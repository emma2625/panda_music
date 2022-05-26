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

    <div class="card mx-auto p-3">
        <!-- Album create starts here -->
        <div class="text-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create New Album
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog text-left">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New Album</h5>
                            <button type="button" class="btn btn-outline-primary fas fa-times" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <form action="../assets/config/insert-control" method="POST">
                               <label>Album Name</label>
                               <input type="hidden" name="acctnum" value="<?php echo $row['acct_num']; ?>">
                               <input type="text" name="album_name"  class="form-control mb-2" required>
                               <button type="submit" name="createAlbum" class="btn btn-outline-primary">Create</button>
                           </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- Album create ends here -->

         <div class="card border p-3 rounded mx-auto" style="max-width: 600px;">
            <form action="../assets/config/insert-control" method="post" enctype="multipart/form-data">
                <div class="row">
                <div class="col-2 mb-2 pt-3">
                        <label>Title:</label>
                    </div>
                    <div class="col-10 mb-2">
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="col-2 mb-2 pt-3">
                        <label>Artist:</label>
                    </div>
                    <div class="col-10 mb-2">
                        <input type="text" name="artist" class="form-control" required>
                    </div>

                    <div class="col-2 mb-2 pt-3">
                        <label>Duration:</label>
                    </div>
                    <div class="col-10 mb-2">
                        <input type="text" name="duration" class="form-control" required>
                    </div>

                    <div class="col-2 mb-2 pt-3">
                        <label>Album:</label>
                    </div>
                    <div class="col-10 mb-2">
                        <select name="album" class="form-control" required>
                            <option>Single</option>
                            <?php 
                                $acctNum = $row['acct_num'];
                                $sql = "SELECT album_name FROM albums WHERE user_acct = '$acctNum'";
                                $query = mysqli_query($connectDb,$sql);
                                while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <option><?php echo ucfirst($row['album_name']); ?> </option>
                            <?php } ?>
                        </select>
                        
                    </div>

                    <div class="col-2 mb-2 pt-3">
                        <label>Genre:</label>
                    </div>
                    <div class="col-10 mb-2">
                        <select name="genre" class="form-control" required>
                            <option>Hip Hop</option>
                            <option>RnB</option>
                            <option>Rock & Roll</option>
                            <option>Afro Beats</option>
                            <option>Tecno</option>
                            <option>Soul Music</option>
                            <option>UK Drill</option>
                        </select>
                    </div>

                    <div class="col-2 mb-2 pt-3">
                        <label>Album Cover:</label>
                    </div>
                    <div class="col-10 mb-2">
                        <input type="file" name="cover" class="form-control" accept="image/*" required>
                    </div>

                    <div class="col-2 mb-2 pt-3">
                        <label>Audio File:</label>
                    </div>
                    <div class="col-10 mb-2">
                        <input type="file" name="audio" class="form-control" accept="audio/*" required>
                    </div>


                    <div class="col-12 my-3">
                        <button type="submit" name="uploadMusic" class="btn btn-outline-success">Upload</button>
                    </div>
                </div>
            </form>
         </div>
    </div>
</div>
<!-- Included footer -->
<?php  include_once '../assets/includes/dashboard_footer.php'; ?>