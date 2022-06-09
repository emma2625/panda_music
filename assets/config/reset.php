<?php
// Require the neccessary modules
require "db_connect.php";
require "../includes/sessions.php";

if (isset($_POST['sendPlainEmail'])) {
    $email = $_POST['email'];
    $token = rand(100000, 999999);

    $sql = "SELECT email FROM users WHERE email = '$email'";
    $query = mysqli_query($connectDb, $sql);

    if (mysqli_num_rows($query) < 1) {
        $_SESSION['errormessage'] = "Invalid Email";
        header("Location: ../../forgot1");
    } else {
        $sql = "UPDATE users SET password_reset = '$token' WHERE email = '$email'";
        $query = mysqli_query($connectDb, $sql);
        if ($query) {
            $to = $email; //Reciever of the email
            $subject = "Reset Password";
            $message = "Your One time Password(OTP) is $token";
            $message = wordwrap($message, 140, "\n\r");
            $headers = "From: support@pandamusic.com";

            $mail = mail($to, $subject, $message, $headers);

            if ($mail) {
                $_SESSION['successmessage'] = "Your mail was sent successfuly";
                header("Location: ../../forgot1?sentMail");
            } else {
                $_SESSION['errormessage'] = "Something went wrong ";
                header("Location: ../../forgot1");
            }
        } else {
            $_SESSION['errormessage'] = "Something went wrong ";
            header("Location: ../../forgot1");
        }
    }
} elseif (isset($_POST['resetPassword'])) {
    $token = $_POST['token'];
    $password = $_POST['pass'];

    $sql = "SELECT password_reset FROM users WHERE password_reset = '$token'";
    $query = mysqli_query($connectDb, $sql);
    if (mysqli_num_rows($query) < 1) {
        $_SESSION['errormessage'] = "Invalid Token";
        header("Location: ../../forgot1");
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password_reset = 'SET', user_password = '$password'  WHERE password_reset = '$token'";
        $query = mysqli_query($connectDb, $sql);
        if ($query) {
            $_SESSION['successmessage'] = "Password reset was successful";
            header("Location: ../../auth");
        } else {
            $_SESSION['errormessage'] = "Something went wrong ";
            header("Location: ../../forgot1");
        }
    }
} elseif (isset($_POST['sendHTMLEmail'])) {
    $email = $_POST['email'];
    $token = rand(100000, 999999);

    $linkTosend = "http://pandamusic.mkpropertiesonline.com/forgot2?q=$token";
    $sql = "SELECT email FROM users WHERE email = '$email'";
    $query = mysqli_query($connectDb, $sql);

    if (mysqli_num_rows($query) < 1) {
        $_SESSION['errormessage'] = "Invalid Email";
        header("Location: ../../forgot1");
    } else {
        $sql = "UPDATE users SET password_reset = '$token' WHERE email = '$email'";
        $query = mysqli_query($connectDb, $sql);
        if ($query) {
            $to = $email;
            $subject = 'Password Reset';
            //Add headers
            $headers = "From: Panda-Music <support@pandamusic.com>\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = "
                <html>
                    <div style=\"border: 1px solid; background-color: #FCF8E8; padding: 15px; margin: 0 auto; max-width: 700px;\">
                        <img src=\"http://pandamusic.mkpropertiesonline.com/assets/img/cover_img/pandaCoin.png\" style=\"height: 100px; width: 100px; display: block; margin: 0 auto;\">
                        <h1 style=\"text-align: center; color: #ff0000;\">Panda Music </h1>
                        <h3 style=\"text-align: center; color: #be1a1a;\">Click the button below to reset your password</h3>
        
                        <div style=\"text-align: center; padding: 20px 0;\">
                            <a href=\"$linkTosend\" style=\"text-decoration: none; padding: 10px 30px; border: none; border-radius: 10px; background-color: #47B5FF; color: #ffffff;\">Reset Password</a>
                        </div>
                    </div>
                </html>
            ";
            $mail = mail($to, $subject, $message, $headers);

            if ($mail) {
                $_SESSION['successmessage'] = "Your mail was sent successfuly";
                header("Location: ../../auth");
            } else {
                $_SESSION['errormessage'] = "Something went wrong ";
                header("Location: ../../forgot1");
            }
        } else {
            $_SESSION['errormessage'] = "Something went wrong ";
            header("Location: ../../forgot1");
        }
    }
}
