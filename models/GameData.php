<?php

namespace app\models;

use Yii;
use app\queries\GameDataQuery;
use app\classes\GameDataClass;

/**
 * This is the model class for table "game_data".
 *
 * @property string $game_data_id
 * @property integer $game_data_game_id
 * @property integer $game_data_user_id
 * @property integer $game_data_user_id_base
 * @property integer $game_data_land_id
 * @property integer $game_data_units
 * @property integer $game_data_capital
 * @property integer $game_data_resource_id
 * @property string $game_data_buildings
 */
class GameData extends \yii\db\ActiveRecord
{
	
	public static $gold_base = 0;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_data_game_id', 'game_data_user_id', 'game_data_user_id_base', 'game_data_land_id', 'game_data_units', 'game_data_capital', 'game_data_resource_id', 'game_data_buildings'], 'required'],
            [['game_data_game_id', 'game_data_user_id', 'game_data_user_id_base', 'game_data_land_id', 'game_data_units', 'game_data_capital', 'game_data_resource_id'], 'integer'],
            [['game_data_buildings'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'game_data_id' => 'Game Data ID',
            'game_data_game_id' => 'Game Data Game ID',
            'game_data_user_id' => 'Game Data User ID',
            'game_data_user_id_base' => 'Game Data User Id Base',
            'game_data_land_id' => 'Game Data Land ID',
            'game_data_units' => 'Game Data Units',
            'game_data_capital' => 'Game Data Capital',
            'game_data_resource_id' => 'Game Data resource ID',
            'game_data_buildings' => 'Game Data Buildings',
        ];
    }

    /**
     *
     * @param unknown $gameId
     * @return \app\classes\GameClass
     */
    public static function getGameDataById($game_Id){
    	return self::find()->where(['game_data_game_id' => $game_Id])->all();
    }
    
    /**
     *
     * @param unknown $gameId
     * @return \app\classes\GameClass
     */
    public static function getGameDataByIdToArray($game_Id){
    	$returned = array();
    	foreach (self::getGameDataById($game_Id) as $data)
    		$returned[$data['game_data_land_id']] = new GameDataClass($data);
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $gameData
     * @param unknown $game_id
     * @param unknown $user_id
     * @return number
     */
    public static function CountLandByUserId($gameData, $game_id, $user_id)
    {
    	if($gameData == null)
    		$gameData = self::getGameDataByIdToArray($game_id);
    	
    	$n = 0;
    	foreach ($gameData as $data)
    		if($data->getGameDataUserId() == $user_id)
    			$n++;
    		
    	return $n;
    }
    
    /**
     * Finds game information
     *
     * @param  string      $gameid & $userid
     * @return static|null
     */
    public static function GoldGameDataUser($gameData, $game_id, $user_id, $count_land=null, $income_by_buildings=null)
    {
    	if($count_land == null)
    		$count_land = self::CountLandByUserId($gameData, $game_id, $user_id);
    	
    	if($income_by_buildings === null)
    		$income_by_buildings = Building::getUserIncomeByBuildings($gameData, $user_id);
    
    	return $count_land + $income_by_buildings + self::$gold_base;
    
    }
    
    /**
     * 
     * @param unknown $assignedLands
     * @param unknown $assignedResources
     * @param unknown $landData
     * @param unknown $gameData
     * @return boolean
     */
    public static function createGameData($assignedLands, $assignedResources, $landData, $gameData){
    	$default_units_user_add = 1;
    	$returned = array();
    	foreach($landData as $land){
    		$returned[$land->getLandId()] = array(
    				'game_data_game_id'       => $gameData->getGameId(),
    				'game_data_user_id'       => (array_key_exists($land->getLandId(), $assignedLands) ? $assignedLands[$land->getLandId()]['game_player_user_id'] : 0),
    				'game_data_user_id_base'  => (array_key_exists($land->getLandId(), $assignedLands) ? $assignedLands[$land->getLandId()]['game_player_user_id'] : 0),
    				'game_data_land_id'       => $land->getLandId(),
    				'game_data_units'         => (array_key_exists($land->getLandId(), $assignedLands) ? ($land->getLandBaseUnits() + $default_units_user_add) : $land->getLandBaseUnits()),
    				'game_data_capital'       => (array_key_exists($land->getLandId(), $assignedLands) ? $assignedLands[$land->getLandId()]['game_player_user_id'] : 0),
    				'game_data_resource_id'   => $assignedResources[$land->getLandId()],
    				'game_data_buildings'     => (array_key_exists($land->getLandId(), $assignedLands) ? "6;1;" : ""),
    		);
    		Yii::$app->db->createCommand()->insert(self::tableName(), $returned[$land->getLandId()])->execute();
    		$returned[$land->getLandId()]['game_data_id'] = 0;
    		$returned[$land->getLandId()] = new GameDataClass($returned[$land->getLandId()]);
    	}
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $land_id
     * @param unknown $units
     * @return number
     */
    public static function updateUnitsGameData($game_id, $land_id, $units){
    	return Yii::$app->db->createCommand()->update(self::tableName(), [
    			'game_data_units'           => $units,
    	],[
    			'game_data_game_id'         => $game_id,
    			'game_data_land_id'         => $land_id,
    	])
    	->execute();
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $land_id
     * @param unknown $buildings
     * @return number
     */
    public static function updateBuildingGameData($game_id, $land_id, $buildings){
    	return Yii::$app->db->createCommand()->update(self::tableName(), [
    			'game_data_buildings'       => $buildings,
    	],[
    			'game_data_game_id'         => $game_id,
    			'game_data_land_id'         => $land_id,
    	])
    	->execute();
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $land_id
     * @param unknown $user_id
     * @return number
     */
    public static function updateUserIdGameData($game_id, $land_id, $user_id){
    	return Yii::$app->db->createCommand()->update(self::tableName(), [
    			'game_data_user_id'         => $user_id,
    	],[
    			'game_data_game_id'         => $game_id,
    			'game_data_land_id'         => $land_id,
    	])
    	->execute();
    }
    
    
    /**
     * @inheritdoc
     * @return GameDataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GameDataQuery(get_called_class());
    }
}
