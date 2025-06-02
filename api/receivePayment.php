<?php
// Hosting-friendly version
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set headers for proper API response
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Debug info - remove this after testing
$debug_info = [
    'REQUEST_METHOD' => $_SERVER['REQUEST_METHOD'],
    'CONTENT_TYPE' => $_SERVER['CONTENT_TYPE'] ?? 'Not set',
    'HTTP_ORIGIN' => $_SERVER['HTTP_ORIGIN'] ?? 'Not set',
    'SERVER_NAME' => $_SERVER['SERVER_NAME'],
    'PHP_VERSION' => phpversion()
];

// Only allow POST method for this endpoint
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Method not allowed. Only POST requests are accepted.",
        "allowed_methods" => ["POST"],
        "debug" => $debug_info
    ]);
    exit();
}

// Multiple ways to get input data (for hosting compatibility)
$raw = '';
$data = null;

// Method 1: php://input (preferred)
if (function_exists('file_get_contents')) {
    $raw = @file_get_contents("php://input");
}

// Method 2: Alternative for restrictive hosts
if (empty($raw) && isset($GLOBALS['HTTP_RAW_POST_DATA'])) {
    $raw = $GLOBALS['HTTP_RAW_POST_DATA'];
}

// Method 3: Check $_POST for form data
if (empty($raw) && !empty($_POST)) {
    $data = $_POST;
}

// Try to decode JSON if we have raw data
if (!empty($raw) && empty($data)) {
    $data = json_decode($raw, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid JSON format: " . json_last_error_msg(),
            "received_data" => substr($raw, 0, 200) . (strlen($raw) > 200 ? '...' : ''),
            "debug" => $debug_info
        ]);
        exit();
    }
}

// Check if we received any data at all
if (empty($data)) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "No data received. Please send JSON data in request body.",
        "received_raw" => substr($raw, 0, 100),
        "debug" => $debug_info,
        "example" => [
            "amount" => 1000.50,
            "date" => "2025-05-30",
            "reference_number" => "REF123456",
            "customer_name" => "Juan Dela Cruz",
            "payment_method" => "Cash"
        ]
    ]);
    exit();
}

// Include your DB connection
try {
    include_once '../config/database.php';
    $conn = (new Database())->getConnection();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed: " . $e->getMessage(),
        "debug" => $debug_info
    ]);
    exit();
}

// Function to auto-generate Payment ID
function generatePaymentID($conn) {
    $prefix = "PAY-";
    $date = date("Ymd");
    
    try {
        $query = "SELECT COUNT(*) as count FROM core_payments WHERE DATE(date) = CURDATE()";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $row['count'] + 1;
        return $prefix . $date . "-" . str_pad($count, 3, "0", STR_PAD_LEFT);
    } catch (Exception $e) {
        // Fallback to timestamp if query fails
        return $prefix . $date . "-" . time();
    }
}

// Function to validate required fields
function validateInput($data) {
    $requiredFields = [
        'amount' => 'number',
        'date' => 'date',
        'reference_number' => 'string',
        'customer_name' => 'string',
        'payment_method' => 'string'
    ];
    
    $errors = [];
    
    foreach ($requiredFields as $field => $type) {
        if (!isset($data[$field]) || (is_string($data[$field]) && empty(trim($data[$field])))) {
            $errors[] = "$field is required";
            continue;
        }
        
        // Type validation
        switch ($type) {
            case 'number':
                if (!is_numeric($data[$field]) || $data[$field] <= 0) {
                    $errors[] = "$field must be a positive number";
                }
                break;
            case 'date':
                if (!strtotime($data[$field])) {
                    $errors[] = "$field must be a valid date (YYYY-MM-DD format)";
                }
                break;
            case 'string':
                if (is_string($data[$field]) && strlen(trim($data[$field])) < 1) {
                    $errors[] = "$field cannot be empty";
                }
                break;
        }
    }
    
    return $errors;
}

// Validate input data
$validationErrors = validateInput($data);
if (!empty($validationErrors)) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Validation failed",
        "errors" => $validationErrors,
        "received_data" => $data,
        "required_fields" => [
            "amount" => "Positive number (e.g., 1000.50)",
            "date" => "Date in YYYY-MM-DD format",
            "reference_number" => "String (e.g., REF123456)",
            "customer_name" => "String (e.g., Juan Dela Cruz)",
            "payment_method" => "String (e.g., Cash, Credit Card, Bank Transfer)"
        ]
    ]);
    exit();
}

// Process the payment
try {
    // Start transaction
    $conn->beginTransaction();
    
    // Generate payment ID
    $payment_id = generatePaymentID($conn);
    
    // Check if reference number already exists
    $checkQuery = "SELECT COUNT(*) as count FROM core_payments WHERE reference_number = :reference_number";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(':reference_number', $data['reference_number']);
    $checkStmt->execute();
    $refExists = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
    if ($refExists['count'] > 0) {
        $conn->rollBack();
        http_response_code(409);
        echo json_encode([
            "status" => "error",
            "message" => "Reference number already exists",
            "reference_number" => $data['reference_number']
        ]);
        exit();
    }
    
    // Insert payment record
    $query = "INSERT INTO core_payments 
              (payment_id, amount, date, reference_number, customer_name, payment_method, created_at)
              VALUES (:payment_id, :amount, :date, :reference_number, :customer_name, :payment_method, NOW())";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':payment_id', $payment_id);
    $stmt->bindParam(':amount', $data['amount'], PDO::PARAM_STR);
    $stmt->bindParam(':date', $data['date']);
    $stmt->bindParam(':reference_number', $data['reference_number']);
    $stmt->bindParam(':customer_name', $data['customer_name']);
    $stmt->bindParam(':payment_method', $data['payment_method']);
    
    $stmt->execute();
    
    // Commit transaction
    $conn->commit();
    
    // Success response
    http_response_code(201);
    echo json_encode([
        "status" => "success",
        "message" => "Payment successfully recorded",
        "data" => [
            "payment_id" => $payment_id,
            "amount" => floatval($data['amount']),
            "date" => $data['date'],
            "reference_number" => $data['reference_number'],
            "customer_name" => $data['customer_name'],
            "payment_method" => $data['payment_method'],
            "created_at" => date('Y-m-d H:i:s')
        ]
    ]);
    
} catch (PDOException $e) {
    // Rollback transaction on error
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Database error occurred",
        "error_code" => $e->getCode(),
        "debug" => $debug_info
    ]);
    
} catch (Exception $e) {
    // Rollback transaction on error
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Server error occurred: " . $e->getMessage(),
        "debug" => $debug_info
    ]);
}
?>