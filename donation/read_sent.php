<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once '../models/donation.php';
include_once '../config/database.php';

$db = new Database();
$db->connect();

$donation = new Donation($db);

$donation->receiverId = isset($_GET['id']) ? $_GET['id'] : die();

$stmt = $donation->readSentDonation();

if ($stmt->rowCount() > 0) {
    $result = array(
        'status' => true
    );
    $result['records'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $single = array(
            'id' => $id,
            'transId' => $sentTransId,
            'senderId' => $userId,
            'transType' => $typeOfTransaction,
            'amount' => $amount,
            'createdAt' => $createdAt, 
        );
        array_push($result['records'], $single);
    }

    http_response_code(200);

    echo json_encode($result);
} else {
    http_response_code(404);

    echo json_encode(
        array(
            'status' => false,
            'message' => 'No records found.'
        )
        );
}