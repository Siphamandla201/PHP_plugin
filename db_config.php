<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "Users";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Something went wrong, try again later;");
}