<?php
include 'cnncollection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bill_type = $_POST['bill_type'];
    $amount = $_POST['amount'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];

    $sql = "INSERT INTO bills (bill_type, amount, due_date, status, remarks) VALUES ('$bill_type', '$amount', '$due_date', '$status', '$remarks')";
    
    if ($con->query($sql) === TRUE) {
        echo "Bill added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}
?>
