<?php
include 'cnnpayable.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $stmt = $conn->prepare("UPDATE accounts_payable SET status = 'Voided' WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Payable successfully voided.";
    } else {
        echo "Error voiding payable.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
