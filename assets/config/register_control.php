<?php
    // Require the neccessary modules
    require "db_connect.php";
    require "../includes/sessions.php";
    date_default_timezone_set("Africa/Lagos");

    // Check if the button was pushed
    if (!isset($_POST['register'])) {
        $_SESSION['errormessage'] = "Please Create an Account to Continue";
        header("Location: ../../auth#message");
    }else{
        // Collect all the data from the user
        $fullName = $_POST['fname'];
        $userName = $_POST['uname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cPass = $_POST['cpass'];
        $acctNum = "PM".rand(1000000,9999999);
        $pCoin = 12;
        $role = 'user';
        $ref = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$$^&_+)(";
        $ref = str_shuffle($ref);
        $ref = substr($ref, 7,15);
        $date = date("Y-m-d h:i:s");

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $query = mysqli_query($connectDb,$sql);
        if(mysqli_num_rows($query) > 0){
            $_SESSION['errormessage'] = "A user with this email already exists!";
            header("Location: ../../auth#message");
        }
        // Set Connstraints 
        elseif (strlen($password) < 8) {
            $_SESSION['errormessage'] = "Password must not be less than 8 characters";
            header("Location: ../../auth#message");
        }
        elseif (strlen($userName) > 30) {
            $_SESSION['errormessage'] = "Username is too long";
            header("Location: ../../auth#message");
        }
        elseif ($password != $cPass) {
            $_SESSION['errormessage'] = "passwords do not match";
            header("Location: ../../auth#message");
        }else{
            // When all constraints are met 

            // Hash user password(encrypt)
            $password = password_hash($password, PASSWORD_DEFAULT);


            // Save to DataBase
            // 1. Prepare Query String
            $sql = "INSERT INTO users(full_name,username,email,user_password,acct_num,panda_coin,user_role,ref_code,date_created) VALUES(?,?,?,?,?,?,?,?,?)";

            // 2. Initialize connection
            $stmt = mysqli_stmt_init($connectDb);

            // 3. Prepare your Statement
            mysqli_stmt_prepare($stmt,$sql);

            // 4. Bind our values to the placeholders
            mysqli_stmt_bind_param($stmt,"sssssisss", $fullName,$userName,$email,$password,$acctNum,$pCoin,$role,$ref,$date);
            
            // 5.Execute the Statement
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['successmessage'] = "Congrats your account has been created successfully";
                header("Location: ../../auth#message");
            }else{
                $_SESSION['errormessage'] = "Something went wrong ";
                header("Location: ../../auth#message");
            }

        }
 
    }
    