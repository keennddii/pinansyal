<?php
include '../../config/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $username = $_POST['username'];

  $stmt = $conn->prepare("UPDATE users SET username = ? WHERE id = ? AND role = 'employee'");
  $stmt->bind_param("si", $username, $id);
  $stmt->execute();
  echo "Updated";
  exit();
}
?>