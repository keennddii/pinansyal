<?php 
// Database connection settings
$dbhost = "127.0.0.1";
$dbport = 3306;
$dbuser = "root";
$dbpass = "";
$dbname = "pinansyal_general_ledger";

// Create a new mysqli object
$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
};


$data = [
    'total_audits' => 0,
    'pending_compliance' => 0,
    'compliance_rate' => 0
];

$dataQuery = $con->query("
    SELECT 
        COUNT(CASE WHEN compliance_status = 'Completed' THEN 1 END) AS total_audits,
        COUNT(CASE WHEN compliance_status = 'Pending' THEN 1 END) AS pending_compliance,
        ROUND(
            COUNT(CASE WHEN compliance_status = 'Completed' THEN 1 END) / COUNT(*) * 100, 2
        ) AS compliance_rate
    FROM audits
");


$data = $dataQuery->fetch_assoc();

// Handle Add Transaction (if form is submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transactionType = $_POST['transaction_type'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $userId = 1; // Replace with session user ID if available

    $stmt = $con->prepare("
        INSERT INTO transactions (transaction_type, amount, transaction_date, description, user_id) 
        VALUES (?, ?, NOW(), ?, ?)
    ");
    $stmt->bind_param("sdsi", $transactionType, $amount, $description, $userId);

    if ($stmt->execute()) {
        // Log the action in audit trail
        $auditStmt = $con->prepare("
            INSERT INTO audit_trails (action, table_name, record_id, user_id) 
            VALUES ('Added Transaction', 'transactions', ?, ?)
        ");
        $transactionId = $stmt->insert_id;
        $auditStmt->bind_param("ii", $transactionId, $userId);
        $auditStmt->execute();

        // Redirect to avoid form resubmission
        header("Location: AuditCompliance.php?success=1");
        exit;
    } else {
        $error = "Error: " . $stmt->error;
    }
}
if ($dataQuery) {
    $data = $dataQuery->fetch_assoc();
}

// Handle Transaction Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['transaction_type'])) {
    $transactionType = $_POST['transaction_type'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $userId = 1; // Replace with dynamic user ID from session or login

    $stmt = $con->prepare("INSERT INTO transactions (transaction_type, amount, transaction_date, description, user_id) VALUES (?, ?, NOW(), ?, ?)");
    $stmt->bind_param("sdsi", $transactionType, $amount, $description, $userId);

    if ($stmt->execute()) {
        $successMessage = "Transaction added successfully!";
    } else {
        $errorMessage = "Error adding transaction: " . $stmt->error;
    }
}

// Fetch Audit Trail Logs
$auditLogs = $con->query("SELECT * FROM audit_trails ORDER BY timestamp DESC");
