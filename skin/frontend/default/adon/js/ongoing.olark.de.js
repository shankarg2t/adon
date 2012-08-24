// German Translation
olark.configure('locale.welcome_title', "Hier klicken um zu chatten");
olark.configure('locale.chatting_title', "Live Hilfe: Jetzt chatten");
olark.configure('locale.unavailable_title', "Live Hilfe: Offline");
olark.configure('locale.busy_title', "Live Hilfe: Besetzt");
olark.configure('locale.away_message', "Unser Live-Chat ist zur Zeit offline. Bitte versuchen Sie es später nochmals.");
olark.configure('locale.loading_title', "Live-Chat wird geladen...");
olark.configure('locale.welcome_message', "Willkommen auf unserer Website. Sie können dieses Chat-Fenster benutzten um mit uns zu chatten.");
olark.configure('locale.busy_message', "All unsere Ansprechpartner sind zur Zeit besetzt. Wir sind gleich bei Ihnen.");
olark.configure('locale.chat_input_text', "Schreiben Sie hier und drücken Sie <ENTER> um zu chatten");
olark.configure('locale.name_input_text', " und schreiben Sie ihren Namen");
olark.configure('locale.email_input_text', " und Ihre E-Mail");
olark.configure('locale.offline_note_message', "Unser Live-Chatt ist Offline. Senden Sie uns eine Nachricht.");
olark.configure('locale.send_button_text', "Absenden");
olark.configure('locale.offline_note_thankyou_text', "Danke für Ihre Nachricht. Wir werden Ihnen sobald als möglich antworten.");
olark.configure('locale.offline_note_error_text', "Sie müssen alle Felder ausfüllen und eine gültige E-Mail Adresse angeben.");
olark.configure('locale.offline_note_sending_text', "Wird versendet...");
olark.configure('locale.operator_is_typing_text', "ist am schreiben...");
olark.configure('locale.operator_has_stopped_typing_text', "hat aufgehört zu schreiben");
olark.configure('locale.introduction_error_text', "Bitte hinterlassen Sie Ihren Namen und Ihre E-Mail Adresse, dass wir Sie kontaktieren können, wenn wir offline gehen würden.");
olark.configure('locale.introduction_messages', "Herzlich Willkommen. Bitte füllen Sie die Felder aus und klicken Sie auf 'Chat starten' um mit uns zu sprechen.");
olark.configure('locale.introduction_submit_button_text', "Chat starten");
olark.configure('locale.disabled_input_text_when_convo_has_ended', "Chat beendet, bitte Seite neu laden um nochmals zu chatten.");
olark.configure('locale.disabled_panel_text_when_convo_has_ended', "Die Unterhaltung wurde beendet. Wenn Sie nochmals chatten möchten, müssen Sie nur die Seiten neu laden.");


/* Document is Ready */
jQuery(document).ready(function() {

	/* News Startseite */
	$(".newsbox .news-detail").hide();
	$(".newsbox .toggle-news").click( function (e) {
		var currNews = $(this.parentNode).find(".news-detail");
		if(currNews.hasClass("active")) {
			currNews.slideUp("slow");
			currNews.removeClass("active");      
			$(this).html("mehr lesen");      
			return false;      
		} else {
			currNews.slideDown("slow");
			currNews.addClass("active");
			$(this.parentNode.parentNode).find(".newsbox").css("height", "");
			$(this).html("schliessen");
			return false;
		}
	});
});	