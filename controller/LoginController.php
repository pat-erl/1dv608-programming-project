<?php

class LoginController {
    
    private $loginModel;
    private $sessionModel;
    private $loginView;
    
    public function __construct($loginModel, $sessionModel, $loginView) {
        $this->loginModel = $loginModel;
        $this->sessionModel = $sessionModel;
        $this->loginView = $loginView;
    }
    
    //Checks for active session.
    //If it exists it sets the current state in the Model and tells the View to get the current state.
    public function checkIfSession() {
        if($this->sessionModel->existingSession()) {
            $this->loginModel->setUserNameEmpty(false);
            $this->loginModel->setUserPasswordEmpty(false);
			$this->loginModel->setIsAlreadyLoggedIn(true);
			$this->loginModel->setIsLoggedOut(false);
			$this->loginView->getCurrentState();
            $this->checkIfLogout();
        }
        else {
            $this->checkIfLogin();
        }
    }

    //1. Gets the userinput and sends it to the Model for comparison.
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
    
    //Gets the userinput and sets the current state in the Model.
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