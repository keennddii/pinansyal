<?php
session_start();
include('connections.php');
// Check if the connection was successful
if (!$con) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}
// Check if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // User is logged in
} else {
    // Handle case where session variable is not set
    echo "Error: No user logged in.";
    exit;
}

// Retrieve username from database
$query = $con->prepare("SELECT * FROM tbl_pinansyal_acc WHERE username = ?");
$query->bind_param('s', $username); 
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

