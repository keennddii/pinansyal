<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // palitan kung may password ka
$dbname = 'financial_system';

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
