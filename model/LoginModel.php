<?php

class LoginModel {
    
    private $userName;
    private $userPassword;
    private $userNameEmpty = false;
    private $userPasswordEmpty = false;
    private $isLoggedIn = false;
    private $isLoggedOut = false;
    private $isAlreadyLoggedIn = false;
    
    public function __construct($currentUserModel) {
        assert($currentUserModel instanceof CurrentUserModel, 'First argument was not an instance of CurrentUserModel');
        
        $this->userName = $currentUserModel->getName();
        $this->userPassword = $currentUserModel->getPassword();
    }
	
	//Methods for validating the input.
	
	public function isEmptyName($userName) {
	    assert(is_string($userName), 'First argument was not a string');
	    
	    return empty($userName);
	}	
	
	public function isEmptyPassword($userPassword) {
	    assert(is_string($userPassword), 'First argument was not a string');
	    
	    return empty($userPassword);
	}
	
    public function isCorrectName($userName) {
        assert(is_string($userName), 'First argument was not a string');
        
        return $this->userName == $userName;
    }
    
    public function isCorrectPassword($userPassword) {
        assert(is_string($userPassword), 'First argument was not a string');
        
        return $this->userPassword == $userPassword;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getIsLoggedIn() {
        if($this->isAlreadyLoggedIn) {
            return true;
        }
        else {
            return $this->isLoggedIn;
        }
    }
    
    public function setIsLoggedIn($state) {
        assert(is_bool($state), 'First argument was not a boolean value');
        
        $this->isLoggedIn = $state;
    }
    
    public function getIsAlreadyLoggedIn() {
        return $this->isAlreadyLoggedIn;
    }
    
    public function setIsAlreadyLoggedIn($state) {
        assert(is_bool($state), 'First argument was not a boolean value');
        
        $this->isAlreadyLoggedIn = $state;
    }
    
    public function getIsLoggedOut() {
        return $this->isLoggedOut;
    }
    
    public function setIsLoggedOut($state) {
        assert(is_bool($state), 'First argument was not a boolean value');
        
        $this->isLoggedOut = $state;
    }
    
    public function getUserNameEmpty() {
        return $this->userNameEmpty;
    }
    
    public function setUserNameEmpty($state) {
        assert(is_bool($state), 'First argument was not a boolean value');
        
        $this->userNameEmpty = $state;
    }
    
    public function getUserPasswordEmpty() {
        return $this->userPasswordEmpty;
    }
    
    public function setUserPasswordEmpty($state) {
        assert(is_bool($state), 'First argument was not a boolean value');
        
        $this->userPasswordEmpty = $state;
    }
}