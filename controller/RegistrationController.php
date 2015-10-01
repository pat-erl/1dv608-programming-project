<?php

class RegistrationController {
    
    private $registrationModel;
    private $registrationView;
    
    public function __construct($registrationModel, $registrationView) {
        assert($registrationModel instanceof RegistrationModel, 'First argument was not an instance of RegistrationModel');
        assert($registrationView instanceof RegistrationView, 'Third argument was not an instance of RegistrationView');
        
        $this->registrationModel = $registrationModel;
        $this->registrationView = $registrationView;
    }

    public function checkIfWantsToRegister() {
        
        //if($this->registrationView->getRequestRegister() {
            
        //}
    
        /*
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
        */
    }
    
}