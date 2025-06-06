  <?php 
include 'config/db.php';
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

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
    <style>
      .glass-card {
    background: rgba(255, 255, 255, 0.1); /* transparent bg */
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    border-radius: 1rem;
  }

    </style>
  </head>

  <body>
  <!-- Idagdag sa header section -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    
    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- Para sa logo -->
    
    <div class="ms-auto d-flex align-items-center">

      <nav class="header-nav">
        <ul class="d-flex align-items-center">
          <!-- DITO NAKALAGAY YUNG SA PROFILE NUNG NAKALOGIN -->
          <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="assets/img/prof.jpg" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2"><?= htmlspecialchars($_SESSION['username']) ?></span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6><?= htmlspecialchars($_SESSION['username']) ?></h6>
                <span><?= htmlspecialchars($_SESSION['role']) ?></span>
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
  <a class="nav-bar" href="Employee.php">
      <i class="bi bi-person-circle"></i>
      <span>Employee List</span>
  </a>
    <a class="nav-bar" href="AuditTrial.php">
      <i class="bi bi-list"></i>
      <span>Audit Trail</span>
  </a>
  <a class="nav-bar" href="AI.php">
      <i class="bi bi-robot"></i>
      <span>AI FORECASTING</span>
  </a>

  
  </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">
  <section class="section dashboard">
  <div class="container mt-5">
  <h2 class="mb-4">Audit Trail Logs</h2>

  <input type="text" class="form-control mb-3" id="searchInput" placeholder="Search logs...">

  <div class="table-responsive">
    <table class="table table-hover table-bordered align-middle" id="auditTable">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Action</th>
          <th>Description</th>
          <th>Module</th>
          <th>Timestamp</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT 
                  at.id,
                  u.username AS user_name,

                  at.action,
                  at.description,
                  at.module,
                  at.timestamp,
                  at.ip_address
                FROM audit_trail at
                JOIN users u ON at.user_id = u.id
                ORDER BY at.timestamp DESC";
        $result = $conn->query($sql);
        $count = 1;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$count}</td>
                        <td>{$row['user_name']}</td>
                        <td>{$row['action']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['module']}</td>
                        <td>{$row['timestamp']}</td>
                      </tr>";
                $count++;
            }
        } else {
            echo "<tr><td colspan='7' class='text-center'>No records found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Template Main JS File -->
    <script src=assets/js/main.js></script>
    <script src="customassets/customjs/signoutnotif.js"></script>
     <script>
  // Search filter
  document.getElementById('searchInput').addEventListener('keyup', function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#auditTable tbody tr');
    rows.forEach(row => {
      row.style.display = [...row.children].some(td => 
        td.textContent.toLowerCase().includes(filter)
      ) ? '' : 'none';
    });
  });
</script> 

  </body>

  </html>