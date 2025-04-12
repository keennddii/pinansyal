<?php
include 'cnnAR.php'; 

$sql = "SELECT * FROM accounts_receivable ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['client_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['booking_date']) . "</td>";
        echo "<td>₱" . number_format($row['amount_due'], 2) . "</td>";
        echo "<td>" . htmlspecialchars($row['due_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>
            <button class='btn btn-success btn-sm' onclick='openPayModal(".$row['id'].")'>Pay</button>
            <button class='btn btn-primary btn-sm' onclick='openDetailsModal(".$row['id'].")'>View Details</button>
        </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No data available</td></tr>";
}
?>

