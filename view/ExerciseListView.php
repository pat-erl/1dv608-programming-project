<?php

class ExerciseListView {
    
    private $exerciseCatalogue;
	
	public function __construct($exerciseCatalogue) {
		assert($exerciseCatalogue instanceof ExerciseCatalogue, 'First argument was not an instance of ExerciseCatalogue');

        $this->exerciseCatalogue = $exerciseCatalogue;
    }
    
    public function response() {

        $exercises = $this->exerciseCatalogue->getExercises();
        $ret = '';
        $userName = $_SESSION['Name'];
        
        uasort($exercises, function($a, $b) { return strcmp($a->getName(), $b->getName()); } );
        
        foreach($exercises as $exercise) {
            if($exercise->getUserName() == $userName) {
                $ret .= '<a href="?' . $exercise->getId() . '">' . $exercise->getName() . '</a>'; //länkar för edit och delete här sedan med!!
            }
        }
        return $ret;
    }
}


