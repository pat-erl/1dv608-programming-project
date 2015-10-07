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
    
    public function getUsers() {
        return $this->users;
    }
    
    public function addUser($user) {
        //Kolla här om användaren redan finns?? med get user då på nåt sätt..
        $this->users[] = $user;
        $this->DAL->saveUsers($this->users);
    }
}