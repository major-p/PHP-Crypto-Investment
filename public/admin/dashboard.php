<?php
session_start();
error_reporting(0);
include('../../config/config.php');
include('includes/checklogin.php');
check_login();
$title="Dashboard";
include 'includes/header.php'; 
include 'includes/sidebar.php';
?>



<div class="main-panel">
          <div class="content-wrapper">
           
          
            <div class="row">
              <div class="col-md-6 grid-margin ">
                <div class="card">  
                  <div class="card-body">        
                  
                 
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Current Users:</h6>
                    <p class="text-muted mb-0">
                    <?php 
                      $query="SELECT * FROM `users` ";
                      $result=mysqli_query($con,$query);
                      $num_rows = mysqli_num_rows($result);    
						          
		                  ?>
			                <?php echo $num_rows?>
                    </p>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                    </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Total Investment</h6>
                    <p class="text-muted mb-0">
                    <?php 
                      $query="SELECT * FROM `investment` ";
                      $result=mysqli_query($con,$query);
                      while($row=mysqli_fetch_array($result)){ 
                      $amount = $row['amount'];
						          }  
		                  ?>
			                $<?php echo $amount?>
                    </p>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                    </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Total Withdrawal</h6>
                    <p class="text-muted mb-0">
                    <?php 
                      $query="SELECT * FROM `transactions` WHERE `status`='Confirmed' AND 
                      `type`='Withdrawal' ";
                      $result=mysqli_query($con,$query);
					  
					            $sum = 0;
                      while($row=mysqli_fetch_array($result)){ 
                      $amount = $row['amount'];
                      $sum += (int)$amount;          
						          }  
		                  ?>
			                $<?php echo $sum?>
                    </p>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                    </div>
                    </div>
                    </div>
                  
                    <div class="" style="width:100%;">
                    <div class="card">     
                   <div class="card-body">
                    <h4 class="card-title">Pending Transactions with Proofs</h4>
                    </p>
                    <div class="table-responsive">
                        <?php 
                         $query="SELECT * FROM `transactions` WHERE  `status` ='Pending' AND `ref` !='' ";
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



              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                 
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title mb-1">Transaction History</h4>
                    </div>
                    <div class="table-responsive">
                        <?php 
                         $query="SELECT * FROM `transactions` ";
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
           


<?php include 'includes/footer.php' ?>
