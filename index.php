<?php

//Including all the files.
require_once('model/DAL/UsersDAL.php');
require_once('model/SessionModel.php');
require_once('model/UserCatalogue.php');
require_once('model/LoginModel.php');
require_once('model/RegisterModel.php');
require_once('model/AddExerciseModel.php');
require_once('model/AddResultModel.php');
require_once('model/UserModel.php');
require_once('model/ExerciseModel.php');
require_once('model/ResultModel.php');
require_once('view/MainView.php');
require_once('view/NavigationView.php');
require_once('view/LayoutView.php');
require_once('view/LoginView.php');
require_once('view/RegisterView.php');
require_once('view/AddExerciseView.php');
require_once('view/AddResultView.php');
require_once('view/AddResultDetailedView.php');
require_once('view/ExerciseListView.php');
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
$addResultModel = new AddResultModel($userCatalogue);

$loginView = new LoginView($loginModel);
$registerView = new RegisterView($registerModel);
$addExerciseView = new AddExerciseView($addExerciseModel);
$addResultView = new AddResultView($userCatalogue);
$addResultDetailedView = new AddResultDetailedView($addResultModel, $userCatalogue);
$exerciseListView = new ExerciseListView($userCatalogue);
$navigationView = new NavigationView($loginModel);
$layoutView = new LayoutView();
        
$mainView = new MainView($userCatalogue, $loginModel, $registerModel, $addExerciseModel, $addResultModel, $loginView, $registerView, $addExerciseView, $addResultView, $addResultDetailedView, $exerciseListView, $navigationView);

$mainController = new MainController($sessionModel, $loginModel, $registerModel, $addExerciseModel, $addResultModel, $mainView);

//Running the application.
$mainController->startApplication();

//Renders content to the client.
$layoutView->render($mainView, $navigationView);