<?php

$fullName = $_POST["fullname"];
$email = $_POST["email"];
$password = $_POST["password"];
$repeatPassword = $_POST["repeat_password"];
$errors = array();

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

if(isset($_POST["submit"])) {
    if(empty($fullName) && empty($email) && empty($password) && empty($repeatPassword )) {
        array_push($errors, "All fields are required" );
    }

    if(empty($fullName)) {
        array_push($errors, "fullname is required" );
    }

    if(empty($email)) {
        array_push($errors, "email is required" );
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "email is not valid" );
    }

    if (empty($password)) {
        array_push($errors, "password is required");
    } elseif (strlen($password) < 8) {
        array_push($errors, "password must be at least 8 characters long");
    } elseif (!preg_match("/[0-9]/", $password)) {
        array_push($errors, "password must contain numbers"); 
    }

    if (empty($repeatPassword)) {
        array_push($errors, "password is required");
    } elseif (strlen($repeatPassword) < 8) {
        array_push($errors, "password must be at least 8 characters long");
    } elseif ($repeatPassword !== $password) {
        array_push($errors, "password does not match");
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
    else {
        // if (empty($errors)) {
        //     require_once "db_config.php";
        //     $sql = " INSERT INTO users (Fullname, Email, Password)
        //              VALUES( ?, ?, ?)";
        //     $stmt = mysqli_stmt_init($conn);

        //     if ( ! $stmt -> prepare($sql)) {
        //         die("SQL erro".$conn->error);
        //     } else {
        //         $stmt -> bind_param("sss", $fullName, $email, $passwordHash);
        //         if ($stmt -> execute()) {
        //             echo "<h2>Sign up Successful</h2>";
        //             print_r($_POST);
        //             var_dump( $passwordHash);
        //         } elseif( $conn->errno === 1062) {
        //             echo "email has already been taken";
        //         } else {
        //             die($conn->error." ".$conn->errno);
        //         }
        //     }
        // }
        if (empty($errors)) {
            echo "<h2>Sign up Successful</h2>";
            print_r($_POST);
            var_dump($passwordHash);
            require_once "db_config.php";
            $sql = "INSERT INTO users (Fullname, Email, Password) VALUES (?, ?, ?)";
            
            $stmt = mysqli_stmt_init($conn);
        
            if (!$stmt->prepare($sql)) {
                die($conn->error . " " . $conn);
            } else {
                $stmt->bind_param("sss", $fullName, $email, $passwordHash);
                
                try {
                    if ($stmt->execute()) {
                        // echo "<h2>Sign up Successful</h2>";
                        // print_r($_POST);
                        // var_dump($passwordHash);
                        header("Location: login.php");
                        die();
                    }
                } catch (mysqli_sql_exception $e) {
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
