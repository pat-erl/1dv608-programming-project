<?php

class SummaryView {
    
    private static $addResultPage = 'addresultpage';
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
			        $latestResultText = $results[0]->getText();
			        $latestResultDateStamp = $results[0]->getDateStamp();
			        $ret .= '<a class="summarylinks" href="?'. self::$addResultPage . '=' . $exercise->getId() . '"><p class="summary">' . $name . '</a> : ' . 
                    '<span class="latestresult">' . $latestResultText . '</span>' . ' - ' . '<span class="datestamp">' . $latestResultDateStamp . '</span></p>';
		        }
            }
        }
        return $ret;
	}

    //Getters and setters for the private membervariables.
	
	public function isAddResultPageSet() {
		return isset($_GET[self::$addResultPage]);
    }
}