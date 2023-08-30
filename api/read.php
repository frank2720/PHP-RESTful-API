<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../configuration/database.php';
include_once '../models/user.php';

//Initiate DB class
$database = new DB();
$db = $database->db_connect();

//Iniate User class
$post = new User($db);
$result=$post->select_all();


$num_rows=$result->rowCount();

if($num_rows>0){
  
  $select_arr = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)) {

    $select_item = array(
      'user_id' => $row['user_id'],
      'username' => $row['username'],
      'first_name' => $row['first_name'],
      'last_name' => $row['last_name'],
      'gender' => $row['gender']
    );

    // push $select_item to "$select_arr"
    array_push($select_arr, $select_item);
  }

  // Convert $select_arr to JSON & echo it.
  echo json_encode($select_arr);

}else{
  //message to echo if $select_arr is empty.
  echo json_encode(
    array('message' => 'No user found')
  );
}