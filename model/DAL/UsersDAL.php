<?php

class UsersDAL {
    
     /*
    Handles logic regarding storage of users.
    */
    
    private $storageFile = "users.txt";
    
    //Gets all the users from file.
    public function getUsersFromFile() {
        if(filesize($this->storageFile) > 0) {
            $contents = file_get_contents($this->storageFile);
            return unserialize($contents);
        }
        return null;
    }
    
    //Saves all the users to file.
    public function saveUsersToFile($users) {
        $contents = serialize($users);
        file_put_contents($this->storageFile, $contents);
    }
    
    public function getExercisesFromFile($file) {
        if(filesize($file) > 0) {
            $contents = file_get_contents($file);
            return unserialize($contents);
        }
        return null;
    }
    
    public function saveExercisesToFile($exercises, $file) {
        $contents = serialize($exercises);
        file_put_contents($file, $contents);
    }
}