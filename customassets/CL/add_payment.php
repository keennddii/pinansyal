<?php
include 'cnncollection.php'; // 'cnncollection.php' = yung connection mo sa database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice_id = $_POST['invoice_id'];
    $amount_paid = $_POST['amount_paid'];
    $payment_method = $_POST['payment_method'];
    $payment_date = $_POST['payment_date'];
    $remarks = $_POST['remarks'];

    $sql = "INSERT INTO collection (invoice_id, amount_paid, payment_method, payment_date, remarks) 
            VALUES ('$invoice_id', '$amount_paid', '$payment_method', '$payment_date', '$remarks')";

    if ($conn->query($sql) === TRUE) {
        echo "Payment added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
