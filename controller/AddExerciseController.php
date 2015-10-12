<?php

class AddExerciseController {
    
    /*
    Handles the input from the user regarding adding exercises.
    */
    
    private $addExerciseModel;
    private $addExerciseView;
    
    public function __construct($addExerciseModel, $addExerciseView) {
        assert($addExerciseModel instanceof AddExerciseModel, 'First argument was not an instance of AddExerciseModel');
        assert($addExerciseView instanceof AddExerciseView, 'Second argument was not an instance of AddExerciseView');
        
        $this->addExerciseModel = $addExerciseModel;
        $this->addExerciseView = $addExerciseView;
    }
    
	public function checkIfAddExercise() {
		if($this->addExerciseView->getRequestAdd()) {
			$exerciseName = $this->addExerciseView->getRequestName();
		    
		    $this->addExerciseModel->doTryToAdd($exerciseName);
		    
		    $this->addExerciseView->getCurrentState();
		}
	}
}