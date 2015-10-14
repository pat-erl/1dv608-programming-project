<?php

class ResultModel {
    
    private $id;
    private $text;
    private $timeStamp;
    
    public function __construct($userCatalogue, $id, $text) {
        assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
        assert(is_numeric($id), 'Second argument was not a numeric value');
	    assert(is_string($text), 'Third argument was not a string');
	    
        $this->id = $id;
        $this->text = $text;
        $this->timeStamp = date(); //Formatera datumet bra sen..
    }
    
    //Getters and setters for the private membervariables.
    
    public function getId() {
        return $this->id;
    }
    
    public function getText() {
        return $this->text;
    }
    
    public function getTimeStamp() {
        return $this->timeStamp;
    }
}