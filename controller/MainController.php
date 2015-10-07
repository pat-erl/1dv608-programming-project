<?php

class MainController {
    
    private $sessionModel;
    private $loginModel;
    private $loginView;
    private $loginController;
    
    public function __construct($sessionModel, $loginModel, $loginView) {
        assert($sessionModel instanceof SessionModel, 'First argument was not an instance of SessionModel');
        assert($loginModel instanceof LoginModel, 'Second argument was not an instance of LoginModel');
        assert($loginView instanceof LoginView, 'Third argument was not an instance of LoginView');
        
        $this->loginModel = $loginModel;
        $this->sessionModel = $sessionModel;
        $this->loginView = $loginView;
        $this->loginController = new LoginController($loginModel, $loginView);
    }
    
    public function startApplication() {
        $this->checkIfSession();
        $this->
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
            $this->loginController->checkIfLogout();
        }
        else {
            $this->loginController->checkIfLogin();
        }
    }
}