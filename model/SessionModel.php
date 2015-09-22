<?php

class SessionModel {
    
    private static $nameId = 'Name';
    private static $passId = 'Pass';
    
    public function __construct() {
      session_start();
    }
    
    //Returns true or false depending on if the membervariables contains data or not.
    public function existingSession() {
        return isset($_SESSION[self::$nameId]) && isset($_SESSION[self::$passId]);
    }
    
    //Saves session data in the membervariables.
    public function setSession($name, $pass) {
        assert(is_string($name), 'First argument was not a string');
        assert(is_string($pass), 'Second argument was not a string');
        
        $_SESSION[self::$nameId] = $name;
        $_SESSION[self::$passId] = $pass;
    }
    
    //Erases session data.
    public function destroySession() {
        session_destroy();
    }
}