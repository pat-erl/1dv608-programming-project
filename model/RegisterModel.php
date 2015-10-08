<?php

class RegisterModel {
    
    private $userCatalogue;
    private $userNameEmpty = false;
    private $userPasswordEmpty = false;
    private $invalidCharacters = false;
    private $userNameTooShort = false;
    private $userPasswordTooShort = false;
    private $failedPasswordMatch = false;
    private $isSuccessfulReg = false;
    private $userAlreadyExists = false;
    
    public function __construct($userCatalogue) {
        assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
        
        $this->userCatalogue = $userCatalogue;
    }
    
    public function doTryToRegister($userName, $userPassword, $userPasswordRepeat) {
	    assert(is_string($userName), 'First argument was not a string');
	    assert(is_string($userPassword), 'Second argument was not a string');
	    assert(is_string($userPasswordRepeat), 'Third argument was not a string');
	    
	    if($this->checkIfEmptyName($userName)) {
	        $this->userNameEmpty = true;
	    }
	    else if($this->checkIfEmptyPassword($userPassword)) {
	        $this->userPasswordEmpty = true;
	    }
	    else if($this->checkIfInvalidCharacters($userName)) {
	        $this->invalidCharacters = true;
	    }
	    else if($this->checkIfTooShortName($userName)) {
	        $this->userNameTooShort = true;
	    }
	    else if($this->checkIfTooShortPassword($userPassword)) {
	        $this->userPasswordTooShort = true;
	    }
	    else if($this->checkIfFailedPasswordMatch($userPassword, $userPasswordRepeat)) {
	        $this->failedPasswordMatch = true;
	    }
	    else if($this->userCatalogue->addUser($userName, $userPassword)) {
	        $this->isSuccessfulReg = true;
	    }
	    else {
	        $this->userAlreadyExists = true;
	    }
    }
    
    public function checkIfEmptyName($userName) {
	    return empty($userName);
	}	
	
	public function checkIfEmptyPassword($userPassword) {
	    return empty($userPassword);
	}
	
	public function checkIfInvalidCharacters($userName) {
        return $userName != strip_tags($userName);
    }
    
    public function checkIfTooShortName($userName) {
        return strlen($userName) < 3;
    }
    
    public function checkIfTooShortPassword($userPassword) {
        return strlen($userPassword) < 6;
    }
    
    public function checkIfFailedPasswordMatch($userPassword, $userPasswordRepeat) {
        return $userPassword != $userPasswordRepeat;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getUserNameEmpty() {
        return $this->userNameEmpty;
    }
    
    public function getUserPasswordEmpty() {
        return $this->userPasswordEmpty;
    }
    
    public function getInvalidCharacters() {
        return $this->invalidCharacters;
    }
    
    public function getUserNameTooShort() {
        return $this->userNameTooShort;
    }
    
    public function getUserPasswordTooShort() {
        return $this->userPasswordTooShort;
    }
    
    public function getFailedPasswordMatch() {
        return $this->failedPasswordMatch;    
    }
    
    public function getIsSuccessfulReg() {
        return $this->isSuccessfulReg;
    }
    
    public function getUserAlreadyExists() {
        return $this->userAlreadyExists;
    }
}