<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../apidb/Database.php';
include_once '../models/Post.php';

//instantiate and connect to DB
$database = new Database();
$db = $database->connect();

//Instantiaate Post
$post = new Post($db);
//Blog post query
$result = $post->read();

//row count
$num = $result->rowCount();

//check post
if ($num > 0) {
    $posts_arr = array();
    $posts_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone,
            'email' => $email
        );

        //Push to Data
        array_push($posts_arr['data'], $post_item);
    }
    //Convert to json
    echo json_encode($posts_arr);
} else {
    // NO post
    echo json_encode(array('message' => 'No Post'));
}
