<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../models/donation.php';
include_once '../config/database.php';

$db = new Database();
$db->connect();

$donation = new Donation($db);

$data = json_decode(file_get_contents("php://input"));

$donation->transId = $data->transId ?? '';
$donation->transType = $data->transType ?? '';
$donation->receiverId = $data->orphanageId ?? '';
$donation->senderPhone = $data->senderPhone ?? '';
$donation->amount = $data->amount ?? '';

if($donation->receiveDonation())
    echo json_encode(
        array(
            'status' => true, 
            'message' => 'Donation Received'
        )
    );
else
    echo json_encode(
        array(
            'status' => false, 
            'message' => 'Donation Not Received'
        )
    );