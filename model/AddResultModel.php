<?php

class AddResultModel {
    
    private $logEntryEmpty = false;
    private $invalidCharacters = false;
    private $logEntryTooShort = false;
    private $isSuccessfulReg = false;
    
    public function __construct() {

    }
    
    public function doTryToAdd($logEntry) {
	    assert(is_string($logEntry), 'First argument was not a string');
	    
	    if($this->checkIfEmptyLogEntry($logEntry)) {
	        $this->logEntryEmpty = true;
	    }
	    else if($this->checkIfInvalidCharacters($logEntry)) {
	        $this->invalidCharacters = true;
	    }
	    else if($this->checkIfTooShortLogEntry($logEntry)) {
	        $this->logEntryTooShort = true;
	    }
	    /*
	    else if($this->logEntryCatalogue->addLogEntry($logEntry)) {
	        $this->isSuccessfulReg = true;
	    }
	    else {
	        
	    }
	    */
    }
    
    //Methods for validating the input.
    
    public function checkIfEmptylogEntry($logEntry) {
	    return empty($logEntry);
	}	
	
	public function checkIfInvalidCharacters($logEntry) {
        return $logEntry != strip_tags($logEntry);
    }
    
    public function checkIfTooShortLogEntry($logEntry) {
        return strlen($logEntry) < 3;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getLogEntryEmpty() {
        return $this->logEntryEmpty;
    }
    
    public function getInvalidCharacters() {
        return $this->invalidCharacters;
    }
    
    public function getLogEntryTooShort() {
        return $this->logEntryTooShort;
    }
    
    public function getIsSuccessfulReg() {
        return $this->isSuccessfulReg;
    }
}