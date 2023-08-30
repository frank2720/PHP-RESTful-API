<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../configuration/database.php';
include_once '../models/user.php';

$database = new DB();
$db = $database->db_connect();

$select = new User($db);

$select->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

$select->select_single();

$post_arr = array(
    'user_id' => $select->user_id,
    'username' => $select->username,
    'first_name' => $select->first_name,
    'last_name' => $select->last_name,
    'gender' => $select->gender
);

echo json_encode($post_arr);