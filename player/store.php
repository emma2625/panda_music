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
    <div class="card p-3 shadow-sm mx-auto" style="max-width: 500px;">
        <img src="../assets/img/cover_img/pandaCoin.png" style="height: 100px;" class="d-block mx-auto">

        <h3>Buy Panda Coins</h3>

        <?php 
            $price = 7;
            $amount = 5;
            for ($i=0; $i < 4; $i++) { 
                $price *= 2;
                $amount *= 2;
        ?>
        <form action="payment-voucher" method="post" class="row border p-1 rounded mb-2    ">
            <div class="col-9">
                <h6>
                    $<?php echo $price; ?> per <?php echo $amount; ?> <img src="../assets/img/cover_img/pandaCoin.png" style="height: 50px;"
                        class="border rounded-circle p-2">
                </h6>
                <input type="hidden" name="amount" value="<?php echo $amount;    ?>">
            </div>
            <div class="col-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#modal<?php echo $amount; ?>">
                    Buy now
                </button>

                <!-- Modal -->
                <div class="modal fade" id="modal<?php echo $amount; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn fas fa-times" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h2>Would you like to buy <?php echo $amount;  ?> <img src="../assets/img/cover_img/pandaCoin.png" style="height: 50px;"
                        class="border rounded-circle p-2"></h2> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
                                <button type="submit" name="buyCoin" class="btn btn-success">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php } ?>




    </div>

</div>
<style>
::placeholder {
    color: #000000 !important;
}
</style>
<!-- Included footer -->
<?php  include_once '../assets/includes/dashboard_footer.php'; ?>