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
		assert($loginModel instanceof LoginModel, 'First argument was not an instance of LoginModel');
		assert($registerModel instanceof RegisterModel, 'First argument was not an instance of RegisterModel');
		assert($addExerciseModel instanceof AddExerciseModel, 'First argument was not an instance of AddExerciseModel');
		assert($addResultModel instanceof AddResultModel, 'First argument was not an instance of AddResultModel');

        $this->userCatalogue = $userCatalogue;
        $this->loginModel = $loginModel;
        $this->registerModel = $registerModel;
        $this->addExerciseModel = $addExerciseModel;
        $this->addResultModel = $addResultModel;
        $this->loginView = new LoginView($loginModel);
        $this->registerView = new RegisterView($registerModel);
        $this->addExerciseView = new AddExerciseView($addExerciseModel);
        $this->addResultView = new AddResultView($addResultModel);
        $this->exerciseListView = new ExerciseListView($userCatalogue);
    }
    
    public function response() {

    }
}






private function showContent($loginView, $registerView, $exerciseListView, $addExerciseView) {
        
        if(isset($_GET['register'])) {
            return $registerView->response();
        }
        else if(isset($_GET['exerciseadd']) && $loginView->getIsLoggedIn()) {
            return $addExerciseView->response();
        }
        else if(isset($_GET['exerciselist']) && $loginView->getIsLoggedIn()) {
            return $exerciseListView->response();
        }
        else if(!$loginView->getIsLoggedIn()) {
            return $loginView->response();
        }
        else {
            return $exerciseListView->response();
        }
    }
    
    private function showLogout($loginView) {
        if($loginView->getIsLoggedIn()) {
            return $loginView->response();
        }
    }
    
    
        private function showHeadline($loginView, $registerView) {
        
        $ret = "<h1>Strength Logger</h1>";
        
        if($loginView->getIsLoggedIn()) {
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
    