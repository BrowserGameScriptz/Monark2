<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\search\GameSearch;
use app\forms\game\gameCreateForm;

class GameController extends \yii\web\Controller
{
public function behaviors()
	{
		return [
				'access' => [
						'class' => AccessControl::className(),
						'only' => ['index'],
						'rules' => [
								[
										'allow' => true, // have access
										'roles' => ['@'], // Connected
								],
								[
										'allow' => false, // No access
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
        $searchModel = new GameSearch();
        $dataProvider = $searchModel->search(['query' => Yii::$app->request->queryParams,]);
        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {

    	$model = new GameCreateForm();
    	if ($model->load(Yii::$app->request->post()) && $model->create()) {
    		// all inputs are valid
    		Yii::$app->session->setFlash('success', Yii::t('game', 'Success_Game_Created')); 
    		return $this->actionIndex();
    	}else{
    		// validation failed: $errors is an array containing error messages
    		$errors = $model->errors;
    		return $this->render('create', [
    				'model' => $model,
    		]);
    	}
    }

}
