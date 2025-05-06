<?php
include 'cnndisburse.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $payable_id      = intval($_POST['payable_id']);
    $disburse_date   = $_POST['disbursement_date'];
    $amount          = floatval($_POST['disburse_amount']);
    $remarks         = trim($_POST['disburse_remarks']);
    $payment_method  = trim($_POST['payment_method']);
    $period          = $disburse_date; // use the disbursement date as period

    // Step 1: Get current payable info
    $stmt = $conn->prepare("
        SELECT amount, department_id 
          FROM accounts_payable 
         WHERE id = ?
    ");
    $stmt->bind_param("i", $payable_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$row = $result->fetch_assoc()) {
        echo "Invalid payable.";
        exit();
    }
    $total          = floatval($row['amount']);
    $department_id  = $row['department_id'];
    $stmt->close();

    // Step 2: Get total disbursed so far
    $q = $conn->prepare("
        SELECT COALESCE(SUM(amount_paid), 0) AS total_disbursed 
          FROM disbursement 
         WHERE payable_id = ?
    ");
    $q->bind_param("i", $payable_id);
    $q->execute();
    $total_disbursed = $q->get_result()->fetch_assoc()['total_disbursed'];
    $q->close();

    // Prevent overpayment
    if ($amount > ($total - $total_disbursed)) {
        echo "Disbursement amount exceeds remaining balance.";
        exit();
    }

    // Step 3: Insert disbursement
    $insert = $conn->prepare("
        INSERT INTO disbursement 
          (payable_id, disbursement_date, amount_paid, payment_method, remarks) 
        VALUES (?, ?, ?, ?, ?)
    ");
    $insert->bind_param("isdss", $payable_id, $disburse_date, $amount, $payment_method, $remarks);

    if ($insert->execute()) {
        // Step 4: Update AP status
        $new_total_disbursed = $total_disbursed + $amount;
        if ($new_total_disbursed >= $total) {
            $new_status = 'Paid';
        } elseif ($new_total_disbursed > 0) {
            $new_status = 'Partially Paid';
        } else {
            $new_status = 'Unpaid';
        }
        $upd = $conn->prepare("
            UPDATE accounts_payable 
               SET status = ? 
             WHERE id = ?
        ");
        $upd->bind_param("si", $new_status, $payable_id);
        $upd->execute();
        $upd->close();

        // Step 5: Journal Entries (Debit AP, Credit Cash)
        $acct_ap   = 4; // Accounts Payable
        $acct_cash = 1; // Cash

        // DR Accounts Payable
        $j1 = $conn->prepare("
            INSERT INTO journal_entries 
              (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) 
            VALUES (?, ?, ?, 0, 'DISBURSEMENT', ?, ?)
        ");
        $j1->bind_param("sidis", $disburse_date, $acct_ap, $amount, $payable_id, $remarks);
        $j1->execute();
        $j1->close();

        // CR Cash
        $j2 = $conn->prepare("
            INSERT INTO journal_entries 
              (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) 
            VALUES (?, ?, 0, ?, 'DISBURSEMENT', ?, ?)
        ");
        $j2->bind_param("sidis", $disburse_date, $acct_cash, $amount, $payable_id, $remarks);
        $j2->execute();
        $j2->close();

        // Step 6: Update Department Budget
        if ($department_id) {
            $budget_stmt = $conn->prepare("
                UPDATE budget_allocations 
                   SET used_amount = used_amount + ? 
                 WHERE department_id = ? 
                   AND year = YEAR(CURDATE())
            ");
            $budget_stmt->bind_param("di", $amount, $department_id);
            $budget_stmt->execute();
            $budget_stmt->close();
        }

        // Step 7: Update/Insert into General Ledger for both accounts
        $entries = [
            ['aid' => $acct_ap,   'deb' => $amount, 'cred' => 0],
            ['aid' => $acct_cash, 'deb' => 0,       'cred' => $amount],
        ];

        foreach ($entries as $e) {
            $aid  = $e['aid'];
            $deb  = $e['deb'];
            $cred = $e['cred'];

            // Check existing GL record
            $chk = $conn->prepare("
                SELECT id, debit, credit 
                  FROM general_ledger 
                 WHERE account_id = ? 
                   AND period = ?
            ");
            $chk->bind_param("is", $aid, $period);
            $chk->execute();
            $res = $chk->get_result();

            if ($res->num_rows) {
                $lg       = $res->fetch_assoc();
                $nid      = $lg['id'];
                $nd       = $lg['debit']  + $deb;
                $nc       = $lg['credit'] + $cred;
                $nb       = $nd - $nc;

                $up = $conn->prepare("
                    UPDATE general_ledger 
                       SET debit   = ?, 
                           credit  = ?, 
                           balance = ? 
                     WHERE id = ?
                ");
                $up->bind_param("dddi", $nd, $nc, $nb, $nid);
                $up->execute();
                $up->close();
            } else {
                $aname = ""; 
                $bal   = $deb - $cred;

                $ins2 = $conn->prepare("
                    INSERT INTO general_ledger 
                      (account_id, account_name, debit, credit, balance, period) 
                    VALUES (?, ?, ?, ?, ?, ?)
                ");
                $ins2->bind_param("isddds", $aid, $aname, $deb, $cred, $bal, $period);
                $ins2->execute();
                $ins2->close();
            }
            $chk->close();
        }

        echo "Disbursement recorded and General Ledger updated successfully.";
    } else {
        echo "Failed to save disbursement.";
    }

    $insert->close();
    $conn->close();
}
?>
