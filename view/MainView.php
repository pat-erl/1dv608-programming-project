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
    private $exerciseListView;
	
	public function __construct($userCatalogue, $loginModel, $registerModel, $addExerciseModel, $addResultModel) {
		assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
		assert($loginModel instanceof LoginModel, 'Second argument was not an instance of LoginModel');
		assert($registerModel instanceof RegisterModel, 'Third argument was not an instance of RegisterModel');
		assert($addExerciseModel instanceof AddExerciseModel, 'Fourth argument was not an instance of AddExerciseModel');
		assert($addResultModel instanceof AddResultModel, 'Fifth argument was not an instance of AddResultModel');

        $this->userCatalogue = $userCatalogue;
        $this->loginModel = $loginModel;
        $this->registerModel = $registerModel;
        $this->addExerciseModel = $addExerciseModel;
        $this->addResultModel = $addResultModel;
        $this->loginView = new LoginView($loginModel);
        $this->registerView = new RegisterView($registerModel);
        $this->addExerciseView = new AddExerciseView($addExerciseModel);
        $this->addResultView = new AddResultView($addResultModel);
        //$this->exerciseListView = new ExerciseListView($userCatalogue);
    }
    
    public function showHeadline() {
        
        $ret = "<h1>Strength Logger</h1>";
        
        if($this->loginModel->getIsLoggedIn()) {
            $name = $_SESSION['Name'];
            $name = strtolower($name);
            $name = ucfirst($name);
            
            $ret .= "<h3>" . $name . "'s log</h3>";
        }
        else {
            if(isset($_GET['register'])) {
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
        if($this->loginModel->getIsLoggedIn()) {
            if(isset($_GET['exerciseadd'])) {
                return $this->addExerciseView->response();
            }
            else {
                //return $this->exerciseListView->response(); Denna ska vara så här sedan när listviewen funkar som den ska
            return $this->addExerciseView->response(); //Tillfällig
            }
        }
        else {
            if(isset($_GET['register'])) {
                return $this->registerView->response();
            }
            else {
                return $this->loginView->response();
            }
        }
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
    
    public function getRequestAddFromAddResultView() {
        return $this->addResultView->getRequestAdd();
    }
    
    public function getRequestTextFromAddResultView() {
        return $this->addResultView->getRequestText();
    }
    
    
    
    public function getCurrentStateFromLoginView() {
        $this->loginView->getCurrentState();
    }
    
    public function getCurrentStateFromRegisterView() {
        $this->registerView->getCurrentState();
    }
    
    public function getCurrentStateFromAddExerciseView() {
        $this->addExerciseView->getCurrentState();
    }
    
    public function getCurrentStateFromAddResultView() {
        $this->addResultView->getCurrentState();
    }
}