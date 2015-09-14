<?php

class LoginModel {
    
    private $userName;
    private $userPassword;
    private $userNameEmpty;
    private $userPasswordEmpty;
    private $userNameOk;
    private $userPasswordOk;
    
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
        if(empty($userName)) {
            return true;
		}
		else {
		    return false;
        }
    }
    
    public function checkIfEmptyUserPassword($userPassword) {
        if(empty($userPassword)) {
            return true;
		}
		else {
		    return false;
        }
    }
    
    public function compareUserName($userName) {
        if($userName === $this->userName) {
            return true;
        }
        else {
            return false;
        }
    }
        
    public function compareUserPassword($userPassword) {
        
		if($userPassword === $this->userPassword) {
		    return true;
		}
		else {
		    return false;
		}
    }
    
    public function isLoggedIn() {
        if($this->userNameOk && $this->userPasswordOk) {
            return true;
        }
        else {
            return false;
        }
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
}