<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// include database and object files
include_once '../config/database.php';
include_once '../models/orphanage.php';

// get database connection
$database = new Database();

// prepare product object
$orphanage = new Orphanage($database->Connect());

// set ID property of record to read
$orphanage->adminId = isset($_GET['adminId']) ? $_GET['adminId'] : die();

// read the details of orphanage to be edited
$orphanage->read_single();

if($orphanage->name!=null){
    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode(array(
        'status' => true,
        'orphanage' => array(
            'id' => $orphanage->id,
            'name' => $orphanage->name,
            'district' => $orphanage->district,
            'area' => $orphanage->area,
            'latitude' => $orphanage->latitude,
            'longitude' => $orphanage->longitude,
            'mission' => html_entity_decode($orphanage->mission),
            'vision' => html_entity_decode($orphanage->vision)
        ) 
    ));
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    echo json_encode(array(
        'status' => false
    ));
}
?>