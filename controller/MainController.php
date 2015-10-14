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
    private $loginController;
    private $registerController;
    private $addExerciseController;
    private $addResultController;
    
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
        $this->loginController = new LoginController($sessionModel, $loginModel, $mainView);
        $this->registerController = new RegisterController($sessionModel, $registerModel, $mainView);
        $this->addExerciseController = new AddExerciseController($addExerciseModel, $mainView);
        $this->addResultController = new AddResultController($addResultModel, $mainView);
    }
    
    public function startApplication() {
        if($this->sessionModel->existingSession()) {
            $this->loginModel->alreadyLoggedIn();
            $this->mainView->getCurrentStateFromLoginView();
            $this->loginController->checkIfLogout();
        }
        else {
            $this->loginController->checkIfLogin();
        }
        $this->registerController->checkIfRegister();
        $this->addExerciseController->checkIfAddExercise();
        $this->addResultController->checkIfAddResult();
    }
}