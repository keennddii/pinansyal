<?php
include 'cnnAR.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $today = date('Y-m-d');

    // ✅ VOID LOGIC
    if (isset($_POST['void']) && $_POST['void'] == 1 && isset($_POST['id'])) {
        $id = intval($_POST['id']);

        $check = $conn->prepare("SELECT id FROM journal_entries 
            WHERE module_type = 'AR' AND reference_id = ? AND remarks LIKE ?");
        $like = "%VOIDED%";
        $check->bind_param("is", $id, $like);
        $check->execute();
        $check_result = $check->get_result();

        if ($check_result && $check_result->num_rows === 0) {
            $fetch = $conn->prepare("SELECT invoice_no, amount_due FROM accounts_receivable WHERE id = ?");
            $fetch->bind_param("i", $id);
            $fetch->execute();
            $row = $fetch->get_result()->fetch_assoc();
            $fetch->close();

            $invoice_no = $row['invoice_no'];
            $amount = floatval($row['amount_due']);
            $remarks = "VOIDED Invoice: $invoice_no";

            $update = $conn->prepare("UPDATE accounts_receivable SET status = 'Voided', amount_due = 0 WHERE id = ?");
            if ($update) {
                $update->bind_param("i", $id);
                $update->execute();
                $update->close();

                // Journal 1: DR Service Revenue
                $acct_service_revenue = 3;
                $j1 = $conn->prepare("INSERT INTO journal_entries 
                    (transaction_date, account_id, debit, credit, module_type, reference_id, remarks)
                    VALUES (?, ?, ?, 0, 'AR', ?, ?)");
                $j1->bind_param("sidis", $today, $acct_service_revenue, $amount, $id, $remarks);
                $j1->execute();
                $j1->close();

                // Journal 2: CR Accounts Receivable
                $acct_ar = 2;
                $j2 = $conn->prepare("INSERT INTO journal_entries 
                    (transaction_date, account_id, debit, credit, module_type, reference_id, remarks)
                    VALUES (?, ?, 0, ?, 'AR', ?, ?)");
                $j2->bind_param("sidis", $today, $acct_ar, $amount, $id, $remarks);
                $j2->execute();
                $j2->close();
            }
        }

        $check->close();
        header("Location: /pinansyal/AccountReceivable.php?voided=1");
        exit();
    }

    // ✅ PAYMENT LOGIC
    if (isset($_POST['id'], $_POST['payment_method'], $_POST['payment_date'], $_POST['amount_paid'])) {
        $id = intval($_POST['id']);
        $payment_method = $_POST['payment_method'];
        $payment_date = $_POST['payment_date'];
        $amount_paid = floatval($_POST['amount_paid']);

        $sel = $conn->prepare("SELECT amount_due, invoice_no FROM accounts_receivable WHERE id = ?");
        $sel->bind_param("i", $id);
        $sel->execute();
        $row = $sel->get_result()->fetch_assoc();
        $sel->close();

        $current_due = floatval($row['amount_due']);
        $invoice_no = $row['invoice_no'];
        $balance = $current_due - $amount_paid;

        if ($balance <= 0) {
            $upd = $conn->prepare("UPDATE accounts_receivable SET status = 'Fully Paid', amount_due = 0 WHERE id = ?");
            $upd->bind_param("i", $id);
        } else {
            $upd = $conn->prepare("UPDATE accounts_receivable SET status = 'Partially Paid', amount_due = ? WHERE id = ?");
            $upd->bind_param("di", $balance, $id);
        }
        $upd->execute();
        $upd->close();

        $insert = $conn->prepare("INSERT INTO collection (invoice_id, payment_method, payment_date, amount_paid)
                                  VALUES (?, ?, ?, ?)");
        $insert->bind_param("issd", $id, $payment_method, $payment_date, $amount_paid);
        $insert->execute();
        $collection_id = $conn->insert_id;
        $insert->close();

        $remarks = "Payment for Invoice: $invoice_no";

        // Journal 1: DR Cash
        $acct_cash = 1;
        $j1 = $conn->prepare("INSERT INTO journal_entries 
            (transaction_date, account_id, debit, credit, module_type, reference_id, remarks)
            VALUES (?, ?, ?, 0, 'COLLECTION', ?, ?)");
        $j1->bind_param("sidis", $today, $acct_cash, $amount_paid, $collection_id, $remarks);
        $j1->execute();
        $j1->close();

        // Journal 2: CR Accounts Receivable
        $acct_ar = 2;
        $j2 = $conn->prepare("INSERT INTO journal_entries 
            (transaction_date, account_id, debit, credit, module_type, reference_id, remarks)
            VALUES (?, ?, 0, ?, 'COLLECTION', ?, ?)");
        $j2->bind_param("sidis", $today, $acct_ar, $amount_paid, $collection_id, $remarks);
        $j2->execute();
        $j2->close();

        echo "Payment recorded.";
        exit();
    }

    // ✅ CREATE INVOICE LOGIC
    if (isset($_POST['client_name'], $_POST['booking_date'], $_POST['amount_due'], $_POST['due_date'], $_POST['remarks'])) {
        $client_name = $conn->real_escape_string($_POST['client_name']);
        $booking_date = $conn->real_escape_string($_POST['booking_date']);
        $amount_due = floatval($_POST['amount_due']);
        $due_date = $conn->real_escape_string($_POST['due_date']);
        $remarks = $conn->real_escape_string($_POST['remarks']);

        $stmt = $conn->prepare("INSERT INTO accounts_receivable (client_name, booking_date, amount_due, due_date, remarks)
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdss", $client_name, $booking_date, $amount_due, $due_date, $remarks);
        $stmt->execute();
        $last_id = $conn->insert_id;
        $stmt->close();

        $date_today = date('Ymd');
        $count = $conn->query("SELECT COUNT(*) AS daily_count FROM accounts_receivable WHERE DATE(created_at) = CURDATE()");
        $daily_count = $count->fetch_assoc()['daily_count'];

        $invoice_no = 'INV-' . $date_today . '-' . str_pad($daily_count, 3, '0', STR_PAD_LEFT);
        $update_stmt = $conn->prepare("UPDATE accounts_receivable SET invoice_no = ? WHERE id = ?");
        $update_stmt->bind_param("si", $invoice_no, $last_id);
        $update_stmt->execute();
        $update_stmt->close();

        $journal_remarks = "Invoice: $invoice_no";

        // Journal 1: DR Accounts Receivable
        $acct_ar = 2;
        $j1 = $conn->prepare("INSERT INTO journal_entries 
            (transaction_date, account_id, debit, credit, module_type, reference_id, remarks)
            VALUES (?, ?, ?, 0, 'AR', ?, ?)");
        $j1->bind_param("sidis", $today, $acct_ar, $amount_due, $last_id, $journal_remarks);
        $j1->execute();
        $j1->close();

        // Journal 2: CR Service Revenue
        $acct_service_revenue = 3;
        $j2 = $conn->prepare("INSERT INTO journal_entries 
            (transaction_date, account_id, debit, credit, module_type, reference_id, remarks)
            VALUES (?, ?, 0, ?, 'AR', ?, ?)");
        $j2->bind_param("sidis", $today, $acct_service_revenue, $amount_due, $last_id, $journal_remarks);
        $j2->execute();
        $j2->close();

        header("Location: /pinansyal/AccountReceivable.php?success=1");
        exit();
    }
}

$conn->close();
?>
