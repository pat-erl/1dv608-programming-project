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
            $this->mainView->currentStateInLoginView(); //Detta kommer jag ändra på något sätt, känns lite muppigt, bättre att ha try catch och säga till view vad som ska köras och visas då istället
            $this->checkIfLogout();
        }
        else {
            $this->checkIfLogin();
        }
        if($this->mainView->getRequestRegisterPageFromNavigationView()) {
            $this->checkIfRegister();
        }
        else if($this->mainView->getRequestAddExercisePageFromNavigationView()) {
            $this->checkIfAddExercise();
        }
        else if($this->mainView->getRequestAddResultPageFromNavigationView()) {
            
        }
        else if($this->mainView->getRequestAddResultDetailedPageFromExerciseListView()) {
            $this->checkIfAddResult();
        }
        else if($this->mainView->getRequestAddResultDetailedPageFromAddResultView()) {
            $this->checkIfAddResult();
        }
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
        $exerciseId = $this->mainView->getExerciseIdFromUrl();
        $this->sessionModel->setExerciseSession($exerciseId);
        
        if($this->mainView->getRequestAddFromAddResultDetailedView()) {
            $resultText = $this->mainView->getRequestTextFromAddResultDetailedView();
            $date = $this->mainView->getRequestDateFromAddResultDetailedView();
            
            $this->addResultModel->doTryToAdd($resultText, $date);
            $this->mainView->currentStateInAddResultDetailedView();
	    }
    }
}