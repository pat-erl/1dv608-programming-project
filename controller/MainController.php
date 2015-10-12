<?php

class MainController {
    
    /*
    Checks for an existing session and contacts the other controllers.
    */
    
    private $sessionModel;
    private $loginModel;
    private $loginView;
    private $loginController;
    private $registerModel;
    private $registerView;
    private $registerController;
    private $addExerciseModel;
    private $addExerciseView;
    private $addExerciseController;
    
    public function __construct($sessionModel, $loginModel, $loginView, $registerModel, $registerView, $addExerciseModel, $addExerciseView) {
        assert($sessionModel instanceof SessionModel, 'First argument was not an instance of SessionModel');
        assert($loginModel instanceof LoginModel, 'Second argument was not an instance of LoginModel');
        assert($loginView instanceof LoginView, 'Third argument was not an instance of LoginView');
        assert($registerModel instanceof RegisterModel, 'Fourth argument was not an instance of RegisterModel');
        assert($registerView instanceof RegisterView, 'Fifth argument was not an instance of RegisterView');
        assert($addExerciseModel instanceof AddExerciseModel, 'Sixth argument was not an instance of AddExerciseModel');
        assert($addExerciseView instanceof AddExerciseView, 'Seventh argument was not an instance of AddExerciseView');
        
        $this->sessionModel = $sessionModel;
        $this->loginModel = $loginModel;
        $this->loginView = $loginView;
        $this->loginController = new LoginController($sessionModel, $loginModel, $loginView);
        $this->registerModel = $registerModel;
        $this->registerView = $registerView;
        $this->registerController = new RegisterController($sessionModel, $registerModel, $registerView);
        $this->addExerciseModel = $addExerciseModel;
        $this->addExerciseView = $addExerciseView;
        $this->addExerciseController = new AddExerciseController($addExerciseModel, $addExerciseView);
    }
    
    public function startApplication() {
        if($this->sessionModel->existingSession()) {
            $this->loginModel->alreadyLoggedIn();
			$this->loginView->getCurrentState();
            $this->loginController->checkIfLogout();
        }
        else {
            $this->loginController->checkIfLogin();
        }
        $this->registerController->checkIfRegister();
        $this->addExerciseController->checkIfAddExercise();
    }
}