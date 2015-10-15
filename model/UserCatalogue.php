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
        
        if($users == null) {
            $users = array();
        }
        return $users;
    }
    
    public function getExercises($user) {
        $file = $user->getStorageFile();
        $exercises = $this->DAL->getExercisesFromFile($file);
        
        if($exercises == null) {
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
    
    public function addExercise($exerciseName) {
        $currentUser = $this->getCurrentUser();
        
        $file = $currentUser->getStorageFile();
        $exercises = $this->getExercises($currentUser);
        
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
    
    public function addResult($resultText) {
        $currentUser = $this->getCurrentUser();
        $currentExercise = $this->getCurrentExercise();
    }
    
    public function checkIfUserExists($userName) {
        $users = $this->getUsers();
        
        foreach($users as $user) {
            if($user->getName() == $userName) {
                return true;
            }
        }
        return false;
    }
    
    public function checkIfCorrectPassword($userName, $userPassword) {
        $users = $this->getUsers();
        
        //Hashing the password.
        $userPassword = sha1($userPassword);
        $userPassword .= $this->salt;
        
        foreach($users as $user) {
            if($user->getName() == $userName && $user->getPassword() == $userPassword) {
                return true;
            }
        }
        return false;
    }
    
    public function checkIfExerciseExists($exerciseName) {
        $currentUser = $this->getCurrentUser();
    
        $exercises = $this->getExercises($currentUser);
        
        foreach($exercises as $exercise) {
            if($exercise->getName() == $exerciseName) {
                return true;
            }
        }
        return false;
    }
    
     public function getCurrentUser() {
        $users = $this->getUsers();
        $currentUser = null;
        
        foreach($users as $user) {
            if($user->getName() == $_SESSION['Name']) { //Kolla om detta är ok verkligen.., kanske bättre att bara injecta sessionModel... kolla runt om behöver på fler ställen...
                $currentUser = $user;
            }
        }
        return $currentUser;
    }
    
    public function getCurrentExercise() {
        
    }
}