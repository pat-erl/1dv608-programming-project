<?php

class CurrentUserModel {
    
    private $name;
    private $password;
    
    public function __construct($name, $password) {
        assert(is_string($name), 'First argument was not a string');
        //assert(is_string($password), 'Second argument was not a string');
        
        $this->name = $name;
        $this->password = $password;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getName() {
        return $this->name;
    }
    
    public function getPassword() {
        return $this->password;
    }
}