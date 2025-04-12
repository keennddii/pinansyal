<?php
require_once 'cnncollection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $id = $con->real_escape_string($_POST['id']);
    $client_name = $con->real_escape_string($_POST['client_name']);
    $amount = $con->real_escape_string($_POST['amount']);
    $payment_method = $con->real_escape_string($_POST['payment_method']);
    $payment_date = $con->real_escape_string($_POST['payment_date']);
    $status = $con->real_escape_string($_POST['status']);
    $remarks = $con->real_escape_string($_POST['remarks']);

    // Prepare the SQL query to update the record (DO NOT modify the invoice_no)
    $sql = "UPDATE payments 
            SET client_name = '$client_name', amount = '$amount', payment_method = '$payment_method', 
                payment_date = '$payment_date', status = '$status', remarks = '$remarks'
            WHERE id = '$id'"; // Using the 'id' for identification

    if ($con->query($sql) === TRUE) {
        echo "Record updated successfully!";
    } else {
        echo "Error: " . $con->error;
    }

    $con->close();
}
?>
