<?php

class UserModel {
    
    private $name;
    private $password;
    private $userNameEmpty = false;
    private $userPasswordEmpty = false;
    private $userNameShort = false;
    private $userPasswordShort = false;
    
    public function __construct($name, $password) {
        $this->name = $name;
        $this->password = $password;
    }
    
    public function checkIfEmptyName($userName) {
	    assert(is_string($userName), 'First argument was not a string');
	    
	    if(empty($userName)) {
	        $this->userNameEmpty = true;
	    }
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
    
    public function getName() {
        return $this->name;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
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
}