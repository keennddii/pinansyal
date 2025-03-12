<?php
session_start();
include("connections.php");

// I-set ang max attempts at cooldown time
$max_attempts = 5;
$lockout_time = 30; // 30 seconds cooldown

// I-initialize ang session variables kung wala pa
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
if (!isset($_SESSION['lockout_time'])) {
    $_SESSION['lockout_time'] = 0;
}

// Check kung naka-lockout
if ($_SESSION['login_attempts'] >= $max_attempts && $_SESSION['lockout_time'] > time()) {
    $remaining_time = $_SESSION['lockout_time'] - time();
    $_SESSION['error_message'] = "Too many failed attempts. Try again in <span id='countdown'>$remaining_time</span> seconds.";
} 

// Kapag lumipas na ang cooldown, I-RESET ang attempts at bigyan ng success message
if ($_SESSION['lockout_time'] <= time() && $_SESSION['login_attempts'] >= $max_attempts) {
    $_SESSION['login_attempts'] = 0; // Reset login attempts
    $_SESSION['lockout_time'] = 0; // Reset lockout time
}

// Process login kung walang active lockout
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SESSION['lockout_time'] <= time()) {
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
                    $_SESSION['login_attempts'] = 0; // Reset attempts
                    $_SESSION['lockout_time'] = 0; // Reset lockout timer
                    header("Location: dashboard.php");
                    exit;
                } else {
                    $_SESSION['error_message'] = 'Invalid password. Please try again.';
                    $_SESSION['login_attempts']++;
                }
            } else {
                $_SESSION['error_message'] = 'Invalid username. Please try again.';
                $_SESSION['login_attempts']++;
            }
        }

        // Kung umabot na sa max attempts, i-set ang lockout timer
        if ($_SESSION['login_attempts'] >= $max_attempts) {
            $_SESSION['lockout_time'] = time() + $lockout_time; // Lock for 30 seconds
            $_SESSION['error_message'] = "Too many failed attempts. Try again in <span id='countdown'>$lockout_time</span> seconds.";
        }
    }
}
?>
