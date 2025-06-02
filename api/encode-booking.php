<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config/database2.php'; 
session_start();

header('Content-Type: application/json');

$booking_id = $_POST['booking_id'] ?? null;
$booking_type = $_POST['booking_type'] ?? null;
$encoded_by = $_SESSION['username'] ?? null;

if (!$booking_id || !$booking_type) {
  echo json_encode(['status' => 'error', 'message' => 'Missing booking data.']);
  exit;
}

// Check if already encoded
$stmt = $pdo->prepare("SELECT * FROM encoded_bookings WHERE booking_id = ? AND booking_type = ?");
$stmt->execute([$booking_id, $booking_type]);
if ($stmt->rowCount() > 0) {
  echo json_encode(['status' => 'exists', 'message' => 'Already encoded.']);
  exit;
}

// Insert into encoded_bookings
$stmt = $pdo->prepare("INSERT INTO encoded_bookings (booking_id, booking_type, encoded_by) VALUES (?, ?, ?)");
$success = $stmt->execute([$booking_id, $booking_type, $encoded_by]);

if ($success) {
  echo json_encode(['status' => 'success', 'message' => 'Booking encoded.']);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Failed to encode.']);
}
?>
