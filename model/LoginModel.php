<?php

class LoginModel {
    
    private $userName;
    private $userPassword;
    private $sessionModel;
    private $userNameEmpty;
    private $userPasswordEmpty;
    private $userNameOk;
    private $userPasswordOk;
    private $isLoggedIn;
    private $isLoggedOut;
    
    public function __construct($user, $sessionModel) {
        $this->userName = $user->getName();
        $this->userPassword = $user->getPassword();
        $this->sessionModel = $sessionModel;
    }
		
    public function compareLogin($userName, $userPassword) {
        if(empty($userName)) {
            $this->userNameEmpty = true;
        }
        if(empty($userPassword)) {
            $this->userPasswordEmpty = true;
        }
        if($userName === $this->userName) {
            $this->userNameOk = true;
        }
        else {
            $this->userNameOk = false;
        }
        if($userPassword === $this->userPassword) {
            $this->userPasswordOk = true;
        }
        else {
            $this->userPasswordOk = false;
        }
        
        return $this->userNameOk && $this->userPasswordOk;
    }
    
    public function getUserNameEmpty() {
        return $this->userNameEmpty;
    }
    
    public function getUserPasswordEmpty() {
        return $this->userPasswordEmpty;
    }
    
    public function getUserNameOk() {
        return $this->userNameOk;
    }
    
    public function getUserPasswordOk() {
        return $this->userPasswordOk;
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