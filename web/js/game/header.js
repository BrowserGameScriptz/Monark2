// Turn length
 $("document").ready(
	function(){
	  setInterval(
         function(){
		    if($("#turn_length").length > 0){
		    	var current_time_split = $("#turn_length").html().split(':');
			    if(current_time_split.length == 3){ var hour = current_time_split[0] + ":";var minute = current_time_split[1] + ":";var second = current_time_split[2];}if(current_time_split.length == 2){ var hour = " ";var minute = current_time_split[0] + ":";var second = current_time_split[1];}if(current_time_split.length == 1){ var hour = " ";var minute = "";var second = current_time_split;}if(parseInt(second) < 9){new_second = "0"+ (parseInt(second) + 1);}else{new_second = parseInt(second) + 1;}if(new_second >= 60){new_second = "00";if(!parseInt(minute)){minute = "01:";}else{minute = parseInt(minute) + 1;}}
			    var new_time = hour+minute+new_second;
			    $("#turn_length").html(new_time);
		    }
         }
	 , 1000); 
});
 
// New turn
$(document).on("click", "#end_of_turn_link", function(){
    $("#end_of_turn_link").html("<font color=white> " + config["text"]["turn_finished"] + " !</font>");
    $("#end_of_turn_link").attr("origin", "");
    CallAjaxMethodModal("newturn", new Array(), null);
});

// Last buy
$(document).on("click", "#current_gold_link", function(){
	CallAjaxMethodHeader("lastgold", new Array(), {'id': "#current_gold_content"});
});

// Income
$(document).on("click", "#gold_per_turn_link", function(){
	CallAjaxMethodHeader("income", new Array(), {'id': "#gold_per_turn_content"});
});

// last Chat
$(document).on("click", "#last_chat_link", function(){
	CallAjaxMethodHeader("lastchat", new Array(), {'id': "#last_chat_content"});
});