<?php 
  require_once "../assets/config/db_connect.php";
  require_once "../assets/includes/sessions.php";
  // Included Navbar
  $currentUser = $_SESSION['id'];
  $sql = "SELECT * FROM users WHERE id = '$currentUser'";
  $query = mysqli_query($connectDb,$sql);

 $row = mysqli_fetch_assoc($query);
  auth();
  include_once '../assets/includes/dashboard_nav.php';
?>
<div class="content-wrapper">
  <?php echo errorMessage(); echo successMessage();?>

 
</div>
<style>
    ::placeholder{
        color: #000000 !important;
    }
</style>
<!-- Included footer -->
<?php  include_once '../assets/includes/dashboard_footer.php'; ?> 

