<?php
session_start();
require_once 'db.php'; 

$requested_by = $_SESSION['username']; // make sure this session variable is set

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payee = trim($_POST['payee']);
    $amount = floatval($_POST['amount']);
    $due_date = $_POST['due_date'];
    $department_id = intval($_POST['department_id']);
    $account_id = intval($_POST['account_id']);
    $remarks = trim($_POST['remarks']);

    // Validate required fields
    if (!$payee || !$amount || !$due_date || !$department_id || !$account_id) {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Please fill in all required fields.'];
        header('Location: dashboard.php'); 
        exit();
    }

    // ✅ Updated INSERT query with requested_by
    $stmt = $conn->prepare("INSERT INTO payable_requests 
        (payee, amount, due_date, department_id, account_id, requested_by, remarks) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsisss", $payee, $amount, $due_date, $department_id, $account_id, $requested_by, $remarks);

    if ($stmt->execute()) {
        $_SESSION['message'] = ['type' => 'success', 'text' => 'Payable request submitted successfully!'];
    } else {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Failed to submit request.'];
    }

    $stmt->close();
    $conn->close();

    header('Location: ../fund_request_employee.php'); 
    exit();
} else {
    header('HTTP/1.1 403 Forbidden');
    echo "Forbidden.";
}
