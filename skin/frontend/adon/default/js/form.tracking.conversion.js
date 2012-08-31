/* Document is Ready */
jQuery(document).ready(function() {

	var pageTracker = _gat._createTracker("UA-29217275-1");

	// Get FormID from URL and Track Conversion
	var myFile = window.location.hash;
	if (myFile.match('#')) {
		var formID = myFile.split('#')[1]; // get FormID Anchor
		pageTracker._trackPageview('/_forms/'+formID+'/sent');
	}
	
});		
