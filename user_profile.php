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
    <link rel="stylesheet" href="user_profile.css">
    <title>User Profile</title>
</head>
<body>
    <div class="user-information">
        <?php if ($user): ?>
            <h1>Welcome, <?php echo $user["Fullname"]; ?></h1>
            <!-- Display other user information as needed -->
            <a href="logout.php">Logout</a> <!-- Example of logout link -->
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
            <h2>Recent Activity</h2>
            <ul>
                <li>Date 1</li>
                <li>Date 2</li>
                <li>Date 3</li>
            </ul>
        </section>
    </main>
</body>
</html>
