<?php

date_default_timezone_set('Europe/Stockholm');

class DateTimeView {

	//Sets the current date and time.
	public function show() {

		$timeString = date('l') . ', the ' . date('j') . 'th of ' . date('F') .
		' ' . date('o') . ', The time is ' . date('H:i');

		return '<p>' . $timeString . '</p>';
	}
}