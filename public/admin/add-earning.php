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
              <h3 class="page-title">Add Earning </h3>
            
            </div>
            <div class="row">
              
            <div class="col-12  stretch-card">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">Investors Details</h4>
                    <div class="custom-row">
                   
                    <div class="table-responsive">
                        <?php 
                         $query="SELECT *
                         FROM `investment`  
                         LEFT JOIN `users`  ON users.id=investment.user_id ";
                         $result=mysqli_query($con,$query);
                         $cnt=1;
                         if(mysqli_num_rows($result)>0){
                            ?>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>SN</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Plan</th>
                            <th>Amount</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                    while($trx=mysqli_fetch_array($result)){
                      ?>
                          <tr>
                           <td><?php echo $cnt++; ?></td>
                            <td><?php echo $trx['username']; ?></td>
                            <td><?php echo $trx['name']; ?></td>
                            <td class="uppercase-text"><?php echo $trx['plan']; ?></td>
                            <td>$<?php echo $trx['amount']?>  </td>
                            <td> <a href="earning-form.php?uid=<?php echo $trx['user_id']; ?>&plan=<?php echo $trx['plan']; ?>&stats=<?php echo $trx['amount']; ?>"> 
                             <button type="button" class="badge badge-success">
                                 Add Earning
                             </button></a>
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