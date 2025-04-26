  <?php 
  include('customassets/cnn/display.php');
  
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
    
  </head>

  <body>
  <!-- Idagdag sa header section -->
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

      <nav class="header-nav">
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
    </div>
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
  <li class="nav-item">
   
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

    <!-- 📊 Quick Stats Cards -->
    <div class="row g-4 mb-4">
      <div class="col-md-3">
        <div class="card text-white bg-primary h-100">
          <div class="card-body">
            <h5 class="card-title">Total Budget</h5>
            <p class="card-text fs-4 fw-bold" id="dashboardTotalBudget">₱0.00</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-danger h-100">
          <div class="card-body">
            <h5 class="card-title">Used Budget</h5>
            <p class="card-text fs-4 fw-bold" id="dashboardUsedBudget">₱0.00</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-warning h-100">
          <div class="card-body">
            <h5 class="card-title">Unpaid AP</h5>
            <p class="card-text fs-4 fw-bold" id="dashboardUnpaidAP">₱0.00</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-white bg-success h-100">
          <div class="card-body">
            <h5 class="card-title">Total Disbursements</h5>
            <p class="card-text fs-4 fw-bold" id="dashboardDisbursements">₱0.00</p>
          </div>
        </div>
      </div>
    </div>

    <!-- 📈 Charts -->
    <div class="row mb-4">
      <div class="col-lg-6">
        <div class="card h-100">
          <div class="card-header">Budget Usage per Department</div>
          <div class="card-body">
            <canvas id="chartBudgetPerDept" height="200"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card h-100">
          <div class="card-header">Monthly Expenses Trend</div>
          <div class="card-body">
            <canvas id="chartMonthlyExpenses" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>


    <!-- 🔗 Quick Links -->
    <div class="row">
      <div class="col text-center">
        <a href="AccountPayable.php" class="btn btn-outline-secondary me-2">
          <i class="bi bi-secure-payment"></i> Account Payable
        </a>
        <a href="Disbursement.php" class="btn btn-outline-secondary me-2">
          <i class="bi bi-cash-stack"></i> Disbursement
        </a>
        <a href="GeneralLedger.php" class="btn btn-outline-secondary me-2">
          <i class="bi bi-book"></i> General Ledger
        </a>
        <a href="BudgetManagement.php" class="btn btn-outline-secondary">
          <i class="bi bi-currency-dollar"></i> Budget Mgmt
        </a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <!-- Template Main JS File -->
    <script src=assets/js/main.js></script>
    <script src="customassets/customjs/signoutnotif.js"></script>

    <script>
    $(function() {
      // 1) Quick Stats
      $.getJSON('customassets/dashboard/totals.php', function(d) {
        $('#dashboardTotalBudget').text('₱'+d.totalBudget.toLocaleString(undefined,{minimumFractionDigits:2}));
        $('#dashboardUsedBudget').text('₱'+d.usedBudget.toLocaleString(undefined,{minimumFractionDigits:2}));
        $('#dashboardUnpaidAP').text('₱'+d.unpaidAP.toLocaleString(undefined,{minimumFractionDigits:2}));
        $('#dashboardDisbursements').text('₱'+d.totalDisbursements.toLocaleString(undefined,{minimumFractionDigits:2}));
      });

      // 2) Budget per Dept (Bar)
      $.getJSON('customassets/dashboard/budget_per_dept.php', function(depts) {
        const labels    = depts.map(r=>r.department);
        const used      = depts.map(r=>r.used);
        const allocated = depts.map(r=>r.allocated);
        const ctxDept = document.getElementById('chartBudgetPerDept').getContext('2d');
        new Chart(ctxDept, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [
              { label:'Used',      data: used },
              { label:'Allocated', data: allocated }
            ]
          }
        });
      });

      // 3) Monthly Expenses Trend (Line)
      $.getJSON('customassets/dashboard/monthly_expenses.php', function(months) {
        const labels = months.map(r=>r.month);
        const data   = months.map(r=>r.expense);
        const ctxExp = document.getElementById('chartMonthlyExpenses').getContext('2d');
        new Chart(ctxExp, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [
              { label:'Expenses', data: data }
            ]
          }
        });
      });
    });
    </script>
  </body>

  </html>