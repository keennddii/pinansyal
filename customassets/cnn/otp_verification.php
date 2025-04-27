<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $entered_otp = trim($_POST['otp']);

    // Check if OTP matches
    if ($entered_otp == $_SESSION['otp']) {
        // OTP is correct, redirect to dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
    <!-- Your usual CSS & JS includes -->
</head>
<body>
    <!-- Modal for OTP Verification -->
    <div class="modal" tabindex="-1" style="display: block; padding-left: 0px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enter OTP</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="otp">Enter OTP</label>
                            <input type="text" class="form-control" name="otp" id="otp" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Verify OTP</button>
                    </form>

                    <?php if (!empty($_SESSION['error_message'])): ?>
                        <div class="error-message text-danger mt-2"><?php echo $_SESSION['error_message']; ?></div>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Optionally, if you want to add a countdown to OTP expiry
    </script>
</body>
</html>
