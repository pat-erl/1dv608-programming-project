<?php

class RegisterController {
    
    private $sessionModel;
    private $registerModel;
    private $registerView;
    
    public function __construct($sessionModel, $registerModel, $registerView) {
        assert($sessionModel instanceof SessionModel, 'First argument was not an instance of SessionModel');
        assert($registerModel instanceof RegisterModel, 'Second argument was not an instance of RegisterModel');
        assert($registerView instanceof RegisterView, 'Third argument was not an instance of RegisterView');
        
        $this->sessionModel = $sessionModel;
        $this->registerModel = $registerModel;
        $this->registerView = $registerView;
    }
    
	public function checkIfRegister() {
		if($this->registerView->getRequestRegister()) {
			$userName = $this->registerView->getRequestName();
			$userPassword = $this->registerView->getRequestPassword();
			$userPasswordRepeat = $this->registerView->getRequestPasswordRepeat();
		
		    if($this->registerModel->doTryToRegister($userName, $userPassword, $userPasswordRepeat)) {
		        $this->sessionModel->setRegSession($userName);
		    }
		    $this->registerView->getCurrentState();
		}
	}
}