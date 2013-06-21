<?php

function createClient() {

	$client = new Google_Client();
	$client->setApplicationName("Google Calendar PHP Starter Application");

	// Visit https://code.google.com/apis/console?api=calendar to generate your
	// client id, client secret, and to register your redirect uri.
	$client->setClientId('735931158762.apps.googleusercontent.com');
	$client->setClientSecret('7M-qje3HUyPBPAGumW4qENUK');
	$client->setRedirectUri('http://localhost:8000/oauth2callback');
	$client->setDeveloperKey('AIzaSyCLyBMLOcAQAuzapm2Wkyle4Cx2gv47S4c');


	return $client;
}

?>
