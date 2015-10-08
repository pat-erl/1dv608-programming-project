<?php

class RegisterController {
    
    private $registerModel;
    private $registerView;
    
    public function __construct($registerModel, $registerView) {
        assert($registerModel instanceof RegisterModel, 'First argument was not an instance of RegisterModel');
        assert($registerView instanceof RegisterView, 'Third argument was not an instance of RegisterView');
        
        $this->registerModel = $registerModel;
        $this->registerView = $registerView;
    }
    
	public function checkIfRegister() {
		if($this->registerView->getRequestRegister()) {
			$userName = $this->registerView->getRequestName();
			$userPassword = $this->registerView->getRequestPassword();
			$userPasswordRepeat = $this->registerView->getRequestPasswordRepeat();
		
		    $this->registerModel->doTryToRegister($userName, $userPassword, $userPasswordRepeat);
		    $this->registerView->getCurrentState();
		}
	}
}