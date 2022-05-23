<?php 
  require_once "../assets/config/db_connect.php";
  require_once "../assets/includes/sessions.php";
  // Included Navbar

  auth();
  include_once '../assets/includes/dashboard_nav.php';
?>
<div class="content-wrapper">
  <?php echo errorMessage(); echo successMessage(); echo $_SESSION['id']; ?>
</div>
<!-- Included footer -->
<?php  include_once '../assets/includes/dashboard_footer.php'; ?> 

