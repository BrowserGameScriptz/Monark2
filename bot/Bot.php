<?php

namespace app\models;

use Yii;
use yii\db\Query;

use app\models\Difficulty;

use app\models\Building;
use app\models\Frontier;
use app\models\Game;
use app\models\GameData;
use app\models\GamePlayer;
use app\models\Harbor;
use app\models\Ressource;
use app\models\Turn;

use app\models\Buy;
use app\models\Fight;
use app\models\Move;
use app\models\Pact;
use app\models\Spy;

/**
 * This is the model class for bot gestion.
 *
 */

class Bot extends \yii\base\Object
{
	/* Basic info */
	private $game_id;
	private $bot_id;
	private $pc_build_id;
	private $frt_build_id;

	/* Array SQL Info */
	private $allland_owned;

	/* Eval Array */
	private $eval_player;
	private $eval_land;
	private $eval_action;

	/* Evaluation informations */
	private $bot_difficulty_data;
	private $units_point;
	private $atk_max_units;
	private $def_max_units;
	private $bonus_fort;
	private $bonus_camp;
	private $ressource_gold_point;
	private $ressource_silver_point;
	private $ressource_bronze_point;
	private $marge_frt;
	private $marge_pc;
	private $build_mine;

	/* Execute action */
	private $bot_need_units_atk_percent;
	private $bot_need_units_def_percent;
	private $bot_atk_percent;
	private $bot_def_percent;
	private $bot_build_percent;


	/**
     * Call all the BOT function and get the required informations
     *
     * @param  integer gameid, bot_id, gold
     * @return void
     */
	public function BotStartTurn($game_id, $bot_id, $test=null){
		// TURN Begin
		// GET Info
		$this->game_id 				= $game_id;
		$this->bot_id 				= $bot_id;

		$this->atk_max_units		= Fight::$AttakerMaxUnits;
		$this->def_max_units		= Fight::$DefenderMaxUnits;
		$this->bonus_fort			= Fight::$FortBonusUnits;
		$this->bonus_camp			= Fight::$CampBonusUnits;

		// Set informations
		$this->units_point 				= 1;
		$this->ressource_gold_point 	= 3;
		$this->ressource_silver_point 	= 2;
		$this->ressource_bronze_point 	= 1;

		/* Evaluations */
		/*$this->ftrs_point 					= $this->bot_difficulty_data['rate_atk_frt'];
		$this->pc_point 					= $this->bot_difficulty_data['rate_def_pc'];
		$this->bot_need_units_atk_percent 	= $this->bot_difficulty_data['rate_units_atk'];
		$this->bot_need_units_def_percent 	= $this->bot_difficulty_data['rate_units_def'];	
		$this->marge_frt 					= $this->bot_difficulty_data['marge_frt'];
		$this->marge_pc 					= $this->bot_difficulty_data['marge_pc'];
		$this->build_mine 					= $this->bot_difficulty_data['build_mine'];
		$this->bot_atk_percent 				= $this->bot_difficulty_data['rate_exec_atk'];
		$this->bot_def_percent 				= $this->bot_difficulty_data['rate_exec_def'];
		$this->bot_build_percent 			= $this->bot_difficulty_data['rate_exec_build'];*/

		// Players
		//$this->BotEvalPlayer();
		// Lands
		//$this->BotEvalLand();
		
		/* Actions */
		// Execute actions
		//$this->BotEvalAction();

		/*print "<pre>";
		print_r($this->allland_owned);
		print "</pre>";*/

		//print $this->turn_data['id'];

		/* TURN END */
		//if($test == null){
			//$this->BotEndTurn();
		//}
	}
	
	
	
	
	
	
	
	
	
	
	
	
}