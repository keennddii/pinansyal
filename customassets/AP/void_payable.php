<?php
session_start();
include 'cnnpayable.php';
require_once '../../functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $user_id = $_SESSION['user_id'] ?? null;

    // Optional: Kunin muna ang payee name para sa description
    $payee = '';
    $fetch = $conn->prepare("SELECT payee FROM accounts_payable WHERE id = ?");
    $fetch->bind_param("i", $id);
    $fetch->execute();
    $fetch->bind_result($payee);
    $fetch->fetch();
    $fetch->close();

    $stmt = $conn->prepare("UPDATE accounts_payable SET status = 'Voided' WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // ✅ Audit Trail
        if ($user_id) {
            $desc = "Voided payable request for {$payee} (ID: {$id})";
            logAudit($conn, $user_id, 'Void Payable', $desc, 'Accounts Payable');
        }
        echo "Payable successfully voided.";
    } else {
        echo "Error voiding payable.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}