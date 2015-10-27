<?php

class DeleteResultView {
	
	/*
        Handles the content for deleting results.
    */
    
    private static $delete = 'DeleteResultView::Delete';
    
    private $userCatalogue;
    
    public function __construct(UserCatalogue $userCatalogue) {
        $this->userCatalogue = $userCatalogue;
    }
    
    public function response() {
        return $this->generateDeleteResultForm();
	}
	
	private function generateDeleteResultForm() {
		$ret = '';
        $currentUser = $this->userCatalogue->getCurrentUser();
        $exercises = $this->userCatalogue->getExercises($currentUser);
        $currentExercise = $this->userCatalogue->getCurrentExercise($exercises);
        $results = $currentExercise->getResults();
        $currentResult = $this->userCatalogue->getCurrentResult($results);
        
        $ret .= '
        <form method="post" > 
            <fieldset>
                <legend>This will delete the result ' . $currentResult->getText() . '</legend>
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
	
 
 
 
 
    
