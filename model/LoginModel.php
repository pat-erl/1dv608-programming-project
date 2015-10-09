<?php

class LoginModel {
    
    private $userCatalogue;
    private $userNameEmpty = false;
    private $userPasswordEmpty = false;
    private $isLoggedIn = false;
    private $isLoggedOut = false;
    private $isAlreadyLoggedIn = false;
    private $salt = '/&tggt%F%F&ygyuIYibjiuhiu';
    
    public function __construct($userCatalogue) {
        assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
        
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
	        if($this->checkIfCorrectPassword($userPassword)) {
	            $this->isLoggedIn = true;
	            return true;
	        }
	    }
	}
	
	public function doLogout() {
        $this->isLoggedOut = true;
        $this->isLoggedIn = false;
        $this->isAlreadyLoggedIn = false;
	}
	
	public function alreadyLoggedIn() {
	    $this->userNameEmpty = false;
        $this->userPasswordEmpty = false;
		$this->isAlreadyLoggedIn = true;
		$this->isLoggedOut = false;
	}
	
	//Methods for validating the input.
	
	public function checkIfEmptyName($userName) {
	    return empty($userName);
	}	
	
	public function checkIfEmptyPassword($userPassword) {
	    return empty($userPassword);
	}
	
    public function checkIfCorrectName($userName) {
        $users = $this->userCatalogue->getUsers();
        $correct = false;
        
        foreach($users as $user) {
            if($userName == $user->getName()) {
                $correct = true;
            }
        }
        return $correct;
    }
    
    public function checkIfCorrectPassword($userPassword) {
        //Denna metod måste ta hänsyn till rätt user också!!! glöm ej!
        $users = $this->userCatalogue->getUsers();
        $correct = false;
        
        $userPassword = sha1($userPassword);
        $userPassword .= $this->salt;
        
        foreach($users as $user) {
            if($userPassword == $user->getPassword()) {
                $correct = true;
            }
        }
        return $correct;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getUserNameEmpty() {
        return $this->userNameEmpty;
    }
    
    public function getUserPasswordEmpty() {
        return $this->userPasswordEmpty;
    }
    
    public function getIsLoggedIn() {
        if($this->isAlreadyLoggedIn) {
            return true;
        }
        else {
            return $this->isLoggedIn;
        }
    }
    
    public function getIsAlreadyLoggedIn() {
        return $this->isAlreadyLoggedIn;
    }
    
    public function getIsLoggedOut() {
        return $this->isLoggedOut;
    }
}