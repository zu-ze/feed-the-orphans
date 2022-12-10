<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../models/contact.php';
include_once '../config/database.php';

$db = new Database();
$db->connect();

$contact = new Contact($db);

$data = json_decode(file_get_contents("php://input"));

$contact->orphanageId = $data->orphanageId;
$contact->name = $data->name;
$contact->number = $data->number;
$contact->type = $data->type;

if($contact->create())
    echo json_encode(
        array(
            'status' => true, 
            'message' => 'Contact Created'
        )
    );
else
    echo json_encode(
        array(
            'status' => false, 
            'message' => 'Contact Not Created'
        )
    );