<?php

class AddResultView {
    
    private static $addResultDetailedPage = 'addresultdetailedpage';
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
        
        uasort($exercises, function($a, $b) { return strcmp($a->getName(), $b->getName()); } );
        
        foreach($exercises as $exercise) {
            $name = strtolower($exercise->getName());
			$name = ucfirst($name);
			$results = $exercise->getResults();
            $ret .= '<a href="?'. self::$addResultDetailedPage . '=' . $exercise->getId() . '">' . $name . ', ' . $this->printOutArray($results) . '</a>';
        }
        
        return $ret;
	}
	
	public function printOutArray($results) {
		$ret = '';
		
		if(!empty($results)) {
		    foreach($results as $result) {
    		    $ret .= '<p>' . $result->getText() . '</p>';
		    }
		}
		return $ret;
	}
	
	//Getters and setters for the private membervariables.
	
	public function getRequestAddResultDetailedPage() {
		return isset($_GET[self::$addResultDetailedPage]);
	}
}