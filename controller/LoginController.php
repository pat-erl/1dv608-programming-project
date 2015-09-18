<?php

class LoginController {
    
    private $loginModel;
    private $loginView;
    private $sessionModel;
    
    public function __construct($loginModel, $loginView, $sessionModel) {
        
        $this->loginModel = $loginModel;
        $this->loginView = $loginView;
        $this->sessionModel = $sessionModel;
    }
    
    public function checkIfLogin() {
        
        if($this->loginView->getRequestLogin()) {
		    $userName = $this->loginView->getRequestName();
			$userPassword = $this->loginView->getRequestPassword();
			
			if($this->loginModel->isEmptyName($userName)) {
			    $this->loginModel->setIsLoggedIn(false);
			}
			else if($this->loginModel->isEmptyPassword($userPassword)){
			    $this->loginModel->setIsLoggedIn(false);
			}
			else if($this->loginModel->isCorrectName($userName)) {
			    if($this->loginModel->isCorrectPassword($userPassword)) {
			        $this->loginModel->setIsLoggedIn(true);
			    }
			    else {
			        $this->loginModel->setIsLoggedIn(false);
			    }
			}
			else {
			    $this->loginModel->setIsLoggedIn(false);
			}
			$this->loginView->getCurrentState();
        }
    }
    
    public function checkIfLogout() {
        
        if($this->loginView->getRequestLogout()) {
            $this->loginModel->setIsLoggedOut(true);
            $this->loginView->getCurrentState();
        }
    }
}