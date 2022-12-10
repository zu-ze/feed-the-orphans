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
$field = $data->type;
$notification->{$field} = $data->{$field} ?? '';

$stmt = $notification->read_where($field);

if ($stmt->rowCount() > 0) {
    http_response_code(200);

    $result = array(
        'status' => true
    );
    $result['records'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $single = array(
            'id' => $id,
            'userId' => $userId,
            'status' => $status,
            'message' => $message,
        );
        array_push($result['records'], $single);
    }

    echo json_encode($result);

} else {
    http_response_code(404);

    echo json_encode(
        array(
            'status' => false,
            'message' => 'Notifications not found.'
        )
        );
}