<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fund Requests</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light p-4">
  <div class="container">
    <h2 class="mb-4">Fund Requests</h2>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Department</th>
          <th>Payee</th>
          <th>Amount</th>
          <th>Purpose</th>
          <th>Type</th>
          <th>Requested By</th>
          <th>Request Date</th>
          <th>Status</th>
          <th>Disbursement</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="request-table-body"></tbody>
    </table>
  </div>

  <script>
    function loadRequests() {
      fetch('api/get_requests.php')
        .then(res => res.json())
        .then(data => {
          const tbody = document.getElementById('request-table-body');
          tbody.innerHTML = '';

          data.forEach(req => {
            const row = document.createElement('tr');

            const actionButtons = () => {
              if (req.status === 'pending') {
                return `
                  <button class="btn btn-success btn-sm me-1" onclick="updateStatus(${req.id}, 'approved')">Approve</button>
                  <button class="btn btn-danger btn-sm" onclick="updateStatus(${req.id}, 'rejected')">Reject</button>
                `;
              } else if (req.status === 'approved' && req.disbursement_status === 'not_disbursed') {
                return `
                  <button class="btn btn-primary btn-sm" onclick="markDisbursed(${req.id})">Mark as Disbursed</button>
                `;
              } else {
                return '-';
              }
            };

            row.innerHTML = `
              <td>${req.id}</td>
              <td>${req.department}</td>
              <td>${req.payee}</td>
              <td>₱${parseFloat(req.amount).toFixed(2)}</td>
              <td>${req.purpose}</td>
              <td>${req.request_type}</td>
              <td>${req.requested_by}</td>
              <td>${req.request_date}</td>
              <td><span class="badge bg-${getBadgeColor(req.status)}">${req.status}</span></td>
              <td><span class="badge bg-${getDisburseColor(req.disbursement_status)}">${req.disbursement_status}</span></td>
              <td>${actionButtons()}</td>
            `;

            tbody.appendChild(row);
          });
        });
    }

    function updateStatus(id, status) {
      fetch('api/update_request_status.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ id, status })
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire("Updated", data.message, "success");
          loadRequests();
        } else {
          Swal.fire("Error", data.message, "error");
        }
      });
    }

    function markDisbursed(id) {
      fetch('api/update_disbursement_status.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire("Disbursed", data.message, "success");
          loadRequests();
        } else {
          Swal.fire("Error", data.message, "error");
        }
      });
    }

    function getBadgeColor(status) {
      switch (status) {
        case 'approved': return 'success';
        case 'rejected': return 'danger';
        case 'pending': return 'warning';
        default: return 'secondary';
      }
    }

    function getDisburseColor(status) {
      switch (status) {
        case 'disbursed': return 'success';
        case 'not_disbursed': return 'secondary';
        default: return 'secondary';
      }
    }

    // Initial load
    loadRequests();
  </script>
</body>
</html>
