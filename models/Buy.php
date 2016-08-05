<?php

namespace app\models;

use Yii;
use app\classes\BuyClass;

/**
 * This is the model class for table "buy".
 *
 * @property string $buy_id
 * @property integer $buy_user_id
 * @property integer $buy_turn_id
 * @property integer $buy_game_id
 * @property integer $buy_land_id
 * @property integer $buy_units_nb
 * @property integer $buy_build_id
 * @property integer $buy_time
 */
class Buy extends \yii\db\ActiveRecord
{
	
	private  $land_id;
	private  $user;
	private  $game;
	private  $gameData;
	private  $turn;
	private  $units;
	private  $futur_units;
	private  $futur_gold;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buy_user_id', 'buy_turn_id', 'buy_game_id', 'buy_units_nb', 'buy_build_id', 'buy_time', 'buy_land_id'], 'required'],
            [['buy_user_id', 'buy_turn_id', 'buy_game_id', 'buy_units_nb', 'buy_build_id', 'buy_time', 'buy_land_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'buy_id' => 'Buy ID',
            'buy_user_id' => 'Buy User ID',
            'buy_turn_id' => 'Buy Turn ID',
            'buy_game_id' => 'Buy Game ID',
            'buy_units_nb' => 'Buy Units Nb',
            'buy_build_id' => 'Buy Build ID',
        	'buy_time'	=> 'Buy Time',
        	'buy_land_id' => 'Buy Land Id',
        ];
    }

    /**
     * 
     * @param unknown $land_id
     * @param unknown $user
     * @param unknown $game
     * @param unknown $gameData
     * @param unknown $turn
     * @param unknown $units
     */
    public function BuyInit($land_id, $user, $game, $gameData, $turn, $units){
    	// Data
    	$this->land_id 	= $land_id;
    	$this->user 	= $user;
    	$this->game 	= $game;
    	$this->gameData = $gameData;
    	$this->turn 	= $turn;
    	$this->units 	= $units;
    	
    	// Calc
    	$this->futur_units 	= $this->units + $this->gameData[$this->land_id]->getGameDataUnits();
    	$this->futur_gold 	= $this->turn->getTurnGold() - $this->units;
    }
    
    /**
     * 
     * @return string
     */
    public function BuyCheck(){
    	// Gold check
    	if($this->futur_gold >= 0){
    		// Turn check
    		if($this->turn->getTurnUserId() == $this->user->getUserID()){
    			// Land check
    			if($this->gameData[$this->land_id]->getGameDataUserId() == $this->user->getUserID()){
    					return true;
    			}else{
    				return "Error";
    			}
    		}else{
    			return "Error_Turn";
    		}
    	}else{
    		return "Error_Gold";
    	}
    	
    }
    
    /**
     * 
     */
    public function BuyExec()
    {
    	GameData::updateUnitsGameData($this->game->getGameId(), $this->land_id, $this->futur_units);
    
    	Turn::updateGoldTurn($this->game->getGameId(), $this->turn->getTurnId(), $this->futur_gold);
    
    	self::insertBuyLog($this->user->getUserID(), $this->turn->getTurnId(), $this->game->getGameId(), $this->land_id, $this->units, 0);
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param number $count
     */
    public static function userLastBuy($game_id, $user_id, $count=4){
    	$returned = array();
    	foreach (self::userLastBuyAll($game_id, $user_id, $count) as $buy){
    		array_push($returned, new BuyClass($buy));
    	}
    	return $returned;
    }
    
  	/**
  	 * 
  	 * @param unknown $game_id
  	 * @param unknown $user_id
  	 * @return \app\models\Buy[]
  	 */
    //->limit($count)
    public static function userLastBuyAll($game_id, $user_id, $limit=4){
    	return self::find()->where(['buy_game_id' => $game_id])->andWhere(['buy_user_id' => $user_id])->orderBy(['buy_time' => SORT_DESC])->limit($limit)->all();
    }
    
    /**
     * 
     * @param unknown $user_id
     * @param unknown $turn_id
     * @param unknown $game_id
     * @param unknown $land_id
     * @param unknown $units
     * @param unknown $building_id
     * @return number
     */
    public static function insertBuyLog($user_id, $turn_id, $game_id, $land_id, $units, $building_id){
    	return Yii::$app->db->createCommand()->insert(self::tableName(), [
    			'buy_user_id'   => $user_id,
    			'buy_turn_id'   => $turn_id,
    			'buy_game_id'   => $game_id,
    			'buy_land_id'   => $land_id,
    			'buy_units_nb' 	=> $units,
    			'buy_build_id'  => $building_id,
    			'buy_time'  	=> time(),
    	])->execute();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\BuyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\BuyQuery(get_called_class());
    }
}
