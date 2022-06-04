<?php 
    include_once '../assets/includes/sessions.php';
    include_once '../assets/config/db_connect.php';
    date_default_timezone_set("Africa/Lagos");
    $currentUser = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id = '$currentUser'";
    $query = mysqli_query($connectDb,$sql);
    $row = mysqli_fetch_assoc($query);


    if (!isset($_GET['report'])) {
        session_unset();
        session_destroy();
        header('Location:../index');
    }else{
        $report = $_GET['report'];

        if ($report === 'failed') {
            $_SESSION['errormessage'] = "Payment Failed try again!";
            header('Location: store');
        }
        elseif($report === 'adjcndcwuijnqodw2u1wdhm12edhiwnqddh230j9123yqdfj0ow3jfnqshidkdh8qc9asixm2ed89iqwejndik9oa'){
            $amount = $_GET['amount'];
            $acctNum = $row['acct_num'];
            $reciept = "default.png";
            $status = "successful";
            $date = date('Y-m-d h:i:s g');

            $sql = "INSERT INTO offline_payment(acct_num,amount_coin,reciept,payment_status,date_created) VALUES(?,?,?,?,?)";

            // 2. Initialize connection
            $stmt = mysqli_stmt_init($connectDb);

            // 3. Prepare your Statement
            mysqli_stmt_prepare($stmt, $sql);

            // 4. Bind our values to the placeholders
            mysqli_stmt_bind_param($stmt, "sssss", $acctNum,$amount,$reciept,$status, $date);

            // 5.Execute the Statement
            if (mysqli_stmt_execute($stmt)) {
                $oldCoin = $row['panda_coin'];
                $amount += $oldCoin;
               $sql = "UPDATE users SET panda_coin = '$amount' WHERE id = '$currentUser'";
               $query = mysqli_query($connectDb,$sql);
               if ($query) {
                    $_SESSION['successmessage'] = "Payment successful!";
                    header("Location:store");
               }else {
                    $_SESSION['errormessage'] = "Something went wrong ";
                    header("Location:store");
                }
            } else {
                $_SESSION['errormessage'] = "Something went wrong ";
                header("Location:store");
            }

        }else{
            header('Location:store');
        }
    }
    