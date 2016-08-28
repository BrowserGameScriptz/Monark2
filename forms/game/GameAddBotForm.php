<?php

namespace app\forms\game;

use Yii;
use yii\base\Model;
use app\models\GamePlayer;
use app\models\Game;
use app\classes\ValidateClass;

/**
 * AddBotForm is the model behind the login form.
 */
class GameAddBotForm extends Model
{
    private $game_id;
    private $user_id;
    private $game_pwd;
	private $gameUserList;
    private $_game_player = false;
	private $_game = false;
	private $_validation;

    public function __construct(){
    	$this->_game_player = new GamePlayer();
    	$this->user_id 		= Yii::$app->session['User']->getId();
    }
    
	/**
	 * Overwrite
	 * {@inheritDoc}
	 * @see \yii\base\Model::validate()
	 */
    public function validate($attributeNames = NULL, $clearErrors = true){
    	// Game validation
    	$this->validateGameId();
    	$this->validateGameData();
		$this->validateUserStatut();
		$this->validateGameMaxPlayer();
    	
    	if($this->hasErrors())
    		return false;
    	else 
    		return true;
    }
    	
    /**
     * 
     */
    public function validateGameId(){
    	$urlparams 			= Yii::$app->request->queryParams;
    	if(array_key_exists('gid', $urlparams)){
    		$this->game_id 		= $urlparams['gid'];
    		$this->_validation 	= new ValidateClass($this->user_id, $this->game_id);
    	}else
    		$this->addError("Game", "error_game_id");
    }
    
    /**
     * 
     */
    public function validateGameData()
    {
    	if (!$this->hasErrors())
    		$result = $this->_validation->validateGameExist();
    	if($result['result'])
    		$this->_game = $result['game'];
    	else
    		$this->addError("Game", "error_game_data");
    }
    
   /**
    * 
    */
    public function validateUserStatut(){
    	if (!$this->hasErrors()) {
	    	if(!$this->_validation->validateGameOwner()){
	    		$this->addError("Game", Yii::t('game', 'Error_Not_Game_Owner'));
	    	}
    	}
    }
    
    /**
     * 
     */
    public function validateGameMaxPlayer(){
    	if (!$this->hasErrors()) {
	    	if(!$this->_validation->validateGameMaxPlayer())
	    		$this->addError("Game", Yii::t('game', 'Error_Game_Full'));
    	}
    }
    
    /**
     * Create a game using the provided gamename and password.
     * @return boolean whether the game is created in successfully
     */
    public function addBot()
    {  	
    	if ($this->validate()) {
    		$bot_id = $this->_game_player->findGamePlayerLastBot($this->game_id)->getGamePlayerBot() + 1;
    		$this->_game_player->userInsertJoinGame($this->game_id, -$bot_id, $bot_id, 1);
    		return true;
    	}
    	return false;
    }
}

