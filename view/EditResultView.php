<?php

class EditResultView {
	
	/*
    
    */
    
    private static $editResultPage = 'editresultpage';
    private static $editExercisePage = 'editexercisepage';
    private static $messageId = 'EditResultView::Message';
    private static $text = 'EditResultView::ResultText';
    private static $date = 'EditResultView::Date';
    private static $edit = 'EditResultView::Edit';
    
    private $editResultModel;
    private $userCatalogue;
    
    public function __construct(EditResultModel $editResultModel, UserCatalogue $userCatalogue) {
        $this->editResultModel = $editResultModel;
        $this->userCatalogue = $userCatalogue;
    }
	
    public function response() {
        $message = '';
        
        $message = $this->getRequestMessageId();
        return $this->generateEditResultForm($message);
	}
	
	private function generateEditResultForm($message) {
		$ret = '';
        $currentUser = $this->userCatalogue->getCurrentUser();
        $exercises = $this->userCatalogue->getExercises($currentUser);
		$currentExercise = $this->userCatalogue->getCurrentExercise($exercises);
		$exerciseName = $currentExercise->getName();
		$results = $currentExercise->getResults();
		$currentResult = $this->userCatalogue->getCurrentResult($results);
		
		$ret .= '
			<form method="post" > 
				<fieldset>
					<legend>Change result for ' . $exerciseName . '</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<label for="' . self::$text . '">Result :</label>
					<input autofocus type="text" maxlength="10" id="' . self::$text . '" name="' . self::$text . '" value="' . $currentResult->getText() . '" />
					<input class="longerdatefield" type="date" id="' . self::$date . '" name="' . self::$date . '" value="' . $currentResult->getDateStamp() .'" />
                    <br />
					<input id="button" type="submit" name="' . self::$edit . '" value="Update" />
				</fieldset>
			</form>
		';
		return $ret;
	}
	
	//Reads the current state from the EditResultModel and sets the appropriate message.
	public function currentState() {
		if($this->editResultModel->getResultTextEmpty()) {
			$this->setRequestMessageId('Result must be at least 3 characters.');
		}
		else if($this->editResultModel->getDateEmpty()) {
			$this->setRequestMessageId('A date must be entered.');
		}
		else if($this->editResultModel->getInvalidCharacters()) {
			$this->setRequestMessageId('Result contains invalid characters.');
			$text = strip_tags($this->getRequestText());
			$this->setRequestText($text);
		}
		else if($this->editResultModel->getResultTextTooShort()) {
			$this->setRequestMessageId('Result must be at least 3 characters.');
		}
		else if($this->editResultModel->getDateWrongFormat()) {
			$this->setRequestMessageId('A date must be in the correct format.');
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
	
	public function getRequestEdit() {
		return isset($_POST[self::$edit]);
	}
}