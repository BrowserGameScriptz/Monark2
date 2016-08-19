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
	public $frontier;
	public $botFrontierData;
	
	public function __construct($bot){
		$this->bot = $bot;
		$this->getData();
	}
	
	private function getData(){
		// Resources
		if(Yii::$app->session['Resource'] == null){
			$this->resource 			= Resource::findAllResourcesToArray();}else{
			$this->resource 			= Yii::$app->session['Resource'];}
			
		// Current turn
		$this->currentTurn				= Turn::getLastTurnByGameId($this->bot->game_id);
				
		// Current game
		$this->game						= Game::getGameById($this->bot->game_id);
		
		// Game Player
		$gamePlayerDataGlobal 			= GamePlayer::findAllGamePlayer($this->bot->game_id);
		$gamePlayerData 				= GamePlayer::findAllGamePlayerToArrayWithData($gamePlayerDataGlobal);
		$gamePlayerData[0]				= GamePlayer::findPlayerZero();
		$gamePlayerData[-99]			= GamePlayer::findPlayerUnknown();
		$this->gamePlayer				= $gamePlayerData;
														 
		// Game data
		// TODO global & botLand use global game data
		$this->gameData					= GameData::getGameDataByIdToArray($this->bot->game_id);
		$this->botLand					= GameData::getUserLandId(null, $this->bot->game_id, $this->bot->bot_id);	 
		
		// Building
		$this->buildingData				= Building::findAllBuildingToArray();
			
		// Frontier	 
		if(Yii::$app->session['Frontier'] == null)
			Yii::$app->session->set("Frontier", Frontier::findAllFrontier($this->game->getMapId()));
		$this->frontier 		= Yii::$app->session['Frontier'];
		$this->botFrontierData	= Frontier::userHaveFrontierLandArray($this->gameData, $this->bot->bot_id, $this->frontier);
	}
	
}

?>