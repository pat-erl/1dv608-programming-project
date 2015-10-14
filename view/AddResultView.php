<?php

class AddResultView {
    
    private static $messageId = 'RegisterView::Message';
    private static $entry = 'RegisterView::LogEntry';
    private static $add = 'RegisterView::Add';
    
    private $logEntryModel;
    
    public function __construct($logEntryModel) {
		assert($logEntryModel instanceof LogEntryModel, 'First argument was not an instance of LogEntryModel');
		
        $this->logEntryModel = $logEntryModel;
    }
	
    public function response() {
        
        $message = '';
        
        $message = $this->getRequestMessageId();
        return $this->generateRegistrationFormHTML($message);
	}
	
	private function generateRegistrationFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Enter exercise name</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<label for="' . self::$entry . '">Result :</label>
					<input autofocus type="text" id="' . self::$entry . '" name="' . self::$entry . '" value="' . $this->getRequestEntry() . '" />
                    <br />
					<input id="button" type="submit" name="' . self::$add . '" value="Add" />
				</fieldset>
			</form>
		';
	}
	
	//Reads the current state from the UserModel and sets the appropriate message.
	public function getCurrentState() {
		if($this->logEntryModel->getLogEntryEmpty()) {
			$this->setRequestMessageId('Entry must be at least 3 characters.');
		}
		else if($this->logEntryModel->getInvalidCharacters()) {
			$this->setRequestMessageId('ENtry contains invalid characters.');
			$entry = strip_tags($this->getRequestEntry());
			$this->setRequestEntry($entry);
		}
		else if($this->logEntryModel->getLogEntryTooShort()) {
			$this->setRequestMessageId('Entry must be at least 3 characters.');
		}
		else if($this->logEntryModel->getIsSuccessfulReg()) {
			$logEntry = strtolower($this->getRequestEntry());
			$logEntry = ucfirst($logEntry);
			
			$this->setRequestMessageId('Successfully logged ' . $logEntry . '.');
			$this->setRequestName('');
		}
		else {
			$this->setRequestMessageId('Some other error!');
		}
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
	
	public function getRequestEntry() {
		if(!isset($_POST[self::$entry])) {
			$this->setRequestEntry('');	
		}
		return $_POST[self::$entry];
	}
	
	public function setRequestEntry($entry) {
		assert(is_string($entry), 'First argument was not a string');
		
		$_POST[self::$entry] = $entry;
	}
	
	public function getRequestAdd() {
		return isset($_POST[self::$add]);
	}
}