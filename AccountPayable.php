<?php
  include('customassets/cnn/display.php');
  include 'customassets/AP/cnnpayable.php';
  $total_payables = 0;
  $total_disbursed = 0;
  $remaining_payables = 0;
  
  
  $sql = "SELECT 
              COALESCE(SUM(amount), 0) AS total,
              COALESCE(SUM(CASE WHEN status = 'Paid' THEN amount ELSE 0 END), 0) AS disbursed
          FROM accounts_payable";
  $result = $conn->query($sql);
  
  if ($row = $result->fetch_assoc()) {
      $total_payables = $row['total'];
      $total_disbursed = $row['disbursed'];
      $remaining_payables = $total_payables - $total_disbursed;
  }
  
  
  $payables = $conn->query("SELECT * FROM accounts_payable ORDER BY id DESC");
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
  <!-- Header Section -->
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

  <!-- Sidebar -->
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

  <!-- Main Content -->
  <main id="main" class="main">
  <section class="section dashboard">
      <h2 class="mb-4">Accounts Payable</h2>
        <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addPayableModal">
      <i class="bi bi-plus-circle me-1"></i> New Payable
    </button>
  </div>

<!-- Summary Cards -->
<div class="row mb-4 g-4">
  <div class="col-md-4">
    <div class="card shadow-sm border-0 rounded-3">
      <div class="card-body">
        <h6 class="text-muted">Total Payables</h6>
        <h3 class="fw-bold text-primary">₱<?= number_format($total_payables, 2) ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm border-0 rounded-3">
      <div class="card-body">
        <h6 class="text-muted">Total Disbursed</h6>
        <h3 class="fw-bold text-success">₱<?= number_format($total_disbursed, 2) ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm border-0 rounded-3">
      <div class="card-body">
        <h6 class="text-muted">Remaining Payables</h6>
        <h3 class="fw-bold text-danger">₱<?= number_format($remaining_payables, 2) ?></h3>
      </div>
    </div>
  </div>
</div>


  <!-- Payables Table -->
  <div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0 fw-semibold">Recent Payables</h5> 
    <input type="text" class="form-control w-25" id="searchInput" placeholder="Search...">
    </div>
    <div class="card-body p-0">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0" id="payablesTable">
      <thead class="table-light">
        <tr>
          <th>Payee</th>
          <th>Remarks</th>
          <th>Amount</th>
          <th>Due Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $payables->fetch_assoc()): ?>
        <tr>
          <td><?= ucwords(strtolower(htmlspecialchars($row['payee']))) ?></td>
          <td><?= ucfirst(htmlspecialchars($row['remarks'])) ?></td>
          <td>₱<?= number_format($row['amount'], 2) ?></td>
          <td><?= date('M d, Y', strtotime($row['due_date'])) ?></td>
          <td>
            <?php if ($row['status'] == 'Paid'): ?>
              <span class="badge bg-success">Paid</span>
            <?php elseif ($row['status'] == 'Partially Paid'): ?>
              <span class="badge bg-primary">Partially Paid</span>
            <?php elseif ($row['status'] == 'Voided'): ?>
              <span class="badge bg-secondary">Voided</span>
            <?php else: ?>
              <span class="badge bg-warning text-dark">Unpaid</span>
            <?php endif; ?>
          </td>
          <td>
            <?php if ($row['status'] == 'Unpaid' || $row['status'] == 'Partially Paid'): ?>
              <button class="btn btn-sm btn-outline-primary" onclick="openDisburseModal(<?= $row['id'] ?>)">View</button>
              <button class="btn btn-sm btn-outline-danger" onclick="voidPayable(<?= $row['id'] ?>)">Void</button>
            <?php else: ?>
              <button class="btn btn-sm btn-outline-secondary" disabled>Processed</button>
            <?php endif; ?>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

  </div>

  <!-- Add Bill Modal -->
<div class="modal fade" id="addPayableModal" tabindex="-1" aria-labelledby="addBillModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addBillForm" method="POST" action="customassets/AP/save_payable.php">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="addBillModalLabel">Add New Payable</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label for="payee" class="form-label">Payee Name</label>
            <input type="text" class="form-control" id="payee" name="payee" required>
          </div>

          <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" step="0.01" id="amount" name="amount" required>
          </div>

          <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" class="form-control" id="due_date" name="due_date" required>
          </div>
           
          <div class="mb-3">
          <label for="department_io" class="form-label">Department</label>
          <select class="form-select" id="department_id" name="department_id" required>
            <option value="">-- Select Department --</option>
            <?php
              $departments = $conn->query("SELECT id, name FROM departments");
              while ($dept = $departments->fetch_assoc()):
            ?>
              <option value="<?= $dept['id'] ?>"><?= htmlspecialchars($dept['name']) ?></option>
            <?php endwhile; ?>
          </select>
          </div>
          
          <div class="mb-3">
            <label for="account_id" class="form-label">Account</label>
            <select class="form-select" id="account_id" name="account_id" required>
              <option value="">-- Select Expense Account --</option>
              <option value="6">Travel Expense</option>
              <option value="7">Utilities Expense</option>
              <option value="8">Supplies Expense</option>
              <!-- Add more accounts as needed -->
            </select>
          </div>
          
          <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Payable</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Disbursement Details -->
<div class="modal fade" id="disburseModal" tabindex="-1" aria-labelledby="disburseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="disburseForm" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="disburseModalLabel">Disburse Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="disburse_payable_id" name="payable_id">

          <div class="alert alert-light border mb-3">
          <p class="mb-1"><strong>Original Amount:</strong> ₱<span id="modal_total_amount">0.00</span></p>
          <p class="mb-1"><strong>Total Paid:</strong> ₱<span id="modal_total_paid">0.00</span></p>
          <p class="mb-0"><strong>Remaining Balance:</strong> ₱<span id="modal_balance">0.00</span></p>
          </div>
        </div>
      </div>
    </form>
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
document.getElementById('addBillForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const form = this;
  const formData = new FormData(form);

  fetch('customassets/AP/save_payable.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        title: 'Success!',
        text: data,
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('addPayableModal'));
        modal.hide();
        form.reset();
        location.reload();
      });
    } else {
      alert(data);
      const modal = bootstrap.Modal.getInstance(document.getElementById('addPayableModal'));
      modal.hide();
      form.reset();
      location.reload();
    }
  })
  .catch(err => {
    console.error('Error:', err);
    alert('Something went wrong.');
  });
});

function openDisburseModal(id) {
  document.getElementById('disburse_payable_id').value = id;

  // Get data via AJAX
  fetch('customassets/AP/fetch_payable.php?id=' + id)
    .then(res => res.json())
    .then(data => {
      document.getElementById('modal_total_amount').textContent = parseFloat(data.amount).toLocaleString('en-PH', { minimumFractionDigits: 2 });
      document.getElementById('modal_total_paid').textContent = parseFloat(data.total_paid).toLocaleString('en-PH', { minimumFractionDigits: 2 });
      document.getElementById('modal_balance').textContent = parseFloat(data.remaining).toLocaleString('en-PH', { minimumFractionDigits: 2 });

      // Show modal
      const disburseModal = new bootstrap.Modal(document.getElementById('disburseModal'));
      disburseModal.show();
    });
}
</script>
<script>
document.getElementById('disburseForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const form = this;
  const formData = new FormData(form);

  Swal.fire({
    title: 'Confirm Disbursement',
    text: "Are you sure you want to disburse this payment?",
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Yes, Disburse',
    cancelButtonText: 'Cancel',
    showLoaderOnConfirm: true,
    preConfirm: () => {
      return fetch('customassets/AP/save_disbursement.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network error');
        }
        return response.json(); // <<--- take note JSON na!
      })
      .catch(error => {
        Swal.showValidationMessage(`Request failed: ${error}`);
      });
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then(result => {
    if (result.isConfirmed) {
      const response = result.value;
      if (!response) {
        Swal.fire('Error', 'Something went wrong.', 'error');
        return;
      }

      if (response.status === 'success') {
        Swal.fire({
          title: 'Success!',
          text: response.message,
          icon: 'success'
        }).then(() => {
          const modal = bootstrap.Modal.getInstance(document.getElementById('disburseModal'));
          modal.hide();
          form.reset();
          location.reload();
        });
      } else if (response.status === 'error') {
        Swal.fire({
          title: 'Error',
          text: response.message,
          icon: 'error'
        });
      }
    }
  });
});

function voidPayable(id) {
  Swal.fire({
    title: 'Are you sure?',
    text: "This payable will be marked as Voided.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, Void it!',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      fetch('customassets/AP/void_payable.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + id
      })
      .then(response => response.text())
      .then(data => {
        Swal.fire('Voided!', data, 'success').then(() => {
          location.reload();
        });
      })
      .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'Something went wrong.', 'error');
      });
    }
  });
}

</script>

<!-- Search Script -->
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
  const filter = this.value.toLowerCase();
  const rows = document.querySelectorAll('#payablesTable tbody tr');

  let visibleCount = 0;

  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    const match = text.includes(filter);
    row.style.display = match ? '' : 'none';
    if (match) visibleCount++;
  });

  if (visibleCount === 0) {
    const tbody = document.querySelector('#payablesTable tbody');
    tbody.innerHTML = `
      <tr>
        <td colspan="6" class="text-center text-muted py-4">No records found.</td>
      </tr>
    `;
  }
});
</script>
</body>
</html>
