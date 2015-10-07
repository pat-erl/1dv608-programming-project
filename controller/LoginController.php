<?php

class LoginController {
    
    private $loginModel;
    private $loginView;
    
    public function __construct($loginModel, $loginView) {
        assert($loginModel instanceof LoginModel, 'First argument was not an instance of LoginModel');
        assert($loginView instanceof LoginView, 'Second argument was not an instance of LoginView');
        
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
			
			if($this->loginModel->isEmptyName($userName)) {
			    $this->loginModel->setUserNameEmpty(true);
			    $this->loginModel->setIsLoggedIn(false);
			}
			else if($this->loginModel->isEmptyPassword($userPassword)){
			    $this->loginModel->setUserPasswordEmpty(true);
			    $this->loginModel->setIsLoggedIn(false);
			}
			else if($this->loginModel->isCorrectName($userName)) {
			    $this->loginModel->setUserNameEmpty(false);
			    if($this->loginModel->isCorrectPassword($userPassword)) {
			        $this->loginModel->setUserPasswordEmpty(false);
			        $this->loginModel->setIsLoggedIn(true);
			        $this->loginModel->setIsLoggedOut(false);
			        $this->sessionModel->setSession($userName, $userPassword);
			        $this->checkIfLogout();
			    }
			    else {
			        $this->loginModel->setUserPasswordEmpty(false);
			        $this->loginModel->setIsLoggedIn(false);
			    }
			}
			else {
			    $this->loginModel->setUserNameEmpty(false);
			    $this->loginModel->setIsLoggedIn(false);
			}
			$this->loginView->getCurrentState();
        }
    }
    
    //Gets the userinput for logout and sets the current state in the Model.
    public function checkIfLogout() {
        if($this->loginView->getRequestLogout()) {
            $this->loginModel->setIsLoggedOut(true);
            $this->loginModel->setIsLoggedIn(false);
            $this->loginModel->setIsAlreadyLoggedIn(false);
            $this->sessionModel->destroySession();
            $this->loginView->getCurrentState();
        }
    }
}