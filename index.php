<?php

//Including all the files.
require_once('model/SessionModel.php');
require_once('model/UserCatalogue.php');
require_once('model/LoginModel.php');
require_once('model/RegisterModel.php');
require_once('model/AddExerciseModel.php');
require_once('model/AddResultModel.php');
require_once('model/UserModel.php');
require_once('model/ExerciseModel.php');
require_once('model/ResultModel.php');
require_once('model/DAL/UsersDAL.php');
require_once('view/MainView.php');
require_once('view/NavigationView.php');
require_once('view/LayoutView.php');
require_once('view/LoginView.php');
require_once('view/RegisterView.php');
require_once('view/AddExerciseView.php');
require_once('view/AddResultView.php');
require_once('view/ExerciseListView.php');
require_once('controller/MainController.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');
require_once('controller/AddExerciseController.php');
require_once('controller/AddResultController.php');

//Displaying errors.
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Creating all the objects.
$userCatalogue = new UserCatalogue();
$sessionModel = new SessionModel();

$loginModel = new LoginModel($userCatalogue);
$registerModel = new RegisterModel($userCatalogue);
$addExerciseModel = new AddExerciseModel(); 
$addResultModel = new AddResultModel();

$mainView = new MainView($userCatalogue, $loginModel, $registerModel, $addExerciseModel, $addResultModel);
$navigationView = new NavigationView();
$layoutView = new LayoutView();

$mainController = new MainController($sessionModel, $loginModel, $registerModel, $addExerciseModel, $mainView);

//Running the application.
$mainController->startApplication();

//Rendering content to the client.
$layoutView->render($mainView, $navigationView);