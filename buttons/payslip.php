<?php
$dbhost = "127.0.0.1";
$dbport = 3306;
$dbuser = "root";
$dbpass = "";
$dbname = "pinansyal_disbursement";

$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get the payslip data
$payslip_id = $_GET['id'];
$query = "SELECT * FROM payrolls WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $payslip_id);
$stmt->execute();
$result = $stmt->get_result();
$payslip = $result->fetch_assoc();

// Close connection
$stmt->close();
$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h1, h2, h3, p {
            margin: 0;
            padding: 0;
        }

        /* Header Section */
        .header {
            text-align: center;
            background: #3498db;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .header p {
            font-size: 1.2rem;
        }

        /* Employee & Payslip Details Section */
        .details, .salary-breakdown {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .details p, .salary-breakdown p {
            font-size: 1rem;
            margin-bottom: 10px;
        }
        .details p strong, .salary-breakdown p strong {
            font-weight: bold;
        }

        /* Salary Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Footer Section */
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px 0;
            background: #f2f2f2;
            border-top: 1px solid #ddd;
        }

        /* Print Button */
        .print-button {
            display: inline-block;
            background: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
        }
        .print-button:hover {
            background: #2980b9;
        }
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>
                <span style="color: yellow;">J</span>
                <span style="color: blue;">V</span>
                <span style="color: red;">D</span>
            </h1>
            <p>Employee: <?php echo htmlspecialchars($payslip['employee_name']); ?></p>
        </div>

        <!-- Salary Breakdown Section -->
        <div class="salary-breakdown">
            <p><strong>Employee Name:</strong> <?php echo htmlspecialchars($payslip['employee_name']); ?></p>
            <p><strong>Grosspay:</strong> ₱<?php echo number_format($payslip['gross_pay'], 2); ?></p>
            <p><strong>Netpay:</strong> ₱<?php echo number_format($payslip['net_pay'], 2); ?></p>
            <p><strong>Deduction:</strong> ₱<?php echo number_format($payslip['gross_pay'] - $payslip['total_deductions'], 2); ?></p>
        </div>

        <!-- Detailed Salary Table -->
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total</td>
                    <td>₱<?php echo number_format($payslip['total_deductions'], 2); ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Footer Section -->
        <div class="footer">
            <p>Thank you for your hard work!</p>
        </div>

        <!-- Print Button -->
        <button class="print-button" onclick="window.print()">Print</button>
    </div>
</body>
</html>
