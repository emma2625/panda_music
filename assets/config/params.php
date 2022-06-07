<?php
// Require the neccessary modules
require "db_connect.php";
require "../includes/sessions.php";
date_default_timezone_set("Africa/Lagos");



if (isset($_GET['approveTransaction'])) {
    $tid = $_GET['approveTransaction'];
    $acct = $_GET['acct'];
    $amount = $_GET['amount'];

    $sql = "SELECT panda_coin FROM users WHERE acct_num = '$acct'";
    $query = mysqli_query($connectDb, $sql);
    $row = mysqli_fetch_assoc($query);
    $oldBal = $row['panda_coin'];

    $amount += $oldBal;

    $sql = "UPDATE users SET panda_coin = '$amount' WHERE acct_num = '$acct'";
    $query = mysqli_query($connectDb, $sql);

    // If we successfully add the new amount
    if ($query) {
        $sql = "UPDATE offline_payment SET payment_status = 'Successful' WHERE id = '$tid'";
        $query = mysqli_query($connectDb, $sql);

        // Update trannsaction to successfull
        if ($query) {
            $_SESSION['successmessage'] = "Payment has been validated";
            header("Location: ../../player/transactions");
        } else {
            $_SESSION['errormessage'] = "Update Failed, please contact support";
            header("Location: ../../player/transactions");
        }
    } else {
        $_SESSION['errormessage'] = "Update Failed, please contact support";
        header("Location: ../../player/transactions");
    }
}

elseif (isset($_GET['cancelTransaction'])) {
    $tid = $_GET['cancelTransaction'];
    $acct = $_GET['acct'];
    $amount = $_GET['amount'];

    $sql = "SELECT panda_coin FROM users WHERE acct_num = '$acct'";
    $query = mysqli_query($connectDb, $sql);
    $row = mysqli_fetch_assoc($query);
    $oldBal = $row['panda_coin'];

    
    if ($amout < $oldBal) {
        $amount = $oldBal - $amount;
    }else{
        $amount -= $oldBal;
    }

    $sql = "UPDATE users SET panda_coin = '$amount' WHERE acct_num = '$acct'";
    $query = mysqli_query($connectDb, $sql);

    // If we successfully add the new amount
    if ($query) {
        $sql = "UPDATE offline_payment SET payment_status = 'pending..' WHERE id = '$tid'";
        $query = mysqli_query($connectDb, $sql);

        // Update trannsaction to successfull
        if ($query) {
            $_SESSION['successmessage'] = "Payment has been canceled";
            header("Location: ../../player/transactions");
        } else {
            $_SESSION['errormessage'] = "Update Failed, please contact support";
            header("Location: ../../player/transactions");
        }
    } else {
        $_SESSION['errormessage'] = "Update Failed, please contact support";
        header("Location: ../../player/transactions");
    }
}
elseif (isset($_GET['del'])) {
   $delId = $_GET['del'];
   $sql = "DELETE FROM offline_payment WHERE id = '$delId'";
   $query = mysqli_query($connectDb, $sql);

        // Delete successfull
        if ($query) {
            $_SESSION['successmessage'] = "Records has been deleted";
            header("Location: ../../player/transactions");
        } else {
            $_SESSION['errormessage'] = "Delete Failed, please contact support";
            header("Location: ../../player/transactions");
        }
} else {
    header('Location: logout');
}
