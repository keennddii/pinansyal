<?php 
include('connection.php');
include('connections.php');
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
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
      
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="javascript:if(confirm('Are you sure you want to log out?')){window.location.href='./signout.php'}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>

            </li>
        
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

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

   
    <div class="card">
            <div class="card-body">
              <h5 class="card-title">Default Table</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Grosspay</th>
                    <th scope="col">SSS</th>
                    <th scope="col">PhilHealth</th>
                    <th scope="col">Pag-Ibig</th>
                    <th scope="col">SSS loan</th>
                    <th scope="col">Home loan</th>
                    <th scope="col">Total Deduction</th>
                    <th scope="col">Net Pay</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td>35</td>
                    <td>2014-12-05</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Ashleigh Langosh</td>
                    <td>Finance</td>
                    <td>45</td>
                    <td>2011-08-12</td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Angus Grady</td>
                    <td>HR</td>
                    <td>34</td>
                    <td>2012-06-11</td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Raheem Lehner</td>
                    <td>Dynamic Division Officer</td>
                    <td>47</td>
                    <td>2011-04-19</td>
                  </tr>
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>

      <div style="text-align: right; margin-top: 20px;">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; :P <strong><span></span></strong>
    </div>
    <div class="credits">
     
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
  <script src="assets/js/main.js"></script>
 

</body>

</html>