<?php

$fullName = $_POST["fullname"];
$email = $_POST["email"];
$password = $_POST["password"];
$repeatPassword = $_POST["repeat_password"];
$errors = array();

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

if(isset($_POST["submit"])) {
    // Check if any of the required fields are empty
    if(empty($fullName) && empty($email) && empty($password) && empty($repeatPassword )) {
        array_push($errors, "All fields are required" );
    }

    // Check if the full name field is empty
    if(empty($fullName)) {
        array_push($errors, "fullname is required" );
    }

    // Check if the email field is empty and validate the email format
    if(empty($email)) {
        array_push($errors, "email is required" );
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "email is not valid" );
    }

    // Check if the password field is empty and meet the length and complexity requirements
    if (empty($password)) {
        array_push($errors, "password is required");
    } elseif (strlen($password) < 8) {
        array_push($errors, "password must be at least 8 characters long");
    } elseif (!preg_match("/[0-9]/", $password)) {
        array_push($errors, "password must contain numbers"); 
    }

    // Check if the repeat password field is empty and matches the password field
    if (empty($repeatPassword)) {
        array_push($errors, "password is required");
    } elseif (strlen($repeatPassword) < 8) {
        array_push($errors, "password must be at least 8 characters long");
    } elseif ($repeatPassword !== $password) {
        array_push($errors, "password does not match");
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
    else {
        // If there are no errors, proceed with the sign-up process
        if (empty($errors)) {
            echo "<h2>Sign up Successful</h2>";
            print_r($_POST);
            var_dump($passwordHash);
            require_once "db_config.php";
            $sql = "INSERT INTO users (Fullname, Email, Password) VALUES (?, ?, ?)";
            
            $stmt = mysqli_stmt_init($conn);
        
            // Prepare the SQL statement
            if (!$stmt->prepare($sql)) {
                die($conn->error . " " . $conn);
            } else {
                // Bind the parameters and execute the statement
                $stmt->bind_param("sss", $fullName, $email, $passwordHash);
                
                try {
                    if ($stmt->execute()) {
                        // If the execution is successful, redirect to the login page
                        header("Location: login.php");
                        die();
                    }
                } catch (mysqli_sql_exception $e) {
                    // Handle exceptions, such as duplicate email entries
                    if ($e->getCode() === 1062) {
                        echo "Email already exists";
                    } else {
                        die($e->getMessage());
                    }
                }
            }
        }
    } 
}
