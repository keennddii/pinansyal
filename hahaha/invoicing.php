<?php
// Sample data for Invoicing and Accounts
$invoices = [
    ['id' => 1, 'customer' => 'Client A', 'amount' => 1500, 'due_date' => '2024-10-10', 'status' => 'Paid'],
    ['id' => 2, 'customer' => 'Client B', 'amount' => 2500, 'due_date' => '2024-10-20', 'status' => 'Pending'],
    ['id' => 3, 'customer' => 'Client C', 'amount' => 1000, 'due_date' => '2024-09-30', 'status' => 'Overdue'],
];

$payables = [
    ['id' => 1, 'vendor' => 'Vendor A', 'amount' => 1200, 'due_date' => '2024-10-15', 'status' => 'Paid'],
    ['id' => 2, 'vendor' => 'Vendor B', 'amount' => 1700, 'due_date' => '2024-10-25', 'status' => 'Pending'],
];

// Handling the form submission for new invoice generation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_invoice'])) {
    $new_invoice = [
        'id' => count($invoices) + 1,
        'customer' => $_POST['customer'],
        'amount' => $_POST['amount'],
        'due_date' => $_POST['due_date'],
        'status' => 'Pending'
    ];

    // Simulating adding the new invoice to the array
    $invoices[] = $new_invoice;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts Payable/Receivable - Invoicing and Aging Reports</title>
    <link rel="stylesheet" href="invoicing.css">
</head>
<body>

<div class="container">
    <header>
        <h1>Accounts Payable/Receivable</h1>
        <p>Manage invoices, track payments, and generate aging reports for overdue accounts.</p>
    </header>

    <!-- Invoice Generation Section -->
    <section class="invoice-generation">
        <h2>Generate New Invoice</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="customer">Customer:</label>
                <input type="text" id="customer" name="customer" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount ($):</label>
                <input type="number" id="amount" name="amount" required>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" id="due_date" name="due_date" required>
            </div>
            <button type="submit" name="generate_invoice">Generate Invoice</button>
        </form>
    </section>

    <!-- Invoices Section (Accounts Receivable) -->
    <section class="invoices-section">
        <h2>Outstanding Invoices (Accounts Receivable)</h2>
        <table>
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Customer</th>
                    <th>Amount ($)</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Overdue</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invoices as $invoice): ?>
                    <tr>
                        <td><?php echo $invoice['id']; ?></td>
                        <td><?php echo $invoice['customer']; ?></td>
                        <td>$<?php echo number_format($invoice['amount'], 2); ?></td>
                        <td><?php echo $invoice['due_date']; ?></td>
                        <td><?php echo $invoice['status']; ?></td>
                        <td><?php echo (strtotime($invoice['due_date']) < time() && $invoice['status'] != 'Paid') ? 'Yes' : 'No'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Accounts Payable Section -->
    <section class="payables-section">
        <h2>Outstanding Payables (Accounts Payable)</h2>
        <table>
            <thead>
                <tr>
                    <th>Payable ID</th>
                    <th>Vendor</th>
                    <th>Amount ($)</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payables as $payable): ?>
                    <tr>
                        <td><?php echo $payable['id']; ?></td>
                        <td><?php echo $payable['vendor']; ?></td>
                        <td>$<?php echo number_format($payable['amount'], 2); ?></td>
                        <td><?php echo $payable['due_date']; ?></td>
                        <td><?php echo $payable['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

</div>

</body>
</html>