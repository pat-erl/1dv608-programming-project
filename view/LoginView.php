<?php

class LoginView {
	
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private static $register = 'LoginView::Register';
	
	private $loginModel;
	
	public function __construct($loginModel) {
		assert($loginModel instanceof LoginModel, 'First argument was not an instance of LoginModel');
		
        $this->loginModel = $loginModel;
    }
	
	public function showLink($isLoggedIn) {
		if(!$isLoggedIn) {
			return '<a href="?register">Register a new user</a>';
		}
	}
	
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isLoggedIn) {
		assert(is_bool($isLoggedIn), 'First argument was not a boolean value');
		
		$message = '';
		
		if($isLoggedIn) {
			$message = $this->getRequestMessageId();
			return $this->generateLogoutButtonHTML($message); 
		}
		else {
			$message = $this->getRequestMessageId();
			return $this->generateLoginFormHTML($message);
		}
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		assert(is_string($message), 'First argument was not a string');
		
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		assert(is_string($message), 'First argument was not a string');
		
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getRequestName() . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//Reads the current state from the LoginModel and sets the appropriate message.
	public function getCurrentState() {
		if($this->loginModel->getUserNameEmpty()) {
			$this->setRequestMessageId('Username is missing');
		}
		else if($this->loginModel->getUserPasswordEmpty()) {
			$this->setRequestMessageId('Password is missing');
		}
		else if($this->loginModel->getIsAlreadyLoggedIn()) {
			$this->setRequestMessageId('');
		}
		else if($this->loginModel->getIsLoggedIn()) {
			$this->setRequestMessageId('Welcome');
		}
		else if($this->loginModel->getIsLoggedOut()) {
			$this->setRequestMessageId('Bye bye!');
		}
		else {
			$this->setRequestMessageId('Wrong name or password');
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
				$this->setRequestName($_SESSION['RegName']);
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
				$this->setRequestMessageId('Registered new user.');
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