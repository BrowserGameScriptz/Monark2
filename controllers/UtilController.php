<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class UtilController extends Controller
{
	
	private $local = false;
	
    public function behaviors()
    {
    	return [
    			'access' => [
    					'class' => AccessControl::className(),
    					'rules' => [
    							[
    									'actions' => ['mdp', 'username'],
    									'allow' => Access::UserIsConnected() && $this->local, // Connected
    							],
    							[
    									'actions' => ['generateallcolors'],
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

}
