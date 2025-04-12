<?php
require_once 'cnncollection.php';

// SQL query to retrieve data from your collection payments table
$sql = "SELECT * FROM payments ORDER BY payment_date ASC"; // assuming 'payments' is your table
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Output each row of data as a table row
        echo "<tr>
                <td>{$row['invoice_no']}</td> <!-- Display invoice_no once -->
                <td>{$row['client_name']}</td>
                <td>₱" . number_format($row['amount'], 2) . "</td>
                <td>{$row['payment_method']}</td>
                <td>{$row['payment_date']}</td>
                <td>{$row['status']}</td>
                <td>{$row['remarks']}</td>
                <td>
                    <button class='btn btn-warning btn-sm' onclick='openEditModal(\"{$row['invoice_no']}\")'>Edit</button> <!-- Use 'invoice_no' here -->
                    <button class='btn btn-danger btn-sm' onclick='confirmDelete(\"{$row['invoice_no']}\")'>Delete</button> <!-- Use 'invoice_no' here -->
                    <button class='btn btn-success btn-sm' onclick='markPayment(\"{$row['invoice_no']}\")'>Mark</button> <!-- Use 'invoice_no' here -->
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No records found.</td></tr>";
}

$con->close();
?>
