<?php
include 'cnndb.php';
header('Content-Type: application/json');

$out = [];
$sql = "
  SELECT d.name AS department,
         COALESCE(b.used_amount,0)      AS used,
         COALESCE(b.allocated_amount,0) AS allocated
    FROM budget_allocations b
    JOIN departments d ON b.department_id = d.id
   WHERE b.status = 'Active'
";
$res = $conn->query($sql);
while ($r = $res->fetch_assoc()) {
    $out[] = [
        'department' => $r['department'],  
        'used'       => (float)$r['used'],
        'allocated'  => (float)$r['allocated']
    ];
}
echo json_encode($out);
$conn->close();
