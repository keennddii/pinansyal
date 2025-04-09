<?php
// check_new_requests.php

// Connect to the database (adjust credentials as needed)
$conn = new mysqli("localhost", "root", "", "pinansyal_budget_management");
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed"]));
}

// Get total count of requests (you can refine this logic to just count only “new” ones)
$sql = "SELECT COUNT(*) AS total FROM requests";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo json_encode(["total" => $row['total']]);

$conn->close();
?>
