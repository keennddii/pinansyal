<?php
include 'cnnAR.php'; 

$sql = "SELECT * FROM accounts_receivable ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['invoice_no']) . "</td>";
        echo "<td>" . htmlspecialchars($row['client_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['booking_date']) . "</td>";
        echo "<td>₱" . number_format($row['amount_due'], 2) . "</td>";
        echo "<td>" . htmlspecialchars($row['due_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>";

        // ✅ PAY button (disabled if Voided)
        if ($row['status'] !== 'Voided') {
            echo "<button class='btn btn-outline-success btn-sm' onclick='openPayModal(".$row['id'].")'>Pay</button> ";
        }

        // ✅ VIEW button
        echo "<button class='btn btn-outline-primary btn-sm' onclick='openDetailsModal(".$row['id'].")'>View Details</button> ";

        // ✅ VOID button (only if not already voided)
        if ($row['status'] !== 'Voided') {
            echo "<button class='btn btn-outline-danger btn-sm' onclick='voidInvoice(" . $row['id'] . ")'>Void</button>";
        }
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No data available</td></tr>";
}
?>
