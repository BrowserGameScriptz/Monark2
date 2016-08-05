<?php

namespace app\classes;

/**
 *
 * @author Paul
 *
 */
class GamePlayerClass{

	private $game_player_id;
	private $game_player_region_id;
	private $game_player_difficulty_id;
	private $game_player_statut;
	private $game_player_game_id;
	private $game_player_user_id;
	private $game_player_color_id;
	private $game_player_enter_time;
	private $game_player_order;
	private $game_player_bot;
	private $game_player_quit;

	/**
	 *
	 */
	public function __construct($gamePlayer) {
		$this->gamePlayerId 				= $gamePlayer['game_player_id'];
		$this->gamePlayerRegionId 			= $gamePlayer['game_player_region_id'];
		$this->gamePlayerDifficultyId 		= $gamePlayer['game_player_difficulty_id'];
		$this->gamePlayerStatut 			= $gamePlayer['game_player_statut'];
		$this->gamePlayerGameId 			= $gamePlayer['game_player_game_id'];
		$this->gamePlayerUserId 			= $gamePlayer['game_player_user_id'];
		$this->gamePlayerColorId 			= $gamePlayer['game_player_color_id'];
		$this->gamePlayerEnterTime 			= $gamePlayer['game_player_enter_time'];
		$this->gamePlayerOrder 				= $gamePlayer['game_player_order'];
		$this->gamePlayerBot 				= $gamePlayer['game_player_bot'];
		$this->gamePlayerQuit 				= $gamePlayer['game_player_quit'];
	}

	public function getGamePlayerUserId(){
		return $this->gamePlayerUserId;
	}

	public function getGamePlayerColorId(){
		return $this->gamePlayerColorId;
	}

	public function getGamePlayerOrder(){
		return $this->gamePlayerOrder;
	}

	public function getGamePlayerBot(){
		return $this->gamePlayerBot;
	}
	
	public function getGamePlayerQuit(){
		return $this->gamePlayerQuit;
	}
}
