<?php
session_start();
include("cnn/connections.php");

// Initialize error message
$_SESSION['error_message'] = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['sign-in'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $stmt = $con->prepare("SELECT * FROM tbl_pinansyal_acc WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            
            // para sa password kung tama
            if ($password === $row['password']) {
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit;
            } else {
                $_SESSION['error_message'] = 'Invalid password. Please try again.';
            }
        } else {
            $_SESSION['error_message'] = 'Invalid username. Please try again.';
        }
    }
}
?>
