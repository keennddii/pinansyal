  <?php
  include('customassets/cnn/user.php');
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>General Ledger</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/jeybidi.png" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="customassets/customcss/signoutnotif.css">
    <style>
    /* Animation styles for General Ledger */
    .animate-up {
      color: green;
      font-weight: bold;
      animation: riseEffect 0.4s ease-in;
    }
    .animate-down {
      color: red;
      font-weight: bold;
      animation: dropEffect 0.4s ease-in;
    }
    @keyframes riseEffect {
      0% { transform: translateY(5px); opacity: 0.5; }
      100% { transform: translateY(0); opacity: 1; }
    }
    @keyframes dropEffect {
      0% { transform: translateY(-5px); opacity: 0.5; }
      100% { transform: translateY(0); opacity: 1; }
    }
    </style>
    
  </head>

  <body>


    <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>
      <!-- Para sa logo -->

      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

          <!-- DITO NAKALAGAY YUNG SA PROFILE NUNG NAKALOGIN -->
          <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="assets/img/prof.jpg" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $username; ?></span>
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
    </header>


    <aside id="sidebar" class="sidebar">
      <!-- Start ng Side Bar -->

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

    <ul class="nav nav-tabs" id="ledgerTabs">
      <li class="nav-item">
        <a class="nav-link active" id="summary-tab" data-bs-toggle="tab" href="#journalentries">Journal Entries</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="generalledeger-tab" data-bs-toggle="tab" href="#generalledger">General Ledger</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="chartofaccounts-tab" data-bs-toggle="tab" href="#chartofaccounts">Chart of Accounts</a>
      </li>
    </ul>

    <div class="tab-content mt-4">

      <!-- JOURNAL ENTRIES -->
      <div class="tab-pane fade show active" id="journalentries">
        <div class="card shadow-sm rounded bg-white p-3">
          <h2 class="mb-4">Journal Entries</h2>
          <div id="journalentries-content" class="table-responsive">
            <!-- Dynamic Journal Entries Table will be loaded here -->
          </div>
        </div>
      </div>

      <!-- GENERAL LEDGER -->
      <div class="tab-pane fade" id="generalledger">
        <div class="card shadow-sm rounded bg-white p-3">
          <h2 class="mb-4">General Ledger</h2>
          <div id="generalledger" class="table-responsive">
            <!-- Dynamic General Ledger Table will be loaded here -->
          </div>
        </div>
      </div>

      <!-- CHART OF ACCOUNTS -->
      <div class="tab-pane fade" id="chartofaccounts">
        <div class="card shadow-sm rounded bg-white p-3">
          <h2 class="mb-4">Chart of Accounts</h2>
          <div id="chartofaccounts" class="table-responsive">
            <!-- Dynamic COA Table will be loaded here -->
          </div>
        </div>
      </div>

    </div>

    <!-- Ledger Details Modal -->
    <div class="modal fade" id="viewLedgerDetails" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ledger Details - <span id="ledgerTitle"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body table-responsive">
            <table class="table table-bordered table-hover table-sm shadow-sm rounded" id="ledgerDetailsTable">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Debit</th>
                  <th>Credit</th>
                  <th>Module</th>
                  <th>Reference</th>
                  <th>Remarks</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
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
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>

    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="customassets/customjs/signoutnotif.js"></script>
    <script src="customassets/customjs/screenshot.js"></script>
    <script>
let previousGL = {}; // Only once

$(document).ready(function () {

    // ✅ viewLedgerDetails - Move this here so it's part of this block
    function viewLedgerDetails(accountId, accountName) {
        $('#ledgerTitle').text(accountName);
        $('#ledgerDetailsTable tbody').html('<tr><td colspan="6">Loading...</td></tr>');

        $.ajax({
            url: 'customassets/GL/ledger_details.php',
            method: 'GET',
            data: { account_id: accountId },
            dataType: 'json',
            success: function(data) {
                let rows = '';
                if (data.length === 0) {
                    rows = '<tr><td colspan="6" class="text-center">No entries found.</td></tr>';
                } else {
                    data.forEach(function(e){
                        rows += '<tr>'
                              + '<td>' + e.transaction_date + '</td>'
                              + '<td>₱' + e.debit.toLocaleString(undefined, {minimumFractionDigits: 2}) + '</td>'
                              + '<td>₱' + e.credit.toLocaleString(undefined, {minimumFractionDigits: 2}) + '</td>'
                              + '<td>' + e.module_type + '</td>'
                              + '<td>' + e.reference_id + '</td>'
                              + '<td>' + e.remarks + '</td>'
                              + '</tr>';
                    });
                }

                $('#ledgerDetailsTable tbody').html(rows);
                const modal = new bootstrap.Modal(document.getElementById('viewLedgerDetails'));
                modal.show();
            },
            error: function(e){
                console.error('Error fetching ledger details:', e);
                $('#ledgerDetailsTable tbody').html('<tr><td colspan="6" class="text-danger">Error loading data.</td></tr>');
            }
        });
    }

    window.viewLedgerDetails = viewLedgerDetails; // Make accessible outside

    // JOURNAL ENTRIES
    $.ajax({
        url: 'customassets/GL/journal_entry.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            let journalEntriesHtml = '<table id="journalTable" class="table table-striped">';
            journalEntriesHtml += '<thead><tr><th>Account Name</th><th>Debit</th><th>Credit</th><th>Module Type</th><th>Date</th></tr></thead><tbody>';

            data.forEach(function (entry) {
                journalEntriesHtml += '<tr>';
                journalEntriesHtml += '<td>' + entry.account_name + '</td>';
                journalEntriesHtml += '<td>' + entry.debit + '</td>';
                journalEntriesHtml += '<td>' + entry.credit + '</td>';
                journalEntriesHtml += '<td>' + entry.module_type + '</td>';
                journalEntriesHtml += '<td>' + entry.transaction_date + '</td>';
                journalEntriesHtml += '</tr>';
            });

            journalEntriesHtml += '</tbody></table>';
            $('#journalentries-content').html(journalEntriesHtml);

            $('#journalTable').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                ordering: false
            });
        },
        error: function (error) {
            console.error("Error fetching journal entries:", error);
        }
    });

    // GENERAL LEDGER
    function fetchGeneralLedger() {
        $.ajax({
            url: 'customassets/GL/general_ledger.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var html = '<table class="table table-striped"><thead>'
                         + '<tr>'
                         +   '<th>Account Name</th>'
                         +   '<th>Total Debit</th>'
                         +   '<th>Total Credit</th>'
                         +   '<th>Balance</th>'
                         +   '<th>Action</th>'
                         + '</tr>'
                         + '</thead><tbody>';

                data.forEach(function(r){
                    let key = r.account_name;
                    let prev = previousGL[key] || { debit: 0, credit: 0, balance: 0 };

                    let debitDiff = r.total_debit - prev.debit;
                    let creditDiff = r.total_credit - prev.credit;
                    let balanceDiff = r.balance - prev.balance;

                    let debitClass = debitDiff > 0 ? 'animate-up' : (debitDiff < 0 ? 'animate-down' : '');
                    let creditClass = creditDiff > 0 ? 'animate-up' : (creditDiff < 0 ? 'animate-down' : '');
                    let balanceClass = balanceDiff > 0 ? 'animate-up' : (balanceDiff < 0 ? 'animate-down' : '');

                    let debitIcon = debitDiff > 0 ? ' 🔺' : (debitDiff < 0 ? ' 🔻' : '');
                    let creditIcon = creditDiff > 0 ? ' 🔺' : (creditDiff < 0 ? ' 🔻' : '');
                    let balanceIcon = balanceDiff > 0 ? ' 🔺' : (balanceDiff < 0 ? ' 🔻' : '');

                    html += '<tr>'
                          +   '<td>'+ r.account_name +'</td>'
                          +   '<td class="'+debitClass+'">₱'+ r.total_debit.toLocaleString(undefined,{minimumFractionDigits:2}) + debitIcon +'</td>'
                          +   '<td class="'+creditClass+'">₱'+ r.total_credit.toLocaleString(undefined,{minimumFractionDigits:2}) + creditIcon +'</td>'
                          +   '<td class="'+balanceClass+'">₱'+ r.balance.toLocaleString(undefined,{minimumFractionDigits:2}) + balanceIcon +'</td>'
                          +   '<td><button class="btn btn-sm btn-primary" onclick="viewLedgerDetails('+ r.account_id +', \''+ r.account_name.replace(/'/g, "\\'") +'\')">View</button></td>'
                          + '</tr>';

                    previousGL[key] = {
                        debit: r.total_debit,
                        credit: r.total_credit,
                        balance: r.balance
                    };
                });

                html += '</tbody></table>';
                $('#generalledger').html(html);
            },
            error: function(e){
                console.error('GL fetch error:', e);
            }
        });
    }

    fetchGeneralLedger();
    setInterval(fetchGeneralLedger, 5000);

    // CHART OF ACCOUNTS
    $.ajax({
        url: 'customassets/GL/chart_of_accounts.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var html = '<table class="table table-striped"><thead>'
                     + '<tr><th>Code</th><th>Name</th><th>Type</th><th>Description</th></tr>'
                     + '</thead><tbody>';
            data.forEach(function(r){
                html += '<tr>'
                     +  '<td>'+ r.account_code +'</td>'
                     +  '<td>'+ r.account_name +'</td>'
                     +  '<td>'+ r.account_type +'</td>'
                     +  '<td>'+ r.description +'</td>'
                     +  '</tr>';
            });
            html += '</tbody></table>';
            $('#chartofaccounts').html(html);
        },
        error: function(e){
            console.error('COA fetch error:', e);
        }
    });

});
</script>


  </body>

  </html>