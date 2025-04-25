<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Disbursement Module</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Disbursement Records</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disburseModal">+ Add Disbursement</button>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Payable ID</th>
          <th>Date</th>
          <th>Amount Paid</th>
          <th>Payment Method</th>
          <th>Remarks</th>
        </tr>
        </thead>
        <tbody id="disbursementTable">
          <!-- Dynamic disbursement rows here -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="disburseModal" tabindex="-1" aria-labelledby="disburseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="disburseForm" class="needs-validation" novalidate>
      <div class="modal-content shadow-lg rounded-4">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title fw-semibold" id="disburseModalLabel">Add Disbursement</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body row g-4">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="payable_id" class="form-label">Select Payable</label>
              <select class="form-select" id="payable_id" name="payable_id" required>
                <option value="">-- Select --</option>
              </select>
              <div class="invalid-feedback">Please select a payable.</div>
            </div>

            <div class="mb-3">
              <label for="disbursement_date" class="form-label">Disbursement Date</label>
              <input type="date" class="form-control" name="disbursement_date" required>
              <div class="invalid-feedback">Please provide a date.</div>
            </div>

            <div class="mb-3">
              <label for="payment_method" class="form-label">Payment Method</label>
              <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="">Select method</option>
                <option value="Cash">Cash</option>
                <option value="Check">Check</option>
                <option value="Bank Transfer">Bank Transfer</option>
              </select>
              <div class="invalid-feedback">Please choose a method.</div>
            </div>

            <div class="mb-3">
              <label for="disburse_amount" class="form-label">Amount</label>
              <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="number" step="0.01" class="form-control" name="disburse_amount" required>
              </div>
              <div class="invalid-feedback">Enter a valid amount.</div>
            </div>

            <div class="mb-3">
              <label for="disburse_remarks" class="form-label">Remarks</label>
              <textarea class="form-control" name="disburse_remarks" rows="3" placeholder="Optional..."></textarea>
            </div>
          </div>

          <div class="col-md-6">
            <div class="p-3 bg-light border rounded-3 shadow-sm h-100">
              <h6 class="mb-3 text-primary fw-bold">Payable Details</h6>
              <div id="payableDetails">
                <p class="text-muted">Select a payable to view its details.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success px-4">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
  const disburseForm = document.getElementById('disburseForm');
  const disbursementTable = document.getElementById('disbursementTable');
  const payableSelect = document.getElementById('payable_id');
  const payableDetails = document.getElementById('payableDetails');

  disburseForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    try {
      const response = await fetch('customassets/DS/save_disbursements.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.text();
      const isSuccess = result.toLowerCase().includes('successfully');

      Swal.fire({
        icon: isSuccess ? 'success' : 'error',
        title: isSuccess ? 'Success!' : 'Oops!',
        text: result,
        confirmButtonColor: '#3085d6'
      }).then(() => {
        if (isSuccess) {
          this.reset();
          bootstrap.Modal.getInstance(document.getElementById('disburseModal')).hide();
          loadDisbursementTable();
          loadUnpaidPayables(); 
          payableDetails.innerHTML = `<p class="text-muted">Select a payable to view its details.</p>`;
        }
      });


    } catch (error) {
      console.error('Submission error:', error);
      Swal.fire('Error', 'Something went wrong while submitting.', 'error');
    }
  });

  async function loadDisbursementTable() {
    try {
      const response = await fetch('customassets/DS/fetch_disbursements.php');
      const data = await response.json();

      disbursementTable.innerHTML = '';

      if (data.length === 0) {
        disbursementTable.innerHTML = `<tr><td colspan="6" class="text-center text-muted">No disbursements found.</td></tr>`;
        return;
      }

      data.forEach((row, index) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${index + 1}</td>
          <td>#${row.payable_id}</td>
          <td>${row.disbursement_date}</td>
          <td>₱${parseFloat(row.amount_paid).toFixed(2)}</td>
          <td>${row.payment_method}</td>
          <td>${row.remarks}</td>
        `;
        disbursementTable.appendChild(tr);
      });
    } catch (error) {
      console.error('Error loading disbursements:', error);
      disbursementTable.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Failed to load disbursements.</td></tr>`;
    }
  }

  async function loadUnpaidPayables() {
  try {
    const res = await fetch('customassets/DS/fetch_unpaid_payables.php');
    const data = await res.json();

    payableSelect.innerHTML = '<option value="">-- Select --</option>';

    data.forEach(row => {
      const opt = document.createElement('option');
      opt.value = row.id;

      // Display only "#ID - Payee"
      opt.textContent = `#${row.id} - ${row.payee}`;
      
      // Store extra data as dataset
      opt.dataset.payee = row.payee;
      opt.dataset.remaining = row.remaining_amount;
      opt.dataset.due = row.due_date;

      payableSelect.appendChild(opt);
    });

  } catch (error) {
    console.error('Error fetching payables:', error);
    Swal.fire('Error', 'Unable to fetch unpaid payables.', 'error');
  }
}

// Update details when selecting payable
payableSelect.addEventListener('change', function () {
  const selected = this.selectedOptions[0];
  const amountInput = disburseForm.querySelector('[name="disburse_amount"]');

  if (!selected.value) {
    payableDetails.innerHTML = `<p class="text-muted">Select a payable to view its details.</p>`;
    amountInput.removeAttribute('max');
    return;
  }

  const payee = selected.dataset.payee;
  const remaining = parseFloat(selected.dataset.remaining).toFixed(2);
  const due = selected.dataset.due;

  payableDetails.innerHTML = `
    <h6 class="mb-2 fw-semibold">Supplier: ${payee}</h6>
    <p><strong>Remaining Amount:</strong> ₱${remaining}</p>
    <p><strong>Due Date:</strong> ${due}</p>
  `;

  // Set max attribute to prevent overpayment
  amountInput.max = remaining;
  amountInput.value = '';
  
  amountInput.addEventListener('input', function () {
    if (parseFloat(this.value) > parseFloat(remaining)) {
      Swal.fire({
        icon: 'warning',
        title: 'Amount exceeds remaining balance',
        text: `Maximum disbursable amount is ₱${remaining}`,
      });
      this.value = remaining;
    }
  });
});



  // Initial loads
  loadUnpaidPayables();
  loadDisbursementTable();
});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
