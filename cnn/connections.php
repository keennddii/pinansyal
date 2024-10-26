<?php 

// Database connection settings
$dbhost = "127.0.0.1";
$dbport = 3306;
$dbuser = "root";
$dbpass = "";
$dbname = "pinansyal_accs";

// Create a new mysqli object
$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}