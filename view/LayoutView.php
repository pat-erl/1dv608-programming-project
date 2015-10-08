<?php

class LayoutView {
    
    //Handles the rendering to the client.
    public function render($isLoggedIn, $loginView, $dateTimeView, $registerView) {
        assert(is_bool($isLoggedIn), 'First argument was not a boolean value');
        assert($loginView instanceof LoginView, 'Second argument was not an instance of LoginView');
        assert($dateTimeView instanceof DateTimeView, 'Third argument was not an instance of DateTimeView');
        assert($registerView instanceof RegisterView, 'Fourth argument was not an instance of RegisterView');
        
        echo '<!DOCTYPE html>
            <html>
              <head>
                <meta charset="utf-8">
                <title>Assignment 4</title>
              </head>
              <body>
                <h1>Assignment 4</h1>
                ' . $this->whatLinkToShow($registerView, $loginView, $isLoggedIn) . '
                
                ' . $this->renderIsLoggedIn($isLoggedIn) . '
                
                <div class="container">
                ' . $this->whatResponseToShow($registerView, $loginView, $isLoggedIn) . '
                
                ' . $dateTimeView->show() . '
                </div>
               </body>
            </html>
        ';
    }
    
    private function renderIsLoggedIn($isLoggedIn) {
        assert(is_bool($isLoggedIn), 'First argument was not a boolean value');
        
        if($isLoggedIn) {
            return '<h2>Logged in</h2>';
        }
        else {
            return '<h2>Not logged in</h2>';
        }
    }
    
    //Kanske inte behöver ha dessa länka i separata views utan bara skrivna här i layoutview??
    private function whatLinkToShow($registerView, $loginView, $isLoggedIn) {
        
        if(isset($_GET['register'])) {
			
			return $registerView->showLink();
        }
        else {
			return $loginView->showLink($isLoggedIn);
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
}
