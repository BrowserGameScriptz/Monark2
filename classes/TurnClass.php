<?php

namespace app\classes;

/**
 * 
 * @author Paul
 *
 */
class TurnClass{
	
	private $turn_id;
	private $turn_game_id;
	private $turn_user_id;
	private $turn_time;
	private $turn_time_begin;
	private $turn_gold;
	private $turn_gold_base;
	private $turn_income;
	
	/**
	 *
	 */
	public function __construct($turnData) {
		$this->turnId 				= $turnData['turn_id'];
		$this->turnGameId 			= $turnData['turn_game_id'];
		$this->turnUserId			= $turnData['turn_user_id'];
		$this->turnTime 			= $turnData['turn_time'];
		$this->turnTimeBegin 		= $turnData['turn_time_begin'];
		$this->turnGold 			= $turnData['turn_gold'];
		$this->turnGoldBase			= $turnData['turn_gold_base'];
		$this->turnIncome 			= $turnData['turn_income'];
	}
	
	public function getTurnId(){
		return $this->turnId;
	}

	public function getTurnUserId(){
		return $this->turnUserId;
	}
	
	public function getTurnGold(){
		return $this->turnGold;
	}
	
	public function setTurnGold($newGold){
		$this->turnGold = $newGold;
	}
	
	public function getTurnGoldBase(){
		return $this->turnGoldBase;
	}
	
	public function getTurnIncome(){
		return $this->turnIncome;
	}
	
	public function getTurnTime(){
		return $this->turnTime;
	}
	
	public function getTurnTimeBegin(){
		return $this->turnTimeBegin;
	}
	
}