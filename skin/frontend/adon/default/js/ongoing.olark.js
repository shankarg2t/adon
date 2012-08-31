/* Document is Ready */
jQuery(document).ready(function() {

	/* LiveChat */
	$("#go-livechat").click(function () {
		
		// Click Livechat-Button - Show Livechat
		if($("#livechat").is(":hidden")){ livechat_show('meta-navi'); }
		else{ livechat_close();	}
		
		return false;
	});	


	// Monitor Name-Fields and Update Chat-Nickname
	
		// Name
		$('input[name$="contact[name]"]').blur(function() {
			var customername = $('input[name$="contact[name]"]').val()
	  		olark('api.visitor.updateFullName', {fullName: customername});
		});
		
		// E-Mail
		$('input[name$="contact[email]"]').blur(function() {
			var customername = $('input[name$="contact[email]"]').val()
	  		olark('api.visitor.updateEmailAddress', {emailAddress: customername});
		});	

});


// Show Chat
function livechat_show(notification){

	// Track Click on LiveChat Button
	if(notification) { 
		_gaq.push(['_trackEvent', 'Live Chat', notification]);
		
	}

	
	// NO Operator is avaiable
	olark('api.chat.onOperatorsAway', function(){ return false; });
	
		
	// Remove default Style
	$('#habla_window_div').attr('style','');
	$('#habla_window_div').removeClass('olrk-fixed-top').removeClass('olrk-fixed-left');
	
	// Show Livechat
	$("#livechat").show();
	olark('api.box.expand');
	
	// Add Metanavi-Style
	$('#metanavi-slidedown').addClass('chat-active');
	
	return false;
}


// Hide Chat
function livechat_close(){

	// Hide Chat and remove Styles
	$("#livechat").hide();
	olark('api.box.hide');
	$('#metanavi-slidedown').removeClass('chat-active');
	//olark('api.chat.sendNotificationToOperator', {body: "visitor closed the chatbox …"});
	
	return false;
}


// Monitor Chat - show/hide
olark('api.box.onExpand', function() { 	livechat_show();  return false; });
olark('api.box.onShow', function() { 	livechat_show();  return false; });
olark('api.box.onShrink', function() { 	livechat_close(); return false; });
//olark('api.box.onHide', function() { 	livechat_close(); return false; });



