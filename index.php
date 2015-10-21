<?php

//Including all the files.

require_once('model/SessionModel.php');
require_once('model/DAL/UsersDAL.php');
require_once('model/UserCatalogue.php');
require_once('model/LoginModel.php');
require_once('model/RegisterModel.php');
require_once('model/AddExerciseModel.php');
require_once('model/EditExerciseModel.php');
require_once('model/AddResultModel.php');
require_once('model/EditResultModel.php');
require_once('model/UserModel.php');
require_once('model/ExerciseModel.php');
require_once('model/ResultModel.php');
require_once('view/LoginView.php');
require_once('view/RegisterView.php');
require_once('view/AddExerciseView.php');
require_once('view/EditExerciseView.php');
require_once('view/AddResultView.php');
require_once('view/EditResultView.php');
require_once('view/DeleteExerciseView.php');
require_once('view/DeleteResultView.php');
require_once('view/SelectExerciseView.php');
require_once('view/SummaryView.php');
require_once('view/NavigationView.php');
require_once('view/LayoutView.php');
require_once('view/MainView.php');
require_once('controller/MainController.php');

//Displaying errors.
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Creating all the objects.

$sessionModel = new SessionModel();
$usersDAL = new UsersDAL();
$userCatalogue = new UserCatalogue($sessionModel, $usersDAL);

$loginModel = new LoginModel($userCatalogue);
$registerModel = new RegisterModel($userCatalogue);
$addExerciseModel = new AddExerciseModel($userCatalogue); 
$editExerciseModel = new EditExerciseModel($userCatalogue); 
$addResultModel = new AddResultModel($userCatalogue);
$editResultModel = new EditResultModel($userCatalogue);

$loginView = new LoginView($loginModel);
$registerView = new RegisterView($registerModel);
$addExerciseView = new AddExerciseView($addExerciseModel);
$editExerciseView = new EditExerciseView($editExerciseModel, $userCatalogue);
$deleteExerciseView = new DeleteExerciseView($userCatalogue);
$addResultView = new AddResultView($addResultModel, $userCatalogue);
$editResultView = new EditResultView($editResultModel, $userCatalogue);
$deleteResultView = new DeleteResultView($userCatalogue);
$selectExerciseView = new SelectExerciseView($userCatalogue);
$summaryView = new SummaryView($userCatalogue);
$navigationView = new NavigationView($loginModel);
$layoutView = new LayoutView();
        
$mainView = new MainView($userCatalogue, $loginModel, $registerModel, 
                        $addExerciseModel, $editExerciseModel, 
                        $addResultModel, $editResultModel, 
                        $loginView, $registerView, 
                        $addExerciseView, $editExerciseView, $deleteExerciseView, 
                        $addResultView, $editResultView, $deleteResultView, 
                        $selectExerciseView, $summaryView, $navigationView);

$mainController = new MainController($userCatalogue, $sessionModel, $loginModel, $registerModel, 
                                    $addExerciseModel, $editExerciseModel, 
                                    $addResultModel, $editResultModel, $mainView);

//Running the application.
$mainController->startApplication();

//Renders content to the client.
$layoutView->render($mainView, $navigationView);