<?php 
namespace app\bot;
use app\models\Frontier;
use app\models\GameData;
use app\classes\GameDataClass;

class BotEval extends \yii\base\Object
{
	private $bot;
	public $eval_land;
	public $eval_land_ennemy;
	public $eval_land_owned;
	public $eval_player;
	
	public function __construct($bot){
		$this->bot = $bot;
		$this->eval_land['ennemy']['threat']['negative'] = array();
		$this->eval_land['ennemy']['threat']['positive'] = array();
	}
	
	/**
	 * Eval all the differents player to determinate a mark per player --> lvl of threat
	 *
	 * @param  void
	 * @return object var array eval_player full
	 */
	// TODO
	public function BotEvalPlayer(){
		$this->eval_player 		= array();
	}
	
	/**
	 * Eval all the differents land in frontier of all of him to determinate a mark per frontier land --> lvl of threat
	 *
	 * @param  void
	 * @return object var array eval_land full
	 */
	public function BotInitEvalLand(){
		$this->bot->bot_log->botAddActionBegin("Init Eval Land");
		$this->eval_land_ennemy 		= array();
		$this->eval_land_owned 			= array();
		
		// Search land frontier
		foreach ($this->bot->bot_data->botLand as $key => $land) {
			$this->eval_land_owned[$land->getGameDataLandId()] 	= array();
			$this->eval_land_ennemy[$land->getGameDataLandId()] = array();
			
			// Frontier of land 
			$landFrontier = Frontier::landHaveFrontierLandArray($this->bot->bot_data->frontier, $land->getGameDataLandId());
			
			// Add the land
			$this->eval_land_owned[$land->getGameDataLandId()][$land->getGameDataLandId()] = $this->bot->bot_data->gameData[$land->getGameDataLandId()];
			
			// Each frontier land
			foreach ($landFrontier as $key => $frontier) {	
				// Ennemy land
				if($this->bot->bot_data->gameData[$frontier->getFrontierLandIdTwo()]->getGameDataUserId() != $this->bot->bot_id){
					if(!in_array($this->bot->bot_data->gameData[$frontier->getFrontierLandIdTwo()], $this->eval_land_ennemy[$land->getGameDataLandId()])){
						$this->eval_land_ennemy[$land->getGameDataLandId()][$frontier->getFrontierLandIdTwo()] = $this->bot->bot_data->gameData[$frontier->getFrontierLandIdTwo()];
					}
					
				// Owned land
				}else{
					if(!in_array($this->bot->bot_data->gameData[$frontier->getFrontierLandIdTwo()], $this->eval_land_owned[$land->getGameDataLandId()])){
						$this->eval_land_owned[$land->getGameDataLandId()][$frontier->getFrontierLandIdTwo()] = $this->bot->bot_data->gameData[$frontier->getFrontierLandIdTwo()];
					}
				}
			}
		}
		$this->eval_land = array(
			'ennemy' => $this->eval_land_ennemy,
			'owned'	 => $this->eval_land_owned,
		);
		
		$this->bot->bot_log->botAddEndAction("Init Eval Land");
		
		// Call method of eval
		$this->BotEvalLands();
	}

	/**
	 * Calls methods of eval own lands & ennemy lands
	 * Return eval data in $this->eval_land
	 */
	private function BotEvalLands(){
		$this->bot->bot_log->botAddActionBegin("Eval Land");
		
		// Own
		$this->BotEvalOwnLands();
		
		// Ennemy
		$this->BotEvalEnnemyLands();
		
		$this->bot->bot_log->botAddEndAction("Eval Land");
	}
	
	/**
	 * Return eval data in :
	 * - $this->eval_land['owned'][land_id]
	 */
	private function BotEvalOwnLands(){
		foreach($this->eval_land['owned'] as $key => $lands)
			foreach ($this->eval_land['owned'][$key] as $frontier){
				$this->eval_land['owned'][$key] = $frontier;
		}
	}
	
	/**
	 * Return eval data in : 
	 * - $this->eval_land['ennemy'][land_id]['evalThreat]
	 */
	private function BotEvalEnnemyLands(){
		foreach($this->eval_land['ennemy'] as $key => $lands)
			foreach ($this->eval_land['ennemy'][$key] as $frontier){
				$this->eval_land['ennemy'][$key] = $frontier; 
				
				$degree_negative = $this->BotEvalEnnemyLandNegativeThreat($this->bot->bot_data->gameData[$key], $frontier);
				$degree_positive = $this->BotEvalEnnemyLandPositiveThreat($frontier);
				
				// Negative degree
				if(isset($this->eval_land['ennemy']['threat']['negative'][$key]['degree']))
					$this->eval_land['ennemy']['threat']['negative'][$key]['degree'] += $degree_negative;
				else
					$this->eval_land['ennemy']['threat']['negative'][$key]['degree'] =  $degree_negative;
				
				$this->eval_land['ennemy']['threat']['negative'][$key]['own_land_data'] = $this->bot->bot_data->gameData[$key];
				$this->eval_land['ennemy']['threat']['negative'][$key]['ennemy_lands'][$frontier->getGameDataLandId()] = array(
						'ennemy_land_data' 	=> $frontier,
						'degree'			=> $degree_negative,
				);
					
				// Positive degree
				if(isset($this->eval_land['ennemy']['threat']['positive'][$key]['degree']))
					$this->eval_land['ennemy']['threat']['positive'][$key]['degree'] += $degree_positive;
				else
					$this->eval_land['ennemy']['threat']['positive'][$key] = array('degree' =>  $degree_positive);
		}
	}
	
	/**
	 * 
	 * @param GameDataClass $ennemyFrontierLandData
	 * @return number
	 */
	private function BotEvalEnnemyLandPositiveThreat(GameDataClass $ennemyFrontierLandData){
		$positive = 0;
		
		// Resource
		$resource_id 	= $ennemyFrontierLandData->getGameDataResourceId();
		if($resource_id != 0)
			$positive 	= $this->bot->bot_data->buildingData[$this->bot->bot_data->resource[$resource_id]->getResourceBuildingId()]->getBuildingGoldIncome();
			
		// Buildings
		$buildings 		= $ennemyFrontierLandData->getGameDataBuildings();
		foreach($buildings as $key => $building_id)
			if($building_id != null)
				$positive 	+= $this->bot->bot_data->buildingData[$building_id]->getBuildingGoldIncome();
		
		return $positive;
	}
	
	/**
	 * 
	 * @param GameDataClass $ownLandData
	 * @param GameDataClass $ennemyFrontierLandData
	 * @return number
	 */
	private function BotEvalEnnemyLandNegativeThreat(GameDataClass $ownLandData, GameDataClass $ennemyFrontierLandData){
		$negativeEnnemy = 0;
		$positiveOwn = 0;
		
		// Ennemy Units
		$negativeEnnemy += $ennemyFrontierLandData->getGameDataUnits();
		
		// Fort
		$ennemyBuilding = $ennemyFrontierLandData->getGameDataBuildings();
		if(in_array($this->bot->frt_build_id, $ennemyBuilding))
			$negativeEnnemy *= $this->bot->frt_multiplier;
		
		// Own Units
		$positiveOwn 	+= $ownLandData->getGameDataUnits();
		
		// Camp
		$ownBuilding 	= $ownLandData->getGameDataBuildings();
		if(in_array($this->bot->frt_build_id, $ownBuilding))
			$positiveOwn *= $this->bot->pc_multiplier;
		
		return $negativeEnnemy - $positiveOwn;
	}
}
?>