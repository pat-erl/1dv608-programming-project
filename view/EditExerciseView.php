<?php

class EditExerciseView {
    
    private static $messageId = 'EditExerciseView::Message';
    private static $name = 'EditExerciseView::ExerciseName';
    private static $edit = 'EditExerciseView::Edit';
    
    private $editExerciseModel;
    private $userCatalogue;
    
    public function __construct(EditExerciseModel $editExerciseModel, UserCatalogue $userCatalogue) {
        $this->editExerciseModel = $editExerciseModel;
        $this->userCatalogue = $userCatalogue;
    }
	
    public function response() {
        $message = '';
        
        $message = $this->getRequestMessageId();
        return $this->generateRegistrationFormHTML($message);
	}
	
	private function generateRegistrationFormHTML($message) {
	    $ret = '';
	    
	    $currentUser = $this->userCatalogue->getCurrentUser();
	    $currentExercises = $this->userCatalogue->getExercises($currentUser);
	    $currentExercise = $this->userCatalogue->getCurrentExercise($currentExercises);
	    
		$ret .= '
			<form method="post" > 
				<fieldset>
					<legend>Change name of exercise</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<label for="' . self::$name . '">Exercise name :</label>
					<input autofocus type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $currentExercise->getName() . '" />
                    <br />
					<input id="button" type="submit" name="' . self::$edit . '" value="Update" />
				</fieldset>
			</form>
		';
		return $ret;
	}
	
	//Reads the current state from the UserModel and sets the appropriate message.
	public function currentState() {
		if($this->editExerciseModel->getExerciseNameEmpty()) {
			$this->setRequestMessageId('Exercise must be at least 3 characters.');
		}
		else if($this->editExerciseModel->getInvalidCharacters()) {
			$this->setRequestMessageId('Exercise contains invalid characters.');
			$name = strip_tags($this->getRequestName());
			$this->setRequestName($name);
		}
		else if($this->editExerciseModel->getExerciseNameTooShort()) {
			$this->setRequestMessageId('Exercise must be at least 3 characters.');
		}
		else if($this->editExerciseModel->getIsSuccessfulEdit()) {
			$exerciseName = strtolower($this->getRequestName());
			$exerciseName = ucfirst($exerciseName);
			
			$this->setRequestMessageId('Successfully updated to ' . $exerciseName . '.');
			$this->setRequestName('');
		}
		else if($this->editExerciseModel->getExerciseAlreadyExists()) {
			$exerciseName = strtolower($this->getRequestName());
			$exerciseName = ucfirst($exerciseName);
			
			$this->setRequestMessageId($exerciseName . ' already exists.');
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
	
	public function getRequestEdit() {
		return isset($_POST[self::$edit]);
	}
}