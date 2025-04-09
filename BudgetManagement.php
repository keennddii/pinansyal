<?php
include('customassets/cnn/user.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Budget Management</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/jeybidi.png" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
#moneySpinner {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  font-size: 1.2rem;
  position: absolute;
}

.money-spinner i {
  animation: money-spin 2s linear infinite;
}

@keyframes money-spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}


    </style>
</head>

<body>

    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <!-- Para sa logo -->
        <div class="ms-auto d-flex align-items-center">
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

            <div class="flex items-center w-full p-1 pl-6"
                style="display: flex; align-items: center; padding: 4px; width: 40px; background-color: transparent; height: 4rem;">
                <div class="flex items-center justify-center"
                    style="display: flex; align-items: center; justify-content: center;">
                    <svg width="250" height="auto" viewBox="0 0 180 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-size="30"
                            font-weight="bold" font-family="Arial Black, sans-serif">
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


    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="budgetTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="budgetAllocationTab" data-bs-toggle="tab" href="#budgetAllocation" role="tab" aria-controls="budgetAllocation" aria-selected="true">Budget Allocation</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="expenseTrackingTab" data-bs-toggle="tab" href="#expenseTracking" role="tab" aria-controls="expenseTracking" aria-selected="false">Expense Tracking</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="fundManagementTab" data-bs-toggle="tab" href="#fundManagement" role="tab" aria-controls="fundManagement" aria-selected="false">Fund Management</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="reportingTab" data-bs-toggle="tab" href="#reporting" role="tab" aria-controls="reporting" aria-selected="false">Reporting & Analysis</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="requestTab" data-bs-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="false">Request Tab</a>
      </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-4" id="budgetTabsContent">


<!-- Budget Allocation Tab -->
<div class="tab-pane fade show active" id="budgetAllocation" role="tabpanel" aria-labelledby="budgetAllocationTab">
  <!-- Search, Filter and Export -->
  <div class="d-flex flex-wrap gap-3 align-items-center mb-4">
    <input type="text" id="searchBudget" class="form-control w-auto" placeholder="Search Request ID / Department" oninput="filterBudget()" style="min-width: 250px;">
  
    <select id="filterBudgetStatus" class="form-select w-auto" onchange="filterBudget()" style="min-width: 200px;">
      <option value="">Filter by Status</option>
      <option value="Allocated">Allocated</option>
      <option value="Pending">Pending</option>
      <option value="Rejected">Rejected</option>
    </select>
  
    <div class="ms-auto d-flex gap-2">
      <!-- Optional: button for manual addition (karaniwan ay awtomatik mula sa request process) -->
      <button class="btn btn-primary" onclick="openAddAllocationModal()">+ Add Allocation</button>
      <button class="btn btn-success" onclick="exportToExcel()">Export Excel</button>
      <button class="btn btn-danger" onclick="exportToPDF()">Export PDF</button>
    </div>
  </div>
  
    <!-- Budget Allocation Table -->
    <div class="card shadow-sm rounded-4 p-3">
      <div class="table-responsive">
        <table class="table table-hover align-middle" id="budgetAllocationTable">
          <thead class="table-light">
            <tr>
              <th>Allocation ID</th>
              <th>Request ID</th>
              <th>Date Submitted</th>
              <th>Date of Response</th>
              <th>Requested Amount</th>
              <th>Approved Amount</th>
              <th>Status</th>
              <th>Remarks</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="budgetAllocationTableBody">
          <?php
          // Pagination logic
          $limit = 10;  // Number of records per page
          $page = isset($_GET['page']) ? $_GET['page'] : 1;
          $offset = ($page - 1) * $limit;

          // Connect to database
          $conn = new mysqli("localhost", "root", "", "pinansyal_budget_management");
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // Fetch total records
          $totalSql = "SELECT COUNT(*) AS total FROM budget_allocations";
          $totalResult = $conn->query($totalSql);
          $totalRow = $totalResult->fetch_assoc();
          $totalRecords = $totalRow['total'];
          $totalPages = ceil($totalRecords / $limit);

          // Fetch paginated data
          $sql = "SELECT * FROM budget_allocations LIMIT $limit OFFSET $offset";
          $result = $conn->query($sql);

          // Output data for table rows
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($row['allocation_id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['request_id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['date_submitted']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['date_of_response']) . "</td>";
                  echo "<td>₱" . number_format($row['requested_amount'], 2) . "</td>";
                  echo "<td>₱" . number_format($row['approved_amount'], 2) . "</td>";
                  echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['remarks']) . "</td>";
                  echo "<td><button class='btn btn-success btn-sm' onclick=\"openValidateModal('".$row['allocation_id']."','".$row['request_id']."','".$row['requested_amount']."')\">Validate</button></td>";
                  echo "<td><button class='btn btn-warning btn-sm'>Edit</button></td>";
                  echo "<td><button class='btn btn-danger btn-sm'>View</button></td>";

                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='9' class='text-center'>No Allocations Found</td></tr>";
          }

          // Close the connection
          $conn->close();
          ?>
          </tbody>
        </table>
        <!-- Pagination Controls -->
          <nav class="mt-3">
              <ul class="pagination justify-content-center" id="budgetAllocationPaginationControls">
                  <?php
                  for ($i = 1; $i <= $totalPages; $i++) {
                      echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                  }
                  ?>
              </ul>
          </nav>
      </div>
      
      <!-- Validate Allocation Modal -->
<div class="modal fade" id="validateAllocationModal" tabindex="-1" aria-labelledby="validateAllocationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title" id="validateAllocationModalLabel">Validate Allocation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Request ID</label>
          <input type="text" id="modalRequestId" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Requested Amount</label>
          <input type="text" id="modalRequestedAmount" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Approved Amount</label>
          <input type="number" id="modalApprovedAmount" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Remarks</label>
          <textarea id="modalRemarks" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="approveAllocation()">Approve</button>
        <button type="button" class="btn btn-danger" onclick="rejectAllocation()">Reject</button>
      </div>
    </div>
  </div>
</div>

    </div>
    

    
    
  </div>


      <!-- Expense Tracking Tab -->
      <div class="tab-pane fade" id="expenseTracking" role="tabpanel" aria-labelledby="expenseTrackingTab">
      <div class="p-6">
  <h2 class="text-2xl font-bold text-gray-700 mb-6">Expense Tracker</h2>

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
        </tbody>
      </table>
    </div>

    <nav class="mt-3">
      <ul class="pagination justify-content-center" id="expensePaginationControls">
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

      <!-- Fund Management Tab -->
      <div class="tab-pane fade" id="fundManagement" role="tabpanel" aria-labelledby="fundManagementTab">
        <p>Fund Management content goes here.</p>
      </div>

      <!-- Reporting & Analysis Tab -->
      <div class="tab-pane fade" id="reporting" role="tabpanel" aria-labelledby="reportingTab">
        <p>Reporting and Analysis content goes here.</p>
      </div>

<!-- Request Tab -->
<div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="requestTab">
  <div class="card shadow-sm rounded-4 p-3">
    <div class="table-responsive">
      <!-- Example: Notification badge near the Request tab title -->
      <li class="nav-item">
        <a class="nav-link" id="requestTab" data-bs-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="false">
          Request
          <span id="requestTabNotification" style="display:none; background:red; color:white; border-radius:50%; padding:2px 6px; font-size:0.8rem;">New</span>
        </a>
      </li>

      <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary">+ New Request</button>
      </div>

      <table class="table table-hover align-middle" id="requestTable">
        <thead class="table-light">
          <tr>
            <th>Request ID</th>
            <th>Requested By</th>
            <th>Department</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Categories</th>
            <th>Attachments</th>
            <th>Remarks</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="requestTableBody">
          <?php
          // Step 3 - Connect to DB
          $conn = new mysqli("localhost", "root", "", "pinansyal_budget_management");

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // Fetch data from requests table
          $sql = "SELECT * FROM requests";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($row['request_id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['requested_by']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['department']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['request_date']) . "</td>";
                  echo "<td>₱" . number_format($row['amount'], 2) . "</td>";
                  echo "<td>" . htmlspecialchars($row['categories']) . "</td>";
                  echo "<td><a href='" . htmlspecialchars($row['attachment']) . "' target='_blank'>View File</a></td>";
                  echo "<td>" . htmlspecialchars($row['remarks']) . "</td>";
                  echo "<td>
                          <!-- Allocate button triggers the modal and passes the request ID -->
                          <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#allocationModal' data-request-id='" . htmlspecialchars($row['request_id']) . "'>Accept</button>
                          
                          <!-- Reject button using separate form -->
                          <form method='post' action='reject_request.php' style='display:inline;'>
                              <input type='hidden' name='request_id' value='" . htmlspecialchars($row['request_id']) . "'>
                              <button type='submit' class='btn btn-danger btn-sm'>Reject</button>
                          </form>
                        </td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='9' class='text-center'>No Requests Found</td></tr>";
          }
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>

    <nav class="mt-3">
      <ul class="pagination justify-content-center" id="requestPaginationControls">
        <!-- Dynamic Pagination if needed -->
      </ul>
    </nav>

    <!-- Allocation Modal Form -->
<div class="modal fade" id="allocationModal" tabindex="-1" aria-labelledby="allocationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shadow rounded-4">
      <div class="modal-header">
        <h5 class="modal-title" id="allocationModalLabel">Allocate Budget</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form can use POST to a PHP processing file (allocate_request.php) or be handled with AJAX -->
        <form id="allocationForm" method="post" action="allocate_request.php">
          <div class="mb-3">
            <label for="approvedAmount" class="form-label">Approved Amount</label>
            <input type="number" name="approved_amount" class="form-control" id="approvedAmount" required>
          </div>
          <div class="mb-3">
            <label for="dateResponse" class="form-label">Date of Response</label>
            <input type="date" name="date_of_response" class="form-control" id="dateResponse" required>
          </div>
          <div class="mb-3">
            <label for="allocationRemarks" class="form-label">Remarks</label>
            <textarea name="remarks" class="form-control" id="allocationRemarks" rows="3"></textarea>
          </div>
          <!-- Hidden field to store the Request ID -->
          <input type="hidden" name="request_id" id="allocationRequestId" value="">
          <button type="submit" class="btn btn-primary">Submit Allocation</button>
        </form>
      </div>
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
            It is highly forbidden to take screenshots, copy and paste, or use other similar techniques to get and
            distribute content on other platforms.
            <br>
            <br>
            NOTICE It is with deep regret that we inform you that all the financial documents and information shared on
            this site pertain solely for the use of the <br> company by the financial officers and administrative staff
            working for the finance department of JVD Event and Travel Management,<br>Co. Unfortunately we have noticed
            that all the details available on this site were uploaded without proper permission and authorization to
            other sites.
        </div>

    </footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

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
<script src=customassets/customjs/screenshot.js></script>
<script src="customassets/customjs/darkmode.js"></script>
<script src="customassets/customjs/BM/functional.js"></script>
<script src="customassets/customjs/BM/womwom.js"></script>
<script src="customassets/customjs/BM/request.js"></script> 

</body>

</html>