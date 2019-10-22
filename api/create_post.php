<?php

// files needed to connect to database
include_once '../config/Database.php';

// headers needed
header("Access-Control-Allow-Origin: http://localhost:8888/php-blog/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../models/Post.php';

//database connection
$database = new Database();
$db = $database->getConnection();

//instantiate user object
$post = new Post($db);


// get posted data
$data = json_decode(file_get_contents("php://input"));


// Set property values.
$post->title = $data->title;
$post->content = $data->content;
$post->author = $data->author;
$post->category_id = $data->category_id;

// var_dump($post->title, $post->content, $post->category_id);
// die();

if ($post->create()) {

    // response code
    http_response_code(200);

    echo json_encode(array(
        "message" =>  "Post created successfully"
    ));
} else {
    // response code
    http_response_code(400);

    //message: unable to create post
    echo json_encode(array("message" => "Unable to create post."));
}
