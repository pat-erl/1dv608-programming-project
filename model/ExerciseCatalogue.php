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
        if($this->checkIfExerciseAlreadyExists($exerciseName)) {
            return false;
        }
        else {
            $id = 0;
            foreach($this->exercises as $exercise){
                if($exercise->getId() > $id){
                    $id = $exercise->getId();
                }
            }
            $id++;
            
            $newExercise = new ExerciseModel($id, $exerciseName);
            $this->exercises[] = $newExercise;
            $this->DAL->saveExercises($this->exercises);
            return true;
        }
    }
    
    public function checkIfExerciseAlreadyExists($exerciseName) {
        foreach($this->exercises as $exercise) {
            if($exerciseName == $exercise->getName()) {
                return true;
            }
        }
        return false;
    }
}