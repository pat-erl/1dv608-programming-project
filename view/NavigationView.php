<?php

class NavigationView {
    
    private $loginModel;
    
    public function __construct($loginModel) {
        assert($loginModel instanceof LoginModel, 'First argument was not an instance of LoginModel');
        
        $this->loginModel = $loginModel;
    }
    
    public function showLinks() {
        if($this->loginModel->getIsLoggedIn()) {
            return '<a class="biggerlinks" href="?exerciselist">LOG RESULTS</a>' . ' | ' . '<a href="?exerciseadd">ADD EXERCISE</a>';
        }
        else {
            if(isset($_GET['register'])) {
                return '<br /><a class="smallerlinks" href="?"><< Back to login</a>';
            }
            else {
                return '<br /><a class="smallerlinks" href="?register">Register a new user >></a>';
            }
        }
    }
}