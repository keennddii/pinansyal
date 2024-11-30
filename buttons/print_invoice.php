<?php
$dbhost = "127.0.0.1";
$dbport = 3306;
$dbuser = "root";
$dbpass = "";
$dbname = "pinansyal_collection";

$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get the payslip data
$invoice_id = $_GET['id'];
$query = "SELECT * FROM invoices WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $invoice_id);
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
    <title>Invoice</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
        }
        h1, h2, h3, p {
            margin: 0;
            padding: 0;
        }

        /* Header Section */
        .header {
            text-align: center;
            background: linear-gradient(45deg, #f39c12, #e74c3c, #2980b9);
            padding: 20px;
            color: #fff;
        }
        .header h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .header p {
            font-size: 1.2rem;
        }

        /* Details Section */
        .details {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .details p {
            font-size: 1rem;
            margin-bottom: 10px;
        }
        .details p strong {
            font-weight: bold;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #f2f2f2;
            font-weight: bold;
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

        /* Button */
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
            <p>Invoice #<?php echo htmlspecialchars($payslip['invoice_number']); ?></p>
        </div>

        <!-- Details Section -->
        <div class="details">
            <p><strong>Client Name:</strong> <?php echo htmlspecialchars($payslip['client_name']); ?></p>
            <p><strong>Date Issued:</strong> <?php echo htmlspecialchars($payslip['date_issued']); ?></p>
            <p><strong>Due Date:</strong> <?php echo htmlspecialchars($payslip['due_date']); ?></p>
            <p><strong>Total Amount:</strong> ₱<?php echo number_format($payslip['total'], 2); ?></p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>Thank you for your business!</p>
        </div>

        <!-- Print Button -->
        <button class="print-button" onclick="window.print()">Print</button>
    </div>
</body>
</html>
