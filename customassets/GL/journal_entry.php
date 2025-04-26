<?php
include 'cnnGL.php';

// Updated SQL query with JOIN to fetch account_name
$sql = "SELECT j.id, j.transaction_date, c.account_name, j.debit, j.credit
        FROM journal_entries j 
        JOIN chart_of_accounts c ON j.account_id = c.id";
$result = $conn->query($sql);

$journalEntries = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Format the transaction_date to "March 17, 2025"
        $formattedDate = date("F j, Y", strtotime($row['transaction_date']));
        $row['transaction_date'] = $formattedDate;

        // Add peso sign to debit and credit values
        $row['debit'] = '₱' . number_format($row['debit'], 2);
        $row['credit'] = '₱' . number_format($row['credit'], 2);
        
        $journalEntries[] = $row;
    }
}

// Return the data as JSON
echo json_encode($journalEntries);

$conn->close();
?>
