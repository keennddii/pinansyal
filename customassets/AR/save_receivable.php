<?php
include 'cnnAR.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $client_name = $conn->real_escape_string($_POST['client_name']);
    $booking_date = $conn->real_escape_string($_POST['booking_date']);
    $amount_due = $conn->real_escape_string($_POST['amount_due']);
    $due_date = $conn->real_escape_string($_POST['due_date']);
    $remarks = $conn->real_escape_string($_POST['remarks']);

    // Step 1: Insert first without invoice_no
    $sql = "INSERT INTO accounts_receivable (client_name, booking_date, amount_due, due_date, remarks)
            VALUES ('$client_name', '$booking_date', '$amount_due', '$due_date', '$remarks')";

    if ($conn->query($sql) === TRUE) {
        // Step 2: Get the ID of the newly inserted record
        $last_id = $conn->insert_id;

        // Step 3: Create the invoice_no based on the ID
        $invoice_no = 'INV-' . $last_id;

        // Step 4: Update the record with the generated invoice_no
        $update_sql = "UPDATE accounts_receivable SET invoice_no = '$invoice_no' WHERE id = $last_id";
        if ($conn->query($update_sql) === TRUE) {
            header("Location: /pinansyal/AccountReceivable.php?success=1");  // Redirect after success
            exit();
        } else {
            echo "Error updating invoice_no: " . $conn->error;
        }
    } else {
        echo "Error inserting data: " . $conn->error;
    }
}

$conn->close();
?>
