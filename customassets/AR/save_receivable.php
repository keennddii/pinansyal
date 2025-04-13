<?php
include 'cnnAR.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 🔁 Step 0: Handle VOID if request includes `void=1`
    if (isset($_POST['void']) && $_POST['void'] == 1 && isset($_POST['id'])) {
        $invoice_id = intval($_POST['id']);

        // Get invoice details for reversal
        $void_q = $conn->prepare("SELECT invoice_no, amount_due FROM accounts_receivable WHERE id = ?");
        $void_q->bind_param("i", $invoice_id);
        $void_q->execute();
        $void_result = $void_q->get_result();

        if ($row = $void_result->fetch_assoc()) {
            $invoice_no = $row['invoice_no'];
            $amount = floatval($row['amount_due']);
            $remarks = "VOIDED Invoice: " . $invoice_no;
            $date = date('Y-m-d');

            // Step 1: Update status and amount_due to 0
            $update_void = $conn->prepare("UPDATE accounts_receivable SET status = 'Voided', amount_due = 0 WHERE id = ?");
            $update_void->bind_param("i", $invoice_id);

            if ($update_void->execute()) {
                // Step 2: Insert Reversing Journal Entry
                $reverse_sql = "INSERT INTO journal_entries (date, account, debit, credit, remarks)
                                VALUES 
                                (?, 'Service Revenue', ?, 0, ?),
                                (?, 'Accounts Receivable', 0, ?, ?)";
                $reverse_stmt = $conn->prepare($reverse_sql);
                $reverse_stmt->bind_param("sdssds", 
                    $date, $amount, $remarks,
                    $date, $amount, $remarks
                );

                if ($reverse_stmt->execute()) {
                    header("Location: /pinansyal/AccountReceivable.php?voided=1");
                    exit();
                } else {
                    echo "Invoice voided but journal reversal failed: " . $reverse_stmt->error;
                }

                $reverse_stmt->close();
            } else {
                echo "Failed to update invoice as voided.";
            }

            $update_void->close();
        } else {
            echo "Invoice not found.";
        }

        $void_q->close();
        exit(); // stop further execution if void
    }

    // 🧾 Create New Invoice (Normal Flow)
    if (isset($_POST['client_name'], $_POST['booking_date'], $_POST['amount_due'], $_POST['due_date'], $_POST['remarks'])) {
        $client_name = $conn->real_escape_string($_POST['client_name']);
        $booking_date = $conn->real_escape_string($_POST['booking_date']);
        $amount_due = floatval($_POST['amount_due']);
        $due_date = $conn->real_escape_string($_POST['due_date']);
        $remarks = $conn->real_escape_string($_POST['remarks']);

        $sql = "INSERT INTO accounts_receivable (client_name, booking_date, amount_due, due_date, remarks)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdss", $client_name, $booking_date, $amount_due, $due_date, $remarks);

        if ($stmt->execute()) {
            $last_id = $conn->insert_id;

            $date_today = date('Ymd');
            $count_sql = "SELECT COUNT(*) AS daily_count FROM accounts_receivable WHERE DATE(created_at) = CURDATE()";
            $count_result = $conn->query($count_sql);
            $count_row = $count_result->fetch_assoc();
            $daily_count = $count_row['daily_count'];

            $invoice_no = 'INV-' . $date_today . '-' . str_pad($daily_count, 3, '0', STR_PAD_LEFT);

            $update_sql = "UPDATE accounts_receivable SET invoice_no = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $invoice_no, $last_id);
            $update_stmt->execute();

            // Insert journal entry
            $journal_sql = "INSERT INTO journal_entries (date, account, debit, credit, remarks)
                            VALUES 
                            (CURDATE(), 'Accounts Receivable', ?, 0, ?),
                            (CURDATE(), 'Service Revenue', 0, ?, ?)";
            $journal_stmt = $conn->prepare($journal_sql);
            $remarks_text = 'Invoice: ' . $invoice_no;
            $journal_stmt->bind_param("dsds", $amount_due, $remarks_text, $amount_due, $remarks_text);

            if ($journal_stmt->execute()) {
                header("Location: /pinansyal/AccountReceivable.php?success=1");
                exit();
            } else {
                echo "Invoice saved but failed to insert journal entries: " . $journal_stmt->error;
            }

            $journal_stmt->close();
            $update_stmt->close();
        } else {
            echo "Error inserting invoice: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
