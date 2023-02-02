<?php
session_start();
error_reporting(0);
include('../../config/config.php');
include('includes/checklogin.php');
check_login();
$title="Dashboard";
include 'includes/header.php'; 
include 'includes/sidebar.php';
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_GET['confirm']))
{
    $tid=($_GET['trx']);
    $uid=($_GET['uid']);

    $sql = "SELECT * FROM `transactions` WHERE id='$tid' ";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);
    $amount=$row['amount'];

    $sql1 = "SELECT * FROM `users` WHERE `id`='$uid' ";
    $result = mysqli_query($con, $sql1);
    $r = mysqli_fetch_assoc($result);
    $oldbal=$r['balance'];
    $newbal=($oldbal-$amount);


    if($amount =""){ 
        $msg="Withdrawal Amount is invalid";
        $type = "warning";
    }else{
     $amount=$row['amount'];
    $sql1="UPDATE `transactions` SET `status`='Confirmed',`updationDate`='$currentTime' WHERE `id`='$tid'";
    $result1=mysqli_query($con,$sql1);
    if($result1){  
    $msg="Withdrawal Confirmed Successfully";
    $type = "success";
    }else{
    $msg="something went wrong,please try again";
    $type = "warning";
    }  
}
}
// Coin Withdrawal Begins
if(isset($_GET['confirmation']))
{
    $tid=($_GET['trx']);
    $uid=($_GET['uid']);


    $sql = "SELECT * FROM `transactions` WHERE id='$tid' ";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);
    $amount=$row['amount'];
    $coin=$row['coin'];

    $sql1 = "SELECT * FROM `users` WHERE `id`='$uid' ";
    $result = mysqli_query($con, $sql1);
    $r = mysqli_fetch_assoc($result);
    $oldbal=$r[$coin];
    $newbal=($oldbal-$amount);

    if($amount =""){ 
        $msg="Withdrawal Amount is invalid";
        $type = "warning";
    }else{
    $sql1="UPDATE `transactions` SET `status`='Confirmed',`updationDate`='$currentTime' WHERE `id`='$tid'";
    $result1=mysqli_query($con,$sql1);
    if($result1){  
    $msg="Withdrawal Confirmed Successfully";
    $type = "success";
    }else{
    $msg="something went wrong,please try again";
    $type = "warning";
    }  
}

}



 ?>       <div class="main-panel">
          <div class="content-wrapper">
          <br>
                    <?php if(isset($msg)) { ?>
                <div class="error-wrapper-<?php echo $type?>">
                <span class="message-<?php echo $type?>"><?php echo $msg; ?></span>
                </div>
                <?php }?>
                <br>
            <div class="row">
              <div class="col-md-6 grid-margin ">
                <div class="card">   
                    <div class="" style="width:100%;">
                    <div class="card">     
                   <div class="card-body">
                    <h4 class="card-title">Investment Withdrawals</h4>
                    </p>
                    <div class="table-responsive">
                        <?php 
                         $query="SELECT * FROM `transactions` WHERE  `type`='Withdrawal' AND `status` ='Pending' AND `coin` =''  ";
                         $result=mysqli_query($con,$query);
                         $cnt=1;
                         if(mysqli_num_rows($result)>0){
                            ?>
                      <table class="table">
                        <thead>
                          <tr>
                          <th>SN</th>
                            <th>Plan</th>
                            <th>Amount</th>
                            <th>Reference</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                    while($row=mysqli_fetch_array($result)){
                      ?>
                          <tr>
                          <td><?php echo $cnt++; ?></td>
                            <td><?php echo $row['type']; ?></td>
                            <td class="uppercase-text">$<?php echo $row['amount']; ?></td>
                            <td>
                            <?php if($row['ref'] == ''){   
                            ?>
                             <label class="badge badge-danger">No Reference</label>
                             <?php }else{
                                ?>
                            <?php echo $row['ref']; ?>
                              
                             <?php }?>
                                </td>
                            <td>  <label class="badge badge-danger"><?php echo $row['status']; ?></label></td>
                            <td><?php echo $row['date']; ?></td>
                            <td>
                           <a href="?trx=<?php echo $row['id'];?>&confirm=true&uid=<?php echo $row['user_id'];?>" 
                           onClick="return confirm(`Are you sure you want to confirm deposit? Confirmation would add deposit to the user's investment`)" class="badge badge-success">
                           Confirm</a>
                            </td>

                          
                          </tr>
                          <?php } 
                    }else{
                      echo"
                      <div class='card-body'>
                     <p style='text-align:left'> No Withdrawal Request yet!</p>
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
                      <h4 class="card-title mb-1">Crypto Withdrawals</h4>
                    </div>
                    <div class="table-responsive">
                        <?php 
                         $query="SELECT * FROM `transactions` WHERE `type`='Withdrawal' AND `status` ='Pending' AND `coin` !=''  ";
                         $result=mysqli_query($con,$query);
                         $cnt=1;
                         if(mysqli_num_rows($result)>0){
                            ?>
                      <table class="table">
                        <thead>
                          <tr>
                          <th>SN</th>
                            <th>Amount</th>
                            <th>Reference</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                    while($row=mysqli_fetch_array($result)){
                      ?>
                          <tr>
                          <td><?php echo $cnt++; ?></td>
                            <td class="uppercase-text">$<?php echo $row['amount']; ?> <?php echo $row['coin']; ?></td>
                            <td>
                            <?php if($row['ref'] == ''){   
                            ?>
                             <label class="badge badge-danger">No Reference</label>
                             <?php }else{
                                ?>
                            <?php echo $row['ref']; ?>
                              
                             <?php }?>
                                </td>
                            <td>  <label class="badge badge-danger"><?php echo $row['status']; ?></label></td>
                            <td><?php echo $row['date']; ?></td>
                            <td>
                           <a href="?trx=<?php echo $row['id'];?>&confirmation=true&uid=<?php echo $row['user_id'];?>" 
                           onClick="return confirm(`Are you sure you want to confirm deposit? Confirmation would add deposit to the user's wallet`)" class="badge badge-success">
                           Confirm</a>
                            </td>

                          
                          </tr>
                          <?php } 
                    }else{
                      echo"
                      <div class='card-body'>
                     <p style='text-align:left'> No Deposit yet!</p>
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
