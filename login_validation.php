<?php

$email = $_POST["email"];
$password = $_POST["password"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$submit = $_POST["login"];
$errors = array();

// Check if the login form is submitted
if (isset($submit)) {
    
    // Include the database configuration file
    require_once "db_config.php";
    
    // SQL query to select user with the provided email
    $sql = "SELECT * FROM users WHERE Email = '$email'";
    
    // Execute the query
    $result = mysqli_query($conn, $sql);
    
    // Fetch the user details from the query result
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    // If a user with the provided email is found in the database
    if ($user) {
        
        // Verify the provided password with the stored hashed password
        if (password_verify($password, $user["Password"])) {
        
            // Start a new session
            session_start();
            
            // Set a session variable to indicate successful login
            $_SESSION["user"] = $user["Email"];
            
            // Insert the clock in details into the login_table
            $ClockInId = $user["ClockIn_Id"];
            $userId = $user["User_Id"];
            $date = date("Y-m-d");
            $timestamp = date("Y-m-d H:i:s");
            $insertQuery = "INSERT INTO clockin (ClockIn_Id, User_Id, Latitude, Longitude, Date, timestamp) VALUES ('$ClockInId', '$userId', '$latitude', '$longitude', '$date', '$timestamp')";
            mysqli_query($conn, $insertQuery);

            // Redirect the user to the user_profile.php page
            header("Location: user_profile.php");
            
            die();
        } else {
            // Display an error message for invalid password
            echo "<p>Invalid password</p>";
        }
    } else {
        // Display an error message for non-existent email
        echo "<p>Email does not exist</p>";
    }
}
?>
