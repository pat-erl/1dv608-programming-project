<?php

class UserCatalogue {
    
     /*
    Handles logic regarding getting, adding and editing users, exercises and results.
    */
    
    private $sessionModel;
    private $DAL;
    //private $salt = '/&tggt%F%F&ygyuIYibjiuhiu';
    
    public function __construct(SessionModel $sessionModel, UsersDAL $usersDAL) {
        $this->sessionModel = $sessionModel;
        $this->DAL = $usersDAL;
    }
    
    public function getUsers() {
        $users = $this->DAL->getUsersFromFile();
        
        if($users == null) {
            $users = array();
        }
        return $users;
    }
    
    public function addUser($userName, $userPassword) {
        
        //Hashing the password.
        $userPassword = password_hash($userPassword, PASSWORD_DEFAULT);

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
        $hash = '';
        
        foreach($users as $user) {
            if($user->getName() == $userName) {
                $hash = $user->getPassword();
            }
        }
        
        //Verifying the password.
        if(password_verify($userPassword, $hash)) {
            return true;
        }
        return false;
    }
    
    public function getCurrentUser() {
        $users = $this->getUsers();
        $currentUser = null;
        
        foreach($users as $user) {
            if($user->getName() == $this->sessionModel->getStoredUserName()) {
                $currentUser = $user;
            }
        }
        return $currentUser;
    }
    
    public function getExercises($user) {
        $file = $user->getStorageFile();
        $exercises = $this->DAL->getExercisesFromFile($file);
        
        if($exercises == null) {
            $exercises = array();
        }
        return $exercises; 
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
    
    public function editExercise($exerciseName) {
        $currentUser = $this->getCurrentUser();
        $file = $currentUser->getStorageFile();
        $exercises = $this->getExercises($currentUser);
        $currentExercise = $this->getCurrentExercise($exercises);
        $currentExercise->setName($exerciseName);
        
        try {
            $this->DAL->saveExercisesToFile($exercises, $file);
            return true;
        }
        catch(Exception $e) {
            return false;
        }
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
    
    public function getCurrentExercise($exercises) {
        $currentExercise = null;
        
        foreach($exercises as $exercise) {
            if($exercise->getId() == $this->sessionModel->getStoredExercise()) {
                $currentExercise = $exercise;
            }
        }
        return $currentExercise;
    }
    
    public function addResult($resultText, $date) {
        $currentUser = $this->getCurrentUser();
        $file = $currentUser->getStorageFile();
        $exercises = $this->getExercises($currentUser);
        $currentExercise = $this->getCurrentExercise($exercises);
        $results = $currentExercise->getResults();
        
        if($results == null) {
            $results = array();
        }
        
        try {
            $id = 0;
            foreach($results as $result){
                if($result->getId() > $id) {
                    $id = $result->getId();
                }
            }
            $id++;
            
            $newResult = new ResultModel($id, $resultText, $date);
            $results[] = $newResult;
            $currentExercise->setResults($results);
            $this->DAL->saveExercisesToFile($exercises, $file);
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
    
    public function editResult($resultText, $date) {
        $currentUser = $this->getCurrentUser();
        $file = $currentUser->getStorageFile();
        $exercises = $this->getExercises($currentUser);
        $currentExercise = $this->getCurrentExercise($exercises);
        $results = $currentExercise->getResults();
        $currentResult = $this->getCurrentResult($results);
        $currentResult->setText($resultText);
        $currentResult->setDateStamp($date);
        
        try {
            $this->DAL->saveExercisesToFile($exercises, $file);
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
    
    public function getCurrentResult($results) {
        $currentResult = null;
        
        foreach($results as $result) {
            if($result->getId() == $this->sessionModel->getStoredResult()) {
                $currentResult = $result;
            }
        }
        return $currentResult;
    }
}