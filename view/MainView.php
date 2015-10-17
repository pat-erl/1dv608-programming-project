<?php

class MainView {
    
    private $userCatalogue;
    private $loginModel;
    private $registerModel;
    private $addExerciseModel;
    private $addResultModel;
    private $loginView;
    private $registerView;
    private $addExerciseView;
    private $addResultView;
    private $addResultDetailedView;
    private $exerciseListView;
    private $navigationView;
	
	public function __construct($userCatalogue, $loginModel, $registerModel, $addExerciseModel, $addResultModel, $loginView, $registerView, $addExerciseView, $addResultView, $addResultDetailedView, $exerciseListView, $navigationView) {
		assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
		assert($loginModel instanceof LoginModel, 'Second argument was not an instance of LoginModel');
		assert($registerModel instanceof RegisterModel, 'Third argument was not an instance of RegisterModel');
		assert($addExerciseModel instanceof AddExerciseModel, 'Fourth argument was not an instance of AddExerciseModel');
		assert($addResultModel instanceof AddResultModel, 'Fifth argument was not an instance of AddResultModel');
		assert($loginView instanceof LoginView, 'Sixth argument was not an instance of LoginView');
		assert($registerView instanceof RegisterView, 'Seventh argument was not an instance of RegisterView');
		assert($addExerciseView instanceof AddExerciseView, 'Eighteth argument was not an instance of AddExerciseView');
		assert($addResultView instanceof AddResultView, 'Nineth argument was not an instance of AddResultView');
		assert($addResultDetailedView instanceof AddResultDetailedView, 'Tenth argument was not an instance of AddResultDetailedView');
		assert($exerciseListView instanceof ExerciseListView, 'Eleventh argument was not an instance of ExerciseListView');
		assert($navigationView instanceof NavigationView, 'Twelweth argument was not an instance of NavigationView');

        $this->userCatalogue = $userCatalogue;
        $this->loginModel = $loginModel;
        $this->registerModel = $registerModel;
        $this->addExerciseModel = $addExerciseModel;
        $this->addResultModel = $addResultModel;
        $this->loginView = $loginView;
        $this->registerView = $registerView;
        $this->addExerciseView = $addExerciseView;
        $this->addResultView = $addResultView;
        $this->addResultDetailedView = $addResultDetailedView;
        $this->exerciseListView = $exerciseListView;
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
            if($this->navigationView->getRequestRegisterPage()) {
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
            if($this->getRequestAddResultPageFromNavigationView()) {
                $ret .= $this->addResultView->response();
            }
            else if($this->getRequestAddResultDetailedPageFromAddResultView()) {
                $ret .= $this->addResultDetailedView->response();
            }
            else if($this->getRequestAddExercisePageFromNavigationView()) {
                $ret .= $this->addExerciseView->response();
            }
            else {
                $ret .= $this->exerciseListView->response();
            }
        }
        else {
            if($this->getRequestRegisterPageFromNavigationView()) {
                $ret .= $this->registerView->response();
            }
            else {
                $ret .= $this->loginView->response();
            }
        }
       return $ret;
    }
    
    public function getRequestAddResultPageFromNavigationView() {
        return $this->navigationView->getRequestAddResultPage();
    }
    
    public function getRequestAddResultDetailedPageFromAddResultView() {
        return $this->addResultView->getRequestAddResultDetailedPage();
    }
    
    public function getRequestAddFromAddResultDetailedView() {
        return $this->addResultDetailedView->getRequestAdd();
    }
    
    public function getRequestTextFromAddResultDetailedView() {
        return $this->addResultDetailedView->getRequestText();
    }
    
    public function getRequestDateFromAddResultDetailedView() {
        return $this->addResultDetailedView->getRequestDate();
    }
    
    
    
    
    
    
    
    
    
    
    public function getExerciseIdFromUrl() {
        return $_GET['addresultdetailedpage'];
    }
    
    
    
    
    public function getRequestAddExercisePageFromNavigationView() {
        return $this->navigationView->getRequestAddExercisePage();
    }
    
    public function getRequestRegisterPageFromNavigationView() {
        return $this->navigationView->getRequestRegisterPage();
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
    
    
    
    public function getRequestAddFromAddExerciseView() {
        return $this->addExerciseView->getRequestAdd();
    }
    
    public function getRequestNameFromAddExerciseView() {
        return $this->addExerciseView->getRequestName();
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
    
    public function currentStateInAddResultDetailedView() {
        $this->addResultDetailedView->currentState();
    }
}