<?php
include('customassets/cnn/user.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Account Receivable</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/jeybidi.png" rel="icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">

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
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $username; ?></span>
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

      <div class="flex items-center w-full p-1 pl-6"
        style="display: flex; align-items: center; padding: 4px; width: 40px; background-color: transparent; height: 4rem;">
        <div class="flex items-center justify-center"
          style="display: flex; align-items: center; justify-content: center;">
          <svg width="250" height="auto" viewBox="0 0 180 70" fill="none" xmlns="http://www.w3.org/2000/svg">
            <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-size="30" font-weight="bold"
              font-family="Arial Black, sans-serif">
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


<section class="section dashboard">
<h2>Collection</h2>

<div class="table-responsive">

<div class="row mb-4">
    <div class="col-md-3">
        <input type="text" id="filterClient" class="form-control" placeholder="Search by Client Name" oninput="filterPayments()">
    </div>
    <div class="col-md-2">
        <select id="filterStatus" class="form-control" onchange="filterPayments()">
            <option value="">All Status</option>
            <option value="Paid">Paid</option>
            <option value="Unpaid">Unpaid</option>
        </select>
    </div>
    <div class="col-md-2">
        <input type="date" id="filterFrom" class="form-control" onchange="filterPayments()">
    </div>
    <div class="col-md-2">
        <input type="date" id="filterTo" class="form-control" onchange="filterPayments()">
    </div>
</div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Invoice No.</th>
                <th>Amount Paid</th>
                <th>Payment Method</th>
                <th>Date of Payment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="collectionTable">
            <?php
                // Fetch collection data from the database
                include('customassets/CL/fetch_collection.php');
            ?>
        </tbody>
    </table>
</div>

<!-- View Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="detailsModalLabel">Invoice Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="detailsContent">
              <!-- Details will be loaded here dynamically -->
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
      It is highly forbidden to take screenshots, copy and paste, or use other similar techniques to get and distribute
      content on other platforms.
      <br>
      <br>
      NOTICE It is with deep regret that we inform you that all the financial documents and information shared on this
      site pertain solely for the use of the <br> company by the financial officers and administrative staff
      working for the finance department of JVD Event and Travel Management,<br>Co. Unfortunately we have noticed that
      all the details available on this site were uploaded without proper permission and authorization to other sites.
    </div>

  </footer>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
  <script src=customassets/customjs/screenshot.js></script>
  <script>
function openDetailsModal(id) {
    // Ajax fetch details
    fetch('customassets/CL/get_payment_details.php?id=' + id)
    .then(response => response.text())
    .then(data => {
        document.getElementById('detailsContent').innerHTML = data;
        var detailsModal = new bootstrap.Modal(document.getElementById('detailsModal'));
        detailsModal.show();
    });
}

function filterPayments() {
    var clientName = document.getElementById('filterClient').value;
    var status = document.getElementById('filterStatus').value;
    var fromDate = document.getElementById('filterFrom').value;
    var toDate = document.getElementById('filterTo').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'filter_collection.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status == 200) {
            document.getElementById('collectionTable').innerHTML = xhr.responseText;
        }
    };

    xhr.send(
        'client_name=' + encodeURIComponent(clientName) +
        '&status=' + encodeURIComponent(status) +
        '&from_date=' + encodeURIComponent(fromDate) +
        '&to_date=' + encodeURIComponent(toDate)
    );
}



</script>
    

</body>

</html>