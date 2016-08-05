<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\Html;
use app\search\GameSearch;
use app\search\GamePlayerSearch;
use app\forms\game\GameCreateForm;
use app\forms\game\GameJoinForm;
use app\models\Game;
use app\models\GamePlayer;
use app\models\Color;
use app\models\Continent;
use app\models\Land;
use app\models\Resource;
use app\models\GameData;
use app\models\Map;
use app\models\Turn;
use app\models\Users;
use app\classes\Access;
use app\assets\AppAsset;
use yii\base\Object;
use app\models\Frontier;
use app\models\Building;
use app\models\Chat;
use app\models\ChatRead;

class GameController extends \yii\web\Controller
{

	public $refreshTime = 1800;

	public function behaviors()
	{
		return [
				'access' => [
						'class' => AccessControl::className(),
						'rules' => [
								[
										'actions' => ['map', 'diplomacy', 'news', 'stats'],
										'allow' => Access::UserIsInStartedGame(), // Into a started game
								],
								[
										'actions' => ['quit', 'lobby', 'start', 'chat', 'mail'],
										'allow' => Access::UserIsInGame(), // Into a game
								],
								[
										'actions' => ['index', 'join', 'spec', 'create', 'return', 'clean'],
										'allow' => Access::UserIsConnected(), // Outer game
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
	 *
	 * {@inheritDoc}
	 * @see \yii\base\Controller::actions()
	 */
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
	 * @return boolean
	 */
	public function checkOwner()
	{
		if(Yii::$app->session['Game']->getGameOwnerID() == Yii::$app->session['User']->getId())
			return true;
		else{
			//Yii::t('game', 'Error_Not_Owner');
			return false;
		}

	}

	/**
	 *
	 * @param unknown $game_id
	 * @return boolean
	 */
	public function checkStarted($game_id)
	{
		if((new Game)->getGameById($game_id)->getGameStatut() >= 50)
			return true;
		else
			return false;
	}

	/**
	 *
	 * @return string
	 */
	public function getJSConfig(){
		return SiteController::getJSConfig();
	}

    /**
     *
     * @return \app\models\GamePlayer|NULL
     */
    public function updateUserLobby(){
    	// Users
    	$gamePlayer 	= new GamePlayer();

    	// Get url update
    	$region_id = null;
    	$statut = null;
    	$color_id = null;
    	if(array_key_exists('ui', Yii::$app->request->queryParams)){
    		if(array_key_exists('ri', Yii::$app->request->queryParams)){
    			$region_id = Yii::$app->request->queryParams['ri'];
    		}elseif(array_key_exists('si', Yii::$app->request->queryParams)){
    			$statut = Yii::$app->request->queryParams['si'];
    		}elseif(array_key_exists('ci', Yii::$app->request->queryParams)){
    			$color_id = Yii::$app->request->queryParams['ci'];
    		}
    	}

    	// Update in bd
    	$gamePlayer->updateGamePlayerById(Yii::$app->session['User']->getId(), Yii::$app->session['Game']->getGameId(), $region_id, $color_id, $statut);

    	// Clear url & go to lobby
    	return $this->redirect(Url::to(['game/lobby']),302);
    }

    /**
     *
     */
    public function setSessionDataNull(){
    	Yii::$app->session['Contient'] = null;
    	Yii::$app->session['Land'] = null;
    	Yii::$app->session['Resource'] = null;
    	Yii::$app->session['Map'] = null;
    	Yii::$app->session['Color'] = null;
    	Yii::$app->session['Frontier'] = null;
    	Yii::$app->session['Building'] = null;
    	Yii::$app->session['MapData'] = null;
    	Yii::$app->session['Game'] = null;
    }

    /**
     *
     * @param unknown $game_current
     */
    public function updateSessionData($game_current){
    	//Yii::$app->session['Land'] = null; //uncomment for debug / comment for optimization
    	if(Yii::$app->session['Contient'] == null)	Yii::$app->session->set("Continent", Continent::findAllContinentToArray($game_current->getMapId()));
    	if(Yii::$app->session['Land'] == null)		Yii::$app->session->set("Land", Land::findAllLandsToArray($game_current->getMapId()));
    	if(Yii::$app->session['Resource'] == null)	Yii::$app->session->set("Resource", Resource::findAllResourcesToArray());
    	if(Yii::$app->session['Map'] == null)		Yii::$app->session->set("Map", Map::findMapById($game_current->getMapId()));
    	if(Yii::$app->session['Color'] == null)		Yii::$app->session->set("Color", Color::findAllColorToArray());
    	if(Yii::$app->session['Frontier'] == null)	Yii::$app->session->set("Frontier", Frontier::findAllFrontier($game_current->getMapId()));
    	if(Yii::$app->session['Building'] == null)	Yii::$app->session->set("Building", Building::findAllBuildingToArray());
    }

    /**
     *
     * @param unknown $game_current
     */
    public function addDataToSession($game_current){
    	$this->updateSessionData($game_current);
    	$data = $this->getGameData();
    	$user_unread_chat = Chat::countUserUnReadChat($game_current->getGameId(), Yii::$app->session['User']->getUserID());

    	// Add header info to session
    	Yii::$app->session['MapData'] = array(
    			'RefreshTime'		=> $this->refreshTime,
    			'GamePlayer'		=> $data['GamePlayer'],
    			'LastTurnData'		=> Turn::getLastTurnByUserId(Yii::$app->session['User']->getUserID(), $game_current->getGameId()),
    			'CurrentTurnData'	=> $data['TurnData'],
    			'GameData'			=> $data['GameData'],
    			'UserData'			=> $data['UserData'],
    			'RefreshTime'		=> $this->refreshTime,
    			'UserUnReadChat'	=> $user_unread_chat,
    	);
    }

    /**
     *
     * @return unknown[]|\app\classes\GameClass[]
     */
    public function getGameData(){
    	// Initialization
    	$game_player 	= new GamePlayer();
    	$game_data		= new GameData();
    	$turn_data		= new Turn();
    	$frontier_data	= new Frontier();
    	$game_current 	= Game::getGameById(Yii::$app->session['Game']->getGameId());

    	// Datas
    	$gamePlayerDataGlobal 	= $game_player::findAllGamePlayer($game_current->getGameId());
    	$gamePlayerData 		= $game_player::findAllGamePlayerToArrayWithData($gamePlayerDataGlobal);
    	$gamePlayerData[0]		= $game_player::findPlayerZero();
    	$gamePlayerData[-1]		= $game_player::findPlayerUnknown();
    	$gameData				= $game_data::getGameDataByIdToArray($game_current->getGameId());
    	$turnData				= $turn_data::getLastTurnByGameId($game_current->getGameId());
    	$userData 				= $game_player::findAllGamePlayerToListUserId($gamePlayerDataGlobal);
    	$userData[0]			= $game_player::findUserZero();
    	$userData[-1]			= $game_player::findUserUnknown();
    	$userFrontierData		= $frontier_data::userHaveFrontierLandArray($gameData, Yii::$app->session['User']->getUserID(), Yii::$app->session['Frontier']);

    	// Return
    	return array(
    			'Game'			=> $game_current,
    			'GamePlayer'	=> $gamePlayerData,
    			'GameData'		=> $gameData,
    			'TurnData'		=> $turnData,
    			'UserData'		=> $userData,
    			'FrontierData'	=> $userFrontierData,
    	);
    }

    /**
     *
     * @return string
     */
    public function actionIndex()
    {
    	$searchModel = new GameSearch();
    	$dataProvider = $searchModel->search(['query' => Yii::$app->request->queryParams,]);
    	return $this->render('index', [
    			'searchModel'   => $searchModel,
    			'dataProvider'  => $dataProvider,
    	]);
    }

    /**
     *
     * @return string
     */
    public function actionChat()
    {
    	// Get data
    	$dataArray = $this->getGameData();

    	// Chat data
    	$user_unread_chat = Chat::countUserUnReadChat($dataArray['Game']->getGameId(), Yii::$app->session['User']->getUserID());
    	$chatData = Chat::getGameChatToArray($dataArray['Game']->getGameId(), null, 50);

    	// Data to map
    	return $this->render('chat', [
    			'User' 			=> Yii::$app->session['User'],
    			'Color'			=> Yii::$app->session['Color'],
    			'Game' 			=> $dataArray['Game'],
    			'GamePlayer' 	=> $dataArray['GamePlayer'],
    			'Users'			=> $dataArray['UserData'],
    			'RefreshTime'	=> $this->refreshTime,
    			'ChatData'		=> $chatData,
    			'UnReadUser'	=> $user_unread_chat,
    	]);
    }

    /**
     *
     * @return string
     */
    public function actionMail()
    {
    	return $this->render('mail');
    }

    /**
     *
     * @return string
     */
    public function actionNews()
    {
    	return $this->render('news');
    }

    /**
     *
     * @return string
     */
    public function actionStats()
    {
    	return $this->render('stats');
    }

    /**
     *
     * @return string
     */
    public function actionDiplomacy()
    {
    	return $this->render('diplomacy');
    }

    /**
     *
     * @return string
     */
    public function actionLobby(){
    	if(isset(Yii::$app->session['Game'])){
    		if(!$this->checkStarted(Yii::$app->session['Game']->getGameId())){
		    	// Continent
		    	$continents 		= new Continent();
		    	$continentsSQL		= $continents->findAllContinent(Yii::$app->session['Game']->getMapId(), 0);
		    	$continentsArray 	= $continents->findAllContinentToArray(Yii::$app->session['Game']->getMapId());

		    	// Color
		    	$colors 			= new Color();
		    	$colorsSQL			= $colors->findAllColor(0);
		    	$colorsArray 		= $colors->findAllColorToArray();

		    	// Users
		    	$gamePlayer 		= new GamePlayer();
		    	$usersArray			= $gamePlayer->findAllGamePlayerToListUserId(null, Yii::$app->session['Game']->getGameId());

		    	// Update data
		    	if(array_key_exists('ui', Yii::$app->request->queryParams))
		    		$this->updateUserLobby();

		    	$searchModel = new GamePlayerSearch(Yii::$app->session['Game']->getGameId());
		        $dataProvider = $searchModel->search(['query' => Yii::$app->request->queryParams,]);
		        return $this->render('lobby', [
		            'searchModel'   => $searchModel,
		            'dataProvider'  => $dataProvider,
		        	'userList'		=> $usersArray,
		        	'colorList'		=> $colorsArray,
		        	'colorSQl'		=> $colorsSQL,
		        	'continentList'	=> $continentsArray,
		        	'continentSQl'	=> $continentsSQL,
		        ]);
    		}else
    			return $this->actionStart();
    	}else
    		return $this->actionIndex();
    }

		/**
     *
     * @return string
     */
    public function actionQuit()
    {
    	// DB
			(new GamePlayer())->gameExitPlayer(Yii::$app->session['User']->getId(), Yii::$app->session['Game']->getGameId());

    	// Session
    	$this->setSessionDataNull();
    	Yii::$app->session->setFlash('info', Yii::t('game', 'Notice_Game_Quit'));

    	return $this->actionIndex();
    }

		/**
     *
     * @return string
     */
    public function actionClean()
    {
    	// DB
			$gamePlayer = new GamePlayer();
			$userGamesList = $gamePlayer->findAllUserGameId(Yii::$app->session['User']->getId());
			foreach ($userGamesList as $userGame) {
				$gamePlayer->gameExitPlayer(Yii::$app->session['User']->getId(), $userGame->game_player_game_id);
			}
    	// Session
    	$this->setSessionDataNull();
    	Yii::$app->session->setFlash('info', Yii::t('game', 'Notice_Games_Quit'));

    	return $this->actionIndex();
    }

    /**
     *
     * @return string
     */
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

		/**
     *
     * @return string
     */
    public function actionJoin()
    {
    	$urlparams = Yii::$app->request->queryParams;
    	if (array_key_exists('gid', $urlparams)) {
			// Game Data
			$gameData = (new Game())->getGameById($urlparams['gid']);

			if($gameData != null){
				// Checks
				$game_player = new GamePlayer();

				// If already enter in this game
				if($game_player->findUserGameIdIfExited(Yii::$app->session['User']->getId(), $urlparams['gid']) != null){
					$game_player->updateEnterInGame(Yii::$app->session['User']->getId(), $urlparams['gid']);
					$game_player->userJoinGame($gameData, Yii::$app->session['User']->getId(), true);
					Yii::$app->session->setFlash('success', Yii::t('game', 'Success_Game_Join'));
					return $this->actionLobby();
					// If never joined in this game
				}else if($game_player->findUserGameId(Yii::$app->session['User']->getId()) == null){
					// Max player
					if($gameData->getGamePlayerMax() < (new Game())->getGameCountPlayer($urlparams['gid'])+1){
						Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Game_Full'));
						return $this->actionLobby();
					}else{
						// all inputs are valid
						$model = new GameJoinForm($gameData);

						// Confirm
						if($model->join())
							Yii::$app->session->setFlash('success', Yii::t('game', 'Success_Game_Join'));
							else
								Yii::$app->session->setFlash('error', Yii::t('game', 'Success_Game_Join'));
						return $this->actionLobby();
					}
				// In another game
				}else{
					$button_Last_Game_Enter = Html::a("<p class='btn btn-success'>".Yii::t('game', 'Button_Last_Game_Enter')."</p>", ['/game/return'], ['style' => "text-decoration: none;"]);
					$button_Games_Quit = Html::a("<p class='btn btn-warning'>".Yii::t('game', 'Button_Games_Quit')."</p>", ['/game/clean'], ['style' => "text-decoration: none;"]);
					Yii::$app->session->setFlash('error', Yii::t('game', 'Error_User_Already_In_Game')." ".$button_Last_Game_Enter." ".$button_Games_Quit);
					return $this->redirect(Url::to(['game/index']),302);
				}
			}else
				return $this->actionIndex();
    	}elseif(isset($model)){
    		// validation failed: $errors is an array containing error messages
    		Yii::$app->session->setFlash('error', Yii::t('game', 'Success_Game_Join'));
    		$errors = $model->errors;
    		return $this->redirect(Url::to(['game/index']),302);
    	}else
    		return $this->redirect(Url::to(['game/index']),302);
    }

		/**
     *
     * @return string
     */
    public function actionReturn()
    {
    	$urlparams = Yii::$app->request->queryParams;
			$gamePlayer = new GamePlayer();
			$game_player = $gamePlayer->findUserGameId(Yii::$app->session['User']->getId());
			if ($game_player != null) {
				if ($game_player->game_player_game_id > 0) {
					Yii::$app->getSession()->setFlash('info', Yii::t('game', 'Notice_Last_Game_Entered'));
					return $this->redirect(array('game/join', 'gid' => $game_player->game_player_game_id), 302);
				} else {
					Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Last_Game_Cant_Join')." n°".$game_player->game_player_game_id);
					return $this->redirect(Url::to(['game/index']),302);
				}
			} else {
				Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Last_Game_Cant_Join')." n°".$game_player->game_player_game_id);
				return $this->redirect(Url::to(['game/index']),302);
			}
    }

    /**
     *
     * @return string
     */
    public function actionSpec()
    {
    	if(false){
	    	$urlparams = Yii::$app->request->queryParams;
	    	if(array_key_exists('gid', $urlparams))
	    		$model = new GameJoinForm((new Game())->getGameById($urlparams['gid']));
	    		if (isset($model) && $model->joinSpec()) {
	    			// all inputs are valid
	    			Yii::$app->session->setFlash('success', Yii::t('game', 'Success_Game_Join'));
	    			return $this->actionLobby();
	    		}elseif(isset($model)){
	    			// validation failed: $errors is an array containing error messages
	    			Yii::$app->session->setFlash('error', Yii::t('game', 'Success_Game_Join'));
	    			$errors = $model->errors;
	    			return $this->actionIndex();
	    		}else
	    			return $this->actionIndex();
    	}
    	return $this->actionIndex();
    }

    /**
     *
     * @return string
     */
    public function actionStart(){
    	// The game as started
    	$urlparams = Yii::$app->request->queryParams;
    	$started = $this->checkStarted(Yii::$app->session['Game']->getGameId());
    	if($started || ($this->checkOwner() && array_key_exists('gid', $urlparams))){

    		// if the owner push the start button
    		if($this->checkOwner() && !$started){
		    	if (array_key_exists('gid', $urlparams)) {

			    	// Initialization
		    		$game_player 	= new GamePlayer();
		    		$game_current 	= (new Game())->getGameById($urlparams['gid']);
		    		$land		 	= new Land();
		    		$res		 	= new Resource();
		    		$game_data		= new GameData();
		    		$turn			= new Turn();
		    		$continentData	= (new Continent())->findAllContinentToArray($game_current->getMapId());
		    		$mapData		= (new Map())->findMapById($game_current->getMapId());

		    		// Datas
		    		$resourceData 	= $res->findAllResourcesToArray();
		    		$landData		= $land->findAllLandsToArray($game_current->getMapId());
			    	$gamePlayerData = $game_player->findAllGamePlayer($game_current->getGameId());

			    	// Checks
			    	if($gamePlayerData != null){
			    		// check colors
			    		if($game_player->checkPlayerColor($gamePlayerData)){
			    			// Check ready
			    			if($game_player->checkPlayerReady($gamePlayerData)){
			    				// Assign Lands
			    				$assignedLands 		= $land->assignLandsToArray($gamePlayerData, $game_current, $continentData, $mapData);

			    				// Assign Resources
			    				$assignedResources 	= $res->assignResourcesToArray($landData, $resourceData);

			    				// Create Game Data
			    				$gameData = $game_data->createGameData($assignedLands, $assignedResources, $landData, $game_current);

						    	// Create turn order
						    	$gameTurnOrder 		= $game_player->updateUserTurnOrder($game_current->getGameId());

						    	// Create first turn
						    	$turn->createGameFirstTurn($game_current->getGameId() , array_values($gameTurnOrder)[0]->getUserID(), $gameData);

						    	// Update Game statut
						    	(new Game())->updateGameStatut($game_current->getGameId(), 50);
						    	Yii::$app->session['Game']->setGameStatut(50);

			    				return $this->render('start');
			    			}else
			    				Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Start_Not_Ready'));
			    		}else
			    			Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Start_Multiple_Color'));
			    	}else
			    		Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Start_Stop'));
		    	}else
		    		Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Start_Stop'));

		    	return $this->redirect(Url::to(['game/lobby']),302);
	    	}
	    	Yii::$app->session['Game']->setGameStatut(50);
	    	return $this->render('start');
    	}else
    		return $this->actionLobby();
    }


    /**
     *
     * @return string
     */
    public function actionMap(){
    	// Create 1rst turn
    	// Check if a turn exist

    	// The game as started
    	if($this->checkStarted(Yii::$app->session['Game']->getGameId())){
    		//$urlparams 		= Yii::$app->request->queryParams;

    		// Session
    		$this->updateSessionData(Yii::$app->session['Game']);

	    	// Get data
	    	$dataArray = $this->getGameData();

	    	// Data to map
	    	return $this->render('map', [
	    			'User' 			=> Yii::$app->session['User'],
	    			'Resource' 		=> Yii::$app->session['Resource'],
	    			'Continent' 	=> Yii::$app->session['Contient'],
	    			'Map' 			=> Yii::$app->session['Map'],
	    			'Land'			=> Yii::$app->session['Land'],
	    			'Color'			=> Yii::$app->session['Color'],
	    			'Frontier'		=> Yii::$app->session['Frontier'],
	    			'Building'		=> Yii::$app->session['Building'],
	    			'Game' 			=> $dataArray['Game'],
	    			'GamePlayer' 	=> $dataArray['GamePlayer'],
	    			'GameData' 		=> $dataArray['GameData'],
	    			'Turn' 			=> $dataArray['TurnData'],
	    			'Users'			=> $dataArray['UserData'],
	    			'UserFrontier'	=> $dataArray['FrontierData'],
	    			'RefreshTime'	=> $this->refreshTime,
	    	]);
    	}else
    		return $this->actionLobby();
    }
}
