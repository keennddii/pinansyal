<?php
include('customassets/AR/coreAPI.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Manual Payment Entry</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Payment ID</label>
                        <input type="text" class="form-control" name="payment_id" value="<?= $generated_id ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Amount</label>
                        <input type="number" name="amount" step="0.01" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Payment Date</label>
                        <input type="date" name="date" class="form-control" required value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Reference No.</label>
                        <input type="text" name="reference_number" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Payment Method</label>
                        <select class="form-select" name="payment_method" required>
                            <option value="">-- Select --</option>
                            <option value="Cash">Cash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Gcash">Gcash</option>
                            <option value="PayMaya">PayMaya</option>
                            <option value="Credit Card">Credit Card</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-success mt-3">Submit Payment</button>
            </form>
        </div>
    </div>

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
                                <td><?= date("F j, Y", strtotime($p['date'])) ?></td>
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

<!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Payment Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
            <li class="list-group-item"><strong>Payment ID:</strong> <span id="modal_payment_id"></span></li>
            <li class="list-group-item"><strong>Amount:</strong> ₱<span id="modal_amount"></span></li>
            <li class="list-group-item"><strong>Date:</strong> <span id="modal_date"></span></li>
            <li class="list-group-item"><strong>Ref #:</strong> <span id="modal_reference"></span></li>
            <li class="list-group-item"><strong>Customer:</strong> <span id="modal_customer"></span></li>
            <li class="list-group-item"><strong>Method:</strong> <span id="modal_method"></span></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- JS dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
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
<script>
    // Search Function
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        document.querySelectorAll("#paymentsTable tbody tr").forEach(function (row) {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });

    // View button
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            let data = JSON.parse(this.getAttribute('data-payment'));
            document.getElementById("modal_payment_id").textContent = data.payment_id;
            document.getElementById("modal_amount").textContent = parseFloat(data.amount).toFixed(2);
            document.getElementById("modal_date").textContent = data.date;
            document.getElementById("modal_reference").textContent = data.reference_number;
            document.getElementById("modal_customer").textContent = data.customer_name;
            document.getElementById("modal_method").textContent = data.payment_method;
            new bootstrap.Modal(document.getElementById('detailsModal')).show();
        });
    });
</script>
</body>
</html>
