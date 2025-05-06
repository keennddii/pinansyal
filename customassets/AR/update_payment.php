<?php
include 'cnnAR.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id     = intval($_POST['id']);
    $today  = date('Y-m-d');
    $period = $today; // or date('Y-m') if you prefer monthly periods

    // ───── VOID LOGIC ─────
    if (!empty($_POST['void']) && $_POST['void'] == 1) {
        // Fetch invoice data
        $stmt = $conn->prepare("
            SELECT invoice_no, amount_due 
              FROM accounts_receivable 
             WHERE id = ?
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($row) {
            $invoice_no = $row['invoice_no'];
            $amount     = floatval($row['amount_due']);
            $remarks    = "VOIDED Invoice: $invoice_no";

            // Mark invoice voided
            $upd = $conn->prepare("
                UPDATE accounts_receivable
                   SET status = 'Voided', amount_due = 0
                 WHERE id = ?
            ");
            $upd->bind_param("i", $id);
            $upd->execute();
            $upd->close();

            // Journal entries
            $entries = [
                ['aid' => 1, 'deb' => 0, 'cred' => $amount], // CR Cash (acct 1)
                ['aid' => 3, 'deb' => $amount, 'cred' => 0],       // DR Service Revenue (acct 3)
                ['aid' => 2, 'deb' => 0,       'cred' => $amount],  // CR Accounts Receivable (acct 2)
            ];
            foreach ($entries as $e) {
                // Insert journal entry
                $j = $conn->prepare("
                    INSERT INTO journal_entries
                      (transaction_date, account_id, debit, credit, module_type, reference_id, remarks)
                    VALUES (?, ?, ?, ?, 'AR', ?, ?)
                ");
                $j->bind_param(
                    "sidiss",
                    $today, $e['aid'], $e['deb'], $e['cred'], $id, $remarks
                );
                $j->execute();
                $j->close();

                // Update or insert into general_ledger
                $chk = $conn->prepare("
                    SELECT id, debit, credit
                      FROM general_ledger
                     WHERE account_id = ?
                       AND period = ?
                ");
                $chk->bind_param("is", $e['aid'], $period);
                $chk->execute();
                $res = $chk->get_result();

                if ($res->num_rows) {
                    $lg       = $res->fetch_assoc();
                    $nid      = $lg['id'];
                    $nd       = $lg['debit']  + $e['deb'];
                    $nc       = $lg['credit'] + $e['cred'];
                    $nb       = $nd - $nc;
                    $up       = $conn->prepare("
                        UPDATE general_ledger
                           SET debit   = ?, credit = ?, balance = ?
                         WHERE id = ?
                    ");
                    $up->bind_param("dddi", $nd, $nc, $nb, $nid);
                    $up->execute();
                    $up->close();
                } else {
                    $aname = ""; // optionally fetch from chart_of_accounts
                    $bal   = $e['deb'] - $e['cred'];
                    $ins   = $conn->prepare("
                        INSERT INTO general_ledger
                          (account_id, account_name, debit, credit, balance, period)
                        VALUES (?, ?, ?, ?, ?, ?)
                    ");
                    $ins->bind_param("isddds", $e['aid'], $aname, $e['deb'], $e['cred'], $bal, $period);
                    $ins->execute();
                    $ins->close();
                }
                $chk->close();
            }

            echo "Invoice voided and GL updated!";
        } else {
            echo "Invoice not found for void.";
        }
        exit();
    }

    // ───── PAYMENT LOGIC ─────
    if (isset($_POST['payment_method'], $_POST['payment_date'], $_POST['amount_paid'])) {
        $payment_method = $_POST['payment_method'];
        $payment_date   = $_POST['payment_date'];
        $amount_paid    = floatval($_POST['amount_paid']);

        // Fetch current AR
        $sel = $conn->prepare("
            SELECT amount_due, invoice_no
              FROM accounts_receivable
             WHERE id = ?
        ");
        $sel->bind_param("i", $id);
        $sel->execute();
        $row = $sel->get_result()->fetch_assoc();
        $sel->close();

        if ($row) {
            $current_due = floatval($row['amount_due']);
            $invoice_no  = $row['invoice_no'];
            $balance     = $current_due - $amount_paid;

            // Update AR status/amount
            if ($balance <= 0) {
                $upd = $conn->prepare("
                    UPDATE accounts_receivable
                       SET status = 'Fully Paid', amount_due = 0
                     WHERE id = ?
                ");
                $upd->bind_param("i", $id);
            } else {
                $upd = $conn->prepare("
                    UPDATE accounts_receivable
                       SET status = 'Partially Paid', amount_due = ?
                     WHERE id = ?
                ");
                $upd->bind_param("di", $balance, $id);
            }
            $upd->execute();
            $upd->close();

            // Record collection
            $ins = $conn->prepare("
                INSERT INTO collection
                  (invoice_id, payment_method, payment_date, amount_paid)
                VALUES (?, ?, ?, ?)
            ");
            $ins->bind_param("issd", $id, $payment_method, $payment_date, $amount_paid);
            $ins->execute();
            $collection_id = $conn->insert_id;
            $ins->close();

            $remarks = "Payment for Invoice: $invoice_no";

            // Journal entries + GL update
            $entries = [
                ['aid' => 1, 'deb' => $amount_paid, 'cred' => 0],       // DR Cash (acct 1)
                ['aid' => 2, 'deb' => 0,           'cred' => $amount_paid], // CR AR (acct 2)
            ];
            foreach ($entries as $e) {
                $j = $conn->prepare("
                    INSERT INTO journal_entries
                      (transaction_date, account_id, debit, credit, module_type, reference_id, remarks)
                    VALUES (?, ?, ?, ?, 'COLLECTION', ?, ?)
                ");
                $j->bind_param(
                    "sidiss",
                    $today, $e['aid'], $e['deb'], $e['cred'], $collection_id, $remarks
                );
                $j->execute();
                $j->close();

                // Update/insert general_ledger
                $chk = $conn->prepare("
                    SELECT id, debit, credit
                      FROM general_ledger
                     WHERE account_id = ?
                       AND period = ?
                ");
                $chk->bind_param("is", $e['aid'], $period);
                $chk->execute();
                $res = $chk->get_result();

                if ($res->num_rows) {
                    $lg       = $res->fetch_assoc();
                    $nid      = $lg['id'];
                    $nd       = $lg['debit']  + $e['deb'];
                    $nc       = $lg['credit'] + $e['cred'];
                    $nb       = $nd - $nc;
                    $up       = $conn->prepare("
                        UPDATE general_ledger
                           SET debit   = ?, credit = ?, balance = ?
                         WHERE id = ?
                    ");
                    $up->bind_param("dddi", $nd, $nc, $nb, $nid);
                    $up->execute();
                    $up->close();
                } else {
                    $aname = "";
                    $bal   = $e['deb'] - $e['cred'];
                    $ins2  = $conn->prepare("
                        INSERT INTO general_ledger
                          (account_id, account_name, debit, credit, balance, period)
                        VALUES (?, ?, ?, ?, ?, ?)
                    ");
                    $ins2->bind_param("isddds", $e['aid'], $aname, $e['deb'], $e['cred'], $bal, $period);
                    $ins2->execute();
                    $ins2->close();
                }
                $chk->close();
            }

            echo "Payment recorded and GL updated!";
        } else {
            echo "Invoice not found.";
        }
        exit();
    }
}

$conn->close();
?>
