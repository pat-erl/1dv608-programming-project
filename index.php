<?php

//Including all the files.
require_once('model/SessionModel.php');
require_once('model/UserCatalogue.php');
require_once('model/ExerciseCatalogue.php');
require_once('model/LoginModel.php');
require_once('model/RegisterModel.php');
require_once('model/AddExerciseModel.php');
require_once('model/UserModel.php');
require_once('model/DAL/UsersDAL.php');
require_once('model/ExerciseModel.php');
require_once('model/DAL/ExercisesDAL.php');

require_once('view/LoginView.php');
require_once('view/RegisterView.php');
require_once('view/ExerciseListView.php');
require_once('view/AddExerciseView.php');
require_once('view/LayoutView.php');
require_once('view/DateTimeView.php'); //Kommer ej finnas sedan..

require_once('controller/MainController.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');
require_once('controller/AddExerciseController.php');

//Displaying errors.
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Creating all the objects.
$sessionModel = new SessionModel();
$userCatalogue = new UserCatalogue();
$exerciseCatalogue = new ExerciseCatalogue();

$loginModel = new LoginModel($userCatalogue);
$registerModel = new RegisterModel($userCatalogue);
$addExerciseModel = new AddExerciseModel($exerciseCatalogue); 

$loginView = new LoginView($loginModel);
$registerView = new RegisterView($registerModel);
$exerciseListView = new ExerciseListView($exerciseCatalogue);
$addExerciseView = new AddExerciseView($addExerciseModel);
$layoutView = new LayoutView($loginView, $registerView, $exerciseListView, $addExerciseView);

$mainController = new MainController($sessionModel, $loginModel, $registerModel, $addExerciseModel, $loginView, $registerView, $exerciseListView, $addExerciseView);

//Running the application.
$mainController->startApplication();

//Rendering the content to the client.
$layoutView->render();