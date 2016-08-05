<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\classes\Access;


class SiteController extends Controller
{
	
	public static $refreshTime = 1800;
	public static $config;
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'lang'],
                'rules' => [
                    [
                        'allow' => true, // have access
                        'roles' => ['@'], // Connected
                    ],
                    [
                        'allow' => true, // No access
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

    /**
     *
     * @return string
     */
    public static function getJSConfig(){
    	self::$config = array(
    			'debugJs' => false,
    			'refresh_time' => self::$refreshTime,
    			'text' => array(
    					'turn_finished' 			=> Yii::t('header', 'Text_Turn_Finished'),
    					'modal_loading_content'		=> '<center><font size=3>'.Yii::t('map', 'Modal_Loading').'...</font><br><img src=img/site/loading.gif></center>',
    					'modal_error_content'		=> '<center><font size=3>'.Yii::t('map', 'Modal_Error').'</font></center>',
    					'dropdown_loading_content'	=> '<img src=img/site/loading.gif height="20px" width="20px"><br>',
    					'dropdown_error_content'	=> '<font size=3>'.Yii::t('map', 'Modal_Error').'</font>',
    					'to_buy' 			=> '<font size=4>'.Yii::t('ajax', 'To buy').'</font>',
    					'to_build' 			=> '<font size=4>'.Yii::t('ajax', 'To build').'</font>',
    					'to_move' 			=> '<font size=4>'.Yii::t('ajax', 'To move units').'</font>',
    					'to_attack' 			=> '<font size=4>'.Yii::t('ajax', 'To attack').'</font>',
    			),
    			'url'	=> array(
    					'ajax' => Yii::$app->urlManager->createUrl(['ajax'])
    			),
    			'ajax'	=> array(
    					'error'	=> AjaxController::returnError(),
    			),
    			'access' => array(
    					'in_game' => Access::UserIsInGame(),
    					'in_started_game' => Access::UserIsInStartedGame(),
    			),
    	);
    	return "var config = ".json_encode(self::$config).";";
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGame()
    {
        return $this->render('game');
    }
    
    public function actionLang()
    {
    	$urlparams = Yii::$app->request->queryParams;
    	$lang_ok   = array('fr', 'en');
    	if(array_key_exists('lang', $urlparams) AND in_array($urlparams['lang'], $lang_ok)){
    		Yii::$app->session['lang'] = $urlparams['lang'];
    		Yii::$app->session->setFlash('success', Yii::t('site', 'Success_Change_Lang'));
    	}
    	return $this->render('lang');
    }

}
