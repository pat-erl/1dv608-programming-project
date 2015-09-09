<?php

namespace model;


class UserArray {
    
    private $users = array();
    private $selectedUser;
    private $dal;
    
    public function __construct(SelectedUserDAL $dal) {
        $this->dal = $dal;
        $this->selectedUser = $this->dal->getSavedUser();
    }
    
    public function add(User $user) {
        $this->users[] = $user;
    }
    
    public function selectUser(User $user) {
        $this->selectedUser = $user;
        $this->dal->saveSelection($user);
    }
    
    public function getUsers() {
        return $this->users;
    }
    
    public function getSelectedUser() {
        return $this->selectedUser;
    }
}