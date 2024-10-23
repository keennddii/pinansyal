<?php
// Placeholder for financial data
$financial_data = [
    ['date' => '2024-01-01', 'revenue' => 5000, 'expenses' => 3000],
    ['date' => '2024-02-01', 'revenue' => 6000, 'expenses' => 3500],
    ['date' => '2024-03-01', 'revenue' => 4500, 'expenses' => 2500],
    ['date' => '2024-04-01', 'revenue' => 7000, 'expenses' => 4000],
];

// Placeholder for financial analysis
$total_revenue = array_sum(array_column($financial_data, 'revenue'));
$total_expenses = array_sum(array_column($financial_data, 'expenses'));
$net_profit = $total_revenue - $total_expenses;

// Handle form submission for adding financial data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_financial_data'])) {
    $new_entry = [
        'date' => $_POST['date'],
        'revenue' => $_POST['revenue'],
        'expenses' => $_POST['expenses'],
    ];
    $financial_data[] = $new_entry;
    header("Location: financial_analytics.php"); // Reload the page to see the new entry
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Analytics</title>
    <link rel="stylesheet" href="fc.css">
</head>
<body>

<div class="container">
    <header>
        <h1>Financial Analytics</h1>
        <p>Analyze your financial data to gain insights into trends and opportunities.</p>
    </header>

    <!-- Financial Data Input Section -->
    <section class="financial-data-input">
        <h2>Add Financial Data</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="revenue">Revenue ($):</label>
                <input type="number" id="revenue" name="revenue" required>
            </div>
            <div class="form-group">
                <label for="expenses">Expenses ($):</label>
                <input type="number" id="expenses" name="expenses" required>
            </div>
            <button type="submit" name="add_financial_data">Add Data</button>
        </form>
    </section>

    <!-- Financial Data Table Section -->
    <section class="financial-data-table">
        <h2>Financial Data Overview</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Revenue ($)</th>
                    <th>Expenses ($)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($financial_data as $data): ?>
                <tr>
                    <td><?php echo $data['date']; ?></td>
                    <td>$<?php echo $data['revenue']; ?></td>
                    <td>$<?php echo $data['expenses']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Financial Analysis Section -->
    <section class="financial-analysis">
        <h2>Financial Analysis</h2>
        <p><strong>Total Revenue:</strong> $<?php echo $total_revenue; ?></p>
        <p><strong>Total Expenses:</strong> $<?php echo $total_expenses; ?></p>
        <p><strong>Net Profit:</strong> $<?php echo $net_profit; ?></p>

        <h3>Financial Trend Chart</h3>
        <canvas id="financialChart" width="400" height="200"></canvas>
    </section>
</div>

<!-- Chart.js Library for Financial Data Visualization -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('financialChart').getContext('2d');
    var financialChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_column($financial_data, 'date')); ?>,
            datasets: [
                {
                    label: 'Revenue',
                    data: <?php echo json_encode(array_column($financial_data, 'revenue')); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Expenses',
                    data: <?php echo json_encode(array_column($financial_data, 'expenses')); ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill: false
                }
            ]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>