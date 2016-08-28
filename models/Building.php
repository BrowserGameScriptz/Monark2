<?php

namespace app\models;

use Yii;
use app\classes\BuildingClass;

/**
 * This is the model class for table "building".
 *
 * @property string $building_id
 * @property string $building_name
 * @property integer $building_cost
 * @property integer $building_id_need
 * @property integer $building_gold_income
 * @property integer $building_petrol_income
 * @property string $building_description
 * @property string $building_img
 */
class Building extends \yii\db\ActiveRecord
{
    
	private $land_id;
	private $user;
	private $game;
	private $gameData;
	private $turn;
	private $building_id;
	private $buildingData;
	private $futur_gold;
	private $futur_buildings;
    
	public static $FortId = 1;
	public static $CampId = 2;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'building';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['building_name', 'building_cost', 'building_id_need', 'building_gold_income', 'building_petrol_income', 'building_description'], 'required'],
            [['building_cost', 'building_id_need', 'building_gold_income', 'building_petrol_income'], 'integer'],
            [['building_name', 'building_img'], 'string', 'max' => 128],
            [['building_description'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'building_id' => 'Building ID',
            'building_name' => 'Building Name',
            'building_cost' => 'Building Cost',
            'building_id_need' => 'Building Id Need',
            'building_gold_income' => 'Building Gold Income',
            'building_petrol_income' => 'Building Petrol Income',
            'building_description' => 'Building Description',
        	'building_img'	=> 'Building Img',
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
    public function BuildInit($land_id, $user, $game, $gameData, $turn, $building_id, $buildingData){
    	// Data
    	$this->land_id 		= $land_id;
    	$this->user 		= $user;
    	$this->game 		= $game;
    	$this->gameData 	= $gameData;
    	$this->turn 		= $turn;
    	$this->building_id 	= $building_id;
    	$this->buildingData = $buildingData;
    	 
    	// Calc
    	if(isset($this->buildingData[$this->building_id]))
    		$this->futur_gold 		= $this->turn->getTurnGold() - $this->buildingData[$this->building_id]->getBuildingCost();
    	else 
    		$this->futur_gold = 0;
    	if($this->gameData[$this->land_id]->getGameDataBuildingsSQL() == "")
    		$this->futur_buildings	= $this->building_id;
    	else
    		$this->futur_buildings	= $this->gameData[$this->land_id]->getGameDataBuildingsSQL().";".$this->building_id;
    }
    
    /**
     *
     * @return string
     */
    public function BuildCheck(){
    	// Gold check
    	if($this->futur_gold >= 0){
    		// Turn check
    		if($this->turn->getTurnUserId() == $this->user->getUserID()){
    			// Building check
    			if(isset($this->buildingData[$this->building_id]) 
    				&& !$this->buildingAlreadyBuild($this->gameData, $this->land_id, $this->building_id)
    				&& in_array($this->building_id, $this->getBuildingsToBuildId($this->gameData[$this->land_id]->getGameDataBuildings(), $this->gameData[$this->land_id]->getGameDataResourceId(), $this->buildingData))){
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
    public function BuildExec()
    {
    	GameData::updateBuildingGameData($this->game->getGameId(), $this->land_id, $this->futur_buildings);
    
    	Turn::updateGoldTurn($this->game->getGameId(), $this->turn->getTurnId(), $this->futur_gold);
    
    	Buy::insertBuyLog($this->user->getUserID(), $this->turn->getTurnId(), $this->game->getGameId(), $this->land_id, 0, $this->building_id);
    }
    
    /**
     * 
     * @param unknown $gameData
     * @param unknown $land_id
     * @param unknown $building_id
     * @return boolean
     */
    public static function buildingAlreadyBuild($gameData, $land_id, $building_id){
    	if(!in_array($building_id, $gameData[$land_id]->getGameDataBuildings()))
    		return false;
    	else
    		return true;
    }
    
    /**
     * 
     * @param unknown $existantBuildingsId
     * @param unknown $landResourceId
     * @param unknown $buildingData
     * @return NULL[]
     */
    public static function getBuildingsToBuildId($existantBuildingsId, $landResourceId, $buildingData){
    	$returned = array();
    	foreach (self::getBuildingsToBuild($existantBuildingsId, $landResourceId, $buildingData) as $building)
    		$returned[$building->getBuildingId()] = $building->getBuildingId();
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $existantBuildingsId
     * @param unknown $landResourceId
     * @param unknown $buildingData
     */
    public static function getBuildingsToBuild($existantBuildingsId, $landResourceId, $buildingData){
    	$returned = array();
    	foreach ($buildingData as $building) {
			
			// If building answer the Resource needs
    		if($building->getBuildingNeed() == $landResourceId || $building->getBuildingNeed() == 0){
    	
    			// If not already build
    			if (!in_array($building->getBuildingId(), $existantBuildingsId)) {
    				array_push($returned, $building);
    			}
    		}
    	}
    	
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $gameData
     * @param unknown $user_id
     * @param unknown $buildingData
     * @param unknown $details
     * @return number
     */
    public static function getUserIncomeByBuildings($gameData, $user_id, $buildingData = null, $details = null){
    	if($details == null)
    		$returned = 0;
    	else
    		$returned = array();
    	
    	if($buildingData == null)
    		$buildingData = self::findAllBuildingToArray();
    	
    	// Each game land
    	foreach ($gameData as $land) {
    		if($land->getGameDataUserId() == $user_id
    		&& count($land->getGameDataBuildings()) > 0){
    			
    			// Each land building
    			foreach ($land->getGameDataBuildings() as $building){
    				if(isset($buildingData[$building])
    				&& $buildingData[$building]->getBuildingGoldIncome() > 0)
    					if($details == null)
    						$returned += $buildingData[$building]->getBuildingGoldIncome();
    					else
    						array_push($returned, array(
    								'land' => $land,
    								'building' => $buildingData[$building],
    						));
    			}
    		}
    	}
    	
    	return $returned;
    }
    
    /**
     *
     * @param unknown $continent_id
     * @return \app\classes\ContinentClass
     */
    public static function findBuildingById($building_id){
    	return new BuildingClass(self::find()->where(['building_id' => $building_id])->one());
    }
    
    /**
     *
     * @param unknown $map_id
     * @return NULL|\app\classes\ContinentClass
     */
    public static function findAllBuildingToArray($buildingData=null){
    	if($buildingData == null)
    		$buildingData = self::findAllBuilding();
    	$array = null;
    	foreach ($buildingData as $key => $building){
    		$array[$building['building_id']] = new BuildingClass($building);
    	}
    	return $array;
    }
    
    /**
     *
     * @param unknown $map_id
     * @return \app\models\Continent[]
     */
    public static function findAllBuilding(){
    	return self::find()->all();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\BuildingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\BuildingQuery(get_called_class());
    }
}
