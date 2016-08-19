<?php

namespace app\classes;

use Yii;

/**
 * 
 * @author Paul
 *
 */
class MapClass{
	
	private $mapId;
	private $mapName;
	private $mapMusic;
	private $mapContinent;
	private $mapLandIdBegin;
	private $mapLandIdEnd;
	private $mapHide;
	
	/**
	 *
	 */
	public function __construct($mapData) {
		$this->mapId 				= $mapData['map_id'];
		$this->mapName 				= $mapData['map_name'];
		$this->mapMusic 			= $mapData['map_music'];
		$this->mapContinent 		= $mapData['map_continent'];
		$this->mapLandIdBegin 		= $mapData['map_land_id_begin'];
		$this->mapLandIdEnd 		= $mapData['map_land_id_end'];
		$this->mapHide 				= $mapData['map_hide'];
	}
	
	public function getMapId(){
		return $this->mapId;
	}
	
	public function getMapName(){
		return Yii::t('map', $this->mapName);
	}
}