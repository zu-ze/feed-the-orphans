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
$field = $data->type ?? 'name';
$orphanage->{$field} = $data->{$field} ?? '';

if ($orphanage->read_where($field)) {
    http_response_code(200);

    echo json_encode(array(
        'status' => true,
        'record' => array(
            'id' => $orphanage->id,
            'name' => $orphanage->name,
            'district' => $orphanage->district,
            'area' => $orphanage->area,
            'vision' => html_entity_decode($orphanage->vision),
            'mission' => html_entity_decode($orphanage->mission),
            'latitude' => $orphanage->latitude,
            'longitude' => $orphanage->longitude
        )
    ));
} else {
    http_response_code(404);

    echo json_encode(
        array(
            'status' => false,
            'message' => 'Not found.'
        )
        );
}