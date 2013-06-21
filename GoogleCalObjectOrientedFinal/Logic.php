<?php

class Logic {

	private $client;

	function __construct($client) {
		$this->client = $client;
	}

	function getCalendars() {
		return getCalendarList($this->client)['items'];
	}

	function getEventsForCalendar($calendarId) {
		return getEventList($this->client, $calendarId)['items'];
	}

	function getEventById($eventId, $calendarId) {
		foreach ($this->getEventsForCalendar($calendarId) as $event)
			if ($event['id'] == $eventId)
				return $event;

		// I knwo there is a way to retrieve an event directly by ID. Think of this
		// as our actual business logic ;)
	}

}