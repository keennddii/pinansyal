<?php
// Placeholder for financial reports (these would normally be dynamically calculated from a database)
$income_statement = [
    'revenue' => 100000,
    'cost_of_goods_sold' => 50000,
    'gross_profit' => 50000,
    'operating_expenses' => 20000,
    'net_income' => 30000
];

$balance_sheet = [
    'assets' => 150000,
    'liabilities' => 60000,
    'equity' => 90000
];

$cash_flow = [
    'operating_activities' => 25000,
    'investing_activities' => -10000,
    'financing_activities' => 15000,
    'net_cash_flow' => 25000
];

// Handle form submission for budgeting and forecasting
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_budget_forecast'])) {
    $budget_forecast = [
        'year' => $_POST['year'],
        'revenue_forecast' => $_POST['revenue_forecast'],
        'expense_forecast' => $_POST['expense_forecast'],
        'profit_forecast' => $_POST['profit_forecast']
    ];

    // Save the forecast (In a real application, this would be stored in a database)
    // For now, we just print the forecast (in a real app, you could use a session or database).
    echo "<p>Forecast for Year {$budget_forecast['year']}:</p>";
    echo "<p>Revenue Forecast: {$budget_forecast['revenue_forecast']}</p>";
    echo "<p>Expense Forecast: {$budget_forecast['expense_forecast']}</p>";
    echo "<p>Profit Forecast: {$budget_forecast['profit_forecast']}</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Report & Analysis</title>
    <link rel="stylesheet" href="far.css">
</head>
<body>

<div class="container">
    <header>
        <h1>Financial Report & Analysis</h1>
        <p>Generate financial statements, budget forecasts, and analyze financial performance.</p>
    </header>

    <!-- Income Statement -->
    <section class="financial-statement">
        <h2>Income Statement</h2>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Amount ($)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Revenue</td>
                    <td>$<?php echo number_format($income_statement['revenue'], 2); ?></td>
                </tr>
                <tr>
                    <td>Cost of Goods Sold</td>
                    <td>$<?php echo number_format($income_statement['cost_of_goods_sold'], 2); ?></td>
                </tr>
                <tr>
                    <td>Gross Profit</td>
                    <td>$<?php echo number_format($income_statement['gross_profit'], 2); ?></td>
                </tr>
                <tr>
                    <td>Operating Expenses</td>
                    <td>$<?php echo number_format($income_statement['operating_expenses'], 2); ?></td>
                </tr>
                <tr>
                    <td>Net Income</td>
                    <td>$<?php echo number_format($income_statement['net_income'], 2); ?></td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Balance Sheet -->
    <section class="financial-statement">
        <h2>Balance Sheet</h2>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Amount ($)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Assets</td>
                    <td>$<?php echo number_format($balance_sheet['assets'], 2); ?></td>
                </tr>
                <tr>
                    <td>Liabilities</td>
                    <td>$<?php echo number_format($balance_sheet['liabilities'], 2); ?></td>
                </tr>
                <tr>
                    <td>Equity</td>
                    <td>$<?php echo number_format($balance_sheet['equity'], 2); ?></td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Cash Flow Statement -->
    <section class="financial-statement">
        <h2>Cash Flow Statement</h2>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Amount ($)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Operating Activities</td>
                    <td>$<?php echo number_format($cash_flow['operating_activities'], 2); ?></td>
                </tr>
                <tr>
                    <td>Investing Activities</td>
                    <td>$<?php echo number_format($cash_flow['investing_activities'], 2); ?></td>
                </tr>
                <tr>
                    <td>Financing Activities</td>
                    <td>$<?php echo number_format($cash_flow['financing_activities'], 2); ?></td>
                </tr>
                <tr>
                    <td>Net Cash Flow</td>
                    <td>$<?php echo number_format($cash_flow['net_cash_flow'], 2); ?></td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Budgeting and Forecasting Section -->
    <section class="financial-forecast">
        <h2>Budget and Forecasting</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" id="year" name="year" required>
            </div>
            <div class="form-group">
                <label for="revenue_forecast">Revenue Forecast ($):</label>
                <input type="number" id="revenue_forecast" name="revenue_forecast" required>
            </div>
            <div class="form-group">
                <label for="expense_forecast">Expense Forecast ($):</label>
                <input type="number" id="expense_forecast" name="expense_forecast" required>
            </div>
            <div class="form-group">
                <label for="profit_forecast">Profit Forecast ($):</label>
                <input type="number" id="profit_forecast" name="profit_forecast" required>
            </div>
            <button type="submit" name="add_budget_forecast">Submit Forecast</button>
        </form>
    </section>
</div>

</body>
</html>