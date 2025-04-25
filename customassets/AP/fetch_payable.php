<?php
include 'cnnpayable.php';

$id = intval($_GET['id']);

$q = $conn->prepare("
  SELECT 
    ap.amount,
    (SELECT COALESCE(SUM(amount_paid), 0) FROM disbursement WHERE payable_id = ap.id) AS total_paid
  FROM accounts_payable ap
  WHERE ap.id = ?
");
$q->bind_param("i", $id);
$q->execute();
$res = $q->get_result()->fetch_assoc();

$res['remaining'] = $res['amount'] - $res['total_paid'];
echo json_encode($res);
