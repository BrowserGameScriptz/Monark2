<?php

namespace app\classes;

use app\models\Building;
use app\models\Fight;

/**
 * This is the model class for fighting simulation.
 *
 */

class FightClass
{
	private $gameData;
	private $atk_max_units;
	private $def_max_units;
	private $bonus_fort;
	private $bonus_camp;
	private $camp_build_id;
	private $fort_build_id;
	private $conquest;
	private $atk_land_id;
	private $atk_user_id;
	private $atk_units_origin;
	private $atk_units;
	private $atk_current_units;
	private $atk_have_camp;
	private $atk_max_unit;
	private $atk_max_unit_final;
	private $def_land_id ;
	private $def_user_id;
	private $def_units_origin;
	private $def_units;
	private $def_current_units;
	private $def_have_fort;
	private $def_max_unit;
	private $def_max_unit_final;
	private $fight_nb;
	
	private $atk_thimble_array;
	private $def_thimble_array;
	private $atk_fighting_units;
	private $def_fighting_units;
	private $atk_thimble_form;
	private $def_thimble_form;
	private $atk_units_form;
	private $def_units_form;
	
	
	public function __construct($atk_land_id, $def_land_id, $atk_units, $game_data)
    {
		// Initialization
		$this->gameData				= $game_data;
    	$this->atk_max_units		= Fight::$AttakerMaxUnits;
    	$this->def_max_units		= Fight::$DefenderMaxUnits;
    	$this->bonus_fort			= Fight::$FortBonusUnits;
    	$this->bonus_camp			= Fight::$CampBonusUnits;
    	$this->camp_build_id 		= Building::$CampId;
    	$this->fort_build_id 		= Building::$FortId;
    	$this->conquest				= 0;
    	
    	// Attaker
    	$this->atk_land_id 			= $atk_land_id;
    	$this->atk_user_id 			= $this->gameData[$this->atk_land_id]->getGameDataUserId();
    	$this->atk_units_origin 	= $atk_units;
    	$this->atk_units 			= $this->atk_units_origin;
    	$this->atk_current_units	= $this->atk_units;
    	$this->atk_have_camp		= (in_array($this->camp_build_id, $this->gameData[$this->atk_land_id]->getGameDataBuildings()))? true : false;
    	$this->atk_max_unit			= ($this->atk_units >= $this->atk_max_units)? $this->atk_max_units : $this->atk_units;
    	$this->atk_max_unit_final	= $this->atk_have_camp*$this->bonus_camp + $this->atk_max_units;
    	
    	// Defender
    	$this->def_land_id 			= $def_land_id;
    	$this->def_user_id 			= $this->gameData[$this->def_land_id]->getGameDataUserId();
    	$this->def_units_origin 	= $this->gameData[$this->def_land_id]->getGameDataUnits();
    	$this->def_units 			= $this->def_units_origin;
    	$this->def_current_units	= $this->def_units;
    	$this->def_have_fort		= (in_array($this->fort_build_id, $this->gameData[$this->def_land_id]->getGameDataBuildings()))? true : false;
    	$this->def_max_unit			= ($this->def_units >= $this->def_max_units)? $this->def_max_units : $this->def_units;
    	$this->def_max_unit_final	= $this->def_have_fort*$this->bonus_fort + $this->def_max_units;
    	
    	// Init fight
    	$this->fight_nb 			= 0;
    	$this->atk_thimble_form 	= "";
    	$this->def_thimble_form		= "";
    	
      }

    /**
      * 
      */
    private function InitRound(){
    	$this->atk_thimble_array	= array();
    	$this->def_thimble_array	= array();
    	$this->atk_fighting_units	= 0;
    	$this->def_fighting_units	= 0;
    	$this->atk_thimble_form		.= "/";
    	$this->def_thimble_form		.= "/";
    }
    
    private function setAtkFightingUnits(){
    	if($this->atk_current_units > $this->atk_max_unit_final){
    		$this->atk_fighting_units = $this->atk_max_unit_final;
    	}else{
    		$this->atk_fighting_units = $this->atk_current_units;
    	}
    }
    
    private function setDefFightingUnits(){
    	if($this->def_current_units > $this->def_max_unit_final){
    		$this->def_fighting_units = $this->def_max_unit_final;
    	}else{
    		$this->def_fighting_units = $this->def_current_units;
    	}
    }
    
    /**
     * 
     * @param unknown $thimble_array
     * @param unknown $thimble_form
     * @return string
     */
    private function setThimbleForm($thimble_array, $thimble_form){
    	foreach($thimble_array as $thimble){
    		$thimble_form.= $thimble.";";
    	}
    	return $thimble_form;
    }
    
    /**
     * 
     * @param unknown $fightingUnits
     */
    private function setThimble($fightingUnits){
    	$returned = array();
    	for($i=0; $i < $fightingUnits; $i++){
    		array_push($returned, rand(1, 6));
    	}
    	return $returned;
    }
    
    private function startFight($atk, $def){
    	if($atk > $def && $atk !="" && $def !="")
    	{
    		$this->def_current_units--;
    	}else{
    		$this->atk_current_units--;
    	}
    }
    
    private function updateUnitsForm(){
    	$this->atk_units_form	.= "/";
    	$this->def_units_form	.= "/";
    	$this->atk_units_form	.= $this->atk_current_units;
    	$this->def_units_form	.= $this->def_current_units;
    }
    
    private function setWin(){
    	if($this->def_current_units == 0){
    		$this->conquest = 1;
    	}else{
    		$this->conquest = 0;
    	}
    	$this->updateUnitsForm();
    }
    
    /**
     * 
     */
    public function FightStart()
    {
    	/* Boucle qui se terminera quand un des camps aura perdu */
    	while($this->atk_current_units > 0 && $this->def_current_units > 0)
    	{
    		// Init
    		$this->InitRound();
    		
    		/**
    		 * Attacker
    		 */
    		// Set fighting units
			$this->setAtkFightingUnits();

    		// Set Atk thimble 
    		$this->atk_thimble_array = $this->setThimble($this->atk_fighting_units);
			
			// Sort thimble
			rsort($this->atk_thimble_array);	

			/**
			 * Defender
			 */
			// Set fighting units
    		$this->setDefFightingUnits();

    		// Set Def thimble
    		$this->def_thimble_array = $this->setThimble($this->def_fighting_units);

			// Sort thimble
			rsort($this->def_thimble_array);	

			/**
			 * Set forms
			 */
			// Reg units
			$this->updateUnitsForm();

			// Reg thimbles
		    $this->atk_thimble_form = $this->setThimbleForm($this->atk_thimble_array, $this->atk_thimble_form);
		    $this->def_thimble_form = $this->setThimbleForm($this->def_thimble_array, $this->def_thimble_form);

		    /**
		     * Fight
		     */
			$fight_max = min($this->atk_fighting_units, $this->def_fighting_units)-1;
			for($i=0;$i <= $fight_max; $i++){
				if($this->atk_current_units > 0 && $this->def_current_units > 0){
					$this->startFight($this->atk_thimble_array[$i], $this->def_thimble_array[$i]);
				}
			}
			$this->fight_nb++;
    	}

    	/**
    	 * Result
    	 */
    	$this->setWin();
    }

    public function FightResult()
    {
    	return array(
    		'atk_land_id'		=> $this->atk_land_id,
            'def_land_id'		=> $this->def_land_id,
    		'fight_nb' 			=> $this->fight_nb,
    		'def_engage_units' 	=> $this->def_units_origin, 
    		'def_result_units' 	=> $this->def_current_units,
    		'atk_engage_units' 	=> $this->atk_units_origin, 
    		'atk_result_units' 	=> $this->atk_current_units,
    		'conquest' 			=> $this->conquest,
    		'thimble_atk'		=> $this->atk_thimble_form,
            'thimble_def'		=> $this->def_thimble_form,
            'atk_units'			=> $this->atk_units_form,
            'def_units'			=> $this->def_units_form,
    	);
    }
} 