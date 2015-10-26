## Use Cases

### UC1 - Register

**Main scenario**

* Starts when a user wants to create login-credentials.
* System asks for username, password and a repeated password.
* User provides the necessary input.
* System saves the credentials and presents a success message.

**Alternate scenarios**

Credentials could not be registered due to invalid input.

* System presents an error message.
* Step 2 in main scenario.

### UC2 - Login

**Main scenario**

* Starts when a user wants to authenticate.
* System asks for username and password.
* User provides the necessary input.
* System authenticates the user and presents the users page.

**Alternate scenarios**

User could not be authenticated due to invalid input.

* System presents an error message.
* Step 2 in main scenario.

### UC3 - Add Exercise

**Preconditions**

* A user is authenticated. UC2.

**Main scenario**

* Starts when the user clicks on "add exercise".
* System asks for a name of an exercise.
* User provides the necessary input.
* System saves the exercise and presents the users collection of created exercises.

**Alternate scenarios**

Exercise could not be created due to invalid input.

* System presents an error message.
* Step 2 in main scenario.

### UC4 - Add Result

**Preconditions**

* A user is authenticated. UC2.

**Main scenario**

* Starts when the user clicks on an exercise in the collection of created exercises.
* System asks for a result-text and a date.
* User provides the necessary input.
* System saves the result and presents the current exercise with all logged results.

**Alternate scenarios**

Result could not be created due to invalid input.

* System presents an error message.
* Step 2 in main scenario.

### UC5 - Edit Exercise

**Preconditions**

* A user is authenticated. UC2.
* The user has clicked on an exercise in the collection of created exercises.

**Main scenario**

* Starts when the user clicks on "edit exercise".
* System asks for a name of an exercise.
* User provides the necessary input.
* System saves the exercise and presents the current exercise with all logged results.

**Alternate scenarios**

Exercise could not be edited due to invalid input.

* System presents an error message.
* Step 2 in main scenario.

### UC6 - Edit Result

**Preconditions**

* A user is authenticated. UC2.
* The user has clicked on an exercise in the collection of created exercises.

**Main scenario**

* Starts when the user clicks on "edit result".
* System asks for a result-text and a date.
* User provides the necessary input.
* System saves the result and presents the current exercise with all logged results.

**Alternate scenarios**

Result could not be edited due to invalid input.

* System presents an error message.
* Step 2 in main scenario.

### UC7 - Delete Exercise

**Preconditions**

* A user is authenticated. UC2.
* The user has clicked on an exercise in the collection of created exercises.

**Main scenario**

* Starts when the user clicks on "delete exercise".
* System asks the user to confirm delete.
* User provides the necessary input.
* System deletes the exercise and presents the users collection of created exercises.

**Alternate scenarios**

back button????

### UC8 - Delete Result

**Preconditions**

* A user is authenticated. UC2.
* The user has clicked on an exercise in the collection of created exercises.

**Main scenario**

* Starts when the user clicks on "delete result".
* System asks the user to confirm delete.
* User provides the necessary input.
* System deletes the result and presents the current exercise with all logged results.

**Alternate scenarios**

back button????

### UC9 - Logout

**Preconditions**

* A user is authenticated. UC2.

**Main scenario**

* Starts when the user no longer wants to be logged in.
* System presents a logout choice.
* User tells the system he wants to log out.
* System logs the user out and presents the login page.