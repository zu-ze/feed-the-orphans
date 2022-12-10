<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../models/orphanage.php';
include_once '../config/database.php';

$db = new Database();
$db->connect();

$orphanage = new Orphanage($db);

$data = json_decode(file_get_contents("php://input"));

$field = $data->type;
$orphanage->id = $data->orphanageId;

$orphanage->{$field} = $data->{$field};

if($orphanage->edit($field))
    echo json_encode(
        array(
            'status' => true, 
            'message' => 'Edited Successfully'
        )
    );
else
    echo json_encode(
        array(
            'status' => false, 
            'message' => 'Failed to Edit'
        )
    );