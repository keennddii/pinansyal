<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once '../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

// Validation
if (!isset($data['id']) || !isset($data['status'])) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Missing request id or status."
    ]);
    exit;
}

$id = intval($data['id']);
$status = $data['status'];

if (!in_array($status, ['approved', 'rejected'])) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Invalid status value."
    ]);
    exit;
}

// Determine disbursement status based on approval
$disbursement_status = $status === 'approved' ? 'not_disbursed' : 'not_applicable';

// Update both status and disbursement_status
$sql = "UPDATE request_table SET status = ?, disbursement_status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $status, $disbursement_status, $id);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Request status updated successfully."
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Failed to update status."
    ]);
}

$stmt->close();
$conn->close();
