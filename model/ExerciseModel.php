<?php

class ExerciseModel {
    
    private $id;
    private $name;
    private $results = array();
    
    public function __construct($userCatalogue, $id, $name) {
        assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
        assert(is_numeric($id), 'Second argument was not a numeric value');
	    assert(is_string($name), 'Third argument was not a string');
	    
        $this->id = $id;
        $this->name = $name;
        $this->results = $userCatalogue->getResults($id);
    }
    
    //Getters and setters for the private membervariables.
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getResults() {
        return $this->results;
    }
}