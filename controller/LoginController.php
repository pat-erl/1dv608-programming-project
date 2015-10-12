<?php

class LoginController {
    
    /*
    Handles the input from the user regarding login and logout.
    */
    
    private $sessionModel;
    private $loginModel;
    private $loginView;
    
    public function __construct($sessionModel, $loginModel, $loginView) {
    	assert($sessionModel instanceof SessionModel, 'First argument was not an instance of SessionModel');
        assert($loginModel instanceof LoginModel, 'Second argument was not an instance of LoginModel');
        assert($loginView instanceof LoginView, 'Third argument was not an instance of LoginView');
        
        $this->sessionModel = $sessionModel;
        $this->loginModel = $loginModel;
        $this->loginView = $loginView;
    }
    
    public function checkIfLogin() {
        if($this->loginView->getRequestLogin()) {
		    $userName = $this->loginView->getRequestName();
			$userPassword = $this->loginView->getRequestPassword();
			
			if($this->loginModel->doTryToLogin($userName, $userPassword)) {
				$this->sessionModel->setSession($userName, $userPassword);
				//ändra response på loginview här??
			}
			$this->loginView->getCurrentState();
        }
    }
    
    public function checkIfLogout() {
        if($this->loginView->getRequestLogout()) {
            $this->loginModel->doLogout();
            $this->sessionModel->unsetSession();
            $this->loginView->getCurrentState();
        }
    }
}