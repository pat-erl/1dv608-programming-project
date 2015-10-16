<?php

class MainController {
    
    /*
    Checks for an existing session and calls the other controllers.
    */
    
    private $sessionModel;
    private $loginModel;
    private $registerModel;
    private $addExerciseModel;
    private $addResultModel;
    private $mainView;
    
    public function __construct($sessionModel, $loginModel, $registerModel, $addExerciseModel, $addResultModel, $mainView) {
        assert($sessionModel instanceof SessionModel, 'First argument was not an instance of SessionModel');
        assert($loginModel instanceof LoginModel, 'Second argument was not an instance of LoginModel');
        assert($registerModel instanceof RegisterModel, 'Third argument was not an instance of RegisterModel');
        assert($addExerciseModel instanceof AddExerciseModel, 'Fourth argument was not an instance of AddExerciseModel');
        assert($addResultModel instanceof AddResultModel, 'Fifth argument was not an instance of AddResultModel');
        assert($mainView instanceof MainView, 'Sixth argument was not an instance of MainView');
        
        $this->sessionModel = $sessionModel;
        $this->loginModel = $loginModel;
        $this->registerModel = $registerModel;
        $this->addExerciseModel = $addExerciseModel;
        $this->addResultModel = $addResultModel;
        $this->mainView = $mainView;
    }
    
    public function startApplication() {
        if($this->sessionModel->existingSession()) {
            $this->loginModel->alreadyLoggedIn();
            $this->mainView->currentStateInLoginView();
            $this->checkIfLogout();
        }
        else {
            $this->checkIfLogin();
        }
        
        //Här kanske det ska på något sätt kollas vart användaren har tryckt...och först då anropas den metoden som väntar på själva knapptryckningen för att skriva en post etc...
        //För sidan ska ju redan vara framme innan dessa kan användas iaf??!!!
        $this->checkIfRegister();
        $this->checkIfAddExercise();
        $this->checkIfAddResult();
    }
    
    public function checkIfLogin() {
        if($this->mainView->getRequestLoginFromLoginView()) {
		    $userName = $this->mainView->getRequestNameFromLoginView();
			$userPassword = $this->mainView->getRequestPasswordFromLoginView();
			
			if($this->loginModel->doTryToLogin($userName, $userPassword)) {
				$this->sessionModel->setSession($userName);
			}
			//Det är här som jag ska ha if else eller true catch beroende på hur insättningen gick...detta gäller samtliga nedanför med förmodligen...
			$this->mainView->currentStateInLoginView();
        }
    }
    
    public function checkIfLogout() {
        if($this->mainView->getRequestLogoutFromLoginView()) {
            $this->loginModel->doLogout();
            $this->sessionModel->unsetSession();
            $this->mainView->currentStateInLoginView();
        }
    }
    
    public function checkIfRegister() {
		if($this->mainView->getRequestRegisterFromRegisterView()) {
			$userName = $this->mainView->getRequestNameFromRegisterView();
			$userPassword = $this->mainView->getRequestPasswordFromRegisterView();
			$userPasswordRepeat = $this->mainView->getRequestPasswordRepeatFromRegisterView();
		
		    if($this->registerModel->doTryToRegister($userName, $userPassword, $userPasswordRepeat)) {
		        $this->sessionModel->setRegSession($userName);
		    }
		    $this->mainView->currentStateInRegisterView();
		}
	}
    
    public function checkIfAddExercise() {
		if($this->mainView->getRequestAddFromAddExerciseView()) {
			$exerciseName = $this->mainView->getRequestNameFromAddExerciseView();
		    
		    $this->addExerciseModel->doTryToAdd($exerciseName);
		    
		    $this->mainView->currentStateInAddExerciseView();
		}
	}
	
    public function checkIfAddResult() {
		if($this->mainView->getRequestAddFromAddResultView()) {
			$resultText = $this->mainView->getRequestTextFromAddResultView();
		    
		    $this->addResultModel->doTryToAdd($resultText);
		    
		    $this->mainView->currentStateInAddResultView();
		}
	}
}