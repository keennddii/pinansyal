<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $employee_name = $_POST['employee_name'];
    $pay_period_start = $_POST['pay_period_start'];
    $pay_period_end = $_POST['pay_period_end'];
    $gross_pay = $_POST['gross_pay'];
    $net_pay = $_POST['net_pay'];
    $total_deductions = $_POST['total_deductions'];

    // Validate and update payroll record
    // Example query (make sure you prepare and sanitize your queries to avoid SQL injection)
    $query = "UPDATE payroll SET employee_name = ?, pay_period_start = ?, pay_period_end = ?, gross_pay = ?, net_pay = ?, total_deductions = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssddi', $employee_name, $pay_period_start, $pay_period_end, $gross_pay, $net_pay, $total_deductions, $id);
    $stmt->execute();

    // Redirect with success message
    header('Location: Payrollmanagement.php?update=success');
    exit();
}

