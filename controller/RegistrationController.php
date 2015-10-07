<?php

class RegistrationController {
    
    private $userCatalogue;
    private $registrationView;
    
    public function __construct($userCatalogue, $registrationView) {
        assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
        assert($registrationView instanceof RegistrationView, 'Third argument was not an instance of RegistrationView');
        
        $this->userCatalogue = $userCatalogue;
        $this->registrationView = $registrationView;
    }
    
	public function checkIfRegister() {
		if($this->registrationView->getRequestRegister()) {
			$name = $this->registrationView->getRequestName();
			$password = $this->registrationView->getRequestPassword();
			$this->userCatalogue->addUser($name, $password);
			
			//header('location: ?');
		}
	}
}