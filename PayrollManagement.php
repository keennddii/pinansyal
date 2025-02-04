<?php
include('buttons/fetch_payroll.php');
include('customassets/cnn/user.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Payroll Management | Finance</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/jvd.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
  <link rel="stylesheet" href="customcss/savebutton.css">
  <link rel="stylesheet" href="customassets/customcss/signoutnotif.css">

</head>

<body>

 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">
  
  <div class="d-flex align-items-center justify-content-between">
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>
  <!-- End Logo -->
  
  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">




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
  </nav>

</header>

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
        <a class="nav-link " href="dashboard.php">
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
    <h1>Payroll Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <?php if (isset($_GET['update']) && $_GET['update'] == 'success'): ?>
    <div class="alert alert-success" role="alert">
        Payroll record updated successfully!
    </div>
  <?php endif; ?>

  <h2>Payrolls</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Employee Name</th>
        <th>Pay Period Start</th>
        <th>Pay Period End</th>
        <th>Gross Pay</th>
        <th>Net Pay</th>
        <th>Total Deductions</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result_payrolls->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['employee_name']; ?></td>
          <td><?php echo $row['pay_period_start']; ?></td>
          <td><?php echo $row['pay_period_end']; ?></td>
          <td><?php echo number_format($row['gross_pay'], 2); ?></td>
          <td><?php echo number_format($row['net_pay'], 2); ?></td>
          <td><?php echo number_format($row['total_deductions'], 2); ?></td>
          <td><?php echo $row['status']; ?></td>
          <td>
          <a href="buttons/payslip.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary me-1" target="_blank">
    Print
          </a>

            <button class="btn btn-danger btn-sm"><i class="bi"></i> Archive</button>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
    </table>

  

</main>

<!-- Footer -->
<footer id="footer" class="footer">
  <div class="container">
    <div class="credits">
      <span>© 2024</span> 
    </div>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
  // Ensure the modal works
  const modals = document.querySelectorAll('.modal');
  modals.forEach(modal => new bootstrap.Modal(modal));

  // Print Payroll
  function printPayroll(id) {
    window.open('buttons/payslip.php?id=' + id, '_blank');
  }
</script>
</body>

</html>