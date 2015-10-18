<?php

class ExerciseListView {
    
   
    private $userCatalogue;
	
	public function __construct($userCatalogue) {
		assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');

        $this->userCatalogue = $userCatalogue;
    }
    
    public function response() {
        return $this->generateRegistrationFormHTML();
	}
	
	private function generateRegistrationFormHTML() {
		$ret = '';
        $currentUser = $this->userCatalogue->getCurrentUser();
        $exercises = $this->userCatalogue->getExercises($currentUser);
        
        if(!empty($exercises)) {
            uasort($exercises, function($a, $b) { return strcmp($a->getName(), $b->getName()); } );
            foreach($exercises as $exercise) {
                $name = strtolower($exercise->getName());
		        $name = ucfirst($name);
		        $results = $exercise->getResults();
		        if(!empty($results)) {
			        uasort($results, function($a, $b) { return strcmp($a->getDateStamp(), $b->getDateStamp()); } );
			        $results = array_reverse($results);
			        $latestResult = $results[0]->getText();
		        }
		        else {
			        $latestResult = '';
		        }
		        
                $ret .= '<p class="detailedresults">' . $name . ' - ' . $latestResult . '</p>';
            }
        }
        else {
            $ret .= '<p class="detailedresult">No exercises has been added yet..</p>';
        }
        return $ret;
	}
}


