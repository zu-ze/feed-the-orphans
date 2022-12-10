<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../models/event.php';
include_once '../config/database.php';

$db = new Database();
$db->connect();

$event = new Event($db);

$data = json_decode(file_get_contents("php://input"));

$event->orphanageId = $data->orphanageId;
$event->eventDate = $data->eventDate;
$event->title = $data->title;
$event->description = $data->description;

if($event->create())
    echo json_encode(
        array(
            'status' => true, 
            'message' => 'Event Created'
        )
    );
else
    echo json_encode(
        array(
            'status' => false, 
            'message' => 'Event Not Created'
        )
    );