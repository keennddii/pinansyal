<?php
$servername = "localhost"; // or your database server address
$username = "root";        // your database username
$password = "";            // your database password
$dbname = "financial_system"; // the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
