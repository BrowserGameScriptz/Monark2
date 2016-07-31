<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Turn;
use app\classes\Access;
use app\models\Land;
use app\models\GameData;
use app\models\Color;
use app\models\Resource;
use app\models\Continent;
use app\models\Game;
use app\models\User;
use app\models\GamePlayer;
use yii\helpers\Json;
use yii\web\Response;
use app\models\Building;
use app\models\Frontier;
use app\models\Buy;
use app\models\Move; 
use yii\web\View;
use app\models\Fight;

/**
 * AjaxController implements the CRUD actions for Ajax model.
 */
class AjaxController extends Controller
{
    public function behaviors()
	{
		return [
				'access' => [
						'class' => AccessControl::className(),
						'rules' => [
								[
										'actions' => ['newturn', 'landinfo', 'header', 'buybegin', 'buyaction', 'buildbegin', 'buildaction', 'attackbegin', 'attackaction', 'movebegin', 'moveaction', 'lastgold', 'income'],
										'allow' => Access::UserIsInStartedGame(), // Into a started game
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

    /**
     * Lists all Game models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * 
     * @return string
     */
    public static function returnError()
    {
    	return "AJAX_ERROR";
    }

    /**
     * 
     * @param unknown $dataList
     * @return \app\classes\GameClass[]|\app\models\User[]|NULL[]|\app\classes\ResourceClass[][]|\app\models\NULL[]|\app\classes\ColorClass[]|\app\models\Continent[][]|\app\models\Land[][]|\app\classes\TurnClass[]|\app\models\number[][]|Session[]
     */
    private function getData($dataList){
		$returned = array();

    	if($dataList['game_id'] === true){
    		$returned['game'] 				= Yii::$app->session['Game'];}else{
    		$returned['game'] 				= Game::getGameById($dataList['game_id']);}
    		
    	if($dataList['user_id'] === true){
    		$returned['user'] 				= Yii::$app->session['User'];}else{
    		$returned['user'] 				= User::findUserById($dataList['user_id']);}
    		
    	if(Yii::$app->session['Resource'] == null && isset($dataList['Resource'])){
    		$returned['resource'] 			= Resource::findAllResourcesToArray();}else{
    		$returned['resource'] 			= Yii::$app->session['Resource'];}
    		
    	if(Yii::$app->session['Color'] == null && isset($dataList['Color'])){
    		$returned['color'] 				= Color::findAllColorToArray();}else{
    		$returned['color'] 				= Yii::$app->session['Color'];}
    		
    	if(Yii::$app->session['Continent'] == null && isset($dataList['Continent'])){
    		$returned['continent'] 			= Continent::findAllContinentToArray($returned['game']->getMapId());}else{
    		$returned['continent'] 			= Yii::$app->session['Continent'];}
    		
    	if(Yii::$app->session['Land'] == null && isset($dataList['Land'])){
    		$returned['land'] 				= Land::findAllLandsToArray($returned['game']->getMapId());}else{
    		$returned['land']				= Yii::$app->session['Land'];}
    		
    	if(Yii::$app->session['Map'] == null && isset($dataList['Map'])){
    		$returned['map']				= Map::findMapById($returned['game']->getMapId());}else{
    		$returned['map']				= Yii::$app->session['Map'];}
    		
    	if(isset($dataList['CurrentTurnData']))
    		$returned['currentTurnData']	= Turn::getLastTurnByGameId($returned['game']->getGameId());
    	
    	if(isset($dataList['LastUserTurnData']))
    		$returned['lastUserTurnData']	= Turn::getLastTurnByUserId($user->getUserID(), $returned['game']->getGameId());
    	
    	if(isset($dataList['GamePlayer'])){
    		$gamePlayerDataGlobal 			= GamePlayer::findAllGamePlayer($returned['game']->getGameId());
    		$gamePlayerData 				= GamePlayer::findAllGamePlayerToArrayWithData($gamePlayerDataGlobal);
    		$gamePlayerData[0]				= GamePlayer::findPlayerZero();
    		$returned['gamePlayer']			= $gamePlayerData;
    	}
    		 
    	if(isset($dataList['GameData']))
    		$returned['gameData']			= GameData::getGameDataByIdToArray($returned['game']->getGameId());
    	
    	if(isset($dataList['BuildingData']))
    		$returned['buildingData']		= Building::findAllBuildingToArray();
    	
    	if(isset($dataList['UsersData'])){
    		$usersData 						= GamePlayer::findAllGamePlayerToListUserId($gamePlayerDataGlobal);
    		$usersData[0]					= GamePlayer::findUserZero();
    		$returned['usersData'] 			= $usersData;
    	}
    	
    	if(isset($dataList['Frontier'])){
    		if(Yii::$app->session['Frontier'] == null) Yii::$app->session->set("Frontier", Frontier::findAllFrontier($returned['game']->getMapId()));
    		if(!isset($returned['gameData'])) $returned['gameData'] = GameData::getGameDataByIdToArray($returned['game']->getGameId());
    		
    		$returned['frontierData'] 		= Yii::$app->session['Frontier'];
    		$returned['userFrontierData']	= Frontier::userHaveFrontierLandArray($returned['gameData'], $returned['user']->getUserID(), $returned['frontierData']);
    	}
    	
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     */
	public function actionNewturn($game_id=null, $user_id=null){
		// Load data     
	    	$data = $this->getData(array(
	    			'game_id' => true,
	    			'user_id' => true,
	    			'GameData' => true,
	    	));
		
		Turn::NewTurn($data['game']->getGameId(), $data['user']->getUserId(), $data['gameData']);
	}
	
	/**
	 * 
	 */
	public function actionHeader(){
		(new GameController(null, null))->addDataToSession(Yii::$app->session['Game']);
	}
	
	/**
	 * 
	 * @return mixed|NULL|string
	 */
	public function getJson($arrayParams){
		$urlparams = Yii::$app->request->queryParams;
		$returned = array();
		if(array_key_exists('args', $urlparams) && Json::decode($urlparams['args'], true) != null)
			$urlArgsArray = Json::decode($urlparams['args'], true);
			foreach ($arrayParams as $params){
				if(array_key_exists($params, $urlArgsArray) && $urlArgsArray[$params] != null)
					$returned[$params] = $urlArgsArray[$params];
				else 
					return null;					
			}
		return $returned;
	}
	
	/**
	 * 
	 * @param unknown $land_id
	 * @param unknown $game
	 * @param unknown $user
	 * @return NULL
	 */ 
	public function actionLandinfo($land_id=null, $game=null, $user=null){
		$urlArgsArray = $this->getJson(array('land_id'));
		if($urlArgsArray != null){
	    	// Load data     
	    	$data = $this->getData(array(
	    			'game_id' => true,
	    			'user_id' => true,
	    			'User' => true,
	    			'Resource' => true,
	    			'Color' => true,
	    			'Continent' => true,
	    			'Land' => true,
	    			'GameData' => true,
	    			'CurrentTurnData' => true,
	    			'GamePlayer' => true,
	    			'UsersData'	=> true,
	    			'BuildingData' => true,
	    			'Frontier' => true,
	    	));
	    	
	    	$conquest_this_turn_data   	= Fight::ConquestThisTurnLandAll($data['game']->getGameId(), $data['currentTurnData']->getTurnId());
	    	
	    	return $this->renderAjax('land_info', [
	    			'land_id' 			=> $urlArgsArray['land_id'],
	    			'land_id_array'		=> $urlArgsArray['land_id'] - 1, 
	    			'Game'				=> $data['game'],
	    			'User'				=> $data['user'],
	    			'Resource'			=> $data['resource'],
	    			'Color'				=> $data['color'],
	    			'Continent'			=> $data['continent'],
	    			'Land'				=> $data['land'],
	    			'GameData'			=> $data['gameData'],
	    			'CurrentTurnData'	=> $data['currentTurnData'],
	    			'GamePlayer'		=> $data['gamePlayer'],
	    			'UsersData'			=> $data['usersData'],
	    			'BuildingData'		=> $data['buildingData'],
	    			'FrontierData'		=> $data['frontierData'],
	    			'UserFrontierData'	=> $data['userFrontierData'],
	    			'conquestAll'		=> $conquest_this_turn_data,
	    	]);
		}
		
		return $this->returnError();
	}
	
	/**
	 * 
	 * @return string
	 */
	public function actionBuybegin(){
		$urlArgsArray = $this->getJson(array('land_id'));
		if($urlArgsArray != null){
			// Load data
			$data = $this->getData(array(
					'game_id' => true,
					'user_id' => true,
					'Land' => true,
					'User' => true,
					'GameData' => true,
					'CurrentTurnData' => true,
			));
			
			return $this->renderAjax('buy_begin', [
					'land_id' 			=> $urlArgsArray['land_id'],
					'Game'				=> $data['game'],
					'User'				=> $data['user'],
					'Land'				=> $data['land'],
					'GameData'			=> $data['gameData'],
					'CurrentTurnData'	=> $data['currentTurnData'],
			]);
		}
		return $this->returnError();
	}
	
	/**
	 * 
	 * @return string
	 */
	public function actionBuyaction(){
		$urlArgsArray = $this->getJson(array('land_id', 'units'));
		if($urlArgsArray != null){		
			// Load data
			$data = $this->getData(array(
					'game_id' => true,
					'user_id' => true,
					'User' => true,
					'GameData' => true,
					'CurrentTurnData' => true,
			));
			
			// Buy update
			$buy = new Buy();
			$buy->BuyInit($urlArgsArray['land_id'], $data['user'], $data['game'], $data['gameData'], $data['currentTurnData'], $urlArgsArray['units']);
			$buyError = $buy->BuyCheck();
			if($buyError === true) $buy->BuyExec();

			return $this->renderAjax('buy_action', [
					'error'				=> $buyError,
					'land_id' 			=> $urlArgsArray['land_id'],
					'units'				=> $urlArgsArray['units'],
					'Game'				=> $data['game'],
					'User'				=> $data['user'],
					'GameData'			=> $data['gameData'],
					'CurrentTurnData'	=> $data['currentTurnData'],
			]);
		}
		return $this->returnError();
	}
	
	/**
	 * 
	 * @return string
	 */
	public function actionBuildbegin(){
		$urlArgsArray = $this->getJson(array('land_id'));
		if($urlArgsArray != null){
			// Load data
			$data = $this->getData(array(
					'game_id' => true,
					'user_id' => true,
					'Land' => true,
					'User' => true,
					'GameData' => true,
					'CurrentTurnData' => true,
					'Resource' => true,
					'CurrentTurnData' => true,
					'BuildingData' => true,
			));
				
			return $this->renderAjax('build_begin', [
					'land_id' 			=> $urlArgsArray['land_id'],
					'Game'				=> $data['game'],
					'User'				=> $data['user'],
					'Land'				=> $data['land'],
					'Resource'			=> $data['resource'],
					'GameData'			=> $data['gameData'],
					'CurrentTurnData'	=> $data['currentTurnData'],
					'BuildingData'		=> $data['buildingData'],
			]);
		}
		return $this->returnError();
	}
	
	/**
	 * 
	 * @return string
	 */
	public function actionBuildaction(){
		$urlArgsArray = $this->getJson(array('land_id', 'building_id'));
		if($urlArgsArray != null){
			// Load data
			$data = $this->getData(array(
					'game_id' => true,
					'user_id' => true,
					'Land' => true,
					'User' => true,
					'GameData' => true,
					'CurrentTurnData' => true,
					'Resource' => true,
					'BuildingData' => true,
			));
				
			// Build
			$build = new Building();
			$build->BuildInit($urlArgsArray['land_id'], $data['user'], $data['game'], $data['gameData'], $data['currentTurnData'], $urlArgsArray['building_id'], $data['buildingData']);
			$buildError = $build->BuildCheck();
			if($buildError === true) $build->BuildExec();
		
			return $this->renderAjax('build_action', [
					'error'				=> $buildError,
					'land_id' 			=> $urlArgsArray['land_id'],
					'building_id'		=> $urlArgsArray['building_id'],
					'Game'				=> $data['game'],
					'User'				=> $data['user'],
					'Land'				=> $data['land'],
					'Resource'			=> $data['resource'],
					'GameData'			=> $data['gameData'],
					'CurrentTurnData'	=> $data['currentTurnData'],
					'BuildingData'		=> $data['buildingData'],
			]);
		}
		return $this->returnError();
	}
	
	/**
	 * 
	 * @return string
	 */
	public function actionAttackbegin(){
		$urlArgsArray = $this->getJson(array('land_id'));
		if($urlArgsArray != null){
			// Load data
			$data = $this->getData(array(
					'game_id' => true,
					'user_id' => true,
					'User' => true,
					'Land' => true,
					'GameData' => true,
					'CurrentTurnData' => true,
					'BuildingData' => true,
					'Frontier'	=> true,
			));
			
			$frontierData 				= Frontier::landHaveFrontierLandArrayId($data['frontierData'], $urlArgsArray['land_id']);
			$conquest_this_turn_data   	= Fight::ConquestThisTurnLandAll($data['game']->getGameId(), $data['currentTurnData']->getTurnId());
			
			return $this->renderAjax('attack_begin', [
					'land_id' 			=> $urlArgsArray['land_id'],
					'Game'				=> $data['game'],
					'User'				=> $data['user'],
					'Land'				=> $data['land'],
					'GameData'			=> $data['gameData'],
					'CurrentTurnData'	=> $data['currentTurnData'],
					'BuildingData'		=> $data['buildingData'],
					'frontierData'		=> $frontierData,
					'conquestAll'		=> $conquest_this_turn_data,
			]);
		}
		return $this->returnError();
	}
	
	/**
	 * 
	 * @return string
	 */
	public function actionAttackaction(){
		$urlArgsArray = $this->getJson(array('land_id', 'atk_id', 'units'));
		if($urlArgsArray != null){
			// Load data
			$data = $this->getData(array(
					'game_id' => true,
					'user_id' => true,
					'User' => true,
					'GameData' => true,
					'CurrentTurnData' => true,
					'Frontier'	=> true,
			));
				
			$frontierData 			= Frontier::landHaveFrontierLandArrayId($data['frontierData'], $urlArgsArray['land_id']);
			
			// Attack
			$fight = new Fight();
			$fight->FightInit($urlArgsArray['land_id'], $data['user'], $data['game'], $data['gameData'], $data['currentTurnData'], $urlArgsArray['atk_id'], $urlArgsArray['units'], $data['frontierData']);
			$fightError = $fight->FightCheck();
			$attack_result = array();
			if($fightError === true) $attack_result = $fight->FightExec();
			
			return $this->renderPartial('attack_action', [
					'error'				=> $fightError,
					'atk_result'		=> $attack_result,
					'land_id' 			=> $urlArgsArray['land_id'],
					'Game'				=> $data['game'],
					'User'				=> $data['user'],
					'GameData'			=> $data['gameData'],
					'CurrentTurnData'	=> $data['currentTurnData'],
			]);
		}
		return $this->returnError();
	}
	
	/**
	 * 
	 * @return string
	 */
	public function actionMovebegin(){
		$urlArgsArray = $this->getJson(array('land_id'));
		if($urlArgsArray != null){
			// Load data
			$data = $this->getData(array(
					'game_id' => true,
					'user_id' => true,
					'Land' => true,
					'User' => true,
					'GameData' => true,
					'CurrentTurnData' => true,
					'Frontier'	=> true,
			));
			
			$frontierData = Frontier::landHaveFrontierLandArrayId($data['frontierData'], $urlArgsArray['land_id']);
			
			return $this->renderAjax('move_begin', [
					'land_id' 			=> $urlArgsArray['land_id'],
					'Game'				=> $data['game'],
					'User'				=> $data['user'],
					'Land'				=> $data['land'],
					'GameData'			=> $data['gameData'],
					'CurrentTurnData'	=> $data['currentTurnData'],
					'frontierData'		=> $frontierData,
			]);
		}
		return $this->returnError();
	}
	
	/**
	 * 
	 * @return string
	 */
	public function actionMoveaction(){
		$urlArgsArray = $this->getJson(array('land_id', 'land_id_to', 'units'));
		if($urlArgsArray != null){
			// Load data
			$data = $this->getData(array(
					'game_id' => true,
					'user_id' => true,
					'User' => true,
					'GameData' => true,
					'CurrentTurnData' => true,
					'Frontier' => true,
			));
				
			$frontierData = Frontier::landHaveFrontierLandArrayId($data['frontierData'], $urlArgsArray['land_id']);
			
			// Move
			$move = new Move();
			$move->MoveInit($urlArgsArray['land_id'], $data['user'], $data['game'], $data['gameData'], $data['currentTurnData'], $urlArgsArray['land_id_to'], $urlArgsArray['units'], $frontierData);
			$moveError = $move->MoveCheck();
			if($moveError === true) $move->MoveExec();
		
			return $this->renderAjax('move_action', [
					'error'				=> $moveError,
					'land_id' 			=> $urlArgsArray['land_id'],
					'land_id_to'		=> $urlArgsArray['land_id_to'],
					'units'				=> $urlArgsArray['units'],
					'Game'				=> $data['game'],
					'User'				=> $data['user'],
					'GameData'			=> $data['gameData'],
					'CurrentTurnData'	=> $data['currentTurnData'],
					'frontierData'		=> $frontierData,
			]);
		}
		return $this->returnError();
	}
	
	/**
	 * 
	 * @return string
	 */
	public function actionLastgold(){
		// Load data
		$data = $this->getData(array(
				'game_id' => true,
				'user_id' => true,
				'Land' => true,
				'CurrentTurnData' => true,
				'BuildingData'	=> true,
		));

		$lastBuy = Buy::userLastBuy($data['game']->getGameId(), $data['user']->getUserID());
		
		return $this->renderAjax('lastbuy', [
				'Land'				=> $data['land'],
				'BuildingData'		=> $data['buildingData'],
				'CurrentTurnData'	=> $data['currentTurnData'],
				'lastBuy'			=> $lastBuy,
		]);
	}
	
	/**
	 *
	 * @return string
	 */
	public function actionIncome(){
		// Load data
		$data = $this->getData(array(
				'game_id' => true,
				'user_id' => true,
				'GameData' => true,
		));
	
		$incomeLand 	= GameData::GoldGameDataUser($data['gameData'], $data['game']->getGameId(), $data['user']->getUserID(), null, 0);
		$incomeBuilding = Building::getUserIncomeByBuildings($data['gameData'], $data['user']->getUserID());
		
		return $this->renderAjax('income', [
				'incomeLand'	=> $incomeLand,
				'incomeBuilding'=> $incomeBuilding,
		]);
	}
}
