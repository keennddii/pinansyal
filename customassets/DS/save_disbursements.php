<?php
include 'cnndisburse.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $payable_id = intval($_POST['payable_id']);
    $disburse_date = $_POST['disbursement_date'];
    $amount = floatval($_POST['disburse_amount']);
    $remarks = trim($_POST['disburse_remarks']);
    $payment_method = trim($_POST['payment_method']);

    // Step 1: Get current payable info
    $stmt = $conn->prepare("SELECT amount FROM accounts_payable WHERE id = ?");
    $stmt->bind_param("i", $payable_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$row = $result->fetch_assoc()) {
        echo "Invalid payable.";
        exit();
    }

    $total = floatval($row['amount']);

    // Step 2: Get total disbursed so far (before this transaction)
    $q = $conn->prepare("SELECT COALESCE(SUM(amount_paid), 0) AS total_disbursed FROM disbursement WHERE payable_id = ?");
    $q->bind_param("i", $payable_id);
    $q->execute();
    $total_disbursed = $q->get_result()->fetch_assoc()['total_disbursed'];
    $q->close();

    $remaining = $total - $total_disbursed;

    // Prevent overpayment
    if ($amount > $remaining) {
        echo "Disbursement amount exceeds remaining balance.";
        exit();
    }

    // Step 3: Insert disbursement
    $insert = $conn->prepare("INSERT INTO disbursement (payable_id, disbursement_date, amount_paid, payment_method, remarks) VALUES (?, ?, ?, ?, ?)");
    $insert->bind_param("isdss", $payable_id, $disburse_date, $amount, $payment_method, $remarks);

    if ($insert->execute()) {
        // Step 4: Compute new total disbursed (after this one)
        $new_total_disbursed = $total_disbursed + $amount;

        // Step 5: Update AP Status
        if ($new_total_disbursed >= $total) {
            $new_status = 'Paid';
        } elseif ($new_total_disbursed > 0) {
            $new_status = 'Partially Paid';
        } else {
            $new_status = 'Unpaid';
        }

        $upd = $conn->prepare("UPDATE accounts_payable SET status = ? WHERE id = ?");
        $upd->bind_param("si", $new_status, $payable_id);
        $upd->execute();
        $upd->close();

        // Journal Entries
        $cash_acct = 1; // Cash
        $ap_acct = 4;   // Accounts Payable

        // DEBIT: Accounts Payable
        $j1 = $conn->prepare("INSERT INTO journal_entries (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) VALUES (?, ?, ?, 0, 'DISBURSEMENT', ?, ?)");
        $j1->bind_param("sidis", $disburse_date, $ap_acct, $amount, $payable_id, $remarks);
        $j1->execute();
        $j1->close();

        // CREDIT: Cash
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
