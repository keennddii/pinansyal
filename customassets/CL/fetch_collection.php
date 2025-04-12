<?php
    include('cnncollection.php');  // Database connection

    $sql = "SELECT * FROM collection ORDER BY payment_date DESC";  // Get all payments
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output each row from the collection table
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['invoice_id'] . "</td>
                    <td>₱" . number_format($row['amount_paid'], 2) . "</td>
                    <td>" . $row['payment_method'] . "</td>
                    <td>" . $row['payment_date'] . "</td>
                    <td>
                    <button class='btn btn-primary btn-sm' onclick='openDetailsModal(".$row['id'].")'>View Details</button>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No payments recorded</td></tr>";
    }
?>
