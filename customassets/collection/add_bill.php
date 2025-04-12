<?php
include 'cnncollection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $client_name = $con->real_escape_string($_POST['client_name']);
    $amount_paid = $con->real_escape_string($_POST['amount_paid']);
    $payment_method = $con->real_escape_string($_POST['payment_method']);
    $payment_date = $con->real_escape_string($_POST['payment_date']);
    $remarks = $con->real_escape_string($_POST['remarks']);

    // Set the default status to "Unpaid" or based on your application logic
    $status = 'Unpaid';  // Change this logic based on your requirements

    // Get the last invoice number and generate the next one
    $result = $con->query("SELECT MAX(CAST(SUBSTRING(invoice_no, 4) AS UNSIGNED)) AS last_id FROM payments");
    $row = $result->fetch_assoc();
    $last_id = $row['last_id'] + 1;  // Increment the last ID
    $invoice_no = "INV" . str_pad($last_id, 4, "0", STR_PAD_LEFT);  // Format as INV0001, INV0002, etc.

    // Prepare SQL query to insert payment information into the database
    $sql = "INSERT INTO payments (invoice_no, client_name, amount, payment_method, payment_date, status, remarks) 
            VALUES ('$invoice_no', '$client_name', '$amount_paid', '$payment_method', '$payment_date', '$status', '$remarks')";

    // Execute the query
    if ($con->query($sql) === TRUE) {
        header("Location: /pinansyal/Collection.php?success=1");
        exit();  
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    
    // Close the database connection
    $con->close();
}
?>
