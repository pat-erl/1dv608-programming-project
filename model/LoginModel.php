<?php

class LoginModel {
    
    private $userName;
    private $userPassword;
    private $userNameEmpty;
    private $userPasswordEmpty;
    private $isLoggedIn;
    private $isLoggedOut;
    
    public function __construct($user) {
        $this->userName = $user->getName();
        $this->userPassword = $user->getPassword();
    }
	
	public function isEmptyName($userName) {
	    return empty($userName);
	}	
	
	public function isEmptyPassword($userPassword) {
	    return empty($userPassword);
	}
	
    public function isCorrectName($userName) {
        return $this->userName == $userName;
    }
    
    public function isCorrectPassword($userPassword) {
        return $this->userPassword == $userPassword;
    }
    
    public function getIsLoggedIn() {
        return $this->isLoggedIn;
    }
    
    public function setIsLoggedIn($state) {
        $this->isLoggedIn = $state;
    }
    
    public function getIsLoggedOut() {
        return $this->isLoggedOut;
    }
    
    public function setIsLoggedOut($state) {
        $this->isLoggedOut = $state;
    }
    
    public function getUserNameEmpty() {
        return $this->userNameEmpty;
    }
    
    public function setUserNameEmpty($state) {
        $this->userNameEmpty = $state;
    }
    
    public function getUserPasswordEmpty() {
        return $this->userPasswordEmpty;
    }
    
    public function setUserPasswordEmpty($state) {
        $this->userPasswordEmpty = $state;
    }
}