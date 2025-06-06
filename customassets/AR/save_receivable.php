<?php
include 'cnnAR.php';
include 'functions.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $today  = date('Y-m-d');
    $period = $today;

    // ───── PAYMENT LOGIC ─────
    if (isset($_POST['id'], $_POST['payment_method'], $_POST['payment_date'], $_POST['amount_paid'])) {
        $id             = intval($_POST['id']);
        $payment_method = $_POST['payment_method'];
        $payment_date   = $_POST['payment_date'];
        $amount_paid    = floatval($_POST['amount_paid']);

        $sel = $conn->prepare("SELECT amount_due, invoice_no FROM accounts_receivable WHERE id = ?");
        $sel->bind_param("i", $id);
        $sel->execute();
        $row = $sel->get_result()->fetch_assoc();
        $sel->close();

        $current_due = floatval($row['amount_due']);
        $invoice_no  = $row['invoice_no'];
        $balance     = $current_due - $amount_paid;

        if ($balance <= 0) {
            $upd = $conn->prepare("UPDATE accounts_receivable SET status = 'Fully Paid', amount_due = 0 WHERE id = ?");
            $upd->bind_param("i", $id);
        } else {
            $upd = $conn->prepare("UPDATE accounts_receivable SET status = 'Partially Paid', amount_due = ? WHERE id = ?");
            $upd->bind_param("di", $balance, $id);
        }
        $upd->execute();
        $upd->close();

        $ins = $conn->prepare("INSERT INTO collection (invoice_id, payment_method, payment_date, amount_paid) VALUES (?, ?, ?, ?)");
        $ins->bind_param("issd", $id, $payment_method, $payment_date, $amount_paid);
        $ins->execute();
        $collection_id = $conn->insert_id;
        $ins->close();

        $remarks = "Payment for Invoice: $invoice_no";

        // 🔒 Audit Trail - Payment
        logAudit($conn, $_SESSION['user_id'], 'Create Payment', "Paid ₱" . number_format($amount_paid, 2) . " for Invoice $invoice_no", 'Collection');

        // Journal entries
        $entries = [
            ['aid' => 1, 'deb' => $amount_paid, 'cred' => 0],     // Cash
            ['aid' => 2, 'deb' => 0,           'cred' => $amount_paid], // AR
        ];
        foreach ($entries as $e) {
            $aid  = $e['aid'];
            $deb  = $e['deb'];
            $cred = $e['cred'];

            $j = $conn->prepare("INSERT INTO journal_entries (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) VALUES (?, ?, ?, ?, 'COLLECTION', ?, ?)");
            $j->bind_param("sidiss", $today, $aid, $deb, $cred, $collection_id, $remarks);
            $j->execute();
            $j->close();

            $chk = $conn->prepare("SELECT id, debit, credit FROM general_ledger WHERE account_id = ? AND period = ?");
            $chk->bind_param("is", $aid, $period);
            $chk->execute();
            $res = $chk->get_result();

            if ($res->num_rows) {
                $lg  = $res->fetch_assoc();
                $nid = $lg['id'];
                $nd  = $lg['debit'] + $deb;
                $nc  = $lg['credit'] + $cred;
                $nb  = $nd - $nc;

                $up = $conn->prepare("UPDATE general_ledger SET debit = ?, credit = ?, balance = ? WHERE id = ?");
                $up->bind_param("dddi", $nd, $nc, $nb, $nid);
                $up->execute();
                $up->close();
            } else {
                $aname = "";
                $bal   = $deb - $cred;
                $ins2  = $conn->prepare("INSERT INTO general_ledger (account_id, account_name, debit, credit, balance, period) VALUES (?, ?, ?, ?, ?, ?)");
                $ins2->bind_param("isddds", $aid, $aname, $deb, $cred, $bal, $period);
                $ins2->execute();
                $ins2->close();
            }
            $chk->close();
        }

        echo "Payment recorded.";
        exit();
    }

    // ───── CREATE INVOICE LOGIC ─────
    if (isset($_POST['client_name'], $_POST['booking_date'], $_POST['amount_due'], $_POST['remarks'])) {
        $client_name  = $conn->real_escape_string($_POST['client_name']);
        $booking_date = $conn->real_escape_string($_POST['booking_date']);
        $amount_due   = floatval($_POST['amount_due']);
        $remarks      = $conn->real_escape_string($_POST['remarks']);

        $stmt = $conn->prepare("INSERT INTO accounts_receivable (client_name, booking_date, amount_due, remarks) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $client_name, $booking_date, $amount_due, $remarks);
        $stmt->execute();
        $last_id = $conn->insert_id;
        $stmt->close();

        $date_today  = date('Ymd');
        $count       = $conn->query("SELECT COUNT(*) AS daily_count FROM accounts_receivable WHERE DATE(created_at) = CURDATE()");
        $daily_count = $count->fetch_assoc()['daily_count'];
        $invoice_no  = 'INV-' . $date_today . '-' . str_pad($daily_count, 3, '0', STR_PAD_LEFT);

        $upd2 = $conn->prepare("UPDATE accounts_receivable SET invoice_no = ? WHERE id = ?");
        $upd2->bind_param("si", $invoice_no, $last_id);
        $upd2->execute();
        $upd2->close();

        // 🔒 Audit Trail - Invoice
        logAudit($conn, $_SESSION['user_id'], 'Create Invoice', "Created Invoice $invoice_no for ₱" . number_format($amount_due, 2) . " - $client_name", 'Accounts Receivable');

        $journal_remarks = "Invoice: $invoice_no";

        $entries = [
            ['aid' => 2, 'deb' => $amount_due, 'cred' => 0],   // AR
            ['aid' => 3, 'deb' => 0,            'cred' => $amount_due], // Revenue
        ];
        foreach ($entries as $e) {
            $aid  = $e['aid'];
            $deb  = $e['deb'];
            $cred = $e['cred'];

            $j = $conn->prepare("INSERT INTO journal_entries (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) VALUES (?, ?, ?, ?, 'AR', ?, ?)");
            $j->bind_param("sidiss", $today, $aid, $deb, $cred, $last_id, $journal_remarks);
            $j->execute();
            $j->close();

            $chk = $conn->prepare("SELECT id, debit, credit FROM general_ledger WHERE account_id = ? AND period = ?");
            $chk->bind_param("is", $aid, $period);
            $chk->execute();
            $res = $chk->get_result();

            if ($res->num_rows) {
                $lg  = $res->fetch_assoc();
                $nid = $lg['id'];
                $nd  = $lg['debit'] + $deb;
                $nc  = $lg['credit'] + $cred;
                $nb  = $nd - $nc;

                $up = $conn->prepare("UPDATE general_ledger SET debit = ?, credit = ?, balance = ? WHERE id = ?");
                $up->bind_param("dddi", $nd, $nc, $nb, $nid);
                $up->execute();
                $up->close();
            } else {
                $aname = "";
                $bal   = $deb - $cred;
                $ins2  = $conn->prepare("INSERT INTO general_ledger (account_id, account_name, debit, credit, balance, period) VALUES (?, ?, ?, ?, ?, ?)");
                $ins2->bind_param("isddds", $aid, $aname, $deb, $cred, $bal, $period);
                $ins2->execute();
                $ins2->close();
            }
            $chk->close();
        }

        header("Location: /pinansyal/AccountReceivable.php?success=1");
        exit();
    }
}

$conn->close();
?>
