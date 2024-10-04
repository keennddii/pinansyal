<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
  
  
    if (isset($_POST['sign-in'])) {
        // Sign-In
        if (!empty($username) && !empty($password)) {
            // Check kung tama info sa databse
            $query = "SELECT * FROM tbl_finance_login1 WHERE username='$username' AND password='$password'";
            $result = mysqli_query($con, $query);
  
            if (mysqli_num_rows($result) == 1) {
                // Successful sign-in
                $_SESSION['username'] = $username;
                header("Location: index.php");
                die;
            } else {
                echo '<div class="error-message">Invalid username or password. Please try again.</div>';
            }
        } 
        else {
            echo '<div class="error-message">Please enter a valid username and password.</div>';
        }
    } 
  }
  