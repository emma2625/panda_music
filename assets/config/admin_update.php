<?php
// Require the neccessary modules
require "db_connect.php";
require "../includes/sessions.php";

// Check if the button was pushed
if (!isset($_POST['adminUpdate'])) {
    $_SESSION['errormessage'] = "Please Create an Account to Continue";
    header("Location: ../../auth#message");
} else {
    $acct = $_POST['acct'];
    $coin = $_POST['coin'];
    $fullName = $_POST['fname'];
    $userName = $_POST['uname'];
    $country = $_POST['con'];

    if (!empty($fullName)) {
        $sql = "UPDATE users SET full_name = '$fullName' WHERE acct_num = '$acct'";
        $query = mysqli_query($connectDb, $sql);

        if ($query) {
            $_SESSION['successmessage'] = "Update was successful";
            header("Location: ../../player/user-details?user=$acct");
        } else {
            $_SESSION['errormessage'] = "Update Failed, please contact support";
            header("Location: ../../player/user-details?user=$acct");
        }
    } else {
        header("Location: ../../player/user-details?user=$acct");
    }
    if (!empty($coin)) {
        $sql = "UPDATE users SET panda_coin = '$coin' WHERE acct_num = '$acct'";
        $query = mysqli_query($connectDb, $sql);

        if ($query) {
            $_SESSION['successmessage'] = "Update was successful";
            header("Location: ../../player/user-details?user=$acct");
        } else {
            $_SESSION['errormessage'] = "Update Failed, please contact support";
            header("Location: ../../player/user-details?user=$acct");
        }
    } else {
        header("Location: ../../player/user-details?user=$acct");
    }
    if (!empty($userName)) {
        $sql = "UPDATE users SET username = '$userName' WHERE acct_num = '$acct'";
        $query = mysqli_query($connectDb, $sql);

        if ($query) {
            $_SESSION['successmessage'] = "Update was successful";
            header("Location: ../../player/user-details?user=$acct");
        } else {
            $_SESSION['errormessage'] = "Update Failed, please contact support";
            header("Location: ../../player/user-details?user=$acct");
        }
    } else {
        header("Location: ../../player/user-details?user=$acct");
    }

    if (!empty($country)) {
        $sql = "UPDATE users SET country = '$country' WHERE acct_num = '$acct'";
        $query = mysqli_query($connectDb, $sql);

        if ($query) {
            $_SESSION['successmessage'] = "Update was successful";
            header("Location: ../../player/user-details?user=$acct");
        } else {
            $_SESSION['errormessage'] = "Update Failed, please contact support";
            header("Location: ../../player/user-details?user=$acct");
        }
    } else {
        header("Location: ../../player/user-details?user=$acct");
    }
}
