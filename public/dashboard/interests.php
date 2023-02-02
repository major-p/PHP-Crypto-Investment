<?php
session_start();
error_reporting(0);
include('../../config/config.php');
include('includes/checklogin.php');
check_login();
$title="Earnings";
$uid=$_SESSION['id'];
$uip=$_SERVER['REMOTE_ADDR'];
include 'includes/header.php'; 
include 'includes/sidebar.php';

$currentTime = date( 'd-m-Y h:i:s A', time () );
$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);


if(isset($_POST['submit']))
{
    $amount=$_POST['amount'];
	$eid=$_POST['eid']; //earning ID

    //Define old and new balance
    $oldbal=$row["balance"];
    $newbal=($oldbal+$amount);

if(empty($amount) || empty($eid) ){
    $msg="An Error Occured please try again";
    $type = "warning";
}elseif($amount = ""){ 
    $msg = 'An Unexpected Error Occured please try again'; 
    $type = "warning";
}else{
    $sql2="UPDATE `users` SET `balance`='$newbal' WHERE `id`='$uid' ";
    $result2=mysqli_query($con,$sql2);
    if($result2){ 
    $sql1="UPDATE `earnings` SET `status`='1' WHERE `uid`='$uid' AND `id`='$eid' ";
    $result1=mysqli_query($con,$sql1);
    if($result1){ 
        $msg="Earning claimed Successfully";
        $type = "success";
    }else{
        $msg="Couldn't claim earning,please try again";
        $type = "warning";  
    }
    

    }else{
    $msg="something went wrong,please try again";
    $type = "warning";
    }   
}

}
			?>

 
 <!-- partial -->
 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Earnings </h3>
            
            </div>
            <div class="row">
              
            <div class="col-12  stretch-card">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">My Earnings</h4>
                    <p class="card-description"></p>
                    <div class="custom-row">
                    <div class="col-12 ">
                        <br>
                    <?php if(isset($msg)) { ?>
                <div class="error-wrapper-<?php echo $type?>">
                <span class="message-<?php echo $type?>"><?php echo $msg; ?></span>
                </div>
                <?php }?>
                  
                <div class="table-responsive">
                        <?php 
                         $query="SELECT * FROM `earnings` WHERE `uid`='$uid' ORDER BY id DESC  ";
                         $result=mysqli_query($con,$query);
                         $cnt=1;
                         if(mysqli_num_rows($result)>0){
                            ?>
                <table class="table">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
            while($trx=mysqli_fetch_array($result)){
                $status=$trx['status'];
                ?>
                    <tr>
                    <td><?php echo $cnt++; ?></td>
                    <td>$<?php echo $trx['amount']; ?></td>
                    <td>
                    <?php 
                    if($status == "0"){  
                    ?>
                    <form role="form" name="" method="post">
                    <input type="hidden" name="amount" class="form-control" value="<?php echo $trx['amount'];?>" >
                    <input type="hidden" name="eid" class="form-control" value="<?php echo $trx['id'];?>" >
                <button type="submit" class="btn btn-success" name="submit"> Claim</button>
                </form>

                <?php
                   }else{
                 echo "<i>Claimed</i>";
                }
                ?>
                </td>
                <td><?php echo $trx['creationDate']; ?></td>
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
        </div>
<?php include 'includes/footer.php' ?>
