<?php 
namespace app\bot;
use yii\base\Object;
use app\models\Turn;
use app\models\Move;
use app\models\Building;
use app\models\Buy;
use app\models\Fight;

class BotAction extends \yii\base\Object
{
	private $bot;
	private $ennemyLandSortedByThreatNegative;
	private $ennemyLandSortedByThreatPositive;
	private $maxActionByDifficulty;
	private $currentActionExecuted;
	private $boughtInTurn;
	
	public function __construct($bot){
		$this->bot								= $bot;
		$this->ennemyLandSortedByThreatNegative = $this->bot->bot_eval_land['ennemy']['threat']['negative'];
		$this->ennemyLandSortedByThreatPositive = $this->bot->bot_eval_land['ennemy']['threat']['positive'];
		$this->maxActionByDifficulty			= $this->bot->bot_data->difficultyData->getDifficultyBotActionPerTurn();
		
		$this->currentActionExecuted			= 0;
		$this->boughtInTurn					= array();
		
		print "<pre>";
		print_r($this->ennemyLandSortedByThreatNegative);
		print "</pre>";
	}
	
	/**
	 * 
	 */
	public function BotInitActionLand(){
		$this->bot->bot_log->botAddActionBegin("Init Action Land");
		
		// Sort
		asort($this->ennemyLandSortedByThreatNegative);
		asort($this->ennemyLandSortedByThreatPositive);
		
		$this->BotLandAction();
		$this->bot->bot_log->botAddEndAction("Init Action Land");
	}
	
	/**
	 * 
	 * @param unknown $land_id
	 * @param unknown $add
	 */
	private function updateBuyInTurn($land_id, $add){
		if(!isset($this->boughtInTurn[$land_id]))
			$this->boughtInTurn[$land_id] = $add;
		else
			$this->boughtInTurn[$land_id] += $add;
	}
	
	/**
	 * 
	 * @param unknown $land_id
	 * @return number
	 */
	private function getBuyInTurn($land_id){
		if(isset($this->boughtInTurn[$land_id]))
			return $this->boughtInTurn[$land_id];
		else 
			return 0;
	}
	
	/**
	 * 
	 * @param $land_id
	 * @param $units
	 */
	private function BotOwnLandBuy($land_id, $units){
		$units = abs($units);
		$buy = new Buy();
		
		if($this->bot->bot_data->currentTurn->getTurnGold() > $units)
			$cost = $units;
		else
			$cost = $this->bot->bot_data->currentTurn->getTurnGold();
		
		$buy->BuyInit($land_id, $this->bot->bot_data->userData, $this->bot->bot_data->game, $this->bot->bot_data->gameData, $this->bot->bot_data->currentTurn, $cost);
		$buyError = $buy->BuyCheck();
	
		$this->bot->bot_log->botAddResult("Achat de : ".$cost, $land_id, $this->bot->bot_data->currentTurn->getTurnGold());
		if($buyError === true){
			$buy->BuyExec();
			$this->bot->bot_data->updateTurnGold($cost);
			$this->currentActionExecuted++;
			$this->bot->bot_data->updateGameDataUnits($cost, $land_id);
			$this->updateBuyInTurn($land_id, $cost);
			return $cost;
		}else{
			$this->bot->bot_log->botAddResult("Erreur : ".$buyError);
			return 0;
		}
	}
	
	/**
	 * 
	 * @param $land_id
	 * @param $building_id
	 */
	private function BotOwnLandBuild($land_id, $building_id){
		if($this->bot->bot_data->currentTurn->getTurnGold() > $this->bot->bot_data->buildingData[$building_id]->getBuildingCost()){
			$build = new Building();
			$build->BuildInit($land_id, $this->bot->bot_data->userData, $this->bot->bot_data->game, $this->bot->bot_data->gameData, $this->bot->bot_data->currentTurn, $building_id, $this->bot->bot_data->buildingData);
			$buildError = $build->BuildCheck();
			
			$this->bot->bot_log->botAddResult("Construction de : ".$building_id, $land_id, $this->bot->bot_data->currentTurn->getTurnGold());
			if($buildError === true){
				$build->BuildExec();
				$this->bot->bot_data->updateTurnGold($this->bot->bot_data->buildingData[$building_id]->getBuildingCost());
				$this->currentActionExecuted++;
			}else
				$this->bot->bot_log->botAddResult("Erreur : ".$buildError);
		}
	}
	
	/**
	 * 
	 * @param $land_id_from
	 * @param $land_id_to
	 * @param $units
	 */
	private function BotOwnLandMove($land_id_from, $land_id_to, $units){	
		$move = new Move();
		$move->MoveInit($land_id_from, $this->bot->bot_data->userData, $this->bot->bot_data->game, $this->bot->bot_data->gameData, $this->bot->bot_data->currentTurn, $land_id_to, $units, $this->bot->bot_data->frontier);
		$moveError = $move->MoveCheck();
		if($moveError === true) $move->MoveExec();
		$this->currentActionExecuted++;
	}
	
	/**
	 * 
	 * @param $land_id_atk
	 * @param $land_id_def
	 * @param $units
	 */
	private function BotAttackLand($land_id_atk, $land_id_def, $units){
		
		if($units == $this->bot->bot_data->gameData[$land_id_atk]->getGameDataUnits())
			$units--;
		
		if($this->bot->bot_data->gameData[$land_id_atk]->getGameDataUnits() > 0 && $this->bot->bot_data->gameData[$land_id_atk]->getGameDataUserId() != $this->bot->bot_data->gameData[$land_id_def]->getGameDataUserId()){
			$this->bot->bot_log->botAddResult("Attack de : ".$land_id_def." Depuis ".$land_id_atk." Avec : ".$units);
			$fight = new Fight();
			$fight->FightInit($land_id_def, $this->bot->bot_data->userData, $this->bot->bot_data->game, $this->bot->bot_data->gameData, $this->bot->bot_data->currentTurn, $land_id_atk, $units, $this->bot->bot_data->frontier);
			$fightError = $fight->FightCheck();
			$attack_result = array();
			if($fightError === true){
				$attack_result = $fight->FightExec();
				
				// Update data
				$this->bot->bot_data->getGameData();
				
				$this->currentActionExecuted++;
			}else
				$this->bot->bot_log->botAddResult("Erreur : ".$fightError);
		}
	}
	
	/**
	 * 
	 * @param unknown $land_id
	 * @param unknown $degree
	 * @param unknown $ennemy_land_id
	 */
	private function BotOwnLandDefend($land_id, $degree, $ennemy_land_id){
		// Not neutral
		if($this->bot->bot_data->gameData[$ennemy_land_id]->getGameDataUserId() != 0){
			// If need construction
			if($degree > 5){
				if($this->bot->bot_data->currentTurn->getTurnGold()/2 >= $this->bot->bot_data->buildingData[$this->bot->frt_build_id]->getBuildingCost()){
					$this->BotOwnLandBuild($land_id, $this->bot->frt_build_id);
				}
			}
			$this->BotOwnLandBuy($land_id, abs(round($degree*1.2) - $this->getBuyInTurn($land_id)));
		}
	}
	
	/**
	 * 
	 * @param unknown $land_atk_id
	 * @param unknown $land_def_id
	 * @param unknown $degree
	 */
	private function BotLandAttack($land_atk_id, $land_def_id, $degree){
		$units_add = 0;
		
		// Need buy units
		if($degree > 0){
			
			// If need construction
			if($degree > 5){
				if($this->bot->bot_data->currentTurn->getTurnGold()/2 >= $this->bot->bot_data->buildingData[$this->bot->pc_build_id]->getBuildingCost()){
					$this->BotOwnLandBuild($land_atk_id, $this->bot->pc_build_id);
					$degree -= $this->bot->bot_data->buildingData[$this->bot->pc_build_id]->getBuildingCost();
				}
			}
		}
			
		// Buy units
		if(($this->bot->bot_data->gameData[$land_atk_id]->getGameDataUnits()) < round($this->bot->bot_data->gameData[$land_def_id]->getGameDataUnits()*1.2)){
			$units_add = $this->BotOwnLandBuy($land_atk_id, abs(round($degree*1.2) - $this->getBuyInTurn($land_atk_id)));
		}
		
		// Attack
		if(($this->bot->bot_data->gameData[$land_atk_id]->getGameDataUnits() + $units_add) > round($this->bot->bot_data->gameData[$land_def_id]->getGameDataUnits()*1.2)){
			$this->BotAttackLand($land_atk_id, $land_def_id, round($this->bot->bot_data->gameData[$land_def_id]->getGameDataUnits()*1.2));
		}
		
	}
	
	/**
	 * 
	 */
	private function BotLandAction(){
		// Defend
		$this->BotLandActionEnnemyDefend();
		
		// Check Land action
		$this->BotOwnLandAction();
			
		// Attack
		$this->BotLandActionEnnemyAttack();
		
		// Rest
		$this->BotOwnLandRestAction();
	}
	
	/**
	 * 
	 */
	private function BotLandActionEnnemyDefend(){
		foreach(array_reverse($this->ennemyLandSortedByThreatNegative) as $key => $landArray){
			foreach($landArray['ennemy_lands'] as $ennemy_land_id => $ennemyArray){
				//$this->bot->bot_log->botAddResult("ID = ".$landArray['own_land_data']->getGameDataLandId()." ennemy = ".$ennemy_land_id." Degree neg = ".$landArray['degree']);
				if($this->checkAction())
					if($landArray['degree'] > 0)
						$this->BotOwnLandDefend($landArray['own_land_data']->getGameDataLandId(), $landArray['degree'], $ennemy_land_id);
			}
		}
	}
	
	/**
	 * 
	 */
	private function BotLandActionEnnemyAttack(){
		foreach($this->ennemyLandSortedByThreatNegative as $key => $landArray){
			foreach($landArray['ennemy_lands'] as $ennemy_land_id => $ennemyArray){
				//$this->bot->bot_log->botAddResult("ID = ".$landArray['own_land_data']->getGameDataLandId()." ennemy = ".$ennemy_land_id." Degree neg = ".$landArray['degree']);
				if($this->checkAction())
					$this->BotLandAttack($landArray['own_land_data']->getGameDataLandId(), $ennemy_land_id, $landArray['degree']);
			}
		}
	}
	
	/**
	 * 
	 */
	private function BotOwnLandAction(){
		foreach($this->bot->bot_eval_land['owned'] as $land){
			// Building ressource
			$to_build = $this->bot->bot_data->gameData[$land->getGameDataLandId()]->getGameDataBuildingsToBuild($this->bot->bot_data->gameData[$land->getGameDataLandId()]->getGameDataResourceId(), $this->bot->bot_data->buildingData);
			foreach($to_build as $build){
				if(isset($this->bot->bot_data->buildingData[$build->getBuildingId()]) && $this->bot->bot_data->buildingData[$build->getBuildingId()]->getBuildingGoldIncome() > 0){
					$this->BotOwnLandBuild($land->getGameDataLandId(), $build->getBuildingId());
				}
			}
		}
	}
	
	/**
	 * 
	 */
	private function BotOwnLandRestAction(){
		$owned_land_count 	= count($this->bot->bot_eval_land['owned']);
		if($owned_land_count > 0){
			$gold_per_land 		= round($this->bot->bot_data->currentTurn->getTurnGold() / $owned_land_count);
			foreach($this->bot->bot_eval_land['owned'] as $land){
				if($this->checkAction()){
					$this->BotOwnLandBuy($land->getGameDataLandId(), $gold_per_land);
				}
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