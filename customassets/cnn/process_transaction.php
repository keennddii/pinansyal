<?php
// Database connection details
$dbhost = "127.0.0.1";
$dbport = 3306;
$dbuser = "root";
$dbpass = "";
$dbname = "pinansyal_budget_management";

// Connect to the database
$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Validate form inputs
if (isset($_POST['employee_id'], $_POST['amount'], $_POST['method'], $_POST['account'])) {
    $employee_id = $_POST['employee_id'];
    $amount = $_POST['amount'];
    $method = $_POST['method'];
    $account = $_POST['account'];
} else {
    die("Error: Invalid form submission.");
}


// Prepare SQL query
$query = "INSERT INTO cash_transactions (employee_id, amount, method, account_number) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param("sdss", $employee_id, $amount, $method, $account);

// Execute query
if ($stmt->execute()) {
    echo "<script>alert('Transaction added successfully!'); window.location.href='FinancialIntegration.php';</script>";
} else {
    echo "<script>alert('Error: Could not add transaction.'); window.history.back();</script>";
}

// Close connection
$stmt->close();
$con->close();

