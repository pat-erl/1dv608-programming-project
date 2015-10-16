<?php

class AddResultDetailedView {
    
    private static $exercise = "exercise";
    private static $messageId = 'AddResultView::Message';
    private static $text = 'AddResultView::ResultText';
    private static $date = 'AddResultView::Date';
    private static $add = 'AddResultView::Add';
    
    private $addResultModel;
    private $userCatalogue;
    
    public function __construct($addResultModel, $userCatalogue) {
		assert($addResultModel instanceof AddResultModel, 'First argument was not an instance of AddResultModel');
		assert($userCatalogue instanceof UserCatalogue, 'Second argument was not an instance of UserCatalogue');
		
        $this->addResultModel = $addResultModel;
        $this->userCatalogue = $userCatalogue;
    }
	
    public function response() {
        $message = '';
        
        $message = $this->getRequestMessageId();
        return $this->generateRegistrationFormHTML($message);
	}
	
	//Reads the current state from the UserModel and sets the appropriate message.
	public function currentState() {
		if($this->addResultModel->getResultTextEmpty()) {
			$this->setRequestMessageId('Result must be at least 3 characters.');
		}
		else if($this->addResultModel->getInvalidCharacters()) {
			$this->setRequestMessageId('Result contains invalid characters.');
			$text = strip_tags($this->getRequestText());
			$this->setRequestText($text);
		}
		else if($this->addResultModel->getResultTextTooShort()) {
			$this->setRequestMessageId('Result must be at least 3 characters.');
		}
		else if($this->addResultModel->getIsSuccessfulAdd()) {
			$text = strtolower($this->getRequestText());
			$text = ucfirst($text);
			
			$this->setRequestMessageId('Successfully added ' . $text . '.');
			$this->setRequestText('');
		}
		else {
			$this->setRequestMessageId('Some other error!');
		}
	}
	
	private function generateRegistrationFormHTML($message) {
		$ret = '';
        $currentUser = $this->userCatalogue->getCurrentUser();
        $exercises = $this->userCatalogue->getExercises($currentUser);
        
        uasort($exercises, function($a, $b) { return strcmp($a->getName(), $b->getName()); } );
        
        foreach($exercises as $exercise) {
            $name = strtolower($exercise->getName());
			$name = ucfirst($name);
            $ret .= '<a href="?'. self::$exercise .'='. $exercise->getId().'">' . $name . '</a>';
        }
     
		$ret .= '
			<form method="post" > 
				<fieldset>
					<legend>Enter a result</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<label for="' . self::$text . '">Result :</label>
					<input autofocus type="text" id="' . self::$text . '" name="' . self::$text . '" value="' . $this->getRequestText() . '" />
					<input type="date" id="' . self::$date . '" name="' . self::$date . '" value="' . date("Y-m-j") .'" />
                    <br />
					<input id="button" type="submit" name="' . self::$add . '" value="Log" />
				</fieldset>
			</form>
		';
		
		return $ret;
	}
	
	//Getters and setters for the private membervariables.
	
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
	
	public function getRequestAdd() {
		return isset($_POST[self::$add]);
	}
}