<?php
function logAudit($conn, $user_id, $action, $description = '', $module = '') {
    $ip = $_SERVER['REMOTE_ADDR'];
    $stmt = $conn->prepare("INSERT INTO audit_trail (user_id, action, description, ip_address, module) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $action, $description, $ip, $module);
    $stmt->execute();
    $stmt->close();
}

?>