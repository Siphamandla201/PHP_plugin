<?php
    session_start();
    if(isset($_SESSION["user"])) {
        header("Location: user_profile.php");
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Login</title>
</head>
<body onload="getLocation()">
    <div class="loginForm">

        <h1>
            Login
        </h1>

        <!-- Login form -->
        <form class="form" action="login_validation.php" method="post" novalidate>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email">
                <span></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password">
                <span></span>
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="latitude">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="longitude">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn" value="login" name="login">
            </div>
        </form>

        <script>
            // Get user's geolocation
            function getLocation() {
                // Check if geolocation is supported
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(success, error);
                } else {
                    console.log('Geolocation is not supported by this browser.');
                }
            }

            // Success callback function
            function success(position) {
                let latitude = position.coords.latitude;
                let longitude = position.coords.longitude;

                // Update input fields with the coordinates
                document.querySelector('input[name="latitude"]').value = latitude;
                document.querySelector('input[name="longitude"]').value = longitude;
            }

            // Error callback function
            function error(error) {
                console.log('Error getting geolocation:', error.message);
            }
            
        </script>

    </div>
</body>
</html>

