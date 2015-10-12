<?php

class AddExerciseModel {
    
    /*
    Handles logic regarding adding exercises.
    */
    
    private $exerciseCatalogue;
    private $exerciseNameEmpty = false;
    private $invalidCharacters = false;
    private $exerciseNameTooShort = false;
    private $isSuccessfulReg = false;
    private $exerciseAlreadyExists = false;
    
    public function __construct($exerciseCatalogue) {
        assert($exerciseCatalogue instanceof ExerciseCatalogue, 'First argument was not an instance of ExerciseCatalogue');
        
        $this->exerciseCatalogue = $exerciseCatalogue;
    }
    
    public function doTryToAdd($exerciseName) {
	    assert(is_string($exerciseName), 'First argument was not a string');
	    
	    if($this->checkIfEmptyExerciseName($exerciseName)) {
	        $this->exerciseNameEmpty = true;
	    }
	    else if($this->checkIfInvalidCharacters($exerciseName)) {
	        $this->invalidCharacters = true;
	    }
	    else if($this->checkIfTooShortExerciseName($exerciseName)) {
	        $this->exerciseNameTooShort = true;
	    }
	    else if($this->exerciseCatalogue->addExercise($exerciseName)) {
	        $this->isSuccessfulReg = true;
	    }
	    else {
	        $this->exerciseAlreadyExists = true;
	    }
    }
    
    //Methods for validating the input.
    
    public function checkIfEmptyExerciseName($exerciseName) {
	    return empty($exerciseName);
	}	
	
	public function checkIfInvalidCharacters($exerciseName) {
        return $exerciseName != strip_tags($exerciseName);
    }
    
    public function checkIfTooShortExerciseName($exerciseName) {
        return strlen($exerciseName) < 3;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getExerciseNameEmpty() {
        return $this->exerciseNameEmpty;
    }
    
    public function getInvalidCharacters() {
        return $this->invalidCharacters;
    }
    
    public function getExerciseNameTooShort() {
        return $this->exerciseNameTooShort;
    }
    
    public function getIsSuccessfulReg() {
        return $this->isSuccessfulReg;
    }
    
    public function getExerciseAlreadyExists() {
        return $this->exerciseAlreadyExists;
    }
}