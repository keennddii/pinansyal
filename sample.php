<?php
include 'customassets/AR/cnnAR.php';

$password = "ken1"; // plain password
$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = 'kenken'");
$stmt->bind_param("s", $hashed);
$stmt->execute();

echo "Password updated.";
?>
