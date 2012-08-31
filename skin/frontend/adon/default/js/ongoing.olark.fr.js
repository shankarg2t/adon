// French Translation
olark.configure('locale.welcome_title', "Cliquez ici pour chatter");
olark.configure('locale.chatting_title', "Aide en direct: chatter maintenant");
olark.configure('locale.unavailable_title', "Aide en direct: hors ligne");
olark.configure('locale.busy_title', "Aide en direct: occupé");
olark.configure('locale.away_message', "Notre Live-Chat est actuellement déconnecté. Veuillez réessayer ultérieurement.");
olark.configure('locale.loading_title', "Live-Chat en cours de chargement...");
olark.configure('locale.welcome_message', "Bienvenue sur notre site Internet. Vous pouvez utiliser cette fenêtre de chat et chatter avec nous.");
olark.configure('locale.busy_message', "Tous nos interlocuteurs sont actuellement occupés. Nous sommes tout de suite à vous.");
olark.configure('locale.chat_input_text', "Ecrivez ici et appuyez sur <ENTRÉe> pour chatter");
olark.configure('locale.name_input_text', " et écrivez votre nom");
olark.configure('locale.email_input_text', " et votre e-mail");
olark.configure('locale.offline_note_message', "Notre Live-Chat est déconnecté. Envoyez-nous un message.");
olark.configure('locale.send_button_text', "Envoyer");
olark.configure('locale.offline_note_thankyou_text', "Merci pour votre message. Nous vous répondrons dès que possible.");
olark.configure('locale.offline_note_error_text', "Veuillez remplir tous les champs et indiquer une adresse e-mail valide.");
olark.configure('locale.offline_note_sending_text', "Envoi en cours...");
olark.configure('locale.operator_is_typing_text', "est en train d’écrire...");
olark.configure('locale.operator_has_stopped_typing_text', "a arrêté d’écrire");
olark.configure('locale.introduction_error_text', "Veuillez laisser votre nom et votre e-mail afin que nous puissions vous contacter en cas de déconnexion.");
olark.configure('locale.introduction_messages', "Bienvenue. Veuillez remplir les champs et cliquer sur «Démarrer le chat» pour discuter avec nous.");
olark.configure('locale.introduction_submit_button_text', "Démarrer le chat");
olark.configure('locale.disabled_input_text_when_convo_has_ended', "Chat terminé, veuillez rafraîchir la page pour chatter de nouveau.");
olark.configure('locale.disabled_panel_text_when_convo_has_ended', "La conversation a été terminée. Pour chatter de nouveau, il vous suffit de charger à nouveau la page.");



/* Document is Ready */
jQuery(document).ready(function() {

	/* News Startseite */
	$('a.toggle-news').text('suite');
	$(".newsbox .news-detail").hide();
	$(".newsbox .toggle-news").click( function (e) {
		var currNews = $(this.parentNode).find(".news-detail");
		if(currNews.hasClass("active")) {
			currNews.slideUp("slow");
			currNews.removeClass("active");      
			$(this).html("autre");      
			return false;      
		} else {
			currNews.slideDown("slow");
			currNews.addClass("active");
			$(this.parentNode.parentNode).find(".newsbox").css("height", "");
			$(this).html("fermer");
			return false;
		}
	});
});	