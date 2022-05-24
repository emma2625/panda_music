<?php
    // Require the neccessary modules
    require "db_connect.php";
    require "../includes/sessions.php";
        $currentUser = $_SESSION['id'];
       // Check if the button was pushed
       if (!isset($_POST['update'])) {
            $_SESSION['errormessage'] = "Please Create an Account to Continue";
            header("Location: ../../auth#message");
       }else{
            $fullName = $_POST['fname'];
            $userName = $_POST['uname'];
            $country = $_POST['country'];

          if (!empty($fullName)) {
            $sql = "UPDATE users SET full_name = '$fullName' WHERE id = '$currentUser'";
            $query = mysqli_query($connectDb,$sql);

            if ($query) {
                $_SESSION['successmessage'] = "Update was successful";
                header("Location: ../../player/profile");
            }else{
                $_SESSION['errormessage'] = "Update Failed, please contact support";
                header("Location: ../../player/profile");
            }
          }else{
            header("Location: ../../player/profile");
          }

          if (!empty($userName)) {
            $sql = "UPDATE users SET username = '$userName' WHERE id = '$currentUser'";
            $query = mysqli_query($connectDb,$sql);

            if ($query) {
                $_SESSION['successmessage'] = "Update was successful";
                header("Location: ../../player/profile");
            }else{
                $_SESSION['errormessage'] = "Update Failed, please contact support";
                header("Location: ../../player/profile");
            }
          }else{
            header("Location: ../../player/profile");
          }

          if (!empty($country)) {
            $sql = "UPDATE users SET country = '$country' WHERE id = '$currentUser'";
            $query = mysqli_query($connectDb,$sql);

            if ($query) {
                $_SESSION['successmessage'] = "Update was successful";
                header("Location: ../../player/profile");
            }else{
                $_SESSION['errormessage'] = "Update Failed, please contact support";
                header("Location: ../../player/profile");
            }
          }else{
            header("Location: ../../player/profile");
          }
       }