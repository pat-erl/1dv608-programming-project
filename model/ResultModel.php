<?php

class ResultModel {
    
    private $id;
    private $text;
    private $dateStamp;
    
    public function __construct($id, $text, $date) {
        assert(is_numeric($id), 'First argument was not a numeric value');
	    assert(is_string($text), 'Second argument was not a string');
	    assert(is_string($date), 'Third argument was not a string');
	    
        $this->id = $id;
        $this->text = $text;
        $this->dateStamp = $date;
    }
    
    //Getters and setters for the private membervariables.
    
    public function getId() {
        return $this->id;
    }
    
    public function getText() {
        return $this->text;
    }
    
    public function getDateStamp() {
        return $this->dateStamp;
    }
}