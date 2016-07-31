<?php

namespace app\models;

use Yii;
use app\classes\FightClass;

/**
 * This is the model class for table "fight".
 *
 * @property string $fight_id
 * @property integer $fight_game_id
 * @property integer $fight_atk_user_id
 * @property integer $fight_def_user_id
 * @property integer $fight_atk_land_id
 * @property integer $fight_def_land_id
 * @property integer $fight_atk_lost_unit
 * @property integer $fight_def_lost_unit
 * @property string $fight_atk_units
 * @property string $fight_def_units
 * @property integer $fight_atk_nb_units
 * @property integer $fight_def_nb_units
 * @property string $fight_thimble_atk
 * @property string $fight_thimble_def
 * @property integer $fight_time
 * @property integer $fight_turn_id
 * @property integer $fight_conquest
 */
class Fight extends \yii\db\ActiveRecord
{
	
	private $land_id_atk;
	private $user;
	private $game;
	private $gameData;
	private $turn;
	private $units_atk;
	private $land_id_def;
	private $futur_units_atk;
    private	$futur_units_def;
    private $frontierData;
    
    public static $FortBonusUnits = 1;
    public static $CampBonusUnits = 1;
	public static $DefenderMaxUnits = 2;
	public static $AttakerMaxUnits = 3;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fight';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fight_game_id', 'fight_atk_user_id', 'fight_def_user_id', 'fight_atk_land_id', 'fight_def_land_id', 'fight_atk_lost_unit', 'fight_def_lost_unit', 'fight_atk_units', 'fight_def_units', 'fight_atk_nb_units', 'fight_def_nb_units', 'fight_thimble_atk', 'fight_thimble_def', 'fight_time', 'fight_turn_id', 'fight_conquest'], 'required'],
            [['fight_game_id', 'fight_atk_user_id', 'fight_def_user_id', 'fight_atk_land_id', 'fight_def_land_id', 'fight_atk_lost_unit', 'fight_def_lost_unit', 'fight_atk_nb_units', 'fight_def_nb_units', 'fight_time', 'fight_turn_id', 'fight_conquest'], 'integer'],
            [['fight_atk_units', 'fight_def_units', 'fight_thimble_atk', 'fight_thimble_def'], 'string', 'max' => 2048]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fight_id' => 'Fight ID',
            'fight_game_id' => 'Fight Game ID',
            'fight_atk_user_id' => 'Fight Atk User ID',
            'fight_def_user_id' => 'Fight Def User ID',
            'fight_atk_land_id' => 'Fight Atk Land ID',
            'fight_def_land_id' => 'Fight Def Land ID',
            'fight_atk_lost_unit' => 'Fight Atk Lost Unit',
            'fight_def_lost_unit' => 'Fight Def Lost Unit',
            'fight_atk_units' => 'Fight Atk Units',
            'fight_def_units' => 'Fight Def Units',
            'fight_atk_nb_units' => 'Fight Atk Nb Units',
            'fight_def_nb_units' => 'Fight Def Nb Units',
            'fight_thimble_atk' => 'Fight Thimble Atk',
            'fight_thimble_def' => 'Fight Thimble Def',
            'fight_time' => 'Fight Time',
            'fight_turn_id' => 'Fight Turn ID',
            'fight_conquest' => 'Fight Conquest',
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
    public function FightInit($land_id, $user, $game, $gameData, $turn, $land_id_atk, $units_atk, $frontierData){
    	// Data
    	$this->land_id_atk 	= $land_id_atk;
    	$this->land_id_def 	= $land_id;
    	$this->user 		= $user;
    	$this->game 		= $game;
    	$this->gameData 	= $gameData;
    	$this->frontierData = $frontierData;
    	$this->turn 		= $turn;
    	$this->units_atk 	= $units_atk;
    	
    	// Calc
    	$this->futur_units_atk 	= 0;
    	$this->futur_units_def 	= 0;
    }
    
    /**
     *
     * @return string
     */
    public function FightCheck(){
    	// Conquest check
    	if(!self::ConquestThisTurnLand($this->game->getGameId(), $this->turn->getTurnId(), $this->land_id_atk)){
	    	// Turn check
	    	if($this->turn->getTurnUserId() == $this->user->getUserID()){
	    		// Land check
	    		if($this->gameData[$this->land_id_atk]->getGameDataUserId() == $this->user->getUserID()
	    			&& $this->gameData[$this->land_id_def]->getGameDataUserId() != $this->user->getUserID()
	    			&& isset($this->frontierData[$this->land_id_def])
	    			&& $this->units_atk > 0){
	    				return true;
	    		}else{
	    			return "Error";
	    		}
	    	}else{
	    		return "Error_Turn";
	    	}
	    }else{
	    	return "Error_Conquest";
	    }
    }
    
    /**
     *
     */
    public function FightExec()
    {
    	$fight = new FightClass($this->land_id_atk, $this->land_id_def, $this->units_atk, $this->gameData);
    	$fight->FightStart();
    	$data = $fight->FightResult();
    	
    	// Calc
    	if($data['conquest'] == 1){
    		$atk_final_units 		= $this->gameData[$data['atk_land_id']]->getGameDataUnits() - $data['atk_engage_units'];
    		$def_final_units 		= $data['atk_result_units'];
    		$def_land_final_user_id	= $this->gameData[$data['atk_land_id']]->getGameDataUserId();
    	}else{
    		$atk_final_units 		= $this->gameData[$data['atk_land_id']]->getGameDataUnits() - $data['atk_engage_units'];
    		$def_final_units 		= $this->gameData[$data['def_land_id']]->getGameDataUnits() - ($data['def_engage_units'] - $data['def_result_units']);
    		$def_land_final_user_id	= $this->gameData[$data['def_land_id']]->getGameDataUserId();
    	}
    	
    	// Update
    	GameData::updateUnitsGameData($this->game->getGameId(), $data['atk_land_id'], $atk_final_units);
    
    	GameData::updateUnitsGameData($this->game->getGameId(), $data['def_land_id'], $def_final_units);
    
    	GameData::updateUserIdGameData($this->game->getGameId(), $data['def_land_id'], $def_land_final_user_id);
    	
    	// insert fight data
		self::insertFightLog(
				$this->game->getGameId(),
				$this->gameData[$data['atk_land_id']]->getGameDataUserId(),
				$this->gameData[$data['def_land_id']]->getGameDataUserId(),
				$data['atk_land_id'],
				$data['def_land_id'],
				($data['atk_engage_units'] - $data['atk_result_units']),
				($this->gameData[$data['def_land_id']]->getGameDataUnits() - $data['def_result_units']),
				$data['atk_units'],
				$data['def_units'],
				$data['atk_engage_units'],
				$data['def_engage_units'],
				$data['thimble_atk'],
				$data['thimble_def'],
				$this->turn->getTurnId(),
				$data['conquest']
		);
		
		return $data;
    }
    
    /**
     * 
     * @param unknown $gameid
     * @param unknown $turnid
     * @param unknown $landid
     * @return number
     */
    public static function ConquestThisTurnLand($game_id, $turn_id, $land_id){
    	foreach (self::fightLandDatathisTurn($game_id, $turn_id, $land_id) as $data) {
    		if(isset($data['fight_def_land_id']) AND $data['fight_def_land_id'] == $land_id && $data['fight_conquest'] == 1){
    			return true;
    		}
    	}
    	return false;
    }
    
    /**
     *
     * @param unknown $gameid
     * @param unknown $turnid
     * @param unknown $landid
     * @return number
     */
    public static function ConquestThisTurnLandAll($game_id, $turn_id){
    	$returned = array();
    	foreach (self::fightLandDatathisTurnAll($game_id, $turn_id) as $data) {
    		if($data['fight_conquest'] == 1){
    			$returned[$data['fight_def_land_id']] = true;
    		}
    	}
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $turn_id
     * @param unknown $land_id
     * @return \app\models\Fight[]
     */
    public static function fightLandDatathisTurn($game_id, $turn_id, $land_id){
    	return $fightLandDataThisTurn = self::find()
    		->where(['fight_game_id' => $game_id])
    		->andWhere(['fight_turn_id' => $turn_id])
    		->andWhere(['fight_def_land_id' => $land_id])->all();
    }
    
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $turn_id
     * @return \app\models\Fight[]
     */
    public static function fightLandDatathisTurnAll($game_id, $turn_id){
    	return $fightLandDataThisTurn = self::find()
    	->where(['fight_game_id' => $game_id])
    	->andWhere(['fight_turn_id' => $turn_id])
		->all();
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $atk_user_id
     * @param unknown $def_user_id
     * @param unknown $atk_land_id
     * @param unknown $def_land_id
     * @param unknown $atk_lost_unit
     * @param unknown $def_lost_unit
     * @param unknown $atk_units
     * @param unknown $def_units
     * @param unknown $atk_nb_units
     * @param unknown $def_nb_units
     * @param unknown $thimble_atk
     * @param unknown $thimble_def
     * @param unknown $turn_id
     * @param unknown $conquest
     * @return number
     */
    public static function insertFightLog($game_id, $atk_user_id, $def_user_id, $atk_land_id, $def_land_id, $atk_lost_unit, $def_lost_unit, $atk_units, $def_units, $atk_nb_units, $def_nb_units, $thimble_atk, $thimble_def, $turn_id, $conquest){
    	return Yii::$app->db->createCommand()->insert(self::tableName(), [
    			'fight_game_id'			=> $game_id,
    			'fight_atk_user_id'		=> $atk_user_id,
    			'fight_def_user_id'		=> $def_user_id,
    			'fight_atk_land_id'		=> $atk_land_id,
    			'fight_def_land_id'		=> $def_land_id,
    			'fight_atk_lost_unit'	=> $atk_lost_unit,
    			'fight_def_lost_unit'	=> $def_lost_unit,
    			'fight_atk_units'		=> $atk_units,
    			'fight_def_units'		=> $def_units,
    			'fight_atk_nb_units'	=> $atk_nb_units,
    			'fight_def_nb_units'	=> $def_nb_units,
    			'fight_thimble_atk'		=> $thimble_atk,
    			'fight_thimble_def'		=> $thimble_def,
    			'fight_time'			=> time(),
    			'fight_turn_id'			=> $turn_id,
    			'fight_conquest'		=> $conquest,
    	])->execute();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\FightQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\FightQuery(get_called_class());
    }
}
