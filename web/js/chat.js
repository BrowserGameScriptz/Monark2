//Call Pjax
$("document").ready(function(){
	if(typeof(config) != 'undefined') {
		scrollDownChat();
	    setInterval(function(){      
	    	reloadChat();
	    	scrollDownChat();
	    }, config["refresh_time"]); //Reload map
	}
});

$("document").on("pjax:timeout", function(event) {
	  // Prevent default timeout redirection behavior
	  event.preventDefault()
	});

function reloadChat(){
	if($("#chat_content").length > 0){
		pjaxReload("#chat_content");
		if(config["debugJs"])console.log("Chat reloaded");
	}
}

function scrollDownChat (){if(!$(".box-body:hover").length > 0){$('#scroll-msg').animate({ scrollTop: $('#scroll-msg').prop("scrollHeight")}, 800);}}

//Function used to call PHP Ajax function to update header info
function CallAjaxMethodHeader(action, args, div) {
	// URL
	var url = config["url"]["ajax"] + "/"+action+"&args="+ JSON.stringify(args);
    
	// Ajax call
	$.ajax({
        url: url,
        dataType : "html",  
        mimeType: "application/json",
        beforeSend:function(){
        	$(div).html(config["text"]["ajax"]);
        },
        success: function(data) {
        	$(div).html(data);
        },
        error: function(){    
        	alert("error : " + url);
        	$(div).html(data);
        }
    });
}

// Send
$(document).on("click", "#button_send_chat", function(){
	var msg = $("#chat_msg_content").val();
	$("#chat_msg_content").val($("#chat_msg_content").attr("placeholder"));
	CallAjaxMethodHeader("sendchat", {'message': msg}, "#ajax-send-chat-return");
});