<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\forms\user\UserLoginForm;
use app\forms\user\UserCreateForm;
use app\controllers\SiteController;

class UserController extends \yii\web\Controller
{
	public function behaviors()
	{
		return [
				'access' => [
						'class' => AccessControl::className(),
						'only' => ['sign', 'login', 'logout'],
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
	
    public function actionIndex()
    {
        return $this->goHome();
    }
    
    public function actionLogin()
    {
    	if (!\Yii::$app->user->isGuest) {
    		return $this->actionIndex();
    	}
    
    	$model = new UserLoginForm();
    	if ($model->load(Yii::$app->request->post()) && $model->login()) {
    		// all inputs are valid
    		Yii::$app->session->setFlash('success', 'Login in successfuly.');
    		return $this->redirect(Url::to(['game/index']),302);
    	}else{
    		// validation failed: $errors is an array containing error messages
    		$errors = $model->errors;
    		return $this->render('login', [
    				'model' => $model,
    		]);
    	}
    }
    
    public function actionSign()
    {
    	if (!\Yii::$app->user->isGuest) {
    		return $this->goHome();
    	}
    
    	$model = new UserCreateForm();
    	if ($model->load(Yii::$app->request->post()) && $model->sign() != false) {
    		// all inputs are valid
    		Yii::$app->session->setFlash('success', 'Create account successed.');
    		return $this->redirect(Url::to(['user/login']),302);
    	}else{
    		// validation failed: $errors is an array containing error messages
    		$errors = $model->errors;
    		return $this->render('sign', [
    				'model' => $model,
    		]);
    	}
    }
    
    public function actionLogout()
    {
    	Yii::$app->user->logout();
    
    	return $this->goHome();
    }

}
