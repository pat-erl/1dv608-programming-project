<?php

date_default_timezone_set('Europe/Stockholm');

class DateTimeView {

	/*
    Displays the current date and time.
    */
    
	public function show() {
		$timeString = date('l') . ', the ' . date('jS') . ' of ' . date('F') .
		' ' . date('o') . ', The time is ' . date('H:i:s');

		return '<p>' . $timeString . '</p>';
	}
}