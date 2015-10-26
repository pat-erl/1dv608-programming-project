## Use Cases

### UC 1 - Register

**Main scenario**

* Starts when a user wants to create login-credentials.
* System asks for username, password and repeated password.
* User provides username, password and repeated password.
* System saves the credentials and presents a success message.

**Alternate scenarios**

Credentials could not be registered due to invalid input.

* System presents an error message.
* Step 2 in main scenario.

### UC 2 - Login

**Main scenario**

* Starts when a user wants to authenticate.
* System asks for username and password.
* User provides username and password.
* System authenticates the user and presents the users page.

**Alternate scenarios**

User could not be authenticated due to invalid input.

* System presents an error message.
* Step 2 in main scenario.

### UC 3 - Add Exercise

**Preconditions**

* A user is authenticated. UC2.

**Main scenario**

* Starts when the user clicks on "add exercise".
* System asks for a name of an exercise.
* User provides a name of an exercise.
* System saves the exercise and presents the users collection of created exercises.

**Alternate scenarios**

Exercise could not be created due to invalid input.

* System presents an error message.
* Step 2 in main scenario.

### UC 4 - Add Result

**Preconditions**

* A user is authenticated. UC2.

**Main scenario**

* Starts when the user clicks on an exercise in the collection of created exercises.
* System asks for a result-text and a date.
* User provides a result-text and a date.
* System saves the result and presents the current exercise with all logged results.

**Alternate scenarios**

Result could not be created due to invalid input.

* System presents an error message.
* Step 2 in main scenario.

### UC 5 - Edit Exercise

**Preconditions**

* A user is authenticated. UC2.
* The user has clicked on an exercise in the collection of created exercises.

**Main scenario**

* Starts when the user clicks on "edit exercise".
* System asks for a name of an exercise.
* User provides a name of an exercise.
* System saves the exercise and presents the current exercise with all logged results.

**Alternate scenarios**

Exercise could not be edited due to invalid input.

* System presents an error message.
* Step 2 in main scenario.

### UC 6 - Edit Result

**Preconditions**

* A user is authenticated. UC2.
* The user has clicked on an exercise in the collection of created exercises.

**Main scenario**

* Starts when the user clicks on "edit result".
* System asks for a result-text and a date.
* User provides a result-text and a date.
* System saves the result and presents the current exercise with all logged results.

**Alternate scenarios**

Result could not be edited due to invalid input.

* System presents an error message.
* Step 2 in main scenario.

### UC 7 - Delete Exercise

**Preconditions**

* A user is authenticated. UC2.
* The user has clicked on an exercise in the collection of created exercises.

**Main scenario**

* Starts when the user clicks on "delete exercise".
* System asks the user to confirm delete.
* User confirms delete.
* System deletes the exercise and presents the users collection of created exercises.

**Alternate scenarios**

User clicks on other link intead of confirming.

* System presents content based on which other link was clicked.

### UC 8 - Delete Result

**Preconditions**

* A user is authenticated. UC2.
* The user has clicked on an exercise in the collection of created exercises.

**Main scenario**

* Starts when the user clicks on "delete result".
* System asks the user to confirm delete.
* User confirms delete.
* System deletes the result and presents the current exercise with all logged results.

**Alternate scenarios**

User clicks on other link intead of confirming.

* System presents content based on which other link was clicked.

### UC 9 - Logout

**Preconditions**

* A user is authenticated. UC2.

**Main scenario**

* Starts when the user no longer wants to be logged in.
* System presents a logout choice.
* User tells the system he wants to log out.
* System logs the user out and presents the login page.