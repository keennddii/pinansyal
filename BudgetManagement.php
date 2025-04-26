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
<div class="container mt-5">
 <!-- 📌 Budget Summary Cards -->
<div class="row row-cols-1 row-cols-md-3 g-4 mb-4">

<div class="col">
  <div class="card shadow-sm h-100">
    <div class="card-body">
      <h5 class="card-title">Total Budget</h5>
      <p class="card-text fs-4 fw-bold text-primary" id="totalBudget">₱0.00</p>
    </div>
  </div>
</div>

<div class="col">
  <div class="card shadow-sm h-100">
    <div class="card-body">
      <h5 class="card-title">Used Budget</h5>
      <p class="card-text fs-4 fw-bold text-danger" id="usedBudget">₱0.00</p>
    </div>
  </div>
</div>

<div class="col">
  <div class="card shadow-sm h-100">
    <div class="card-body">
      <h5 class="card-title">Remaining Budget</h5>
      <p class="card-text fs-4 fw-bold text-success" id="remainingBudget">₱0.00</p>
    </div>
  </div>
</div>

</div>
<!-- End Budget Summary Cards -->


  <!-- Existing Table -->
  <div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
      <span>Budgets Overview</span>
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#budgetModal">
        + New Budget
      </button>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>Department</th>
            <th>Year</th>
            <th>Budget</th>
            <th>Used</th>
            <th>Remaining</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
            <!-- Dynamic budget rows here -->
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- 💬 Modal for Add/Edit Budget -->
<div class="modal fade" id="budgetModal" tabindex="-1" aria-labelledby="budgetModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="budgetForm">
        <div class="modal-header">
          <h5 class="modal-title" id="budgetModalLabel">Allocate Budget</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <select id="department" class="form-select" required>
              <option value="">Select Department</option>
              <!-- Dynamic options here -->
            </select>
          </div>

          <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" id="year" class="form-control" value="2025" required>
          </div>

          <div class="mb-3">
            <label for="budget" class="form-label">Budget Amount</label>
            <input type="number" id="budget" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save Budget</button>
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
document.addEventListener('DOMContentLoaded', function() {
  // Fetch departments
  fetch('customassets/BM/fetch_departments.php')
    .then(response => response.json())
    .then(data => {
      const departmentSelect = document.getElementById('department');
      data.forEach(dept => {
        const option = document.createElement('option');
        option.value = dept.id;
        option.textContent = dept.name;
        departmentSelect.appendChild(option);
      });
    })
    .catch(error => {
      console.error('Error fetching departments:', error);
    });

  // Handle budget form submission
  const budgetForm = document.getElementById('budgetForm');
  budgetForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const department_id = document.getElementById('department').value;
    const year = document.getElementById('year').value;
    const budget = document.getElementById('budget').value;

    fetch('customassets/BM/save_budget.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `department_id=${department_id}&year=${year}&budget=${budget}`
    })
    .then(response => response.text())
    .then(data => {
      console.log(data);
      Swal.fire({
        icon: 'success',
        title: 'Budget Saved!',
        text: 'New budget allocation successfully added.',
        timer: 2000,
        showConfirmButton: false
      }).then(() => {
        location.reload(); // Reload page to refresh table
      });
    })
    .catch(error => {
      console.error('Error saving budget:', error);
    });
  });
});

// Fetch budgets and populate table
fetch('customassets/BM/fetch_budgets.php')
  .then(response => response.json())
  .then(data => {
    const tbody = document.querySelector('table tbody');
    tbody.innerHTML = ''; // clear existing

    data.forEach(budget => {
      const tr = document.createElement('tr');
      
      const remainingFormatted = parseFloat(budget.remaining_amount).toLocaleString('en-PH', { style: 'currency', currency: 'PHP' });
      const allocatedFormatted = parseFloat(budget.allocated_amount).toLocaleString('en-PH', { style: 'currency', currency: 'PHP' });
      const usedFormatted = parseFloat(budget.used_amount).toLocaleString('en-PH', { style: 'currency', currency: 'PHP' });

      let statusBadge = '';
      if (parseFloat(budget.remaining_amount) < 0) {
        statusBadge = '<span class="badge bg-danger">Over</span>';
      } else {
        statusBadge = '<span class="badge bg-success">OK</span>';
      }

      tr.innerHTML = `
        <td>${budget.department_name}</td>
        <td>${budget.year}</td>
        <td>${allocatedFormatted}</td>
        <td>${usedFormatted}</td>
        <td>${remainingFormatted}</td>
        <td>${statusBadge}</td>
      `;
      tbody.appendChild(tr);
    });
  })
  .catch(error => {
    console.error('Error fetching budgets:', error);
  });
</script>
<script>
// Fetch budgets and populate table **and** cards
fetch('customassets/BM/fetch_budgets.php')
  .then(response => response.json())
  .then(data => {
    // 1) Compute card values
    let total = 0, used = 0, remaining = 0;
    data.forEach(b => {
      const alloc = parseFloat(b.allocated_amount)  || 0;
      const usedAmt = parseFloat(b.used_amount)     || 0;
      const rem = alloc - usedAmt;
      total     += alloc;
      used      += usedAmt;
      remaining += rem;
    });

    // 2) Update cards
    document.getElementById('totalBudget').textContent     =
      '₱' + total.toLocaleString('en-PH',{minimumFractionDigits:2});
    document.getElementById('usedBudget').textContent      =
      '₱' + used.toLocaleString('en-PH',{minimumFractionDigits:2});
    document.getElementById('remainingBudget').textContent =
      '₱' + remaining.toLocaleString('en-PH',{minimumFractionDigits:2});

    // 3) Populate table
    const tbody = document.querySelector('table tbody');
    tbody.innerHTML = ''; // clear existing
    data.forEach(budget => {
      const remFmt = (parseFloat(budget.allocated_amount) - parseFloat(budget.used_amount))
                        .toLocaleString('en-PH',{style:'currency',currency:'PHP'});
      const allocFmt = parseFloat(budget.allocated_amount)
                        .toLocaleString('en-PH',{style:'currency',currency:'PHP'});
      const usedFmt = parseFloat(budget.used_amount)
                        .toLocaleString('en-PH',{style:'currency',currency:'PHP'});

      const statusBadge = (parseFloat(budget.allocated_amount) - parseFloat(budget.used_amount) < 0)
        ? '<span class="badge bg-danger">Over</span>'
        : '<span class="badge bg-success">OK</span>';

      tbody.insertAdjacentHTML('beforeend', `
        <tr>
          <td>${budget.department_name}</td>
          <td>${budget.year}</td>
          <td>${allocFmt}</td>
          <td>${usedFmt}</td>
          <td>${remFmt}</td>
          <td>${statusBadge}</td>
        </tr>
      `);
    });
  })
  .catch(error => {
    console.error('Error fetching budgets:', error);
  });
</script>

</body>
</html>
