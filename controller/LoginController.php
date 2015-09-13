<?php

class LoginController {
    
    private $loginModel;
    private $loginView;
    private $userOk;
    private $passOk;
    
    public function __construct($loginModel, $loginView) {
        $this->loginModel = $loginModel;
        $this->loginView = $loginView;
    }
    
    public function checkIfLogin() {
        $userName = '';
        $userPassword = '';
        
        if($this->loginView->getRequestLogin()) {
		    $userName = $this->loginView->getRequestUserName();
			$userPassword = $this->loginView->getRequestPassword();
			$this->compareLogin($userName, $userPassword);
		}
    }
    
    public function compareLogin($userName, $userPassword) {
        
        if($userName === $this->loginModel->getUserName()) {
            echo("användarnamn stämde");
            $this->userOk = true;
        }
        else {
            echo("användarnamn stämde inte!");
            $this->loginView->setRequestMessageId('Wrong username');
            $this->userOk = false;
        }
        
		if($userPassword === $this->loginModel->getUserPassword()) {
		    echo("lösenord stämde");
		    $this->passOk = true;
		}
		else {
		    echo("lösenord stämde inte!");
		    $this->loginView->setRequestMessageId('Wrong password');
		    $this->passOk = false;
		}
		
		$this->IsLoggedIn();
    }
    
    public function isLoggedIn() {
        if($this->userOk && $this->passOk) {
            $this->loginView->setRequestMessageId('Welcome');
            return true;
        }
        else {
            return false;
        }
    }
}