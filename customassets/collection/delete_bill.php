<?php
include 'cnncollection.php';

if (isset($_POST['invoice_no'])) {
    $invoice_no = $con->real_escape_string($_POST['invoice_no']);  // Use invoice_no from POST

    // Use prepared statement to prevent SQL injection
    $stmt = $con->prepare("DELETE FROM payments WHERE invoice_no = ?");
    $stmt->bind_param("s", $invoice_no); // 's' means string for invoice_no

    if ($stmt->execute()) {
        echo "Bill deleted successfully";
    } else {
        http_response_code(500); // Internal Server Error
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    http_response_code(400); // Bad request
    echo "Invoice number not set.";
}

$con->close();
?>
