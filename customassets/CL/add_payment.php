<?php
include('cnncollection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice_id = $_POST['invoice_id'];
    $amount_paid = $_POST['amount_paid'];
    $payment_method = $_POST['payment_method'];
    $payment_date = $_POST['payment_date'];
    $remarks = $_POST['remarks'];

    // Insert payment into collection table
    $sql = "INSERT INTO collection (invoice_id, amount_paid, payment_method, payment_date, remarks)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idsss", $invoice_id, $amount_paid, $payment_method, $payment_date, $remarks);

    if ($stmt->execute()) {
        // ✅ Get invoice number for journal entry
        $invoice_lookup = $conn->prepare("SELECT invoice_no FROM accounts_receivable WHERE id = ?");
        $invoice_lookup->bind_param("i", $invoice_id);
        $invoice_lookup->execute();
        $invoice_result = $invoice_lookup->get_result();
        $invoice_data = $invoice_result->fetch_assoc();
        $invoice_no = $invoice_data['invoice_no'];

        // ✅ Insert into journal_entries
        $journal_sql = "INSERT INTO journal_entries (date, account, debit, credit, remarks)
                        VALUES 
                        (CURDATE(), 'Cash', ?, 0, 'Payment for Invoice: $invoice_no'),
                        (CURDATE(), 'Accounts Receivable', 0, ?, 'Payment for Invoice: $invoice_no')";

        $journal_stmt = $conn->prepare($journal_sql);
        $journal_stmt->bind_param("dd", $amount_paid, $amount_paid);
        $journal_stmt->execute();

        // ✅ Update AR status (optional, but smart to include)
        $check_total_sql = "SELECT SUM(amount_paid) as total_paid FROM collection WHERE invoice_id = $invoice_id";
        $total_result = $conn->query($check_total_sql);
        $total_row = $total_result->fetch_assoc();
        $total_paid = $total_row['total_paid'];

        $ar_result = $conn->query("SELECT amount_due FROM accounts_receivable WHERE id = $invoice_id");
        $ar_row = $ar_result->fetch_assoc();
        $amount_due = $ar_row['amount_due'];

        if ($total_paid >= $amount_due) {
            $conn->query("UPDATE accounts_receivable SET status = 'Fully Paid' WHERE id = $invoice_id");
        } else {
            $conn->query("UPDATE accounts_receivable SET status = 'Partially Paid' WHERE id = $invoice_id");
        }

        header("Location: /pinansyal/Collection.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
