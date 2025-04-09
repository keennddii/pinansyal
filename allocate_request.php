<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "pinansyal_budget_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve POST data
$request_id = $_POST['request_id'];
$approved_amount = $_POST['approved_amount'];
$date_of_response = $_POST['date_of_response'];
$remarks = $_POST['remarks'];
$date_submitted = date('Y-m-d'); // Use current date as date_submitted

// Retrieve requested_amount from the related request (assuming it exists in 'requests' table)
$sql_get = "SELECT amount FROM requests WHERE request_id = ?";
$stmt_get = $conn->prepare($sql_get);
$stmt_get->bind_param("s", $request_id);
$stmt_get->execute();
$result_get = $stmt_get->get_result();
if ($result_get->num_rows > 0) {
    $row_get = $result_get->fetch_assoc();
    $requested_amount = $row_get['amount'];
} else {
    // If no matching request found, you might want to handle the error
    die("Invalid Request ID");
}
$stmt_get->close();

// Insert new allocation record
$sql = "INSERT INTO budget_allocations (request_id, date_submitted, date_of_response, requested_amount, approved_amount, status, remarks)
        VALUES (?, ?, ?, ?, ?, 'Accepted', ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdds", $request_id, $date_submitted, $date_of_response, $requested_amount, $approved_amount, $remarks);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // Redirect back to the page or send a success response
    header("Location: BudgetManagement.php?msg=allocation_success");
} else {
    echo "Error allocating budget: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
