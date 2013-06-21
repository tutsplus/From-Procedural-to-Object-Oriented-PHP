<?php

function doUserAction($client) {
	printMenu();
	if (isAction('home'))
		printHome();
	if (isAction('showCalendars'))
		printCalendars($client);
	if (isAction('showThisCalendar'))
		printCalendarContents($client);
	if (isAction('showThisEvent'))
		printEventDetails($client);
}

function isAction($getAction) {
	return isset($_GET[$getAction]);
}

function printHome() {
	print('Welcome to Google Calendar over NetTuts Example');
}

function printMenu() {
	putLink('?home', 'Home');
	putLink('?showCalendars', 'Show Calendars');
	putLink('?logout', 'Log Out');
	print('<br><br>');
}

function printCalendars($client) {
	putTitle('These are your calendars:');
	foreach (getCalendarList($client)['items'] as $calendar) {
		putLink('?showThisCalendar=' . htmlentities($calendar['id']), $calendar['summary']);
		print('<br>');
	}
}

function printCalendarContents($client) {
	putTitle('These are you events for ' . getCalendar($client, $_GET['showThisCalendar'])['summary'] . ' calendar:');
	foreach (retrieveEvents($client, $_GET['showThisCalendar']) as $event) {
		print('<div style="font-size:10px;color:grey;">' . date('Y-m-d H:m', strtotime($event['created'])));
		putLink('?showThisEvent=' . htmlentities($event['id']) .
				'&calendarId=' . htmlentities($_GET['showThisCalendar']), $event['summary']);
		print('</div>');
		print('<br>');
	}
}

function putLink($href, $text) {
	print(sprintf('<a href="%s" style="font-size:12px;margin-left:10px;">%s</a> | ', $href, $text));
}

function putTitle($text) {
	print(sprintf('<h3 style="font-size:16px;color:green;">%s</h3>', $text));
}

function putBlock($text) {
	print('<div display="block">'.$text.'</div>');
}

function printEventDetails($client) {
	foreach (retrieveEvents($client, $_GET['calendarId']) as $event)
		if ($event['id'] == $_GET['showThisEvent']) {
			putTitle('Details for event: '. $event['summary']);
			putBlock('This event has status ' . $event['status']);
			putBlock('It was created at ' .
					date('Y-m-d H:m', strtotime($event['created'])) .
					' and last updated at ' .
					date('Y-m-d H:m', strtotime($event['updated'])) . '.');
			putBlock('For this event you have to <strong>' . $event['summary'] . '</strong>.');
		}
}

function retrieveEvents($client, $calendarId) {
	return getEventList($client, htmlspecialchars($calendarId))['items'];
}