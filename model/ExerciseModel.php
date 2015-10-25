<?php

class ExerciseModel {
    
    private $id;
    private $name;
    private $results = array();
    
    public function __construct($id, $name, $results) {
        assert(is_numeric($id), 'First argument was not a numeric value');
	    assert(is_string($name), 'Second argument was not a string');
	    
        $this->id = $id;
        $this->name = $name;
        $this->results = $results;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        assert(is_string($name), 'First argument was not a string');
        
        $this->name = $name;
    }
    
    public function getResults() {
        return $this->results;
    }
    
    public function setResults($results) {
        assert(is_array($results), 'First argument was not an array');
        
        $this->results = $results;
    }
}