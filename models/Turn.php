<?php

namespace app\models;

use Yii;
use app\classes\TurnClass;
use app\bot\Bot;

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
     * @return number[]
     */
    public static function getRankUserLongTurn($game_id){
    	$timeArray = self::getUserLongTurnTimeArray($game_id);
    	$rankArray = array();
    	foreach($timeArray as $user){
    		$turnTimeSum = 0;
    		foreach($user['turn'] as $turn)
    			$turnTimeSum += ($turn->getTurnTime() - $turn->getTurnTimeBegin()); 
    		if(isset($user['count']) && $user['count'] > 0)
    			$rankArray[$user['user_id']] = $turnTimeSum / $user['count'];
    		else
    			$rankArray[$user['user_id']] = 0;
    	}
    	arsort($rankArray);
    	return $rankArray; 
    }
    
    /**
     * 
     * @param unknown $game_id
     * @return number|NULL[]
     */
    public static function getUserLongTurnTimeArray($game_id){
    	$data = self::getAllGameTurnToArray($game_id);
    	$returned = array();
    	foreach($data as $turn){
    		if(isset($returned[$turn->getTurnUserId()])){
    			array_push($returned[$turn->getTurnUserId()]['turn'], $turn);
    			$returned[$turn->getTurnUserId()]['count']++;
    		}else{
    			$returned[$turn->getTurnUserId()]['turn'] = array();
    			array_push($returned[$turn->getTurnUserId()]['turn'], $turn);
    			$returned[$turn->getTurnUserId()]['count'] = 1;
    			$returned[$turn->getTurnUserId()]['user_id'] = $turn->getTurnUserId();
    		}
    	}
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @return \app\classes\TurnClass[]
     */
    public static function getAllGameTurnToArray($game_id){
    	$data = self::getAllGameTurn($game_id);
    	$returned = array();
    	foreach($data as $turn)
    		$returned[$turn['turn_id']] = new TurnClass($turn);
    	return $returned;
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
     * @return \app\models\Turn[]
     */
    public static function getAllGameTurn($game_id){
    	return self::find()->where(['turn_game_id' => $game_id])->all();
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     */
    public static function createGameFirstTurn($game_id, $user_id, $gameData, $difficultyData){
    	self::NewTurn($game_id, $user_id, $gameData, $difficultyData);
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     */
    public static function NewTurn($game_id, $user_id, $gameData, $difficultyData, $gameInfo=null)
    {
    	// Turn Data
    	$previousTurnData 				= self::getLastTurnByGameId($game_id);
    	if($gameInfo == null)$gameInfo 	= Game::getGameById($game_id);
    	
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
    	
    	// If bot bonus income
    	if($gamePlayerData[$next_user_id]->getGamePlayerBot() != 0)
    		$next_gold = round($next_gold * $difficultyData[$gameInfo->getDifficultyId()]->getDifficultyBotBonusIncome());
    		
    	if($previousTurnData->getTurnTime() == null)
    		$new_turn_begin = time();
    	else
    		$new_turn_begin = $previousTurnData->getTurnTime();
    	
    	// If end
    	if(GameData::checkGameEnd($user_id, $game_id, $gameData))
    		return Game::updateGameStatut($game_id, 100);
    	
    	// New turn	
    	if($previousTurnData->getTurnUserId() == $user_id || $previousUserTurnData->getTurnUserId() == null){
    		self::createNewTurn(array(
    				'user_id' 		=> $next_user_id,
    				'game_id' 		=> $game_id,
    				'gold' 			=> $next_gold,
    				'count_gold' 	=> $count_gold,
    				'turn_begin' 	=> $new_turn_begin,
    		));
    		
    		// If a user loose OR user quit the game
    		if($count_land == 0 OR $gamePlayerData[$next_user_id]->getGamePlayerQuit() > 0){
    			return self::NewTurn($game_id, $next_user_id, $gameData);
    		}
    		
    		// If bot
    		if($gamePlayerData[$next_user_id]->getGamePlayerBot() != 0){
    			$Bot = new Bot($game_id, $next_user_id);
    			return true;
    			//return $Bot->BotStartTurn($gameid, $next_user_id, $next_gold);
    		}
    	}
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
