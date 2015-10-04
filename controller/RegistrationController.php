<?php

class RegistrationController {
    
    private $registrationModel;
    private $registrationView;
    private $layoutView;
    
    public function __construct($registrationModel, $registrationView, $layoutView) {
        assert($registrationModel instanceof RegistrationModel, 'First argument was not an instance of RegistrationModel');
        assert($registrationView instanceof RegistrationView, 'Third argument was not an instance of RegistrationView');
        assert($layoutView instanceof LayoutView, 'Fourth argument was not an instance of LayoutView');
        
        $this->registrationModel = $registrationModel;
        $this->registrationView = $registrationView;
        $this->layoutView = $layoutView;
    }

	public function hasClickedRegLink() {
		if($_GET['register'] == 'new') { //Fixa så själva get bara ligger i view sedan!!!
			$this->registrationModel->setHasClickedRegLink(true);
		}
		else {
			$this->registrationModel->setHasClickedRegLink(false);
		}
	}
}