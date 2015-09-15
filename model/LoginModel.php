<?php

class LoginModel {
    
    private $userName;
    private $userPassword;
    private $userNameEmpty;
    private $userPasswordEmpty;
    private $userNameOk;
    private $userPasswordOk;
    private $isLoggedOut;
    
    public function __construct($user) {
        $this->userName = $user->getName();
        $this->userPassword = $user->getPassword();
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
    }
    
    public function isLoggedIn() {
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
    
    public function getIsLoggedOut() {
        return $this->isLoggedOut;
    }
    
    public function setIsLoggedOut($state) {
        $this->isLoggedOut = $state;
    }
}