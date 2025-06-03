<?php
include 'cnndisburse.php';

$sql = "SELECT 
            d.id, 
            d.payable_id, 
            d.disbursement_date, 
            d.payment_method, 
            d.amount_paid, 
            d.remarks,
            ap.payee,
            dept.name AS department_name
        FROM disbursement d
        LEFT JOIN accounts_payable ap ON d.payable_id = ap.id
        LEFT JOIN departments dept ON ap.department_id = dept.id
        ORDER BY d.disbursement_date DESC";


$result = $conn->query($sql);

$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

header('Content-Type: application/json');
echo json_encode($rows);
?>
