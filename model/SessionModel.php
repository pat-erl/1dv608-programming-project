<?php

class SessionModel {
    
    /*
    Handles logic regarding sessions.
    */
    
    private static $nameId = 'Name';
    private static $regNameId = 'RegName';
    
    public function __construct() {
        session_start();
    }
    
    //Returns true or false depending on if the membervariables contains data or not.
    public function existingSession() {
        return isset($_SESSION[self::$nameId]);
    }
    
    //Saves session data in the membervariables.
    public function setSession($name) {
        assert(is_string($name), 'First argument was not a string');
        
        $_SESSION[self::$nameId] = $name;
    }
    
    //Saves session data in the membervariables.
    public function setRegSession($name) {
        assert(is_string($name), 'First argument was not a string');
        
        $_SESSION[self::$regNameId] = $name;
    }
    
    //Erases session data.
    public function unsetSession() {
        unset($_SESSION[self::$nameId]);
    }
    
    //Erases session data.
    public function unsetRegSession() {
        unset($_SESSION[self::$regNameId]);
    }
}