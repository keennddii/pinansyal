<?php
include('customassets/cnn/loginconn.php');
// ✅ Check kung naka-login na ang user
if (isset($_SESSION['username'])) {
  header("Location: dashboard.php"); // Redirect sa dashboard
  exit();
}

// ✅ Prevent browser cache (para hindi bumalik sa login page)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login Page | Finance</title>

  <!-- Favicons -->
  <link href="assets/img/jeybidi.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Nunito|Poppins" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="customassets/customcss/login.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">
              <div style="display: flex; align-items: center; justify-content: center; width: 100%; background-color: transparent; height: 4rem;">
                  <div class="flex items-center justify-center"
                    style="display: flex; align-items: center; justify-content: center;">
                    <svg width="250" height="auto" viewBox="0 0 180 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-size="30"
                        font-weight="bold" font-family="Arial Black, sans-serif">
                        <tspan fill="#FFD700">J</tspan>
                        <tspan fill="#00008B">V</tspan>
                        <tspan fill="#FF0000">D</tspan>
                      </text>
                    </svg>
                  </div>
                </div>

                <div class="card-body">
                  <form action="" method="POST">

                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                      <p class="text-center small">Enter your username & password to login</p>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group">
                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">
                          <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                      </div>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <?php if (!empty($_SESSION['error_message'])): ?>
                      <div class="error-message text-danger mt-2"><?php echo $_SESSION['error_message']; ?></div>
                      <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['error_message'])): ?>
                      <div class="error-message text-danger mt-2" id="errorBox">
                        <?php echo $_SESSION['error_message']; ?>
                      </div>
                      <script>startCountdown();</script> <!-- Start countdown -->
                      <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>

                    <br>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="sign-in">Login</button>
                      <br><br>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>


  <script>
    function togglePasswordVisibility() {
      const passwordField = document.getElementById('yourPassword');
      const toggleIcon = document.getElementById('toggleIcon');
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
      } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
      }
    }
  </script>

  <script>
    function startCountdown() {
      var countdownElement = document.getElementById('countdown');
      if (countdownElement) {
        var timeLeft = parseInt(countdownElement.innerText);

        var countdownInterval = setInterval(function () {
          timeLeft--;
          countdownElement.innerText = timeLeft;

          if (timeLeft <= 0) {
            clearInterval(countdownInterval);
            document.getElementById("errorBox").innerHTML = "<span class='text-success'>You can login again!</span>";
          }
        }, 1000);
      }
    }

    window.onload = function () {
      if (document.getElementById('countdown')) {
        startCountdown(); // Auto-start countdown if lockout exists
      }
    };
  </script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>