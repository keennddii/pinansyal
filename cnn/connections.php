<?php 
include('connection.php');
session_start();


// Check if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // User is logged in
} else {
    // Handle case where session variable is not set
    echo "Error: No user logged in.";
    exit;
}

// Retrieve username from database
$query = $con->prepare("SELECT * FROM tbl_finance_login1 WHERE username = ?");
$query->bind_param('s', $username); // 's' stands for string
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = htmlspecialchars($row["username"], ENT_QUOTES, 'UTF-8');
    $position = htmlspecialchars($row["position"], ENT_QUOTES, 'UTF-8');
} else {
    $username = "Unknown";
    $position = "Unknown"; 
}

