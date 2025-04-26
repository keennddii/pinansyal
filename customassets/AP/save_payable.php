<?php
include 'cnnpayable.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $payee         = trim($_POST['payee']);
    $amount        = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    $due_date      = $_POST['due_date'];
    $account_id    = isset($_POST['account_id']) ? intval($_POST['account_id']) : 0;
    $department_id = isset($_POST['department_id']) ? intval($_POST['department_id']) : null;
    $remarks       = trim($_POST['remarks']);
    $date_today    = date('Y-m-d');
    $period        = $date_today;         // or date('Y-m') if you want monthly

    // Validate required fields
    if (empty($payee) || $amount <= 0 || empty($due_date) || empty($account_id)) {
        echo "Invalid input. Please complete all required fields.";
        exit;
    }

    // ✅ Check Department Budget
    if (!empty($department_id)) {
        $budgetQuery = $conn->prepare("
            SELECT (allocated_amount - used_amount) AS remaining_budget 
            FROM budget_allocations 
            WHERE department_id = ? AND year = ? AND status = 'Active'
        ");
        $current_year = date('Y');
        $budgetQuery->bind_param("is", $department_id, $current_year);
        $budgetQuery->execute();
        $budgetResult = $budgetQuery->get_result();

        if ($budgetResult->num_rows > 0) {
            $budgetRow       = $budgetResult->fetch_assoc();
            $remaining_budget = $budgetRow['remaining_budget'];
            if ($remaining_budget < $amount) {
                echo "Insufficient Department Budget.";
                exit;
            }
        } else {
            echo "No active budget allocation found for this department.";
            exit;
        }
        $budgetQuery->close();
    }

    // Insert into accounts_payable
    $stmt = $conn->prepare("
        INSERT INTO accounts_payable 
          (payee, amount, due_date, account_id, department_id, remarks) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    if (!$stmt) {
        echo "Prepare failed: " . $conn->error;
        exit;
    }
    $stmt->bind_param("sdsiss", $payee, $amount, $due_date, $account_id, $department_id, $remarks);

    if ($stmt->execute()) {
        $payable_id = $conn->insert_id;

        // 1) Debit entry (expense)
        $journal1 = $conn->prepare("
            INSERT INTO journal_entries 
              (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) 
            VALUES (?, ?, ?, 0, 'AP', ?, ?)
        ");
        $journal1->bind_param("sidis", $date_today, $account_id, $amount, $payable_id, $remarks);
        $journal1->execute();
        $journal1->close();

        // 2) Credit entry (accounts payable)
        $account_payable_id = 4; 
        $journal2 = $conn->prepare("
            INSERT INTO journal_entries 
              (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) 
            VALUES (?, ?, 0, ?, 'AP', ?, ?)
        ");
        $journal2->bind_param("sidis", $date_today, $account_payable_id, $amount, $payable_id, $remarks);
        $journal2->execute();
        $journal2->close();

        // ✅ Update or Insert into General Ledger
        $checkLedger = $conn->prepare("
            SELECT id, debit, credit 
            FROM general_ledger 
            WHERE account_id = ? AND period = ?
        ");
        $checkLedger->bind_param("is", $account_id, $period);
        $checkLedger->execute();
        $checkResult = $checkLedger->get_result();

        if ($checkResult->num_rows > 0) {
            // Update existing GL record
            $ledger      = $checkResult->fetch_assoc();
            $new_debit   = $ledger['debit']  + $amount;
            $new_credit  = $ledger['credit'] + $amount;
            $new_balance = $new_debit - $new_credit;
            $ledger_id   = $ledger['id'];

            $updateLedger = $conn->prepare("
                UPDATE general_ledger 
                SET debit = ?, credit = ?, balance = ? 
                WHERE id = ?
            ");
            $updateLedger->bind_param("dddi", $new_debit, $new_credit, $new_balance, $ledger_id);
            $updateLedger->execute();
            $updateLedger->close();
        } else {
            // Insert new GL record
            $credit_amount = 0.0;
            $balance       = $amount - $credit_amount;
            $account_name  = ""; // fetch from chart_of_accounts if needed

            $insertLedger = $conn->prepare("
                INSERT INTO general_ledger 
                  (account_id, account_name, debit, credit, balance, period) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $insertLedger->bind_param(
                "isddds",
                $account_id,
                $account_name,
                $amount,
                $credit_amount,
                $balance,
                $period
            );
            $insertLedger->execute();
            $insertLedger->close();
        }

        $checkLedger->close();
        echo "Payable saved and general ledger updated!";
    } else {
        echo "Error saving payable: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
