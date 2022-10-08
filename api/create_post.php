<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access- Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


// include_once '../apidb/Database.php';
// include_once '../api_models/CreatePost.php';
include_once($_SERVER['DOCUMENT_ROOT'] . "/apidb/Database.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/api_models/CreatePost.php");

$database = new Database();
$db = $database->connect();

$post = new CreatePost($db);

$data = json_decode(file_get_contents('php://input'));

$post->first_name = $data->first_name;
$post->last_name = $data->last_name;
$post->phone = $data->phone;
$post->email = $data->email;
$post->state_id = $data->state_id;
$post->lga_id = $data->lga_id;
$post->ward_id = $data->ward_id;
$post->pu_id = $data->pu_id;
$post->gender = $data->gender;
$post->pvc_status = $data->pvc_status;


echo ($post->create())
    ?  json_encode(array('message' => 'Data saved.'))
    :  json_encode(array('message' => 'Internal Error.'));
