<?php
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <!-- Main Page UI: Accounts Payable + Disbursement Dashboard -->
<div class="container py-5">
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
          <th>Particulars</th>
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
              <button class="btn btn-sm btn-outline-success" onclick="openDisburseModal(<?= $row['id'] ?>)">Disburse</button>
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
        <div class="modal-header">
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

<!-- Disbursement Modal -->
<div class="modal fade" id="disburseModal" tabindex="-1" aria-labelledby="disburseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="disburseForm" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="disburseModalLabel">Disburse Payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
          <div class="alert alert-light border mb-3">
          <p class="mb-1"><strong>Original Amount:</strong> ₱<span id="modal_total_amount">0.00</span></p>
          <p class="mb-1"><strong>Total Paid:</strong> ₱<span id="modal_total_paid">0.00</span></p>
          <p class="mb-0"><strong>Remaining Balance:</strong> ₱<span id="modal_balance">0.00</span></p>
          </div>

          <!-- Hidden Payable ID -->
          <input type="hidden" id="disburse_payable_id" name="payable_id">

          <div class="mb-3">
            <label for="disbursement_date" class="form-label">Disbursement Date</label>
            <input type="date" class="form-control" id="disbursement_date" name="disbursement_date" required>
          </div>

          <div class="mb-3">
            <label for="disburse_amount" class="form-label">Amount</label>
            <input type="number" step="0.01" class="form-control" id="disburse_amount" name="disburse_amount" required>
          </div>

          <div class="mb-3">
            <label for="disburse_remarks" class="form-label">Remarks</label>
            <textarea class="form-control" id="disburse_remarks" name="disburse_remarks"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit Disbursement</button>
        </div>
      </div>
    </form>
  </div>
</div>


</div>
 
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
          throw new Error('Disbursement failed');
        }
        return response.text();
      })
      .catch(error => {
        Swal.showValidationMessage(`Request failed: ${error}`);
      });
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then(result => {
    if (result.isConfirmed) {
      Swal.fire({
        title: 'Success!',
        text: result.value,
        icon: 'success'
      }).then(() => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('disburseModal'));
        modal.hide();
        form.reset();
        location.reload();
      });
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
</html>