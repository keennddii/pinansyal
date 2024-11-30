<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pinansyal_disbursement";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch payrolls data
$sql_payrolls = "SELECT * FROM payrolls";
$result_payrolls = $con->query($sql_payrolls);

