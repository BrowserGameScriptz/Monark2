<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mail_read".
 *
 * @property string $mail_read_id
 * @property integer $mail_read_game_id
 * @property integer $mail_read_mail_id
 * @property integer $mail_read_user_receive_id
 * @property integer $mail_read_time
 */
class MailRead extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mail_read';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mail_read_game_id', 'mail_read_mail_id', 'mail_read_user_receive_id', 'mail_read_time'], 'required'],
            [['mail_read_game_id', 'mail_read_mail_id', 'mail_read_user_receive_id', 'mail_read_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mail_read_id' => 'Mail Read ID',
            'mail_read_game_id' => 'Mail Read Game ID',
            'mail_read_mail_id' => 'Mail Read Message ID',
            'mail_read_user_receive_id' => 'Mail Read User Receive ID',
            'mail_read_time' => 'Mail Read Time',
        ];
    }

    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $mail_id
     * @return boolean
     */
    public static function getUserHasReadMail($game_id, $user_id, $mail_id){
    	if(self::find()->where(['mail_read_mail_id' => $mail_id])->andWhere(['mail_read_user_receive_id	' => $user_id])->andWhere(['mail_read_game_id' => $game_id])->one() === null)
    		return false;
    	return true;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     */
    public static function getUserHasReadMailById($game_id, $user_id){
    	$data = self::getUserHasReadMailAll($game_id, $user_id);
    	$returned = array();
    	foreach ($data as $read)
    		array_push($returned, $read['mail_read_id']);
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @return \app\models\MailRead[]
     */
    public static function getUserHasReadMailAll($game_id, $user_id){
    	return self::find()->where(['mail_read_user_receive_id' => $user_id])->andWhere(['mail_read_game_id' => $game_id])->all();
    }
    
    /**
     * 
     * @param unknown $user_id
     * @return \app\models\Mail[]
     */
    public static function getUserReadNotGameMail($user_id){
    	return self::getUserReadGameMail(0, $user_id);
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @return \app\models\MailRead[]
     */
    public static function getUserReadGameMail($game_id, $user_id){
    	return self::find()->where(['mail_read_game_id' => $game_id])->andWhere(['mail_read_user_receive_id' => $user_id])->all();
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $mail_id
     * @return number
     */
    public static function insertMailReadLog($game_id, $user_id, $mail_id){
    	if(!self::getUserHasReadMail($game_id, $user_id, $mail_id))
	    	return Yii::$app->db->createCommand()->insert(self::tableName(), [
	            		'mail_read_game_id' 		=> $game_id,
	            		'mail_read_mail_id' 		=> $mail_id,
	            		'mail_read_user_receive_id' => $user_id,
	            		'mail_read_time' 			=> time(),
	    		])->execute();
	    return 0;
    }
    
    
    /**
     * @inheritdoc
     * @return \app\queries\MailReadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\MailReadQuery(get_called_class());
    }
}
