<?php

class LoginView {
	
	/*
    	
    */
	
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $messageId = 'LoginView::Message';
	private static $register = 'LoginView::Register';
	
	private $loginModel;
	
	public function __construct(LoginModel $loginModel) {
        $this->loginModel = $loginModel;
    }
	
	public function response() {
		$message = '';
		
		$message = $this->getRequestMessageId();
		return $this->generateLoginForm($message);
	}
	
	public function logoutPanel() {
		return $this->generateLogoutButton(); 
	}
	
	private function generateLoginForm($message) {
		assert(is_string($message), 'First argument was not a string');
		
		return '
			<form method="post" > 
				<fieldset>
					<legend>Enter username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<label for="' . self::$name . '">Username :</label>
					<input type="text" autofocus maxlength="10" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getRequestName() . '" />
					<br />
					<label for="' . self::$password . '">Password :</label>
					<input class="extramargin3" type="password" maxlength="15" id="' . self::$password . '" name="' . self::$password . '" />
					<br />
					<input id="button" type="submit" name="' . self::$login . '" value="Login" />
				</fieldset>
			</form>
		';
	}
	
	private function generateLogoutButton() {
		return '
			<form id="logoutform" method="post">
				<input id="buttonlogout" type="submit" name="' . self::$logout . '" value="Logout"/>
			</form>
		';
	}
	
	//Reads the current state from the LoginModel and sets the appropriate message.
	public function displayMessage() {
		if($this->loginModel->getUserNameEmpty()) {
			$this->setRequestMessageId('Username is missing.');
		}
		else if($this->loginModel->getUserPasswordEmpty()) {
			$this->setRequestMessageId('Password is missing.');
		}
		else {
			$this->setRequestMessageId('Wrong name or password.');
		}
	}
	
	//Getters and setters for the private membervariables.
	
	public function getRequestLogin() {
		return isset($_POST[self::$login]);
	}
	
	public function getRequestLogout() {
		return isset($_POST[self::$logout]);
	}
	
	public function getRequestName() {
		if(!isset($_POST[self::$name])) {
			if(isset($_SESSION['RegName'])) {
				$this->setRequestName($_SESSION['RegName']); //Kolla detta i sessionModel som alla andra filer gör????
				unset($_SESSION['RegName']);
			}
			else {
				$this->setRequestName('');
			}
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
	
	public function getRequestMessageId() {
		if(!isset($_POST[self::$messageId])) {
			if(isset($_SESSION['RegName'])) {
				$this->setRequestMessageId('Successfully registered ' . $_SESSION['RegName'] . '.'); //Kolla detta i sessionModel som alla andra filer gör????
			}
			else {
				$this->setRequestMessageId('');
			}
		}
		return $_POST[self::$messageId];
	}
	
	public function setRequestMessageId($message) {
		assert(is_string($message), 'First argument was not a string');
		
		$_POST[self::$messageId] = $message;
	}
}