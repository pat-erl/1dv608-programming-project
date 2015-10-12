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
        return $this->exercises;
    }
    
    public function addExercise($exerciseName) {
        if($this->checkIfExerciseAlreadyExists($exerciseName)) {
            return false;
        }
        else {
            $newExercise = '<a href="' . $exerciseName . '">' . $exerciseName . '</a>';
            $this->exercises[] = $newExercise;
            $this->DAL->saveExercises($this->exercises);
            return true;
        }
    }
    
    public function checkIfExerciseAlreadyExists($exerciseName) {
        foreach($this->exercises as $exercise) {
            if($exerciseName == $exercise) {
                return true;
            }
        }
        return false;
    }
}