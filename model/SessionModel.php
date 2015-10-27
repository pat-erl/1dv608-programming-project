<?php

class SessionModel {
    
    /*
        Handles logic regarding sessions.
    */
    
    private static $nameId = 'Name';
    private static $regNameId = 'RegName';
    private static $exerciseId = 'ExerciseId';
    private static $resultId = 'ResultId';
    
    public function __construct() {
        session_start();
    }
    
    public function existingSession() {
        return isset($_SESSION[self::$nameId]);
    }
    
    public function setSession($name) {
        assert(is_string($name), 'First argument was not a string');
        
        $_SESSION[self::$nameId] = $name;
    }
    
    public function setRegSession($name) {
        assert(is_string($name), 'First argument was not a string');
        
        $_SESSION[self::$regNameId] = $name;
    }
    
    public function setExerciseSession($id) {
        assert(is_numeric($id), 'First argument was not a numeric value');
        
        $_SESSION[self::$exerciseId] = $id;
    }
    
    public function setResultSession($id) {
        assert(is_numeric($id), 'First argument was not a numeric value');
        
        $_SESSION[self::$resultId] = $id;
    }
    
    public function unsetSession() {
        unset($_SESSION[self::$nameId]);
    }
    
    public function unsetRegSession() {
        unset($_SESSION[self::$regNameId]);
    }
    
    public function getStoredUserName() {
        return $_SESSION[self::$nameId];
    }
    
    public function getStoredExercise() {
        return $_SESSION[self::$exerciseId];
    }
    
    public function getStoredResult() {
        return $_SESSION[self::$resultId];
    }
}