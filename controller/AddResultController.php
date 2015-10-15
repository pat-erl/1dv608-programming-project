<?php

class AddResultController {
    
    /*
    Handles the input from the user regarding adding results.
    */
    
    private $addResultModel;
    private $mainView;
    
    public function __construct($addResultModel, $mainView) {
        assert($addResultModel instanceof AddResultModel, 'First argument was not an instance of AddResultModel');
        assert($mainView instanceof MainView, 'Second argument was not an instance of MainView');
        
        $this->addResultModel = $addResultModel;
        $this->mainView = $mainView;
    }
    
	public function checkIfAddResult() {
		if($this->mainView->getRequestAddFromAddResultView()) {
			$resultText = $this->mainView->getRequestTextFromAddResultView();
		    
		    $this->addResultModel->doTryToAdd($resultText);
		    
		    $this->mainView->currentStateInAddResultView();
		}
	}
}