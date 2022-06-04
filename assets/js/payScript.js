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
                 window.location = "payment?report=failed";
            } else {
                //when successful
            window.location = "payment?report=adjcndcwuijnqodw2u1wdhm12edhiwnqddh230j9[123yqdfj0ow3jfnqshidkdh8qc9asixm%2ed89iqwejndik9oa&amount=<?php echo $coinAmount; ?>";
            }
        }
        }
    );
    });
    });