<?php
include 'cnnpayable.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $payee = trim($_POST['payee']);
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    $due_date = $_POST['due_date'];
    $account_id = isset($_POST['account_id']) ? intval($_POST['account_id']) : 0;
    $department_id = isset($_POST['department_id']) ? intval($_POST['department_id']) : null;
    $remarks = trim($_POST['remarks']);
    $date_today = date('Y-m-d');

    // Validate required fields
    if (empty($payee) || $amount <= 0 || empty($due_date) || empty($account_id)) {
        echo "Invalid input. Please complete all required fields.";
        exit;
    }

    // Insert into accounts_payable
    $stmt = $conn->prepare("INSERT INTO accounts_payable (payee, amount, due_date, account_id, department_id, remarks) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit;
    }
    $stmt->bind_param("sdsiss", $payee, $amount, $due_date, $account_id, $department_id, $remarks);

    if ($stmt->execute()) {
        $payable_id = $conn->insert_id;

        // ✅ Insert Journal Entry (Debit - Expense Account)
        $journal1 = $conn->prepare("INSERT INTO journal_entries 
            (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) 
            VALUES (?, ?, ?, 0, 'AP', ?, ?)");
        $journal1->bind_param("sidis", $date_today, $account_id, $amount, $payable_id, $remarks);
        $journal1->execute();
        $journal1->close();

        // ✅ Insert Journal Entry (Credit - Accounts Payable, account_id = 4)
        $account_payable_id = 4; // Always 4 for Accounts Payable
        $journal2 = $conn->prepare("INSERT INTO journal_entries 
            (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) 
            VALUES (?, ?, 0, ?, 'AP', ?, ?)");
        $journal2->bind_param("sidis", $date_today, $account_payable_id, $amount, $payable_id, $remarks);
        $journal2->execute();
        $journal2->close();

        echo "Payable saved successfully!";
    } else {
        echo "Error saving payable: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
