<?php
include 'cnnAR.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $today = date('Y-m-d');

    // ✅ VOID REQUEST
    if (isset($_POST['void']) && $_POST['void'] == 1) {
        $sql = "SELECT invoice_no, amount_due FROM accounts_receivable WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $invoice_no = $row['invoice_no'];
            $amount = floatval($row['amount_due']);
            $remarks = "VOIDED Invoice: $invoice_no";

            $update = $conn->prepare("UPDATE accounts_receivable SET status = 'Voided', amount_due = 0 WHERE id = ?");
            $update->bind_param("i", $id);

            if ($update->execute()) {
                // Use chart_of_accounts IDs
                $acct_service = 3; // Service Revenue
                $acct_ar = 2;      // Accounts Receivable

                $j1 = $conn->prepare("INSERT INTO journal_entries 
                    (transaction_date, account_id, debit, credit, module_type, reference_id, remarks)
                    VALUES (?, ?, ?, 0, 'AR', ?, ?)");
                $j1->bind_param("sidis", $today, $acct_service, $amount, $id, $remarks);
                $j1->execute();
                $j1->close();

                $j2 = $conn->prepare("INSERT INTO journal_entries 
                    (transaction_date, account_id, debit, credit, module_type, reference_id, remarks)
                    VALUES (?, ?, 0, ?, 'AR', ?, ?)");
                $j2->bind_param("sidis", $today, $acct_ar, $amount, $id, $remarks);
                $j2->execute();
                $j2->close();

                echo "Invoice voided and journal reversed successfully!";
            } else {
                echo "Failed to update invoice as void.";
            }

            $update->close();
        } else {
            echo "Invoice not found for void.";
        }

        $stmt->close();
        exit();
    }



    // ✅ NORMAL PAYMENT
    if (isset($_POST['payment_method'], $_POST['payment_date'], $_POST['amount_paid'])) {
        $payment_method = $_POST['payment_method'];
        $payment_date = $_POST['payment_date'];
        $amount_paid = floatval($_POST['amount_paid']);

        $sql_select = "SELECT amount_due, invoice_no FROM accounts_receivable WHERE id = ?";
        $stmt_select = $conn->prepare($sql_select);
        $stmt_select->bind_param("i", $id);
        $stmt_select->execute();
        $result = $stmt_select->get_result();

        if ($row = $result->fetch_assoc()) {
            $current_due = floatval($row['amount_due']);
            $invoice_no = $row['invoice_no'];
            $remaining_balance = $current_due - $amount_paid;

            if ($remaining_balance <= 0) {
                $sql_update = "UPDATE accounts_receivable SET status = 'Fully Paid', amount_due = 0 WHERE id = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("i", $id);
            } else {
                $sql_update = "UPDATE accounts_receivable SET status = 'Partially Paid', amount_due = ? WHERE id = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("di", $remaining_balance, $id);
            }

            if ($stmt_update->execute()) {
                $stmt_update->close();

                // Step 1: Record collection
                $sql_insert = "INSERT INTO collection (invoice_id, payment_method, payment_date, amount_paid) 
                               VALUES (?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("issd", $id, $payment_method, $payment_date, $amount_paid);

                if ($stmt_insert->execute()) {
                    $collection_id = $conn->insert_id;
                    $remarks = "Payment for Invoice: $invoice_no";

                    // Use chart_of_accounts IDs
                    $acct_cash = 1; // Cash
                    $acct_ar = 2;   // Accounts Receivable

                    // DR Cash
                    $j1 = $conn->prepare("INSERT INTO journal_entries 
                        (transaction_date, account_id, debit, credit, module_type, reference_id, remarks)
                        VALUES (?, ?, ?, 0, 'COLLECTION', ?, ?)");
                    $j1->bind_param("sidis", $today, $acct_cash, $amount_paid, $collection_id, $remarks);
                    $j1->execute();
                    $j1->close();

                    // CR AR
                    $j2 = $conn->prepare("INSERT INTO journal_entries 
                        (transaction_date, account_id, debit, credit, module_type, reference_id, remarks)
                        VALUES (?, ?, 0, ?, 'COLLECTION', ?, ?)");
                    $j2->bind_param("sidis", $today, $acct_ar, $amount_paid, $collection_id, $remarks);
                    $j2->execute();
                    $j2->close();

                    echo "Payment and journal entries successfully recorded!";
                } else {
                    echo "Error recording payment.";
                }

                $stmt_insert->close();
            } else {
                echo "Error updating invoice.";
            }
        } else {
            echo "Invoice not found.";
        }

        $stmt_select->close();
    }


}
?>
