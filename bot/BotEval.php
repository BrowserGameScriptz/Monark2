<?php 
namespace app\bot;
class BotEval extends \yii\base\Object
{
	private $bot;
	public $eval_land;
	
	public function __construct($bot){
		$this->bot = $bot;
	}
	
	/**
	 * Eval all the differents player to determinate a mark per player --> lvl of threat
	 *
	 * @param  void
	 * @return object var array eval_player full
	 */
	public function BotEvalPlayer(){
		$this->eval_player 		= array();
	}
	
	/**
	 * Eval all the differents land in frontier of all of him to determinate a mark per frontier land --> lvl of threat
	 *
	 * @param  void
	 * @return object var array eval_land full
	 */
	public function BotEvalLand(){
		$this->eval_land 		= array();
		$i 	= 0;
		$n 	= 0;
		$u 	= 0;
	
		/* GET INFORMATIONS OF FRONTIERS LANDS */
		/* Search all the lands owned by the bot */
		foreach ($this->game_data as $key => $value) {
			if($value['user_id'] == $this->bot_id){
				$this->allland_owned[$i] = array(
						'land_info' 	=> $this->game_data[$value['land_id']],
						'frontier'		=> "",
						'only_own_front'=> "",
				);
				$i++;
			}
		}
	
		/* Search Info Land Frontier */
		foreach ($this->allland_owned as $key => $value) {
			$u = 0;
			foreach ($this->frontier_data as $key => $frontier) {
	
				/* If this land have frontier with a bot land */
				if($frontier['land_id_one'] == $value['land_info']['land_id']){
	
					/* An ennemy land */
					if($this->game_data[$frontier['land_id_two']]['user_id'] != $this->bot_id){
	
						$this->allland_owned[$n]['frontier'][$u] = array(
								'land_frontier_data' 	=> $this->game_data[$frontier['land_id_two']],
						);
	
						/* An Owned bot land */
					}else{
						$this->allland_owned[$n]['frontier'][$u] = array(
								'land_frontier_data' 	=> $this->game_data[$frontier['land_id_two']],
						);
					}
					$u++;
				}
			}
			$n++;
		}
		/* END GET INFORMATIONS OF FRONTIERS LANDS */
	
	}

	
	/**
	 * Eval all the differents per lands --> lvl of necessity
	 *
	 * @param  void
	 * @return object var array eval_action full
	 */
	public function BotEvalAction(){
		$count_own_land 			= count($this->allland_owned);
		$attack_array				= array();
		$defense_array				= array();
		$build_array				= array();
	
		foreach ($this->allland_owned as $key => $bot_land) {
				
			/* Frontier initialisation */
			$only_own_land_frontier 	= 0;
			$count_frontier 			= count($bot_land['frontier']);
			$most_need_def_land_id		= 0;
			$n = 0;
	
			/**** All frontier ****/
			foreach ($bot_land['frontier'] as $key => $bot_land_frontier) {
				/* Land frontier initialisation */
				$land_id_atk 	= $bot_land_frontier['land_frontier_data']['land_id'];
				$land_id_bot	= $bot_land['land_info']['land_id'];
	
				$bot_own_land_buildings = array();
				if($this->game_data[$land_id_bot]['buildings'] != "")
					$bot_own_land_buildings	= explode(';', $this->game_data[$land_id_bot]['buildings']);
	
					/* Ressource */
					if(isset($this->ressources_data[$this->game_data[$land_id_bot]['ressource_id']]) && !in_array($this->ressources_data[$this->game_data[$land_id_bot]['ressource_id']]['building_id'], $bot_own_land_buildings)){
						$b_array = array(
								'cost' 			=> $this->building_data[$this->ressources_data[$this->game_data[$land_id_bot]['ressource_id']]['building_id']]['cost'],
								'building_id' 	=> $this->ressources_data[$this->game_data[$land_id_bot]['ressource_id']]['building_id'],
								'land_id' 		=> $bot_land['land_info']['land_id'],
						);
						array_push($build_array, $b_array);
					}
	
	
					/* A not own bot land */
					if($bot_land_frontier['land_frontier_data']['user_id'] != $this->bot_id){
							
						/* Eval Atk & Def */
						$atk_info = $this->BotEvalAtkLand($this->game_data[$land_id_bot], $this->game_data[$land_id_atk]);
						$def_info = $this->BotEvalDefLand($this->game_data[$land_id_bot], $this->game_data[$land_id_atk]);
	
						/* Prepare Atk */
						$atk_array = array(
								'attackable' 	=> $atk_info['attackable'],
								'units' 		=> $atk_info['need_atk'],
								'land_id' 		=> $bot_land['land_info']['land_id'],
								'land_id_atk' 	=> $bot_land_frontier['land_frontier_data']['land_id'],
						);
						array_push($attack_array, $atk_array);
	
						/* Prepare Defense */
						$def_array = array(
								'danger' 		=> $def_info['danger'],
								'units' 		=> $def_info['need_def'],
								'land_id' 		=> $bot_land['land_info']['land_id'],
								'land_id_def' 	=> $bot_land_frontier['land_frontier_data']['land_id'],
						);
						array_push($defense_array, $def_array);
	
						/* An own bot land */
					}else{
						$only_own_land_frontier++;
					}
	
					$n++;
			}
			/**** End All frontier ****/
			 	
			/* If only owned front land */
			if($only_own_land_frontier == $count_frontier){
				$this->allland_owned[$n]['only_own_front'] = 1;
	
				/* Move only owned land in frontier */
				if($bot_land['land_info']['units'] > 1){
					// Verification
					if($most_need_def_land_id == 0){
						$most_need_def_land_id_rand = rand(1, $count_frontier) - 1;
						$most_need_def_land_id 		= $bot_land['frontier'][$most_need_def_land_id_rand]['land_frontier_data']['land_id'];}
	
						// Move units
						$this->BotStartAction("move", $bot_land['land_info']['land_id'], $this->game_data[$bot_land['land_info']['land_id']]['units']-1, $most_need_def_land_id);
				}
			}else{
				$this->allland_owned[$n]['only_own_front'] = 0;
			}
		}
	
		// Sort array by priority
		array_multisort($attack_array, SORT_ASC);
		array_multisort($defense_array, SORT_DESC);
		array_multisort($build_array, SORT_DESC);
	
		/*print "<pre>";
			//print_r($attack_array);
			print_r($defense_array);
			print "</pre>";*/
	
		/********* Actions ********/
		/*** Def ***/
		$count_def = ceil(count($defense_array) * ($this->bot_def_percent/100));
		for ($i=0; $i < $count_def; $i++) {
			if($this->game_data[$defense_array[$i]['land_id_def']]['user_id'] != $this->bot_id){
				/* Eval Forteress */
				$bot_own_land_buildings = array();
				if($this->game_data[$attack_array[$i]['land_id']]['buildings'] != "")
					$bot_own_land_buildings	= explode(';', $this->game_data[$attack_array[$i]['land_id']]['buildings']);
	
					// If not have one
					if(!in_array($this->frt_build_id, $bot_own_land_buildings)){
						// If build a frt
						if($defense_array[$i]['units'] > ((1 + $this->marge_pc/100) * $this->game_data[$defense_array[$i]['land_id']]['units']) AND $this->turn_gold > $this->building_data[$this->frt_build_id]['cost']){
							$this->BotStartAction("build", $defense_array[$i]['land_id'], "", "", $this->frt_build_id);
						}
					}
	
					$this->BotStartAction("buy", $defense_array[$i]['land_id'], $defense_array[$i]['units'] - $this->game_data[$defense_array[$i]['land_id']]['units']);
			}
		}
		/*** End Def ***/
	
		/* Build ressources */
		$count_build = ceil(count($build_array) * ($this->bot_build_percent/100));
		for ($i=0; $i < $count_build; $i++) {
			if($this->turn_gold < $build_array[$i]['cost']){
				$this->BotStartAction("build", $build_array[$i]['land_id'], "", "", $build_array[$i]['building_id']);
			}
		}
	
		/*** Atk ***/
		$count_atk = ceil(count($attack_array) * ($this->bot_atk_percent/100));
		for ($i=0; $i < $count_atk; $i++) {
			if($this->game_data[$attack_array[$i]['land_id_atk']]['user_id'] != $this->bot_id){
				/* Eval Preparation Camp */
				$bot_own_land_buildings = array();
				if($this->game_data[$attack_array[$i]['land_id']]['buildings'] != "")
					$bot_own_land_buildings	= explode(';', $this->game_data[$attack_array[$i]['land_id']]['buildings']);
	
					// If not have one
					if(!in_array($this->pc_build_id, $bot_own_land_buildings)){
						// If build a pc
						if($attack_array[$i]['units'] > ((1 + $this->marge_pc/100) * $this->game_data[$attack_array[$i]['land_id']]['units']) AND $this->turn_gold > $this->building_data[$this->pc_build_id]['cost']){
							$this->BotStartAction("build", $attack_array[$i]['land_id'], "", "", $this->pc_build_id);
						}
					}
	
					$this->BotStartAction("atk", $attack_array[$i]['land_id'], $attack_array[$i]['units'], $attack_array[$i]['land_id_atk']);
			}
		}
		/*** End Atk ***/
	
		/* Bonus Gold */
		if($this->turn_gold > 0 AND $count_own_land > 0){
			$units = ($this->turn_gold / $count_own_land) + 1;
			for ($i=0;$i < $count_own_land; $i++) {
				$this->BotStartAction("buy", $this->allland_owned[$i]['land_info']['land_id'], $units);
			}
		}
	
	}
	
	
	/**
	 * Eval the possibilities of atk
	 *
	 * @param  void
	 * @return void
	 */
	public function BotEvalAtkLand($botownlanddata, $botatklanddata, $atkuserdata=null){
		/* Initialisation */
		$bot_atk_land_buildings				= explode(';', $botatklanddata['buildings']);
		$bot_own_land_buildings				= explode(';', $botownlanddata['buildings']);
		$bot_atk_land_buildings_have_ftrs 	= 0;
		$bot_own_land_buildings_have_pc 	= 0;
		$attackable							= 0;
		$need_atk							= 0;
	
		/* Buildings */
		// If user def have frts
		if(in_array(1, $bot_atk_land_buildings)){$bot_atk_land_buildings_have_ftrs = 1;}
		// If bot have pc
		if(in_array(2, $bot_own_land_buildings)){$bot_own_land_buildings_have_pc = 1;}
	
		/* ressources */
		// ressources buildings + just ressources
	
		/* Units */
		$attackable += $this->units_point * $botatklanddata['units'];
		$need_atk 	+= $botatklanddata['units'] * (1 + $this->bot_need_units_atk_percent/100);
	
		// Affect points
		$attackable *= 1 + ($this->ftrs_point * $bot_atk_land_buildings_have_ftrs - $this->pc_point * $bot_own_land_buildings_have_pc)/100;
		$need_atk 	*= 1 + ($this->ftrs_point * $bot_atk_land_buildings_have_ftrs - $this->pc_point * $bot_own_land_buildings_have_pc)/100;
	
		// Return
		return array(
				'attackable'	=> ceil($attackable),
				'need_atk'		=> ceil($need_atk),
		);
	}
	
	
	/**
	 * Eval the possibilities of defend
	 *
	 * @param  void
	 * @return void
	 */
	public function BotEvalDefLand($botownlanddata, $botatklanddata, $atkuserdata=null){
		/* Initialisation */
		$bot_atk_land_buildings				= explode(';', $botatklanddata['buildings']);
		$bot_own_land_buildings				= explode(';', $botownlanddata['buildings']);
		$bot_atk_land_buildings_have_ftrs 	= 0;
		$bot_own_land_buildings_have_pc 	= 0;
		$danger								= 0;
		$need_def							= 0;
	
		// If neutral user
		if($botatklanddata['user_id'] > 0){
			/* Buildings */
			// If user def have frts
			if(in_array(1, $bot_atk_land_buildings)){$bot_atk_land_buildings_have_ftrs = 1;}
			// If bot have pc
			if(in_array(2, $bot_own_land_buildings)){$bot_own_land_buildings_have_pc = 1;}
	
			/* ressources */
			// ressources buildings + just ressources
	
			/* Add points User land atk*/
	
			/* Units */
			$danger 	+= $this->units_point * $botatklanddata['units'];
			$need_def 	+= $botatklanddata['units'] * ($this->bot_need_units_def_percent/100);
	
			// Affect points
			$danger 	*= 1 + ($this->ftrs_point * $bot_atk_land_buildings_have_ftrs - $this->pc_point * $bot_own_land_buildings_have_pc)/100;
			$need_def 	*= 1 + ($this->ftrs_point * $bot_atk_land_buildings_have_ftrs - $this->pc_point * $bot_own_land_buildings_have_pc)/100;
	
			// Return
			return array(
					'danger' 		=> ceil($danger),
					'need_def'		=> ceil($need_def),
			);
		}else{
			// Return
			return array(
					'danger' 		=> 0,
					'need_def'		=> 0,
			);
		}
	}


}
?>