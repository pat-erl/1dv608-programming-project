<?php

class LoginModel {
    
    private $userName;
    private $userPassword;
    private $sessionModel;
    private $isLoggedIn;
    private $isLoggedOut;
    
    public function __construct($user, $sessionModel) {
        $this->userName = $user->getName();
        $this->userPassword = $user->getPassword();
        $this->sessionModel = $sessionModel;
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
    
    public function getSessionModel() {
        return $this->sessionModel;
    }
    
    public function setSessionModel($state) {
        $this->sessionModel = $state;
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
}