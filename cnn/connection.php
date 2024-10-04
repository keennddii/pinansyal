<?php
$dbhost = "127.0.0.1: 3306";
$dbuser = "root";
$dbpass = "";
$dbname = "travel_and_tours_finance";


$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check if the connection was successful
if (!$con) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}
