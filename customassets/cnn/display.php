<?php 
include("user.php");
// SQL query to count the total employees
$query = "SELECT COUNT(*) as total_employees FROM tbl_pinansyal_acc";
$result = mysqli_query($con, $query);

// Fetch the result
$row = mysqli_fetch_assoc($result);
$total_employees = $row['total_employees'];

// Close the database connection
mysqli_close($con);