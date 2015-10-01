<?php

class RegistrationModel {
    
    private $hasClickedRegLink = false;

    public function __construct() {
        
    }
	
    public function getHasClickedRegLink() {
        return $this->hasClickedRegLink;
    }
    
    public function setHasClickedRegLink($state) {
        assert(is_bool($state), 'First argument was not a boolean value');
        
        $this->hasClickedRegLink = $state;
    }
}