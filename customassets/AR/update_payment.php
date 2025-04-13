<?php
include 'cnnAR.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Check if this is a void request
    if (isset($_POST['void']) && $_POST['void'] == 1) {
        // Get invoice_no and amount_due for reversing journal
        $sql = "SELECT invoice_no, amount_due FROM accounts_receivable WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $invoice_no = $row['invoice_no'];
            $amount = floatval($row['amount_due']);
            $date = date('Y-m-d');
            $remarks = "VOIDED Invoice: $invoice_no";

            // Step 1: Update AR to voided
            $update = $conn->prepare("UPDATE accounts_receivable SET status = 'Voided', amount_due = 0 WHERE id = ?");
            $update->bind_param("i", $id);

            if ($update->execute()) {
                // Step 2: Reverse journal entry
                $reverse = $conn->prepare("INSERT INTO journal_entries (date, account, debit, credit, remarks)
                                           VALUES 
                                           (?, 'Service Revenue', ?, 0, ?),
                                           (?, 'Accounts Receivable', 0, ?, ?)");
                $reverse->bind_param("sdssds", 
                    $date, $amount, $remarks,
                    $date, $amount, $remarks
                );

                if ($reverse->execute()) {
                    echo "Invoice voided and journal reversed successfully!";
                } else {
                    echo "Invoice voided but journal reversal failed: " . $reverse->error;
                }

                $reverse->close();
            } else {
                echo "Failed to update invoice as void.";
            }

            $update->close();
        } else {
            echo "Invoice not found for void.";
        }

        $stmt->close();
        exit(); // Stop further execution
    }

    // 👉 Normal payment flow starts here (same as before)
    if (isset($_POST['payment_method']) && isset($_POST['payment_date']) && isset($_POST['amount_paid'])) {
        $payment_method = $_POST['payment_method'];
        $payment_date = $_POST['payment_date'];
        $amount_paid = floatval($_POST['amount_paid']);

        $sql_select = "SELECT amount_due, invoice_no FROM accounts_receivable WHERE id = ?";
        $stmt_select = $conn->prepare($sql_select);
        $stmt_select->bind_param("i", $id);
        $stmt_select->execute();
        $result = $stmt_select->get_result();

        if ($row = $result->fetch_assoc()) {
            $current_amount_due = floatval($row['amount_due']);
            $invoice_no = $row['invoice_no'];
            $remaining_balance = $current_amount_due - $amount_paid;

            if ($remaining_balance <= 0) {
                $sql_update = "UPDATE accounts_receivable SET status = 'Fully Paid', amount_due = 0 WHERE id = ?";
            } else {
                $sql_update = "UPDATE accounts_receivable SET status = 'Partially Paid', amount_due = ? WHERE id = ?";
            }

            $stmt_update = $conn->prepare($sql_update);

            if ($remaining_balance <= 0) {
                $stmt_update->bind_param("i", $id);
            } else {
                $stmt_update->bind_param("di", $remaining_balance, $id);
            }

            if ($stmt_update->execute()) {
                $sql_insert = "INSERT INTO collection (invoice_id, payment_method, payment_date, amount_paid) 
                               VALUES (?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("issd", $id, $payment_method, $payment_date, $amount_paid);

                if ($stmt_insert->execute()) {
                    $journal_sql = "INSERT INTO journal_entries (date, account, debit, credit, remarks)
                                    VALUES 
                                    (?, 'Cash', ?, 0, ?),
                                    (?, 'Accounts Receivable', 0, ?, ?)";
                    $stmt_journal = $conn->prepare($journal_sql);

                    $remarks = "Payment for Invoice: " . $invoice_no;
                    $date = date('Y-m-d');

                    $stmt_journal->bind_param(
                        "sdssds",
                        $date, $amount_paid, $remarks,
                        $date, $amount_paid, $remarks
                    );

                    if ($stmt_journal->execute()) {
                        echo "Payment and journal entries successfully recorded!";
                    } else {
                        echo "Payment saved but journal failed: " . $stmt_journal->error;
                    }

                    $stmt_journal->close();
                } else {
                    echo "Error recording payment.";
                }
                $stmt_insert->close();
            } else {
                echo "Error updating invoice.";
            }

            $stmt_update->close();
        } else {
            echo "Invoice not found.";
        }

        $stmt_select->close();
    }
}
?>
