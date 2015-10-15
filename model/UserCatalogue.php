<?php

class UserCatalogue {
    
     /*
    Handles logic regarding getting and adding users.
    */
    
    private $DAL;
    private $users = array();
    private $salt = '/&tggt%F%F&ygyuIYibjiuhiu';
    
    public function __construct() {
        $DAL = new UsersDAL();
        $users = $DAL->getUsers();
        
        if($users !== null) {
            $this->users = $users;
        }
        else {
            $this->users = array();
        }
        $this->DAL = $DAL;
    }
    
    public function getUsers() {
        return $this->users;
    }
    
    public function getExercises($user) {
        return 'exercises';
    }
    
    public function getResults($exerciseId) {
        return 'results';
    }
    
    public function addUser($userName, $userPassword) {
        
        //Hashing the password.
        $userPassword = sha1($userPassword);
        $userPassword .= $this->salt;

        try {
            $newUser = new UserModel($userName, $userPassword);
            $this->users[] = $newUser;
            $this->DAL->saveUsers($this->users);
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
}