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
        if($this->checkIfUserAlreadyExists($userName)) {
            return false;
        }
        else {
            //Hashing the password.
            $userPassword = sha1($userPassword);
            $userPassword .= $this->salt;

            $newUser = new UserModel($userName, $userPassword);
            $this->users[] = $newUser;
            $this->DAL->saveUsers($this->users);
            return true;
        }
    }
    
    public function checkIfUserAlreadyExists($userName) {
        foreach($this->users as $user) {
            if($userName == $user->getName()) {
                return true;
            }
        }
        return false;
    }
}