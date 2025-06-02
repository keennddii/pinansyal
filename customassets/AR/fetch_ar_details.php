<?php
include 'cnnAR.php'; // Include your database connection file

$id = intval($_GET['id']);
$sql = "SELECT * FROM accounts_receivable WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<strong>Invoice No:</strong> " . htmlspecialchars($row['invoice_no']) . "<br>";
    echo "<strong>Client Name:</strong> " . htmlspecialchars($row['client_name']) . "<br>";
    echo "<strong>Booking Date:</strong> " . htmlspecialchars($row['booking_date']) . "<br>";
    echo "<strong>Amount Due:</strong> ₱" . number_format($row['amount_due'], 2) . "<br>";
    echo "<strong>Status:</strong> " . htmlspecialchars($row['status']) . "<br>";
    echo "<strong>Remarks:</strong> " . nl2br(htmlspecialchars($row['remarks'])) . "<br>";
} else {
    echo "No details found.";
}
?>
