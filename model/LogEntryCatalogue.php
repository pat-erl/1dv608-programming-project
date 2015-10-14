<?php

class LogEntryCatalogue {
    
     /*
    Handles logic regarding getting and adding exercises.
    */
    
    private $DAL;
    private $logEntries = array();
    
    public function __construct() {
        $DAL = new ExercisesDAL();
        $logEntries = $DAL->getLogEntries();
        
        if($logEntries !== null) {
            $this->logEntries = $logEntries;
        }
        else {
            $this->logEntries = array();
        }
        $this->DAL = $DAL;
    }
    
    public function getLogEntries() {
        $this->DAL->getLogEntries();
        return $this->logEntries;
    }
    
    public function addLogEntry($logEntry) {
        $ = $_SESSION['Name']; //Hur göra om inte ok att använda seesion här?? injecta sessionmodel??
        
        $logEntry = strtolower($logEntry);
        $logEntry = ucfirst($logEntry);
        
        $id = 0;
        foreach($this->exercises as $exercise){
            if($exercise->getId() > $id && $userName == $exercise->getUserName()){
                $id = $exercise->getId();
            }
        }
        $id++;
            
        $newExercise = new ExerciseModel($userName, $id, $exerciseName);
        $this->exercises[] = $newExercise;
        $this->DAL->saveExercises($this->exercises);
        return true;
    }
}