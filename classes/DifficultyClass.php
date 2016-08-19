<?php

namespace app\classes;

use Yii;

/**
 *
 * @author Paul
 *
 */
class DifficultyClass{

	 private $difficulty_id;
	 private $difficulty_name;
	 private $difficulty_rate_resource_freq;
	 private $difficulty_rate_building_cost;
	 private $difficulty_rate_building_icome;
	 private $difficulty_rate_land_base_units;
	 private $difficulty_bot_action_per_turn;
	 private $difficulty_bot_bonus_income;

	/**
	 *
	 */
	public function __construct($difficultyData) {
		$this->difficultyId 					= $difficultyData['difficulty_id'];
		$this->difficultyId 					= $difficultyData['$difficulty_name'];
		$this->difficultyId 					= $difficultyData['$difficulty_rate_resource_freq'];
		$this->difficultyId 					= $difficultyData['$difficulty_rate_building_cost'];
		$this->difficultyId 					= $difficultyData['$difficulty_rate_building_icome'];
		$this->difficultyId 					= $difficultyData['$difficulty_rate_land_base_units'];
		$this->difficultyId 					= $difficultyData['$difficulty_bot_action_per_turn'];
		$this->difficultyId 					= $difficultyData['$difficulty_bot_bonus_income'];
	}

	public function getDifficultyId(){
		return $this->difficultyId;
	}
}
