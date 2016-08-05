<?php

namespace app\classes;

/**
 * 
 * @author Paul
 *
 */
class ChatClass{
	 
	private $chatId;
	private $chatUserId;
	private $chatGameId;
	private $chatMessage;
	private $chatTime;
	private $chatLandId;
	
	/**
	 * 
	 */
	public function __construct($chatData) {
		// DB data
		$this->chatId 				= $chatData['chat_id'];	
		$this->chatUserId 			= $chatData['chat_user_id'];
		$this->chatGameId 			= $chatData['chat_game_id'];
		$this->chatMessage 			= $chatData['chat_message'];
		$this->chatTime 			= $chatData['chat_time'];
	}
	
	public function getChatId(){
		return $this->chatId;
	}
	
	public function getChatUserId(){
		return $this->chatUserId;
	}
	
	public function getChatMessage(){
		return $this->chatMessage;
	}
	
	public function getChatTime(){
		return $this->chatTime;
	}
}