<?php

class MainController {
    
    /*
    
    */
    
    private $userCatalogue;
    private $sessionModel;
    private $loginModel;
    private $registerModel;
    private $addExerciseModel;
    private $editExerciseModel;
    private $addResultModel;
    private $editResultModel;
    private $mainView;
    
    public function __construct(UserCatalogue $userCatalogue, SessionModel $sessionModel, LoginModel $loginModel, RegisterModel $registerModel, 
                                AddExerciseModel $addExerciseModel, EditExerciseModel $editExerciseModel, 
                                AddResultModel $addResultModel, EditResultModel $editResultModel, MainView $mainView) {
        
        $this->userCatalogue = $userCatalogue;
        $this->sessionModel = $sessionModel;
        $this->loginModel = $loginModel;
        $this->registerModel = $registerModel;
        $this->addExerciseModel = $addExerciseModel;
        $this->editExerciseModel = $editExerciseModel;
        $this->addResultModel = $addResultModel;
        $this->editResultModel = $editResultModel;
        $this->mainView = $mainView;
    }
    
    //Checks which method to run.
    public function startApplication() {
        if($this->sessionModel->existingSession()) {
            $this->loginModel->alreadyLoggedIn();
            $this->mainView->currentStateInLoginView(); //Detta kommer jag ändra på något sätt, känns lite muppigt, bättre att ha try catch och säga till view vad som ska köras och visas då istället
            $this->checkIfLogout();
        }
        else {
            $this->checkIfLogin();
        }
        
        if($this->mainView->isAddExercisePageSet()) {
            $this->checkIfAddExercise();
        }
        else if($this->mainView->isLoginPageSet()) {
            $this->checkIfLogin();
        }
        else if($this->mainView->isRegisterPageSet()) {
            $this->checkIfRegister();
        }
        else if($this->mainView->isAddResultPageSetFromSummaryView() || $this->mainView->isAddResultPageSetFromSelectExerciseView()) {
            $this->checkIfAddResult();
        }
        else if($this->mainView->isEditResultPageSet()) {
            $this->checkIfEditResult();
        }
        else if($this->mainView->isEditExercisePageSet()) {
            $this->checkIfEditExercise();
        }
        else if($this->mainView->isDeleteResultPageSet()) {
            $this->checkIfDeleteResult();
        }
        else if($this->mainView->isDeleteExercisePageSet()) {
            $this->checkIfDeleteExercise();;
        }
    }
    
    public function checkIfLogout() {
        if($this->mainView->getRequestLogoutFromLoginView()) {
            $this->loginModel->doLogout();
            $this->sessionModel->unsetSession();
            $this->mainView->currentStateInLoginView();
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
			//Kanske bara skicka iväg ett meddelande till view??
			$this->mainView->currentStateInLoginView();
        }
    }
    
    public function checkIfAddExercise() {
		if($this->mainView->getRequestAddFromAddExerciseView()) {
			$exerciseName = $this->mainView->getRequestNameFromAddExerciseView();
		    $this->addExerciseModel->doTryToAdd($exerciseName);
		    $this->mainView->currentStateInAddExerciseView();
		}
	}
	
	public function checkIfEditExercise() {
		if($this->mainView->getRequestEditFromEditExerciseView()) {
			$exerciseName = $this->mainView->getRequestNameFromEditExerciseView();
		    $this->editExerciseModel->doTryToEdit($exerciseName);
		    $this->mainView->currentStateInEditExerciseView();
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
    
    public function checkIfAddResult() {
        $exerciseId = $this->mainView->getExerciseIdFromUrl();
        $this->sessionModel->setExerciseSession($exerciseId);
        
        if($this->mainView->getRequestAddFromAddResultView()) {
            $resultText = $this->mainView->getRequestTextFromAddResultView();
            $date = $this->mainView->getRequestDateFromAddResultView();
            $this->addResultModel->doTryToAdd($resultText, $date);
            $this->mainView->currentStateInAddResultView();
	    }
    }
    
    public function checkIfEditResult() {
        $resultId = $this->mainView->getResultIdFromUrl();
        $this->sessionModel->setResultSession($resultId);
        
        if($this->mainView->getRequestEditFromEditResultView()) {
            $resultText = $this->mainView->getRequestTextFromEditResultView();
            $date = $this->mainView->getRequestDateFromEditResultView();
            $this->editResultModel->doTryToEdit($resultText, $date);
            $this->mainView->currentStateInEditResultView();
	    }
    }
    
    public function checkIfDeleteResult() {
        $resultId = $this->mainView->getResultIdToDeleteFromUrl();
        $this->sessionModel->setResultSession($resultId);
        
        if($this->mainView->getRequestDeleteFromDeleteResultView()) {
            $this->userCatalogue->deleteResult();
        }
    }
    
    public function checkIfDeleteExercise() {
        $exerciseId = $this->mainView->getExerciseIdToDeleteFromUrl();
        $this->sessionModel->setExerciseSession($exerciseId);
        
        if($this->mainView->getRequestDeleteFromDeleteExerciseView()) {
            $this->userCatalogue->deleteExercise();
        }
    }
}