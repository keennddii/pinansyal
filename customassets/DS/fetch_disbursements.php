<?php
include 'cnndisburse.php';

$sql = "SELECT d.id, d.payable_id, d.disbursement_date, d.payment_method, d.amount_paid, d.remarks
        FROM disbursement d
        ORDER BY d.disbursement_date DESC";

$result = $conn->query($sql);

$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

header('Content-Type: application/json');
echo json_encode($rows);
?>
