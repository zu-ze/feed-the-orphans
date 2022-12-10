<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../models/notification.php';
include_once '../config/database.php';

$db = new Database();
$db->connect();

$notification = new Notification($db);

$data = json_decode(file_get_contents("php://input"));

$notification->userId = $data->userId;
$notification->status = $data->status;
$notification->message = $data->message;

if($notification->create())
    echo json_encode(
        array(
            'status' => true, 
        )
    );
else
    echo json_encode(
        array(
            'status' => false, 
        )
    );