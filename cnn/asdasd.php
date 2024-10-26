<?php
include("cnn/connections.php");

// Initialize an error message variable
$error_message = ""; // Default message

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($_POST['sign-in'])) {
        if (!empty($username) && !empty($password)) {
            // Prepare and bind
            $stmt = $con->prepare("SELECT * FROM tbl_finance_login1 WHERE username = ? LIMIT 1");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if (mysqli_num_rows($result) == 1) {
                // Assuming password verification logic here (e.g., password_verify)
                if (password_verify($password, $row['password'])) {
                    $_SESSION['username'] = $username;
                    header("Location: index.php");
                    exit;
                }
            } else {
                // Invalid username or password
                $_SESSION['error_message'] = 'Invalid username or password. Please try again.';
            }
        } else {
            $_SESSION['error_message'] = 'Please enter a valid username and password.';
        }
    }
}

