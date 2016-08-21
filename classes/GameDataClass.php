<?php

namespace app\classes;

use app\models\Building;

/**
 * 
 * @author Paul
 *
 */
class GameDataClass{
	
	private $gameDataId;
	private $gameDataGameId;
	private $gameDataUserId;
	private $gameDataUserIdBase;
	private $gameDataLandId;
	private $gameDataUnits;
	private $gameDataCapital;
	private $gameDataResourceId;
	private $gameDataBuildings;
	
	/**
	 *
	 */
	public function __construct($gameData) {
		$this->gameDataId 			= $gameData['game_data_id'];
		$this->gameDataGameId 		= $gameData['game_data_game_id'];
		$this->gameDataUserId 		= $gameData['game_data_user_id'];
		$this->gameDataUserIdBase 	= $gameData['game_data_user_id_base'];
		$this->gameDataLandId 		= $gameData['game_data_land_id'];
		$this->gameDataUnits 		= $gameData['game_data_units'];
		$this->gameDataCapital 		= $gameData['game_data_capital'];
		$this->gameDataResourceId 	= $gameData['game_data_resource_id'];
		$this->gameDataBuildings 	= $gameData['game_data_buildings'];
	}
	
	public function getGameDataUserId(){
		return $this->gameDataUserId;
	}
	
	public function getGameDataGameId(){
		return $this->gameDataGameId;
	}
	
	public function getGameDataLandId(){
		return $this->gameDataLandId;
	}
	
	public function getGameDataResourceId(){
		return $this->gameDataResourceId;
	}
	
	public function getGameDataBuildingsSQL(){
		return $this->gameDataBuildings;
	}
	
	public function getGameDataBuildings(){
		return explode(";", $this->gameDataBuildings);
	}
	
	public function setGameDataBuildings($newBuildingId){
		if($this->gameDataBuildings == "")
			$this->gameDataBuildings = $newBuildingId;
		else
			$this->gameDataBuildings = $this->gameDataBuildings.";".$newBuildingId;
	}
	
	public function getGameDataCapital(){
		return $this->gameDataCapital;
	}
	
	public function getGameDataUnits(){
		return $this->gameDataUnits;
	}
	
	public function setGameDataUnits($newUnits){
		$this->gameDataUnits = $newUnits;
	}
	
	public function getGameDataBuildingsToBuild($landResourceId, $buildingData){
		return Building::getBuildingsToBuild($this->getGameDataBuildings(), $landResourceId, $buildingData);
	}
}