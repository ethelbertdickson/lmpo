<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//include_once '../apidb/Database.php';
//include_once '../models/PollingUnit.php';
include_once ($_SERVER['DOCUMENT_ROOT'] . "/apidb/Database.php");
include_once ($_SERVER['DOCUMENT_ROOT'] . "/api_models/PollingUnit.php");

//instantiate and connect to DB
$database = new Database();
$db = $database->connect();

//Instantiaate Post
$post = new PollingUnit($db);
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
            'pu_id' => $pu_id,
            'pu_name' => $pu_name,
            'status' => $status,

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
