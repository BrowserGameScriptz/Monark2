<?php

namespace app\models;

use Yii;
use app\classes\AlertClass;

/**
 * This is the model class for table "alert".
 *
 * @property string $alert_id
 * @property integer $alert_type_id
 * @property integer $alert_game_id
 * @property integer $alert_user_id
 * @property integer $alert_time
 * @property integer $alert_parameter
 */
class Alert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alert_type_id', 'alert_game_id', 'alert_user_id', 'alert_time', 'alert_parameter'], 'required'],
            [['alert_type_id', 'alert_game_id', 'alert_user_id', 'alert_time', 'alert_parameter'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alert_id' => 'Alert ID',
            'alert_type_id' => 'Alert Type ID',
            'alert_game_id' => 'Alert Game ID',
            'alert_user_id' => 'Alert User ID',
            'alert_time' => 'Alert Time',
            'alert_parameter' => 'Alert Parameter',
        ];
    }

    /**
     * 
     * @param unknown $parameter_type
     * @param unknown $parameter
     * @param unknown $landData
     * @return NULL
     */
    public static function getParameter($parameter_type, $parameter, $landData){
    	switch ($parameter_type){
    		case 1: 
    				if(isset($landData[$parameter]))
    					return $landData[$parameter]->getLandName();
    		default: return null;
    	}
    	return null;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $limit
     */
    public static function getUserAlertToArray($game_id, $user_id, $limit=null){
    	$returned = array();
    	foreach (self::getUserAlert($game_id, $user_id, $limit) as $alert){
    		array_push($returned, new AlertClass($alert));
    	}
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $time
     * @param number $limit
     */
    public static function getUnReadAlertToArray($game_id, $user_id, $time=null, $limit=10){
    	$returned = array();
    	foreach (self::getUnReadAlert($game_id, $user_id, $time, $limit) as $alert){
    		array_push($returned, new AlertClass($alert));
    	}
    	return $returned;
    }
    
    /**
     *
     * @param unknown $user_id
     * @param unknown $game_id
     * @param unknown $time
     */
    public static function countUserUnReadAlert($game_id, $user_id, $time=null){
    	return count(self::getUnReadAlert($game_id, $user_id, $time));
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $time
     * @param unknown $limit
     */
    public static function getUnReadAlert($game_id, $user_id, $time=null, $limit=null){
    	if($time === null) $time = AlertRead::getUserLastAlertReadTime($game_id, $user_id);
    	return self::find()->where(['alert_game_id' => $game_id])->andWhere("alert_time >= ".$time)->andWhere(['alert_user_id' => $user_id])->orderBy(['alert_time' => SORT_DESC])->limit($limit)->all();
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $limit
     */
    public static function getUserAlert($game_id, $user_id, $limit=null){
    	return self::find()->where(['alert_game_id' => $game_id])->andWhere(['alert_user_id' => $user_id])->orderBy(['alert_time' => SORT_DESC])->limit($limit)->all();
    }
    
    /**
     * 
     * @param unknown $game
     * @param unknown $type_id
     * @param unknown $user_id
     * @param string $parameter
     * @return number
     */
    public static function createAlert($game, $type_id, $user_id, $parameter=null){
    	return Yii::$app->db->createCommand()->insert(self::tableName(), [
    				'alert_type_id'     => $type_id,
    				'alert_game_id'  	=> $gameData->getGameId(),
    				'alert_user_id'     => $user_id,
    				'alert_time'        => time(),
    				'alert_parameter'   => $parameter,
    		])->execute();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\AlertQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\AlertQuery(get_called_class());
    }
}
