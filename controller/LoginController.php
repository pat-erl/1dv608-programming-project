<?php

namespace controller;

class LoginController {
    
    private $loginModel;
    
    public function __construct($loginModel) {
        $this->loginModel = $loginModel;
    }
    
    public function doesTheUserWantToLogin() {
        
    }
    
    public function isTheUserAllowedToLogin($userName, $userPassword) {
        $testUser = false;
        $testPass = false;
        $testUser = $this->loginModel->getUserName();
        $testPass = $this->loginModel->getUserPassword();
        
        if($testUser === $userName && $testPass === $userPassword) {
            return true;
        }
        else if($testUser === $userName && $testPass !== $userPassword) {
            return false;
        }
        else if($testUser !== $userName && $testPass === $userPassword) {
            return false;
        }
        else {
            return false;
        }
    }
}