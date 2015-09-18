<?php

class SessionModel {
    
    private static $nameID = 'Name';
    private static $passID = 'Pass';
    
    public function __construct() {
      session_start();
    }
    
    public function getSession() {
        $hej = $_SESSION[self::$nameID];
        $svej = $_SESSION[self::$passID];
        return $hej+$svej;
    }
    
    public function setSession($test, $test2) {
        $_SESSION[self::$nameID] = $test;
        $_SESSION[self::$passID] = $test2;
    }
}