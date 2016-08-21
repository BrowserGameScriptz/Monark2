<?php 
namespace app\bot;
use yii\base\Object;
use app\models\Turn;

class BotAction extends \yii\base\Object
{
	private $bot;
	private $ennemyLandSortedByThreatNegative;
	private $ennemyLandSortedByThreatPositive;
	private $maxAtkByDifficulty;
	
	public function __construct($bot){
		$this->bot								= $bot;
		$this->ennemyLandSortedByThreatNegative = $this->bot->bot_eval_land['ennemy']['threat']['negative'];
		$this->ennemyLandSortedByThreatPositive = $this->bot->bot_eval_land['ennemy']['threat']['positive'];
	}
	
	/**
	 * 
	 */
	public function BotInitActionLand(){
		$this->bot->bot_log->botAddActionBegin("Init Action Land");
		
		// Sort
		array_multisort($this->bot->bot_eval_land['ennemy']['threat']['negative'], SORT_DESC, $this->ennemyLandSortedByThreatNegative);
		array_multisort($this->bot->bot_eval_land['ennemy']['threat']['positive'], SORT_DESC, $this->ennemyLandSortedByThreatPositive);
		
		$this->BotEnnemyLandAction();
		$this->BotOwnLandAction();
		$this->bot->bot_log->botAddEndAction("Init Action Land");
	}
	
	/**
	 *
	 * @param GameDataClass $ownLandData
	 * @param array $ownFrontierLandData
	 */
	private function BotOwnLandAction(){
		$this->BotOwnLandBuy();
		$this->BotOwnLandBuild();
		$this->BotOwnLandMove();
	}
	
	private function BotOwnLandBuy(){
	
	}
	
	private function BotOwnLandBuild(){
	
	}
	
	private function BotOwnLandMove(){
	
	}
	
	private function BotEnnemyLandAction(){
		
	}
	
	/**
	 * End the Turn of the BOT
	 *
	 * @param  void
	 * @return void
	 */
	public function BotEndTurn(){
		/* Pause */
		//sleep(2);
		$this->bot->bot_log->botAddActionBegin("End of turn");
		/* Next turn */
		Turn::NewTurn($this->bot->game_id, $this->bot->bot_id, $this->bot->bot_data->gameData);
		$this->bot->bot_log->botAddEndAction("End of turn");
	}
}
?>