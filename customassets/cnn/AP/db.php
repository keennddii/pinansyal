<?php
// db.php
$servername = "localhost";
$username   = "root";  // your DB username
$password   = "";  // your DB password
$database   = "pinansyal_acc_payable_recievable";   // your database name

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
