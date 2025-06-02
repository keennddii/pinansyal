<?php
require '../config/database2.php'; 
header('Content-Type: application/json');

$payment_id = $_POST['payment_id'] ?? null;

if (!$payment_id) {
  echo json_encode(['status' => 'error', 'message' => 'Missing payment ID']);
  exit;
}

// Check if already marked
$stmt = $pdo->prepare("SELECT status FROM core_payments WHERE id = ?");
$stmt->execute([$payment_id]);
$current = $stmt->fetch();

if ($current && $current['status'] === 'Done') {
  echo json_encode(['status' => 'exists', 'message' => 'Already marked as done.']);
  exit;
}

// Update status to Done
$stmt = $pdo->prepare("UPDATE core_payments SET status = 'Done' WHERE id = ?");
if ($stmt->execute([$payment_id])) {
  echo json_encode(['status' => 'success']);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Failed to update status']);
}
?>
