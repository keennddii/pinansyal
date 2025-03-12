<?php 
include('customassets/cnn/user.php');
include('customassets/cnn/cnncollection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Collection</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <!-- Favicons -->
  <link href="assets/img/jeybidi.png" rel="icon">

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

<!-- DITO NAKALAGAY YUNG SA PROFILE NUNG NAKALOGIN -->
        <li class="nav-item dropdown pe-3">
      
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/prof.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $username;?></span>
          </a>

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
</nav>
</header>


<aside id="sidebar" class="sidebar"><!-- Start ng Side Bar -->

<ul class="sidebar-nav" id="sidebar-nav">

<div class="flex items-center w-full p-1 pl-6" style="display: flex; align-items: center; padding: 4px; width: 40px; background-color: transparent; height: 4rem;">
<div class="flex items-center justify-center" style="display: flex; align-items: center; justify-content: center;">
  <svg width="250" height="auto" viewBox="0 0 180 70" fill="none" xmlns="http://www.w3.org/2000/svg">
    <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-size="30" font-weight="bold" font-family="Arial Black, sans-serif">
      <tspan fill="#FFD700">J</tspan>
      <tspan fill="#00008B">V</tspan>
      <tspan fill="#FF0000">D</tspan>
    </text>
  </svg>
</div>
  </div>
</div>

<hr class="sidebar-divider">

<li class="nav-item">
  <a class="nav-bar" href="dashboard.php">
    <i class="bi bi-house-door"></i>
    <span>Dashboard</span>
  </a>
</li>
<hr class="sidebar-divider">
<li class="nav-heading">MODULES</li>
   
<a class="nav-bar" href="GeneralLedger.php">
    <i class="ri-contacts-book-2-line"></i>
    <span>General Ledger</span>
</a>

<a class="nav-bar" href="AccountPayable.php">
    <i class="ri-secure-payment-line"></i>
    <span>Account Payable</span>
</a>

<a class="nav-bar" href="AccountReceivable.php">
    <i class="ri-secure-payment-line"></i>
    <span>Account Receivable</span>
</a>

<a class="nav-bar" href="Disbursement.php">
    <i class="bi bi-layout-text-window-reverse"></i>
    <span>Disbursement</span>
</a>

<a class="nav-bar" href="Collection.php">
    <i class="ri-draft-line"></i>
    <span>Collection</span>
</a>

<a class="nav-bar" href="BudgetManagement.php">
    <i class="bi bi-currency-dollar"></i>
    <span>Budget Management</span>
</a>

<hr class="sidebar-divider">  
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Collection</h1>
    </div><!-- End Page Title -->

<section class="section dashboard">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Company Bills Record</h4>
            </div>
            <div class="card-card">
                <input type="text" id="search" class="form-control mb-2" placeholder="Search bills...">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bill Type</th>
                            <th>Amount</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="billTable">
                        <?php include('customassets/cnn/fetch_bills.php'); ?>
                    </tbody>
                </table>

                <button class="btn btn-success" onclick="toggleForm()">Add Bill</button>

                <div id="billFormContainer" style="display: none;">
                    <h5 class="mt-4">Add New Bill</h5>
                    <form id="billForm" method="POST" action="add_bill.php">
                        <div class="mb-3">
                            <label class="form-label">Bill Type</label>
                            <select class="form-control" name="bill_type">
                                <option>Electricity</option>
                                <option>Internet</option>
                                <option>Rent</option>
                                <option>Water</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" class="form-control" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Due Date</label>
                            <input type="date" class="form-control" name="due_date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option>Paid</option>
                                <option>Unpaid</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Remarks</label>
                            <textarea class="form-control" name="remarks"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Bill</button>
                        <button type="button" class="btn btn-secondary" onclick="toggleForm()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; 
      FAIR WARNING
      It is highly forbidden to take screenshots, copy and paste, or use other similar techniques to get and distribute content on other platforms.
     <br>
     <br>
      NOTICE It is with deep regret that we inform you that all the financial documents and information shared on this site pertain solely for the use of the <br>  company by the financial officers and administrative staff
      working for the finance department of JVD Event and Travel Management,<br>Co. Unfortunately we have noticed that all the details available on this site were uploaded without proper permission and authorization to other sites. 
    </div>
    
  </footer>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  
  <script src=assets/js/main.js></script>
  <script src="customassets/customjs/signoutnotif.js"></script>
  <script src=customassets/customjs/collection.js></script>
  <script src=customassets/customjs/screenshot.js></script>

</body>
</html>