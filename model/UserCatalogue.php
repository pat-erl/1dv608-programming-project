<?php

class UserCatalogue {
    
     /*
    Handles logic regarding getting and adding users.
    */
    
    private $DAL;
    private $salt = '/&tggt%F%F&ygyuIYibjiuhiu';
    
    public function __construct($usersDAL) {
        assert($usersDAL instanceof UsersDAL, 'First argument was not an instance of UsersDAL');
        
        $this->DAL = $usersDAL;
    }
    
    public function getUsers() {
        $users = $this->DAL->getUsersFromFile();
        
        if($users === null) {
            $users = array();
        }
        return $users;
    }
    
    public function getExercises($user) {
        $file = $user->getStorageFile();
        $exercises = $this->DAL->getExercisesFromFile($file);
        
        if($exercises === null) {
            $exercises = array();
        }
        return $exercises; 
    }
    
    public function addUser($userName, $userPassword) {
        
        //Hashing the password.
        $userPassword = sha1($userPassword);
        $userPassword .= $this->salt;
        
        $users = $this->getUsers();

        try {
            $newUser = new UserModel($userName, $userPassword, null);
            $users[] = $newUser;
            $this->DAL->saveUsersToFile($users);
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
    
    public function addExercise($user, $exerciseName) {
        $file = $user->getStorageFile();
        $exercises = $this->getExercises($user);
        
        try {
            $id = 0;
            foreach($exercises as $exercise){
                if($exercise->getId() > $id) {
                    $id = $exercise->getId();
                }
            }
            $id++;
            
            $newExercise = new ExerciseModel($id, $exerciseName, null);
            $exercises[] = $newExercise;
            $this->DAL->saveExercisesToFile($exercises, $file);
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
}