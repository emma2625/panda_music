<?php
// Require the neccessary modules
require "db_connect.php";
require "../includes/sessions.php";
date_default_timezone_set("Africa/Lagos");
$currentUser = $_SESSION['id'];
if (isset($_POST['createAlbum'])) {
    $userAcctNum = $_POST['acctnum'];
    $albumName = $_POST['album_name'];
    $date = date("Y-m-d h:i:s");


    // 1. Prepare Query String
    $sql = "INSERT INTO albums(user_acct,album_name,date_created) VALUES(?,?,?)";

    // 2. Initialize connection
    $stmt = mysqli_stmt_init($connectDb);

    // 3. Prepare your Statement
    mysqli_stmt_prepare($stmt, $sql);

    // 4. Bind our values to the placeholders
    mysqli_stmt_bind_param($stmt, "sss", $userAcctNum, $albumName, $date);

    // 5.Execute the Statement
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['successmessage'] = "Album created successfully";
        header("Location: ../../player/add-music");
    } else {
        $_SESSION['errormessage'] = "Something went wrong ";
        header("Location: ../../player/add-music");
    }
}

// Upload Music control
elseif (isset($_POST['uploadMusic'])) {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $duration = $_POST['duration'];
    $album = $_POST['album'];
    $genre = $_POST['genre'];
    $cover = $_FILES['cover'];
    $audio = $_FILES['audio'];
    $date = date('Y-m-d h:i:s');

    $sql = "SELECT * FROM users WHERE id = '$currentUser'";
    $query = mysqli_query($connectDb, $sql);
    $row = mysqli_fetch_assoc($query);

    $pandaCoin = $row['panda_coin'];
    $acctNum = $row['acct_num'];

    if ($pandaCoin < 2) {
        echo  $_SESSION['errormessage'] = "Oops! looks like you are out of coins";
        header("Location: ../../player/add-music");
    } else {
        $pandaCoin -= 2;

        $fileName = $cover['name'];
        $fileTempLoc = $cover['tmp_name'];
        $fileError = $cover['error'];
        $fileSize = $cover['size'];

        $fileType = explode(".", $fileName);
        $fileType = end($fileType);
        $fileType = strtolower($fileType);
        $location = "../img/cover_img/";


        // Create an array of allowed file types
        $allowedFiles = array('jpg', 'png', 'jpeg');

        // Get the File type
        $fileType = explode(".", $fileName);
        $fileType = end($fileType);
        $fileType = strtolower($fileType);
        $location = "../img/cover_img/";

        // Audio File Checks Starts

        $audioFileName = $audio['name'];
        $audioFileTempLoc = $audio['tmp_name'];
        $audioFileError = $audio['error'];
        $audioFileSize = $audio['size'];

        $audioFileType = explode(".", $audioFileName);
        $audioFileType = end($audioFileType);
        $audioFileType = strtolower($audioFileType);
        $audioLocation = "../music/";
        // End of Audio File Check//////////////////////////////////////////////////////////////////


        // Build our constraints
        if (in_array($fileType, $allowedFiles) && $audioFileType === 'mp3') {
            // Check file size
            if ($fileSize < 5000000 && $audioFileSize < 10000000) {
                // Check for errors   
                if ($fileError < 1 && $audioFileError < 1) {
                    $newCoverImage = "cover_for" . mt_rand() . "." . $fileType;
                    $newAudioFile = "audio_for" . mt_rand() . "." . $audioFileType;
                    //    Move both files
                    $move = move_uploaded_file($fileTempLoc, $location . $newCoverImage);
                    $move2 = move_uploaded_file($audioFileTempLoc, $audioLocation . $newAudioFile);

                    if ($move && $move2) {
                        // 1. Prepare Query String
                        $sql = "INSERT INTO music(acct_num,music_title,music_artist,duaration,album,genre,cover_image,audio_file,date_created) VALUES(?,?,?,?,?,?,?,?,?)";

                        // 2. Initialize connection
                        $stmt = mysqli_stmt_init($connectDb);

                        // 3. Prepare your Statement
                        mysqli_stmt_prepare($stmt, $sql);

                        // 4. Bind our values to the placeholders
                        mysqli_stmt_bind_param($stmt, "sssssssss", $acctNum, $title, $artist, $duration, $album, $genre, $newCoverImage, $newAudioFile, $date);

                        // 5.Execute the Statement
                        if (mysqli_stmt_execute($stmt)) {
                            $sql = "UPDATE users SET panda_coin = '$pandaCoin' WHERE id = '$currentUser'";
                            $query = mysqli_query($connectDb, $sql);
                            if ($query) {
                                $_SESSION['successmessage'] = "Music added successfully";
                                header("Location: ../../player/add-music");
                            } else {
                                $_SESSION['errormessage'] = "Something went wrong ";
                                header("Location: ../../player/add-music");
                            }
                        } else {
                            $_SESSION['errormessage'] = "Something went wrong ";
                            header("Location: ../../player/add-music");
                        }
                    } else {
                        $_SESSION['errormessage'] = "Failed, please contact support";
                        header("Location: ../../player/add-music");
                    }
                } else {
                    $_SESSION['errormessage'] = "Corrupt files, please check your files";
                    header("Location: ../../player/add-music");
                }
            } else {
                $_SESSION['errormessage'] = "filesize too large, max image size: 5mb & max audio size is 10mb";
                header("Location: ../../player/add-music");
            }
        } else {
            echo $_SESSION['errormessage'] = "This file types is not allowed, please upload either a jpg,png or jpeg file, or an mp3 file";
            // header("Location: ../../player/add-music");
        }
    }
}
elseif(isset($_POST['payOffline'])){
    $amount = $_POST['amount'];
    $acct = $_POST['uuid'];
    $status = "pending..";
    $file = $_FILES['proof'];
   

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
    $location = "../img/reciepts/";

    // Build our constraints
    if (in_array($fileType,$allowedFiles)) {
        // Check file size
       if ($fileSize < 5000000) {
        // Check for errors   
           if ($fileError < 1) {
               $fileNewName = "reciept".mt_rand().".".$fileType;
                // Check if file exist
                $move = move_uploaded_file($fileTempLoc,$location.$fileNewName);
                // 1. Prepare Query String
                $sql = "INSERT INTO offline_payment(acct_num,amount_coin,reciept,payment_status,date_created) VALUES(?,?,?,?,?)";

                // 2. Initialize connection
                $stmt = mysqli_stmt_init($connectDb);

                // 3. Prepare your Statement
                mysqli_stmt_prepare($stmt, $sql);

                // 4. Bind our values to the placeholders
                mysqli_stmt_bind_param($stmt, "sssss", $acct,$amount,$fileNewName,$status, $date);

                // 5.Execute the Statement
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['successmessage'] = "Payment successful, pending approval..";
                    header("Location: ../../player/store");
                } else {
                  echo  $_SESSION['errormessage'] = "Something went wrong ";
                    //header("Location: ../../player/store");
                }

           }else{
            $_SESSION['errormessage'] = "Corrupt file";
            header("Location: ../../player/store");
           }
       }else{
        $_SESSION['errormessage'] = "File too large, max size: 5mb";
        header("Location: ../../player/store");
       }
    }else{
        $_SESSION['errormessage'] = "This file type is not allowed, please upload either a jpg,png or jpeg file.";
        header("Location: ../../player/store");
    }

}


// Main Else

else {
    header('Location: ../../index');
}
