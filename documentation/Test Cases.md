## Test Cases

### TC 1.1 - Show Register Form

**Input**

* Navigate to the application URL.
* Press "Register a new user".

**Output**

* The headline "Register Page" is shown.
* A form for registration of a new user is shown.
* A link with the text "Back to login" is shown.

### TC 1.2 - Register with invalid input fails

**Input**

* TC 1.1 - Show Register Form.
* Press "Register" button with empty fields, short or wrong username or password, 
passwords that doesn't match, a user that already exists or text with invalid characters.

**Output**

* An appropriate error message is shown.
* Still shows the register form.

### TC 1.3 - Successful Registration

**Input**

* TC 1.1 - Show Register Form.
* Press "Register" button with valid inputs.

**Output**

* A success message is shown.
* Shows login form with the name filled in.