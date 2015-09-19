<?php

class SessionModel {
    
    private static $nameId = 'Name';
    private static $passId = 'Pass';
    
    public function __construct() {
      session_start();
    }
    
    public function existingSession() {
        return isset($_SESSION[self::$nameId]) && isset($_SESSION[self::$passId]);
    }
    
    public function getSessionName() {
        return $_SESSION[self::$nameId];
    }
    
    public function getSessionPass() {
        return $_SESSION[self::$passId];
    }
    
    public function setSession($name, $pass) {
        $_SESSION[self::$nameId] = $name;
        $_SESSION[self::$passId] = $pass;
    }
}