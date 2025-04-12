
<?php
include 'cnnAR.php';


if (isset($_POST['id']) && isset($_POST['payment_method']) && isset($_POST['payment_date']) && isset($_POST['amount_paid'])) {
    $id = $_POST['id'];
    $payment_method = $_POST['payment_method'];
    $payment_date = $_POST['payment_date'];
    $amount_paid = floatval($_POST['amount_paid']); // always cast to float for safety

    // Kunin muna ang current amount_due
    $sql_select = "SELECT amount_due FROM accounts_receivable WHERE id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $current_amount_due = floatval($row['amount_due']);
        $remaining_balance = $current_amount_due - $amount_paid;

        if ($remaining_balance <= 0) {
            // FULL PAYMENT
            $sql_update = "UPDATE accounts_receivable SET status = 'Fully Paid', amount_due = 0 WHERE id = ?";
        } else {
            // PARTIAL PAYMENT
            $sql_update = "UPDATE accounts_receivable SET status = 'Partially Paid', amount_due = ? WHERE id = ?";
        }

        // Prepare Update statement
        $stmt_update = $conn->prepare($sql_update);

        if ($remaining_balance <= 0) {
            $stmt_update->bind_param("i", $id);
        } else {
            $stmt_update->bind_param("di", $remaining_balance, $id);
        }

        if ($stmt_update->execute()) {
            // Insert Payment Record sa Collection
            $sql_insert = "INSERT INTO collection (invoice_id, payment_method, payment_date, amount_paid) 
                           VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("issd", $id, $payment_method, $payment_date, $amount_paid);
            
            if ($stmt_insert->execute()) {
                echo "Payment successfully recorded!";
            } else {
                echo "Error recording payment.";
            }
        } else {
            echo "Error updating invoice status.";
        }

        $stmt_update->close();
        $stmt_insert->close();
    } else {
        echo "Invoice not found.";
    }

    $stmt_select->close();
}
?>


