<?php

namespace app\models;

use Yii;
use app\classes\MapClass;

/**
 * This is the model class for table "map".
 *
 * @property string $map_id
 * @property string $map_name
 * @property string $map_music
 * @property integer $map_continent
 * @property integer $map_land_id_begin
 * @property integer $map_land_id_end
 * @property integer $map_hide
 */
class Map extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['map_name', 'map_music', 'map_continent', 'map_land_id_begin', 'map_land_id_end', 'map_hide'], 'required'],
            [['map_continent', 'map_land_id_begin', 'map_land_id_end', 'map_hide'], 'integer'],
            [['map_name', 'map_music'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'map_id' => 'Map ID',
            'map_name' => 'Map Name',
            'map_music' => 'Map Music',
            'map_continent' => 'Map Continent',
            'map_land_id_begin' => 'Map Land Id Begin',
            'map_land_id_end' => 'Map Land Id End',
        	'map_hide'	=> 'Map Hide',
        ];
    }

    /**
     * 
     * @param unknown $map_id
     * @return \app\models\Map|NULL
     */
    public static function findMapById($map_id){
    	return self::find()->where(['map_id' => $map_id])->one();
    }
    
    /**
     * 
     * @return \app\classes\MapClass[]
     */
    public static function findAllMapToArray($hide=null){
    	$data = self::findAllMap($hide);
    	$returned = array();
    	foreach ($data as $map)
    		$returned[$map['map_id']] = new MapClass($map);
    	return $returned;
    }
    
    /**
     *  
     * @return \app\models\Map[]
     */
    public static function findAllMap($hide=null){
    	if($hide === null)
    		return self::find()->all();
    	else 
    		return self::find()->where(['map_hide' => $hide])->all();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\MapQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\MapQuery(get_called_class());
    }
}
