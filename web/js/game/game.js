$("document").on("pjax:timeout", function(event) {
  // Prevent default timeout redirection behavior
  event.preventDefault()
});

//Call Pjax
$("document").ready(function(){
	// No connection lost
	HideLostConnection();
    setInterval(function(){      
    	reloadPjax();
    }, config["refresh_time"]); //Reload map
});

// Call Pjax Functions
function pjaxReload(div){if(!$("input:hover").length > 0){$.pjax.reload({container:div, async:true});}}
function reloadPjax(){reloadGameIndex();reloadMap();reloadHeader();if(config["debugJs"])console.log("Pjax reload called");}

function reloadGameIndex(){if($("#list_game").length > 0){pjaxReload("#list_game");if(true){console.log("Pjax Game Index reloaded");}}}
function reloadMap(){if($("#map_content").length > 0 && !$("#modal-view").is(':visible')){pjaxReload("#map_content");if(config["debugJs"]){console.log("Pjax Map reloaded");}}}

function reloadHeader(){
	// URL
	var url = config["url"]["ajax"] + "/" + "header";
	
	if($("#navbar-menu-game:hover").length == 0 && config["access"]["in_started_game"]){
		// Ajax call
		$.ajax({
	        url: url,
	        dataType : "html",  
	        success: function(data) {
	        	pjaxReload("#navbar-menu-game-data");
	        	if(config["debugJs"])console.log("Pjax Header reloaded");
	        },
	        error: function(){    
	        	ShowLostConnection();
	        }
	    });
	}
}

// Pjax success
$(document).on('pjax:success', function() {
	HideLostConnection();
});

// Lost server connection
$('#pjax').on('pjax:error', function (event, error) {
	ShowLostConnection();
    event.preventDefault();
});

// Show / Hide lost connection
function ShowLostConnection(){$('#lost_connection_text').show();}
function HideLostConnection(){$('#lost_connection_text').hide();}

//New JS after refresh
$(document).on("pjax:end", function() {
  // tooltips
  $("[data-toggle=tooltip]").tooltip();

  // popover
  $("[data-toggle=popover]").popover();
});