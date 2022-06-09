<?php  require "assets/includes/sessions.php"; ?>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Panda Music</title>

    <!-- Favicon -->
    <link rel="icon" href="assets/img/core-img/logo.png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/classy-nav.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Navbar Area -->
        <div class="oneMusic-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <?php require_once "assets/includes/navbar.php"; ?>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url(assets/img/bg-img/breadcumb3.jpg);">
        <div class="bradcumbContent textText">
            <p>See what’s new in Panda Music</p>
            <h2>Login</h2>
        </div>
        <div class="bradcumbContent textText2 d-none">
            <p>Get your free 12 coins Today</p>
            <h2>Register</h2>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Login Area Start ##### -->
    <section class="login-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="login-content">
                   <div id="message">
                   <?php  echo errorMessage(); echo successMessage(); ?>
                   </div>
                        <!-- Reset Pin  Form -->
                        <?php 
                           if (!isset($_GET['sentMail'])) {
                        ?>
                        <div class="login-form login">
                            <h3>Lets get you back online!!!</h3>
                            
                            <label for="exampleInputEmail1" class="d-block text-left">Email address</label>
                            <form action="assets/config/reset" method="post">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter E-mail">
                                    <small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>We'll never share your email with anyone else.</small>
                                </div>
                                <button type="submit" name="sendPlainEmail" class="btn oneMusic-btn mt-30">Send Pin</button>
                            </form>
                        </div>
                        <?php }else{ ?>
                            <div class="login-form login">
                            <h3>Enter the 6 digit OTP code sent to your mail!</h3>
                            <form action="assets/config/reset" method="post">
                                <div class="form-group">
                                    <label>Enter Token:</label>
                                    <input type="text" name="token" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter E-mail">
                                    <label>Enter New Password:</label>
                                    <input type="password" name="pass" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter E-mail">
                                </div>
                                <button type="submit" name="resetPassword" class="btn oneMusic-btn mt-30">Reset</button>
                            </form>
                        </div>
                        <?php } ?>
                        </div>  
                        <!-- register form ends -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Login Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container">
            <div class="row d-flex flex-wrap align-items-center">
                <div class="col-12 col-md-6">
                    <a href="index"><img src="assets/img/core-img/logo.png" alt="" class="mainLogo"></a>
                    <p class="copywrite-text">
                        Copyright &copy; 2022 All rights reserved
                    </p>
                </div>

                
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

        <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="assets/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="assets/js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="assets/js/active.js"></script>
</body>

</html>