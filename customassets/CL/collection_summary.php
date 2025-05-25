<?php
include('cnncollection.php'); 

$totalPayments = 0;
$paidCount = 0;
$partialCount = 0;
$unpaidCount = 0;

// 1. TOTAL PAYMENTS (excluding voided remarks or NULL-safe)
$sqlTotal = "SELECT SUM(amount_paid) AS total_paid 
             FROM collection 
             WHERE amount_paid IS NOT NULL AND (remarks IS NULL OR LOWER(remarks) NOT LIKE '%void%')";
$resTotal = $conn->query($sqlTotal);

if ($resTotal) {
    $rowTotal = $resTotal->fetch_assoc();
    $totalPayments = $rowTotal['total_paid'] ?? 0;
} else {
    die("Query error (total payments): " . $conn->error);
}


// 2. COUNT PER STATUS (from accounts_receivable table)
$sqlStatus = "SELECT status, COUNT(*) AS count FROM accounts_receivable GROUP BY status";
$resStatus = $conn->query($sqlStatus);

if ($resStatus) {
    while ($row = $resStatus->fetch_assoc()) {
        switch (strtolower($row['status'])) {
            case 'fully paid':
                $paidCount = $row['count'];
                break;
            case 'partially paid':
                $partialCount = $row['count'];
                break;
            case 'unpaid':
                $unpaidCount = $row['count'];
                break;
        }
    }
} else {
    die("Query error (status count): " . $conn->error);
}

?>
