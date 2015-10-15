<?php

class AddResultView {
    
    private static $messageId = 'AddResultView::Message';
    private static $text = 'AddResultView::ResultText';
    private static $add = 'AddResultView::Add';
    
    private $addResultModel;
    
    public function __construct($addResultModel) {
		assert($addResultModel instanceof AddResultModel, 'First argument was not an instance of AddResultModel');
		
        $this->addResultModel = $addResultModel;
    }
	
    public function response() {
        $message = '';
        
        $message = $this->getRequestMessageId();
        return $this->generateRegistrationFormHTML($message);
	}
	
	//Reads the current state from the UserModel and sets the appropriate message.
	public function currentState() {
		if($this->addResultModel->getLogEntryEmpty()) {
			$this->setRequestMessageId('Result must be at least 3 characters.');
		}
		else if($this->addResultModel->getInvalidCharacters()) {
			$this->setRequestMessageId('Result contains invalid characters.');
			$text = strip_tags($this->getRequestText());
			$this->setRequestText($text);
		}
		else if($this->addResultModel->getLogEntryTooShort()) {
			$this->setRequestMessageId('Result must be at least 3 characters.');
		}
		else if($this->addResultModel->getIsSuccessfulAdd()) {
			$text = strtolower($this->getRequestText());
			$text = ucfirst($text);
			
			$this->setRequestMessageId('Successfully logged ' . $text . '.');
			$this->setRequestText('');
		}
		else {
			$this->setRequestMessageId('Some other error!');
		}
	}
	
	private function generateRegistrationFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Enter result name</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<label for="' . self::$entry . '">Result :</label>
					<input autofocus type="text" id="' . self::$entry . '" name="' . self::$entry . '" value="' . $this->getRequestEntry() . '" />
                    <br />
					<input id="button" type="submit" name="' . self::$add . '" value="Add" />
				</fieldset>
			</form>
		';
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