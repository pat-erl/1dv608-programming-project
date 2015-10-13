<?php

class ExerciseModel {
    
    private $userName;
    private $id;
    private $name;
    
    public function __construct($userName, $id, $name) {
        assert(is_string($userName), 'First argument was not a string');
        assert(is_numeric($id), 'Second argument was not a numeric value');
        assert(is_string($name), 'Third argument was not a string');
	    
	    $this->userName = $userName;
	    $this->id = $id;
        $this->name = $name;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getUserName() {
        return $this->userName;
        
    }
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
}