<?php
include '../../config/db.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $defaultPass = password_hash("password123", PASSWORD_DEFAULT);

  $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ? AND role = 'employee'");
  $stmt->bind_param("si", $defaultPass, $id);
  $stmt->execute();
  echo "Reset";
  exit();
}
?>