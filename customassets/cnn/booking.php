<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pinansyal_acc_payable_recievable";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the action
$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : null);

function fetchBookings() {
    global $conn;
    $sql = "SELECT * FROM bookings"; 
    $result = $conn->query($sql);

    if ($result === false) {
        die("Error fetching bookings: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $bookings = [];
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
        return $bookings;
    } else {
        return [];
    }
}




