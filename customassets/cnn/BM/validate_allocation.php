<?php
$conn = new mysqli("localhost", "root", "", "pinansyal_budget_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$allocation_id = $_POST['allocation_id'];
$action = $_POST['action'];

if ($action == 'approve') {
    $approved_amount = $_POST['approved_amount'];
    $remarks = $_POST['remarks'];

    $sql = "UPDATE budget_allocations SET approved_amount='$approved_amount', status='Allocated', remarks='$remarks', date_of_response=NOW() WHERE allocation_id='$allocation_id'";
} else if ($action == 'reject') {
    $remarks = $_POST['remarks'];

    $sql = "UPDATE budget_allocations SET status='Rejected', remarks='$remarks', date_of_response=NOW() WHERE allocation_id='$allocation_id'";
}

if ($conn->query($sql) === TRUE) {
    echo "Allocation updated successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
