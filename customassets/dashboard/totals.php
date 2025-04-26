<?php
// File: customassets/dashboard/totals.php
include 'cnndb.php';
header('Content-Type: application/json');

$sql = "
  SELECT
    COALESCE(SUM(b.allocated_amount),0) AS totalBudget,
    COALESCE(SUM(b.used_amount),0)      AS usedBudget,
    (SELECT COALESCE(SUM(ap.amount),0)
       FROM accounts_payable ap
      WHERE ap.status!='Paid')           AS unpaidAP,
    (SELECT COALESCE(SUM(d.amount_paid),0)
       FROM disbursement d)             AS totalDisbursements
  FROM budget_allocations b
";

$res = $conn->query($sql);
$row = $res->fetch_assoc();

echo json_encode([
  'totalBudget'        => (float)$row['totalBudget'],
  'usedBudget'         => (float)$row['usedBudget'],
  'unpaidAP'           => (float)$row['unpaidAP'],
  'totalDisbursements' => (float)$row['totalDisbursements'],
]);
$conn->close();