<?php

class LoginController {
    
    private $loginModel;
    private $loginView;
    
    public function __construct($loginModel, $loginView) {
        $this->loginModel = $loginModel;
        $this->loginVIew = $loginView;
    }
    
    public function doLogin() {
        
    }
    
    public function isLoggedIn() {
        return false;
    }
}