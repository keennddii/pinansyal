<?php
include('customassets/cnn/payroll.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch payroll data from the database
    $query = "SELECT * FROM payrolls WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo '<h3>Payroll ID: ' . $row['id'] . '</h3>';
        echo '<p>Employee Name: ' . $row['employee_name'] . '</p>';
        echo '<p>Pay Period: ' . $row['pay_period_start'] . ' to ' . $row['pay_period_end'] . '</p>';
        echo '<p>Gross Pay: ' . number_format($row['gross_pay'], 2) . '</p>';
        echo '<p>Net Pay: ' . number_format($row['net_pay'], 2) . '</p>';
        echo '<p>Total Deductions: ' . number_format($row['total_deductions'], 2) . '</p>';
        echo '<p>Status: ' . $row['status'] . '</p>';
    }
}



