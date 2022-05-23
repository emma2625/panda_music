<?php
// require the neccessary modules
    require "db-connect.php";
    require "../includes/sessions.php";
    date_default_timezone_set('Africa/Lagos')
 
// check if the button was pushed

  if(!isset($_POST['register'])) {
   $_SESSION['errormessage']="please create an Account to continue";
   header('Location: ../../auth#message');
}else{
   // collect all the data from the user
   $fullName = $_POST['fname'];
   $userNmae = $_POST['uname'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $cPass = $_POST['cpass'];
   $accName = 'PM'.rand(1000000,9999999);
   $pcoin = 12;
   echo $date = date('Y-m-d h:i:s');

//    set connstraints
if (strlen($password)) < 8 {
    $_SESSION['errormessage'] = 'password must not be less than 8 characters';
    header('Location: ../../auth#message');
}
elseif (strlen($userName) > 30) {
    $_SESSION['errormessage'] = 'Username is too long';
    header('Location: ../../auth#message');
}
elseif ($password != $cPass) {
    $_SESSION['errormessage'] = 'passwords do not match';
    header('Location: ../../auth#message');
}else{
    // when all constraints are met

    // hash user password(encrypt)

    $password = password_hash($password,PASSWORD_DEFAULT);


    // save to DataBase
    // 1. prepare Query string
    $sql = "INSERT INTO users(full_name,username,email,user_password,acct_num,panda_coin,date_created)VALUES(?,?,?,?,?,?,?)";
  

      //   2. Initialize connection
    $stmt = mysqli_stmt_init($connectDb);


    // prepare your statement
    mysqli_stmt_prepare($stmt,$sql);

    // 4. Bind our values to the placeholders
    mysqli_stmt_bind_param($stmt,'sssssis',$fullName,$userName,$email,$password,$accName,$pcoin,$date);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['successmessage'] = 'congrats your account has been created successfully';
        header('Location: ../../auth#message');
    }else{
        $_SESSION['errormessage'] = 'something went wrong';
        header('Location: ../../auth#message');
    }

}


}

    