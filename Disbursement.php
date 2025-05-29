<?php
  include('customassets/cnn/display.php');
  include 'customassets/AP/cnnpayable.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Disbursement</title>
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
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="fw-bold text-primary">Disbursement Records</h3>
      <button class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#disburseModal">
        <i class="bi bi-plus-circle"></i> Add Disbursement
      </button>
    </div>

    <div class="card shadow-sm rounded-4 border-0">
      <div class="card-body">
        <div class="table-responsive">
          <table id="disbursementTableMain" class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>Payable ID</th>
                <th>Date</th>
                <th>Amount Paid</th>
                <th>Payment Method</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody id="disbursementTable">
              <!-- Dynamic rows -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Modal -->
<div class="modal fade" id="disburseModal" tabindex="-1" aria-labelledby="disburseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="disburseForm" class="needs-validation" novalidate>
      <div class="modal-content shadow rounded-4 border-0">
        <div class="modal-header bg-primary text-white rounded-top-4">
          <h5 class="modal-title fw-semibold" id="disburseModalLabel">
            <i class="bi bi-cash-coin me-2"></i> Add Disbursement
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4 row g-4">
          <!-- Left Side Form -->
          <div class="col-md-6">
            <div class="mb-3">
              <label for="payable_id" class="form-label">Select Payable</label>
              <select class="form-select" id="payable_id" name="payable_id" required>
                <option value="">-- Select --</option>
              </select>
              <div class="invalid-feedback">Please select a payable.</div>
            </div>

            <div class="mb-3">
              <label for="disbursement_date" class="form-label">Disbursement Date</label>
              <input type="date" class="form-control" name="disbursement_date" required>
              <div class="invalid-feedback">Please provide a date.</div>
            </div>

            <div class="mb-3">
              <label for="payment_method" class="form-label">Payment Method</label>
              <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="">Select method</option>
                <option value="Cash">Cash</option>
                <option value="Check">Check</option>
                <option value="Bank Transfer">Bank Transfer</option>
              </select>
              <div class="invalid-feedback">Please choose a method.</div>
            </div>

            <div class="mb-3">
              <label for="disburse_amount" class="form-label">Amount</label>
              <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="number" step="0.01" class="form-control" name="disburse_amount" required>
              </div>
              <div class="invalid-feedback">Enter a valid amount.</div>
            </div>

            <div class="mb-3">
              <label for="disburse_remarks" class="form-label">Remarks</label>
              <textarea class="form-control" name="disburse_remarks" rows="3" placeholder="Optional..."></textarea>
            </div>
          </div>

          <!-- Right Side Info -->
          <div class="col-md-6">
            <div class="bg-light rounded-4 p-4 shadow-sm h-100 border">
              <h6 class="mb-3 text-primary fw-bold">Payable Details</h6>
              <div id="payableDetails">
                <p class="text-muted fst-italic">Select a payable to view its details.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer px-4 py-3 bg-light rounded-bottom-4">
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-check-circle me-1"></i> Submit
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i> Cancel
          </button>
        </div>
      </div>
    </form>
  </div>
</div>


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
document.addEventListener('DOMContentLoaded', () => {
  const disburseForm = document.getElementById('disburseForm');
  const disbursementTable = document.getElementById('disbursementTable');
  const payableSelect = document.getElementById('payable_id');
  const payableDetails = document.getElementById('payableDetails');

  disburseForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    try {
      const response = await fetch('customassets/DS/save_disbursements.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.text();
      const isSuccess = result.toLowerCase().includes('successfully');

      Swal.fire({
        icon: isSuccess ? 'success' : 'error',
        title: isSuccess ? 'Success!' : 'Oops!',
        text: result,
        confirmButtonColor: '#3085d6'
      }).then(() => {
        if (isSuccess) {
          this.reset();
          bootstrap.Modal.getInstance(document.getElementById('disburseModal')).hide();
          loadDisbursementTable();
          loadUnpaidPayables(); 
          payableDetails.innerHTML = `<p class="text-muted">Select a payable to view its details.</p>`;
        }
      });


    } catch (error) {
      console.error('Submission error:', error);
      Swal.fire('Error', 'Something went wrong while submitting.', 'error');
    }
  });

  async function loadDisbursementTable() {
    try {
      const response = await fetch('customassets/DS/fetch_disbursements.php');
      const data = await response.json();

      disbursementTable.innerHTML = '';

      if (data.length === 0) {
        disbursementTable.innerHTML = `<tr><td colspan="6" class="text-center text-muted">No disbursements found.</td></tr>`;
        return;
      }

      data.forEach((row, index) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${index + 1}</td>
          <td>#${row.payable_id}</td>
          <td>${row.disbursement_date}</td>
          <td>₱${parseFloat(row.amount_paid).toFixed(2)}</td>
          <td>${row.payment_method}</td>
          <td>${row.remarks}</td>
        `;
        disbursementTable.appendChild(tr);
      });
    } catch (error) {
      console.error('Error loading disbursements:', error);
      disbursementTable.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Failed to load disbursements.</td></tr>`;
    }
  }

  async function loadUnpaidPayables() {
  try {
    const res = await fetch('customassets/DS/fetch_unpaid_payables.php');
    const data = await res.json();

    payableSelect.innerHTML = '<option value="">-- Select --</option>';

    data.forEach(row => {
      const opt = document.createElement('option');
      opt.value = row.id;

      // Display only "#ID - Payee"
      opt.textContent = `#${row.id} - ${row.payee}`;
      
      // Store extra data as dataset
      opt.dataset.payee = row.payee;
      opt.dataset.remaining = row.remaining_amount;
      opt.dataset.due = row.due_date;

      payableSelect.appendChild(opt);
    });

  } catch (error) {
    console.error('Error fetching payables:', error);
    Swal.fire('Error', 'Unable to fetch unpaid payables.', 'error');
  }
}

// Update details when selecting payable
payableSelect.addEventListener('change', function () {
  const selected = this.selectedOptions[0];
  const amountInput = disburseForm.querySelector('[name="disburse_amount"]');

  if (!selected.value) {
    payableDetails.innerHTML = `<p class="text-muted">Select a payable to view its details.</p>`;
    amountInput.removeAttribute('max');
    return;
  }

  const payee = selected.dataset.payee;
  const remaining = parseFloat(selected.dataset.remaining).toFixed(2);
  const due = selected.dataset.due;

  payableDetails.innerHTML = `
    <h6 class="mb-2 fw-semibold">Payee: ${payee}</h6>
    <p><strong>Remaining Amount:</strong> ₱${remaining}</p>
    <p><strong>Due Date:</strong> ${due}</p>
  `;

  // Set max attribute to prevent overpayment
  amountInput.max = remaining;
  amountInput.value = '';
  
  amountInput.addEventListener('input', function () {
    if (parseFloat(this.value) > parseFloat(remaining)) {
      Swal.fire({
        icon: 'warning',
        title: 'Amount exceeds remaining balance',
        text: `Maximum disbursable amount is ₱${remaining}`,
      });
      this.value = remaining;
    }
  });
});



  // Initial loads
  loadUnpaidPayables();
  loadDisbursementTable();
});

</script>
</body>
</html>
