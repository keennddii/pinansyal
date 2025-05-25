<?php
  include('customassets/cnn/display.php');
  include 'customassets/AP/cnnpayable.php';
  
$query = "SELECT * FROM payable_requests WHERE status = 'Pending'";
$result = mysqli_query($conn, $query);
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Vendor CSS Files -->
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
    <div class="ms-auto d-flex align-items-center">

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

  <aside id="sidebar" class="sidebar">
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
      </li>
    </ul>
  </aside>

<main id="main" class="main">
  <section class="section dashboard">
    <!-- Trigger Button -->
<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#payableRequestModal">New Request</button>


    <h4 class="mb-3 fw-bold">Pending Payable Requests</h4>

    <!-- Modern Table -->
    <div class="table-responsive rounded shadow-sm">
      <table class="table table-hover align-middle table-bordered">
        <thead class="table-light">
          <tr>
            <th>Payee</th>
            <th>Amount</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?= htmlspecialchars($row['payee']) ?></td>
            <td>₱<?= number_format($row['amount'], 2) ?></td>
            <td><?= htmlspecialchars($row['due_date']) ?></td>
            <td>
              <span class="badge bg-warning text-dark"><?= htmlspecialchars($row['status']) ?></span>
            </td>
            <td>
              <button class="btn btn-success btn-sm rounded-pill approve-btn" data-id="<?= $row['id'] ?>">Approve</button>
            <button class="btn btn-danger btn-sm rounded-pill reject-btn" data-id="<?= $row['id'] ?>">Reject</button>

            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

<!-- Payable Request Modal -->
<div class="modal fade" id="payableRequestModal" tabindex="-1" aria-labelledby="payableRequestModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow rounded-4 border-0">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title" id="payableRequestModalLabel">New Payable Request</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="customassets/AP/submit_payable_request.php" method="POST">
        <div class="modal-body py-4 px-5">
          <div class="row g-4">
            <div class="col-md-6">
              <label for="pr_payee" class="form-label fw-semibold">Payee</label>
              <input type="text" class="form-control rounded-3" id="pr_payee" name="payee" required>
            </div>
            <div class="col-md-6">
              <label for="pr_amount" class="form-label fw-semibold">Amount</label>
              <input type="number" step="0.01" class="form-control rounded-3" id="pr_amount" name="amount" required>
            </div>
            <div class="col-md-6">
              <label for="pr_due_date" class="form-label fw-semibold">Due Date</label>
              <input type="date" class="form-control rounded-3" id="pr_due_date" name="due_date" required>
            </div>
            <div class="col-md-6">
              <label for="pr_department_id" class="form-label fw-semibold">Department</label>
              <select class="form-select rounded-3" id="pr_department_id" name="department_id" required>
                <option value="">-- Select Department --</option>
                <?php
                  if (isset($conn)) {
                    $departments = $conn->query("SELECT id, name FROM departments");
                    while ($dept = $departments->fetch_assoc()):
                ?>
                    <option value="<?= $dept['id'] ?>"><?= htmlspecialchars($dept['name']) ?></option>
                <?php 
                    endwhile;
                  }
                ?>
              </select>
            </div>
            <div class="col-12">
              <label for="pr_account_id" class="form-label fw-semibold">Expense Account</label>
              <select class="form-select rounded-3" id="pr_account_id" name="account_id" required>
                <option value="">-- Select Expense Account --</option>
                <optgroup label="For HR Department">
                  <option value="9">Salaries and Wages Expense</option>
                  <option value="10">Training and Development Expense</option>
                  <option value="14">Communication Expense</option>
                </optgroup>
                <optgroup label="For Core Department">
                  <option value="6">Travel Expense</option>
                  <option value="7">Utilities Expense</option>
                  <option value="13">Repair and Maintenance Expense</option>
                  <option value="15">Professional Fee Expense</option>
                </optgroup>
                <optgroup label="For Logistics Department">
                  <option value="8">Supplies Expense</option>
                  <option value="11">Office Supplies Expense</option>
                  <option value="12">Transportation Expense</option>
                </optgroup>
              </select>
            </div>
            <div class="col-12">
              <label for="pr_remarks" class="form-label fw-semibold">Remarks</label>
              <textarea class="form-control rounded-3" id="pr_remarks" name="remarks" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3">
          <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary rounded-pill">Submit Request</button>
        </div>
      </form>
    </div>
  </div>
</div>

  </section>
</main>



  <!-- Footer -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; FAIR WARNING
      It is highly forbidden to take screenshots, copy and paste, or use other similar techniques to get and distribute content on other platforms.
      <br><br>
      NOTICE: All the financial documents and information shared on this site pertain solely for the use of the company by the financial officers and administrative staff working for the finance department of JVD Event and Travel Management, Co.
      <br>
      Please note that the details available on this site were uploaded without proper permission and should not be distributed.
    </div>
  </footer>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="customassets/customjs/signoutnotif.js"></script>
<script>
  document.querySelectorAll('.approve-btn').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.getAttribute('data-id');

      Swal.fire({
        title: 'Approve Request?',
        text: "You want to approve this?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, Approve',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `customassets/AP/approve_request.php?id=${id}`;
        }
      });
    });
  });

  document.querySelectorAll('.reject-btn').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.getAttribute('data-id');

      Swal.fire({
        title: 'Reject Request?',
        text: "You want to reject this?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Reject',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `customassets/AP/reject_request.php?id=${id}`;
        }
      });
    });
  });
</script>

</body>
</html>
