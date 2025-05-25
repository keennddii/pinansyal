<?php
include 'cnnpayable.php'; 
if (isset($_GET['id'])) {
    $request_id = $_GET['id'];

    $sql = "UPDATE payable_requests SET status = 'Rejected' WHERE id = $request_id";
    mysqli_query($conn, $sql);

    header("Location: ../../BudgetManagement.php");
}
?>
