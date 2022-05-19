<?php
    require "../includes/sessions.php";
    $_SESSION['successmessage'] = "You have hit reg control";
    header('Location: ../../auth');