<?php

namespace app\bot;

use Yii;
use app\models\Turn;
use app\models\Resource;
use app\models\GamePlayer;
use app\models\GameData;
use app\models\Building;
use app\models\Frontier;
use app\models\Game;
use app\models\Difficulty;

class BotData extends \yii\base\Object
{
	private $bot;
	public $game;
	public $resource;
	public $currentTurn;
	public $gamePlayer;
	public $gameData;
	public $botLand;
	public $buildingData;
	public $difficultyData;
	public $frontier;
	public $userData;
	public $botFrontierData;
	
	/**
	 * 
	 * @param unknown $bot
	 */
	public function __construct($bot){
		$this->bot = $bot;
		$this->getData();
	}
	
	/**
	 * 
	 */
	private function getData(){
		$this->getResourcesData();
		$this->getTurnData();
		$this->getGame();
		$this->getGamePlayerData();
		$this->getGameData();
		$this->getBuildingData();
		$this->getFrontierData();
		$this->getDifficultyData();
		$this->getUserData();
	}
	
	/**
	 * 
	 */
	private function getResourcesData(){
		if(Yii::$app->session['Resource'] == null){
			$this->resource = Resource::findAllResourcesToArray();
		}else{
			$this->resource = Yii::$app->session['Resource'];
		}
	}	

	/**
	 * 
	 */
	private function getTurnData(){
		$this->currentTurn = Turn::getLastTurnByGameId($this->bot->game_id);
	}
	
	/**
	 * 
	 */
	private function getGame(){
		$this->game	= Game::getGameById($this->bot->game_id);
	}
		
	/**
	 * 
	 */
	private function getGamePlayerData(){
		$gamePlayerDataGlobal 			= GamePlayer::findAllGamePlayer($this->bot->game_id);
		$gamePlayerData 				= GamePlayer::findAllGamePlayerToArrayWithData($gamePlayerDataGlobal);
		$gamePlayerData[0]				= GamePlayer::findPlayerZero();
		$gamePlayerData[-99]			= GamePlayer::findPlayerUnknown();
		$this->gamePlayer				= $gamePlayerData;
	}
		
	/**
	 * 
	 */
	public function getGameData(){
		// TODO global & botLand use global game data (1 req db)
		$this->gameData	= GameData::getGameDataByIdToArray($this->bot->game_id);
		$this->botLand	= GameData::getUserLandId(null, $this->bot->game_id, $this->bot->bot_id);	 
	}
	
	/**
	 * 
	 */
	private function getBuildingData(){
		$this->buildingData	= Building::findAllBuildingToArray();
	}
	
	/**
	 * 
	 */
	private function getFrontierData(){
		if (Yii::$app->session ['Frontier'] == null)
			Yii::$app->session->set ( "Frontier", Frontier::findAllFrontier ($this->game->getMapId () ) );
		$this->frontier = Yii::$app->session ['Frontier'];
		$this->botFrontierData = Frontier::userHaveFrontierLandArray ( $this->gameData, $this->bot->bot_id, $this->frontier );
	}
	
	/**
	 * 
	 */
	private function getDifficultyData(){
		$this->difficultyData			= Difficulty::findAllDifficulyToArray()[$this->game->getDifficultyId()];
	}
	
	private function getUserData(){
		$this->userData					= GamePlayer::findUserBot(abs($this->bot->bot_id));
	}
	
	/**
	 * 
	 * @param number $minus
	 */
	public function updateTurnGold($minus){
		$this->currentTurn->setTurnGold($this->currentTurn->getTurnGold() - $minus);
	}
	
	/**
	 * 
	 * @param number $minus
	 * @param number $land_id
	 */
	public function updateGameDataUnits($add, $land_id){
		$this->gameData[$land_id]->setGameDataUnits($this->gameData[$land_id]->getGameDataUnits() + $add);
	}
	
	/**
	 *
	 * @param number $minus
	 * @param number $land_id
	 */
	public function updateGameDataUserId($new_user, $land_id){
		$this->gameData[$land_id]->setGameDataUserId($new_user);
	}
	 
	/**
	 * 
	 * @param number $newBuildingId
	 * @param number $land_id
	 */
	public function updateGameDataBuildings($newBuildingId, $land_id){
		$this->gameData[$land_id]->setGameDataBuildings($newBuildingId);
	}
}

?>