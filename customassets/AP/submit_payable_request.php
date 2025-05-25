<?php
session_start();
require_once 'cnnpayable.php'; 

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

    $stmt = $conn->prepare("INSERT INTO payable_requests 
        (payee, amount, due_date, department_id, account_id, remarks) 
        VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsiss", $payee, $amount, $due_date, $department_id, $account_id, $remarks);

    if ($stmt->execute()) {
        $_SESSION['message'] = ['type' => 'success', 'text' => 'Payable request submitted successfully!'];
    } else {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Failed to submit request.'];
    }

    $stmt->close();
    $conn->close();

    header('Location: ../../AccountPayable.php'); 
    exit();
} else {
    header('HTTP/1.1 403 Forbidden');
    echo "Forbidden.";
}
