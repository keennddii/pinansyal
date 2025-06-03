<?php
include 'assets/db.php';
session_start();
if ($_SESSION['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}
  $my_username = $_SESSION['username'];
  $my_payables = $conn->query("
    SELECT pr.id, pr.payee, pr.amount, pr.due_date, d.name AS department, pr.status
    FROM payable_requests pr
    LEFT JOIN departments d ON pr.department_id = d.id
    WHERE pr.requested_by = '" . $conn->real_escape_string($my_username) . "'
    ORDER BY pr.created_at DESC
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
      <a class="nav-bar <?php if(basename($_SERVER['PHP_SELF']) == 'fund_request_employee.php') echo 'active'; ?>" href="fund_request_employee.php">
        <i class="bi bi-journal-plus"></i><span> Submit AP Request</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-bar <?php if(basename($_SERVER['PHP_SELF']) == 'my_request.php') echo 'active'; ?>" href="my_request.php">
        <i class="bi bi-folder2-open"></i><span> My Requests</span>
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
<div class="container my-4">
  <div class="card shadow rounded-4 border-0">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-primary mb-0">My Payable Requests</h5>
        <input type="text" class="form-control w-25" placeholder="Search..." id="searchInput">
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle text-center" id="payableTable">
          <thead class="table-primary">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Payee</th>
              <th scope="col">Amount</th>
              <th scope="col">Due Date</th>
              <th scope="col">Department</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($my_payables->num_rows > 0): ?>
              <?php while ($row = $my_payables->fetch_assoc()): ?>
                <tr>
                  <td><?= $row['id'] ?></td>
                  <td class="text-start"><?= htmlspecialchars($row['payee']) ?></td>
                  <td class="text-end text-success">₱<?= number_format($row['amount'], 2) ?></td>
                  <td><?= date('M d, Y', strtotime($row['due_date'])) ?></td>
                  <td><?= htmlspecialchars($row['department']) ?></td>
                  <td>
                    <?php
                      switch ($row['status']) {
                        case 'Approved':
                          echo '<span class="badge rounded-pill bg-success px-3">Approved</span>';
                          break;
                        case 'Rejected':
                          echo '<span class="badge rounded-pill bg-danger px-3">Rejected</span>';
                          break;
                        default:
                          echo '<span class="badge rounded-pill bg-warning text-dark px-3">Pending</span>';
                          break;
                      }
                    ?>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr><td colspan="6" class="text-muted">No payable requests found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


  </div><!-- End of Main -->

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
  document.getElementById("searchInput").addEventListener("keyup", function () {
    var value = this.value.toLowerCase();
    var rows = document.querySelectorAll("#payableTable tbody tr");
    rows.forEach(function (row) {
      row.style.display = row.textContent.toLowerCase().includes(value) ? "" : "none";
    });
  });
</script>

</body>
</html>
