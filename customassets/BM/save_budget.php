<?php
include 'cnnbm.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $department_id = intval($_POST['department_id']);
    $year = intval($_POST['year']);
    $additional_budget = floatval($_POST['budget']);

    // Check if record exists
    $check = $conn->prepare("SELECT allocated_amount FROM budget_allocations WHERE department_id = ? AND year = ?");
    $check->bind_param("ii", $department_id, $year);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        // Update
        $update = $conn->prepare("UPDATE budget_allocations SET allocated_amount = allocated_amount + ? WHERE department_id = ? AND year = ?");
        $update->bind_param("dii", $additional_budget, $department_id, $year);
        if ($update->execute()) {
            echo "Budget updated successfully.";
        } else {
            echo "Error updating budget: " . $update->error;
        }
        $update->close();
    } else {
        // Insert
        $insert = $conn->prepare("INSERT INTO budget_allocations (department_id, year, allocated_amount, used_amount, status) VALUES (?, ?, ?, 0.00, 'Active')");
        $insert->bind_param("isd", $department_id, $year, $additional_budget);
        if ($insert->execute()) {
            echo "New budget added.";
        } else {
            echo "Error inserting budget: " . $insert->error;
        }
        $insert->close();
    }

    $check->close();
    $conn->close();
}
?>
