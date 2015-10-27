<?php

class AddExerciseView {
    
    /*
    	Handles the content for adding new exercises.
    */
    
    private static $messageId = 'AddExerciseView::Message';
    private static $name = 'AddExerciseView::ExerciseName';
    private static $add = 'AddExerciseView::Add';
    
    private $addExerciseModel;
    
    public function __construct(AddExerciseModel $addExerciseModel) {
        $this->addExerciseModel = $addExerciseModel;
    }
	
    public function response() {
        $message = '';
        
        $message = $this->getRequestMessageId();
        return $this->generateAddExerciseForm($message);
	}
	
	private function generateAddExerciseForm($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Enter name of exercise</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<label for="' . self::$name . '">Exercise name :</label>
					<input autofocus type="text" maxlength="15" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getRequestName() . '" />
                    <br />
					<input id="button" type="submit" name="' . self::$add . '" value="Add" />
				</fieldset>
			</form>
		';
	}
	
	//Reads the current state from the AddExerciseModel and sets the appropriate message.
	public function displayMessage() {
		if($this->addExerciseModel->getExerciseNameEmpty()) {
			$this->setRequestMessageId('Exercise must be at least 3 characters.');
		}
		else if($this->addExerciseModel->getInvalidCharacters()) {
			$this->setRequestMessageId('Exercise contains invalid characters.');
			$name = strip_tags($this->getRequestName());
			$this->setRequestName($name);
		}
		else if($this->addExerciseModel->getExerciseNameTooShort()) {
			$this->setRequestMessageId('Exercise must be at least 3 characters.');
		}
		else if($this->addExerciseModel->getExerciseAlreadyExists()) {
			$this->setRequestMessageId($this->getRequestName() . ' already exists.');
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
	
	public function getRequestName() {
		if(!isset($_POST[self::$name])) {
			$this->setRequestName('');	
		}
		return $_POST[self::$name];
	}
	
	public function setRequestName($name) {
		assert(is_string($name), 'First argument was not a string');
		
		$_POST[self::$name] = $name;
	}
	
	public function getRequestAdd() {
		return isset($_POST[self::$add]);
	}
}