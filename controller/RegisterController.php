<?php

class RegisterController {
    
    private $userCatalogue;
    private $registerView;
    
    public function __construct($userCatalogue, $registerView) {
        assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
        assert($registerView instanceof RegisterView, 'Third argument was not an instance of RegisterView');
        
        $this->userCatalogue = $userCatalogue;
        $this->registerView = $registerView;
    }
    
	public function checkIfRegister() {
		if($this->registerView->getRequestRegister()) {
			$name = $this->registerView->getRequestName();
			$password = $this->registerView->getRequestPassword();
		
		    $user = new UserModel($name, $password);
		    
		    if($user->checkIfValid()) {
		        
		        $this->userCatalogue->addUser($user);
		    }
		   
		    $this->registerView->getCurrentState($e);
		}
	}
}