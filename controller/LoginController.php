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
			
			if(empty($userName) && empty($userPassword)) {
			    $this->loginView->setRequestMessageId('Username and password are missing');
			}
			else {
			    if(empty($userName)) {
			        $this->loginView->setRequestMessageId('Username is missing');
    			}
    			else if(empty($userPassword)) {
    			    $this->loginView->setRequestMessageId('Password is missing');
    			}
    			else {
    			    $this->compareLogin($userName, $userPassword);
    			}
			}
		}
    }
    
    public function compareLogin($userName, $userPassword) {
        
        if($userName === $this->loginModel->getUserName()) {
            $this->userOk = true;
        }
        else {
            $this->loginView->setRequestMessageId('Wrong username');
            $this->userOk = false;
        }
        
		if($userPassword === $this->loginModel->getUserPassword()) {
		    $this->passOk = true;
		}
		else {
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