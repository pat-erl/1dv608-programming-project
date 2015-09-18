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
			if($this->loginModel->compareLogin($userName, $userPassword)) {
                if($this->loginView->getRequestKeep()) {
                    echo('Test: Körs om användaren tryckt på keep innan login!');
                }
                $this->loginModel->setIsLoggedIn(true);
                //$this->sessionModel->setSession('test', 'test2');
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