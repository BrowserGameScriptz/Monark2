<?php

namespace app\classes;
use Yii;
/**
 * 
 * @author Paul
 *
 */

class AlertTypeClass{

	private $alertTypeId;
	private $alertTypeMessage;
	private $alertTypeColor;
	private $alertTypeParameter;

	/**
	 *
	 */
	public function __construct($alertTypeData) {
		// DB data
		$this->alertTypeId 					= $alertTypeData['alert_type_id'];
		$this->alertTypeMessage 			= $alertTypeData['alert_type_message'];
		$this->alertTypeColor 				= $alertTypeData['alert_type_color'];
		$this->alertTypeParameter 			= $alertTypeData['alert_type_parameter'];
	}

	public function getAlertTypeId(){
		return $this->alertTypeId;
	}
	
	public function getAlertTypeColor(){
		return $this->alertTypeColor;
	}
	
	public function getAlertTypeMessage($param=null){
		if($param != null)
			return Yii::t('alert', $this->alertTypeMessage, ['param' => $param]);
		else
			return Yii::t('alert', $this->alertTypeMessage);		
	}
	
	public function getAlertTypeParameter(){
		return $this->alertTypeParameter;
	}
}