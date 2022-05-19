<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbName = "panda_music";

    $connectDb = mysqli_connect($server,$username,$password,$dbName);

    if (!$connectDb) {
        die("Failed to Connect to database".mysqli_connect_error());
    }