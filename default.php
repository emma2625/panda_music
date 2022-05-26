<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Panda Music | Admin</title>
  <link rel="stylesheet" href="../assets/css/dashnav.css">
  <link rel="stylesheet" href="../assets/css/personal-extra.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
  <link rel="shortcut icon" href="../assets/img/core-img/logo.png" />
  
</head>
<body>
  <div class="container-scroller">
    <!-- FULL NAV STARTS HERE -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo me-5" href="dashboard"><img src="../assets/img/core-img/dashlogo.png" class="me-2" alt="logo"/>Pmusic</a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../assets/img/core-img/dashlogo.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fas fa-bars"></span>
        </button>
        <ul class="navbar-nav me-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <form class="input-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
              <button class="btn">
                  <i class="fas fa-search"></i>
              </button>
            </form>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-settings me-5 d-none d-lg-flex">
            <img src="../assets/img/core-img/pandaCoin.png" alt="coin" id="navCoin">
            <span><?php echo $row['panda_coin'] ?></span>
          </li>
          <!-- Profile Pic And DropDown Start -->
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../assets/img/profile_Uploads/<?php
                        $img = $row['prof_pic'];
                        if (empty($img)) {
                            echo "user.png";
                        }else{
                            echo "$img?".mt_rand();
                        }
                    ?>" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <h6 class="fw-bold dropdown-item"><?php echo ucwords($row['full_name']); ?></h6>
              
              <h6 class="fw-bold dropdown-item border-bottom">
                <i class="fas fa-id-badge text-info"></i>
                 <?php echo $row['acct_num']; ?>
              </h6>
              <a class="dropdown-item">
                <i class="fas fa-cog text-primary"></i>
                Settings
              </a>
              <a href="../assets/config/logout" class="dropdown-item">
                <i class="fas fa-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          
        </ul>
        <!-- Navbar Toggler -->
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="fas fa-bars"></span>
        </button>
      </div>
    </nav>
    <!--End of Top Nav -->
    <div class="container-fluid page-body-wrapper">
      <!--Start of Side Bar -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard">
              <i class="fas fa-tachometer-alt"></i>
              <span class="menu-title ps-3">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile" >
              <i class="fas fa-id-badge"></i>
              <span class="menu-title ps-3">Profile</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#ui-basic" >
              <i class="fas fa-music"></i>
              <span class="menu-title ps-3">Favourites</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add-music">
              <i class="fas fa-music"></i>
              <span class="menu-title ps-3">Upload Music</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- FULL NAV ENDS HERE -->
      

      <!-- MAIN PANNEL STARTS -->
      <div class="main-panel">