<?php

namespace app\models;

use Yii;
use app\queries\GamePlayerQuery;
use app\classes\UserClass;
use app\classes\GamePlayerClass;

/**
 * This is the model class for table "game_player".
 *
 * @property string $game_player_id
 * @property integer $game_player_region_id
 * @property integer $game_player_difficulty_id
 * @property integer $game_player_statut
 * @property integer $game_player_game_id
 * @property integer $game_player_user_id
 * @property integer $game_player_color_id
 * @property integer $game_player_enter_time
 * @property integer $game_player_order
 * @property integer $game_player_bot
 * @property integer $game_player_quit
 */
class GamePlayer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_player';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_player_region_id', 'game_player_game_id', 'game_player_user_id', 'game_player_color_id', 'game_player_enter_time', 'game_player_order', 'game_player_bot', 'game_player_quit'], 'required'],
            [['game_player_region_id', 'game_player_difficulty_id', 'game_player_statut', 'game_player_game_id', 'game_player_user_id', 'game_player_color_id', 'game_player_enter_time', 'game_player_order', 'game_player_bot', 'game_player_quit'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'game_player_id' => 'Game Player ID',
            'game_player_region_id' => 'Game Player Region ID',
            'game_player_difficulty_id' => 'Game Player Difficulty ID',
            'game_player_statut' => 'Game Player Statut',
            'game_player_game_id' => 'Game Player Game ID',
            'game_player_user_id' => 'Game Player User ID',
            'game_player_color_id' => 'Game Player Color ID',
            'game_player_enter_time' => 'Game Player Enter Time',
            'game_player_order' => 'Game Player Order',
            'game_player_bot' => 'Game Player Bot',
            'game_player_quit' => 'Game Player Quit',
        ];
    }


    /**
     *
     * @param unknown $gamePlayerData
     * @return boolean
     */
    public static function checkPlayerColor($gamePlayerData){
    	$colorArray = null;
    	foreach ($gamePlayerData as $key => $player){
    		if(isset($colorArray[$player['game_player_color_id']]))
    			return false;
    		else
    			$colorArray[$player['game_player_color_id']] = true;
    	 }
    	 return true;
    }

    /**
     *
     * @param unknown $gamePlayerData
     * @return boolean
     */
    public static function checkPlayerReady($gamePlayerData){
    	foreach ($gamePlayerData as $key => $player){
    		if($player['game_player_statut'] == 0)
    			return false;
    	}
    	return true;
    }


	/**
	 *
	 * @return \app\classes\gamePlayerClass
	 */
    public static function findPlayerZero(){
    	return new GamePlayerClass(
    			array(
    			'game_player_id' => 0,
    			'game_player_region_id' => 0,
    			'game_player_difficulty_id' => 0,
    			'game_player_statut' => 1,
    			'game_player_game_id' => 0,
    			'game_player_user_id' => 0,
    			'game_player_color_id' => 1,
    			'game_player_enter_time' => 0,
    			'game_player_order' => 0,
    			'game_player_bot' => 0,
    			'game_player_quit' => 0,)
    			);
    }

    /**
     *
     * @return \app\classes\gamePlayerClass
     */
    public static function findPlayerUnknown(){
    	return self::findPlayerZero();
    }

   /**
    *
    * @return \app\classes\UserClass
    */
    public static function findUserZero(){
    	return new UserClass(
    			array(
    					'user_id' => 0,
    					'user_name' => Yii::t('game_player', 'Neutral_User_Name'),
    					'user_pwd' => "",
    					'user_mail' => "",
    					'user_type' => 0,
    					'user_key' => "",
    			)
    			);
    }

    /**
     *
     * @return \app\classes\UserClass
     */
    public static function findUserUnknown(){
    	return new UserClass(
    			array(
    					'user_id' => 0,
    					'user_name' => Yii::t('game_player', 'Unknown_User_Name'),
    					'user_pwd' => "",
    					'user_mail' => "",
    					'user_type' => 0,
    					'user_key' => "",
    			)
    			);
    }

    /**
     *
     * @param unknown $gamePlayerData
     * @return boolean
     */
    public static function sortByOrder($gamePlayerData){
    	$ordered = array();
		foreach ($gamePlayerData as $key => $data)
		{
   			$ordered[$key] = $data->getGamePlayerOrder();
		}
		array_multisort($ordered, SORT_ASC, $gamePlayerData);
		return $gamePlayerData;
    }

    /**
     *
     * @param unknown $gameId
     * @return \app\classes\GameClass
     */
    public static function userJoinGame($game, $user_id, $userReq=false){
    	// set Session Var
    	Yii::$app->session->set("Game", $game);

    	// Insert in BD
    	if(!$userReq)
    		self::userInsertJoinGame($game->getGameId(), $user_id);
    }

    /**
     *
     * @param unknown $game_id
     */
    public static function setUserTurnOrderToArray($game_id){
    	$users = self::findAllGamePlayerToListUserId(null, $game_id);
    	$returned = array();
    	foreach ($users as $user){
    		do{
    			$rand = rand(1, count($users));
    		}while(array_key_exists($rand, $returned));
    		$returned[$rand] = $user;
    	}
    	return $returned;
    }

    /**
     *
     * @param unknown $game
     * @return number
     */
    public static function gameCountPlayer($game_Id){
    	return self::find()->where(['game_player_game_id' => $game_Id])->andWhere(['game_player_quit' => 0])->count();
    }

    /**
     *
     * @param unknown $color_id
     * @return \app\classes\ColorClass
     */
    public static function findGamePlayerById($player_id){
    	return new GamePlayerClass(self::find()->where(['color_id' => $color_id])->one());
    }

    /**
     *
     * @param unknown $colorData
     * @return NULL|\app\classes\ColorClass
     */
    public static function findAllGamePlayerToListUserId($gamePlayerData, $game_id=null){
    	if($gamePlayerData == null && $game_id != null)
    		$gamePlayerData = self::findAllGamePlayer($game_id);
    	$array = null;
    	$i = 0;
    	foreach ($gamePlayerData as $key => $gamePlayer){
    		$array[$i] = $gamePlayer['game_player_user_id'];
    		$i++;
    	}
    	$users = null;
    	if($array != null)
	    	foreach ((new Users)->getListUserByListUserId($array) as $key => $user){
	    		$users[$user['user_id']] = new UserClass($user);
	    	}
    	return $users;
    }

    /**
     *
     * @param unknown $user_id
     * @return \app\queries\GamePlayer|NULL
     */
    public static function findUserGameId($user_id){
    	return self::find()->where(['game_player_user_id' => $user_id])->andWhere(['game_player_quit' => 0])->one();
    }

    /**
     *
     * @param unknown $user_id
     * @return \app\queries\GamePlayer[]
     */
    public static function findAllUserGameId($user_id){
    	return self::find()->where(['game_player_user_id' => $user_id])->andWhere(['game_player_quit' => 0])->all();
    }

    /**
     *
     * @param unknown $user_id
     * @param unknown $game_id
     * @return \app\queries\GamePlayer|NULL
     */
    public static function findUserGameIdIfExited($user_id, $game_id){
    	return self::find()->where(['game_player_user_id' => $user_id])->andWhere(['game_player_game_id' => $game_id])->one();
    }

    /**
     *
     * @param unknown $game_id
     * @return \app\queries\GamePlayer[]
     */
    public static function findAllGamePlayer($game_id){
    	return self::find()->where(['game_player_game_id' => $game_id])->all();
    }

    /**
     *
     * @param unknown $game_id
     * @return \app\queries\GamePlayer[]
     */
    public static function findAllGamePlayerToArray($game_id){
    	$returned = array();
    	foreach (self::findAllGamePlayer($game_id) as $gamePlayer)
    		$returned[$gamePlayer['game_player_user_id']] = new GamePlayerClass($gamePlayer);
    	return $returned;
    }

    /**
     *
     * @param unknown $game_id
     * @return \app\queries\GamePlayer[]
     */
    public static function findAllGamePlayerToArrayWithData($game_data){
    	$returned = array();
    	foreach ($game_data as $gamePlayer)
    		$returned[$gamePlayer['game_player_user_id']] = new gamePlayerClass($gamePlayer);
    		return $returned;
    }

    /**
     * update gameplayer information
     *
     * @param  integer      $user_id
     * @return static|null
     */
    public static function updateGamePlayerById($user_id, $game_id, $region_id, $color_id, $statut)
    {
    	if(isset($user_id) && isset($game_id)){
    		$key 	= null;
    		$value 	= null;
    		if(isset($color_id)){
				$key = 'game_player_color_id';
    			$value = $color_id;
    			if($value < 2 OR $value > 10) $value = 1;
    		}elseif(isset($region_id)){
    			$key = 'game_player_region_id';
    			$value = $region_id;
    			if($value > 6 OR $value < 1) $value = 6;
    		}elseif(isset($statut)){
    			$key = 'game_player_statut';
    			$value = $statut;
    			if($value > 1 OR $value < 0) $value = 0;
    		}
    		if(isset($key) && isset($value))
    			Yii::$app->db->createCommand()->update(self::tableName(), [$key => $value], ['game_player_user_id' => $user_id, 'game_player_game_id' => $game_id])->execute();
    	}
    	return null;
    }

    /**
     *
     * @param unknown $user_id
     * @param unknown $game_id
     * @return number
     */
    public static function updateEnterInGame($user_id, $game_id){
    	return Yii::$app->db->createCommand()->update(self::tableName(), ['game_player_quit' => 0], ['game_player_user_id' => $user_id, 'game_player_game_id' => $game_id])->execute();
    }

    /**
    *
    * @param unknown $game_id
    * @return boolean
    */
    public static function updateUserTurnOrder($game_id){
    	$updated = self::setUserTurnOrderToArray($game_id);
    	foreach ($updated as $key => $user) {
    		Yii::$app->db->createCommand()->update(self::tableName(), ['game_player_order' => $key], ['game_player_game_id' => $game_id, 'game_player_user_id' => $user->getUserID()])->execute();
    	}
    	return $updated;
    }

    /**
     *
     */
    public static function gameExitPlayer($user_id, $game_id){
    	Yii::$app->db->createCommand()->update(self::tableName(), [
    			'game_player_quit'		=> 1,
    	],[
    			'game_player_user_id'   => $user_id,
    			'game_player_game_id'   => $game_id,
    	])
    	->execute();
    }

    /**
     *
     * @param unknown $gameId
     * @return \app\classes\GameClass
     */
    public static function userInsertJoinGame($game_id, $user_id){
    	Yii::$app->db->createCommand()->insert(self::tableName(),[
    			'game_player_region_id' => 1,
    			'game_player_difficulty_id' => 1,
    			'game_player_statut' => 0,
    			'game_player_game_id' => $game_id,
    			'game_player_user_id' => $user_id,
    			'game_player_color_id' => 2,
    			'game_player_enter_time' => time(),
    			'game_player_order'	=> 0,
    			'game_player_bot' => 0,
    			'game_player_quit' => 0,
    	])->execute();
    }

    /**
     * @inheritdoc
     * @return GamePlayerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GamePlayerQuery(get_called_class());
    }
}
