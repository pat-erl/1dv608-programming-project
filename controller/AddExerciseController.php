<?php

class AddExerciseController {
    
    /*
    Handles the input from the user regarding adding exercises.
    */
    
    private $addExerciseModel;
    private $mainView;
    
    public function __construct($addExerciseModel, $mainView) {
        assert($addExerciseModel instanceof AddExerciseModel, 'First argument was not an instance of AddExerciseModel');
        assert($mainView instanceof MainView, 'Second argument was not an instance of MainView');
        
        $this->addExerciseModel = $addExerciseModel;
        $this->mainView = $mainView;
    }
    
	public function checkIfAddExercise() {
		if($this->mainView->getRequestAddFromAddExerciseView()) {
			$exerciseName = $this->mainView->getRequestNameFromAddExerciseView();
		    
		    $this->addExerciseModel->doTryToAdd($exerciseName);
		    
		    $this->mainView->currentStateInAddExerciseView();
		}
	}
}