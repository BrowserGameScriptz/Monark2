<?php

namespace app\forms\game;

use Yii;
use yii\base\Model;
use app\models\GamePlayer;

/**
 * LoginForm is the model behind the login form.
 */
class gameJoinForm extends Model
{
    public $game_id;
    public $game_pwd;

    private $_game_player = false;
	private $_game = false;

    public function __construct($game){
    	$this->_game_player = new GamePlayer();
    	$this->_game 		= $game;
    }
    
    /**
     * Validate.
     * This method serves as the inline validation.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateJoin()
    {
        //$this->addError($attribute, Yii::t('game', 'Error_Max_Player_Nb'));
        return true;
    }
    
    /**
     * Create a game using the provided gamename and password.
     * @return boolean whether the game is created in successfully
     */
    public function join()
    {
    	if ($this->validateJoin()) {   		 
    		// Create in db
    		$this->_game_player->userJoinGame($this->_game, Yii::$app->session['User']->getId(), 0);
    		return true;
    	}
    	return false;
    }
    
    public function joinSpec()
    {
    	if ($this->validateJoin()) {
    		// Create in db
    		$this->_game_player->userJoinGame($this->_game, true, 0);
    		return true;
    	}
    	return false;
    }
}

