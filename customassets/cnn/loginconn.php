<?php
session_start();
include("connections.php");
$_SESSION['error_message'] = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        if (isset($_POST['sign-in'])) {
            $stmt = $con->prepare("SELECT * FROM tbl_pinansyal_acc WHERE username = ? LIMIT 1");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                
                
                if (password_verify($password, $row['password'])) {
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

         // Admin login
         elseif (isset($_POST['admin-login'])) {
            $stmt = $con->prepare("SELECT * FROM tbl_pinansyal_adminacc WHERE username = ? LIMIT 1");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();

               
                if ($password === $row['password']) {
                    $_SESSION['admin_username'] = $username;
                    header("Location: adminhome.php"); 
                    exit;
                } else {
                    $_SESSION['error_message'] = 'Invalid admin password. Please try again.';
                }
            } else {
                $_SESSION['error_message'] = 'Invalid admin username. Please try again.';
            }
        }
    }
}