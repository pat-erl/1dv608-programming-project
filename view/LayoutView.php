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
                <title>Strength LEVELS</title>
              </head>
              <body>
              <h1>STRENGTH LEVELS</h1>
              <h3>Log, improve, repeat..</h3>
              <div id="container">
                
                ' . $this->whatResponseToShow($registerView, $loginView, $isLoggedIn) . '
                </div>
                ' . $this->whatLinkToShow($registerView, $loginView, $isLoggedIn) . '
               </body>
            </html>
        ';
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
