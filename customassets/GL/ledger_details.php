<?php
include 'cnnGL.php';
header('Content-Type: application/json');

$account_id = isset($_GET['account_id']) ? (int) $_GET['account_id'] : 0;

$sql = "
    SELECT 
        je.transaction_date,
        je.debit,
        je.credit,
        je.remarks,
        je.module_type,
        je.reference_id
    FROM journal_entries AS je
    WHERE je.account_id = $account_id
    ORDER BY je.transaction_date ASC
";

$res = $conn->query($sql);
$out = [];

while ($row = $res->fetch_assoc()) {
    $out[] = [
        'transaction_date' => $row['transaction_date'],
        'debit'            => (float) $row['debit'],
        'credit'           => (float) $row['credit'],
        'remarks'          => $row['remarks'],
        'module_type'      => $row['module_type'],
        'reference_id'     => $row['reference_id']
    ];
}

echo json_encode($out);
$conn->close();
