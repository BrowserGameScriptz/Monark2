<?php

namespace app\classes;

/**
 * 
 * @author Paul
 *
 */
class FightDataClass{
	 
	private $fightId;
	private $fightGameId;
	private $fightAtkUserId;
	private $fightDefUserId;
	private $fightAtkLandId;
	private $fightDefLandId;
	private $fightAtkLostUnit;
	private $fightDefLostUnit;
	private $fightAtkUnits;
	private $fightDefUnits;
	private $fightAtkNbUnits;
	private $fightDefNbUnits;
	private $fightThimbleAtk;
	private $fightThimbleDef;
	private $fightTime;
	private $fightTurnId;
	private $fightConquest;
	
	/**
	 * 
	 */
	public function __construct($fightData) {
		// DB data
		$this->fightId 					= $fightData['fight_id'];	
		$this->fightGameId 				= $fightData['fight_game_id'];
		$this->fightAtkUserId 			= $fightData['fight_atk_user_id'];
		$this->fightDefUserId 			= $fightData['fight_def_user_id'];
		$this->fightAtkLandId 			= $fightData['fight_atk_land_id'];
		$this->fightDefLandId 			= $fightData['fight_def_land_id'];
		$this->fightAtkLostUnit 		= $fightData['fight_atk_lost_unit'];
		$this->fightDefLostUnit 		= $fightData['fight_def_lost_unit'];
		$this->fightAtkUnits 			= $fightData['fight_atk_units'];
		$this->fightDefUnits 			= $fightData['fight_def_units'];
		$this->fightAtkNbUnits 			= $fightData['fight_atk_nb_units'];
		$this->fightDefNbUnits 			= $fightData['fight_def_nb_units'];
		$this->fightThimbleAtk 			= $fightData['fight_thimble_atk'];
		$this->fightThimbleDef 			= $fightData['fight_thimble_def'];
		$this->fightTime 				= $fightData['fight_time'];
		$this->fightTurnId 				= $fightData['fight_turn_id'];
		$this->fightConquest 			= $fightData['fight_conquest'];
	}
	
	public function getFightId(){
		return $this->fightId;
	}
	
	public function getFightTime(){
		return $this->fightTime;
	}
	
	public function getFightConquest(){
		return $this->fightConquest;
	}
	
	public function getFightAtkLandId(){
		return $this->fightAtkLandId;
	}
	
	public function getFightDefLandId(){
		return $this->fightDefLandId;
	}
	
	public function getFightAtkUserId(){
		return $this->fightAtkUserId;
	}
	
	public function getFightDefUserId(){
		return $this->fightDefUserId;
	}
}