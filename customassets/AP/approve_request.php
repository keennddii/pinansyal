<?php
include 'cnnpayable.php';
session_start();
require_once '../../functions.php'; // adjust if needed

if (isset($_GET['id'])) {
    $request_id = intval($_GET['id']);

    // 🔍 Fetch the request
    $query = $conn->prepare("SELECT * FROM payable_requests WHERE id = ?");
    $query->bind_param("i", $request_id);
    $query->execute();
    $result = $query->get_result();
    $request = $result->fetch_assoc();
    $query->close();

    if (!$request) {
        echo "Request not found.";
        exit;
    }

    // 🔐 Sanitize inputs
    $payee         = trim($request['payee']);
    $amount        = floatval($request['amount']);
    $due_date      = $request['due_date'];
    $account_id    = intval($request['account_id']);
    $department_id = intval($request['department_id']);
    $remarks       = trim($request['remarks']);
    $date_today    = date('Y-m-d');
    $period        = $date_today;

    // ✅ Budget Check
    $current_year = date('Y');
    $budgetQuery = $conn->prepare("
        SELECT (allocated_amount - used_amount) AS remaining_budget 
        FROM budget_allocations 
        WHERE department_id = ? AND year = ? AND status = 'Active'
    ");
    $budgetQuery->bind_param("is", $department_id, $current_year);
    $budgetQuery->execute();
    $budgetResult = $budgetQuery->get_result();

    if ($budgetResult->num_rows > 0) {
        $budgetRow = $budgetResult->fetch_assoc();
        if ($budgetRow['remaining_budget'] < $amount) {
            echo "Insufficient Department Budget.";
            exit;
        }
    } else {
        echo "No active budget found for this department.";
        exit;
    }
    $budgetQuery->close();

    // ✅ Insert into accounts_payable
    $stmt = $conn->prepare("
        INSERT INTO accounts_payable 
        (payee, amount, due_date, account_id, department_id, remarks) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("sdsiss", $payee, $amount, $due_date, $account_id, $department_id, $remarks);
    if (!$stmt->execute()) {
        echo "Error inserting payable: " . $stmt->error;
        exit;
    }
    $payable_id = $conn->insert_id;
    $stmt->close();

    // ✅ Journal Entries
    $journal1 = $conn->prepare("
        INSERT INTO journal_entries 
        (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) 
        VALUES (?, ?, ?, 0, 'AP', ?, ?)
    ");
    $journal1->bind_param("sidis", $date_today, $account_id, $amount, $payable_id, $remarks);
    $journal1->execute();
    $journal1->close();

    $account_payable_id = 4; // Replace with your actual AP account ID
    $journal2 = $conn->prepare("
        INSERT INTO journal_entries 
        (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) 
        VALUES (?, ?, 0, ?, 'AP', ?, ?)
    ");
    $journal2->bind_param("sidis", $date_today, $account_payable_id, $amount, $payable_id, $remarks);
    $journal2->execute();
    $journal2->close();

    // ✅ General Ledger Entry
    $checkLedger = $conn->prepare("
        SELECT id, debit, credit 
        FROM general_ledger 
        WHERE account_id = ? AND period = ?
    ");
    $checkLedger->bind_param("is", $account_id, $period);
    $checkLedger->execute();
    $ledgerResult = $checkLedger->get_result();

    if ($ledgerResult->num_rows > 0) {
        $ledger = $ledgerResult->fetch_assoc();
        $new_debit = $ledger['debit'] + $amount;
        $new_credit = $ledger['credit'];
        $ledger_id = $ledger['id'];

        $typeRes = $conn->query("SELECT account_type FROM chart_of_accounts WHERE id = $account_id");
        $account_type = ($typeRes->num_rows > 0) ? $typeRes->fetch_assoc()['account_type'] : 'Asset';

        $new_balance = in_array($account_type, ['Asset', 'Expense']) ?
            $new_debit - $new_credit : $new_credit - $new_debit;

        $updateLedger = $conn->prepare("
            UPDATE general_ledger 
            SET debit = ?, credit = ?, balance = ? 
            WHERE id = ?
        ");
        $updateLedger->bind_param("dddi", $new_debit, $new_credit, $new_balance, $ledger_id);
        $updateLedger->execute();
        $updateLedger->close();
    } else {
        $credit_amount = 0.0;
        $info = $conn->query("SELECT account_name, account_type FROM chart_of_accounts WHERE id = $account_id")->fetch_assoc();
        $account_name = $info['account_name'];
        $account_type = $info['account_type'];
        $balance = in_array($account_type, ['Asset', 'Expense']) ? $amount : -$amount;

        $insertLedger = $conn->prepare("
            INSERT INTO general_ledger 
            (account_id, account_name, debit, credit, balance, period) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $insertLedger->bind_param("isddds", $account_id, $account_name, $amount, $credit_amount, $balance, $period);
        $insertLedger->execute();
        $insertLedger->close();
    }
    $checkLedger->close();

    // ✅ Mark Request as Approved
    $update = $conn->prepare("UPDATE payable_requests SET status = 'Approved' WHERE id = ?");
    $update->bind_param("i", $request_id);
    $update->execute();
    $update->close();

    // ✅ Audit Trail Logging
    $user_id = $_SESSION['user_id'] ?? 0;
    $action = "Approved Payable Request";
    $desc = "Approved payable request ID #$request_id for ₱" . number_format($amount, 2);
    $module = "Accounts Payable";
    logAudit($conn, $user_id, $action, $desc, $module);

    // ✅ Done
    header("Location: ../../AccountPayable.php?approved=1");
    exit;
}
?>
