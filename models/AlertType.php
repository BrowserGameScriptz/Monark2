<?php

namespace app\models;

use Yii;
use app\classes\AlertTypeClass;

/**
 * This is the model class for table "alert_type".
 *
 * @property string $alert_type_id
 * @property string $alert_type_message
 * @property string $alert_type_color
 * @property integer $alert_type_parameter
 */
class AlertType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alert_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alert_type_message', 'alert_type_color', 'alert_type_parameter'], 'required'],
            [['alert_type_parameter'], 'integer'],
            [['alert_type_message', 'alert_type_color'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alert_type_id' => 'Alert Type ID',
            'alert_type_message' => 'Alert Type Message',
            'alert_type_color' => 'Alert Type Color',
            'alert_type_parameter' => 'Alert Type Parameter',
        ];
    }
    
    /**
     * 
     * @return \app\classes\AlertTypeClass
     */
    public static function findAllAlertTypeToArray(){
    	$returned = array();
    	$data = self::findAllAlertType();	
		foreach($data as $alertType)
    		$returned[$alertType['alert_type_id']] = new AlertTypeClass($alertType);
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $alertTypeId
     */
    public static function findAlertTypeById($alertTypeId){
    	return null;
    }
    
    /**
     * 
     */
    public static function findAllAlertType(){
    	return self::find()->all();
    }

    /**
     * @inheritdoc
     * @return \app\queries\AlertTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\AlertTypeQuery(get_called_class());
    }
}
