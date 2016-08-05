<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat_read".
 *
 * @property string $chat_read_id
 * @property integer $chat_read_game_id
 * @property integer $chat_read_user_id
 * @property integer $chat_read_time
 */
class ChatRead extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat_read';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chat_read_game_id', 'chat_read_user_id', 'chat_read_time'], 'required'],
            [['chat_read_game_id', 'chat_read_user_id', 'chat_read_time'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'chat_read_id' => 'Chat Read ID',
            'chat_read_game_id' => 'Chat Read Game ID',
            'chat_read_user_id' => 'Chat Read User ID',
            'chat_read_time' => 'Chat Read Time',
        ];
    }

    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     */
    public static function getUserLastChatReadTimeInGame($game_id, $user_id){
    	$result = self::find()->where(['chat_read_game_id' => $game_id])->andWhere(['chat_read_user_id' => $user_id])->orderBy(['chat_read_time' => SORT_DESC])->one();
    	if($result['chat_read_time'] != null)
    		return $result['chat_read_time'];
    	else
    		return 0;
    }
    
    
    /**
     * 
     * @param unknown $user_id
     */
    public static function getUserLastChatReadTimeGlobal($user_id){
    	$result =  self::find()->where(['chat_read_user_id' => $user_id])->orderBy(['chat_read_time' => SORT_DESC])->one();
    	if($result['chat_read_time'] != null)
    		return $result['chat_read_time'];
    	else
    		return 0;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @return number
     */
    public static function insertChatReadLog($game_id, $user_id){
    	if(Chat::countUserUnReadChat($game_id, $user_id) > 0)
	    	return Yii::$app->db->createCommand()->insert(self::tableName(), [
	    			'chat_read_game_id'   	=> $game_id,
	    			'chat_read_user_id'   	=> $user_id,
	    			'chat_read_time'  		=> time(),
	    	])->execute();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\ChatReadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\ChatReadQuery(get_called_class());
    }
}
