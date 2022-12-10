<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once '../models/orphanage.php';
include_once '../config/database.php';

$db = new Database();
$db->connect();

$orphanage = new Orphanage($db);

$orphanage->searchStr = isset($_GET['query']) ? $_GET['query'] : die();

$stmt = $orphanage->search();

if ($stmt->rowCount() > 0) {
    $result = array(
        'status' => true
    );
    $result['records'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $single = array(
            'id' => $id,
            'adminId' => $adminId,
            'name' => $name,
            'district' => $district,
            'area' => $area, 
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
            'message' => 'No Orphanages found.'
        )
        );
}