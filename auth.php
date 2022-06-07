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
                        <!-- Login Form -->
                        <div class="login-form login">
                            <h3>Welcome Back</h3>
                            
                            <label for="exampleInputEmail1" class="d-block text-left">Email address</label>
                            <form action="assets/config/login_control" method="post">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter E-mail">
                                    <small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <button type="submit" name="login" class="btn oneMusic-btn mt-30">Login</button>
                                <a href="#" class="nav-link text-dark" onclick="change()">Create An Account Today to get 12 panda coins</a>
                            </form>
                        </div>

                        <!-- Register Form Starts -->
                        <div class="login-form register d-none">
                            <form action="assets/config/register_control" method="post">
                                <?php 
                                    if (isset($_GET['ref'])) {
                                        echo " <input type=\"hidden\" name=\"refBy\" value=\"". $_GET['ref']."\">";
                                    }
                                ?>
                                <h3>Create an Account to get Started</h3>
                                <div class="form-group">
                                    <label for="exampleInputName">Full Name</label>
                                    <input type="text" class="form-control" name="fname" id="exampleInputName" placeholder="Enter Full Name">
                                </div>

                                <div class="form-group">
                                    <label for="example">User Name</label>
                                    <input type="text" class="form-control" name="uname" id="example" placeholder="Enter User Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter E-mail">
                                    <small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" class="form-control" name="cpass" id="exampleInputPassword1" placeholder="Confirm Password">
                                </div>
                                <button type="submit" name="register" class="btn oneMusic-btn mt-30">Register</button>


                                <a href="#" class="nav-link text-dark" onclick="change()">Login Instead</a>
                            </form>
                        <!-- Register Form Ends -->
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
    <script>
        function change() {
            document.querySelector('.register').classList.toggle('d-none')
            document.querySelector('.login').classList.toggle('d-none')
            document.querySelector('.textText').classList.toggle('d-none')
            document.querySelector('.textText2').classList.toggle('d-none')
        }
    </script>
</body>

</html>