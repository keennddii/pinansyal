<?php
include 'cnncollection.php'; 

$id = intval($_GET['id']);

// Fetch collection record + related AR + total paid (excluding this record)
$sql = "SELECT 
            c.*, 
            ar.client_name, 
            ar.booking_date, 
            ar.amount_due,     -- this is remaining balance!
            ar.due_date, 
            ar.status,
            ar.invoice_no,
            (SELECT COALESCE(SUM(amount_paid), 0) FROM collection 
             WHERE invoice_id = ar.id) AS total_paid
        FROM collection c
        JOIN accounts_receivable ar ON c.invoice_id = ar.id
        WHERE c.id = $id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $original_total = $row['amount_due'] + $row['total_paid'];
    $remaining_balance = $row['amount_due'];

    echo "<div style='font-size: 14px;'>";
    echo "<div><strong>Invoice No:</strong> " . htmlspecialchars($row['invoice_no']) . "</div>";
    echo "<div><strong>Client Name:</strong> " . htmlspecialchars($row['client_name']) . "</div>";
    echo "<div><strong>Booking Date:</strong> " . htmlspecialchars($row['booking_date']) . "</div>";
    echo "<div><strong>Original Total:</strong> ₱" . number_format($original_total, 2) . "</div>";
    echo "<div><strong>Total Paid:</strong> ₱" . number_format($row['total_paid'], 2) . "</div>";
    echo "<div><strong>Remaining Balance:</strong> ₱" . number_format($remaining_balance, 2) . "</div>";
    echo "<div><strong>Status:</strong> " . htmlspecialchars($row['status']) . "</div>";
    echo "<hr>";
    echo "<div><strong>Amount Paid (this record):</strong> ₱" . number_format($row['amount_paid'], 2) . "</div>";
    echo "<div><strong>Payment Method:</strong> " . htmlspecialchars($row['payment_method']) . "</div>";
    echo "<div><strong>Payment Date:</strong> " . htmlspecialchars($row['payment_date']) . "</div>";
    echo "<div><strong>Remarks:</strong> " . nl2br(htmlspecialchars($row['remarks'])) . "</div>";
    echo "</div>";
} else {
    echo "No details found.";
}
?>
