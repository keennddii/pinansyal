<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Flow Management</title>
    <link rel="stylesheet" href="CashFlow.css">
</head>
<body>

<div class="container">
    <header>
        <h1>Cash Flow Management</h1>
    </header>

    <!-- Cash Flow Tracking Section -->
    <section class="cash-flow-tracking">
        <h2>Track Cash Flow</h2>
        <form action="cash_flow_action.php" method="POST">
            <!-- Inflow Input -->
            <label for="inflow_amount">Cash Inflow:</label>
            <input type="number" id="inflow_amount" name="inflow_amount" placeholder="Enter cash inflow amount" required>

            <label for="inflow_source">Source:</label>
            <input type="text" id="inflow_source" name="inflow_source" placeholder="Enter source of inflow" required>

            <!-- Outflow Input -->
            <label for="outflow_amount">Cash Outflow:</label>
            <input type="number" id="outflow_amount" name="outflow_amount" placeholder="Enter cash outflow amount" required>

            <label for="outflow_purpose">Purpose:</label>
            <input type="text" id="outflow_purpose" name="outflow_purpose" placeholder="Enter purpose of outflow" required>

            <label for="transaction_date">Transaction Date:</label>
            <input type="date" id="transaction_date" name="transaction_date" required>

            <button type="submit" name="track_cash_flow">Track Cash Flow</button>
        </form>
    </section>

    <!-- Cash Flow History Section -->
    <section class="cash-flow-history">
        <h2>Cash Flow History</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Cash Inflow</th>
                    <th>Source</th>
                    <th>Cash Outflow</th>
                    <th>Purpose</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Data, Replace with Dynamic PHP Data -->
                <?php
                // Sample cash flow data (replace with data from your database)
                $cash_flows = [
                    ['date' => '2024-10-01', 'inflow' => 5000, 'source' => 'Sales', 'outflow' => 2000, 'purpose' => 'Salaries', 'balance' => 3000],
                    ['date' => '2024-10-02', 'inflow' => 3000, 'source' => 'Investments', 'outflow' => 1000, 'purpose' => 'Office Supplies', 'balance' => 2000]
                ];

                foreach ($cash_flows as $flow) {
                    echo "<tr>
                            <td>{$flow['date']}</td>
                            <td>\${$flow['inflow']}</td>
                            <td>{$flow['source']}</td>
                            <td>\${$flow['outflow']}</td>
                            <td>{$flow['purpose']}</td>
                            <td>\${$flow['balance']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</div>

</body>
</html>