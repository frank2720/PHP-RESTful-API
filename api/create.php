<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Acess-Control-Allow-Methods: POSTS');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../configuration/database.php';
include_once '../models/user.php';

$database = new DB();
$db = $database->db_connect();

$select = new User($db);

$data=json_decode(file_get_contents("php://input"));

$select->username=$data->username;
$select->first_name=$data->first_name;
$select->last_name=$data->last_name;
$select->gender=$data->gender;

if($select->insert()){
    echo json_encode(array('messade'=>'Details added succesfully'));
}else{
    echo json_encode(array('message'=>'Failed to add details'));
}