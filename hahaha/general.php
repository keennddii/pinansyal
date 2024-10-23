<?php
// Placeholder for Account and Journal Data
$accounts = [
    ['id' => 1, 'account_code' => '101', 'account_name' => 'Cash', 'account_type' => 'Asset'],
    ['id' => 2, 'account_code' => '202', 'account_name' => 'Accounts Receivable', 'account_type' => 'Asset'],
    ['id' => 3, 'account_code' => '301', 'account_name' => 'Sales Revenue', 'account_type' => 'Revenue'],
    ['id' => 4, 'account_code' => '401', 'account_name' => 'Expenses', 'account_type' => 'Expense'],
];

$journalEntries = [
    ['id' => 1, 'description' => 'Payment from Client A', 'debit_account' => 'Cash', 'credit_account' => 'Sales Revenue', 'amount' => 500],
    ['id' => 2, 'description' => 'Purchase of office supplies', 'debit_account' => 'Expenses', 'credit_account' => 'Cash', 'amount' => 150],
];

// Placeholder for Reconciliation Status
$reconciliations = [
    ['account_name' => 'Cash', 'status' => 'Completed'],
    ['account_name' => 'Accounts Receivable', 'status' => 'Pending'],
];

// Handle form submission for adding new accounts
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_account'])) {
    // Add a new account to the $accounts array (In real-world app, you should save this in DB)
    $newAccount = [
        'id' => count($accounts) + 1,
        'account_code' => $_POST['account_code'],
        'account_name' => $_POST['account_name'],
        'account_type' => $_POST['account_type'],
    ];
    $accounts[] = $newAccount;
    header("Location: general_ledger.php"); // Reload the page to see the new account
}

// Handle form submission for adding journal entries
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_journal_entry'])) {
    // Add a new journal entry to the $journalEntries array
    $newEntry = [
        'id' => count($journalEntries) + 1,
        'description' => $_POST['description'],
        'debit_account' => $_POST['debit_account'],
        'credit_account' => $_POST['credit_account'],
        'amount' => $_POST['amount'],
    ];
    $journalEntries[] = $newEntry;
    header("Location: general_ledger.php"); // Reload the page to see the new journal entry
}

// Handle account reconciliation updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reconcile_account'])) {
    // Update reconciliation status (In real-world app, this should be saved in the database)
    $selectedAccount = $_POST['account_id'];
    $reconciliationStatus = $_POST['status'];
    
    foreach ($reconciliations as &$reconciliation) {
        if ($reconciliation['account_name'] === $accounts[$selectedAccount - 1]['account_name']) {
            $reconciliation['status'] = $reconciliationStatus;
        }
    }
    header("Location: general_ledger.php"); // Reload the page to see the updated status
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General Ledger Management</title>
    <link rel="stylesheet" href="general.css">
</head>
<body>

<div class="container">
    <header>
        <h1>General Ledger Management</h1>
        <p>Manage your accounts, journal entries, and financial transactions.</p>
    </header>

    <!-- Chart of Accounts Section -->
    <section class="chart-of-accounts">
        <h2>Chart of Accounts</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="account-code">Account Code:</label>
                <input type="text" id="account-code" name="account_code" required>
            </div>
            <div class="form-group">
                <label for="account-name">Account Name:</label>
                <input type="text" id="account-name" name="account_name" required>
            </div>
            <div class="form-group">
                <label for="account-type">Account Type:</label>
                <select id="account-type" name="account_type" required>
                    <option value="Asset">Asset</option>
                    <option value="Liability">Liability</option>
                    <option value="Revenue">Revenue</option>
                    <option value="Expense">Expense</option>
                </select>
            </div>
            <button type="submit" name="add_account">Add Account</button>
        </form>

        <h3>Accounts List</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Account Code</th>
                    <th>Account Name</th>
                    <th>Account Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accounts as $account): ?>
                <tr>
                    <td><?php echo $account['id']; ?></td>
                    <td><?php echo $account['account_code']; ?></td>
                    <td><?php echo $account['account_name']; ?></td>
                    <td><?php echo $account['account_type']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Journal Entries Section -->
    <section class="journal-entries">
        <h2>Journal Entries</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required>
            </div>
            <div class="form-group">
                <label for="debit-account">Debit Account:</label>
                <select id="debit-account" name="debit_account" required>
                    <?php foreach ($accounts as $account): ?>
                        <option value="<?php echo $account['account_name']; ?>"><?php echo $account['account_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="credit-account">Credit Account:</label>
                <select id="credit-account" name="credit_account" required>
                    <?php foreach ($accounts as $account): ?>
                        <option value="<?php echo $account['account_name']; ?>"><?php echo $account['account_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount ($):</label>
                <input type="number" id="amount" name="amount" required>
            </div>
            <button type="submit" name="add_journal_entry">Add Journal Entry</button>
        </form>

        <h3>Journal Entries List</h3>
        <table>
            <thead>
                <tr>
                    <th>Entry ID</th>
                    <th>Description</th>
                    <th>Debit Account</th>
                    <th>Credit Account</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($journalEntries as $entry): ?>
                <tr>
                    <td><?php echo $entry['id']; ?></td>
                    <td><?php echo $entry['description']; ?></td>
                    <td><?php echo $entry['debit_account']; ?></td>
                    <td><?php echo $entry['credit_account']; ?></td>
                    <td>$<?php echo $entry['amount']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Account Reconciliation Section -->
    <section class="account-reconciliation">
        <h2>Account Reconciliation</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="account-id">Select Account:</label>
                <select id="account-id" name="account_id" required>
                    <?php foreach ($accounts as $account): ?>
                        <option value="<?php echo $account['id']; ?>"><?php echo $account['account_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Reconciliation Status:</label>
                <select id="status" name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Failed">Failed</option>
                </select>
            </div>
            <button type="submit" name="reconcile_account">Reconcile Account</button>
        </form>

        <h3>Reconciliation Status</h3>
        <table>
            <thead>
                <tr>
                    <th>Account Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reconciliations as $reconciliation): ?>
                <tr>
                    <td><?php echo $reconciliation['account_name']; ?></td>
                    <td><?php echo $reconciliation['status']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>

</body>
</html>