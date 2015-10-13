<?php

class ExerciseModel {
    
    private $id;
    private $name;
    
    public function __construct($id, $name) {
        assert(is_numeric($id), 'First argument was not a numeric value');
        assert(is_string($name), 'Second argument was not a string');
	    
	    $this->id = $id;
        $this->name = $name;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
}