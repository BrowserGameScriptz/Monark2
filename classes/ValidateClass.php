<?php 

namespace app\classes;

use app\models\Game;
use app\models\User;

/**
* Class regroupant les différentes validations des formulaires
*/

class ValidateClass
{

	private $_user;
	private $user_id;
	private $_game;
	private $game_id;
	
	/**
	 * 
	 * @param unknown $user
	 * @param unknown $game
	 */
	public function __construct($user, $game){
		// User
		if($user instanceof User) {
			$this->_user 	= $user;
			$this->user_id 	= $user->getUserID();
		}else
			$this->user_id = $user;
		
		// Game	
		if($game instanceof GameClass) {
			$this->_game 	= $game;
			$this->game_id	= $game->getGameId();
		}else
			$this->game_id = $game;
	}
	
	/**
	 * 
	 * @return boolean[]|\app\classes\GameClass[]|boolean[]
	 */
	public function validateGameExist(){
		$game = Game::getGameById($this->game_id);
		if($game != null){
			$this->_game = $game;
			return array(
					'game' 		=> $this->_game,
					'result' 	=> true,
			);
		}
		return array('result' 	=> false,);
	}

	/**
	 * 
	 * @return boolean
	 */
	public function validateGameMaxPlayer(){
		if($this->_game->getGamePlayerMax() < Game::getGameCountPlayer($this->game_id)+1)
			return false;
		return true;
	}
	
	/**
	 * 
	 * @return boolean
	 */
	public function validateGameOwner(){
		if($this->_game->getGameOwnerID() == $this->user_id){
	    	return true;
	    }
	    return false;
	}
}

?>