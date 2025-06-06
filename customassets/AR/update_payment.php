<?php
include 'cnnAR.php';
include 'functions.php'; // ← ensure logAudit is available

session_start();
$user_id = $_SESSION['user_id'] ?? 0; // fallback kung walang session

function updateGeneralLedger($conn, $aid, $deb, $cred, $period, $aname = "") {
    // unchanged
}

function insertJournalEntry($conn, $today, $aid, $deb, $cred, $module_type, $ref_id, $remarks) {
    // unchanged
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id     = intval($_POST['id']);
    $today  = date('Y-m-d');
    $period = $today;

    // ───── VOID LOGIC ─────
    if (!empty($_POST['void']) && $_POST['void'] == 1) {
        $conn->begin_transaction();

        $stmt = $conn->prepare("SELECT invoice_no, amount_due FROM accounts_receivable WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($row) {
            $invoice_no = $row['invoice_no'];
            $amount_due = floatval($row['amount_due']);
            $remarks = "VOIDED Invoice: $invoice_no";

            $paid_stmt = $conn->prepare("SELECT SUM(amount_paid) AS total_paid FROM collection WHERE invoice_id = ?");
            $paid_stmt->bind_param("i", $id);
            $paid_stmt->execute();
            $paid_row = $paid_stmt->get_result()->fetch_assoc();
            $total_paid = floatval($paid_row['total_paid'] ?? 0);
            $paid_stmt->close();

            $original_total = $amount_due + $total_paid;

            // Update status
            $upd = $conn->prepare("UPDATE accounts_receivable SET status = 'Voided', amount_due = 0 WHERE id = ?");
            $upd->bind_param("i", $id);
            $upd->execute();
            $upd->close();

            $entries = [];

            // Reverse full revenue
            $entries[] = ['aid' => 3, 'deb' => $original_total, 'cred' => 0]; // DR Service Revenue

            // Reverse unpaid part (A/R)
            if ($amount_due > 0) {
                $entries[] = ['aid' => 2, 'deb' => $amount_due, 'cred' => 0]; // DR AR
            }

            // Refund paid part (Cash)
            if ($total_paid > 0) {
                $entries[] = ['aid' => 1, 'deb' => 0, 'cred' => $total_paid]; // CR Cash
            }

            foreach ($entries as $e) {
                insertJournalEntry($conn, $today, $e['aid'], $e['deb'], $e['cred'], 'AR_VOID', $id, $remarks);
                updateGeneralLedger($conn, $e['aid'], $e['deb'], $e['cred'], $period);
            }

            $conn->commit();
            echo "Invoice successfully voided!";

            // ➕ Audit trail
            logAudit($conn, $user_id, 'Void Invoice', "Voided invoice #$invoice_no with original total: $original_total", 'Accounts Receivable');
        } else {
            $conn->rollback();
            echo "Invoice not found for void.";
        }
        exit();
    }

    // ───── PAYMENT LOGIC ─────
    if (isset($_POST['payment_method'], $_POST['payment_date'], $_POST['amount_paid'])) {
        $payment_method = $_POST['payment_method'];
        $payment_date   = $_POST['payment_date'];
        $amount_paid    = floatval($_POST['amount_paid']);

        $sel = $conn->prepare("SELECT amount_due, invoice_no FROM accounts_receivable WHERE id = ?");
        $sel->bind_param("i", $id);
        $sel->execute();
        $row = $sel->get_result()->fetch_assoc();
        $sel->close();

        if ($row) {
            $conn->begin_transaction();

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
            $entries = [
                ['aid' => 1, 'deb' => $amount_paid, 'cred' => 0],       // DR Cash
                ['aid' => 2, 'deb' => 0,           'cred' => $amount_paid], // CR AR
            ];

            foreach ($entries as $e) {
                insertJournalEntry($conn, $today, $e['aid'], $e['deb'], $e['cred'], 'COLLECTION', $collection_id, $remarks);
                updateGeneralLedger($conn, $e['aid'], $e['deb'], $e['cred'], $period);
            }

            $conn->commit();
            echo "Payment recorded and GL updated!";

            // ➕ Audit trail
            logAudit($conn, $user_id, 'Record Payment', "Payment of ₱$amount_paid recorded for invoice #$invoice_no using $payment_method", 'Collection');
        } else {
            $conn->rollback();
            echo "Invoice not found.";
        }
        exit();
    }
}

$conn->close();
?>
