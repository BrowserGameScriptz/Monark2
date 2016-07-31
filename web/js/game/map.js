// Land interaction
$(document).on("click", ".land_content", function (){
    var land_id = $(this).attr("i");
    showLandInfo(land_id);
});

// Buy
// begin
$(document).on("click", ".buy_link", function (){
	$(".buy_link").html("...");
	var land_id = $(this).attr("i");
	showBuyBegin(land_id);
});
// action
$(document).on("click", ".buy_action_link", function (){
	$(".buy_action_link").html("...");
	var land_id = $(this).attr("i");
	var units = $("#input_select_unit_number").val();
	showBuyAction(land_id, units);
});

// Build
// begin
$(document).on("click", ".build_link", function (){
	$(".build_link").html("...");
	var land_id = $(this).attr("i");
	showBuildBegin(land_id);
});
// action
$(document).on("click", ".build_action_link", function (){
	$(".build_action_link").html("...");
	var land_id = $(this).attr("i");
	var building_id = $(this).attr("building_i");
	showBuildAction(land_id, building_id);
});

// Move
// begin
$(document).on("click", ".move_link", function(){
	$(".move_link").html("...");
	var land_id = $(this).attr("i");
	showMoveBegin(land_id);
});
// action
$(document).on("click", ".move_action_link", function (){
	var land_id = $(this).attr("i");
	var land_id_to = $(this).attr("to_i");
	var units = $("#input_select_unit_number").val();
	$(".build_action_link").html("...");
	showMoveAction(land_id, land_id_to, units);
});


// ATK
// begin
$(document).on("click", ".atk_link", function(){
	$(".atk_link").html("...");
	var land_id = $(this).attr("i");
	showAtkBegin(land_id);
});
// action
$(document).on("click", ".atk_action_link", function (){
	$(".atk_action_link").html("...");
	var land_id = $(this).attr("i");
	var land_atk_id = $(this).attr("atk_i");
	var units =  $(this).closest('tr').children('td #td-select_unit_number').find('#input_select_unit_number').val();
	showAtkAction(land_id, land_atk_id, units);
});

// Functions
function showLandInfo(land_id){CallAjaxMethodModal("landinfo", {"land_id":land_id}, {'title': "", 'title_with_land_name' : true}, land_id);}
function showBuyBegin(land_id){CallAjaxMethodModal("buybegin", {"land_id":land_id}, {'title': config["text"]["to_buy"], 'title_with_land_name' : true}, land_id);}
function showBuyAction(land_id, units){CallAjaxMethodModal("buyaction", {"land_id":land_id, 'units':units}, {'title': " Recrutement en cours...", 'title_with_land_name' : true}, land_id);}
function showBuildBegin(land_id){CallAjaxMethodModal("buildbegin", {"land_id":land_id}, {'title': config["text"]["to_build"], 'title_with_land_name' : true}, land_id);}
function showBuildAction(land_id, building_id){CallAjaxMethodModal("buildaction", {"land_id":land_id, 'building_id':building_id}, {'title': " Construction en cours...", 'title_with_land_name' : true}, land_id);}
function showMoveBegin(land_id){CallAjaxMethodModal("movebegin", {"land_id":land_id}, {'title': config["text"]["to_move"], 'title_with_land_name' : true}, land_id);}
function showMoveAction(land_id, land_id_to, units){CallAjaxMethodModal("moveaction", {'land_id':land_id, 'land_id_to':land_id_to, 'units':units}, {'title': " Déplacement en cours...", 'title_with_land_name' : true}, land_id);}
function showAtkBegin(land_id){CallAjaxMethodModal("attackbegin", {"land_id":land_id}, {'title':config["text"]["to_attack"], 'title_with_land_name' : true}, land_id);}
function showAtkAction(land_id, land_atk_id, units){CallAjaxMethodModal("attackaction", {'land_id':land_id, 'atk_id':land_atk_id, 'units':units}, {'title': " Attaque en cours...", 'title_with_land_name' : true}, land_id);}

// Context Menu
$(".land_content").rightClick( function(e) {
    $.contextMenu({
        selector: '.land_content',
        callback: function(key, options) {
            switch (key){
            	case "atk":
            		showAtkBegin($(this).attr("i"));
            		break;
            	case "buy":
            		showBuyBegin($(this).attr("i"))
            		break;
            	case "build":
            		showBuildBegin($(this).attr("i"));
            		break;
            	case "move":
            		showMoveBegin($(this).attr("i"));
            		break;
            	default:break;
            }
        },
        items: {
          "atk": {name: "Atk"},
	        "sep1": "---------",
	        "buy": {name: "Buy"},
	        "sep2": "---------",
	        "build": {name: "Build"},
	        "sep3": "---------",
	        "move": {name: "Move"},
        }
    });
});
