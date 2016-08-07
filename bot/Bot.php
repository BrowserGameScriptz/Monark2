<?php

namespace app\bot;

use Yii;
use app\models\Fight;
use yii\base\Object;

/**
 * This is the model class for bot gestion.
 *
 */

class Bot extends \yii\base\Object
{
	// Basic
	public $game_id;
	public $bot_id;
	public $bot_data;
	public $pc_build_id;
	public $frt_build_id;

	// Bot Eval
	public $bot_eval;
	public $bot_eval_player;
	public $bot_eval_land;
	public $eval_action;

	// Evaluation data
	public $bot_difficulty_data;
	public $units_point;
	public $atk_max_units;
	public $def_max_units;
	public $bonus_fort;
	public $bonus_camp;
	public $ressource_gold_point;
	public $ressource_silver_point;
	public $ressource_bronze_point;
	public $marge_frt;
	public $marge_pc;
	public $build_mine;

	// Execute action
	public $bot_need_units_atk_percent;
	public $bot_need_units_def_percent;
	public $bot_atk_percent;
	public $bot_def_percent;
	public $bot_build_percent;


	/**
     * Call all the BOT function and get the required informations
     *
     * @param  integer gameid, bot_id, gold
     * @return void
     */
	public function __construct($game_id, $bot_id, $test=null){
		/* INIT */
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

		/* INIT end */
		
		// DATA
		$this->bot_data 		= new BotData($this); 
		
		// Set Configuration
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

		// Evaluations
		$this->bot_eval 			= new BotEval($this);
		$this->bot_eval_player		= $this->bot_eval->BotEvalPlayer();
		$this->bot_eval_land		= $this->bot_eval->BotEvalLand()->eval_land;
	}
	
	
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