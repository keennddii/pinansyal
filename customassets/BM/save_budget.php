<?php
include 'cnnbm.php'; // adjust mo path kung nasaan connection mo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $department_id = intval($_POST['department_id']);
    $year = intval($_POST['year']);
    $allocated_amount = floatval($_POST['budget']);

    $stmt = $conn->prepare("INSERT INTO budget_allocations (department_id, year, allocated_amount, used_amount, status) VALUES (?, ?, ?, 0.00, 'Active')");
    $stmt->bind_param("isd", $department_id, $year, $allocated_amount);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
