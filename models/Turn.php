<?php

namespace app\models;

use Yii;
use app\classes\TurnClass;

/**
 * This is the model class for table "turn".
 *
 * @property string $turn_id
 * @property integer $turn_game_id
 * @property integer $turn_user_id
 * @property integer $turn_time
 * @property integer $turn_time_begin
 * @property integer $turn_gold
 * @property integer $turn_gold_base
 * @property integer $turn_income
 */
class Turn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'turn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['turn_game_id', 'turn_user_id', 'turn_time', 'turn_time_begin', 'turn_gold', 'turn_gold_base', 'turn_income'], 'required'],
            [['turn_game_id', 'turn_user_id', 'turn_time', 'turn_time_begin', 'turn_gold', 'turn_gold_base', 'turn_income'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'turn_id' => 'Turn ID',
            'turn_game_id' => 'Turn Game ID',
            'turn_user_id' => 'Turn User ID',
            'turn_time' => 'Turn Time',
            'turn_time_begin' => 'Turn Time Begin',
            'turn_gold' => 'Turn Gold',
            'turn_gold_base' => 'Turn Gold Base',
            'turn_income' => 'Turn Income',
        ];
    }

    /**
     * 
     * @param unknown $game_id
     * @return \app\classes\TurnClass
     */
    public static function getLastTurnByGameId($game_id){
    	return new TurnClass(self::find()->where(['turn_game_id' => $game_id])->orderBy(['turn_id' => SORT_DESC])->one());
    }
    
    /**
     * 
     * @param unknown $user_id
     * @param unknown $game_id
     * @return \app\classes\TurnClass
     */
    public static function getLastTurnByUserId($user_id, $game_id){
    	return new TurnClass(self::find()->where(['turn_game_id' => $game_id])->andWhere(['turn_user_id' => $user_id])->orderBy(['turn_id' => SORT_DESC])->one());
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     */
    public static function createGameFirstTurn($game_id, $user_id, $gameData){
    	self::NewTurn($game_id, $user_id, $gameData);
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     */
    public static function NewTurn($game_id, $user_id, $gameData)
    {
    	// Turn Data
    	$previousTurnData 			= self::getLastTurnByGameId($game_id);
    	
    	
    	
    	// Game Player
    	$game_player 				= new GamePlayer();
    	$gamePlayerData 			= $game_player->findAllGamePlayerToArray($game_id);
    	$gamePlayerDataSortByOrder	= $game_player->sortByOrder($gamePlayerData);
    
    	// If no turn previous
    	if($previousTurnData->getTurnUserId() == null)
    		$current_user_order = 0;
    	else
    		$current_user_order = $gamePlayerData[$previousTurnData->getTurnUserId()]->getGamePlayerOrder();
    	
    	
    	// If next player id exists
    	if(isset($gamePlayerDataSortByOrder[$current_user_order]) && $gamePlayerDataSortByOrder[$current_user_order]->getGamePlayerUserId() != null)
    		$next_order   = $current_user_order;
    	else
    		$next_order   = 0;
    
    	// Previous user turn data
    	$next_user_id 			= $gamePlayerDataSortByOrder[$next_order]->getGamePlayerUserId();
    	$previousUserTurnData	= self::getLastTurnByUserId($next_user_id, $game_id);
    		
    	// Count Next Gold
    	$count_land = GameData::CountLandByUserId($gameData, $game_id, $next_user_id);
    	$count_gold = GameData::GoldGameDataUser($gameData, $game_id, $next_user_id, $count_land);
    	$next_gold 	= $previousUserTurnData->getTurnGold() + $count_gold;
    
    	$previous_turn_begin        = $previousUserTurnData->getTurnTimeBegin();
    	$previous_turn_game_time    = $previousUserTurnData->getTurnTime();
    	if($previous_turn_game_time != null)
    		$turn_time              = 0;
    	else
    		$turn_time              = time() - $previous_turn_game_time;
    	
    	$new_turn_begin             = $previous_turn_begin + $turn_time;
    	
    	// TO CHECK
    	if($previousTurnData->getTurnUserId() == $user_id || $previousUserTurnData->getTurnUserId() == null){
    		self::createNewTurn(array(
    				'user_id' 		=> $next_user_id,
    				'game_id' 		=> $game_id,
    				'gold' 			=> $next_gold,
    				'count_gold' 	=> $count_gold,
    				'turn_begin' 	=> $new_turn_begin,
    		));
    	}
    
    	// If end
    	//Game::GameEnd($gameid);
    
    	// If a user loose OR user quit the game
    	if($count_land == 0 OR $gamePlayerData[$next_user_id]->getGamePlayerQuit() > 0){
    		return self::NewTurn($game_id, $next_user_id, $gameData);
    	}
    
    	// If bot user
    	/*if($allgameplayerorder[$next_order]['bot'] > 0 AND $next_user_info['type'] == 2){
    		$Bot = new Bot();
    		return $Bot->BotStartTurn($gameid, $next_user_id, $next_gold);
    	}*/
    
    }
    
    /**
     * 
     * @param unknown $newTurn
     */
    public static function createNewTurn($newTurn){
    	Yii::$app->db->createCommand()->insert(self::tableName(), [
    			'turn_user_id'           => $newTurn['user_id'],
    			'turn_game_id'           => $newTurn['game_id'],
    			'turn_time'              => time(),
    			'turn_gold'              => $newTurn['gold'],
    			'turn_gold_base'         => $newTurn['gold'],
    			'turn_income'            => $newTurn['count_gold'],
    			'turn_time_begin'        => $newTurn['turn_begin'],
    	])->execute();
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $turn_id
     * @param unknown $gold
     * @return number
     */
    public static function updateGoldTurn($game_id, $turn_id, $gold){
    	return Yii::$app->db->createCommand()->update(self::tableName(), [
    			'turn_gold'              => $gold,
    	],[
    			'turn_game_id'           => $game_id,
    			'turn_id'                => $turn_id,
    	])
    	->execute();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\TurnQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\TurnQuery(get_called_class());
    }
}
