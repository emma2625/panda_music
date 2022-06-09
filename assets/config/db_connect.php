<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbName = "panda_music";

    // $server = "localhost";
    // $username = "u109482341_panda_music";
    // $password = "APGS:~P&fN5";
    // $dbName = "u109482341_panda_music";

    $connectDb = mysqli_connect($server,$username,$password,$dbName);

    if (!$connectDb) {
        die("Failed to Connect to database".mysqli_connect_error());
    }