<?php
include 'cnnGL.php';
header('Content-Type: application/json');

$sql = "
  SELECT 
    gl.account_id,
    c.account_name,
    SUM(gl.debit)   AS total_debit,
    SUM(gl.credit)  AS total_credit,
    SUM(gl.debit) - SUM(gl.credit) AS balance
  FROM general_ledger AS gl
  JOIN chart_of_accounts AS c
    ON gl.account_id = c.id
  GROUP BY gl.account_id, c.account_name
  ORDER BY gl.account_id
";

$res = $conn->query($sql);
$out = [];

while ($row = $res->fetch_assoc()) {
    $out[] = [
      'account_id'   => (int)   $row['account_id'],
      'account_name' =>         $row['account_name'],
      'total_debit'  => (float) $row['total_debit'],
      'total_credit' => (float) $row['total_credit'],
      'balance'      => (float) $row['balance'],
    ];
}

echo json_encode($out);
$conn->close();

