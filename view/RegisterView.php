<?php

class RegisterView {
    private static $messageId = 'RegisterView::Message';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $register = 'RegisterView::Register';
    
    private $registerModel;
    
    public function __construct($registerModel) {
		assert($registerModel instanceof RegisterModel, 'First argument was not an instance of RegisterModel');
		
        $this->registerModel = $registerModel;
    }
    
	public function showLink() {
		$link = '<a href="?">Back to login</a>';
		
		return $link;
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
					<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getRequestName() . '" />
                    <br />
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<br />
					<label for="' . self::$passwordRepeat . '">Repeat password :</label>
					<input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />
					<br />
					<input type="submit" name="' . self::$register . '" value="Register" />
				</fieldset>
			</form>
		';
	}
	
	//Reads the current state from the UserModel and sets the appropriate message.
	public function getCurrentState() {
		
		if($this->registerModel->getUserNameEmpty()) {
			$this->setRequestMessageId('Username has too few characters, at least 3 characters.
			<br /> Password has too few characters, at least 6 characters.');
		}
		else if($this->registerModel->getUserPasswordEmpty()) {
			$this->setRequestMessageId('Password has too few characters, at least 6 characters.');
		}
		else if($this->registerModel->getUserNameShort()) {
			$this->setRequestMessageId('Username has too few characters, at least 3 characters.');
		}
		else if($this->registerModel->getUserPasswordShort()) {
			$this->setRequestMessageId('Password has too few characters, at least 6 characters.');
		}
		else if($this->registerModel->getUserAlreadyExists()) {
			$this->setRequestMessageId('User exists, pick another username.');
		}
		else if($this->registerModel->getIsSuccessfulReg()) {
			$this->setRequestMessageId('Registered new user.');
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
	
	public function getRequestPassword() {
		if(!isset($_POST[self::$password])) {
			$this->setRequestPassword('');
		}
		return $_POST[self::$password];
	}
	
	public function setRequestPassword($password) {
		assert(is_string($password), 'First argument was not a string');
		
		$_POST[self::$password] = $password;
	}
	
	public function getRequestRegister() {
		return isset($_POST[self::$register]);
	}
}
