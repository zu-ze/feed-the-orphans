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

$user->role = $data->role;
$user->status = $data->status ?? $user->status; 
$user->userName = $data->userName;
$user->email = $data->email;
$user->phone = $data->phone ?? $user->phone;
$user->password = $data->password;

if($user->create())
    echo json_encode(
        array(
            'status' => true, 
            'message' => 'User Created'
        )
    );
else
    echo json_encode(
        array(
            'status' => false, 
            'message' => 'User Not Created'
        )
    );