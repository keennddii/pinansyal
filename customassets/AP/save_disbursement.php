<?php
include 'cnnpayable.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $payable_id = intval($_POST['payable_id']);
    $disburse_date = $_POST['disbursement_date'];
    $amount = floatval($_POST['disburse_amount']);
    $remarks = $_POST['disburse_remarks'];

    // Step 1: Get current payable info
    $stmt = $conn->prepare("SELECT amount, status FROM accounts_payable WHERE id = ?");
    $stmt->bind_param("i", $payable_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$row = $result->fetch_assoc()) {
        echo "Invalid payable.";
        exit();
    }

    $total = floatval($row['amount']);
    $new_status = 'Unpaid';

    // Step 2: Insert into disbursement table
    $insert = $conn->prepare("INSERT INTO disbursement (payable_id, disbursement_date, amount_paid, remarks) VALUES (?, ?, ?, ?)");
    $insert->bind_param("isds", $payable_id, $disburse_date, $amount, $remarks);    
    if ($insert->execute()) {
        // Step 3: Get total disbursed so far
        $q = $conn->prepare("SELECT COALESCE(SUM(amount_paid), 0) AS total_disbursed FROM disbursement WHERE payable_id = ?");
        $q->bind_param("i", $payable_id);
        $q->execute();
        $total_disbursed = $q->get_result()->fetch_assoc()['total_disbursed'];
        $q->close();

        // Step 4: Update status
        if ($total_disbursed >= $total) {
            $new_status = 'Paid';
        } elseif ($total_disbursed > 0) {
            $new_status = 'Partially Paid';
        }

        $upd = $conn->prepare("UPDATE accounts_payable SET status = ? WHERE id = ?");
        $upd->bind_param("si", $new_status, $payable_id);
        $upd->execute();
        $upd->close();

        
        $cash_acct = 1; 
        $ap_acct = 4;   

       
        $j1 = $conn->prepare("INSERT INTO journal_entries (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) VALUES (?, ?, ?, 0, 'DISBURSEMENT', ?, ?)");
        $j1->bind_param("sidis", $disburse_date, $ap_acct, $amount, $payable_id, $remarks);
        $j1->execute();
        $j1->close();

        
        $j2 = $conn->prepare("INSERT INTO journal_entries (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) VALUES (?, ?, 0, ?, 'DISBURSEMENT', ?, ?)");
        $j2->bind_param("sidis", $disburse_date, $cash_acct, $amount, $payable_id, $remarks);
        $j2->execute();
        $j2->close();

        echo "Disbursement recorded successfully.";
    } else {
        echo "Failed to save disbursement.";
    }

    $stmt->close();
    $insert->close();
    $conn->close();
}
?>
