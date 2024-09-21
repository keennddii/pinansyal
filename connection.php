<?php
$dbhost = "127.0.0.1: 3306";
$dbuser = "root";
$dbpass = "";
$dbname = "travel_and_tours";


if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect!");

}
