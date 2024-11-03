<?php 
include('customassets/cnn/fetchdata.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Finance</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <!-- Favicons -->
  <link href="assets/img/jeybidi.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="customassets/customcss/signoutnotif.css">
  
</head>

<body>
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- Para sa logo -->
    
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

    <!--  DITO MAGSSTART ANG NOTIFICATION -->
  <li class="nav-item dropdown">
  <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
    <i class="bi bi-bell"></i>
    <span class="badge bg-primary badge-number">4</span> 
  </a>

  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
    <li class="dropdown-header">
      You have 4 new notifications
      <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View All</span></a>
    </li>
    <li><hr class="dropdown-divider"></li>

    <!-- Example notification 1 -->
    <li class="notification-item">
      <a class="dropdown-item d-flex align-items-center" href="notification-link-1.html">
        <i class="bi bi-exclamation-circle text-warning"></i>
        <div>
          <h4>New Alert</h4>
          <p>This is a new alert notification</p>
          <p>5 minutes ago</p>
        </div>
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>

    <!-- Example notification 2 -->
    <li class="notification-item">
      <a class="dropdown-item d-flex align-items-center" href="notification-link-2.html">
        <i class="bi bi-envelope text-info"></i>
        <div>
          <h4>New Message</h4>
          <p>You have a new message from John Doe</p>
          <p>10 minutes ago</p>
        </div>
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>

    <!-- Example notification 3 -->
    <li class="notification-item">
      <a class="dropdown-item d-flex align-items-center" href="notification-link-3.html">
        <i class="bi bi-check-circle text-success"></i>
        <div>
          <h4>Task Completed</h4>
          <p>Your task "Project ABC" is completed</p>
          <p>30 minutes ago</p>
        </div>
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>

    <!-- Example notification 4 -->
    <li class="notification-item">
      <a class="dropdown-item d-flex align-items-center" href="notification-link-4.html">
        <i class="bi bi-info-circle text-primary"></i>
        <div>
          <h4>System Update</h4>
          <p>A new system update is available</p>
          <p>1 hour ago</p>
        </div>
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>

    <li class="dropdown-footer">
      <a href="#">Show all notifications</a>
    </li>
  </ul>
  </li><!-- LAST CODE NUNG NOTIFICATION -->


<!-- DITO NAKALAGAY YUNG SA PROFILE NUNG NAKALOGIN -->
        <li class="nav-item dropdown pe-3">
      
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
            <h6>Admin</h6>
              <span>admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
    <a class="dropdown-item d-flex align-items-center" href="#" onclick="openLogoutModal()">
      <i class="bi bi-box-arrow-right"></i>
      <span>Log Out</span>
    </a>
  </li>
</ul>

                <!-- MODAL PARA SA LOGOUT -->
                <div id="logoutModal" class="custom-modal" style="display: none;">
                <div class="custom-modal-content">
                    <h2>Confirm Logout</h2>
                    <p>Are you sure you want to log out?</p>
                    <div class="modal-buttons">
                    <button onclick="closeLogoutModal()" class="btn-no">No</button>
                    <a href="./signout.php" class="btn-yes">Yes</a>
                    </div>
                </div>
                </div>
                
          
  </li>

    </ul>
    </nav>

  </header>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <div class="flex items-center w-full p-1 pl-6" style="display: flex; align-items: center; padding: 4px; width: 40px; background-color: transparent; height: 4rem;">
        <div class="flex items-center justify-center" style="display: flex; align-items: center; justify-content: center; auto;">
            <img src="assets/img/jeybidi.png" alt="Logo" style="width: 120px; height: auto; margin: 40px;">
        </div>
      </div>
    </div>

    <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link " href="adminhome.php">
          <i class="bi bi-house-door"></i>
          <span>ADMIN HOME</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <hr class="sidebar-divider">

      <li class="nav-heading">MODULES</li>
      <a class="nav-link " href="adminacc.php">
          <i class="bi bi-book"></i>
          <span>Employee Accounts</span>
        </a>

  </aside>

<!-- MAIN Dashboard  -->
  <main id="main" class="main">
    <div class="card">
        <div class="card-body">
        <div class="welcome-text" style="font-size: 8rem; font-weight: bold; color: #333; text-align: center;">
        Welcome to Admin Side
    </div>
</main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; :P
    </div>
    
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  

  <!-- Template Main JS File -->
<script src=assets/js/main.js></script>
<script src="customassets/customjs/signoutnotif.js"></script>
</body>

</html>