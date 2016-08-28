<?php

namespace app\classes;

use Yii;

/**
 * 
 * @author Paul
 *
 */
class ContinentClass{
	
	private $continent_id;
	private $continent_name;
	private $continent_bonus;
	private $continent_land_id_begin;
	private $continent_land_id_end;
	private $continent_hide;
	private $continent_map_id;
	
	/**
	 * 
	 */
	public function __construct($continentData) {
		// DB data
		$this->continent_id 			= $continentData['continent_id'];	
		$this->continent_name 			= $continentData['continent_name'];
		$this->continent_bonus 			= $continentData['continent_bonus'];
		$this->continent_land_id_begin 	= $continentData['continent_land_id_begin'];
		$this->continent_land_id_end 	= $continentData['continent_land_id_end'];
		$this->continent_hide 			= $continentData['continent_hide'];
		$this->continent_map_id 		= $continentData['continent_map_id'];
	}
	
	public function getContinentId(){
		return $this->continent_id;
	}
	
	public function getContinentBonus(){
		return $this->continent_bonus;
	}
	
	public function getContinentName(){
		return Yii::t('continent', $this->continent_name);
	}
	
	public function getContinentLandIdBegin(){
		return $this->continent_land_id_begin;
	}
	
	public function getContinentLandIdEnd(){
		return $this->continent_land_id_end;
	}
	
	public function getContinentHide(){
		return $this->continent_hide;
	}
	
	public function getContinentMapId(){
		return $this->continent_map_id;
	}
}