<?php

class LoginModel {
    
    /*
        Handles logic regarding login and logout.
    */
    
    private $userCatalogue;
    private $userNameEmpty = false;
    private $userPasswordEmpty = false;
    private $isLoggedIn = false;
    private $isLoggedOut = false;
    private $isAlreadyLoggedIn = false;
    
    public function __construct(UserCatalogue $userCatalogue) {
        $this->userCatalogue = $userCatalogue;
    }
	
	public function doTryToLogin($userName, $userPassword) {
	    assert(is_string($userName), 'First argument was not a string');
	    assert(is_string($userPassword), 'Second argument was not a string');
	    
	    if($this->checkIfEmptyName($userName)) {
	        $this->userNameEmpty = true;
	    }
	    else if($this->checkIfEmptyPassword($userPassword)) {
	        $this->userPasswordEmpty = true;
	    }
	    else if($this->checkIfCorrectName($userName)) {
	        if($this->checkIfCorrectPassword($userName, $userPassword)) {
	            $this->isLoggedIn = true;
	            return true;
	        }
	        else {
	            return false;
	        }
	    }
	    else {
	        return false;
	    }
	}
	
	public function doLogout() {
        $this->isLoggedOut = true;
        $this->isLoggedIn = false;
        $this->isAlreadyLoggedIn = false;
	}
	
	public function alreadyLoggedIn() {
		$this->isAlreadyLoggedIn = true;
		$this->isLoggedIn = true;
	}
	
	//Methods for validating the input.
	
	public function checkIfEmptyName($userName) {
	    return empty($userName);
	}	
	
	public function checkIfEmptyPassword($userPassword) {
	    return empty($userPassword);
	}
	
    public function checkIfCorrectName($userName) {
        return $this->userCatalogue->checkIfUserExists($userName);
    }
    
    public function checkIfCorrectPassword($userName, $userPassword) {
        return $this->userCatalogue->checkIfCorrectPassword($userName, $userPassword);
    }
    
    //Getters and setters for the private membervariables.
    
    public function getUserNameEmpty() {
        return $this->userNameEmpty;
    }
    
    public function getUserPasswordEmpty() {
        return $this->userPasswordEmpty;
    }
    
    public function getIsLoggedIn() {
        return $this->isLoggedIn;
    }
    
    public function getIsLoggedOut() {
        return $this->isLoggedOut;
    }
    
    public function getIsAlreadyLoggedIn() {
        return $this->isAlreadyLoggedIn;
    }
}