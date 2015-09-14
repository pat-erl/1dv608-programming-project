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
        if($this->checkIfEmptyUserName($userName)) {
            $this->userNameEmpty = true;
        }
        else {
            if($this->checkIfEmptyUserPassword($userPassword)) {
                $this->userPasswordEmpty = true;
            }
            else {
                if($this->compareUserName($userName)) {
                    $this->userNameOk = true;
                    if($this->compareUserPassword($userPassword)) {
                        $this->userPasswordOk = true;
                    }
                    else {
                        $this->userPasswordOk = false;
                    }
                }
                else {
                    $this->userNameOk = false;
                }
            }
        }
    }
    
    public function checkIfEmptyUserName($userName) {
        return empty($userName);
    }
    
    public function checkIfEmptyUserPassword($userPassword) {
        return empty($userPassword);
    }
    
    public function compareUserName($userName) {
        return $userName === $this->userName;
    }
        
    public function compareUserPassword($userPassword) {
        return $userPassword === $this->userPassword;
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