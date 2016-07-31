<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "move".
 *
 * @property string $move_id
 * @property integer $move_game_id
 * @property integer $move_user_id
 * @property integer $move_time
 * @property integer $move_land_id_from
 * @property integer $move_land_id_arrive
 * @property integer $move_units
 */
class Move extends \yii\db\ActiveRecord
{
	
	private $land_id_from;
	private $user;
	private $game;
	private $gameData;
	private $turn;
	private $land_id_to;
	private $units;
	private $frontierData;
	private $futur_units_from;
	private $futur_units_to;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'move';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['move_game_id', 'move_user_id', 'move_time', 'move_land_id_from', 'move_land_id_arrive', 'move_units'], 'required'],
            [['move_game_id', 'move_user_id', 'move_time', 'move_land_id_from', 'move_land_id_arrive', 'move_units'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'move_id' => 'Move ID',
            'move_game_id' => 'Move Game ID',
            'move_user_id' => 'Move User ID',
            'move_time' => 'Move Time',
            'move_land_id_from' => 'Move Land Id From',
            'move_land_id_arrive' => 'Move Land Id Arrive',
            'move_units' => 'Move Units',
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
    public function MoveInit($land_id_from, $user, $game, $gameData, $turn, $land_id_to, $units, $frontierData){
    	// Data
    	$this->land_id_from = $land_id_from;
    	$this->user 		= $user;
    	$this->game 		= $game;
    	$this->gameData 	= $gameData;
    	$this->turn 		= $turn;
    	$this->land_id_to	= $land_id_to;
    	$this->units 		= $units;
    	$this->frontierData = $frontierData;
    	 
    	// Calc
    	$this->futur_units_from 	= $this->gameData[$this->land_id_from]->getGameDataUnits() - $this->units;
    	$this->futur_units_to 		= $this->gameData[$this->land_id_to]->getGameDataUnits() + $this->units;
    }
    
    /**
     *
     * @return string
     */
    public function MoveCheck(){
    	// Gold check
    	if($this->futur_units_from > 0){
    		// Turn check
    		if($this->turn->getTurnUserId() == $this->user->getUserID()){
    			// Land check
    			$conquestAll = Fight::ConquestThisTurnLandAll($this->game->getGameId(), $this->turn->getTurnUserId());
    			if($this->gameData[$this->land_id_from]->getGameDataUserId() == $this->user->getUserID()
    			   && $this->gameData[$this->land_id_to]->getGameDataUserId() == $this->user->getUserID()
    				&& $this->units > 0
    				 && isset($this->frontierData[$this->land_id_to])
    				  && !isset($conquestAll[$this->land_id_from])){
    				return true;
    			}else{
    				return "Error";
    			}
    		}else{
    			return "Error_Turn";
    		}
    	}else{
    		return "Error_Units";
    	}
    	 
    }
    
    /**
     *
     */
    public function MoveExec()
    {
    	GameData::updateUnitsGameData($this->game->getGameId(), $this->land_id_from, $this->futur_units_from);
    	
    	GameData::updateUnitsGameData($this->game->getGameId(), $this->land_id_to, $this->futur_units_to);
    	
    	self::insertUnitMovement($this->game->getGameId(), $this->user->getUserID(), $this->land_id_from, $this->land_id_to, $this->units);
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $land_id_from
     * @param unknown $land_id_to
     * @param unknown $units
     * @return number
     */
    public static function insertUnitMovement($game_id, $user_id, $land_id_from, $land_id_to, $units){
    	return Yii::$app->db->createCommand()->insert(self::tableName(), [
    			'move_game_id'       	=> $game_id,
    			'move_user_id'       	=> $user_id,
    			'move_time'  			=> time(),
    			'move_land_id_from'     => $land_id_from,
    			'move_land_id_arrive'   => $land_id_to,
    			'move_units'       		=> $units,
    	])->execute();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\MoveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\MoveQuery(get_called_class());
    }
}
