<?php

class LoginController {
    
    /*
    Handles the input from the user regarding login and logout.
    */
    
    private $sessionModel;
    private $loginModel;
    private $mainView;
    
    public function __construct($sessionModel, $loginModel, $mainView) {
    	assert($sessionModel instanceof SessionModel, 'First argument was not an instance of SessionModel');
        assert($loginModel instanceof LoginModel, 'Second argument was not an instance of LoginModel');
        assert($mainView instanceof MainView, 'Third argument was not an instance of MainView');
        
        $this->sessionModel = $sessionModel;
        $this->loginModel = $loginModel;
        $this->mainView = $mainView;
    }
    
    public function checkIfLogin() {
        if($this->mainView->getRequestLoginFromLoginView()) {
		    $userName = $this->mainView->getRequestNameFromLoginView();
			$userPassword = $this->mainView->getRequestPasswordFromLoginView();
			
			if($this->loginModel->doTryToLogin($userName, $userPassword)) {
				$this->sessionModel->setSession($userName, $userPassword);
			}
			$this->mainView->getCurrentStateFromLoginView();
        }
    }
    
    public function checkIfLogout() {
        if($this->mainView->getRequestLogoutFromLoginView()) {
            $this->loginModel->doLogout();
            $this->sessionModel->unsetSession();
            $this->mainView->getCurrentStateFromLoginView();
        }
    }
}