<?php
include 'cnncollection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $client_name = $con->real_escape_string($_POST['client_name']);
    $invoice_number = $con->real_escape_string($_POST['invoice_number']);
    $amount_paid = $con->real_escape_string($_POST['amount_paid']);
    $payment_method = $con->real_escape_string($_POST['payment_method']);
    $payment_date = $con->real_escape_string($_POST['payment_date']);
    $remarks = $con->real_escape_string($_POST['remarks']);

    // Set the default status to "Unpaid" or based on your application logic
    $status = 'Unpaid';  // Change this logic based on your requirements

    // Prepare SQL query to insert payment information into the database
    $sql = "INSERT INTO payments (client_name, invoice_no, amount, payment_method, payment_date, status, remarks) 
            VALUES ('$client_name', '$invoice_number', '$amount_paid', '$payment_method', '$payment_date', '$status', '$remarks')";

    // Execute the query
    if ($con->query($sql) === TRUE) {
        echo "Payment collected successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    // Close the database connection
    $con->close();
}
?>
