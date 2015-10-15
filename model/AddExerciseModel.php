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
    private $isSuccessfulReg = false;
    
    public function __construct($userCatalogue) {
        assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
        
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
	    else if($this->userCatalogue->addExercise($this->findCurrentUser(), $exerciseName)) {
	        $this->isSuccessfulReg = true;
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
        $thisUser = $this->findCurrentUser();
        
        $exercises = $this->userCatalogue->getExercises($thisUser);
        
        foreach($exercises as $exercise) {
            if($exerciseName == $exercise->getName()) {
                return true;
            }
        }
        return false;
    }
    
    public function findCurrentUser() {
        $users = $this->userCatalogue->getUsers();
        
        foreach($users as $user) {
            if($_SESSION['Name'] == $user->getName()) { //Kolla om detta är ok verkligen.., kanske bättre att bara injecta sessionModel... kolla runt om behöver på fler ställen...
                return $user;
            }
            return null;
        }
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