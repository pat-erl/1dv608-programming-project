<?php

class ExerciseCatalogue {
    
     /*
    Handles logic regarding getting and adding exercises.
    */
    
    private $DAL;
    private $exercises = array();
    
    public function __construct() {
        $DAL = new ExercisesDAL();
        $exercises = $DAL->getExercises();
        
        if($exercises !== null) {
            $this->exercises = $exercises;
        }
        else {
            $this->exercises = array();
        }
        $this->DAL = $DAL;
    }
    
    public function getExercises() {
        $this->DAL->getExercises();
        return $this->exercises;
    }
    
    public function addExercise($exerciseName) {
        
        $userName = $_SESSION['Name']; //Hur göra om inte ok att använda seesion här?? injecta sessionmodel??
        
        if($this->checkIfExerciseAlreadyExists($exerciseName, $userName)) {
            return false;
        }
        else {
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
    
    public function checkIfExerciseAlreadyExists($exerciseName, $userName) {
        foreach($this->exercises as $exercise) {
            if($exerciseName == $exercise->getName() && $userName == $exercise->getUserName()) {
                return true;
            }
        }
        return false;
    }
}