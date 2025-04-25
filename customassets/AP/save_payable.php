<?php
include 'cnnpayable.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payee = $_POST['payee'];
    $amount = floatval($_POST['amount']);
    $due_date = $_POST['due_date'];
    $account_id = intval($_POST['account_id']);
    $remarks = $_POST['remarks'];
    $date = date('Y-m-d');

    // Insert into accounts_payable
    $stmt = $conn->prepare("INSERT INTO accounts_payable (payee, amount, due_date, account_id, remarks) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsis", $payee, $amount, $due_date, $account_id, $remarks);

    if ($stmt->execute()) {
        $payable_id = $conn->insert_id;

        // ✅ Journal Entry: DR Expense Account
        $j1 = $conn->prepare("INSERT INTO journal_entries 
            (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) 
            VALUES (?, ?, ?, 0, 'AP', ?, ?)");
        $j1->bind_param("sidis", $date, $account_id, $amount, $payable_id, $remarks);
        $j1->execute();
        $j1->close();

        // ✅ Journal Entry: CR Accounts Payable (acct_id = 4)
        $acct_ap = 4;
        $j2 = $conn->prepare("INSERT INTO journal_entries 
            (transaction_date, account_id, debit, credit, module_type, reference_id, remarks) 
            VALUES (?, ?, 0, ?, 'AP', ?, ?)");
        $j2->bind_param("sidis", $date, $acct_ap, $amount, $payable_id, $remarks);
        $j2->execute();
        $j2->close();

        echo "Payable saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
