<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/CurrentUserModel.php');
require_once('model/LoginModel.php');
require_once('model/SessionModel.php');
require_once('controller/LoginController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Creates an object of CurrentUserModel.
$currentUserModel = new CurrentUserModel('Patrik', 'Losenord');

//Creates an object of SessionModel.
$sessionModel = new SessionModel();

//Creates an object of loginModel.
$loginModel = new LoginModel($currentUserModel, $sessionModel);

//CREATE OBJECTS OF THE VIEWS
$loginView = new LoginView($loginModel);
$layoutView = new LayoutView();
$dateTimeView = new DateTimeView();

//Creates an object of loginController.
$loginController = new LoginController($loginModel, $loginView, $sessionModel);

//Calls the methods that will handle the userinput.
$loginController->checkIfLogin();
$loginController->checkIfLogout();

//Creates a variable with the current login-state.
$isLoggedIn = $loginModel->getIsLoggedIn();

//Calls the method that handles the rendering to the client.
$layoutView->render($isLoggedIn, $loginView, $dateTimeView);