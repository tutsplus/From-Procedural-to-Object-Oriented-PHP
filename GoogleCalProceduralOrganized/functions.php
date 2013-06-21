<?php

function doUserAction() {
	putMenu();
	if (!isset($_GET['action'])) return;
		$_GET['action']();
}

function printCalendars() {
	global $client;
	putCalendarListTitle();
	foreach (getCalendarList($client)['items'] as $calendar) {
		putCalendarListElement($calendar);
	}
}

function printCalendarContents() {
	putCalendarTitle();
	foreach (retrieveEvents($_GET['showThisCalendar']) as $event) {
		putEventListElement($event);
	}
}

function printEventDetails() {
	global $client;
	foreach (retrieveEvents($_GET['calendarId']) as $event)
		if (isCurrentEvent($event))
			putEvent($event);
}

function isCurrentEvent($event) {
	return $event['id'] == $_GET['showThisEvent'];
}

function retrieveEvents($calendarId) {
	global $client;
	return getEventList($client, htmlspecialchars($calendarId))['items'];
}
