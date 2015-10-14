<?php

class ExerciseListView {
    
    private $userCatalogue;
	
	public function __construct($userCatalogue) {
		assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');

        $this->userCatalogue = $userCatalogue;
    }
    
    //Massor att fixa här för att bara få tag i exercises, dessutom sen bara för att få tag i results kvar också att göra i deras separata filer etc.
    
    public function response() {
        $exercises = $this->exerciseCatalogue->getExercises();
        $ret = '';
        $userName = $_SESSION['Name'];
        $thisUsersExercises = array();
        
        foreach($exercises as $exercise) {
            if($exercise->getUserName() == $userName) {
                $thisUsersExercises[] = $exercise;
            }
        }
        
        uasort($thisUsersExercises, function($a, $b) { return strcmp($a->getName(), $b->getName()); } );
        
        foreach($thisUsersExercises as $exercise) {
            $ret .= '<a href="?' . $exercise->getId() . '">' . $exercise->getName() . '</a>'; //länkar för edit och delete här sedan med!!
        }
        return $ret;
    }
}


