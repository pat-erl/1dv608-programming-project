<?php

class RegistrationView {
    private static $messageId = 'RegistrationView::Message';
    private static $name = 'RegistrationView::UserName';
    private static $password = 'RegistrationView::Password';
    private static $passwordRepeat = 'RegistrationView::PasswordRepeat';
    private static $register = 'RegistrationView::Register';
    
    
    public function __construct($loginModel) {
		assert($loginModel instanceof LoginModel, 'First argument was not an instance of LoginModel');
		
        $this->loginModel = $loginModel;
    }
    
    public function response() {
        $message = 'Hej!';
        return $this->generateRegistrationFormHTML($message);
	}
	
	
	private function generateRegistrationFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />
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
}
