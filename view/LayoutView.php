<?php

class LayoutView {
    
    /*
    Handles the rendering to the client.
    */
    
    public function render($isLoggedIn, $loginView, $registerView) {
        assert(is_bool($isLoggedIn), 'First argument was not a boolean value');
        assert($loginView instanceof LoginView, 'Second argument was not an instance of LoginView');
        assert($registerView instanceof RegisterView, 'Third argument was not an instance of RegisterView');
        
        echo '<!DOCTYPE html>
            <html>
              <head>
                <meta charset="utf-8">
                <link rel="stylesheet" type="text/css" href="css/style.css">
                <title>Programming project - Strength Levels</title>
              </head>
              <body>
              ' . $this->whatHeaderToShow($isLoggedIn) . '
              
              <div id="container">
                ' . $this->showMainMenu($isLoggedIn) . '
                
                
                
              
                ' . $this->whatResponseToShow($registerView, $loginView, $isLoggedIn) . '
                
                </div>
                ' . $this->whatLinkToShow($registerView, $loginView, $isLoggedIn) . '
                
               </body>
            </html>
        ';
    }

    private function whatHeaderToShow($isLoggedIn) {
        
        if($isLoggedIn) {
            return "<h1>Strength Logger 1.0</h1><h3>" . $_SESSION['Name'] . "'s log</h3>";
        }
        else {
            return '<h1>Strength Logger 1.0</h1><h3>Log in or register</h3>';
        }
    }
    
    private function showMainMenu($isLoggedIn) {
        if($isLoggedIn) {
            return '<a href="?">Overview</a>
            <a href="?exerciseadd">Add Exercise</a><br /><br><br />';
        }
    }
    
    private function whatResponseToShow($registerView, $loginView, $isLoggedIn) {
        
        if(isset($_GET['register'])) {
			
			return $registerView->response();
        }
        else {
			return $loginView->response($isLoggedIn);
        }
    }
    
    private function whatLinkToShow($registerView, $loginView, $isLoggedIn) {
        
        if(isset($_GET['register'])) {
			
			return $registerView->showLink();
        }
        else {
			return $loginView->showLink($isLoggedIn);
        }
    }
    
    
}
