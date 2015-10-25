<?php

class AddExerciseModel {
    
    /*
        Handles logic regarding adding exercises.
    */
    
    private $userCatalogue;
    private $exerciseNameEmpty = false;
    private $invalidCharacters = false;
    private $exerciseNameTooShort = false;
    private $exerciseAlreadyExists = false;
    private $isSuccessfulAdd = false;
    
    public function __construct(UserCatalogue $userCatalogue) {
        $this->userCatalogue = $userCatalogue;
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
	    else if($this->checkIfExerciseAlreadyExists($exerciseName)) {
	        $this->exerciseAlreadyExists = true;
	    }
	    else if($this->tryToAddExercise($exerciseName)) {
	        $this->isSuccessfulAdd = true;
	        return true;
	    }
	    else {
	        return false;
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
    
    public function checkIfExerciseAlreadyExists($exerciseName) {
        return $this->userCatalogue->checkIfExerciseExists($exerciseName);
    }
    
    public function tryToAddExercise($exerciseName) {
        return $this->userCatalogue->addExercise($exerciseName);
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
    
    public function getIsSuccessfulAdd() {
        return $this->isSuccessfulAdd;
    }
    
    public function getExerciseAlreadyExists() {
        return $this->exerciseAlreadyExists;
    }
}