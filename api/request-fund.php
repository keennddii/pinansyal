<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once '../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
$required_fields = ['department', 'payee', 'amount', 'purpose', 'request_type', 'requested_by', 'request_date'];
foreach ($required_fields as $field) {
    if (empty($data[$field])) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Missing required field: $field"
        ]);
        exit;
    }
}

// Sanitize values
$department    = htmlspecialchars($data['department']);
$payee         = htmlspecialchars($data['payee']);
$amount        = floatval($data['amount']);
$purpose       = htmlspecialchars($data['purpose']);
$request_type  = htmlspecialchars($data['request_type']);
$reference_id  = isset($data['reference_id']) ? htmlspecialchars($data['reference_id']) : null;
$requested_by  = htmlspecialchars($data['requested_by']);
$request_date  = htmlspecialchars($data['request_date']);
$status        = 'pending';
$source        = 'API';

$sql = "INSERT INTO request_table 
        (department, payee, amount, purpose, request_type, reference_id, requested_by, request_date, status, source) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $conn->error
    ]);
    exit;
}

$reference_id_final = $reference_id ?? "";

$stmt->bind_param(
    "ssdsssssss",
    $department,
    $payee,
    $amount,
    $purpose,
    $request_type,
    $reference_id_final,
    $requested_by,
    $request_date,
    $status,
    $source
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Fund request submitted successfully."
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Failed to submit fund request."
    ]);
}

$stmt->close();
$conn->close();
