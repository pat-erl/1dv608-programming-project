<?php

class UsersDAL {
    
     /*
    Handles logic regarding storage of users and exercises.
    */
    
    private $storageFile;
    
    public function __construct() {
        $this->storageFile = '/customers/7/b/0/resultlogger.com//httpd.www/model/DAL/storagefiles/users.txt';
    }
    
    //Gets all the users from file.
    public function getUsersFromFile() {
        if(file_exists($this->storageFile)) {
            if(filesize($this->storageFile) > 0) {
                $contents = file_get_contents($this->storageFile);
                return unserialize($contents);
            }
        }
        return null;
    }
    
    //Gets a user's all exercises from file.
    public function getExercisesFromFile($file) {
        if(file_exists($file)) {
            if(filesize($file) > 0) {
                $contents = file_get_contents($file);
                return unserialize($contents);
            }
        }
        return null;
    }
    
    //Saves all the users to file.
    public function saveUsersToFile($users) {
        $contents = serialize($users);
        file_put_contents($this->storageFile, $contents);
    }
    
    //Saves a user's all exercises to file.
    public function saveExercisesToFile($exercises, $file) {
        $contents = serialize($exercises);
        file_put_contents($file, $contents);
    }
}