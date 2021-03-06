<?php

namespace app\models;

use Yii;
use app\classes\MailClass;

/**
 * This is the model class for table "mail".
 *
 * @property string $mail_id
 * @property integer $mail_game_id
 * @property integer $mail_time
 * @property string $mail_message
 * @property string $mail_subject
 * @property integer $mail_pact_id
 * @property integer $mail_user_send_id
 * @property integer $mail_user_receive_id
 * @property integer $mail_del
 */
class Mail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mail_game_id', 'mail_time', 'mail_message', 'mail_subject', 'mail_pact_id', 'mail_user_send_id', 'mail_user_receive_id', 'mail_del'], 'required'],
            [['mail_game_id', 'mail_time', 'mail_pact_id', 'mail_user_send_id', 'mail_user_receive_id', 'mail_del'], 'integer'],
            [['mail_message'], 'string', 'max' => 256],
            [['mail_subject'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mail_id' => 'Mail ID',
            'mail_game_id' => 'Mail Game ID',
            'mail_time' => 'Mail Time',
            'mail_message' => 'Mail Message',
            'mail_subject' => 'Mail Subject',
            'mail_pact_id' => 'Mail Pact ID',
            'mail_user_send_id' => 'Mail User Send ID',
            'mail_user_receive_id' => 'Mail User Receive ID',
            'mail_del' => 'Mail Del',
        ];
    }

    /**
     * 
     * @param unknown $user_id
     * @param unknown $limit
     */
    public static function getUserNotGameMailToArray($user_id, $limit=null){
    	$data = self::getUserNotGameMail($user_id, $limit);
    	$returned = array();
    	foreach($data as $mail)
    		array_push($returned, new MailClass($mail));
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $limit
     */
    public static function getUserGameMailToArray($game_id, $user_id, $limit=null){
    	$data = self::getUserGameMail($game_id, $user_id, $limit);
    	$returned = array();
    	foreach($data as $mail)
    		array_push($returned, new MailClass($mail));
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $mail_id
     * @return \app\classes\MailClass
     */
    public static function getMailDataToArray($game_id, $user_id, $mail_id){
    	$data = self::getMailData($game_id, $user_id, $mail_id);
    	return new MailClass($data);
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $limit
     */
    public static function getUserGameMailUnReadToArray($game_id, $user_id, $limit=null){
    	$data = self::getUserGameMailUnRead($game_id, $user_id, $limit);
    	$returned = array();
    	foreach($data as $mail)
    		array_push($returned, new MailClass($mail));
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @return number
     */
    public static function countUserGameMailUnread($game_id, $user_id){
    	return count(self::getUserGameMailUnReadToArray($game_id, $user_id));
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param number $limit
     * @return \app\models\Mail[]
     */
    public static function getUserGameMailUnRead($game_id, $user_id, $limit=99){
    	return self::find()->where(['mail_game_id' => $game_id])->andWhere(['mail_user_receive_id' => $user_id])->andWhere(['not in','mail_id', MailRead::getUserHasReadMailById($game_id, $user_id)])->andWhere(['mail_del' => 0])->orderBy(['mail_time' => SORT_DESC])->limit($limit)->all();
    }
    
    /**
     * 
     * @param unknown $user_id
     * @param number $limit
     * @return \app\models\Mail[]
     */
    public static function getUserNotGameMail($user_id, $limit=500){
    	return self::getUserGameMail(0, $user_id, $limit);
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $mail_id
     */
    public static function getMailData($game_id, $user_id, $mail_id){
    	return self::find()->where(['mail_game_id' => $game_id])->andWhere(['mail_id' => $mail_id])->andWhere(['mail_user_receive_id' => $user_id])->one();
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param number $limit
     * @return \app\models\Mail[]
     */
    public static function getUserGameMail($game_id, $user_id, $limit=500){
    	return self::find()->where(['mail_game_id' => $game_id])->andWhere(['mail_user_receive_id' => $user_id])->andWhere(['mail_del' => 0])->orderBy(['mail_time' => SORT_DESC])->limit($limit)->all();
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $mail_id
     * @return number
     */
    public static function setMailRead($game_id, $user_id, $mail_id){
    	return MailRead::insertMailReadLog($game_id, $user_id, $mail_id);
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $mail_message
     * @param unknown $mail_subject
     * @param unknown $mail_pact_id
     * @param unknown $mail_user_send_id
     * @param unknown $mail_user_receive_id
     * @return number
     */
  	public static function insertMail($game_id, $mail_message, $mail_subject, $mail_pact_id, $mail_user_send_id, $mail_user_receive_id){
  		return Yii::$app->db->createCommand()->insert(self::tableName(), [
            	'mail_game_id' 			=> $game_id,
            	'mail_time' 			=> time(),
            	'mail_message' 			=> $mail_message,
            	'mail_subject' 			=> $mail_subject,
            	'mail_pact_id' 			=> $mail_pact_id,
            	'mail_user_send_id' 	=> $mail_user_send_id,
            	'mail_user_receive_id' 	=> $mail_user_receive_id,
            	'mail_del' 				=> 0,
  		])->execute();
  	}
    
    /**
     * @inheritdoc
     * @return \app\queries\MailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\MailQuery(get_called_class());
    }
}
