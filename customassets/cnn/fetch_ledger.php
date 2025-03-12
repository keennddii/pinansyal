<?php
include 'cnnGeneralLedger.php';

// Query para makuha ang general ledger transactions
$sql = "SELECT gen_id, date, description, journal_reference, debit, credit, balance FROM general_ledger ORDER BY date DESC";
$result = $con->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $row['debit'] = number_format($row['debit'], 2);
    $row['credit'] = number_format($row['credit'], 2);
    $row['balance'] = number_format($row['balance'], 2);
    
    $row['actions'] = '<button class="btn btn-warning btn-sm">Edit</button> 
                       <button class="btn btn-danger btn-sm">Delete</button>';
    
    $data[] = $row;
}

echo json_encode(['data' => $data]); // Convert to JSON format

$con->close();
?>
