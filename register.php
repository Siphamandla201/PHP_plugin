<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register / Sign up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h1>
      Sign Up
    </h1>


    <div class="registerForm">
        <form action="registration_validation.php" method="post" novalidate>
           <div class="form-group">
                 <label >Fullname</label>
                 <input type="text" class="form-control" name="fullname">
                 <span></span>
            </div>
            <div class="form-group">
                 <label >Email</label>
                 <input type="emamil" class="form-control" name="email">
                 <span></span>
            </div>
            <div class="form-group">
                 <label >Password</label>
                 <input type="password" class="form-control" name="password">
                 <span></span>
            </div>
            <div class="form-group">
                 <label >Repeat Password</label>
                 <input type="password" class="form-control" name="repeat_password">
                 <span></span>
            </div>
            <div class="form-btn">
                 <input type="submit" class="btn" value="sign up" name="submit">
            </div>
        </form>

    </div>
    
</body>
</html>