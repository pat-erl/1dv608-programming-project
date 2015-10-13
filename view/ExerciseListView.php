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
        
        foreach($exercises as $exercise) {
            $ret .= '<br /><a href="?' . $exercise->getId() . '">' . $exercise->getName() . '</a><br />'; //Id sen inte namnet..
        }
        return $ret;
    }
}