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
    private $deleteExerciseView;
    private $addResultView;
    private $editResultView;
    private $deleteResultView;
    private $selectExerciseView;
    private $summaryView;
    private $navigationView;
	
	public function __construct(UserCatalogue $userCatalogue, LoginModel $loginModel, RegisterModel $registerModel, 
                                AddExerciseModel $addExerciseModel, EditExerciseModel $editExerciseModel, 
                                AddResultModel $addResultModel, EditResultModel $editResultModel, 
                                LoginView $loginView, RegisterView $registerView, 
                                AddExerciseview $addExerciseView, EditExerciseView $editExerciseView, DeleteExerciseView $deleteExerciseView, 
                                AddResultView $addResultView, EditResultView $editResultView, DeleteResultView $deleteResultView, 
                                SelectExerciseView $selectExerciseView, SummaryView $summaryView, NavigationView $navigationView) {

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
        $this->deleteExerciseView = $deleteExerciseView;
        $this->addResultView = $addResultView;
        $this->editResultView = $editResultView;
        $this->deleteResultView = $deleteResultView;
        $this->selectExerciseView = $selectExerciseView;
        $this->summaryView = $summaryView;
        $this->navigationView = $navigationView;
    }
    
    public function showHeadline() {
        $ret = "<h1>Result Logger</h1>";
        
        if($this->loginModel->getIsLoggedIn()) {
            $currentUser = $this->userCatalogue->getCurrentUser();
            
            $ret .= "<h3>" . $currentUser->getName() . "'s log</h3>";
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
            else if(($this->getRequestAddFromAddExerciseView() && $this->addExerciseModel->getIsSuccessfulAdd()) || $this->getRequestDeleteFromDeleteExerciseView()) {
                //Detta har jag fått från http://stackoverflow.com/questions/11072042/headerlocation-redirect-works-on-localhost-but-not-on-remote-server
                $host  = $_SERVER['HTTP_HOST'];
			    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			    $extra = "?selectexercisepage";
			    header("Location: http://$host$uri/$extra");
            }
            else if($this->isAddExercisePageSet()) {
                $ret .= $this->addExerciseView->response();
            }
            else if($this->isLoginPageSet()) {
                $ret .= $this->summaryView->response();
            }
            
            //Gets not the info from NavigationView.
            else if($this->isAddResultPageSetFromSummaryView() || $this->isAddResultPageSetFromSelectExerciseView()) {
                $ret .= $this->addResultView->response();
            }
            else if(($this->getRequestEditFromEditResultView() && $this->editResultModel->getIsSuccessfulEdit()) || ($this->getRequestEditFromEditExerciseView() && $this->editExerciseModel->getIsSuccessfulEdit()) || $this->getRequestDeleteFromDeleteResultView()) {
                $currentUser = $this->userCatalogue->getCurrentUser();
                $exercises = $this->userCatalogue->getExercises($currentUser);
                $currentExercise = $this->userCatalogue->getCurrentExercise($exercises);
                $id = $currentExercise->getId();
			    $host  = $_SERVER['HTTP_HOST'];
			    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			    $extra = "?addresultpage=$id";
			    header("Location: http://$host$uri/$extra");
            }
            else if($this->isEditResultPageSet()) {
                $ret .= $this->editResultView->response();
            }
            else if($this->isEditExercisePageSet()) {
                $ret .= $this->editExerciseView->response();
            }
            else if($this->isDeleteResultPageSet()) {
                $ret .= $this->deleteResultView->response();
            }
            else if($this->isDeleteExercisePageSet()) {
                $ret .= $this->deleteExerciseView->response();
            }
            else {
                $ret .= $this->summaryView->response();
            }
        }
        else {
            if($this->getRequestLogoutFromLoginView() || ($this->getRequestRegisterFromRegisterView() && $this->registerModel->getIsSuccessfulReg())) {
			    $host  = $_SERVER['HTTP_HOST'];
			    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			    $extra = "?loginpage";
			    header("Location: http://$host$uri/$extra");
            }
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
    public function isDeleteResultPageSet() {
        return $this->addResultView->isDeleteResultPageSet();
    }
    public function isDeleteExercisePageSet() {
        return $this->addResultView->isDeleteExercisePageSet();
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
    
    

    public function getRequestDeleteFromDeleteResultView() {
        return $this->deleteResultView->getRequestDelete();
    }
    
    
    
    public function getRequestDeleteFromDeleteExerciseView() {
        return $this->deleteExerciseView->getRequestDelete();
    }
    
    
    
    
    
    public function getExerciseIdFromUrl() {
        return $_GET['addresultpage'];
    }
    
    public function getResultIdFromUrl() {
        return $_GET['editresultpage'];
    }
    
    public function getExerciseIdToDeleteFromUrl() {
        return $_GET['deleteexercisepage'];
    }
    
    public function getResultIdToDeleteFromUrl() {
        return $_GET['deleteresultpage'];
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