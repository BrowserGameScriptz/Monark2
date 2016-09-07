<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\classes\Access;

class UtilController extends Controller
{
	
	private $local = true;
	
    public function behaviors()
    {
    	return [
    			'access' => [
    					'class' => AccessControl::className(),
    					'rules' => [
    							[
		    							'actions' => ['bot'],
		    							'allow' => Access::UserIsInStartedGame() && $this->local, // In started
    							],
    							[
    									'actions' => ['mdp', 'username', 'rolldice'],
    									'allow' => Access::UserIsConnected() && $this->local, // Connected
    							],
    							[
    									'actions' => ['generateallcolors', 'rolldice'],
    									'allow' => $this->local, // No access
    									'roles'=>['?'], // Guests
    							],
    					],
    			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionMdp()
    {
        return $this->render('user/mdp');
    }

    public function actionUsername()
    {
    	return $this->render('user/username');
    }

    public function actionGenerateallcolors()
    {
    	return $this->render('generateallcolors');
    }
    
    public function actionBot()
    {
    	return $this->render('bot/bot');
    }

    public function actionRolldice()
    {
    	return $this->render('js/rolldice');
    }
}
