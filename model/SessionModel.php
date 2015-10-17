<?php

class SessionModel {
    
    /*
    Handles logic regarding sessions.
    */
    
    private static $nameId = 'Name';
    private static $regNameId = 'RegName';
    private static $exerciseId = 'ExerciseId';
    
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
    
    //Saves session data in the membervariables.
    public function setExerciseSession($id) {
        assert(is_numeric($id), 'First argument was not a numeric value');
        
        $_SESSION[self::$exerciseId] = $id;
    }
    
    //Erases session data.
    public function unsetSession() {
        unset($_SESSION[self::$nameId]);
    }
    
    //Erases session data.
    public function unsetRegSession() {
        unset($_SESSION[self::$regNameId]);
    }
    
    public function getStoredUserName() {
        return $_SESSION[self::$nameId];
    }
    
    public function getStoredExercise() {
        return $_SESSION[self::$exerciseId];
    }
}