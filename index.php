<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/User.php');
require_once('model/Login.php');
require_once('controller/Login.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');


//Creates an object of user.
//$modelUser = new model\User('Patrik', 'Losenord');

//Creates an object of login.
$modelLogin = new model\Login();

//Creates an object of controller.
$controllerLogin = new controller\Login($modelLogin);

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView($controllerLogin);
$dtv = new DateTimeView();
$lv = new LayoutView();








$lv->render(false, $v, $dtv);