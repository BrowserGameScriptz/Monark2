<?php

namespace app\models;

use Yii;
use app\classes\DifficultyClass;

/**
 * This is the model class for table "difficulty".
 *
 * @property string $difficulty_id
 * @property string $difficulty_name
 * @property string $difficulty_rate_resource_freq
 * @property string $difficulty_rate_building_cost
 * @property string $difficulty_rate_building_icome
 * @property string $difficulty_rate_land_base_units
 * @property string $difficulty_bot_action_per_turn
 * @property string $difficulty_bot_bonus_income
 * @property string $difficulty_hide
 */
class Difficulty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'difficulty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['difficulty_name', 'difficulty_rate_resource_freq', 'difficulty_rate_building_cost', 'difficulty_rate_building_icome', 'difficulty_rate_land_base_units', 'difficulty_bot_action_per_turn', 'difficulty_bot_bonus_income', 'difficulty_hide'], 'required'],
            [['difficulty_name'], 'string', 'max' => 256],
            [['difficulty_rate_resource_freq', 'difficulty_rate_building_cost', 'difficulty_rate_building_icome', 'difficulty_rate_land_base_units', 'difficulty_bot_action_per_turn', 'difficulty_bot_bonus_income'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'difficulty_id' => 'Difficulty ID',
            'difficulty_name' => 'Difficulty Name',
            'difficulty_rate_resource_freq' => 'Difficulty Rate Resource Freq',
            'difficulty_rate_building_cost' => 'Difficulty Rate Building Cost',
            'difficulty_rate_building_icome' => 'Difficulty Rate Building Icome',
            'difficulty_rate_land_base_units' => 'Difficulty Rate Land Base Units',
            'difficulty_bot_action_per_turn' => 'Difficulty Bot Action Per Turn',
            'difficulty_bot_bonus_income' => 'Difficulty Bot Bonus Income',
        	'difficulty_hide' => 'Difficulty Hide',
        ];
    }

    /**
     * 
     * @return \app\classes\DifficultyClass[]
     */
    public static function findAllDifficulyToArray($hide=null){
    	$data = self::findAllDifficulty($hide);
    	$returned = array();
    	foreach($data as $difficulty)
    		$returned[$difficulty['difficulty_id']] = new DifficultyClass($difficulty);
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $difficulty_id
     * @return \app\classes\DifficultyClass
     */
    public static function findDifficultyByIdToArray($difficulty_id){
    	return new DifficultyClass(self::findDifficultyById($difficulty_id));
    }
    
    /**
     * 
     * @return \app\models\Difficulty[]
     */
    public static function findAllDifficulty($hide=null){
    	if($hide == null)
    		return self::find()->all();
    	else
    		return self::find()->where(['difficulty_id' => $hide])->all();
    }
    
    /**
     *
     * @return \app\models\Difficulty[]
     */
    public static function findDifficultyById($difficulty_id){
    	return self::find()->where(['difficulty_id' => $difficulty_id])->one();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\DifficultyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\DifficultyQuery(get_called_class());
    }
}
