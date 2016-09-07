/**** RESET FUNCTIONS ****/
function resetDice(maxDice){
	// atk
	for(i = 1; i <= maxDice; i++)
		setDice("die-atk-"+i, "");
	
	// def
	for(i = 1; i <= maxDice; i++)
		setDice("die-def-"+i, "");
}

function resetRound(maxDice){
	resetDice(maxDice);
}

/**** UPDATE FUNCTIONS ****/
//Update Units
function showUnits(round_fight_units_atk, round_fight_units_def){
	$("#units_atk").html(round_fight_units_atk);
	$("#units_def").html(round_fight_units_def);
}

// Update Progress Bar
function updateProgress(progress_name, i, percent){
	var current = i * percent;
	$("#"+progress_name+" .progress-bar").attr("style", "width:"+current+"%");
	$("#"+progress_name+" .progress-bar").attr("aria-valuenow", current);
	//$("#"+progress_name+" .progress-bar").html(current+"%");
}

// Update Chance of Win
function updateChanceWin(round_fight_units_atk, round_fight_units_def){
	var percent = 0;
	if((round_fight_units_atk - round_fight_units_def) > 0){
		percent = 100-(Math.round((round_fight_units_atk + round_fight_units_def) / (round_fight_units_atk - round_fight_units_def)));
	}else{
		percent = (Math.round(-(round_fight_units_atk + round_fight_units_def) / (round_fight_units_atk - round_fight_units_def)));
	}

	return percent;
}

/**** SHOW FUNCTIONS ****/
//Show fight
function showFight(fightDetailsArray){
	var maxDice 				= 4;
	var round_time				= 1500;
	var i 						= 1;
	var timeout					= 200;
	var total_time 				= fightDetailsArray["fight_nb"];
	var percent 				= Math.round(100/(total_time+1));
	var progress_name 			= "attack-action";
	var fight_conquest			= fightDetailsArray["conquest"];
	var fight_die_atk 			= fightDetailsArray["thimble_atk"];
	var fight_die_def 			= fightDetailsArray["thimble_def"];
	var fight_units_atk 		= fightDetailsArray["atk_units"];
	var fight_units_def 		= fightDetailsArray["def_units"];
	var fight_die_atk_array 	= fight_die_atk.split("/");
	var fight_die_def_array 	= fight_die_def.split("/");
	var fight_units_atk_array 	= fight_units_atk.split("/");
	var	fight_units_def_array 	= fight_units_def.split("/");
	
	// Interval beginning
	var IntervalId = setInterval(
		function(){			
			if(showRound(i, percent, total_time, progress_name, fight_die_atk_array, fight_die_def_array, fight_units_atk_array, fight_units_def_array, maxDice, timeout) == 1){
				clearInterval(IntervalId);
				
				// Show end
				showFightEnd(fight_conquest, progress_name);
			}	
			i++;
		}, round_time); 

	/*rollDice("die-def-3", 5);
	setTimeout(function () {resetDice(maxDice)}, 3000);*/

}

function showRound(i, percent, total_time, progress_name, fight_die_atk_array, fight_die_def_array, fight_units_atk_array, fight_units_def_array, maxDice, timeout){
	// Reset
	resetRound(maxDice);
	
	// Round information
	var round_fight_units_atk	= fight_units_atk_array[i];
	var round_fight_units_def 	= fight_units_def_array[i];

	if(fight_die_atk_array[i] != null && fight_die_def_array[i] != null){
		var round_array_die_atk 	= fight_die_atk_array[i].split(";");
		var round_array_die_def 	= fight_die_def_array[i].split(";");			
	}

	// Change units
	showUnits(round_fight_units_atk, round_fight_units_def);
	
	// Get probabilty
	var atk_percent = updateChanceWin(round_fight_units_atk, round_fight_units_def);
	
	// Attacker
	// Change probabilty to win
	$("#win_percent_atk").html(atk_percent);
	
	// Defender
	// Change probabilty to win
	$("#win_percent_def").html(100 - atk_percent);
	
	// Change progress
	updateProgress(progress_name, i, percent);
	
	// Show dice
	// Atk
	if(round_array_die_atk != undefined)
		for (var i = 0; i < round_array_die_atk.length; i++){
			rollDice("die-atk-"+(i+1), round_array_die_atk[i], timeout);
		}
		
	// Def
	if(round_array_die_def != undefined)
		for (var i = 0; i < round_array_die_def.length; i++){
			rollDice("die-def-"+(i+1), round_array_die_def[i], timeout);
		}
		
	if(i > total_time)
		return 1;
}

function showFightEnd(fight_conquest, progress_name){
	// Change percent
	if(fight_conquest == 1){
		$("#win_percent_atk").html(100);
		$("#win_percent_def").html(0);
	}else{
		$("#win_percent_atk").html(0);
		$("#win_percent_def").html(100);
	}
	
	// Progress bar
	updateProgress(progress_name, 1, 100);
}