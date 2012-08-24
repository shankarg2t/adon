/* Document is Ready */
jQuery(document).ready(function() {

	// Remove Description
	$('.pp_description').attr('style','');
	
	// Tracking
	var pageTracker = _gat._createTracker("UA-29217275-1");

	// Get the Form ID 
	var formid = $('form.adcom-form').attr('id');

	/* NO Errors - First Load */
	if($("div.error").size() == 0) {
		
		// Track Form Start if on Focus
		var start = false;
		$('#'+formid+' input').focus(function() {
			if(!start){
				//_gaq.push(['_trackEvent', 'Form', formid, 'Start']);
				pageTracker._trackPageview('/_forms/'+formid+'/start');
				start = true;
			}	
		});
		$('#'+formid+' textarea').focus(function() {
			if(!start){
				pageTracker._trackPageview('/_forms/'+formid+'/start');
				start = true;
			}	
		});
		
		
		// Track Form Next
		$('#form-next').click(function() {
			pageTracker._trackPageview('/_forms/'+formid+'/next');
			return false;
		});		
		
		
	}else {
		// Form Errors
		pageTracker._trackPageview('/_forms/'+formid+'/error');
		
		// Track Errors
		$('div.error').each(function(index) {
			_gaq.push(['_trackEvent', 'Forms', formid+' Error', $(this).text()]);
		});
	}
	

	
});		
