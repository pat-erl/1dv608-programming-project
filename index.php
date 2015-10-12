<?php

//Included files.
require_once('model/SessionModel.php');
require_once('model/UserCatalogue.php');
require_once('model/LoginModel.php');
require_once('model/RegisterModel.php');
require_once('model/UserModel.php');
require_once('model/DAL/UsersDAL.php');
require_once('view/LoginView.php');
require_once('view/LayoutView.php');
require_once('view/DateTimeView.php');
require_once('view/RegisterView.php');
require_once('controller/MainController.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');

require_once('model/ExerciseCatalogue.php');
require_once('model/AddExerciseModel.php');
require_once('model/ExerciseModel.php');
require_once('model/DAL/ExercisesDAL.php');
require_once('view/AddExerciseView.php');
require_once('controller/AddExerciseController.php');

//Error reporting.
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Creates an object of SessionModel.
$sessionModel = new SessionModel();

//Creates an object of UserCatalogue.
$userCatalogue = new UserCatalogue();

$exerciseCatalogue = new ExerciseCatalogue();

//Creates an object of LoginModel.
$loginModel = new LoginModel($userCatalogue);

$addExerciseModel = new AddExerciseModel($exerciseCatalogue);

//Creates an object of RegisterModel.
$registerModel = new RegisterModel($userCatalogue);

//Creates objects of the views.
$loginView = new LoginView($loginModel);
$registerView = new RegisterView($registerModel);
$addExerciseView = new AddExerciseView($addExerciseModel);
$layoutView = new LayoutView();

//Creates an object of MainController.
$mainController = new MainController($sessionModel, $loginModel, $loginView, $registerModel, $registerView, $addExerciseModel, $addExerciseView);

$mainController->startApplication();

//Creates a variable with the current login-state.
$isLoggedIn = $loginModel->getIsLoggedIn();

//Calls the method that handles the rendering to the client.
$layoutView->render($isLoggedIn, $loginView, $registerView, $addExerciseView);





				
				
				