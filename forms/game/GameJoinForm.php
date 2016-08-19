<?php

namespace app\forms\game;

use Yii;
use yii\base\Model;
use app\models\GamePlayer;
use app\models\Game;

/**
 * LoginForm is the model behind the login form.
 */
class gameJoinForm extends Model
{
    private $game_id;
    private $user_id;
    private $game_pwd;
	private $gameUserList;
	private $userInsert;
    private $_game_player = false;
	private $_game = false;

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
    	
    	// Game Password validation
    	$this->validateGamePassword();
    	
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
    	if(array_key_exists('gid', $urlparams))
    		$this->game_id = $urlparams['gid'];
    	else
    		$this->addError("Game", "error_game_id");
    }
    
    /**
     * 
     */
    public function validateGameData()
    {
    	if (!$this->hasErrors()) {
    		$game = Game::getGameById($this->game_id);
    		if($game != null)
    			$this->_game = $game;
    		else
    			$this->addError("Game", "error_game_data");
    	}
    }
    
    /**
     * 
     */
    public function validateUserStatut(){
    	if (!$this->hasErrors()) {
	    	$this->gameUserList = $this->_game_player->findAllUserGameIdToArray($this->user_id);
	    	if($this->_game_player->userIsInGameId($this->gameUserList) === null && !isset($this->gameUserList[$this->game_id])){
	    		$this->userInsert = false;
	    	}else if (isset($this->gameUserList[$this->game_id])){
	    		$this->userInsert = true;
	    	}else 
	    		$this->addError("Game", Yii::t('game', 'Error_User_Already_In_Game'));
    	}
    }
    
    /**
     * 
     */
    public function validateGameMaxPlayer(){
    	if (!$this->hasErrors()) {
	    	if($this->_game->getGamePlayerMax() < Game::getGameCountPlayer($this->game_id)+1)
	    		$this->addError("Game", Yii::t('game', 'Error_Game_Full'));
    	}
    }
    
    /**
     * 
     */
    public function validateGamePassword(){
    	if (!$this->hasErrors()) {
    		//$this->addError("Password", Yii::t('game', 'Error_Max_Player_Nb'));
    	}
    }
    
    /**
     * Create a game using the provided gamename and password.
     * @return boolean whether the game is created in successfully
     */
    public function join()
    {  	
    	if ($this->validate()) {
    		// update
    		if($this->userInsert)
    			$this->_game_player->updateEnterInGame($this->user_id, $this->game_id);
    		// Create in db
    		$this->_game_player->userJoinGame($this->_game, $this->user_id, $this->userInsert);
    		return true;
    	}
    	return false;
    }
    
    public function spec()
    {
    	if ($this->validate()) {
    		// Create in db
    		//$this->_game_player->userJoinGame($this->_game, true, 0);
    		return true;
    	}
    	return false;
    }
}

