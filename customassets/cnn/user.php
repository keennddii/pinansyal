<?php
session_start();
include('connections.php');

if (!$con) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; 
} else {
    
    echo "Error: No user logged in.";
    exit;
}


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

