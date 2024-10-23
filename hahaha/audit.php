<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Trails - Financial Management</title>
    <link rel="stylesheet" href="audit.css">
</head>
<body>

<div class="container">
    <header>
        <h1>Audit Trails</h1>
    </header>

    <!-- Search Section -->
    <section class="search-audit">
        <form action="audit_trail_action.php" method="POST">
            <input type="text" name="search_action" placeholder="Search by User, Action or Date">
            <button type="submit" name="search_audit">Search</button>
        </form>
    </section>

    <!-- Audit Trails Table -->
    <section class="audit-table">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                    <th>User</th>
                    <th>Transaction Details</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Data, Replace with PHP dynamic data -->
                <?php
                // Sample audit data (replace with data from your database)
                $audit_logs = [
                    ['date' => '2024-10-01', 'time' => '09:12:45', 'action' => 'Add', 'user' => 'John Doe', 'transaction_details' => 'Added new vendor payment', 'ip_address' => '192.168.1.1'],
                    ['date' => '2024-10-02', 'time' => '10:24:18', 'action' => 'Edit', 'user' => 'Jane Smith', 'transaction_details' => 'Edited salary payment', 'ip_address' => '192.168.1.2'],
                ];

                foreach ($audit_logs as $log) {
                    echo "<tr>
                            <td>{$log['date']}</td>
                            <td>{$log['time']}</td>
                            <td>{$log['action']}</td>
                            <td>{$log['user']}</td>
                            <td>{$log['transaction_details']}</td>
                            <td>{$log['ip_address']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</div>

</body>
</html>