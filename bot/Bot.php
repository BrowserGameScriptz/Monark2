<?php

namespace app\bot;

use Yii;
use app\models\Fight;

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
	public $pc_build_id;
	public $frt_build_id;
	public $frt_multiplier;
	public $pc_multiplier;
	
	// Execute action
	public $bot_action;

	// test
	public $bot_log;
	
	/**
     * Call all the BOT function and get the required informations
     *
     * @param  integer gameid, bot_id, gold
     * @return void
     */
	public function __construct($game_id, $bot_id, $test=null){
		/* INIT */
		$this->bot_log 					= new BotLog($this, $test);
		$this->bot_log->botAddActionBegin("Init");
		
		// GET Info
		$this->game_id 					= $game_id;
		$this->bot_id 					= $bot_id;

		$this->atk_max_units			= Fight::$AttakerMaxUnits;
		$this->def_max_units			= Fight::$DefenderMaxUnits;
		$this->bonus_fort				= Fight::$FortBonusUnits;
		$this->bonus_camp				= Fight::$CampBonusUnits;

		// Set informations
		$this->units_point 				= 1;
		$this->pc_build_id				= 2;
		$this->pc_multiplier			= 1.5;
		$this->frt_build_id				= 1;
		$this->frt_multiplier			= 1.5;
		
		$this->bot_log->botAddEndAction("Init");
		
		/* INIT end */
		
		$this->botGetData();

		$this->botGetEvaluations();
		
		$this->botDoActions();
		
		$this->botEnd();
	}
	
	// Date
	private function botGetData(){
		$this->bot_data 		= new BotData($this);
	}
	
	// Evaluations
	private function botGetEvaluations(){
		$this->bot_eval 			= new BotEval($this);
		$this->bot_eval->BotEvalPlayer();
		$this->bot_eval->BotInitEvalLand();
		$this->bot_eval_player		= $this->bot_eval->eval_player;
		$this->bot_eval_land		= $this->bot_eval->eval_land;
	}
	
	private function botDoActions(){
		$this->bot_action			= new BotAction($this);
		$this->bot_action->BotInitActionLand();
		$this->bot_action->BotEndTurn();
	}
	
	private function botEnd(){
		if($test)
			print $this->bot_log->botShowLogs();
	}
}