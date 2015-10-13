<?php

class LayoutView {
    
    /*
    Handles the rendering to the client.
    */
    
    private $loginView;
	private $registerView;
	private $exerciseListView;
	private $addExerciseView;
	
	public function __construct($loginView, $registerView, $exerciseListView, $addExerciseView) {
		assert($loginView instanceof LoginView, 'First argument was not an instance of LoginView');
		assert($registerView instanceof RegisterView, 'First argument was not an instance of RegisterView');
		assert($exerciseListView instanceof ExerciseListView, 'First argument was not an instance of ExerciseListView');
		assert($addExerciseView instanceof AddExerciseView, 'First argument was not an instance of AddExerciseView');
		
        $this->loginView = $loginView;
        $this->registerView = $registerView;
        $this->exerciseListView = $exerciseListView;;
        $this->addExerciseView = $addExerciseView;
    }
    
    public function render() {
        
        echo '<!DOCTYPE html>
            <html>
              <head>
                <meta charset="utf-8">
                <link rel="stylesheet" type="text/css" href="css/style.css">
                <title>Programming project - Strength Logger</title>
              </head>
              <body>
                ' . $this->showHeadline($this->loginView, $this->registerView) . '
                ' . $this->showMenu($this->loginView, $this->registerView) . '
              <div id="container">
                ' . $this->showContent($this->loginView, $this->registerView, $this->exerciseListView, $this->addExerciseView) . '
                </div>
                ' . $this->showFooter($this->loginView) . '
               </body>
            </html>
        ';
    }
    
    private function showHeadline($loginView, $registerView) {
        
        $ret = "<h1>Strength Logger</h1>";
        
        if($loginView->getIsLoggedIn()) {
            $ret .= "<h3>" . $_SESSION['Name'] . "'s log</h3>";
        }
        else {
            if(isset($_GET['register'])) {
                $ret .= "<h3>Register Page</h3>";
            }
            else {
                $ret .= "<h3>Login Page</h3>";
            }
        }
        return $ret;
    }
    
    public function showMenu($loginView, $registerView) {
        
        if($loginView->getIsLoggedIn()) {
            return '<a href="?exerciselist">EXERCISE LIST</a>' . ' | ' . '<a href="?exerciseadd">ADD EXERCISE</a>';
        }
        else {
            if(isset($_GET['register'])) {
                return '<a href="?"><< Back to login</a>';
            }
            else {
                return '<a href="?register">Register a new user >></a>';
            }
        }
    }
    
    private function showContent($loginView, $registerView, $exerciseListView, $addExerciseView) {
        
        if(isset($_GET['register'])) {
            return $registerView->response();
        }
        else if(isset($_GET['exerciseadd']) && $loginView->getIsLoggedIn()) {
            return $addExerciseView->response();
        }
        else if(isset($_GET['exerciselist']) && $loginView->getIsLoggedIn()) {
            return $exerciseListView->response();
        }
        else if(!$loginView->getIsLoggedIn()) {
            return $loginView->response();
        }
        else {
            return $exerciseListView->response();
        }
    }
    
    private function showFooter($loginView) {
        if($loginView->getIsLoggedIn()) {
            return $loginView->response();
        }
    }
}
