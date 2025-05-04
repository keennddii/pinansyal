<?php
include 'cnnGL.php';


$sql = "SELECT j.id, j.transaction_date, c.account_name, j.debit, j.credit, j.module_type, j.reference_id, j.remarks, j.created_at
        FROM journal_entries j 
        JOIN chart_of_accounts c ON j.account_id = c.id
        ORDER BY j.transaction_date DESC, j.id DESC";
$result = $conn->query($sql);

$journalEntries = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
        $formattedDate = date("F j, Y", strtotime($row['transaction_date']));
        $row['transaction_date'] = $formattedDate;

        
        $row['debit'] = '₱' . number_format($row['debit'], 2);
        $row['credit'] = '₱' . number_format($row['credit'], 2);
        
        $journalEntries[] = $row;
    }
}


echo json_encode($journalEntries);

$conn->close();
?>
