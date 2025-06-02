<?php
// Debugging lines (optional, remove sa production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// DB connection
$conn = new mysqli("localhost", "root", "", "financial_system");
if ($conn->connect_error) {
  echo json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]);
  exit;
}

// Fetch from core1
$url = "https://core1.easetravelandtours.com/external/vehicle-bookings";
$response = @file_get_contents($url);

if ($response === false) {
  echo json_encode(["status" => "error", "message" => "Failed to connect to core1 API"]);
  exit;
}

$data = json_decode($response, true);
if (!$data || !isset($data['data'])) {
  echo json_encode(["status" => "error", "message" => "Invalid response from core1"]);
  exit;
}

// Check each booking if encoded
foreach ($data['data'] as &$booking) {
  $bookingId = $booking['id'];
  $bookingType = 'tour';

  $stmt = $conn->prepare("SELECT id FROM encoded_bookings WHERE booking_id = ? AND booking_type = ?");
  $stmt->bind_param("is", $bookingId, $bookingType);
  $stmt->execute();
  $result = $stmt->get_result();

  $booking['encoded'] = $result->num_rows > 0;
  $stmt->close();
}

$conn->close();

// Final return
echo json_encode(["status" => "success", "data" => $data['data']]);
