<?php

class UserCatalogue {
    
    private $users = array();
    private $DAL;
    
    public function __construct() {
        
        $DAL = new UsersDAL();
        $users = $DAL->getUsers();
        
        if($users === null) {
            $this->users = array();
        }
        else {
            $this->users = $users;
        }
        
        $this->DAL = $DAL;
    }
    
    public function addUser($user) {
        //Kolla här om användaren redan finns???
        $this->users[] = $user;
        $this->DAL->saveUsers($this->users);
    }
}