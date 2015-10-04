<?php

class LayoutView {
    
    private $link;
    
    //Handles the rendering to the client.
    public function render($isLoggedIn, $loginView, $dateTimeView, $hasClickedRegLink, $registrationView) {
        assert(is_bool($isLoggedIn), 'First argument was not a boolean value');
        assert($loginView instanceof LoginView, 'Second argument was not an instance of LoginView');
        assert($dateTimeView instanceof DateTimeView, 'Third argument was not an instance of DateTimeView');
        assert(is_bool($hasClickedRegLink), 'Fourth argument was not a boolean value');
        assert($registrationView instanceof RegistrationView, 'Fifth argument was not an instance of RegistrationView');
        
        echo '<!DOCTYPE html>
            <html>
              <head>
                <meta charset="utf-8">
                <title>Assignment 2</title>
              </head>
              <body>
                <h1>Assignment 2</h1>
                ' . $this->generateLink($hasClickedRegLink) . '
                
                ' . $this->renderIsLoggedIn($isLoggedIn) . '
                
                <div class="container">
                ' . $this->decideWhatToRender($hasClickedRegLink, $registrationView, $loginView, $isLoggedIn) . '
                
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
    
    private function decideWhatToRender($hasClickedRegLink, $registrationView, $loginView, $isLoggedIn) {
        
        if($hasClickedRegLink) {
            return $registrationView->response();
        }
        else {
            return $loginView->response($isLoggedIn);
        }
    }
    
    private function generateLink($hasClickedRegLink) {
        if($hasClickedRegLink) {
            $this->link = '<a href="?">Back to login</a>';
            return $this->link;
        }
        else {
            $this->link = '<a href="?register=new">Register a new user</a>';
            return $this->link;
        }
    }
    
    public function getLink() {
        return isset($this->link);
    }
}
