<?php
include 'cnncollection.php'; // Include your database connection file

$id = intval($_GET['id']);
$sql = "SELECT c.*, ar.client_name, ar.booking_date, ar.amount_due, ar.due_date, ar.status 
        FROM collection c
        JOIN accounts_receivable ar ON c.invoice_id = ar.id
        WHERE c.id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    echo "<div style='font-size: 14px;'>";
    echo "<div><strong>Invoice No:</strong> " . htmlspecialchars($row['invoice_id']) . "</div>";
    echo "<div><strong>Client Name:</strong> " . htmlspecialchars($row['client_name']) . "</div>";
    echo "<div><strong>Booking Date:</strong> " . htmlspecialchars($row['booking_date']) . "</div>";
    echo "<div><strong>Amount Due:</strong> ₱" . number_format($row['amount_due'], 2) . "</div>";
    echo "<div><strong>Due Date:</strong> " . htmlspecialchars($row['due_date']) . "</div>";
    echo "<div><strong>Status:</strong> " . htmlspecialchars($row['status']) . "</div>";
    echo "<hr>";
    echo "<div><strong>Amount Paid:</strong> ₱" . number_format($row['amount_paid'], 2) . "</div>";
    echo "<div><strong>Payment Method:</strong> " . htmlspecialchars($row['payment_method']) . "</div>";
    echo "<div><strong>Payment Date:</strong> " . htmlspecialchars($row['payment_date']) . "</div>";
    echo "<div><strong>Remarks:</strong> " . nl2br(htmlspecialchars($row['remarks'])) . "</div>";
    echo "</div>";
} else {
    echo "No details found.";
}
?>
