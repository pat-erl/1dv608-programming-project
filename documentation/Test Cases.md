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

### TC 2.1 - Show Login Form

**Input**

* Navigate to the application URL.

**Output**

* The headline "Login Page" is shown.
* A form for login is shown.
* A link with the text "Register a new user" is shown.

### TC 2.2 - Login with invalid input fails

**Input**

* TC 2.1 - Show Login Form.
* Press "Login" button with empty fields, short or wrong username or password or text with invalid characters.

**Output**

* An appropriate error message is shown.
* Still shows the login form.

### TC 2.3 - Successful Login

**Input**

* TC 2.1 - Show Login Form.
* Press "Login" button with valid inputs.

**Output**

* The headline displays the name of the user.
* A logout button is shown.
* A navigation menu is shown.
* The users's personal content is shown. 

### TC 3.1 - Show Add Exercise Form

**Input**

* TC 2.3 - Successful Login.
* Click on "Add Exercise".

**Output**

* A form for adding exercises is shown.

### TC 3.2 - Add exercise with invalid input fails

**Input**

* TC 3.1 - Show Add Exercise Form.
* Press "Add" button with empty field, short name, a name that already exists or text with invalid characters.

**Output**

* An appropriate error message is shown.
* Still shows the add exercise form.

### TC 3.3 - Successful Adding of Exercise

**Input**

* TC 3.1 - Show Add Exercise Form.
* Press "Add" button with valid inputs.

**Output**

* The users collection of created exercises is shown.
* The newly created exercise is in the collection.

### TC 4.1 - Show Add Result Form

**Input**

* TC 3.3 - Successful Adding of Exercise.
* Click on an exercise in the users collection of exercises.

**Output**

* A list of all logged results of the current exercise is shown.
* A form for adding results is shown.

### TC 4.2 - Add result with invalid input fails

**Input**

* TC 4.1 - Show Add Result Form.
* Press "Log" button with empty fields, short or wrong result-text or date or text with invalid characters.

**Output**

* An appropriate error message is shown.
* Still shows the add result form.

### TC 4.3 - Successful Adding of Result

**Input**

* TC 4.1 - Show Add Result Form.
* Press "Log" button with valid inputs.

**Output**

* A list of all logged results of the current exercise is shown.
* The newly created result is in the list.
* A form for adding results is shown.

### TC 5.1 - Show Edit Exercise Form

**Input**

* TC 3.3 - Successful Adding of Exercise.
* Click on an exercise in the users collection of exercises.
* Click on "edit exercise".

**Output**

* A form for editing the exercise is shown.

### TC 5.2 - Edit exercise with invalid input fails

**Input**

* TC 5.1 - Show Edit Exercise Form.
* Press "Update" button with empty field, short name, a name that already exists or text with invalid characters.

**Output**

* An appropriate error message is shown.
* Still shows the edit exercise form.

### TC 5.3 - Successful Editing of Exercise

**Input**

* TC 5.1 - Show Edit Exercise Form.
* Press "Update" button with valid inputs.

**Output**

* The name of the current exercise is changed.
* A list of all logged results of the current exercise is shown.
* A form for adding results is shown.

### TC 6.1 - Show Edit Result Form

**Input**

* TC 4.3 - Successful Adding of Result.
* Click on "edit result".

**Output**

* A form for editing the result is shown.

### TC 6.2 - Edit result with invalid input fails

**Input**

* TC 6.1 - Show Edit Result Form.
* Press "Update" button with empty fields, short or wrong result-text or date or text with invalid characters.

**Output**

* An appropriate error message is shown.
* Still shows the edit result form.

### TC 6.3 - Successful Editing of Result

**Input**

* TC 6.1 - Show Edit Exercise Form.
* Press "Update" button with valid inputs.

**Output**

* A list of all logged results of the current exercise is shown.
* The newly updated result is in the list.
* A form for adding results is shown.

### TC 7.1 - Show Delete Exercise Form

**Input**

* TC 3.3 - Successful Adding of Exercise.
* Click on an exercise in the users collection of exercises.
* Click on "delete exercise".

**Output**

* A form for deleting the exercise is shown.

### TC 7.2 - Delete exercise

**Input**

* TC 7.1 - Show Delete Exercise Form.
* Press "Confirm" button.

**Output**

* The users collection of created exercises is shown.
* The newly deleted exercise is not in the collection.

### TC 8.1 - Show Delete Result Form

**Input**

* TC 4.3 - Successful Adding of Result.
* Click on "delete result".

**Output**

* A form for deleting the result is shown.

### TC 8.2 - Delete result

**Input**

* TC 8.1 - Show Delete Result Form.
* Press "Confirm" button.

**Output**

* A list of all logged results of the current exercise is shown.
* The newly deleted result is not in the list.
* A form for adding results is shown.

### TC 9.1 - Show Logout Form

**Input**

* TC 2.3 - Successful Login.

**Output**

* TC 2.3 - Successful Login.

### TC 9.2 - Logout

**Input**

* TC 9.1 - Show Logout Form.
* Press "Logout" button.

**Output**

* TC 2.1 - Show Login Form.