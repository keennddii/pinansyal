<?php
require_once 'cnncollection.php';

// SQL query to retrieve data from your collection payments table
$sql = "SELECT * FROM payments ORDER BY payment_date ASC"; // assuming 'payments' is your table
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Output each row of data as a table row
        echo "<tr>
                <td>{$row['transaction_id']}</td>
                <td>{$row['client_name']}</td>
                <td>{$row['invoice_no']}</td>
                <td>{$row['amount']}</td>
                <td>{$row['payment_method']}</td>
                <td>{$row['payment_date']}</td>
                <td>{$row['status']}</td>
                <td>
                    <button class='btn btn-warning btn-sm' onclick='editPayment({$row['transaction_id']})'>Edit</button>
                    <button class='btn btn-danger btn-sm' onclick='deletePayment({$row['transaction_id']})'>Delete</button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No records found.</td></tr>";
}

$con->close();
?>
