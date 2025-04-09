<?php 
include('customassets/cnn/user.php');
include('customassets/collection/cnncollection.php');
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
  <link rel="stylesheet" href="customassets/customcss/darkmode.css">
  <link rel="stylesheet" href="customassets/customcss/random.css">
</head>

<body>
  
  <header id="header" class="header fixed-top d-flex align-items-center">
  
    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- Para sa logo -->

    <div class="ms-auto d-flex align-items-center">
    <!-- Dark Mode Toggle Button -->
    <button class="theme-toggle" id="theme-toggle">
      <i class="bi bi-moon-fill" id="theme-icon"></i>
    </button>
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
  <div class="col-12">
    
    <!-- Toast Notification -->
    <div id="toastContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
      <div id="successToast" class="toast align-items-center text-white bg-success border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body fw-bold" id="toastMessage"></div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>

    <!-- Main Card -->
    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Company Bills Record</h4>
      </div>

      <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
<!-- Button to trigger the modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#collectionModal"> Collect Payment</button>
        </div>

        <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Client Name</th>
                <th>Invoice No.</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Date of Payment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="billTable">
            <?php include('customassets/collection/fetch_bills.php'); ?>
        </tbody>
        </table>
        </div>

<!-- Collection Modal Form -->
<div class="modal fade" id="collectionModal" tabindex="-1" aria-labelledby="collectionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shadow rounded-4">
      
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold" id="collectionModalLabel">Collect Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form id="collectionForm" method="post" action="customassets\collection\add_bill.php">
          
          <div class="mb-3">
            <label for="clientName" class="form-label fw-semibold">Client Name</label>
            <input type="text" name="client_name" class="form-control rounded-3" id="clientName" required>
          </div>

          <div class="mb-3">
            <label for="invoiceNumber" class="form-label fw-semibold">Invoice Number</label>
            <input type="text" name="invoice_number" class="form-control rounded-3" id="invoiceNumber" required>
          </div>

          <div class="mb-3">
            <label for="amountPaid" class="form-label fw-semibold">Amount Paid (₱)</label>
            <input type="number" name="amount_paid" class="form-control rounded-3" id="amountPaid" required>
          </div>

          <div class="mb-3">
            <label for="paymentMethod" class="form-label fw-semibold">Payment Method</label>
            <select name="payment_method" id="paymentMethod" class="form-select rounded-3" required>
              <option value="" disabled selected>Select Method</option>
              <option value="Cash">Cash</option>
              <option value="Bank Transfer">Bank Transfer</option>
              <option value="Credit Card">Credit Card</option>
              <option value="Cheque">Cheque</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="paymentDate" class="form-label fw-semibold">Date of Payment</label>
            <input type="date" name="payment_date" class="form-control rounded-3" id="paymentDate" required>
          </div>

          <div class="mb-3">
            <label for="remarks" class="form-label fw-semibold">Remarks</label>
            <textarea name="remarks" class="form-control rounded-3" id="remarks" rows="3"></textarea>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-success rounded-3">Submit Collection</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>


      </div> <!-- End Card Body -->

    </div> <!-- End Card -->

  </div>
</section>

<!-- Delete Modal -->
<div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this bill?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="successMessage"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

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
  
  <script src="assets/js/main.js"></script>
  <script src="customassets/customjs/signoutnotif.js"></script>
  <script src="customassets/customjs/collection.js"></script>
  <script src="customassets/customjs/screenshot.js"></script>
  <script src="customassets/customjs/darkmode.js"></script>
  <script>
  function showToast(message) {
    document.getElementById("toastMessage").innerText = message;
    var toast = new bootstrap.Toast(document.getElementById("successToast"));
    toast.show();
}
</script>
  <script>
    function showSuccessModal(message) {
    document.getElementById("successMessage").innerText = message;
    var successModal = new bootstrap.Modal(document.getElementById("successModal"));
    successModal.show();
}

  </script>
</body>
</html>