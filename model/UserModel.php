<?php

class UserModel {
    
    private $name;
    private $password;
    private $storageFile;
    private $exercises = array();
    
    public function __construct($name, $password, $exercises) {
        assert(is_string($name), 'First argument was not a string');
	    assert(is_string($password), 'Second argument was not a string');
	    
        $this->name = $name;
        $this->password = $password;
        $this->storageFile = 'model/DAL/storagefiles/userfiles/' . $name . '.txt';
        $this->exercises = $exercises;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getName() {
        return $this->name;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getStorageFile() {
        return $this->storageFile;
    }
    
    public function getExercises() {
        return $this->exercises;
    }
}