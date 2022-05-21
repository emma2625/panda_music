<?php
    // Require the neccessary modules
    require "db_connect.php";
    require "../includes/sessions.php";

       // Check if the button was pushed
       if (!isset($_POST['login'])) {
            $_SESSION['errormessage'] = "Please Create an Account to Continue";
            header("Location: ../../auth#message");
       }else{
        
        // Collect The data 
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = ?";
        // initialize connection
        $stmt = mysqli_stmt_init($connectDb);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        

        // covert the resulting columns in our database into associative arrays
        if ($row = mysqli_fetch_assoc($result)) {
            $returnedPassword = $row['user_password'];

            if (password_verify($password, $returnedPassword)) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['errormessage'] = "Get ready to party ". $row['full_name'];
                header('Location: ../../player/dashboard');
            }else{
                $_SESSION['errormessage'] = "Incorrect Password";
                header("Location: ../../auth#message");
            }
        }else{
            $_SESSION['errormessage'] = "This email does not exist";
            header("Location: ../../auth#message");
        }


    }
    