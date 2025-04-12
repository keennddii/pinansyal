<?php
include 'cnnGL.php'; // (or kung iba file mo for db connection)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $conn->real_escape_string($_POST['date']);
    $account_code = $conn->real_escape_string($_POST['account_code']);
    $description = $conn->real_escape_string($_POST['description']);
    $debit = $conn->real_escape_string($_POST['debit']);
    $credit = $conn->real_escape_string($_POST['credit']);
    $module = $conn->real_escape_string($_POST['module']);
    $reference_id = $conn->real_escape_string($_POST['reference_id']);

    $sql = "INSERT INTO journal_entries (date, account_code, description, debit, credit, module, reference_id)
            VALUES ('$date', '$account_code', '$description', '$debit', '$credit', '$module', '$reference_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: /pinansyal/GeneralLedger.php?success=1"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
