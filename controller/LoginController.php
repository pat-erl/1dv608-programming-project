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
    
    public function checkIfSession() {
        if($this->sessionModel->existingSession()) {
            
            var_dump($this->sessionModel->getSessionName());
			var_dump($this->sessionModel->getSessionPass());
            //Om finns existing session kanske ändra states härifrån då??
             //Som vid en korrekt login!
             //Getcurrent state då också!
            //Hämta värdena i session med getsession()???
            //Måste det jämföras igen???
            $this->checkIfLogout();
        }
        else {
            $this->checkIfLogin();
        }
    }

    
    
    //1. Gets the userinput and sends it to the Model for comparison.
    //2. Uses the response from the Model to set the current states in the Model.
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
			        $this->sessionModel->setSession($userName, $userPassword);
			        //När input är ok, släng in dem i session då!
			        //Kanske måste köra checklogout här då när det lyckas???
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
    
    public function checkIfLogout() {
        if($this->loginView->getRequestLogout()) {
            $this->loginModel->setIsLoggedOut(true);
            $this->loginModel->setIsLoggedIn(false);
            $this->loginView->getCurrentState();
        }
    }
}