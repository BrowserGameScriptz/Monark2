<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alert_read".
 *
 * @property string $alert_read_id
 * @property integer $alert_read_game_id
 * @property integer $alert_read_user_id
 * @property integer $alert_read_time
 */
class AlertRead extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alert_read';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alert_read_game_id', 'alert_read_user_id', 'alert_read_time'], 'required'],
            [['alert_read_game_id', 'alert_read_user_id', 'alert_read_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alert_read_id' => 'Alert Read ID',
            'alert_read_game_id' => 'Alert Read Game ID',
            'alert_read_user_id' => 'Alert Read User ID',
            'alert_read_time' => 'Alert Read Time',
        ];
    }

    /**
     *
     * @param unknown $game_id
     * @param unknown $user_id
     */
    public static function getUserLastAlertReadTime($game_id, $user_id){
    	$result = self::find()->where(['alert_read_game_id' => $game_id])->andWhere(['alert_read_user_id' => $user_id])->orderBy(['alert_read_time' => SORT_DESC])->one();
    	if($result['alert_read_time'] != null)
    		return $result['alert_read_time'];
    	else
    		return 0;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @return number
     */
    public static function insertAlertReadLog($game_id, $user_id){
    	if(Alert::countUserUnReadAlert($game_id, $user_id) > 0)
    		return Yii::$app->db->createCommand()->insert(self::tableName(), [
    				'alert_read_game_id'   	=> $game_id,
    				'alert_read_user_id'   	=> $user_id,
    				'alert_read_time'  		=> time(),
    		])->execute();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\AlertReadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\AlertReadQuery(get_called_class());
    }
}
