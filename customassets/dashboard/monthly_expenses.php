<?php
// File: customassets/dashboard/totals.php
include 'cnndb.php';
header('Content-Type: application/json');

$out = [];
$sql = "
  SELECT DATE_FORMAT(disbursement_date,'%b') AS month,
         ROUND(SUM(amount_paid),2)         AS expense
    FROM disbursement
   GROUP BY DATE_FORMAT(disbursement_date,'%Y-%m')
   ORDER BY MIN(disbursement_date)
";
$res = $conn->query($sql);
while ($r = $res->fetch_assoc()) {
    $out[] = [
        'month'   => $r['month'],  
        'expense' => (float)$r['expense']
    ];
}
echo json_encode($out);
$conn->close();
