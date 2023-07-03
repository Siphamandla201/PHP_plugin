<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "users";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
// Create a connection to the database using the provided credentials

if (!$conn) {
    die("Something went wrong, try again later;");
    // If the connection fails, display an error message and terminate the script
}

?>
