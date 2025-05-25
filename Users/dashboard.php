<?php
session_start();
if ($_SESSION['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee Dashboard</title>
</head>
<body>
  <h1>Welcome Employee, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
  <!-- View-only financial data or limited modules -->
</body>
</html>
