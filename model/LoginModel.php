<?php

namespace model;

class LoginModel {
    
    private $userName;
    private $userPassword;
    
    public function __construct() {
        $this->userName = 'Patrik';
        $this->userPassword = 'Losenord';
    }
    
    public function getUserName() {
        return $this->userName;
    }
    
    public function getUserPassword() {
        return $this->userPassword;
    }
}