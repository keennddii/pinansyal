<?php
// File: customassets/dashboard/get_disbursements.php
include 'cnndb.php';

// Query to get disbursements history (adjust query as needed)
$sql = "
  SELECT disbursement_date, amount_paid 
  FROM disbursement
  ORDER BY disbursement_date ASC
";
$res = $conn->query($sql);

// Prepare arrays for historical data
$dataX = []; // Months or Date Index
$dataY = []; // Disbursements Amount

while ($row = $res->fetch_assoc()) {
    // Get the month index (e.g., 1 for January, 2 for February, etc.)
    $monthIndex = date('n', strtotime($row['disbursement_date']));
    $dataX[] = $monthIndex;
    $dataY[] = (float)$row['amount_paid'];
}

$conn->close();

// Output data as JSON (for use in the frontend)
echo json_encode([
  'dataX' => $dataX,
  'dataY' => $dataY
]);
