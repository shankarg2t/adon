/* Scale Slider */

// Set Max-Sizes
var maxWidth  = 1800;
var minWidth  = 992;
var minHeight = 400;

function scale_slider() {

	 $('#slideshow .slide').each(function(e){
	 
	 	  // Get Sizes
	 	  
	 	  var slide = $('#slideshow .slide')[e];
	 	  
	 	  
		  var imgWidth = $(slide).find('img.bgimg').width();
		  var imgHeight = $(slide).find('img.bgimg').height();
		  var imgRatio = imgWidth / imgHeight;
		  
		  //console.log("1st width: "+imgWidth+" / height:"+imgHeight);
		  
		  //var scaleRatioWidth = winWidth / imgWidth;    
		  var winWidth  = $(window).width();
		  

		
		  var newWidth = 0;
		  var newHeight = 0;
		
		  // Scale Image
		  if(winWidth >= minWidth) {
		    newWidth = winWidth;
		    newHeight = parseInt(newWidth/imgRatio);
		    //console.log("bild=bildschirmbreite: "+imgWidth+" / height:"+imgHeight+" / Ratio: "+imgRatio);
		  }
		  
		  if(newWidth > maxWidth){
		    newWidth = maxWidth;
		    newHeight = parseInt(newWidth/imgRatio);
		    //console.log("zu breit width: "+imgWidth+" / height:"+imgHeight+" / Ratio: "+imgRatio);
		  }
		  
		  // Image Height too small
		  if(newHeight < minHeight){
		    
		    newHeight = minHeight;
		    newWidth = parseInt(newHeight*imgRatio);
		    //console.log("zu schmal: "+imgWidth+" / height:"+imgHeight+" / Ratio: "+imgRatio);
		    
		    if(winWidth < minWidth) { 
		    	$("#slider").width(minWidth); 
		    	$("#slider .slider-shadow").width(minWidth); 
		    }
		    else { 
		    	$("#slider").width(winWidth); 
		    	$("#slider .slider-shadow").width(winWidth);
		    }
		    
		  } else {
		  	$("#slider").width(newWidth);
		  	$("#slider .slider-shadow").width(newWidth);
		  }
		
		
		  // Set INT
		  newWidth = parseInt(newWidth);
		  newHeight = parseInt(newHeight);
		    
		  $(slide).find("img.bgimg").width(newWidth);
		  $(slide).find("img.bgimg").height(newHeight);    
		  //$("#slider .slider-shadow").width(newWidth); 
	 
	 });
	


}    
  
  
  
/* Document is Ready */
jQuery(document).ready(function() {
  
  	
  	// Track Clicks on E-Mail of Person
	$('.person a.mailto').click(function () {
  		var name = $(this).parent().find('h3').text();
  		_gaq.push(['_trackEvent', 'EMail', name]);
	});
  
  	// Track Clicks on XING-Link of Person
	$('.person a.xing').click(function () {
  		var name = $(this).parent().find('h3').text();
  		_gaq.push(['_trackEvent', 'Xing', name]);
	});  
  
  
  /* Prety Photo */
  $("a[rel^='prettyPhoto']").prettyPhoto({
    animation_speed:'normal',
    theme:'light_rounded', 
    autoplay_slideshow: false, 
    show_title: false,
    social_tools: false
  });
  
  /* Slideshow */
  $('#slideshow').cycle({ 
    fx:     'fade', 
    prev:   '#prev1', 
    next:   '#next1', 
    speed: 'slow',
    timeout: 7000,   
    speed: 2500,
    random:  1,
	backwards: true,
    before: function(){ $(this).parent().find('div.current').removeClass('current'); },
    after: function(){ $(this).addClass('current'); }
  });
  
  
  // Show Slideshow-Navigation-Buttons
  var size = $("#slideshow .slide").size();
  if(size > 1) { $("#slider #prev1").show(); $("#slider #next1").show() }

  
  
  $('#werk-close').click(function () {    
    $("#werkbesichtigung").hide();
    return false;
  });

  
  
  /* Fix Hover-Menu for IE */
  $('#navigation li.main').hover(
    function() { $('ul', this).css('display', 'block'); },
    function() { $('ul', this).css('display', 'none'); });


  /* Show Downloads */
  $("#slide-downloads").click(function () {    
    $("#metanavi-slidedown-faq").hide();
    $("#metanavi-slidedown-downloads").show();
    $("#metanavi-slidedown").slideDown("slow");
    onclick="_gaq.push(['_trackEvent', 'Meta-Navi', 'Spezifikationen show']);"
    return false;
  });
  
  
  /* Fix File-Icons of Specifications */
  $("#metanavi-slidedown-downloads a[href$=zip]").parent().addClass("zip");
  $("#metanavi-slidedown-downloads a[href$=doc]").parent().addClass("doc");
  $("#metanavi-slidedown-downloads a[href$=docx]").parent().addClass("doc");
  $("#metanavi-slidedown-downloads a[href$=dot]").parent().addClass("doc");
  
  
  
  /* Show FAQ */
  $("#slide-faq").click(function () {    
    $("#metanavi-slidedown-downloads").hide();
    $("#metanavi-slidedown-faq").show();
    $("#metanavi-slidedown").slideDown("slow");
    onclick="_gaq.push(['_trackEvent', 'Meta-Navi', 'FAQ show']);"
    return false;
  });    
  
  /* Close */
  $(".metanavi-close").click(function () {
    $("#metanavi-slidedown").slideUp("slow");  
    return false;    
  });
  
  
  /* Werkbesichtigung */
  $("#visit").hover(function () {
    $("#werkbesichtigung").show();
    pageTracker._trackPageview('/_forms/werkbesichtigung-form/box');    
  });    
  /*$("#werkbesichtigung").mouseout(function () {
    $("#werkbesichtigung").hide();      
  });  */

  
  /* FAQ Accordion */
  $('.toggle_container').hide();
  $('.trigger').click( function() {
    var trig = $(this);
    if ( trig.hasClass('trigger_active') ) {
      trig.next('.toggle_container').slideToggle('slow');
      trig.removeClass('trigger_active');
    } else {
      $('.trigger_active').next('.toggle_container').slideToggle('slow');
      $('.trigger_active').removeClass('trigger_active');
      trig.next('.toggle_container').slideToggle('slow');
      trig.addClass('trigger_active');
    };
  return false;
  });    
  
  // Scale Slider
  scale_slider();
  //scale_slider();

  
  
});




// Scale Slider on Window Resize
$(window).resize(function() {
  // Scale Slider
  scale_slider();      
});  




// Newsletter Form
jQuery(document).ready(function(){

	// Field Name
	jQuery("#newsletter #name").click(function () {
		if(jQuery("#newsletter #name").val() == 'Vorname /Nachname') {
			jQuery("#newsletter #name").val('');
			jQuery("#newsletter #name").removeClass('false');
		}
	});

	// Field E-Mail
	jQuery("#newsletter #ydjiiyi-ydjiiyi").click(function () {
		if(jQuery("#newsletter #ydjiiyi-ydjiiyi").val() == 'E-Mail Adresse') {
			jQuery("#newsletter #ydjiiyi-ydjiiyi").val('');
			jQuery("#newsletter #ydjiiyi-ydjiiyi").removeClass('false');
		}
	});
	
	// Anrede
	jQuery("#newsletter #anrede").change(function () {
		
		if(jQuery("#newsletter #anrede").val() == 'm') {
			jQuery("#newsletter #Anrede1").val('Sehr geehrter'); 
			jQuery("#newsletter #Anrede2").val('Herr'); 
		}
		else if(jQuery("#newsletter #anrede").val() == 'f') {
			jQuery("#newsletter #Anrede1").val('Sehr geehrte'); 
			jQuery("#newsletter #Anrede2").val('Frau'); 
		}		
		else {
			jQuery("#newsletter #Anrede1").val('Sehr geehrte'); 
			jQuery("#newsletter #Anrede2").val('Damen und Herren'); 
		}
	});
	
	
	
	
	
	
	// Field Name
	jQuery("#newsletter #name").click(function () {
		if(jQuery("#newsletter #name").val() == 'prénom /nom') {
			jQuery("#newsletter #name").val('');
			jQuery("#newsletter #name").removeClass('false');
		}
	});

	// Field E-Mail
	jQuery("#newsletter #ydjkwy-ydjkwy").click(function () {
		if(jQuery("#newsletter #ydjkwy-ydjkwy").val() == 'adresse email') {
			jQuery("#newsletter #ydjkwy-ydjkwy").val('');
			jQuery("#newsletter #ydjkwy-ydjkwy").removeClass('false');
		}
	});
	
	// Anrede
	jQuery("#newsletter #anrede").change(function () {
		
		if(jQuery("#newsletter #anrede").val() == 'm') {
			jQuery("#newsletter #Anrede1").val('Cher'); 
			jQuery("#newsletter #Anrede2").val('Monsieur'); 
		}
		else if(jQuery("#newsletter #anrede").val() == 'f') {
			jQuery("#newsletter #Anrede1").val('Chère'); 
			jQuery("#newsletter #Anrede2").val('Madame'); 
		}		
		else {
			jQuery("#newsletter #Anrede1").val(''); 
			jQuery("#newsletter #Anrede2").val('Mesdames et Messieurs,'); 
		}
	});	
	
	
	
	
});








