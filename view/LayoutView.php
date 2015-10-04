<?php

class LayoutView {
    
    private $link;
    
    //Handles the rendering to the client.
    public function render($isLoggedIn, $loginView, $dateTimeView, $registrationView) {
        assert(is_bool($isLoggedIn), 'First argument was not a boolean value');
        assert($loginView instanceof LoginView, 'Second argument was not an instance of LoginView');
        assert($dateTimeView instanceof DateTimeView, 'Third argument was not an instance of DateTimeView');
        assert($registrationView instanceof RegistrationView, 'Fourth argument was not an instance of RegistrationView');
        
        echo '<!DOCTYPE html>
            <html>
              <head>
                <meta charset="utf-8">
                <title>Assignment 4</title>
              </head>
              <body>
                <h1>Assignment 4</h1>
                ' . $this->whatLinkToShow($registrationView, $loginView) . '
                
                ' . $this->renderIsLoggedIn($isLoggedIn) . '
                
                <div class="container">
                ' . $this->whatResponseToShow($registrationView, $loginView, $isLoggedIn) . '
                
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
    
    private function whatLinkToShow($registrationView, $loginView) {
        
        if($_GET['register'] == 'new') {
			
			return $registrationView->showLink();
        }
        else {
			return $loginView->showLink();
        }
    }
    
    private function whatResponseToShow($registrationView, $loginView, $isLoggedIn) {
        
        if($_GET['register'] == 'new') {
			
			return $registrationView->response();
        }
        else {
			return $loginView->response($isLoggedIn);
        }
    }
}
