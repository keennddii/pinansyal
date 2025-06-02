<?php
include('customassets/cnn/user.php');
include('customassets/AR/save_receivable.php');
include('customassets/AR/coreAPI.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Account Receivable</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/jeybidi.png" rel="icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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



  <aside id="sidebar" class="sidebar"><!-- Start ng Side Bar -->

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
<h2>Accounts Receivable List</h2>
<div class="card shadow-sm rounded-4 p-3">
<div class="table-responsive">
    <table id="arDataTable" class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
                <th>Invoice No.</th>
                <th>Client/Customer Name</th>
                <th>Payment Date</th>
                <th>Amount Due (₱)</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="arTable">
            <?php
            include('customassets/AR/list_receivables.php');
            ?>
        </tbody>
    </table>
</div>

<!-- Add Bill Modal -->
<div class="modal fade" id="addBillModal" tabindex="-1" aria-labelledby="addBillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBillModalLabel">Add New Bill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addBillForm" method="POST">
                    <div class="mb-3">
                        <label for="clientName" class="form-label">Client/Customer Name</label>
                        <input type="text" class="form-control" id="clientName" name="client_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="bookingDate" class="form-label">Payment Date</label>
                        <input type="date" class="form-control" id="bookingDate" name="booking_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="amountDue" class="form-label">Amount Due</label>
                        <input type="number" class="form-control" id="amountDue" name="amount_due" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Bill</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Button to trigger the modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBillModal">
    Add New Bill
</button>
<br><br><br>

<!-- Tabs naman para sa  CORE 1 -->
  <h2 class="mb-4">List of Payments</h2>
  <ul class="nav nav-tabs" id="bookingTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#vehicle-tab" type="button" role="tab">Vehicle</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#hotel-tab" type="button" role="tab">Hotel</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tour-tab" type="button" role="tab">Tour</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#card-tab" type="button" role="tab">ID payments</button>
    </li>
  </ul>

  <div class="tab-content mt-4">
    <!-- Vehicle Bookings -->
    <div class="tab-pane fade show active" id="vehicle-tab" role="tabpanel">
      <div class="card shadow-sm">
        <div class="card-body">
          <button onclick="loadVehicleBookings()" class="btn btn-outline-primary mb-3">Refresh Vehicle Bookings</button>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="table-dark">
                <tr>
                  <th>#</th>
                  <th>Full Name</th>
                  <th>Total Price</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="vehicle-body">
                <tr><td colspan="6" class="text-center">Loading...</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<!-- Hotel Bookings -->
<div class="tab-pane fade" id="hotel-tab" role="tabpanel">
  <div class="card shadow-sm">
    <div class="card-body">
      <button onclick="loadHotelBookings()" class="btn btn-outline-primary mb-3">Refresh Hotel Bookings</button>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Full Name</th>
              <th>Total Price</th>
              <th>Created At</th>
              <th>Actions</th>
              
            </tr>
          </thead>
          <tbody id="hotel-body">
            <tr><td colspan="7" class="text-center">Loading...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


 <!-- Tour Bookings -->
<div class="tab-pane fade" id="tour-tab" role="tabpanel">
  <div class="card shadow-sm">
    <div class="card-body">
      <button onclick="loadTourBookings()" class="btn btn-outline-primary mb-3">Refresh Tour Bookings</button>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Full Name</th>
              <th>Booking Date</th> 
              <th>Total Price</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="tour-body">
            <tr><td colspan="6" class="text-center">Loading...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

 <!-- Integration sa Core 2 to-->
<div class="tab-pane fade" id="card-tab" role="tabpanel">
<!-- Table -->
<div class="card shadow mt-4">
    <div class="card-header bg-dark text-white d-flex justify-content-between">
        <h5 class="mb-0">Payments</h5>
        <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">
    </div>
    <div class="card-body p-0">
        <?php if (count($payments)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" id="paymentsTable">
                    <thead class="table-light">
                        <tr>
                            <th>Payment ID</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payments as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['payment_id']) ?></td>
                                <td><?= number_format($p['amount'], 2) ?></td>
                                <td><?= htmlspecialchars($p['date']) ?></td>
                                <td><?= htmlspecialchars($p['customer_name']) ?></td>
                                <td><?= htmlspecialchars($p['payment_method']) ?></td>
                                <td>
                                    <?php if ($p['status'] === 'Done'): ?>
                                        <span class="badge bg-success">Done</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($p['status'] === 'Done'): ?>
                                        <button class="btn btn-secondary btn-sm" disabled>Done</button>
                                    <?php else: ?>
                                        <button class="btn btn-success btn-sm"
                                            onclick="markPaymentAsDone(<?= $p['id'] ?>)">Mark as Done</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="p-3 text-center">No payments found.</div>
        <?php endif ?>
    </div>
</div>
</div>
 
</div> 


<!-- Pay Modal -->
<div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="payForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="payModalLabel">Pay Invoice</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- Hidden -->
          <input type="hidden" id="pay_id" name="id">


          <!-- 💵 Payment Form -->
          <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
              <option value="">Select method</option>
              <option value="Cash">Cash</option>
              <option value="Bank Transfer">Bank Transfer</option>
              <option value="Credit Card">Credit Card</option>
              <option value="GCash">GCash</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="payment_date" class="form-label">Payment Date</label>
            <input type="date" class="form-control" id="payment_date" name="payment_date" required>
          </div>

          <div class="mb-3">
            <label for="amount_paid" class="form-label">Amount Paid</label>
            <input type="number" step="0.01" class="form-control" id="amount_paid" name="amount_paid" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit Payment</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>



<!-- View Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="detailsModalLabel">Invoice Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="detailsContent">
              <!-- Details will be loaded here dynamically -->
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src=assets/js/main.js></script>
  <script src="customassets/customjs/signoutnotif.js"></script>
  <script src=customassets/customjs/collection.js></script>
  <script src=customassets/customjs/screenshot.js></script>
  <script src="customassets/customjs/AR/bookings.js"></script>
  <script>
  function openPayModal(id) {
    document.getElementById('pay_id').value = id;
    var payModal = new bootstrap.Modal(document.getElementById('payModal'));
    payModal.show();
}

function openDetailsModal(id) {
    // Ajax fetch details
    fetch('customassets/AR/fetch_ar_details.php?id=' + id)
    .then(response => response.text())
    .then(data => {
        document.getElementById('detailsContent').innerHTML = data;
        var detailsModal = new bootstrap.Modal(document.getElementById('detailsModal'));
        detailsModal.show();
    });
}

document.addEventListener("DOMContentLoaded", function () {
  const dataTable = new simpleDatatables.DataTable("#arDataTable", {
    perPage: 10,
    perPageSelect: [5, 10, 25, 50, 100]
  });
});

// Handle Pay form submit
document.getElementById('payForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('customassets/AR/update_payment.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    // ✅ Optional: use SweetAlert if available
    if (typeof Swal !== "undefined") {
      Swal.fire({
        title: 'Success!',
        text: data,
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('payModal'));
        modal.hide(); // Close modal
        location.reload(); // Reload the table
      });
    } else {
      alert(data);
      const modal = bootstrap.Modal.getInstance(document.getElementById('payModal'));
      modal.hide();
      location.reload();
    }
  })
  .catch(error => {
    console.error('Payment error:', error);
    alert('Something went wrong while processing payment.');
  });
});

function voidInvoice(id) {
  if (typeof Swal !== "undefined") {
    Swal.fire({
      title: "Are you sure?",
      text: "This invoice will be voided and journal entries reversed.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, void it!",
      cancelButtonText: "Cancel"
    }).then((result) => {
      if (result.isConfirmed) {
        fetch('customassets/AR/update_payment.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'id=' + encodeURIComponent(id) + '&void=1'
        })
        .then(res => res.text())
        .then(data => {
          Swal.fire({
            title: "Voided!",
            text: data,
            icon: "success"
          }).then(() => {
            location.reload();
          });
        })
        .catch(err => {
          console.error(err);
          Swal.fire("Error", "Something went wrong.", "error");
        });
      }
    });
  } else {
    // fallback confirm
    if (confirm("Are you sure you want to void this invoice?")) {
      const form = new FormData();
      form.append("id", id);
      form.append("void", "1");

      fetch('customassets/AR/update_payment.php', {
        method: "POST",
        body: form
      }).then(() => location.reload());
    }
  }
}
</script>

<!-- Javascript to ng table sa core2 -->
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        document.querySelectorAll("#paymentsTable tbody tr").forEach(function (row) {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });

function markPaymentAsDone(paymentId) {
  Swal.fire({
    title: "Mark as Done?",
    text: "Are you sure this payment is complete?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Yes, mark it",
    cancelButtonText: "Cancel"
  }).then((result) => {
    if (result.isConfirmed) {
      fetch("api/mark-payment-done.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `payment_id=${paymentId}`
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === "success") {
          Swal.fire("Marked as Done", "", "success").then(() => location.reload());
        } else {
          Swal.fire("Error", data.message, "error");
        }
      });
    }
  });
}
</script>
</body>

</html>