<?php

class AddResultView {
	
	/*
    
    */
    
    private static $editResultPage = 'editresultpage';
    private static $editExercisePage = 'editexercisepage';
    private static $deleteResultPage = 'deleteresultpage';
    private static $deleteExercisePage = 'deleteexercisepage';
    private static $messageId = 'AddResultView::Message';
    private static $text = 'AddResultView::ResultText';
    private static $date = 'AddResultView::Date';
    private static $add = 'AddResultView::Add';
    
    private $addResultModel;
    private $userCatalogue;
    
    public function __construct(AddResultModel $addResultModel, UserCatalogue $userCatalogue) {
        $this->addResultModel = $addResultModel;
        $this->userCatalogue = $userCatalogue;
    }
	
    public function response() {
        $message = '';
        
        $message = $this->getRequestMessageId();
        return $this->generateListAndAddResultForm($message);
	}
	
	private function generateListAndAddResultForm($message) {
		$ret = '';
        $currentUser = $this->userCatalogue->getCurrentUser();
        $exercises = $this->userCatalogue->getExercises($currentUser);
        
        if(!empty($exercises)) {
	        foreach($exercises as $exercise) {
	            $id = $_GET['addresultpage'];
	            if($exercise->getId() == $id) {
	            	$ret .= '<p class ="detailedname">' . $this->printOut($exercise) . '</p>';
	            }
	        }
			$currentExercise = $this->userCatalogue->getCurrentExercise($exercises);
			$exerciseName = $currentExercise->getName();
				
			$ret .= '
				<form method="post" > 
					<fieldset>
						<legend>Enter result for ' . $exerciseName . '</legend>
						<p id="' . self::$messageId . '">' . $message . '</p>
						<label for="' . self::$text . '">Result :</label>
						<input autofocus type="text" maxlength="10" id="' . self::$text . '" name="' . self::$text . '" value="' . $this->getRequestText() . '" />
						<input class="longerdatefield" type="date" id="' . self::$date . '" name="' . self::$date . '" value="' . date("Y-m-d") .'" />
	                    <br />
						<input id="button" type="submit" name="' . self::$add . '" value="Log" />
					</fieldset>
				</form>
			';
			return $ret;
		}
	}
	
	public function printOut($exercise) {
		$ret = '';
	    
		$ret .= $exercise->getName() . '
		<a class="linklogos" title="edit" href="?' . self::$editExercisePage . '=' . $exercise->getId() . '"><img src="img/editimage.png" width="12px" height="12px"></a>
		<a class="linklogos" title="delete" href="?' . self::$deleteExercisePage . '=' . $exercise->getId() . '"><img src="img/deleteimage.png" width="12px" height="12px"></a>';
		
		$results = $exercise->getResults();
		
		if(!empty($results)) {
			uasort($results, function($a, $b) { return strcmp($a->getDateStamp(), $b->getDateStamp()); } );
			$results = array_reverse($results);
			
		    foreach($results as $result) {
    		    $ret .= '
    		    <p class="detailedresult">' . ' ' . $result->getText() . ' - ' . '<span class="datestamp">' . $result->getDateStamp() . '</span>
    		    <a class="linklogos" title="edit" href="?' . self::$editResultPage . '=' . $result->getId() . '"><img src="img/editimage.png" width="12px" height="12px"></a>
    		    <a class="linklogos" title="delete" href="?' . self::$deleteResultPage . '=' . $result->getId() . '"><img src="img/deleteimage.png" width="12px" height="12px"></a></p>';
		    }
		}
		else {
			$ret .= '<p class="detailedresult">No result has been logged yet..</p>';
		}
		return $ret;
	}
	
	//Reads the current state from the AddResultModel and sets the appropriate message.
	public function currentState() {
		if($this->addResultModel->getResultTextEmpty()) {
			$this->setRequestMessageId('Result must be at least 3 characters.');
		}
		else if($this->addResultModel->getDateEmpty()) {
			$this->setRequestMessageId('A date must be entered.');
		}
		else if($this->addResultModel->getInvalidCharacters()) {
			$this->setRequestMessageId('Result contains invalid characters.');
			$text = strip_tags($this->getRequestText());
			$this->setRequestText($text);
		}
		else if($this->addResultModel->getResultTextTooShort()) {
			$this->setRequestMessageId('Result must be at least 3 characters.');
		}
		else if($this->addResultModel->getDateWrongFormat()) {
			$this->setRequestMessageId('A date must be in the correct format.');
		}
		else if($this->addResultModel->getIsSuccessfulAdd()) {
			$this->setRequestText('');
		}
		else {
			$this->setRequestMessageId('Some other error!');
		}
	}
	
	//Getters and setters for the private membervariables.
	
	public function isEditResultPageSet() {
		return isset($_GET[self::$editResultPage]);
	}
	
	public function isEditExercisePageSet() {
		return isset($_GET[self::$editExercisePage]);
	}
	
	public function isDeleteResultPageSet() {
		return isset($_GET[self::$deleteResultPage]);
	}
	
	public function isDeleteExercisePageSet() {
		return isset($_GET[self::$deleteExercisePage]);
	}
	
	public function getRequestMessageId() {
		if(!isset($_POST[self::$messageId])) {
			$this->setRequestMessageId('');	
		}
		return $_POST[self::$messageId];
	}
	
	public function setRequestMessageId($message) {
		assert(is_string($message), 'First argument was not a string');
		
		$_POST[self::$messageId] = $message;
	}
	
	public function getRequestText() {
		if(!isset($_POST[self::$text])) {
			$this->setRequestText('');	
		}
		return $_POST[self::$text];
	}
	
	public function setRequestText($text) {
		assert(is_string($text), 'First argument was not a string');
		
		$_POST[self::$text] = $text;
	}
	
	public function getRequestDate() { 
		if(!isset($_POST[self::$date])) {
			$this->setRequestDate('');	
		}
		return $_POST[self::$date];
	}
	
	public function setRequestDate($date) {
		assert(is_string($date), 'First argument was not a string');
		
		$_POST[self::$date] = $date;
	}
	
	public function getRequestAdd() {
		return isset($_POST[self::$add]);
	}
}