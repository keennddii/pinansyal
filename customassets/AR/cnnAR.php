<?php
// 1. Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'financial_system'; // <-- palitan mo sa database mo
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>