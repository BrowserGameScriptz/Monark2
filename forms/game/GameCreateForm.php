<?php

namespace app\forms\game;

use Yii;
use yii\base\Model;
use app\models\Game;
use app\classes\Crypt;
use app\models\Map;

/**
 * LoginForm is the model behind the login form.
 */
class gameCreateForm extends Model
{
    public $game_name;
    public $game_pwd;
    public $game_max_player;
    public $game_map_id;

    private $_game;

	public function __construct(){
		$this->_game = new Game();
	}
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // gamename and password are both required
            [['game_name', 'game_max_player', 'game_map_id'], 'required'],
        	['game_pwd', 'string'],
        	// password is validated by validatePassword()
        	['game_name', 'validateGameName'],
            // password is validated by validatePassword()
            ['game_pwd', 'validatePassword'],
        	// player_max is validated by validatePlayerMax()
        	['game_max_player', 'validatePlayerMax'],
        	// map id valid
        	['game_map_id', 'validateMapId']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for gamename.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateGameName($attribute, $params)
    {
    	if (!$this->hasErrors()) {    
    	 if ($this->_game->existsGameName($this->game_name)) {
    	 	$this->addError($attribute, Yii::t('game', 'Error_Name_Already_Use'));
    	 }
    	}
    }
    
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        
    }
    
    /**
     * Validates the map.
     * This method serves as the inline validation for map.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateMapId($attribute, $params)
    {
    	if(Map::findMapById($this->game_map_id) == null)
    		$this->addError($attribute, Yii::t('game', 'Error_Incorrect_Map'));
    }
    
    
    
    /**
     * Validates the mail.
     * This method serves as the inline validation for player_max.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePlayerMax($attribute, $params)
    {
    	if (!$this->hasErrors()) {
    	 if ($this->game_max_player > 10) {
    	 	$this->addError($attribute, Yii::t('game', 'Error_Max_Player_Nb'));
    	 }
    	}
    }

    /**
     * Create a game using the provided gamename and password.
     * @return boolean whether the game is created in successfully
     */
    public function create()
    {
    	if ($this->validate()) {
	    	// Crypt
	    	// gamename
	    	$game_name = (new Crypt($this->game_name))->s_crypt();
	    	// password
	    	$game_pwd = (new Crypt($this->game_pwd))->crypt();
	    	 
	    	// Create in db
	        $this->_game->createGame($game_name, $game_pwd, $this->game_max_player, $this->game_map_id);
	        return true;
	    }
	    return false;
    }
}

