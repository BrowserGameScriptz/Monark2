<?php

namespace app\classes;

/**
 * 
 * @author Paul
 *
 */
class MailClass{
	
	private $mailId;
	private $mailGameId;
	private $mailTime;
	private $mailMessage;
	private $mailSubject;
	private $mailPactId;
	private $mailUserSendId;
	private $mailUserReceiveId;
	private $mailDel;
	
	/**
	 *
	 */
	public function __construct($mailData) {
		$this->mailId 				= $mailData['mail_id'];
		$this->mailGameId 			= $mailData['mail_game_id'];
		$this->mailTime 			= $mailData['mail_time'];
		$this->mailMessage 			= $mailData['mail_message'];
		$this->mailSubject 			= $mailData['mail_subject'];
		$this->mailPactId 			= $mailData['mail_pact_id'];
		$this->mailUserSendId 		= $mailData['mail_user_send_id'];
		$this->mailUserReceiveId 	= $mailData['mail_user_receive_id'];
		$this->mailDel 				= $mailData['mail_del'];
	}
	
	public function getMailId(){
		return $this->mailId;
	}
	
	public function getMailGameId(){
		return $this->mailGameId;
	}
	
	public function getMailTime(){
		return $this->mailTime;
	}
	
	public function getMailMessage(){
		return $this->mailMessage;
	}
	
	public function getMailSubject(){
		return $this->mailSubject;
	}
	
	public function getMailPactId(){
		return $this->mailPactId;
	}
	
	public function getMailUserSendId(){
		return $this->mailUserSendId;
	}
	
	public function getMailUserReceiveId(){
		return $this->mailUserReceiveId;
	}
	
	public function getMailDel(){
		return $this->mailDel;
	}
}