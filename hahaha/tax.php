<?php
// Tax calculation variables
$calculatedTax = null;

// Tax filing records
$taxFilings = [
    ["period" => "Q1 2024", "amount" => 500, "status" => "Pending", "due_date" => "2024-04-30"],
    ["period" => "Q2 2024", "amount" => 700, "status" => "Filed", "due_date" => "2024-07-31"],
    ["period" => "Q3 2024", "amount" => 600, "status" => "Overdue", "due_date" => "2024-10-31"],
];

// Tax report data
$taxReports = [
    ["period" => "Q1 2024", "tax_paid" => 1200, "tax_due" => 500],
    ["period" => "Q2 2024", "tax_paid" => 1100, "tax_due" => 450],
    ["period" => "Q3 2024", "tax_paid" => 1300, "tax_due" => 600],
];

// Process tax calculation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['transaction_amount']) && isset($_POST['tax_rate'])) {
        $transactionAmount = $_POST['transaction_amount'];
        $taxRate = $_POST['tax_rate'];
        $calculatedTax = ($transactionAmount * $taxRate) / 100;
    }
}

// Process tax report selection
$reportPeriod = null;
if (isset($_POST['report_period'])) {
    $reportPeriod = $_POST['report_period'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Management System</title>
    <link rel="stylesheet" href="tax.css">
</head>
<body>

<div class="container">
    <header>
        <h1>Tax Management System</h1>
        <p>Manage your tax calculations, filings, and reports seamlessly.</p>
    </header>

    <!-- Tax Calculation Section -->
    <section class="tax-calculation">
        <h2>Tax Calculation</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="transaction-amount">Transaction Amount ($):</label>
                <input type="number" id="transaction-amount" name="transaction_amount" required>
            </div>
            <div class="form-group">
                <label for="tax-rate">Tax Rate (%):</label>
                <input type="number" id="tax-rate" name="tax_rate" required>
            </div>
            <button type="submit">Calculate Tax</button>
        </form>

        <?php if ($calculatedTax !== null) { ?>
        <div class="result">
            <p>Calculated Tax: $<?php echo number_format($calculatedTax, 2); ?></p>
        </div>
        <?php } ?>
    </section>

    <!-- Tax Filing Section -->
    <section class="tax-filing">
        <h2>Tax Filings</h2>
        <table>
            <thead>
                <tr>
                    <th>Filing Period</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($taxFilings as $filing): ?>
                <tr>
                    <td><?php echo $filing['period']; ?></td>
                    <td>$<?php echo $filing['amount']; ?></td>
                    <td><?php echo $filing['due_date']; ?></td>
                    <td><?php echo $filing['status']; ?></td>
                    <td>
                        <button class="btn-primary">File Now</button>
                        <button class="btn-danger">Cancel</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Tax Reporting Section -->
    <section class="tax-reporting">
        <h2>Tax Reporting</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="report-period">Select Reporting Period:</label>
                <input type="month" id="report-period" name="report_period" required>
            </div>
            <button type="submit">Generate Report</button>
        </form>

        <?php if ($reportPeriod !== null) { ?>
        <div class="report">
            <h3>Tax Report for <?php echo $reportPeriod; ?>:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Filing Period</th>
                        <th>Tax Paid</th>
                        <th>Tax Due</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($taxReports as $report): ?>
                    <tr>
                        <td><?php echo $report['period']; ?></td>
                        <td>$<?php echo $report['tax_paid']; ?></td>
                        <td>$<?php echo $report['tax_due']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </section>
</div>

</body>
</html>