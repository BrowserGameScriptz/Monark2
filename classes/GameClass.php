<?php

namespace app\classes;
use app\models\Game;
/**
 *
 * @author Paul
 *
 */
class GameClass{

	private $gameId;
	private $gameNameCrypted;
	private $gameOwnerID;
	private $gameUserOwner;
	private $gamePassword;
	private $gameType;
	private $gameKey;
	private $gameMaxPlayer;
	private $gameCreateTime;
	private $gameStatut;
	private $gameMapId;
	private $gameModId;
	private $gameTurnTime;
	private $gameDifficultyId;
	private $gameWonUserId;
	private $gameWonTime;

	/**
	 *
	 */
	public function __construct($gameData) {
		// DB data
		$this->gameId 			= $gameData['game_id'];
		$this->gameNameCrypted 	= $gameData['game_name'];
		$this->gamePassword 	= $gameData['game_pwd'];
		$this->gameOwnerID 		= $gameData['game_owner_id'];
		$this->gameKey 			= $gameData['game_key'];
		$this->gameMaxPlayer 	= $gameData['game_max_player'];
		$this->gameCreateTime 	= $gameData['game_create_time'];
		$this->gameStatut 		= $gameData['game_statut'];
		$this->gameMapId 		= $gameData['game_map_id'];
		$this->gameModId 		= $gameData['game_mod_id'];
		$this->gameTurnTime 	= $gameData['game_turn_time'];
		$this->gameDifficultyId = $gameData['game_difficulty_id'];
		$this->gameWonUserId 	= $gameData['game_won_user_id'];
		$this->gameWonTime 		= $gameData['game_won_time'];
	}

	public function getGameId(){
		return $this->gameId;
	}

	public function getGamePassword(){
		return $this->gamePassword;
	}

	public function getGameNameCrypted(){
		return $this->gameNameCrypted;
	}

	public function getGameOwnerID(){
		return $this->gameOwnerID;
	}

	public function getGamePlayerMax(){
		return $this->gameMaxPlayer;
	}

	public function getGameKey(){
		return $this->gameKey;
	}

	public function getGameName(){
		return (new Crypt($this->gameNameCrypted))->s_decrypt();
	}

	public function getUserOwner(){
		$this->gameUserOwner = Game::getUserOwner($this->gameOwnerID);
		return $this->gameUserOwner;
	}

	public function getMapId(){
		return $this->gameMapId;
	}

	public function getGameStatut(){
		return $this->gameStatut;
	}

	public function setGameStatut($statut){
		$this->gameStatut = $statut;
	}

	/**
	 *
	 * @return number
	 */
	public function getStatutExplicit(){
		// before game
		if($this->gameStatut < 100)
			return 0;

		// in game
		else if($this->gameStatut > 100 && $this->gameStatut < 200)
			return 1;

		// after game
		else
			return 2;

	}
}

?>
