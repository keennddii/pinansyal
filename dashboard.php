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
 
    <div class="tab-content mt-4">
      <!-- Budget Analytics Tab -->
      <div class="tab-pane fade show active" id="budgetanalytics" role="tabpanel">
        <!-- Budget Analytics Content -->
        <div class="row">
          <!-- Cards Section -->
          <div class="col-lg-3 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Total Budget</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cash"></i>
                  </div>
                  <div class="ps-3">
                    <h6>₱100,000</h6>
                    <span class="text-success small pt-1 fw-bold">+10%</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="card info-card expense-card">
              <div class="card-body">
                <h5 class="card-title">Total Spent</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-credit-card"></i>
                  </div>
                  <div class="ps-3">
                    <h6>₱50,000</h6>
                    <span class="text-danger small pt-1 fw-bold">-5%</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="card info-card pending-card">
              <div class="card-body">
                <h5 class="card-title">Remaining Budget</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-hourglass-split"></i>
                  </div>
                  <div class="ps-3">
                    <h6>₱20,000</h6>
                    <span class="text-warning small pt-1 fw-bold">Pending</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Budget Analytics Charts -->
        <div class="budget-analytics mt-4">
          <h2>Budget Analytics</h2>

          <div class="chart-selector mb-3">
            <label for="chartType">Select Chart:</label>
            <select id="chartType" onchange="changeChart()">
              <option value="pie">Expenses by Category</option>
              <option value="bar">Budget vs Actual</option>
              <option value="line">Monthly Trend</option>
            </select>
          </div>

          <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); width: 100%; max-width: 600px;">
            <canvas id="pieChart" style="display: block; width: 100%; height: 300px;"></canvas>
            <canvas id="barChart" style="display: none; width: 100%; height: 300px;"></canvas>
            <canvas id="lineChart" style="display: none; width: 100%; height: 300px;"></canvas>
          </div>

          <!-- Insights -->
          <div class="row mt-4">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Insights</h5>
                  <ul class="list-group">
                    <li class="list-group-item">You are overspending on <strong>Food</strong> by <strong>₱5,000</strong>.</li>
                    <li class="list-group-item">You saved <strong>₱10,000</strong> in <strong>Transportation</strong> this month.</li>
                    <li class="list-group-item">You are on track with your <strong>Entertainment</strong> budget, with <strong>₱3,000</strong> remaining.</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

        </div> <!-- end Budget Analytics -->
      </div> <!-- end budgetanalytics -->


      <!-- Expense Tracker Tab -->
      <div class="tab-pane fade" id="expensetracker" role="tabpanel">
      <div class="p-6">
  <h2 class="text-2xl font-bold text-gray-700 mb-6">Expense Tracker</h2>

  <!-- Overview Cards (Professional Look) -->
  <div class="row mb-5">
    <div class="col-md-4">
      <div class="card shadow-sm rounded-4">
        <div class="card-body text-center">
          <h5 class="card-title text-muted mb-2">Total Expenses</h5>
          <p class="fs-3 fw-bold mb-0 text-success" id="totalExpenses">₱0</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm rounded-4">
        <div class="card-body text-center">
          <h5 class="card-title text-muted mb-2">Expenses This Month</h5>
          <p class="fs-3 fw-bold mb-0 text-primary" id="monthlyExpenses">₱0</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm rounded-4">
        <div class="card-body text-center">
          <h5 class="card-title text-muted mb-2">Remaining Budget</h5>
          <p class="fs-3 fw-bold mb-0 text-warning" id="remainingBudget">₱0</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Search, Filter and Export (Professional Controls) -->
  <div class="d-flex flex-wrap gap-3 align-items-center mb-4">
    <input type="text" id="searchExpense" class="form-control w-auto" placeholder="Search by Category / Description" oninput="filterExpense()" style="min-width: 250px;">

    <select id="filterExpenseCategory" class="form-select w-auto" onchange="filterExpense()" style="min-width: 200px;">
      <option value="">Select Category</option>
      <option value="Transportation Costs">Transportation Costs</option>
      <option value="Accommodation Costs">Accommodation Costs</option>
      <option value="Tour Package Costs">Tour Package Costs</option>
      <option value="Marketing and Promotion">Marketing and Promotion</option>
      <option value="Staff and Operational Costs">Staff and Operational Costs</option>
      <option value="Technology and Software Costs">Technology and Software Costs</option>
      <option value="Miscellaneous Costs">Miscellaneous Costs</option>
      <option value="Maintenance Costs">Maintenance Costs</option>
    </select>

    <div class="ms-auto d-flex gap-2">
      <button class="btn btn-primary" onclick="openAddExpenseModal()">+ Add Expense</button>
      <button class="btn btn-success" onclick="exportToExcel()">Export Excel</button>
      <button class="btn btn-danger" onclick="exportToPDF()">Export PDF</button>
    </div>
  </div>

  <!-- Expense Table -->
  <div class="card shadow-sm rounded-4 p-3">
    <div class="table-responsive">
      <table class="table table-hover align-middle" id="expenseTable">
        <thead class="table-light">
          <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Amount (₱)</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="expenseTableBody">
          <!-- Dynamic Rows Here -->
        </tbody>
      </table>
    </div>

    <!-- Pagination Controls -->
    <nav class="mt-3">
      <ul class="pagination justify-content-center" id="expensePaginationControls">
        <!-- Dynamic Pagination Here -->
      </ul>
    </nav>
  </div>

  <!-- Add Expense Modal -->
  <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content shadow rounded-4">
        <div class="modal-header">
          <h5 class="modal-title" id="addExpenseModalLabel">Add New Expense</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addExpenseForm">
            <div class="mb-3">
              <label for="expenseDate" class="form-label">Date</label>
              <input type="date" class="form-control" id="expenseDate" required>
            </div>
            <div class="mb-3">
              <label for="expenseCategory" class="form-label">Category</label>
              <select class="form-select" id="expenseCategory" required>
                <option value="">Select Category</option>
                <option value="Transportation Costs">Transportation Costs</option>
                <option value="Accommodation Costs">Accommodation Costs</option>
                <option value="Tour Package Costs">Tour Package Costs</option>
                <option value="Marketing and Promotion">Marketing and Promotion</option>
                <option value="Staff and Operational Costs">Staff and Operational Costs</option>
                <option value="Technology and Software Costs">Technology and Software Costs</option>
                <option value="Miscellaneous Costs">Miscellaneous Costs</option>
                <option value="Maintenance Costs">Maintenance Costs</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="expenseAmount" class="form-label">Amount</label>
              <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="number" class="form-control" id="expenseAmount" placeholder="Enter Amount" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="expenseDescription" class="form-label">Description (optional)</label>
              <input type="text" class="form-control" id="expenseDescription" placeholder="Enter description" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" onclick="saveNewExpense()">Save Expense</button>
        </div>
      </div>
    </div>
  </div>

</div>
      </div>

      <!-- Budget Categories Tab -->
      <div class="tab-pane fade" id="budgetcategories" role="tabpanel">

  <!-- Budget Category Overview -->
  <div class="row mb-4">
    <!-- Category Item -->
    <div class="col-md-4">
      <div class="card shadow-sm rounded-4">
        <div class="card-body">
          <h5 class="card-title text-muted mb-2">Food</h5>
          <div class="d-flex justify-content-between mb-3">
            <span class="text-muted">Budgeted Amount</span>
            <span class="text-success">₱20,000</span>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <span class="text-muted">Amount Spent</span>
            <span class="text-danger">₱8,000</span>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <span class="text-muted">Remaining Amount</span>
            <span class="text-warning">₱12,000</span>
          </div>

          <!-- Progress Bar -->
          <div class="mb-3">
            <div class="progress">
              <div class="progress-bar bg-success" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>

          <!-- Edit and Delete buttons -->
          <div class="d-flex justify-content-end gap-2">
            <button class="btn btn-warning btn-sm" onclick="editCategory()">Edit</button>
            <button class="btn btn-danger btn-sm" onclick="deleteCategory()">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Repeat for other categories -->
    <!-- You can dynamically generate this with JavaScript if needed -->

  </div>

  <!-- Add New Category Button -->
  <div class="d-flex justify-content-end">
    <button class="btn btn-primary" onclick="openAddCategoryModal()">+ Add New Category</button>
  </div>

  <!-- Add Category Modal -->
  <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content shadow rounded-4">
        <div class="modal-header">
          <h5 class="modal-title" id="addCategoryModalLabel">Add New Budget Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addCategoryForm">
            <div class="mb-3">
              <label for="categoryName" class="form-label">Category Name</label>
              <input type="text" class="form-control" id="categoryName" placeholder="Enter Category Name" required>
            </div>
            <div class="mb-3">
              <label for="categoryBudget" class="form-label">Budgeted Amount</label>
              <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="number" class="form-control" id="categoryBudget" placeholder="Enter Budgeted Amount" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="categorySpent" class="form-label">Amount Spent</label>
              <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="number" class="form-control" id="categorySpent" placeholder="Enter Amount Spent" required>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" onclick="saveCategory()">Save Category</button>
        </div>
      </div>
    </div>
  </div>
</div>
      </div>

      <!-- Budget History Tab -->
      <div class="tab-pane fade" id="budgethistory" role="tabpanel">
        <h2>Budget History</h2>
        <p>Content for Budget History tab.</p>
      </div>

    </div> <!-- end tab-content -->

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
 
    <!-- Template Main JS File -->
    <script src=assets/js/main.js></script>
    <script src="customassets/customjs/signoutnotif.js"></script>
    <script src="customassets/customjs/bar.js"></script>
  </body>

  </html>