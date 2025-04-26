<?php
include 'cnnbm.php';

$sql = "SELECT 
            ba.id,
            d.name AS department_name,
            ba.year,
            ba.allocated_amount,
            ba.used_amount,
            (ba.allocated_amount - ba.used_amount) AS remaining_amount,
            ba.status
        FROM budget_allocations ba
        INNER JOIN departments d ON ba.department_id = d.id
        ORDER BY ba.year DESC, d.name ASC";

$result = $conn->query($sql);

$budgets = [];
while ($row = $result->fetch_assoc()) {
    $budgets[] = $row;
}

echo json_encode($budgets);

$conn->close();
?>
