<?php

class RegisterController {
    
    /*
    Handles the input from the user regarding registration.
    */
    
    private $sessionModel;
    private $registerModel;
    private $mainView;
    
    public function __construct($sessionModel, $registerModel, $mainView) {
        assert($sessionModel instanceof SessionModel, 'First argument was not an instance of SessionModel');
        assert($registerModel instanceof RegisterModel, 'Second argument was not an instance of RegisterModel');
        assert($mainView instanceof MainView, 'Third argument was not an instance of MainView');
        
        $this->sessionModel = $sessionModel;
        $this->registerModel = $registerModel;
        $this->mainView = $mainView;
    }
    
	public function checkIfRegister() {
		if($this->mainView->getRequestRegisterFromRegisterView()) {
			$userName = $this->mainView->getRequestNameFromRegisterView();
			$userPassword = $this->mainView->getRequestPasswordFromRegisterView();
			$userPasswordRepeat = $this->mainView->getRequestPasswordRepeatFromRegisterView();
		
		    if($this->registerModel->doTryToRegister($userName, $userPassword, $userPasswordRepeat)) {
		        $this->sessionModel->setRegSession($userName);
		    }
		    $this->mainView->getCurrentStateFromRegisterView();
		}
	}
}