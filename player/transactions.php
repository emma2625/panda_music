<?php 
  require_once "../assets/config/db_connect.php";
  require_once "../assets/includes/sessions.php";
  // Included Navbar
  $currentUser = $_SESSION['id'];
  $sql = "SELECT * FROM users WHERE id = '$currentUser'";
  $query = mysqli_query($connectDb,$sql);

 $row = mysqli_fetch_assoc($query);
  auth();
  adminAuth();
  include_once '../assets/includes/dashboard_nav.php';
?>
<div class="content-wrapper">
    <?php echo errorMessage(); echo successMessage();?>

    <div class="card p-3 shadow">
        <div class="table-responsive my-3">
            <h5 class="text-right">Order By</h5>
            <a href="transactions" class="btn btn-outline-primary">View All</a>
            <form method="get" class="d-flex justify-content-end">
                <input type="date" name="date" class="form-control w-25">
                <button type="submit" class="fas fa-search btn"></button>
            </form>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Acct Num</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Reciept</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col">...</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if (!isset($_GET['date'])) {
                            $sql = "SELECT * FROM offline_payment ORDER BY id DESC LIMIT 0,5";
                        }else{
                            $search = $_GET['date'];
                            $sql = "SELECT * FROM offline_payment WHERE date_created LIKE '%$search%'";
                        }
                        $query = mysqli_query($connectDb,$sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row['acct_num']; ?></th>
                        <td>
                            <?php 
                                $acct = $row['acct_num'];
                                $aql = "SELECT * FROM users WHERE acct_num = '$acct'";
                                $aQuery = mysqli_query($connectDb,$aql);
                                $urow = mysqli_fetch_assoc($aQuery);
                                echo $urow['full_name'];
                            ?>
                        </td>
                        <td><?php echo $row['amount_coin']; ?></td>
                        <td>
                            <a href="../assets/img/reciepts/<?php echo $row['reciept']; ?>" target="_blank"
                                class="btn btn-outline-info fas fa-eye"></a>
                        </td>
                        <td><?php echo $row['payment_status']; ?></td>
                        <td><?php
                         $date = date_create($row['date_created']);
                         echo date_format($date,"M. j, Y g:i A");
                        ?></td>
                        <!-- Validate -->
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary text-nowrap" data-bs-toggle="modal"
                                data-bs-target="#modal<?php echo $row['id']; ?>">
                                <i class="fas fa-exchange-alt"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal<?php echo $row['id']; ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Process Transaction</h5>
                                            <button type="button" class="btn fas fa-times" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <?php
                                                if($row['payment_status'] !== 'pending..'){
                                                    echo "<h5>Already validated, Do you want to revert transaction?</h5>";
                                                }else{
                                                    echo "<h5>Do you want to validate this transaction?</h5>";
                                                }
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <?php if($row['payment_status'] !== 'pending..'){ ?>
                                            <a href="../assets/config/params?cancelTransaction=<?php echo $row['id']; ?>&acct=<?php echo $row['acct_num']; ?>&amount=<?php echo $row['amount_coin']; ?>" class="btn btn-warning">Reverse</a>
                                            <?php }else{ ?>
                                                <a href="../assets/config/params?approveTransaction=<?php echo $row['id']; ?>&acct=<?php echo $row['acct_num']; ?>&amount=<?php echo $row['amount_coin']; ?>" class="btn btn-success">Validate</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                         <!-- Delete -->
                         <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger text-nowrap" data-bs-toggle="modal"
                                data-bs-target="#delete<?php echo $row['id']; ?>">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="delete<?php echo $row['id']; ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Process Transaction</h5>
                                            <button type="button" class="btn fas fa-times" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                         
                                        <h3 class="text-center">Are you Sure</h3>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                aria-label="Close"> NO</button>

                                            <a href="../assets/config/params?del=<?php echo $row['id']; ?>" class="btn btn-danger">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
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