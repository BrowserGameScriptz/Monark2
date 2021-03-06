<?php

namespace app\classes;

use Yii;

/**
 *
 * @author Paul
 *
 */
class DifficultyClass{

	 private $difficultyId;
	 private $difficultyName;
	 private $difficultyRateResourceFreq;
	 private $difficultyRateBuildingCost;
	 private $difficultyRateBuildingIcome;
	 private $difficultyRateLandBaseUnits;
	 private $difficultyBotActionPerTurn;
	 private $difficultyBotBonusIncome;
	 private $difficultyHide;

	/**
	 *
	 */
	public function __construct($difficultyData) {
		$this->difficultyId 					= $difficultyData['difficulty_id'];
		$this->difficultyName 					= $difficultyData['difficulty_name'];
		$this->difficultyRateResourceFreq 		= $difficultyData['difficulty_rate_resource_freq'];
		$this->difficultyRateBuildingCost 		= $difficultyData['difficulty_rate_building_cost'];
		$this->difficultyRateBuildingIcome 		= $difficultyData['difficulty_rate_building_icome'];
		$this->difficultyRateLandBaseUnits 		= $difficultyData['difficulty_rate_land_base_units'];
		$this->difficultyBotActionPerTurn 		= $difficultyData['difficulty_bot_action_per_turn'];
		$this->difficultyBotBonusIncome 		= $difficultyData['difficulty_bot_bonus_income'];
		$this->difficultyHide					= $difficultyData['difficulty_hide'];
	}

	public function getDifficultyId(){
		return $this->difficultyId;
	}
	
	public function getDifficultyBotActionPerTurn(){
		return $this->difficultyBotActionPerTurn;
	}
	
	public function getDifficultyName(){
		return Yii::t('difficulty', $this->difficultyName);
	}
	
	public function getDifficultyRateResourceFreq(){
		return $this->difficultyRateResourceFreq;
	}
	
	public function getDifficultyRateLandBaseUnits(){
		return $this->difficultyRateLandBaseUnits;
	}
	
	public function getDifficultyBotBonusIncome(){
		return $this->difficultyBotBonusIncome;
	}
}
