<?php

class ExerciseModel {
    
    private $name;
    
    public function __construct($name) {
        assert(is_string($name), 'First argument was not a string');
	    
        $this->name = $name;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getName() {
        return $this->name;
    }
}