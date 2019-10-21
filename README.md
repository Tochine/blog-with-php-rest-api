# blog-with-php-rest-api-backend
A blog project built on OOP PHP with REST API. 

### How to download this project
step 1: Setup your database and create a user table with an __id, name, email, password and created_at field.__

Step 2: Modify the Databse.php file inside config folder to match your database credentials.

step 3: Create a folder and __git clone__ this project or __git pull__ this repo. 

step 4: go to your terminal or command prompt and cd into the project folder.

step 5: type __composer autoload__ on your terminal or command prompt to download dependencies.

### How to test your api endpoint.
step 1: Install any api testing app (I used postman) and open the app.

step 2: Type in your url structure and file path Eg http://localhost/projectfolder/file.php on the api testing app

##### Endpoint.

CREATE a user type in your url including file path E.g __http://localhost/projectfolder/api/create_user.php__

Registration details: name, email and password.

click send. If the registration is successful you will get a 200 code response with 'User was created' message, otherwise a 400 error code with a message 'Unable to create user'.

To LOGIN a user enter url with file path E.g __http://localhost/projectfolder/api/login.php__

Login details: enter the email and password you used for registrattion. If successful you will get a 'User logged in!' message otherwise a 400 error response.

__More update coming soon__
