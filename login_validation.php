<?php

$email = $_POST["email"];
$password = $_POST["password"];
$submit = $_POST["login"];
$errors = array();

if (isset($submit)) {
    // Check if the login form is submitted
    
    require_once "db_config.php";
    // Include the database configuration file
    
    $sql = "SELECT * FROM users WHERE Email  = '$email' ";
    // SQL query to select user with the provided email
    
    $result = mysqli_query($conn, $sql);
    // Execute the query
    
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    // Fetch the user details from the query result
    
    if ($user) {
        // If a user with the provided email is found in the database
        
        if (password_verify($password, $user["Password"])) {
            // Verify the provided password with the stored hashed password
        
            session_start();
            // Start a new session
            
            $_SESSION["user"] = $user["Email"];
            // Set a session variable to indicate successful login

            header("Location: user_profile.php");
            // Redirect the user to the user_profile.php page
            
            die();
            // Insert the user's id and timestamp into the login_table
            // $userId = $user["User_Id"]; // Assuming the ID column name is "ID"
            // $timestamp = date("Y-m-d H:i:s"); // Current timestamp
            // $insertQuery = "INSERT INTO login (User_Id, timestamp) VALUES ('$userId', '$timestamp')";
            // mysqli_query($conn, $insertQuery);
        } else {
            echo "<p>Invalid password</p>";
            // Display an error message for invalid password
        }
    } else {
        echo "<p>Email does not exist</p>";
        // Display an error message for non-existent email
    }
}
?>
