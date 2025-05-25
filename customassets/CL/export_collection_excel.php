<?php
include('cnncollection.php');

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=collection_export_" . date('Ymd_His') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>Invoice No.</th>
        <th>Amount Paid</th>
        <th>Payment Method</th>
        <th>Payment Date</th>
        <th>Remarks</th>
        <th>Created At</th>
      </tr>";

$sql = "SELECT c.id, ar.invoice_no, c.amount_paid, c.payment_method, c.payment_date, c.remarks, c.created_at 
        FROM collection c
        LEFT JOIN accounts_receivable ar ON c.invoice_id = ar.id
        ORDER BY c.created_at DESC";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['invoice_no']}</td>
                <td>₱" . number_format($row['amount_paid'], 2) . "</td>
                <td>{$row['payment_method']}</td>
                <td>{$row['payment_date']}</td>
                <td>{$row['remarks']}</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found.</td></tr>";
}

echo "</table>";
?>
