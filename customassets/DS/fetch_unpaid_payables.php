<?php
include_once 'cnndisburse.php';

$sql = "
  SELECT ap.id, ap.payee, ap.amount,
    ap.amount - IFNULL(SUM(d.amount_paid), 0) AS remaining_amount,
    ap.due_date
  FROM accounts_payable ap
  LEFT JOIN disbursement d ON ap.id = d.payable_id
  WHERE ap.status != 'Paid' AND ap.status != 'Voided'
  GROUP BY ap.id
";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

echo json_encode($data);
?>
