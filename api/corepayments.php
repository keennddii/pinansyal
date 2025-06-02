<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';

$conn = (new Database())->getConnection();

// Get the POST data
$data = json_decode(file_get_contents("php://input"), true);

// Required fields
$requiredFields = ['payment_id', 'amount', 'date', 'reference_number', 'customer_name', 'payment_method'];
$missingFields = [];

foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        $missingFields[] = $field;
    }
}

if (!empty($missingFields)) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Missing required fields: " . implode(', ', $missingFields)
    ]);
    exit;
}

// Prepare data
$payment_id = htmlspecialchars(strip_tags($data['payment_id']));
$amount = floatval($data['amount']);
$date = htmlspecialchars(strip_tags($data['date']));
$reference_number = htmlspecialchars(strip_tags($data['reference_number']));
$customer_name = htmlspecialchars(strip_tags($data['customer_name']));
$payment_method = htmlspecialchars(strip_tags($data['payment_method']));

try {
    $query = "INSERT INTO core_payments (payment_id, amount, date, reference_number, customer_name, payment_method)
              VALUES (:payment_id, :amount, :date, :reference_number, :customer_name, :payment_method)";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':payment_id', $payment_id);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':reference_number', $reference_number);
    $stmt->bindParam(':customer_name', $customer_name);
    $stmt->bindParam(':payment_method', $payment_method);

    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode([
            "success" => true,
            "message" => "Payment received and saved successfully."
        ]);
    } else {
        throw new Exception("Failed to save payment.");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Server error: " . $e->getMessage()
    ]);
}
