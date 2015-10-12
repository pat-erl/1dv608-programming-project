<?php

class AddExerciseView {
    
    private static $messageId = 'RegisterView::Message';
    private static $name = 'RegisterView::ExerciseName';
    private static $add = 'RegisterView::Add';
    
    private $addExerciseModel;
    
    public function __construct($addExerciseModel) {
		assert($addExerciseModel instanceof AddExerciseModel, 'First argument was not an instance of AddExerciseModel');
		
        $this->addExerciseModel = $addExerciseModel;
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
					<legend>Enter name of exercise</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<label for="' . self::$name . '">Name :</label>
					<input class="extramargin" type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getRequestName() . '" />
                    <br />
					<input id="button" type="submit" name="' . self::$add . '" value="Add" />
				</fieldset>
			</form>
		';
	}
	
	//Reads the current state from the UserModel and sets the appropriate message.
	public function getCurrentState() {
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
		else if($this->addExerciseModel->getIsSuccessfulReg()) {
			$this->setRequestMessageId('Successfully registered the exercise ' . $this->getRequestName() . '.');
			$this->setRequestName('');
		}
		else if($this->addExerciseModel->getExerciseAlreadyExists()) {
			$this->setRequestMessageId('Exercise already exists.');
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