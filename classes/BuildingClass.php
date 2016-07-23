<?php

namespace app\classes;

/**
 * 
 * @author Paul
 *
 */
class BuildingClass{
	 
	 private $buildingId;
	 private $buildingName;
	 private $buildingCost;
	 private $buildingIdNeed;
	 private $buildingGoldIncome;
	 private $buildingPetrolIncome;
	 private $buildingDescription;
	
	/**
	 * 
	 */
	public function __construct($buildingData) {
		// DB data
		$this->buildingId 				= $buildingData['building_id'];	
		$this->buildingName 			= $buildingData['building_name'];
		$this->buildingCost 			= $buildingData['building_cost'];
		$this->buildingIdNeed 			= $buildingData['building_id_need'];
		$this->buildingGoldIncome 		= $buildingData['building_gold_income'];
		$this->buildingPetrolIncome 	= $buildingData['building_petrol_income'];
		$this->buildingDescription 		= $buildingData['building_description'];
	}
	
	public function getBuildingId(){
		return $this->building_id;
	}
	
	public function getBuildingName(){
		return ucfirst($this->building_name);
	}
}