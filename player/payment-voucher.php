<?php 
  require_once "../assets/config/db_connect.php";
  require_once "../assets/includes/sessions.php";

  if (!isset($_POST['buyCoin'])) {
     header('Location: store');
  }
  else{
      $ref = "PM".rand(1000000,9999999);
      $coinAmount = $_POST['amount'];
      if ($coinAmount == 10) {
          $payAmount = 14;
      }
      elseif ($coinAmount == 20) {
        $payAmount = 28;
      }
      elseif ($coinAmount == 40) {
        $payAmount = 56;
      }
      elseif ($coinAmount == 80) {
        $payAmount = 112;
      }

      
  }
  // Included Navbar
  $currentUser = $_SESSION['id'];
  $sql = "SELECT * FROM users WHERE id = '$currentUser'";
  $query = mysqli_query($connectDb,$sql);

 $row = mysqli_fetch_assoc($query);
 $email = $row['email'];
 $phone = "08123457678";
  auth();
  include_once '../assets/includes/dashboard_nav.php';
?>
<div class="content-wrapper">
    <?php echo errorMessage(); echo successMessage();?>

    <div class="card mx-auto p-3 shadow-sm" style="max-width: 500px;">
        <img src="../assets/img/core-img/pandaCoin.png" height="150px" class="mx-auto d-block">


        <div class="border rounded my-2 p-2 lh-lg">
            <h3 class="mb-3">
                Ref: <?php echo $ref; ?>
            </h3>
            <h3 class="mb-3">
                Amount: <?php echo $coinAmount; ?>
            </h3>

            <small class="fw-bold  my-3">
                <i> Please upload payment reciept if you paid offline</i>
            </small>
            <form action="../assets/config/insert-control" method="POST" enctype="multipart/form-data">
                <input type="file" name="proof" class="form-control mb-3" required>
                <input type="hidden" name="amount" value="<?php echo $coinAmount; ?>">
                <input type="hidden" name="uuid" value="<?php echo $row['acct_num']; ?>">
                <button type="submit" name="payOffline" class="btn btn-primary" >Pay Offline</button>
            </form>
            <div class="text-right">
                <small>Pay online with your debit card</small>
                 <!-- //// begins flutterwave payment code //// -->
                <small>Pay online with your debit card</small>
                <input type="submit" class="btn-success btn" style="cursor:pointer;" value="Pay Now" id="submit" />
                
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                    <script type="text/javascript" src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                    <script type="text/javascript">
                    document.addEventListener("DOMContentLoaded", function(event) {
                    document.getElementById('submit').addEventListener('click', function () {
                        
                    var flw_ref = "", chargeResponse = "", trxref = "FDKHGK"+ Math.random(), API_publicKey = "FLWPUBK_TEST-83af4504f6370dc6576a13be3875e79b-X";//Always change flutterwave public key to your own key

                    //   ENTER ALL ESSENTIAL VARIABLES
                    // var amount_ea = "50000";
                    var amount_ea = <?php echo $payAmount;?>;
                    var email_ea = <?php echo (json_encode($email)); ?>;
                    var phone_ea = <?php echo (json_encode($phone)); ?>;
                    var ref_ea = <?php echo(json_encode($ref)); ?>;

                    getpaidSetup(
                        {
                        PBFPubKey: API_publicKey,
                        customer_email: email_ea,
                        amount: amount_ea,
                        customer_phone: phone_ea,
                        currency: "USD",
                        txref: ref_ea,
                        meta: [{metaname:"EA-NG", metavalue: "US"}],
                        onclose:function(response) {
                        },
                        callback:function(response) {
                            txref = response.data.txRef, chargeResponse = response.data.chargeResponseCode;
                            if (chargeResponse == "00" || chargeResponse == "0") {
                            //   if payment failed
                            window.location = "forgot?report=failed";
                            } else {
                                //when successful
                            window.location = "forgot?report=Success";
                            }
                        }
                        }
                    );
                    });
                    });
                </script>
                <!-- END OF PAYMENT SCRIPT -->
            </div>

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