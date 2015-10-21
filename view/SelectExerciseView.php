<?php

class SelectExerciseView {
    
    private static $addResultPage = 'addresultpage';
    private $userCatalogue;
    
    public function __construct(UserCatalogue $userCatalogue) {
        $this->userCatalogue = $userCatalogue;
    }
	
    public function response() {
        return $this->generateExerciseList();
	}
	
	private function generateExerciseList() {
		$ret = '';
		
        $currentUser = $this->userCatalogue->getCurrentUser();
        $exercises = $this->userCatalogue->getExercises($currentUser);
        
        if(!empty($exercises)) {
            uasort($exercises, function($a, $b) { return strcmp($a->getName(), $b->getName()); } );
            foreach($exercises as $exercise) {
                $ret .= '<a class="exerciselinks" href="?'. self::$addResultPage . '=' . $exercise->getId() . '">' . $exercise->getName() . '</a>';
            }
        }
        else {
            $ret .= '<p class="detailedresult">No exercise has been added yet..</p>';
        }
        return $ret;
	}
	
	//Getters and setters for the private membervariables.
	
	public function isAddResultPageSet() {
		return isset($_GET[self::$addResultPage]);
	}
}