<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once '../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'])) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Missing request ID."
    ]);
    exit;
}

$id = intval($data['id']);

// Only update if current status is approved and not yet disbursed
$sql = "UPDATE request_table 
        SET disbursement_status = 'disbursed' 
        WHERE id = ? AND status = 'approved' AND disbursement_status = 'not_disbursed'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode([
            "status" => "success",
            "message" => "Disbursement marked as completed."
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid status. Make sure the request is approved and not already disbursed."
        ]);
    }
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Failed to update disbursement status."
    ]);
}

$stmt->close();
$conn->close();
