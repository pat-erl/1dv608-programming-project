<?php

class LoginController {
    
    private $loginModel;
    private $loginView;
    
    public function __construct($loginModel, $loginView) {
        $this->loginModel = $loginModel;
        $this->loginView = $loginView;
    }
    
    public function checkIfLogin() {
        $userName;
        $userPassword;
        
        if($this->loginView->getRequestLogin()) {
		    $userName = $this->loginView->getRequestUserName();
			$userPassword = $this->loginView->getRequestPassword();
			$this->compareLogin($userName, $userPassword);
		}
    }
    
    public function compareLogin($userName, $userPassword) {
        if($userName === $this->loginModel->getUserName()) {
            echo("användarnamn stämde");
        }
        else {
            echo("användarnamn stämde inte!");
        }
        
		if($userPassword === $this->loginModel->getUserPassword()) {
		    echo("lösenord stämde");
		}
		else {
		    echo("lösenord stämde inte!");
		}
    }
    
    public function isLoggedIn() {
        return false;
    }
}