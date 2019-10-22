<?php
// Database file needed.
include_once '../../config/Database.php';

// headers needed.
header("Access-Control-Allow-Origin: http://localhost:8888/php-blog/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, 
    Authorization, X-Requested-With");


// files needed.
require "../vendor/autoload.php";
include_once '../models/User.php';
// generate json web token
include_once '../config/Core.php';
include_once '../jwt/src/BeforeValidException.php';
include_once '../jwt/src/ExpiredException.php';
include_once '../jwt/src/SignatureInvalidException.php';
include_once '../jwt/src/JWT.php';

use Firebase\JWT\JWT;

//database connection
$database = new Database();
$db = $database->getConnection();

//instantiate user object
$user = new User($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// Set Property values.
$user->email = $data->email;
$user->password = $data->password;
$email_exists = $user->emailExists();



//Check if email exist and if password is correct.
if ($email_exists && password_verify($data->password, $user->password)) {
    $secret_key = "YOUR_SECRET_KEY";
    $issuer_claim = "THE_ISSUER"; // this can be the servername
    $audience_claim = "THE_AUDIENCE";
    $issuedat_claim = time(); // issued at
    $notbefore_claim = $issuedat_claim + 10; //not before in seconds
    $expire_claim = $issuedat_claim + 60; // expire time in seconds
    $token = array(
        "iss" => $iss,
        "aud" => $aud,
        "iat" => $iat,
        "nbf" => $nbf,
        "data" => array(
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email
        )
    );
    // Response code
    http_response_code(200);

    // generate jwt
    $jwt = JWT::encode($token, $secret_key);
    echo json_encode(
        array(
            "message" => "User logged in!.",
            "jwt" => $jwt,
            "email" => $user->email,
            "expireAt" => $expire_claim
        )
    );
} else {
    // If login fails
    //Response code
    http_response_code(401);

    // Unable to login user.
    echo json_encode(array("message" => "Login failed."));
}
