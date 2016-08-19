<?php

namespace app\forms\game;

use Yii;
use yii\base\Model;
use app\models\Mail;
use app\models\User;

/**
 * SendMailForm is the model behind the mail form.
 */
class gameSendMailForm extends Model
{
    public $mail_subject;
    public $mail_to;
    public $mail_message;
    public $mail_receive_user_id;

    private $_mail;

	public function __construct(){
		$this->_mail = new Mail();
	}
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // gamename and password are both required
            [['mail_subject', 'mail_to', 'mail_message'], 'required'],
        	[['mail_message'], 'string', 'max' => 256],
            [['mail_subject', 'mail_to'], 'string', 'max' => 128],
        	// password is validated by validatePassword()
        	['mail_to', 'validateUserName'],
            // password is validated by validatePassword()
            ['mail_message', 'validateMessage'],
        	// player_max is validated by validatePlayerMax()
        	['mail_subject', 'validateSubject'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for gamename.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateUserName($attribute, $params)
    {
    	if (!$this->hasErrors()) {
    	$user_receive = User::findByUsername($this->mail_to);
    	 if ($user_receive == null) {
    	 	$this->addError($attribute, Yii::t('game', 'Error_User_Not_Found'));
    	 }else{
    	 	$this->mail_receive_user_id = $user_receive->getUserId();
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
    public function validateMessage($attribute, $params)
    {
        
    }
    
    /**
     * Validates the mail.
     * This method serves as the inline validation for player_max.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateSubject($attribute, $params)
    {
    	
    }

    /**
     * Create a game using the provided gamename and password.
     * @return boolean whether the game is created in successfully
     */
    public function send()
    {
    	if ($this->validate()) {
	        $this->_mail->insertMail(Yii::$app->session ['Game']->getGameId(), $this->mail_message, $this->mail_subject, 0, Yii::$app->session['User']->getUserID(), $this->mail_receive_user_id);
	        return true;
	    }
	    return false;
    }
}

