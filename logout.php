<?php
session_start();

// database configuration file
require_once "db_config.php";

require_once "login.php";

// Fetch the user data based on the email stored in the session
$userEmail = $_SESSION["user"];

// Retrieve the user data from the database
$selectQuery = "SELECT * FROM users WHERE Email = ?";
$stmt = mysqli_prepare($conn, $selectQuery);
mysqli_stmt_bind_param($stmt, "s", $userEmail);
mysqli_stmt_execute($stmt);
$user = mysqli_stmt_get_result($stmt)->fetch_assoc();

if ($user) {
    // Declare all variables needed for the clockout table
    $userId = $user["User_Id"];
    $latitude = $_POST["latitude"]; // Make sure to get the latitude value from the form or any other source
    $longitude = $_POST["longitude"]; // Make sure to get the longitude value from the form or any other source
    $date = date("Y-m-d");
    $timestamp = date("Y-m-d H:i:s");

    // Insert the clockout record into the clockout table
    $insertQuery = "INSERT INTO clockout (User_Id, Latitude, Longitude, Date, timestamp) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, "iddss", $userId, $latitude, $longitude, $date, $timestamp);
    mysqli_stmt_execute($stmt);

    // Unset all session variables
    $_SESSION = array();
    // Destroy the session
    session_destroy();
    // Redirect the user to the login page
    header("Location: login.php");
    die();
} else {
    // Handle the case when the user does not exist
    echo "User not found";
}
?>


