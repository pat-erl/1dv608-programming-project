<?php

//INCLUDE THE FILES NEEDED...
require_once('model/UserModel.php');
require_once('model/LoginModel.php');
require_once('model/SessionModel.php');
require_once('model/UserCatalogue.php');
require_once('model/DAL/UsersDAL.php');
require_once('view/LoginView.php');
require_once('view/LayoutView.php');
require_once('view/DateTimeView.php');
require_once('view/RegistrationView.php');
require_once('controller/LoginController.php');
require_once('controller/RegistrationController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'Off');

//Creates an object of CurrentUserModel.
$userModel = new UserModel('Admin', 'Password');

//Creates an object of loginModel.
$loginModel = new LoginModel($userModel);

//Creates an object of SessionModel.
$sessionModel = new SessionModel();

$userCatalogue = new UserCatalogue();

//CREATE OBJECTS OF THE VIEWS
$loginView = new LoginView($loginModel);
$layoutView = new LayoutView();
$dateTimeView = new DateTimeView();
$registrationView = new RegistrationView($userCatalogue);

//Creates an object of loginController.
$loginController = new LoginController($loginModel, $sessionModel, $loginView);

//Calls the method that will check for active session.
$loginController->checkIfSession();

//Creates an object of RegistrationController.
$registrationController = new RegistrationController($userCatalogue, $registrationView);

$registrationController->checkIfRegister();

//Creates a variable with the current login-state.
$isLoggedIn = $loginModel->getIsLoggedIn();

//Calls the method that handles the rendering to the client.
$layoutView->render($isLoggedIn, $loginView, $dateTimeView, $registrationView);