<?php

class SessionModel {
    
    /*
    Handles logic regarding sessions.
    */
    
    private static $nameId = 'Name';
    private static $passId = 'Pass';
    private static $regNameId = 'RegName';
    
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
    
    //Saves session data in the membervariables.
    public function setRegSession($name) {
        assert(is_string($name), 'First argument was not a string');
        
        $_SESSION[self::$regNameId] = $name;
    }
    
    //Erases session data.
    public function unsetSession() {
        unset($_SESSION[self::$nameId]);
        unset($_SESSION[self::$passId]);
    }
    
    //Erases session data.
    public function unsetRegSession() {
        unset($_SESSION[self::$regNameId]);
    }
}