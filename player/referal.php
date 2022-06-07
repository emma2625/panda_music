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
    <div class="card p-3 w-75 shadow-sm mx-auto">
        <h3>Referal Link</h3>

        <div class="row">
            <div class="col-10">
                <input type="text" id="copy" class="form-control" value="https://pandaMusic.com/auth?ref=<?php echo $link = $row['ref_code'] ?>" readonly>


            </div>
            <div class="col-2">
                <button class="btn btn-primary w-100" onclick="copyText()">
                    <i class="fa fa-copy"></i>
                </button>
            </div>
        </div>
        <div class="my-3">
            <!-- FULL API LINK WITH PHONE NUMBER
                    https://api.whatsapp.com/send?text=Hello, Pand Music, I would like to enquire about the Property&phone=+2347036849564
            -->
            <?php $link = "https://pandaMusic.com/auth?ref=".$link; ?>
            <a href="https://api.whatsapp.com/send?text=Hey come checkout this cool plat form, you can use my link:<?php echo $link; ?> to join us at panda Music" class="btn btn-outline-success" target="_blank">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </div>
 
</div>
<style>
    ::placeholder{
        color: #000000 !important;
    }
</style>
<!-- Included footer -->
<?php  include_once '../assets/includes/dashboard_footer.php'; ?> 
<script>
    function copyText() {
    var copyText = document.getElementById("copy");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);

    /* Alert the copied text */
    alert("Link: " + copyText.value);
    }
</script>

