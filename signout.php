<?php
session_start();
include 'functions.php'; // kung andito yung logAudit()
include 'customassets/AR/cnnAR.php'; // database connection

// 🔐 Kunin muna bago ma-unset
$user_id = $_SESSION['user_id'] ?? null;
$username = $_SESSION['username'] ?? '';
$role = $_SESSION['role'] ?? '';

// ✅ Audit log muna bago i-destroy
if ($user_id) {
    logAudit($conn, $user_id, 'Logout', "User logged out", 'Authentication');
}

// ❌ Destroy session after log
session_destroy();

// Extra precaution
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['role']);

// ✅ No-cache headers
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");

// Redirect to login
header("Location: index.php");
exit;
