<?php

require_once './google-api-php-client/src/Google_Client.php';
require_once './google-api-php-client/src/contrib/Google_CalendarService.php';
require_once __DIR__ . '/../apiAccess.php';
require_once './functins_google_api.php';
require_once './Presenter.php';
require_once './Logic.php';
require_once './Router.php';
session_start();

$client = createClient();
if(!authenticate($client)) return;

$logic = new Logic($client);
$presenter = new Presenter($logic);
(new Router($presenter))->doUserAction();

//listAllCalendars($client);
