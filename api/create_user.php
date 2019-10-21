<?php

// files needed to connect to database
include_once '../config/Database.php';

// headers needed
header("Access-Control-Allow-Origin: http://localhost:8888/php-blog/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../models/User.php';

//database connection
$database = new Database();
$db = $database->getConnection();

//instantiate user object
$user = new User($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set property values
$user->name = $data->name;
$user->email = $data->email;
$user->password = $data->password;

// create the user
if (
    !empty($user->name) &&
    !empty($user->email) &&
    !empty($user->password) &&
    $user->create()

) {

    // response code
    http_response_code(200);

    // message: user was created
    echo json_encode(array("message" => "User was created."));
} else {

    // response code
    http_response_code(400);

    //message: unable to create user
    echo json_encode(array("message" => "Unable to create user."));
}
