<?php 
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
$data = getAuditComplianceData($con);
function getAuditComplianceData($con) {
    $data = [
        'total_audits' => 0,
        'complete_compliance' => 0,
        'pending_compliance' => 0,
        'compliance_rate' => 0
    ];

    // Total audits conducted
    $result = mysqli_query($con, "SELECT COUNT(*) as total FROM complains");
    if ($row = mysqli_fetch_assoc($result)) {
        $data['total_audits'] = $row['total'];
    }
    $result = mysqli_query($con, "SELECT COUNT(*) as completed FROM complains WHERE compliance_status = 'Completed'");
    if ($row = mysqli_fetch_assoc($result)) {
        $data['complete_compliance'] = $row['completed'];
    }
    
    $result = mysqli_query($con, "SELECT COUNT(*) as pending FROM complains WHERE compliance_status = 'Pending'");
    if ($row = mysqli_fetch_assoc($result)) {
        $data['pending_compliance'] = $row['pending'];
    }
    if ($data['total_audits'] > 0) {
        $result = mysqli_query($con, "SELECT COUNT(*) as completed FROM complains WHERE compliance_status = 'Completed'");
        if ($row = mysqli_fetch_assoc($result)) {
            $data['compliance_rate'] = round(($row['completed'] / $data['total_audits']) * 100, 2);
        }
    }

    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $compliance_status = $_POST['compliance_status'];
    $comments = $_POST['comments'];

    $query = "UPDATE complains SET 
              compliance_status = ?, 
              comments = ? 
              WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ssi', $compliance_status, $comments, $id);

    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: InvoicingBilling.php?success=1");
        exit;
    } else {
        // Redirect with error message
        header("Location: InvoicingBilling.php?error=1");
        exit;
    }
}





