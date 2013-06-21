<?php

function putHome() {
	print('Welcome to Google Calendar over NetTuts Example');
}

function putMenu() {
	putLink('?action=putHome', 'Home');
	putLink('?action=printCalendars', 'Show Calendars');
	putLink('?logout', 'Log Out');
	print('<br><br>');
}

function putLink($href, $text) {
	print(sprintf('<a href="%s" style="font-size:12px;margin-left:10px;">%s</a> | ', $href, $text));
}

function putTitle($text) {
	print(sprintf('<h3 style="font-size:16px;color:green;">%s</h3>', $text));
}

function putBlock($text) {
	print('<div display="block">' . $text . '</div>');
}

function putEvent($event) {
	putTitle('Details for event: ' . $event['summary']);
	putBlock('This event has status ' . $event['status']);
	putBlock('It was created at ' .
			date('Y-m-d H:m', strtotime($event['created'])) .
			' and last updated at ' .
			date('Y-m-d H:m', strtotime($event['updated'])) . '.');
	putBlock('For this event you have to <strong>' . $event['summary'] . '</strong>.');
}

function putEventListElement($event) {
	print('<div style="font-size:10px;color:grey;">' . date('Y-m-d H:m', strtotime($event['created'])));
	putLink('?action=printEventDetails&showThisEvent=' . htmlentities($event['id']) .
			'&calendarId=' . htmlentities($_GET['showThisCalendar']), $event['summary']);
	print('</div>');
	print('<br>');
}

function putCalendarTitle() {
	global $client;
	putTitle('These are you events for ' . getCalendar($client, $_GET['showThisCalendar'])['summary'] . ' calendar:');
}

function putCalendarListTitle() {
	putTitle('These are your calendars:');
}

function putCalendarListElement($calendar) {
	putLink('?action=printCalendarContents&showThisCalendar=' . htmlentities($calendar['id']), $calendar['summary']);
	print('<br>');
}

?>
