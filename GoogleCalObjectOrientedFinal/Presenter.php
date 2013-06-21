<?php

class Presenter {

	private $businessLogic;

	function __construct(Logic $logic) {
		$this->businessLogic = $logic;
	}

	function printCalendars() {
		$this->putCalendarListTitle();
		foreach ($this->businessLogic->getCalendars() as $calendar) {
			$this->putCalendarListElement($calendar);
		}
	}

	function printCalendarContents() {
		$this->putCalendarTitle();
		$eventsForCalendar = $this->businessLogic->getEventsForCalendar(htmlspecialchars($_GET['showThisCalendar']));
		foreach ($eventsForCalendar as $event) {
			$this->putEventListElement($event);
		}
	}

	function printEventDetails() {
		$this->putEvent($this->businessLogic->getEventById($_GET['showThisEvent'], $_GET['calendarId']));
	}

	function putHome() {
		print('Welcome to Google Calendar over NetTuts Example');
	}

	function putMenu() {
		$this->putLink('?action=putHome', 'Home');
		$this->putLink('?action=printCalendars', 'Show Calendars');
		$this->putLink('?logout', 'Log Out');
		print('<br><br>');
	}

	private function putEvent($event) {
		$this->putTitle('Details for event: ' . $event['summary']);
		$this->putBlock('This event has status ' . $event['status']);
		$this->putBlock('It was created at ' .
				date('Y-m-d H:m', strtotime($event['created'])) .
				' and last updated at ' .
				date('Y-m-d H:m', strtotime($event['updated'])) . '.');
		$this->putBlock('For this event you have to <strong>' . $event['summary'] . '</strong>.');
	}

	private function putCalendarTitle() {
		global $client;
		$this->putTitle('These are you events for ' . getCalendar($client, $_GET['showThisCalendar'])['summary'] . ' calendar:');
	}

	private function putCalendarListElement($calendar) {
		$this->putLink('?action=printCalendarContents&showThisCalendar=' . htmlentities($calendar['id']), $calendar['summary']);
		print('<br>');
	}

	private function putCalendarListTitle() {
		$this->putTitle('These are your calendars:');
	}

	private function putEventListElement($event) {
		print('<div style="font-size:10px;color:grey;">' . date('Y-m-d H:m', strtotime($event['created'])));
		$this->putLink('?action=printEventDetails&showThisEvent=' . htmlentities($event['id']) .
				'&calendarId=' . htmlentities($_GET['showThisCalendar']), $event['summary']);
		print('</div>');
		print('<br>');
	}

	private function putLink($href, $text) {
		print(sprintf('<a href="%s" style="font-size:12px;margin-left:10px;">%s</a> | ', $href, $text));
	}

	private function putTitle($text) {
		print(sprintf('<h3 style="font-size:16px;color:green;">%s</h3>', $text));
	}

	private function putBlock($text) {
		print('<div display="block">' . $text . '</div>');
	}

}

?>
