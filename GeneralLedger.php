  <?php
  include('customassets/cnn/user.php');
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>General Ledger</title>
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


    <aside id="sidebar" class="sidebar">
      <!-- Start ng Side Bar -->

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

  <ul class="nav nav-tabs" id="ledgerTabs">
    <li class="nav-item"><a class="nav-link active" id="summary-tab" data-bs-toggle="tab" href="#journalentries">Journal Entries</a></li>
    <li class="nav-item"><a class="nav-link" id="reconciliation-tab" data-bs-toggle="tab" href="#trialbalance">Trial Balance</a></li>
    <li class="nav-item"><a class="nav-link" id="chartofaccounts-tab" data-bs-toggle="tab" href="#chartofaccounts">Chart of Accounts</a></li>
  </ul>

  <div class="tab-content mt-4">

  <!-- JOURNAL ENTRIES -->
    <div class="tab-pane fade show active" id="journalentries">
    <h5>Journal Entries</h5>
  
  <!-- Search and Filter -->
  <div class="d-flex justify-content-between mb-3">
    <input type="text" class="form-control w-25" placeholder="Search by Account or Description">
    <select class="form-select w-25">
      <option selected>Filter by Date</option>
      <option value="today">Today</option>
      <option value="week">This Week</option>
      <option value="month">This Month</option>
    </select>
    <button class="btn btn-primary" onclick="openJournalModal()">+ Add Entry</button>
  </div>

  <!-- Journal Entries Table -->
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Date</th>
        <th>Account</th>
        <th>Description</th>
        <th>Debit</th>
        <th>Credit</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>2025-04-01</td>
        <td>Cash</td>
        <td>Initial Capital</td>
        <td>10,000</td>
        <td>0</td>
        <td>
          <button class="btn btn-sm btn-info">View</button>
          <button class="btn btn-sm btn-warning">Edit</button>
          <button class="btn btn-sm btn-danger">Delete</button>
        </td>
      </tr>
      <tr>
        <td>2025-04-02</td>
        <td>Accounts Payable</td>
        <td>Office Rent</td>
        <td>0</td>
        <td>5,000</td>
        <td>
          <button class="btn btn-sm btn-info">View</button>
          <button class="btn btn-sm btn-warning">Edit</button>
          <button class="btn btn-sm btn-danger">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>


<!-- Add Journal Entry Modal -->
<div class="modal fade" id="addJournalModal" tabindex="-1" aria-labelledby="addJournalModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addJournalModalLabel">Add Journal Entry</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addJournalForm">
          <div class="mb-3">
            <label for="journalDate" class="form-label">Date</label>
            <input type="date" class="form-control" id="journalDate" required>
          </div>
          <div class="mb-3">
            <label for="journalAccount" class="form-label">Account</label>
            <select class="form-control" id="journalAccount" required>
              <option value="">Select Account</option>
              <option value="Assets">Assets</option>
              <option value="Withdrawal">Withdrawal</option>
              <option value="Expenses">Expenses</option>
              <option value="Liabilities">Liabilities</option>
              <option value="Equity">Equity</option>
              <option value="Revenue">Revenue</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="journalDescription" class="form-label">Description</label>
            <input type="text" class="form-control" id="journalDescription" placeholder="Enter description" required>
          </div>
          <div class="mb-3">
            <label for="journalDebit" class="form-label">Debit</label>
            <input type="number" class="form-control" id="journalDebit" placeholder="Enter debit amount" required>
          </div>
          <div class="mb-3">
            <label for="journalCredit" class="form-label">Credit</label>
            <input type="number" class="form-control" id="journalCredit" placeholder="Enter credit amount" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="saveJournalEntry()">Save Entry</button>
      </div>
    </div>
  </div>
</div>


</div>


<!-- CHART OF ACCOUNTS -->
<div class="tab-pane fade" id="chartofaccounts">
<h2 class="mb-4">Chart of Accounts</h2>
      
      <!-- Actions -->
      <div class="d-flex justify-content-between mb-3">
        <input type="text" id="searchAccount" class="form-control w-25" placeholder="Search Account..." onkeyup="filterAccounts()">
        <select id="filterAccountType" class="form-select w-25" onchange="filterAccounts()">
          <option value="">Filter by Account Type</option>
          <option value="Asset">Asset</option>
          <option value="Liability">Liability</option>
          <option value="Equity">Equity</option>
          <option value="Revenue">Revenue</option>
          <option value="Expense">Expense</option>
        </select>
        <button class="btn btn-primary" onclick="openAddModal()">Add New Account</button>
        <button class="btn btn-success" onclick="exportToExcel()">Export to Excel</button>
        <button class="btn btn-danger" onclick="exportToPDF()">Export to PDF</button>
      </div>
      
      <!-- Chart of Accounts Table -->
      <div class="table-responsive">
        <table class="table table-striped" id="coaTable">
          <thead>
            <tr>
              <th><input type="checkbox" id="selectAll"></th>
              <th>Account Code</th>
              <th>Account Name</th>
              <th>Account Type</th>
              <th>Parent Account</th>
              <th>Normal Balance</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="coaBody">
            <!-- Data Injected by JavaScript -->
          </tbody>
        </table>
      </div>
      
      <!-- Bulk Actions -->
      <div class="d-flex gap-2 mt-2">
        <button class="btn btn-danger btn-sm" onclick="deleteSelected()">Delete Selected</button>
      </div>
      
      <!-- Pagination -->
      <nav class="mt-3">
        <ul class="pagination justify-content-center" id="paginationControls">
          <!-- Pagination buttons injected by JavaScript -->
        </ul>
      </nav>
    </section>
  </main>
  
  <!-- Add New Account Modal -->
  <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addAccountModalLabel">Add New Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addAccountForm">
            <div class="mb-3">
              <label for="newAccountCode" class="form-label">Account Code</label>
              <input type="text" class="form-control" id="newAccountCode" required>
            </div>
            <div class="mb-3">
              <label for="newAccountName" class="form-label">Account Name</label>
              <input type="text" class="form-control" id="newAccountName" required>
            </div>
            <div class="mb-3">
              <label for="newAccountType" class="form-label">Account Type</label>
              <select class="form-select" id="newAccountType" required>
                <option value="">Select Account Type</option>
                <option value="Asset">Asset</option>
                <option value="Liability">Liability</option>
                <option value="Equity">Equity</option>
                <option value="Revenue">Revenue</option>
                <option value="Expense">Expense</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="newParentAccount" class="form-label">Parent Account</label>
              <input type="text" class="form-control" id="newParentAccount">
            </div>
            <div class="mb-3">
              <label for="newNormalBalance" class="form-label">Normal Balance</label>
              <select class="form-select" id="newNormalBalance" required>
                <option value="">Select Normal Balance</option>
                <option value="Debit">Debit</option>
                <option value="Credit">Credit</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="newStatus" class="form-label">Status</label>
              <select class="form-select" id="newStatus" required>
                <option value="">Select Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" onclick="saveNewAccount()">Save Account</button>
        </div>
      </div>
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
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>

    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="customassets/customjs/signoutnotif.js"></script>
    <script src="customassets/customjs/screenshot.js"></script>
    <script src="customassets/customjs/darkmode.js"></script>
    <script src="customassets/customjs/GL/summary.js"></script>

  </body>

  </html>