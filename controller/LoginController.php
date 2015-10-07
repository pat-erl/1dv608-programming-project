<?php

class LoginController {
    
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
    
    //1. Gets the userinput for login and sends it to the Model for comparison.
    //2. Uses the response from the Model to set the current state in the Model.
    //3. Tells the View to get the current state.
    public function checkIfLogin() {
        if($this->loginView->getRequestLogin()) {
		    $userName = $this->loginView->getRequestName();
			$userPassword = $this->loginView->getRequestPassword();
			
			if($this->loginModel->doTryToLogin($userName, $userPassword)) {
				$this->sessionModel->setSession($userName, $userPassword);
			}
			$this->loginView->getCurrentState();
        }
    }
    
    //Gets the userinput for logout and sets the current state in the Model.
    public function checkIfLogout() {
        if($this->loginView->getRequestLogout()) {
            $this->loginModel->doLogout();
            $this->sessionModel->destroySession();
            $this->loginView->getCurrentState();
        }
    }
}