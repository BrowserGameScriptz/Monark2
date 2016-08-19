// Update progress Bar
function updateProgress(progress_name, i, percent){
	var current = i * percent;
	showProgressionDetails(current);
	$("#"+progress_name+" .progress-bar").attr("style", "width:"+current+"%");
	$("#"+progress_name+" .progress-bar").attr("aria-valuenow", current);
	$("#"+progress_name+" .progress-bar").html(current+"%");
	if(current + percent > 100)
		return 1;
	else
		return 0;
}
	
// show progression
function showProgressionDetails(currentPercent){
	switch(currentPercent) {
	case 20:
    	$("#create_map img").removeAttr("style");
		$("#create_map span").hide();
		$("#create_region span").removeAttr("style");
    	break;
	case 40:
    	$("#create_region img").removeAttr("style");
		$("#create_region span").hide();
		$("#create_players span").removeAttr("style");
    	break;
	case 60:
    	$("#create_players img").removeAttr("style");
		$("#create_players span").hide();
		$("#assign_lands span").removeAttr("style");
    	break;
	case 80:
    	$("#assign_lands img").removeAttr("style");
		$("#assign_lands span").hide();
		$("#finalization span").removeAttr("style");
    	break;
	case 99:
    	$("#finalization img").removeAttr("style");
		$("#finalization span").hide();
    	break;
	case 100:
		$("#enter_button").removeAttr("style");
    	break;
	default:
    	break;
	} 	
}

// Start all functions
$("document").ready(
	function(){
		// Informations 
    	var i 						= 1;
		var percent 				= 1;
		var progress_name 			= 'game_load';
		
		// Prepare header
		//reloadHeader();
		
    	// Interval beginning
		var IntervalId = setInterval(
			function(){
				if(updateProgress(progress_name, i, percent) == 0)
					i++;
				else
					clearInterval(IntervalId);
			}
            , 100); 
		}
	);