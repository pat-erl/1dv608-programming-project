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
	
	private $loginModel;
	
	public function __construct($loginModel) {
        $this->loginModel = $loginModel;
    }
	
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isLoggedIn) {
		
		$message = '';
		$response;
		
		if($isLoggedIn) {
			$message = $this->getRequestMessageId();
			$response = $this->generateLogoutButtonHTML($message); 
		}
		else {
			//Här kanske kolla om det är första gången sidan visas eller en utloggning??( tomt eller bye bye mao.
			//Och då initiera messageId så det slipper göras i index??
			$message = $this->getRequestMessageId();
			$response = $this->generateLoginFormHTML($message);
		}
		
		return $response;
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
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
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	public function getCurrentState() {
		if($this->loginModel->getUserNameEmpty()) {
			$this->setRequestMessageId('Username is missing');
		}
		else if ($this->loginModel->getUserPasswordEmpty()) {
			$this->setRequestMessageId('Password is missing');
		}
		else if($this->loginModel->getUserNameOk()) {
			if($this->loginModel->getUserPasswordOk()) {
				$this->setRequestMessageId('Welcome');
			}
			else {
				$this->setRequestMessageId('Wrong name or password');
			}
		}
		else {
			$this->setRequestMessageId('Wrong name or password');
		}
		
		if($this->loginModel->getIsLoggedOut()) {
			$this->setRequestMessageId('Bye bye!');
		}
	}

	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getRequestLogin() {
		return isset($_POST[self::$login]);
	}
	
	public function getRequestLogout() {
		return isset($_POST[self::$logout]);
	}
	
	public function getRequestUserName() {
		return $_POST[self::$name];
	}
	
	public function getRequestPassword() {
		return $_POST[self::$password];
	}
	
	public function getRequestMessageId() {
		return $_POST[self::$messageId];
	}
	
	public function setRequestMessageId($message) {
		$_POST[self::$messageId] = $message;
	}
}