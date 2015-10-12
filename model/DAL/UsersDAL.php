<?php

class UsersDAL {
    
     /*
    Handles logic regarding storage of users.
    */
    
    private $storageFile = "users.txt";
    
    //Gets all the users from file.
    public function getUsers() {
        if(filesize($this->storageFile) > 0) {
            $contents = file_get_contents($this->storageFile);
            return unserialize($contents);
        }
        return null;
    }
    
    //Saves all the users to file.
    public function saveUsers($users) {
        $contents = serialize($users);
        file_put_contents($this->storageFile, $contents);
    }
}