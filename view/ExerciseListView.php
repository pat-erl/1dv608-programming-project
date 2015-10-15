<?php

class ExerciseListView {
    
    private $userCatalogue;
	
	public function __construct($userCatalogue) {
		assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');

        $this->userCatalogue = $userCatalogue;
    }
    
    public function response() {
        $ret = '';
        $currentUser = $this->userCatalogue->getCurrentUser();
        $exercises = $this->userCatalogue->getExercises($currentUser);
        
        uasort($exercises, function($a, $b) { return strcmp($a->getName(), $b->getName()); } );
        
        foreach($exercises as $exercise) {
            $name = strtolower($exercise->getName());
			$name = ucfirst($name);
            $ret .= '<a href="?' . $exercise->getId() . '">' . $name . '</a>';
        }
        return $ret;
    }
}


