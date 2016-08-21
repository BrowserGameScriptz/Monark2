<?php 
namespace app\bot;
use yii\base\Object;
use app\models\Turn;

class BotAction extends \yii\base\Object
{
	private $bot;
	private $ennemyLandSortedByThreatNegative;
	private $ennemyLandSortedByThreatPositive;
	private $maxActionByDifficulty;
	private $currentActionExecuted;
	
	public function __construct($bot){
		$this->bot								= $bot;
		$this->ennemyLandSortedByThreatNegative = $this->bot->bot_eval_land['ennemy']['threat']['negative'];
		$this->maxActionByDifficulty			= $this->bot->bot_data->difficultyData->getDifficultyBotActionPerTurn();
		$this->currentActionExecuted			= 0;
	}
	
	/**
	 * 
	 */
	public function BotInitActionLand(){
		$this->bot->bot_log->botAddActionBegin("Init Action Land");
		
		// Sort
		asort($this->ennemyLandSortedByThreatNegative);
		
		
		
		$this->BotEnnemyLandAction();
		//$this->BotOwnLandAction();
		$this->bot->bot_log->botAddEndAction("Init Action Land");
	}
	
	/**
	 *
	 * @param GameDataClass $ownLandData
	 * @param array $ownFrontierLandData
	 */
	private function BotOwnLandAction(){
		// 	foreach($this->bot->bot_eval_land['owned'] as $ownedLand){
		/*$this->BotOwnLandBuy();
		$this->BotOwnLandBuild();
		$this->BotOwnLandMove();*/
	}
	
	/**
	 * 
	 * @param number $land_id
	 * @param number $units
	 */
	private function BotOwnLandBuy(number $land_id, number $units){
		$buy = new Buy();
		
		if($this->bot->bot_data->currentTurn->getTurnGold() > $units)
			$buy->BuyInit($land_id, $this->userData, $this->bot->bot_data->game, $this->bot->bot_data->gameData, $this->bot->bot_data->currentTurn, $units);
		else 
			$buy->BuyInit($land_id, $this->userData, $this->bot->bot_data->game, $this->bot->bot_data->gameData, $this->bot->bot_data->currentTurn, $this->bot->bot_data->currentTurn->getTurnGold());
		
		$buyError = $buy->BuyCheck();
		
		if($buyError === true){
			$this->bot->bot_log->botAddResult("Achat de : ".$units);
			//$buy->BuyExec();
		}else
			$this->bot->bot_log->botAddResult("Erreur : ".$buyError);
	}
	
	/**
	 * 
	 * @param number $land_id
	 * @param number $building_id
	 */
	private function BotOwnLandBuild(number $land_id, number $building_id){
		if($this->bot->bot_data->currentTurn->getTurnGold() > $this->bot->bot_data->buildingData[$building_id]->getBuildingCost()){
			$build = new Building();
			$build->BuildInit($land_id, $this->userData, $this->bot->bot_data->game, $this->bot->bot_data->gameData, $this->bot->bot_data->currentTurn, $building_id, $this->bot->bot_data->buildingData);
			$buildError = $build->BuildCheck();
			if($buildError === true){
				$this->bot->bot_log->botAddResult("Construction de : ".$building_id);
				//$build->BuildExec();
			}else
				$this->bot->bot_log->botAddResult("Erreur : ".$buyError);
		}
	}
	
	/**
	 * 
	 */
	private function BotOwnLandMove(){	
		
	}
	
	private function BotAttackLand(){
	
	}
	
	/**
	 * 
	 * @param number $land_id
	 * @param number $units
	 */
	private function BotOwnLandDefend(number $land_id, number $degree){
		if($degree > 10){
			if($this->bot->bot_data->currentTurn->getTurnGold()/3 >= $this->bot->bot_data->buildingData[$this->bot->frt_build_id]->getBuildingCost()){
				$this->BotOwnLandBuild($land_id, $this->bot->frt_build_id);
			}
		}
		$this->BotOwnLandBuy($land_id, round($degree*1.2));
	}
	
	/**
	 * 
	 * @param number $land_id
	 * @param number $units
	 */
	private function BotOwnLandAttack(number $land_id, number $degree){
		
	}
	
	
	/**
	 * 
	 */
	private function BotEnnemyLandAction(){
		foreach($this->ennemyLandSortedByThreatNegative as $land => $degree){
			if($this->checkAction()){
				$degree -= $this->bot->bot_eval_land['ennemy']['threat']['positive'][$land];
				$this->bot->bot_log->botAddResult("ID = ".$land." Degree neg = ".$degree." pos = ".$positive);
				
				// Threat
				if($degree > 0)
					$this->BotOwnLandDefend($land, $degree);
				
				// To attack	
				else
					$this->BotOwnLandAttack($land, $degree);
			}
		}
	}
	
	/**
	 * 
	 * @return boolean
	 */
	private function checkAction(){
		// if current turn
		if($this->currentActionExecuted <= $this->maxActionByDifficulty){
			if($this->bot->bot_data->currentTurn->getTurnGold() > 0){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * End the Turn of the BOT
	 *
	 * @param  void
	 * @return void
	 */
	public function BotEndTurn(){
		/* Pause */
		//sleep(2);
		$this->bot->bot_log->botAddActionBegin("End of turn");
		/* Next turn */
		Turn::NewTurn($this->bot->game_id, $this->bot->bot_id, $this->bot->bot_data->gameData);
		$this->bot->bot_log->botAddEndAction("End of turn");
	}
}
?>