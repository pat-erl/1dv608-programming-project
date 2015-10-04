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
    
	public function checkIfRegister() {
		if($this->registrationView->getRequestRegister()) {
			echo "test";
		}
	}
}