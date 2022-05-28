<?php 
    require 'assets/config/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

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

    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            <!-- Single Hero Slide -->
            <div class="single-hero-slide d-flex align-items-center justify-content-center">
                <!-- Slide Img -->
                <div class="slide-img bg-img" style="background-image: url(assets/img/bg-img/bg-1.jpg);"></div>
                <!-- Slide Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-slides-content text-center">
                                <h6 data-animation="fadeInUp" data-delay="100ms">Latest album</h6>
                                <h2 data-animation="fadeInUp" data-delay="300ms">Beyond Time <span>Beyond Time</span></h2>
                                <a data-animation="fadeInUp" data-delay="500ms" href="#" class="btn oneMusic-btn mt-50">Discover <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ##### Hero Area End ##### -->



    <!-- ##### Buy Now Area Start ##### -->
    <section class="oneMusic-buy-now-area has-fluid bg-gray section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading style-2">
                        <h2>See What’s New</h2>
                    </div>
                </div>
            </div>

            <div class="row">
            <audio src="" type="audio/mp3" id="player"></audio>
           
                <!-- Single Album Area -->
                <?php 
                    $sql = "SELECT * FROM music";
                    $query = mysqli_query($connectDb,$sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                    <div class="single-album-area wow fadeInUp" data-wow-delay="100ms">
                        <div class="album-thumb">
                            <img src="assets/img/cover_img/<?php echo $row['cover_image'] ?>" alt="">
                        </div>
                        <div class="album-info">
                            <a href="#">
                                <h5><?php echo ucwords($row['music_title']); ?></h5>
                            </a>
                            <p><?php echo ucwords($row['genre']); ?></p>
                            <form id="streamForm">
                                <input type="hidden" name="song" value="<?php echo $row['audio_file']; ?>">
                                <input type="hidden" name="id" value="btn<?php echo $row['id']; ?>">
                                <button  style="font-size: 21px;" class=" btn btn-light fa fa-play-circle" id="btn<?php echo $row['id']; ?>"></button>
                                <button  style="font-size: 21px;" class=" btn btn-light fa fa-pause-circle d-none" id="btn<?php echo $row['id']; ?>"></button>
                                <a href="assets/music/<?php echo $row['audio_file'] ?>" download style="font-size: 23px;" class="btn btn-light fa fa-download"></a>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <script>
                    const player = document.querySelector('#player');
                    const streamForms = document.querySelectorAll('#streamForm');
                    streamForms.forEach((forms)=>{
                        forms.addEventListener('submit',(e)=>{
                            e.preventDefault();
                            player.setAttribute('src',`assets/music/${forms.song.value}`);
                            player.play();
                            let id =  forms.id.value;
                            document.querySelectorAll(id).forEach((btn)=>{
                                btn.classList.toggle('d-none')
                            })
                        })
                    })
                    
                </script>
                    
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="load-more-btn text-center wow fadeInUp" data-wow-delay="300ms">
                        <a href="authentication" class="btn oneMusic-btn">Load More <i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Buy Now Area End ##### -->

    <!-- ##### Contact Area Start ##### -->
    <section id="contactUs" class="contact-area section-padding-100 bg-img bg-overlay bg-fixed has-bg-img" style="background-image: url(assets/img/bg-img/bg-2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading white wow fadeInUp" data-wow-delay="100ms">
                        <p>See what’s new</p>
                        <h2>Get In Touch</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- Contact Form Area -->
                    <div class="contact-form-area">
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group wow fadeInUp" data-wow-delay="100ms">
                                        <input type="text" class="form-control" id="name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group wow fadeInUp" data-wow-delay="200ms">
                                        <input type="email" class="form-control" id="email" placeholder="E-mail">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group wow fadeInUp" data-wow-delay="300ms">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group wow fadeInUp" data-wow-delay="400ms">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 text-center wow fadeInUp" data-wow-delay="500ms">
                                    <button class="btn oneMusic-btn mt-30" type="submit">Send <i class="fa fa-angle-double-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Contact Area End ##### -->

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