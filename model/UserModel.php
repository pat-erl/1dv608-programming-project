<?php

class UserModel {
    
    private $name;
    private $password;
    private $exercises = array();
    
    public function __construct($userCatalogue, $name, $password) {
        assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
        assert(is_string($name), 'Second argument was not a string');
	    assert(is_string($password), 'Third argument was not a string');
	    
        $this->name = $name;
        $this->password = $password;
        $this->exercises = $userCatalogue->getExercises($name);
    }
    
    //Getters and setters for the private membervariables.
    
    public function getName() {
        return $this->name;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getExercises() {
        return $this->exercises;
    }
}