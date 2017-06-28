<?php

namespace app\classes;

/**
 * 
 * @author Paul
 *
 */
class AlertClass{
	 
	 private $alertId;
	 private $alertTypeId;
	 private $alertGameId;
	 private $alertUserId;
	 private $alertTime;
	 private $alertParameter;
	 
	/**
	 * 
	 */
	public function __construct($alertData) {
		// DB data
		$this->alertId 				= $alertData['alert_id'];	
		$this->alertTypeId 			= $alertData['alert_type_id'];
		$this->alertGameId 			= $alertData['alert_game_id'];
		$this->alertUserId 			= $alertData['alert_user_id'];
		$this->alertTime 			= $alertData['alert_time'];
		$this->alertParameter 		= $alertData['alert_parameter'];
	}
	
	public function getAlertId(){
		return $this->alertId;
	}
	
	public function getAlertTypeId(){
		return $this->alertTypeId;
	}
	
	public function getAlertTime(){
		return $this->alertTime;
	}
	
	public function getAlertParameter(){
		return $this->alertParameter;
	}
}