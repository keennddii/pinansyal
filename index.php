<?php 
include('cnn/connection.php');
include('cnn/connections.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Finance Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <!-- Favicons -->
  <link href="assets/img/jvd.jpg" rel="icon">
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
  <link rel="stylesheet" href="customcss/signoutnotif.css">
  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
  <label class="switch">
        <input type="checkbox" id="toggle" onclick="myFunction()">
        <span class="slider round">
            <i class="bi bi-moon-stars-fill" id="sun-icon"></i>
            <i class="bi bi-sun-fill" id="moon-icon"></i>
        </span>
      </label>
    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->
    
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
  </li><!-- CODE NUNG NOTIFICATION -->


<!-- DITO NAKALAGAY YUNG SA PROFILE NUNG NAKALOGIN -->
        <li class="nav-item dropdown pe-3">
      
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $username;?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
            <h6><?php echo $username; ?></h6>
              <span><?php echo $position; ?> </span>
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

<!-- Custom Logout Modal -->
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
 
          
  </li><!-- LAST LINE NUNG PROFILE  -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

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
        <a class="nav-link " href="index.php">
          <i class="bi bi-house-door"></i>
          <span>Homepage</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <hr class="sidebar-divider">

      <li class="nav-heading">MODULES</li>

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#disbursement-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-layout-text-window-reverse"></i><span>Disbursement</span><i class="bi bi-arrow-bar-down ms-auto"></i>
  </a>
  <ul id="disbursement-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    <li>
      <a href="dExpense.php">
        <i class="bi bi-circle-fill"></i><span>Expense Management</span>
      </a>
    </li>
    <li>
      <a href="dPayrollManagement.php">
        <i class="bi bi-circle-fill"></i><span>Payroll Management</span>
      </a>
    </li>
    <li>
      <a href="dFinancialIntegration.php">
        <i class="bi bi-circle-fill"></i><span>Financial Integration</span>
      </a>
    </li>
  </ul>
</li><!-- End Disbursement Nav -->



<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#budget-management-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-currency-dollar"></i><span>Budget Management</span><i class="bi bi-arrow-bar-down ms-auto"></i>
  </a>
  <ul id="budget-management-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
  <li>
      <a href="bPayrollReporting.php">
        <i class="bi bi-circle-fill"></i><span>Payroll Reporting</span>
      </a>
    </li>
    <li>
      <a href="bTaxManagement.php">
        <i class="bi bi-circle-fill"></i><span>Tax Management</span>
      </a>
    </li>
    <li>
      <a href="bAuditCompliance.php">
        <i class="bi bi-circle-fill"></i><span>Audit & Compliance</span>
        </a>
    </li>
    <li>
      
      <a href="gCashFlow.php">
        <i class="bi bi-circle-fill"></i><span>Cash Flow Management</span>
      </a>
    </li>
  </ul>
</li>
<!-- End Budget Management Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#collection-nav" data-bs-toggle="collapse" href="#">
    <i class="ri-draft-line"></i><span>Collection</span><i class="bi bi-arrow-bar-down ms-auto"></i>
  </a>
  <ul id="collection-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    <li>
      <a href="cInvoicingBilling.php">
        <i class="bi bi-circle-fill"></i><span>Invoicing & Billing</span>
      </a>
    </li>
    <li>
      <a href="cBookingRevenue.php">
        <i class="bi bi-circle-fill"></i><span>Booking & Revenue Management</span>
      </a>
    </li>
    <li>
      <a href="cFinancialIntegration.php">
        <i class="bi bi-circle-fill"></i><span>Financial Integration</span>
      </a>
    </li>
  </ul>
</li><!-- End Collection Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#general-ledger-nav" data-bs-toggle="collapse" href="#">
    <i class="ri-contacts-book-2-line"></i><span>General Ledger</span><i class="bi bi-arrow-bar-down ms-auto"></i>
  </a>
  <ul id="general-ledger-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
  <li>
      <a href="gGeneralLedger.php">
        <i class="bi bi-circle-fill"></i><span>General Ledger Management</span>
      </a>
    </li>
    <li>
      <a href="gBookingRevenue.php">
        <i class="bi bi-circle-fill"></i><span>Booking  & Revenue Management</span>
      </a>
    </li>
    <li>
      <a href="gFinancialReportingAnalysis.php">
        <i class="bi bi-circle-fill"></i><span>Financial Reporting & Analysis</span>
      </a>
    </li>
    <li>
      <a href="gFinancialAnalytics.php">
        <i class="bi bi-circle-fill"></i><span>Financial Analytics</span>
      </a>
    </li>
  </ul>
</li><!-- End General Ledger Nav -->
<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#account-payable-nav" data-bs-toggle="collapse" href="#">
    <i class="ri-secure-payment-line"></i><span>Account Payable/Receivable</span><i class="bi bi-arrow-bar-down ms-auto"></i>
  </a>
  <ul id="account-payable-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    <li>
      <a href="aprInvoiceBilling.php">
        <i class="bi bi-circle-fill"></i><span>Invoice & Billing Management</span>
      </a>
    </li>
    <li>
      <a href="aprFinancialIntegration.php">
        <i class="bi bi-circle-fill"></i><span>Financial Integration</span>
      </a>
    </li>
  </ul>
</li><!-- End Account Payable/Receivable Nav -->

      <hr class="sidebar-divider">  
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

      

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>XXXXXX</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      BCP
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
  <script src="customjs/signoutnotif.js"></script>

</body>

</html>