<?php

class DeleteExerciseView {
	
	/*
        Handles the content for deleting exercises.
    */
    
    private static $delete = 'DeleteExerciseView::Delete';
    
    private $userCatalogue;
    
    public function __construct(UserCatalogue $userCatalogue) {
        $this->userCatalogue = $userCatalogue;
    }
    
    public function response() {
        return $this->generateDeleteExerciseForm();
	}
	
	private function generateDeleteExerciseForm() {
		$ret = '';
        $currentUser = $this->userCatalogue->getCurrentUser();
        $exercises = $this->userCatalogue->getExercises($currentUser);
        $currentExercise = $this->userCatalogue->getCurrentExercise($exercises);
        
        $ret .= '
        <form method="post" > 
            <fieldset>
                <legend>This will delete the exercise ' . $currentExercise->getName() . '</legend>
		        <br />
			    <input id="button" type="submit" name="' . self::$delete . '" value="Confirm" />
		    </fieldset>
		</form>
		';
		return $ret;
	}
	
	//Getters and setters for the private membervariables.
	
	public function getRequestDelete() {
		return isset($_POST[self::$delete]);
	}
}