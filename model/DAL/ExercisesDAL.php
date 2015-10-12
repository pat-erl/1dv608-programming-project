<?php

class ExercisesDAL {
    
     /*
    Handles logic regarding storage of exercises.
    */
    
    private $storageFile = "exercises.txt";
    
    //Gets all the exercises from file.
    public function getExercises() {
        if(filesize($this->storageFile) > 0) {
            $contents = file_get_contents($this->storageFile);
            return unserialize($contents);
        }
        return null;
    }
    
    //Saves all the exercises to file.
    public function saveExercises($exercises) {
        $contents = serialize($exercises);
        file_put_contents($this->storageFile, $contents);
    }
}