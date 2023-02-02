<?php
session_start();
error_reporting(0);
include('../../config/config.php');
include('includes/checklogin.php');
check_login();
$title="Transaction History";
include 'includes/header.php'; 
include 'includes/sidebar.php';
$currentTime = date( 'd-m-Y h:i:s A', time () );
?>    
  <!-- partial -->
  <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Transaction History </h3>
            
            </div>
            <div class="row">
              
            <div class="col-12  stretch-card">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">All Transactions</h4>
                    <div class="custom-row">
                   
                    <div class="table-responsive">
                        <?php 
                         $query="SELECT * FROM `transactions`  ";
                         $result=mysqli_query($con,$query);
                         $cnt=1;
                         if(mysqli_num_rows($result)>0){
                            ?>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>SN</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                    while($trx=mysqli_fetch_array($result)){
                      ?>
                          <tr>
                           <td><?php echo $cnt++; ?></td>
                            <td><?php echo $trx['date']; ?></td>
                            <td><?php echo $trx['type']; ?></td>
                            <td class="uppercase-text"><?php echo $trx['amount']; ?> <?php echo $trx['coin']; ?></td>
                            <td>
                            <?php if($trx['status'] == 'Pending'){   
                            ?>
                             <label class="badge badge-danger"><?php echo $trx['status']; ?></label>
                             <?php }else{
                                ?>
                            <label class="badge badge-success"><?php echo $trx['status']; ?></label>
                              
                             <?php }?>
                                </td>
                          </tr>
                          <?php } 
                    }else{
                      echo"
                      <div class='card-body'>
                     <p style='text-align:left'> No Transaction yet!</p>
                      </div>
                      ";
                    }
                    ?>
                        </tbody>
                      </table>
                    </div>

                    </div>

                  </div>
                </div>
              </div>
             
            
              
        </div>
        </div>          


<?php include 'includes/footer.php' ?>
