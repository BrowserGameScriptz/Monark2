<?php 

class BotData extends \yii\base\Object
{
	private $bot;
	private $resource;
	private $currentTurn;
	private $gamePlayer;
	private $gameData;
	private $buildingData;
	private $frontier;
	private $botFrontierData;
	
	public function __construct($bot){
		$this->bot = $bot;
	}
	
	public function getData(){
		// Resources
		if(Yii::$app->session['Resource'] == null){
			$this->resource 			= Resource::findAllResourcesToArray();}else{
			$this->resource 			= Yii::$app->session['Resource'];}
			
		// Current turn
		$this->currentTurn				= Turn::getLastTurnByGameId($this->bot->game_id);
															 
		// Game Player
		$gamePlayerDataGlobal 			= GamePlayer::findAllGamePlayer($this->bot->game_id);
		$gamePlayerData 				= GamePlayer::findAllGamePlayerToArrayWithData($gamePlayerDataGlobal);
		$gamePlayerData[0]				= GamePlayer::findPlayerZero();
		$gamePlayerData[-99]			= GamePlayer::findPlayerUnknown();
		$this->gamePlayer				= $gamePlayerData;
															 
		// Game data
		$this->gameData				= GameData::getGameDataByIdToArray($this->bot->game_id);
			 
		// Building
		$this->buildingData			= Building::findAllBuildingToArray();
			
		// Frontier	 
		if(Yii::$app->session['Frontier'] == null)
			Yii::$app->session->set("Frontier", Frontier::findAllFrontier($this->game->getMapId()));
		$this->frontier 		= Yii::$app->session['Frontier'];
		$this->botFrontierData	= Frontier::userHaveFrontierLandArray($this->gameData, $this->bot->bot_id, $this->frontier);
	}
	
}

?>