<?php

class NavigationView {
    
    private static $summaryPage = 'summarypage';
    private static $addResultPage = 'addresultpage';
    private static $addExercisePage = 'addexercisepage';
    private static $loginPage = 'loginpage';
    private static $registerPage = 'registerpage';
    
    private $loginModel;
    
    public function __construct($loginModel) {
        assert($loginModel instanceof LoginModel, 'First argument was not an instance of LoginModel');
        
        $this->loginModel = $loginModel;
    }
    
    public function showLinks() {
        if($this->loginModel->getIsLoggedIn()) {
            return '<a class="biggerlinks" href="?' . self::$summaryPage . '">SHOW SUMMARY</a>' 
            . ' | ' . '<a class="biggerlinks" href="?' . self::$addResultPage . '">LOG RESULT</a>'
            . ' | ' . '<a href="?' . self::$addExercisePage . '">ADD EXERCISES</a>';
        }
        else {
            if($this->getRequestRegisterPage()) {
                return '<br /><a class="smallerlinks" href="?' . self::$loginPage . '"><< Back to login</a>';
            }
            else {
                return '<br /><a class="smallerlinks" href="?' . self::$registerPage . '">Register a new user >></a>';
            }
        }
    }
    
    public function getRequestSummaryPage() {
        return isset($_GET[self::$summaryPage]);
    }
    
    public function getRequestAddResultPage() {
        return isset($_GET[self::$addResultPage]);
    }
    
    public function getRequestAddExercisePage() {
        return isset($_GET[self::$addExercisePage]);
    }
    
    public function getRequestLoginPage() {
        return isset($_GET[self::$loginPage]);
    }
    
    public function getRequestRegisterPage() {
        return isset($_GET[self::$registerPage]);
    }
}