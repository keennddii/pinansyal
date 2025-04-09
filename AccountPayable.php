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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>

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
      
      <!-- Dashboard Cards -->
      <div class="row mb-4">
        <div class="col-md-4">
          <div class="card text-white bg-primary mb-3">
            <div class="card-body">
              <h5 class="card-title">Total Bills</h5>
              <p class="card-text fs-4" id="totalBills"></p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-white bg-warning mb-3">
            <div class="card-body">
              <h5 class="card-title">Pending Payments</h5>
              <p class="card-text fs-4" id="pendingBills"></p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-white bg-success mb-3">
            <div class="card-body">
              <h5 class="card-title">Paid Bills</h5>
              <p class="card-text fs-4" id="paidBills"></p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Actions -->
      <div class="d-flex justify-content-between mb-3">
        <input type="text" id="searchBill" class="form-control w-25" placeholder="Search by Supplier or Bill ID" onkeyup="filterBills()">
        <select id="filterBillStatus" class="form-select w-25" onchange="filterBills()">
          <option value="">Filter by Status</option>
          <option value="pending">Pending</option>
          <option value="approved">Approved</option>
          <option value="paid">Paid</option>
        </select>
        <button class="btn btn-success" onclick="exportToExcel()">Export to Excel</button>
        <button class="btn btn-danger" onclick="exportToPDF()">Export to PDF</button>
        <!-- Open Add Bill Modal -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBillModal">+ Add Bill</button>
      </div>
      
      <!-- Bills Table -->
      <div class="table-responsive">
        <table class="table table-striped" id="billTable">
          <thead>
            <tr>
              <th>Date</th>
              <th>Supplier</th>
              <th>Bill Type</th>
              <th>Invoice Number</th>
              <th>Amount Due</th>
              <th>Due Date</th>
              <th>Status</th>
              <th>Payment Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?php echo htmlspecialchars($row['date']); ?></td>
                <td><?php echo htmlspecialchars($row['supplier']); ?></td>
                <td><?php echo htmlspecialchars($row['bill_type']); ?></td>
                <td><?php echo htmlspecialchars($row['invoice_number']); ?></td>
                <td>₱<?php echo number_format($row['amount_due'], 2); ?></td>
                <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td><?php echo htmlspecialchars($row['payment_date']); ?></td>
                <td>
                  <!-- Edit: Opens the edit modal (or you may redirect to a separate page) -->
                  <button class="btn btn-warning btn-sm" onclick="openEditBillModal(<?php echo $row['id']; ?>)">Edit</button>
                  <!-- Delete: Calls a JavaScript function that submits a hidden delete form -->
                  <button class="btn btn-danger btn-sm" onclick="deleteBill(<?php echo $row['id']; ?>)">Delete</button>
                  <!-- Mark as Paid: A form submission for marking as paid -->
                  <form style="display:inline;" action="AccountPayable.php" method="post">
                    <input type="hidden" name="action" value="mark_paid">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button class="btn btn-success btn-sm" type="submit">Mark as Paid</button>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
  

  
  <!-- Add Bill Modal -->
  <div class="modal fade" id="addBillModal" tabindex="-1" aria-labelledby="addBillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addBillModalLabel">Add Bill</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- The form submits to this same file with action 'add' -->
          <form id="addBillForm" action="AccountPayable.php" method="post">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
              <label for="supplier" class="form-label">Supplier</label>
              <input type="text" class="form-control" id="supplier" name="supplier" required>
            </div>
            <div class="mb-3">
              <label for="billType" class="form-label">Bill Type</label>
              <input type="text" class="form-control" id="billType" name="billType" required>
            </div>
            <div class="mb-3">
              <label for="invoiceNumber" class="form-label">Invoice Number</label>
              <input type="text" class="form-control" id="invoiceNumber" name="invoiceNumber" required>
            </div>
            <div class="mb-3">
              <label for="amountDue" class="form-label">Amount Due</label>
              <input type="number" class="form-control" id="amountDue" name="amountDue" required>
            </div>
            <div class="mb-3">
              <label for="dueDate" class="form-label">Due Date</label>
              <input type="date" class="form-control" id="dueDate" name="dueDate" required>
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-select" id="status" name="status" required>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="paid">Paid</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Bill</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Edit Bill Modal -->
  <div class="modal fade" id="editBillModal" tabindex="-1" aria-labelledby="editBillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editBillModalLabel">Edit Bill</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- This form submits to the same file with action 'edit' -->
          <form id="editBillForm" action="AccountPayable.php" method="post">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" id="editBillId">
            <div class="mb-3">
              <label for="editSupplier" class="form-label">Supplier</label>
              <input type="text" class="form-control" id="editSupplier" name="supplier" required>
            </div>
            <div class="mb-3">
              <label for="editBillType" class="form-label">Bill Type</label>
              <input type="text" class="form-control" id="editBillType" name="billType" required>
            </div>
            <div class="mb-3">
              <label for="editInvoiceNumber" class="form-label">Invoice Number</label>
              <input type="text" class="form-control" id="editInvoiceNumber" name="invoiceNumber" required>
            </div>
            <div class="mb-3">
              <label for="editAmountDue" class="form-label">Amount Due</label>
              <input type="number" class="form-control" id="editAmountDue" name="amountDue" required>
            </div>
            <div class="mb-3">
              <label for="editDueDate" class="form-label">Due Date</label>
              <input type="date" class="form-control" id="editDueDate" name="dueDate" required>
            </div>
            <div class="mb-3">
              <label for="editStatus" class="form-label">Status</label>
              <select class="form-select" id="editStatus" name="status" required>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="paid">Paid</option>
              </select>
            </div>
            <button type="submit" class="btn btn-warning">Update Bill</button>
          </form>
        </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="customassets/customjs/signoutnotif.js"></script>

  <script src="customassets/customjs/AP/function.js"></script>
</body>
</html>
