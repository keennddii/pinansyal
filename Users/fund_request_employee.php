<?php
include '../customassets/AP/cnnpayable.php';
session_start();
if ($_SESSION['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}

  $payables = $conn->query("
  SELECT 
    ap.*, 
    d.name AS department_name
  FROM 
    accounts_payable ap
  INNER JOIN 
    departments d ON ap.department_id = d.id
  ORDER BY ap.id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
  body {
    background: #f8fafc;
    font-family: 'Segoe UI', sans-serif;
    transition: background 0.3s, color 0.3s;
  }

  body.dark-mode {
    background: #1e293b;
    color: #e2e8f0;
  }

  .sidebar {
    height: 100vh;
    width: 240px;
    background: linear-gradient(160deg, #0d6efd, #3b82f6);
    position: fixed;
    top: 0;
    left: 0;
    transition: width 0.3s;
    overflow-x: hidden;
    z-index: 1000;
    color: white;
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
    border-top-right-radius: 15px;
    border-bottom-right-radius: 15px;
    display: flex;
    flex-direction: column;
  }

  .sidebar.collapsed {
    width: 70px;
  }

  .sidebar-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.2rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
  }

  .sidebar-header span {
    font-size: 1.2rem;
    font-weight: bold;
    white-space: nowrap;
  }

  .sidebar.collapsed .sidebar-header span {
    display: none;
  }

  .toggle-btn {
    background: none;
    border: none;
    color: white;
    font-size: 1.4rem;
    cursor: pointer;
  }

  .dark-toggle {
    background: none;
    border: none;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
    margin-left: 0.5rem;
  }

  .sidebar ul {
    list-style: none;
    padding-left: 0;
    margin-top: 20px;
    flex-grow: 1;
  }

  .nav-item {
    padding: 0.6rem 1rem;
  }

  .nav-bar {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    padding: 10px 12px;
    border-radius: 10px;
    transition: background 0.2s, padding-left 0.3s;
    position: relative;
  }

  .nav-bar:hover {
    background-color: rgba(255, 255, 255, 0.15);
    padding-left: 16px;
  }

  .nav-bar i {
    font-size: 1.2rem;
    margin-right: 10px;
    transition: margin 0.3s;
  }

  .sidebar.collapsed .nav-bar span {
    display: none;
  }

  .sidebar.collapsed .nav-bar i {
    margin-right: 0;
    text-align: center;
    width: 100%;
  }

  .sidebar.collapsed .nav-bar {
    position: relative;
  }

  .sidebar.collapsed .nav-bar[title]:hover::after {
    content: attr(title);
    position: absolute;
    left: 100%;
    top: 50%;
    transform: translateY(-50%);
    background: #1e3a8a;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    white-space: nowrap;
    margin-left: 10px;
    font-size: 0.9rem;
    z-index: 9999;
  }

  .nav-bar.active {
    background-color: rgba(255, 255, 255, 0.3);
    font-weight: bold;
  }

  .main {
    margin-left: 240px;
    padding: 25px;
    transition: margin-left 0.3s;
  }

  .sidebar.collapsed ~ .main {
    margin-left: 80px;
  }

  .card-modern {
    background: white;
    border: none;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.2s ease-in-out;
  }

  .card-modern:hover {
    transform: translateY(-5px);
  }

  .card-icon {
    font-size: 2rem;
    color: #0d6efd;
  }
</style>


</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <span class="fs-5 fw-bold">JVD Travel & Tours</span>
    <button class="toggle-btn" id="toggleBtn"><i class="bi bi-list"></i></button>
  </div>
  <ul>
    <li class="nav-item">
      <a class="nav-bar <?php if(basename($_SERVER['PHP_SELF']) == 'employee_dashboard.php') echo 'active'; ?>" href="employee_dashboard.php">
        <i class="bi bi-house-door"></i><span> Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-bar <?php if(basename($_SERVER['PHP_SELF']) == 'submit_request.php') echo 'active'; ?>" href="submit_request.php">
        <i class="bi bi-journal-plus"></i><span> Submit AP Request</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-bar <?php if(basename($_SERVER['PHP_SELF']) == 'my_request.php') echo 'active'; ?>" href="my_request.php">
        <i class="bi bi-folder2-open"></i><span> My Requests</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-bar <?php if(basename($_SERVER['PHP_SELF']) == 'view_budget.php') echo 'active'; ?>" href="view_budget.php">
        <i class="bi bi-cash-coin"></i><span> View Budget</span>
      </a>
    </li>
    <li class="nav-item mt-auto">
      <a class="nav-bar" href="../signout.php">
        <i class="bi bi-box-arrow-right"></i><span> Logout</span>
      </a>
    </li>
  </ul>
</aside>


  <!-- Main -->
<div class="main" id="main">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <button class="btn btn-primary rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#payableRequestModal">
      <i class="bi bi-plus-circle me-2"></i> New Request
    </button>
  </div>

  <!-- Requests Table -->
  <div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body p-4">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-primary rounded-top-3">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Department</th>
              <th scope="col">Payee</th>
              <th scope="col">Amount</th>
              <th scope="col">Purpose</th>
              <th scope="col">Type</th>
              <th scope="col">Requested By</th>
              <th scope="col">Request Date</th>
              <th scope="col">Status</th>
              <th scope="col">Disbursement</th>
            </tr>
          </thead>
          <tbody id="request-table-body">
            <!-- Dynamic rows inserted here via JS or PHP -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Payable Request Modal -->
  <div class="modal fade" id="payableRequestModal" tabindex="-1" aria-labelledby="payableRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content shadow border-0 rounded-4">
        <div class="modal-header bg-primary text-white rounded-top-4">
          <h5 class="modal-title fw-semibold" id="payableRequestModalLabel">New Payable Request</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Pending Requests Section -->
        <div class="mb-4">
        <div class="table-responsive">
            <table class="table table-sm table-bordered align-middle">
            <thead class="table-light text-center small">
                <tr>
                <th>ID</th>
                <th>Department</th>
                <th>Payee</th>
                <th>Amount</th>
                <th>Purpose</th>
                <th>Status</th>
                </tr>
            </thead>
            <tbody class="small text-center">
                <?php
                if (isset($conn)) {
                $pending = $conn->query("
                SELECT id, department, payee, amount, purpose, status
                FROM request_table
                WHERE status = 'pending'
                ORDER BY request_date DESC
                LIMIT 5
                ");


                    if ($pending->num_rows > 0) {
                    while ($row = $pending->fetch_assoc()):
                ?>
                    <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['department']) ?></td>
                    <td><?= htmlspecialchars($row['payee']) ?></td>
                    <td>₱<?= number_format($row['amount'], 2) ?></td>
                    <td><?= htmlspecialchars($row['purpose']) ?></td>
                    <td><span class="badge bg-warning text-dark"><?= ucfirst($row['status']) ?></span></td>
                    </tr>
                <?php
                    endwhile;
                    } else {
                    echo '<tr><td colspan="6" class="text-center text-muted">No pending requests found.</td></tr>';
                    }
                }
                ?>
            </tbody>
            </table>
        </div>
        </div>

        <form action="assets/submit_payable_request1.php" method="POST">
          <div class="modal-body px-5 py-4">
            <div class="row g-4">
              <div class="col-md-6">
                <label for="pr_payee" class="form-label">Payee</label>
                <input type="text" class="form-control rounded-pill" id="pr_payee" name="payee" required>
              </div>
              <div class="col-md-6">
                <label for="pr_amount" class="form-label">Amount</label>
                <input type="number" step="0.01" class="form-control rounded-pill" id="pr_amount" name="amount" required>
              </div>
              <div class="col-md-6">
                <label for="pr_due_date" class="form-label">Due Date</label>
                <input type="date" class="form-control rounded-pill" id="pr_due_date" name="due_date" required>
              </div>
              <div class="col-md-6">
                <label for="pr_department_id" class="form-label">Department</label>
                <select class="form-select rounded-pill" id="pr_department_id" name="department_id" required>
                  <option value="">-- Select Department --</option>
                  <?php
                    if (isset($conn)) {
                      $departments = $conn->query("SELECT id, name FROM departments");
                      while ($dept = $departments->fetch_assoc()):
                  ?>
                    <option value="<?= $dept['id'] ?>"><?= htmlspecialchars($dept['name']) ?></option>
                  <?php endwhile; } ?>
                </select>
              </div>
              <div class="col-12">
                <label for="pr_account_id" class="form-label">Expense Account</label>
                <select class="form-select rounded-3" id="pr_account_id" name="account_id" required>
                  <option value="">-- Select Expense Account --</option>
                  <optgroup label="For HR Department">
                    <option value="9">Salaries and Wages Expense</option>
                    <option value="10">Training and Development Expense</option>
                    <option value="14">Communication Expense</option>
                  </optgroup>
                  <optgroup label="For Core Department">
                    <option value="6">Travel Expense</option>
                    <option value="7">Utilities Expense</option>
                    <option value="13">Repair and Maintenance Expense</option>
                    <option value="15">Professional Fee Expense</option>
                  </optgroup>
                  <optgroup label="For Logistics Department">
                    <option value="8">Supplies Expense</option>
                    <option value="11">Office Supplies Expense</option>
                    <option value="12">Transportation Expense</option>
                  </optgroup>
                </select>
              </div>
              <div class="col-12">
                <label for="pr_remarks" class="form-label">Remarks</label>
                <textarea class="form-control rounded-3" id="pr_remarks" name="remarks" rows="3"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3">
            <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary rounded-pill">Submit Request</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> <!-- end of main -->


  <!-- Toggle Script -->
  <script>
    const toggleBtn = document.getElementById('toggleBtn');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
    });
  </script>
<script>
  function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("collapsed");
  }

</script>
 
  <script>
    function loadRequests() {
      fetch('../api/get_requests.php')
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
            `;

            tbody.appendChild(row);
          });
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
