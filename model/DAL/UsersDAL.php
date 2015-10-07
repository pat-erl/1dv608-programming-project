<?php

class UsersDAL {
    
    private $storageFile = "users.txt";
    
    public function getUsers() {
        
        if(filesize($this->storageFile) > 0) {
            $contents = file_get_contents($this->storageFile);
            return unserialize($contents);
        }
        
        return null;
    }
    
    public function saveUsers($users) {
        $contents = serialize($users);
        file_put_contents($this->storageFile, $contents);
    }
}