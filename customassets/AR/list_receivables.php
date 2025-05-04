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

        $status = htmlspecialchars($row['status']);
        $badgeClass = 'secondary';

        switch ($status) {
            case 'Unpaid':
                $badgeClass = 'warning';
                break;
            case 'Partial Paid':
                $badgeClass = 'info';
                break;
            case 'Fully Paid':
                $badgeClass = 'success';
                break;
            case 'Voided':
                $badgeClass = 'danger';
                break;
        }

        echo "<td><span class='badge bg-$badgeClass'>$status</span></td>";

        echo "<td>";
        
        if ($status !== 'Voided' && $status !== 'Fully Paid') {
            echo "<button class='btn btn-outline-success btn-sm' onclick='openPayModal(".$row['id'].")'>Pay</button> ";
        }

        echo "<button class='btn btn-outline-primary btn-sm' onclick='openDetailsModal(".$row['id'].")'>View Details</button> ";

        if ($status !== 'Voided' && $status !== 'Fully Paid') {
            echo "<button class='btn btn-outline-danger btn-sm' onclick='voidInvoice(" . $row['id'] . ")'>Void</button>";
        }

        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No data available</td></tr>";
}
?>
