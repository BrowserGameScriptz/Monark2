<?php

namespace app\models;

use Yii;
use app\classes\LandClass;

/**
 * This is the model class for table "land".
 *
 * @property string $land_id
 * @property string $land_name
 * @property integer $land_map_id
 * @property string $land_abv
 * @property string $land_image
 * @property integer $land_continent_id
 * @property string $land_position_top
 * @property string $land_position_left
 * @property integer $land_base_units
 * @property integer $land_harbor
 */
class Land extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'land';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['land_name', 'land_map_id', 'land_abv', 'land_image', 'land_continent_id', 'land_position_top', 'land_position_left', 'land_base_units', 'land_harbor'], 'required'],
            [['land_map_id', 'land_continent_id', 'land_base_units', 'land_harbor'], 'integer'],
            [['land_name', 'land_abv', 'land_image'], 'string', 'max' => 128],
            [['land_position_top', 'land_position_left'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'land_id' => 'Land ID',
            'land_name' => 'Land Name',
            'land_map_id' => 'Land Map ID',
            'land_abv' => 'Land Abv',
            'land_image' => 'Land Image',
            'land_continent_id' => 'Land Continent ID',
            'land_position_top' => 'Land Position Top',
            'land_position_left' => 'Land Position Left',
            'land_base_units' => 'Land Base Units',
            'land_harbor' => 'Land Harbor',
        ];
    }
    
    /**
     * 
     * @param unknown $units
     * @return string
     */
    public static function LandCountUnitsToArrayShow($units){
    	$data = self::LandCountUnitsToArray($units);
    	$returned = "";
    	for($i=1; $i <= $data['plane']; $i++)
    		$returned.= "<img src='img/game/plane.png' class='land_plane' style='width:22px;'>";
    	for($i=1; $i <= $data['canon']; $i++)
    		$returned.= "<img src='img/game/canon.png' class='land_canon' style='width:17px;'>";
    	for($i=1; $i <= $data['horseman']; $i++)
    		$returned.= "<img src='img/game/horseman.png' class='land_horseman' style='width:15px;'>";
    	for($i=1; $i <= $data['soldier']; $i++)
    		$returned.= "<img src='img/game/soldier.png' class='land_soldier' style='width:8px;'>";
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $units
     * @return number[]
     */
    public static function LandCountUnitsToArray($units){
    	$count_plane 		= (int)($units/20);
    	$count_canon 		= (int)(fmod($units, 20)/10);
    	$count_horseman 	= (int)(fmod(fmod($units, 20), 10)/5);
    	$count_soldier 		= (int)(fmod(fmod(fmod($units, 20), 10), 5));
    	return array(
    			'plane'		=> $count_plane,
    			'canon'		=> $count_canon,
    			'horseman'	=> $count_horseman,
    			'soldier'	=> $count_soldier,
    	);
    }
    
    /**
     * 
     * @param unknown $land_id
     * @return \app\models\Land|NULL
     */
    public static function findLandById($land_id){
    	return self::find()->where(['land_id' => $land_id])->one();
    }
    
    /**
     * 
     * @param unknown $land_id
     * @return \app\classes\LandClass
     */
    public static function findLandByIdToArray($land_id){
    	return new LandClass(findLandById($land_id));
    }

    /**
     *
     * @param unknown $map_id
     * @return \app\models\Land[]
     */
    public static function findAllLands($map_id){
    	return self::find()->where(['land_map_id' => $map_id])->all();
    }
    
    /**
     *
     * @param unknown $map_id
     * @return \app\models\Land[]
     */
    public static function findAllLandsToArray($map_id){
    	$returned = array();
    	foreach (self::findAllLands($map_id) as $land){
    		$returned[$land['land_id']] = new LandClass($land);
    	}
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $gameid
     * @param unknown $map_id
     */
    public static function assignLandsToArray($usersData, $gameData, $continentData, $mapData){
    	$assignedLand           = array();

    	foreach ($usersData as $user) {
    		$landId = 0;

    		// While land not occuped
    		do{
    			// If map has continent
    			if($mapData['map_continent'] == 1){
    				// Random antarctic continent
    				$antarcticRand 	= rand(1, 100);
    				$antarcticId	= 7;
    				
    				// 1/10 to go in antarctic
    				if ($antarcticRand < 95) {
    					$landId = rand($continentData[$user['game_player_region_id']]->getContinentLandIdBegin(), $continentData[$user['game_player_region_id']]->getContinentLandIdEnd());
    				}else{
    					$landId = rand($continentData[$antarcticId]->getContinentLandIdBegin(), $continentData[$antarcticId]->getContinentLandIdEnd());
    				}
    			}else{
    				$landId = rand($mapData['map_land_id_begin'], $mapData['map_land_id_end']);
    			}
    		}while(array_key_exists($landId, $assignedLand));
    
    		// Add to array
    		$assignedLand[$landId] = $user;
    	}
    	
    	return $assignedLand;
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\LandQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\LandQuery(get_called_class());
    }
}
