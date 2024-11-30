<?php
include("user.php");
// Database connection settings
$dbhost = "127.0.0.1";
$dbport = 3306;
$dbuser = "root";
$dbpass = "";
$dbname = "pinansyal_collection";

// Create a new mysqli object
$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Function to get all invoices
function getInvoices($con) {
    $sql = "SELECT * FROM invoices";
    $result = $con->query($sql);
    $invoices = [];
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $invoices[] = $row;
        }
    }
    return $invoices;
}

// Fetch the invoices before using them
$invoices = getInvoices($con);

// Handle form submission for adding an invoice
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_invoice'])) {
    // Prepare the SQL INSERT statement
    $stmt = $con->prepare("INSERT INTO invoices (invoice_number, client_name, date_issued, due_date, total) VALUES (?, ?, ?, ?, ?)");

    // Bind parameters
    $invoice_number = $_POST['invoice_number'] ?? '';
    $client_name = $_POST['client_name'] ?? '';
    $date_issued = $_POST['date_issued'] ?? '';
    $due_date = $_POST['due_date'] ?? '';
    $total = $_POST['total'] ?? 0;

    $stmt->bind_param("sssss", $invoice_number, $client_name, $date_issued, $due_date, $total);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Invoice added successfully.";
        header("Location: /pinansyal/InvoicingBilling.php");
        exit();
    } else {
        echo "Error: " . $stmt->error; 
    }

    // Close the statement
    $stmt->close();
}

// Handle delete action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $invoice_id = $_POST['invoice_id'] ?? 0;

    // Prepare the DELETE statement
    $stmt = $con->prepare("DELETE FROM invoices WHERE id = ?");
    $stmt->bind_param("i", $invoice_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Invoice deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting invoice: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

    // Redirect to the same page to refresh the invoice list
    header("Location: /pinansyal/InvoicingBilling.php");
    exit();
}

// Close the connection
$con->close();
