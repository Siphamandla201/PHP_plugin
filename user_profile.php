<?php
   session_start();
   if (!isset($_SESSION["user"])) {
       header("Location: login.php");
       exit;
   } else {
       require_once "db_config.php";
       $userEmail = $_SESSION["user"]; // Assuming you stored the user's email in $_SESSION["user"]
       
       $sql = "SELECT * FROM Users WHERE Email = '$userEmail'";
       $result = mysqli_query($conn, $sql);
       $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
   
       if (!$user) {
           echo "User not found.";
           exit;
       }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>User Profile</title>
</head>
<body onload="getLocation()">
    <div class="user-information">
        <?php if ($user): ?>
            <h1>Welcome, <?php echo $user["Fullname"]; ?></h1>
            <!-- Display other user information as needed -->
            <form class="form" action="logout.php" method="post">
            <div class="form-group">
                <input type="hidden" class="form-control" name="latitude">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="longitude">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn" value="logout" name="logout">
            </div>
        </form>
        <?php else: ?>
            <p>User not found.</p>
        <?php endif; ?>
    </div>
    <main>
        <section class="dashboard-section">
            <h2>Dashboard Overview</h2>
            <p>This is the user dashboard section where you can display an overview of user information or relevant data.</p>
        </section>
        <section class="dashboard-section">
            <h2>Personal infomation</h2>
            <ul>
                <li>Email : <?php echo $user["Email"]; ?></li>
                <li>Role :  <?php echo $user["Role"]; ?></li>
                <li>Fullname <?php echo $user["Fullname"]; ?></li>
            </ul>
        </section>
    </main>
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
</body>
</html>
