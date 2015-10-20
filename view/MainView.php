<?php

class MainView {
    
    /*
    
    */
    
    private $userCatalogue;
    private $loginModel;
    private $registerModel;
    private $addExerciseModel;
    private $editExerciseModel;
    private $addResultModel;
    private $editResultModel;
    private $loginView;
    private $registerView;
    private $addExerciseView;
    private $editExerciseView;
    private $addResultView;
    private $editResultView;
    private $selectExerciseView;
    private $summaryView;
    private $navigationView;
	
	public function __construct($userCatalogue, $loginModel, $registerModel, 
                                $addExerciseModel, $editExerciseModel, 
                                $addResultModel, $editResultModel, 
                                $loginView, $registerView, 
                                $addExerciseView, $editExerciseView, 
                                $addResultView, $editResultView, 
                                $selectExerciseView, $summaryView, $navigationView) {

        $this->userCatalogue = $userCatalogue;
        $this->loginModel = $loginModel;
        $this->registerModel = $registerModel;
        $this->addExerciseModel = $addExerciseModel;
        $this->editExerciseModel = $editExerciseModel;
        $this->addResultModel = $addResultModel;
        $this->editResultModel = $editResultModel;
        $this->loginView = $loginView;
        $this->registerView = $registerView;
        $this->addExerciseView = $addExerciseView;
        $this->editExerciseView = $editExerciseView;
        $this->addResultView = $addResultView;
        $this->editResultView = $editResultView;
        $this->selectExerciseView = $selectExerciseView;
        $this->summaryView = $summaryView;
        $this->navigationView = $navigationView;
    }
    
    public function showHeadline() {
        $ret = "<h1>Strength Logger</h1>";
        
        if($this->loginModel->getIsLoggedIn()) {
            $currentUser = $this->userCatalogue->getCurrentUser();
            $name = $currentUser->getName();
            $name = strtolower($name);
            $name = ucfirst($name);
            
            $ret .= "<h3>" . $name . "'s log</h3>";
        }
        else {
            if($this->navigationView->isRegisterPageSet()) {
                $ret .= "<h3>Register Page</h3>";
            }
            else {
                $ret .= "<h3>Login Page</h3>";
            }
        }
        return $ret;
    }
    
    public function showLogoutPanel() {
        if($this->loginModel->getIsLoggedIn()) {
            return $this->loginView->logoutPanel();
        }
    }

    public function showContent() {
        $ret = '';
        
        if($this->loginModel->getIsLoggedIn()) {
            
            //Gets the info from NavigationView
            if($this->isSummaryPageSet()) {
                $ret .= $this->summaryView->response();
            }
            else if($this->isSelectExercisePageSet()) {
                $ret .= $this->selectExerciseView->response();
            }
            else if($this->isAddExercisePageSet()) {
                $ret .= $this->addExerciseView->response();
            }
            else if($this->isLoginPageSet()) {
                $ret .= $this->summaryView->response();
            }
            
            //Gets not the info from NavigationView.
            else if($this->isAddResultPageSetFromSummaryView()) {
                $ret .= $this->addResultView->response();
            }
            else if($this->isAddResultPageSetFromSelectExerciseView()) {
                $ret .= $this->addResultView->response();
            }
            else if($this->isEditResultPageSet()) {
                $ret .= $this->editResultView->response();
            }
            else if($this->isEditExercisePageSet()) {
                $ret .= $this->editExerciseView->response();
            }
        }
        else {
            //Gets the info from NavigationView
            if($this->isRegisterPageSet()) {
                $ret .= $this->registerView->response();
            }
            else {
                $ret .= $this->loginView->response();
            }
        }
       return $ret;
    }
    
    //Gets the info from NavigationView
    public function isSummaryPageSet() {
        return $this->navigationView->isSummaryPageSet();
    }
    public function isSelectExercisePageSet() {
        return $this->navigationView->isSelectExercisePageSet();
    }
    public function isAddExercisePageSet() {
        return $this->navigationView->isAddExercisePageSet();
    }
    public function isLoginPageSet() {
        return $this->navigationView->isLoginPageSet();
    }
    public function isRegisterPageSet() {
        return $this->navigationView->isRegisterPageSet();
    }
    
    //Gets not the info from NavigationView.
    public function isAddResultPageSetFromSummaryView() {
        return $this->summaryView->isAddResultPageSet();
    }
    public function isAddResultPageSetFromSelectExerciseView() {
        return $this->selectExerciseView->isAddResultPageSet();
    }
    public function isEditResultPageSet() {
        return $this->addResultView->isEditResultPageSet();
    }
    public function isEditExercisePageSet() {
        return $this->addResultView->isEditExercisePageSet();
    }
    
    
    
    public function getRequestAddFromAddExerciseView() {
        return $this->addExerciseView->getRequestAdd();
    }
    
    public function getRequestNameFromAddExerciseView() {
        return $this->addExerciseView->getRequestName();
    }



    public function getRequestLoginFromLoginView() {
        return $this->loginView->getRequestLogin();
    }
    
    public function getRequestLogoutFromLoginView() {
        return $this->loginView->getRequestLogout();
    }
    
    public function getRequestNameFromLoginView() {
        return $this->loginView->getRequestName();
    }
    
    public function getRequestPasswordFromLoginView() {
        return $this->loginView->getRequestPassword();
    }
    
    
    
    public function getRequestRegisterFromRegisterView() {
        return $this->registerView->getRequestRegister();
    }
    
    public function getRequestNameFromRegisterView() {
        return $this->registerView->getRequestName();
    }
    
    public function getRequestPasswordFromRegisterView() {
        return $this->registerView->getRequestPassword();
    }
    
    public function getRequestPasswordRepeatFromRegisterView() {
        return $this->registerView->getRequestPasswordRepeat();
    }
    
    

    public function getRequestAddFromAddResultView() {
        return $this->addResultView->getRequestAdd();
    }
    
    public function getRequestTextFromAddResultView() {
        return $this->addResultView->getRequestText();
    }
    
    public function getRequestDateFromAddResultView() {
        return $this->addResultView->getRequestDate();
    }
    
    
    
    public function getRequestEditFromEditResultView() {
        return $this->editResultView->getRequestEdit();
    }
    public function getRequestTextFromEditResultView() {
        return $this->editResultView->getRequestText();
    }
    public function getRequestDateFromEditResultView() {
        return $this->editResultView->getRequestDate();
    }
    
    
    
    public function getRequestEditFromEditExerciseView() {
        return $this->editExerciseView->getRequestEdit();
    }
    public function getRequestNameFromEditExerciseView() {
        return $this->editExerciseView->getRequestName();
    }
    
    
    
    public function getExerciseIdFromUrl() {
        return $_GET['addresultpage'];
    }
    
    public function getResultIdFromUrl() {
        return $_GET['editresultpage'];
    }
    
    
    
    public function currentStateInLoginView() {
        $this->loginView->currentState();
    }
    
    public function currentStateInRegisterView() {
        $this->registerView->currentState();
    }
    
    public function currentStateInAddExerciseView() {
        $this->addExerciseView->currentState();
    }
    
    public function currentStateInEditExerciseView() {
        $this->editExerciseView->currentState();
    }
    
    public function currentStateInAddResultView() {
        $this->addResultView->currentState();
    }
    
    public function currentStateInEditResultView() {
        $this->editResultView->currentState();
    }
}