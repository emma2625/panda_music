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


  <div class="row">
    <div class="col-md-8 mb-2">
      <div class="card mx-auto p-3">
        <h5 class="card-title">Lastest Songs</h5>

        <div class="row">
            <div class="col-md-4 mb-2">
              <div class="card border">
                <img src="../assets/img/core-img/dashlogo.png" height="90px" class="card-img-top">
                <div class="card-body">
                  <h5 class="fw-bold p-3 shadow-sm">Title: <span>John Doe</span></h5> 
                </div>
                <button class="btn">
                    <i class="fas fa-play-circle" style="font-size: 40px !important;"></i>
                </button>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow p-3">
          <img src="../assets/img/core-img/dashlogo.png" alt="" style="width: 200px; height:200px;" class="card-img-top rounded-circle border d-block mx-auto">
          <div class="d-flex justify-content-center">
              <button class="btn">
                <i class="fas fa-play-circle" style="font-size: 40px !important;"></i>
              </button>
          </div>
          <div class="mt-2" style="font-weight: bold !important;">
            <ul class="list-unstyled">
              <li>
                <h5 class="fw-bold border p-3 shadow-sm">Artist: <span>John Doe</span></h5> 
              </li>
              <li>
                <h5 class="fw-bold border p-3 shadow-sm">Title: <span>John Doe</span></h5> 
              </li>
              <li>
                <h5 class="fw-bold border p-3 shadow-sm">Genre: <span>John Doe</span></h5> 
              </li>
              <li>
                <h5 class="fw-bold border p-3 shadow-sm">Album: <span>John Doe</span></h5> 
              </li>
            </ul>
          </div>

        
      </div>
    </div>
  </div>
</div>
<!-- Included footer -->
<?php  include_once '../assets/includes/dashboard_footer.php'; ?> 

