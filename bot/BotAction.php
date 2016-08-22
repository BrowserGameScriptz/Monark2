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
	
	public function __construct($bot){
		$this->bot								= $bot;
		$this->ennemyLandSortedByThreatNegative = $this->bot->bot_eval_land['ennemy']['threat']['negative'];
		$this->ennemyLandSortedByThreatPositive = $this->bot->bot_eval_land['ennemy']['threat']['positive'];
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
		asort($this->ennemyLandSortedByThreatPositive);
		
		$this->BotEnnemyLandAction();
		$this->BotOwnLandAction();
		$this->bot->bot_log->botAddEndAction("Init Action Land");
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
	
		$this->bot->bot_log->botAddResult("Achat de : ".$units);
		if($buyError === true){
			$buy->BuyExec();
			$this->bot->bot_data->updateTurnGold($cost);
			$this->currentActionExecuted++;
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
			
			$this->bot->bot_log->botAddResult("Construction de : ".$building_id);
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
				$this->currentActionExecuted++;
			}else
				$this->bot->bot_log->botAddResult("Erreur : ".$fightError);
		}
	}
	
	/**
	 * 
	 * @param $land_id
	 * @param $units
	 */
	private function BotOwnLandDefend($land_id, $degree){
		if($degree > 10){
			if($this->bot->bot_data->currentTurn->getTurnGold()/2 >= $this->bot->bot_data->buildingData[$this->bot->frt_build_id]->getBuildingCost()){
				$this->BotOwnLandBuild($land_id, $this->bot->frt_build_id);
			}
		}
		$this->BotOwnLandBuy($land_id, round($degree*1.2));
	}
	
	/**
	 * 
	 * @param unknown $land_atk_id
	 * @param unknown $land_def_id
	 * @param unknown $degree
	 */
	private function BotLandAttack($land_atk_id, $land_def_id, $degree){
		$units_add = 0;
		if($degree > 0){
			if($degree > 10){
				if($this->bot->bot_data->currentTurn->getTurnGold()/3 >= $this->bot->bot_data->buildingData[$this->bot->frt_build_id]->getBuildingCost()){
			 		$this->BotOwnLandBuild($land_atk_id, $this->bot->pc_build_id);
			 		$degree -= $this->bot->bot_data->buildingData[$this->bot->frt_build_id]->getBuildingCost();
			 	}
			}
			$units_add = $this->BotOwnLandBuy($land_atk_id, round(abs($degree)*1.1));
		}elseif($degree > -10) {
			$units_add = $this->BotOwnLandBuy($land_atk_id, round(abs($degree)*1.2));
		}
		 
		 if(round(($this->bot->bot_data->gameData[$land_atk_id]->getGameDataUnits() + $units_add) / 2) > $this->bot->bot_data->gameData[$land_def_id]->getGameDataUnits()){
		 	$this->BotAttackLand($land_atk_id, $land_def_id, round(($this->bot->bot_data->gameData[$land_atk_id]->getGameDataUnits()) / 2) + $units_add);
		 }else{
		 	$this->BotAttackLand($land_atk_id, $land_def_id, $this->bot->bot_data->gameData[$land_atk_id]->getGameDataUnits() + $units_add);
		 }
	}
	
	/**
	 * 
	 */
	private function BotEnnemyLandAction(){
		foreach(array_reverse($this->ennemyLandSortedByThreatNegative) as $key => $landArray){
			foreach($landArray['ennemy_lands'] as $ennemy_land_id => $ennemyArray){
				if($this->checkAction() && $landArray['own_land_data']->getGameDataLandId() != 0){
					//$this->bot->bot_log->botAddResult("ID = ".$landArray['own_land_data']->getGameDataLandId()." ennemy = ".$ennemy_land_id." Degree neg = ".$landArray['degree']);
					// Threat
					if($landArray['degree'] > 0)
						$this->BotOwnLandDefend($landArray['own_land_data']->getGameDataLandId(), $landArray['degree']);
					
					// To attack	
					else if($landArray['degree'] < 0)
						$this->BotLandAttack($landArray['own_land_data']->getGameDataLandId(), $ennemy_land_id, $landArray['degree']);
					
					/*
					 * Add move
					 */
				}
			}
		}
		
		
	}
	
	/**
	 * 
	 */
	private function BotOwnLandAction(){
		foreach(array_reverse($this->ennemyLandSortedByThreatPositive) as $land => $degree){
			if($this->checkAction() && $land != 0){
				//$this->bot->bot_log->botAddResult("ID = ".$land." Degree neg = ".$degree);
		
				/*
				 * Build resource
				 */
		
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