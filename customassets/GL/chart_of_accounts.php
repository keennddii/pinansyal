<?php
include 'cnnGL.php'; // Adjust the path to your database connection file
header('Content-Type: application/json');

$sql = "
  SELECT 
    account_code,
    account_name,
    account_type,
    description
  FROM chart_of_accounts
  ORDER BY account_code
";
$res = $conn->query($sql);

$out = [];
while ($row = $res->fetch_assoc()) {
    $out[] = $row;
}

echo json_encode($out);
$conn->close();
