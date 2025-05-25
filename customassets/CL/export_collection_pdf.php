<?php
include('cnncollection.php');

$sql = "SELECT c.id, ar.invoice_no, c.amount_paid, c.payment_method, c.payment_date, c.remarks, c.created_at 
        FROM collection c
        LEFT JOIN accounts_receivable ar ON c.invoice_id = ar.id
        ORDER BY c.created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Collection Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; font-size: 14px; }
        th { background-color: #f2f2f2; }
        @media print {
            body * { visibility: hidden; }
            #print-area, #print-area * { visibility: visible; }
            #print-area { position: absolute; left: 0; top: 0; }
        }
    </style>
</head>
<body onload="window.print()">
    <div id="print-area">
        <h2>Collection Report</h2>
        <table>
            <thead>
                <tr>
                    <th>Invoice No.</th>
                    <th>Amount Paid</th>
                    <th>Payment Method</th>
                    <th>Payment Date</th>
                    <th>Remarks</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['invoice_no'] ?></td>
                            <td>₱<?= number_format($row['amount_paid'], 2) ?></td>
                            <td><?= $row['payment_method'] ?></td>
                            <td><?= $row['payment_date'] ?></td>
                            <td><?= $row['remarks'] ?></td>
                            <td><?= $row['created_at'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">No records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
