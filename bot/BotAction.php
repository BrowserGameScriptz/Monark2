<?php 
namespace app\bot;
use yii\base\Object;

class BotAction extends \yii\base\Object
{
	private $bot;
	
	public function __construct($bot){
		$this->bot = $bot;
	}
	
	/**
	 * With the previous evaluations realise the best actions
	 *
	 * @param  void
	 * @return void
	 */
	private function BotStartAction($action, $land_id, $units=null, $land_atk_id=null, $build_id=null){
		switch ($action) {
			case 'buy':
				if($this->turn_gold > 0 && $units > 0){
					if($this->turn_gold < $units){
						$gold_buy = $this->turn_gold;}else{
							$gold_buy = $units;}
							$this->BotBuy($land_id, $gold_buy, $this->bot_id);
				}else{
					print "Erreur Case Achat";
					return 1;
				}
				break;
	
			case 'atk':
				if($units > 0 AND $land_atk_id != null){
					if($this->game_data[$land_id]['units'] <= $units){
						if($this->turn_gold >= ($units - $this->game_data[$land_id]['units'])){
							$this->BotStartAction("buy", $land_id, $units - $this->game_data[$land_id]['units']);
						}
					}
					if($units > $this->game_data[$land_atk_id]['units']){
						$this->BotFight($land_id, $land_atk_id, $units, $this->bot_id);
					}elseif ($units == $this->game_data[$land_atk_id]['units']) {
						$fight = $this->BotFight($land_id, $land_atk_id, $units-1, $this->bot_id);
					}
				}else{
					print "Erreur Case Atk";
					return 1;
				}
				break;
	
			case 'move':
				if($units > 0 AND $land_atk_id != null AND $units < $this->game_data[$land_id]['units']){
					$this->BotMove($land_atk_id, $land_id, $units);
					$this->game_data[$land_id]['units'] 	-= $units;
					$this->game_data[$land_atk_id]['units'] += $units;
				}else{
					print "Erreur Case Move";
					return 1;
				}
				break;
	
			case 'build':
				if($build_id > 0 && isset($this->building_data[$build_id])){
					$this->BotBuild($land_id, $build_id);
					$this->game_data[$land_id]['buildings'] .= $build_id.";";
				}else{
					print "Erreur Case Build";
					return 1;
				}
				break;
					
			default:
				# code...
				break;
		}
	}
	
	/**
	 * Create a process of Fight
	 *
	 * @param  void
	 * @return informations of the fight result array
	 */
	private function BotFight($atk_land_id, $def_land_id, $atk_units, $user_id){
		$Fight = new Fight;
		$Fight->FightInformations($this->game_id, $atk_land_id, $def_land_id, $atk_units, $user_id, $this->game_data, $this->frontier_data, $this->turn_data);
		$error = $Fight->FightVerification();
		if($error == ""){
			$result = $Fight->FightStart();
			$this->game_data[$atk_land_id]['units'] = $result['atk_result_units'];
			$this->game_data[$def_land_id]['units'] = $result['def_result_units'];
			if($result['conquest']){$this->game_data[$atk_land_id]['user_id'] = $this->bot_id;}
			return $Fight->FightResult();
		}else{print "Error Fight";}
		/*
		 * nb_fight
		 * def_engage_units
		 * def_result_units
		 * atk_engage_units
		 * atk_result_units
		 * fight_data_id
		 * conquest
		 */
	}
	
	/**
	 * Create a process of Move
	 *
	 * @param  void
	 * @return void
	 */
	private function BotMove($arrived_land_id, $move_land_id, $nb_units){
		$Move = new Move;
		$Move->MoveInformations($this->game_id, $move_land_id, $arrived_land_id, $nb_units, $this->game_data, $this->turn_data);
		$error = $Move->MoveVerification();
		if($error == ""){
			$Move->MoveUpdate();
			$this->game_data[$arrived_land_id]['units'] += $nb_units;
			$this->game_data[$move_land_id]['units'] 	-= $nb_units;
		}else{print "Error Move";}
	}
	
	/**
	 * Create a process of Build
	 *
	 * @param  void
	 * @return void
	 */
	private function BotBuild($build_land_id, $build_id){
		$Build = new Build;
		$Build->BuildInformations($this->game_id, $build_land_id, $build_id, $this->game_data, $this->turn_data);
		$error = $Build->BuildVerification();
		if($error == ""){print $Build->BuildUpdate();}else{print "Error Build";}
	}
	
	/**
	 * Create a process of Buy
	 *
	 * @param  void
	 * @return void
	 */
	private function BotBuy($buy_land_id, $nb_units, $user_id){
		$Buy = new Buy;
		$Buy->BuyInformations($this->game_id, $buy_land_id, $nb_units, $user_id, $this->game_data, $this->turn_data);
		$error = $Buy->BuyVerification();
		if($error == ""){
			$Buy->BuyUpdate();
			$this->game_data[$buy_land_id]['units'] += $nb_units;
			$this->turn_gold 		 -= $nb_units;
			$this->turn_data['gold'] -= $nb_units;
		}else{print "Error Buy";}
	}
	
	/**
	 * Create a process of creation of pact
	 *
	 * @param  void
	 * @return void
	 */
	private function BotPactSend($nb_tr, $receive_user_id, $pact_type){
		$Pact = new Pact;
		$Pact->PactInformations($this->game_id, $this->bot_id, $receive_user_id, $nb_tr, $pact_type, 0, 0, $this->game_player);
		$Pact->PactMessageVerification();
		$Pact->PactMessageCreate();
	}
	
	/**
	 * Create a process of acceptation of pact
	 *
	 * @param  void
	 * @return void
	 */
	private function BotPactAccept($nb_tr, $accept_user_id, $pact_type){
		$Pact = new Pact;
		$Pact->PactInformations($this->game_id, $this->bot_id, $accept_user_id, $nb_tr, $pact_type, 0, 0, $this->game_player);
		$Pact->PactVerification();
		$Pact->PactCreate();
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
	
		/* Next turn */
		Turn::CreateNewTurn($this->game_id);
	}
}
?>