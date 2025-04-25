<?php
    include('cnncollection.php');  // Database connection

    // Join collection with accounts_receivable to get invoice_no
    $sql = "SELECT 
                c.*, 
                ar.invoice_no 
            FROM 
                collection c
            JOIN 
                accounts_receivable ar ON c.invoice_id = ar.id
            ORDER BY 
                c.payment_date DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['invoice_no']) . "</td>
                    <td>₱" . number_format($row['amount_paid'], 2) . "</td>
                    <td>" . htmlspecialchars($row['payment_method']) . "</td>
                    <td>" . htmlspecialchars($row['payment_date']) . "</td>
                    <td>
                        <button class='btn btn-outline-primary btn-sm' onclick='openDetailsModal(".$row['id'].")'>View Details</button>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No payments recorded</td></tr>";
    }
?>
