<?php 
  require_once "../assets/config/db_connect.php";
  require_once "../assets/includes/sessions.php";
  // Included Navbar
  $currentUser = $_SESSION['id'];
  $sql = "SELECT * FROM users WHERE id = '$currentUser'";
  $query = mysqli_query($connectDb,$sql);

 $row = mysqli_fetch_assoc($query);
 $acctNum = $row['acct_num'];
  auth();
  include_once '../assets/includes/dashboard_nav.php';
?>
<div class="content-wrapper">
    <?php echo errorMessage(); echo successMessage();?>
    <div class="card shadow-sm p-3">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql = "SELECT * FROM offline_payment WHERE acct_num = '$acctNum'";
                        $query = mysqli_query($connectDb,$sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <td><?php
                         $date = date_create($row['date_created']);
                         echo date_format($date,"M. j, Y g:i A");
                        ?></td>
                        <td><?php echo $row['amount_coin']; ?></td>
                        <td><?php echo $row['payment_status']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<style>
::placeholder {
    color: #000000 !important;
}
</style>
<!-- Included footer -->
<?php  include_once '../assets/includes/dashboard_footer.php'; ?>