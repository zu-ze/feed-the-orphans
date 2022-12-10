<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../models/user.php';
include_once '../config/database.php';

$db = new Database();
$db->connect();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));
// if(!empty($_POST))
$user->email = $data->email;
$user->password = $data->password;

if($user->login()) {
    echo json_encode(
        array(
            'status' => true, 
            'message' => 'User logged In Successfully',
            'user' => array(
                'id' => $user->id,
                'role' => $user->role,
                'status' => $user->status,
                'userName' => $user->userName,
                'email' => $user->email,
                'phone' => $user->phone
            ),
        )
    );
} else {
    echo json_encode(
        array(
            'status' => false,
            'message' => 'Failed To Log In User'
        )
    );
}