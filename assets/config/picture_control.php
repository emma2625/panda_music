<?php
// Require the neccessary modules
require "db_connect.php";
require "../includes/sessions.php";
$currentUser = $_SESSION['id'];
// Check if the button was pushed
if (!isset($_POST['updatePicture'])) {
    $_SESSION['errormessage'] = "Please Create an Account to Continue";
    header("Location: ../../auth#message");
}else{
    $file = $_FILES['file'];
    print_r($file);

    $fileName = $file['name'];
    $fileTempLoc = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    // Create an array of allowed file types
    $allowedFiles = array('jpg','png','jpeg');

    // Get the File type
    $fileType = explode(".",$fileName);
    $fileType = end($fileType);
    $fileType = strtolower($fileType);
    $location = "../img/profile_Uploads/";

    // Build our constraints
    if (in_array($fileType,$allowedFiles)) {
        // Check file size
       if ($fileSize < 5000000) {
        // Check for errors   
           if ($fileError < 1) {
               $fileNewName = "profile".$currentUser.".".$fileType;
                // Check if file exist

                if (file_exists($location.$fileNewName)) {
                    unlink($location.$fileNewName);
                    $move = move_uploaded_file($fileTempLoc,$location.$fileNewName);
                    $sql = "UPDATE users SET prof_pic = '$fileNewName' WHERE id = '$currentUser'";
                    $query = mysqli_query($connectDb,$sql);
                    if ($query) {
                        $_SESSION['successmessage'] = "Update was successful";
                        header("Location: ../../player/profile");
                    }else{
                        $_SESSION['errormessage'] = "Update Failed, please contact support";
                        header("Location: ../../player/profile");
                    }
                }else{
                    $move = move_uploaded_file($fileTempLoc,$location.$fileNewName);
                    $sql = "UPDATE users SET prof_pic = '$fileNewName' WHERE id = '$currentUser'";
                    $query = mysqli_query($connectDb,$sql);
                    if ($query) {
                        $_SESSION['successmessage'] = "Update was successful";
                        header("Location: ../../player/profile");
                    }else{
                        $_SESSION['errormessage'] = "Update Failed, please contact support";
                        header("Location: ../../player/profile");
                    }
                }
           }else{
            $_SESSION['errormessage'] = "Corrupt file";
            header("Location: ../../player/profile");
           }
       }else{
        $_SESSION['errormessage'] = "File too large, max size: 5mb";
        header("Location: ../../player/profile");
       }
    }else{
        $_SESSION['errormessage'] = "This file type is not allowed, please upload either a jpg,png or jpeg file.";
        header("Location: ../../player/profile");
    }

}
