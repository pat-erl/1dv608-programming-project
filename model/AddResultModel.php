<?php

class AddResultModel {
    
    /*
    Handles logic regarding adding results.
    */
    
    private $userCatalogue;
    private $resultTextEmpty = false;
    private $invalidCharacters = false;
    private $resultTextTooShort = false;
    private $isSuccessfulAdd = false;
    
    public function __construct($userCatalogue) {
        assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
        
        $this->userCatalogue = $userCatalogue;
    }
    
    public function doTryToAdd($resultText, $date) {
	    assert(is_string($resultText), 'First argument was not a string');
	    
	    if($this->checkIfEmptyResultText($resultText)) {
	        $this->resultTextEmpty = true;
	    }
	    else if($this->checkIfInvalidCharacters($resultText)) {
	        $this->invalidCharacters = true;
	    }
	    else if($this->checkIfTooShortResultText($resultText)) {
	        $this->resultTextTooShort = true;
	    }
	    else if($this->tryToAddResult($resultText, $date)) {
	        $this->isSuccessfulAdd = true;
	        return true;
	    }
	    else {
	        return false;
	    }
    }
    
    //Methods for validating the input.
    
    public function checkIfEmptyResultText($resultText) {
	    return empty($resultText);
	}	
	
	public function checkIfInvalidCharacters($resultText) {
        return $resultText != strip_tags($resultText);
    }
    
    public function checkIfTooShortResultText($resultText) {
        return strlen($resultText) < 3;
    }
    
    public function trytoAddResult($resultText, $date) {
        return $this->userCatalogue->addResult($resultText, $date);
    }
    
    //Getters and setters for the private membervariables.
    
    public function getResultTextEmpty() {
        return $this->resultTextEmpty;
    }
    
    public function getInvalidCharacters() {
        return $this->invalidCharacters;
    }
    
    public function getResultTextTooShort() {
        return $this->resultTextTooShort;
    }
    
    public function getIsSuccessfulAdd() {
        return $this->isSuccessfulAdd;
    }
}