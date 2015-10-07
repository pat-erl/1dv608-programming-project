<?php

class RegisterModel {
    
    private $userCatalogue;
    private $userNameEmpty = false;
    private $userPasswordEmpty = false;
    private $userNameShort = false;
    private $userPasswordShort = false;
    private $isSuccessfulReg = false;
    private $userAlreadyExists = false;
    
    public function __construct($userCatalogue) {
        assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
        
        $this->userCatalogue = $userCatalogue;
    }
    
    public function doTryToRegister($userName, $userPassword) {
	    assert(is_string($userName), 'First argument was not a string');
	    assert(is_string($userPassword), 'Second argument was not a string');
	    
	    if($this->checkIfEmptyName($userName)) {
	        $this->userNameEmpty = true;
	    }
	    else if($this->checkIfEmptyPassword($userPassword)) {
	        $this->userPasswordEmpty = true;
	    }
	    else if($this->checkIfCorrectName($userName)) {
	        if($this->checkIfCorrectPassword($userPassword)) {
	            if($this->userCatalogue->addUser($userName, $userPassword)) {
	                $this->isSuccessfulReg = true;   
	            }
	            else {
	                $this->userAlreadyExists = true;
	            }
	        }
	        else {
	            $this->userPasswordShort = true;
	        }
	    }
	    else {
	        $this->userNameShort = true;
	    }
	}
    
    public function checkIfEmptyName($userName) {
	    return empty($userName);
	}	
	
	public function checkIfEmptyPassword($userPassword) {
	    return empty($userPassword);
	}
	
    public function checkIfCorrectName($userName) {
        return strlen($userName) >= 3;
    }
    
    public function checkIfCorrectPassword($userPassword) {
        return strlen($userPassword) >= 6;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getUserNameEmpty() {
        return $this->userNameEmpty;
    }
    
    public function getUserPasswordEmpty() {
        return $this->userPasswordEmpty;
    }
    
    public function getUserNameShort() {
        return $this->userNameShort;
    }
    
    public function getUserPasswordShort() {
        return $this->userPasswordShort;
    }
    
    public function getIsSuccessfulReg() {
        return $this->isSuccessfulReg;
    }
    
    public function getUserAlreadyExists() {
        return $this->userAlreadyExists;
    }
}