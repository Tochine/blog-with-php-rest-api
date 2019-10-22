# blog-with-php-rest-api-backend

A blog project built on OOP PHP with REST API.

### How to download this project

step 1: Setup your database and create a user table with an **id, name, email, password and created_at field.**

Step 2: Modify the Databse.php file inside config folder to match your database credentials.

step 3: Create a folder and **git clone** this project or **git pull** this repo.

step 4: go to your terminal or command prompt and cd into the project folder.

step 5: type **composer autoload** on your terminal or command prompt to download dependencies.

### How to test your api endpoint.

step 1: Install any api testing app (I used postman) and open the app.

step 2: Type in your url structure and file path Eg http://localhost/projectfolder/file.php on the api testing app

##### Endpoint.

CREATE a user - type in your url including file path E.g **http://localhost/projectfolder/api/create_user.php**

Registration details: name, email and password.

click send. If the registration is successful you will get a 200 code response with 'User was created' message, otherwise a 400 error code with a message 'Unable to create user'.

LOGIN a user enter url with file path E.g **http://localhost/projectfolder/api/login.php**

Login details: enter the email and password you used for registration. If successful you will get a 'User logged in!' message otherwise a 400 error response.

CREATE a post - type in your url E.g **http://localhost/projectfolder/api/create_post.php**

Registration details: title, content, author, category_id.
Click send. If succesful you will get a 200 code response with "Post created successfully" or else a 400 error code 'Unable to create post' message.

**More update coming soon**
