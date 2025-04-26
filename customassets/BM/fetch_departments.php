<?php
include 'cnnbm.php';

$result = $conn->query("SELECT id, name FROM departments WHERE status = 'active'");

$departments = [];
while ($row = $result->fetch_assoc()) {
    $departments[] = $row;
}

echo json_encode($departments);

$conn->close();
?>
