<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Report</title>
    <link rel="stylesheet" href="Expense.css">
</head>
<body>

<div class="container">
    <header>
        <h1>Expense Report</h1>
    </header>

    <!-- Expense Filter Section -->
    <section class="expense-report-filter">
        <h2>Filter Expenses</h2>
        <form action="expense_report.php" method="GET">
            <label for="filter_category">Category:</label>
            <select id="filter_category" name="filter_category">
                <option value="">All Categories</option>
                <option value="Travel">Travel</option>
                <option value="Vendor Payments">Vendor Payments</option>
                <option value="Staff Expenses">Staff Expenses</option>
                <option value="Administrative">Administrative</option>
            </select>

            <label for="filter_start_date">Start Date:</label>
            <input type="date" id="filter_start_date" name="filter_start_date">

            <label for="filter_end_date">End Date:</label>
            <input type="date" id="filter_end_date" name="filter_end_date">

            <button type="submit" name="filter_expenses">Apply Filter</button>
        </form>
    </section>

    <!-- Expense History Section -->
    <section class="expense-history">
        <h2>Filtered Expense Report</h2>
        <table>
            <thead>
                <tr>
                    <th>Expense Name</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Data, Replace with Dynamic PHP Data -->
                <?php
                // Sample filtered expense data (replace with data from your database)
                $filtered_expenses = [
                    ['name' => 'Flight to NYC', 'category' => 'Travel', 'amount' => 500, 'date' => '2024-10-01', 'description' => 'Round trip flight to NYC for business'],
                    ['name' => 'Software License', 'category' => 'Vendor Payments', 'amount' => 200, 'date' => '2024-10-05', 'description' => 'Annual license renewal for software'],
                ];

                foreach ($filtered_expenses as $expense) {
                    echo "<tr>
                            <td>{$expense['name']}</td>
                            <td>{$expense['category']}</td>
                            <td>\${$expense['amount']}</td>
                            <td>{$expense['date']}</td>
                            <td>{$expense['description']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</div>

</body>
</html>