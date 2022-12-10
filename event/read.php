<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../models/event.php';
include_once '../config/database.php';

$db = new Database();
$db->connect();

$event = new Event($db);

$stmt = $event->read();

if ($stmt->rowCount() > 0) {
    $result = array(
        'status' => true
    );
    $result['records'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $single = array(
            'id' => $id,
            'orphanageId' => $orphanageId,
            'eventDate' => $eventDate,
            'title' => $title,
            'description' => html_entity_decode($description), 
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
            'message' => 'No events found.'
        )
        );
}