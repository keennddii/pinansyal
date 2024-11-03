<?php 
include("user.php");
// Database connection settings
$dbhost = "127.0.0.1";
$dbport = 3306;
$dbuser = "root";
$dbpass = "";
$dbname = "pinansyal_budget_management";

// Create a new mysqli object
$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
 // Query to fetch bank transactions
 $query = "SELECT id, payroll_id, transaction_id, amount, bank_account, status FROM bank_transactions";
 $result = mysqli_query($con, $query);