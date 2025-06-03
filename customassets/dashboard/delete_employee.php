<?php
include '../../config/db.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role = 'employee'");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  echo "Deleted";
  exit();
}
?>