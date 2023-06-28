<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Login</title>
</head>
<body>
<div class="loginForm">

    <h1>
        Login
    </h1>

    <form action="login_validation.php" method="post" novalidate>
        <div class="form-group">
            <label >Email</label>
            <input type="email" class="form-control" name="email">
            <span></span>
        </div>
        <div class="form-group">
            <label >Password</label>
            <input type="password" class="form-control" name="password">
            <span></span>
        </div>
        <div class="form-btn">
            <input type="submit" class="btn" value="login" name="login">
        </div>
    </form>
</div>
</body>
</html>