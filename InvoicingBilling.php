<?php 
include('customassets/cnn/invoicing.php');
include('customassets/cnn/auditcompliance.php');
$result = mysqli_query($con, "SELECT * FROM audit_compliance");
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

    <!--  DITO MAGSSTART ANG NOTIFICATION -->
  <li class="nav-item dropdown">
  <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
    <i class="bi bi-bell"></i>
    <span class="badge bg-primary badge-number">4</span> 
  </a>

  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
    <li class="dropdown-header">
      You have 4 new notifications
      <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View All</span></a>
    </li>
    <li><hr class="dropdown-divider"></li>

    <!-- Example notification 1 -->
    <li class="notification-item">
      <a class="dropdown-item d-flex align-items-center" href="notification-link-1.html">
        <i class="bi bi-exclamation-circle text-warning"></i>
        <div>
          <h4>New Alert</h4>
          <p>This is a new alert notification</p>
          <p>5 minutes ago</p>
        </div>
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>

    <!-- Example notification 2 -->
    <li class="notification-item">
      <a class="dropdown-item d-flex align-items-center" href="notification-link-2.html">
        <i class="bi bi-envelope text-info"></i>
        <div>
          <h4>New Message</h4>
          <p>You have a new message from John Doe</p>
          <p>10 minutes ago</p>
        </div>
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>

    <!-- Example notification 3 -->
    <li class="notification-item">
      <a class="dropdown-item d-flex align-items-center" href="notification-link-3.html">
        <i class="bi bi-check-circle text-success"></i>
        <div>
          <h4>Task Completed</h4>
          <p>Your task "Project ABC" is completed</p>
          <p>30 minutes ago</p>
        </div>
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>

    <!-- Example notification 4 -->
    <li class="notification-item">
      <a class="dropdown-item d-flex align-items-center" href="notification-link-4.html">
        <i class="bi bi-info-circle text-primary"></i>
        <div>
          <h4>System Update</h4>
          <p>A new system update is available</p>
          <p>1 hour ago</p>
        </div>
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>

    <li class="dropdown-footer">
      <a href="#">Show all notifications</a>
    </li>
  </ul>
  </li><!-- LAST CODE NUNG NOTIFICATION -->


<!-- DITO NAKALAGAY YUNG SA PROFILE NUNG NAKALOGIN -->
        <li class="nav-item dropdown pe-3">
      
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $username;?></span>
          </a><!-- End Profile Iamge Icon -->

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

<!-- Custom Logout Modal -->
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
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <div class="flex items-center w-full p-1 pl-6" style="display: flex; align-items: center; padding: 4px; width: 40px; background-color: transparent; height: 4rem;">
        <div class="flex items-center justify-center" style="display: flex; align-items: center; justify-content: center; auto;">
            <img src="assets/img/jeybidi.png" alt="Logo" style="width: 120px; height: auto; margin: 40px;">
        </div>
      </div>
    </div>

    <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-house-door"></i>
          <span>Homepage</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <hr class="sidebar-divider">

      <li class="nav-heading">MODULES</li>

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#disbursement-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-layout-text-window-reverse"></i><span>Disbursement</span><i class="bi bi-arrow-bar-down ms-auto"></i>
  </a>
  <ul id="disbursement-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    <li>
      <a href="PayrollManagement.php">
        <i class="bi bi-circle-fill"></i><span>Payroll Management</span>
      </a>
    </li>  
  </ul>
</li><!-- End Disbursement Nav -->


<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#budget-management-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-currency-dollar"></i><span>Budget Management</span><i class="bi bi-arrow-bar-down ms-auto"></i>
  </a>
  <ul id="budget-management-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
  <li>
      <a href="Expense.php">
        <i class="bi bi-circle-fill"></i><span>Expense Management</span>
      </a>
    </li>
    <li>
      <a href="TaxManagement.php">
        <i class="bi bi-circle-fill"></i><span>Tax Management</span>
      </a>
    </li>
    <li>
      <a href="FinancialIntegration.php">
        <i class="bi bi-circle-fill"></i><span>Financial Integration</span>
      </a>
    </li>
    
  </ul>
</li>
<!-- End Budget Management Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#collection-nav" data-bs-toggle="collapse" href="#">
    <i class="ri-draft-line"></i><span>Collection</span><i class="bi bi-arrow-bar-down ms-auto"></i>
  </a>
  <ul id="collection-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
  <li>
      <a href="InvoicingBilling.php">
        <i class="bi bi-circle-fill"></i><span>Invoice & Billing Management</span>
      </a>
    </li>
  </ul>
</li><!-- End Collection Nav -->

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#general-ledger-nav" data-bs-toggle="collapse" href="#">
    <i class="ri-contacts-book-2-line"></i><span>General Ledger</span><i class="bi bi-arrow-bar-down ms-auto"></i>
  </a>
  <ul id="general-ledger-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
  <li>
      <a href="GeneralLedger.php">
        <i class="bi bi-circle-fill"></i><span>General Ledger Management</span>
      </a>
    </li>
    <li>
      <a href="AuditCompliance.php">
        <i class="bi bi-circle-fill"></i><span>Audit & Compliance</span>
        </a>
    </li>
    <li>
      <a href="CashFlow.php">
        <i class="bi bi-circle-fill"></i><span>Cash Flow Management</span>
      </a>
    </li>
    <li>
      <a href="FinancialReportingAnalysis.php">
        <i class="bi bi-circle-fill"></i><span>Financial Reporting & Analysis</span>
      </a>
    </li>
    <li>
      <a href="FinancialAnalytics.php">
        <i class="bi bi-circle-fill"></i><span>Financial Analytics</span>
      </a>
    </li>
  </ul>
</li><!-- End General Ledger Nav -->
<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#account-payable-nav" data-bs-toggle="collapse" href="#">
    <i class="ri-secure-payment-line"></i><span>Account Payable/Receivable</span><i class="bi bi-arrow-bar-down ms-auto"></i>
  </a>
  <ul id="account-payable-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    
    <li>
      <a href="BookingRevenue.php">
        <i class="bi bi-circle-fill"></i><span>Booking  & Revenue Management</span>
      </a>
    </li>
  </ul>
</li><!-- End Account Payable/Receivable Nav -->
      <hr class="sidebar-divider">  
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Homepage</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
                <!-- Left side columns -->
        


        <div class="col-12">
        <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0">Invoicing and Billing</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#newInvoiceModal">
            + New Invoice
        </button>
    </div>
    <div class="card-body">
    <!-- Invoices Table -->
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Invoice #</th>
                    <th>Client Name</th>
                    <th>Date Issued</th>
                    <th>Due Date</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($invoices as $invoice): ?>
                  <tr>
                      <td><?php echo htmlspecialchars($invoice['invoice_number']); ?></td>
                      <td><?php echo htmlspecialchars($invoice['client_name']); ?></td>
                      <td><?php echo htmlspecialchars($invoice['date_issued']); ?></td>
                      <td><?php echo htmlspecialchars($invoice['due_date']); ?></td>
                      <td>₱<?php echo number_format($invoice['total'], 2); ?></td>
                      <td>
                          <a href="view_invoice.php?id=<?php echo $invoice['id']; ?>" class="btn btn-sm btn-info me-1">View</a>
                          <a href="edit_invoice.php?id=<?php echo $invoice['id']; ?>" class="btn btn-sm btn-secondary me-1">Edit</a>
                          <form method="POST" action="" style="display:inline;">
                              <input type="hidden" name="invoice_id" value="<?php echo $invoice['id']; ?>">
                              <button type="submit" name="delete" class="btn btn-sm btn-danger">Delete</button>
                          </form>
                      </td>
                  </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
    </div>
</div>

</div>
</div>

      <!-- New Invoice Modal -->
<div class="modal fade" id="newInvoiceModal" tabindex="-1" aria-labelledby="newInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newInvoiceModalLabel">Create New Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="clientName" class="form-label">Client Name</label>
                        <input type="text" class="form-control" id="clientName" name="client_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="invoiceDate" class="form-label">Invoice Date</label>
                        <input type="date" class="form-control" id="invoiceDate" name="date_issued" required>
                    </div>
                    <div class="mb-3">
                        <label for="dueDate" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="dueDate" name="due_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="total" required>
                    </div>
                    <input type="hidden" name="invoice_number" value="INV-003"> 
                    <input type="hidden" name="status" value="Pending"> 
                    <button type="submit" class="btn btn-primary" name="add_invoice">Save Invoice</button>
                </form>
            </div>
        </div>
    </div>
</div>


                       
</div>

    </section>
    <section class="section dashboard">
        <?php
    // Check if a success or error message needs to be displayed
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 0; right: 0; z-index: 1050; margin: 60px; display: flex; justify-content: flex-end;">
                <i class="bi bi-check-circle me-1"></i>Record updated successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    } elseif (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Failed to update the record. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>
          <!-- Left side columns -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Audit and Compliance</h5>
      <!-- Table Display -->
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Date</th>
            <th>Compliance Type</th>
            <th>Status</th>
            <th>Comments</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['audit_date']; ?></td>
              <td><?php echo $row['compliance_type']; ?></td>
              <td><?php echo $row['compliance_status']; ?></td>
              <td><?php echo $row['comments']; ?></td>
              <td>
                <!-- Edit Button -->
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateComplianceModal<?php echo $row['id']; ?>">
                  Update
                </button>
              </td>
            </tr>

            <!-- Update Modal -->
            <div class="modal fade" id="updateComplianceModal<?php echo $row['id']; ?>" tabindex="-1">
              <div class="modal-dialog">
                <form method="POST" action="auditcompliance.php">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Update Compliance</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                      <div class="mb-3">
                        <label class="form-label">Compliance Status</label>
                        <select name="compliance_status" class="form-select">
                          <option value="Pending" <?php if ($row['compliance_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                          <option value="Completed" <?php if ($row['compliance_status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Comments</label>
                        <textarea name="comments" class="form-control"><?php echo $row['comments']; ?></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Save Changes</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
 

    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; :P
    </div>
    
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  

  <!-- Template Main JS File -->
  <script src=assets/js/main.js></script>
  <script src="customassets/customjs/signoutnotif.js"></script>
  <script src="customassets/customjs/invoicing.js"></script>
</body>
</html>