<?php

class MainController {
    
    /*
    Checks for an existing session and calls the other controllers.
    */
    
    private $sessionModel;
    private $loginModel;
    private $registerModel;
    private $addExerciseModel;
    private $loginView;
    private $registerView;
    private $exerciseListView;
    private $addExerciseView;
    private $loginController;
    private $registerController;
    private $addExerciseController;
    
    public function __construct($sessionModel, $loginModel, $registerModel, $addExerciseModel, $loginView, $registerView, $exerciseListView, $addExerciseView) {
        assert($sessionModel instanceof SessionModel, 'First argument was not an instance of SessionModel');
        assert($loginModel instanceof LoginModel, 'Second argument was not an instance of LoginModel');
        assert($registerModel instanceof RegisterModel, 'Third argument was not an instance of RegisterModel');
        assert($addExerciseModel instanceof AddExerciseModel, 'Fourth argument was not an instance of AddExerciseModel');
        assert($loginView instanceof LoginView, 'Fifth argument was not an instance of LoginView');
        assert($registerView instanceof RegisterView, 'Sixth argument was not an instance of RegisterView');
        assert($exerciseListView instanceof ExerciseListView, 'Seventh argument was not an instance of ExerciseListView');
        assert($addExerciseView instanceof AddExerciseView, 'Eighth argument was not an instance of AddExerciseView');
        
        $this->sessionModel = $sessionModel;
        $this->loginModel = $loginModel;
        $this->registerModel = $registerModel;
        $this->addExerciseModel = $addExerciseModel;
        $this->loginView = $loginView;
        $this->registerView = $registerView;
        $this->exerciseListView = $exerciseListView;
        $this->addExerciseView = $addExerciseView;
        $this->loginController = new LoginController($sessionModel, $loginModel, $loginView);
        $this->registerController = new RegisterController($sessionModel, $registerModel, $registerView);
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