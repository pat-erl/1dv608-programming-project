<?php

class LayoutView {
    
    /*
    Handles the rendering to the client.
    */
    
    public function render($isLoggedIn, $loginView, $registerView, $addExerciseView) {
        assert(is_bool($isLoggedIn), 'First argument was not a boolean value');
        assert($loginView instanceof LoginView, 'Second argument was not an instance of LoginView');
        assert($registerView instanceof RegisterView, 'Third argument was not an instance of RegisterView');
        assert($addExerciseView instanceof AddExerciseView, 'Fourth argument was not an instance of AddExerciseView');
        
        echo '<!DOCTYPE html>
            <html>
              <head>
                <meta charset="utf-8">
                <link rel="stylesheet" type="text/css" href="css/style.css">
                <title>Programming project - Strength Logger</title>
              </head>
              <body>
                ' . $this->showHeader($isLoggedIn) . '
              <div id="container">
                ' . $this->showMainMenu($isLoggedIn) . '
                ' . $this->showMainContent($isLoggedIn, $addExerciseView) . '
                ' . $this->showCurrentForm($registerView, $loginView, $isLoggedIn) . '
                ' . $this->showLink($registerView, $loginView, $isLoggedIn) . '
                </div>
                ' . $this->showLogoutPanel($loginView, $isLoggedIn) . '
               </body>
            </html>
        ';
    }

    private function showHeader($isLoggedIn) {
        
        if($isLoggedIn) {
            return "<h1>Strength Logger</h1><h3>" . $_SESSION['Name'] . "'s log</h3>";
        }
        else {
            return '<h1>Strength Logger</h1><h3>Log in or register</h3>';
        }
    }
    
    private function showMainMenu($isLoggedIn) {
        if($isLoggedIn) {
            return '<a href="?">Overview</a>
            <a href="?exerciseadd">Add Exercise</a>';
        }
    }
    
    private function showMainContent($isLoggedIn, $addExerciseView) {
        if($isLoggedIn) {
            if(isset($_GET['exerciseadd'])) {
                return $addExerciseView->response();
            }
            else {
                
            }
        }
    }
    
    private function showCurrentForm($registerView, $loginView, $isLoggedIn) {
        if(isset($_GET['register'])) {
			
			return $registerView->response();
        }
        else {
            if(!$isLoggedIn) {
                return $loginView->response($isLoggedIn);    
            }
        }
    }
    
    private function showLink($registerView, $loginView, $isLoggedIn) {
        if(isset($_GET['register'])) {
			
			return $registerView->showLink();
        }
        else {
			return $loginView->showLink($isLoggedIn);
        }
    }
    
    private function showLogoutPanel($loginView, $isLoggedIn) {
        if($isLoggedIn) {
            return $loginView->response($isLoggedIn);
        }
    }
}
