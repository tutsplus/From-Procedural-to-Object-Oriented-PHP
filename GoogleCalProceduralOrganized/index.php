<?php

require_once './google-api-php-client/src/Google_Client.php';
require_once './google-api-php-client/src/contrib/Google_CalendarService.php';
require_once __DIR__ . '/../apiAccess.php';
require_once './functins_google_api.php';
require_once './functions_display.php';
require_once './functions.php';
session_start();

$client = createClient();
if(!authenticate($client)) return;

doUserAction();

//listAllCalendars($client);
