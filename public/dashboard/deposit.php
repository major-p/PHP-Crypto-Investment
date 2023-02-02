<?php
session_start();
error_reporting(0);
include('../../config/config.php');
include('includes/checklogin.php');
check_login();
$title="Dashboard";
$uid=$_SESSION['id'];
$uip=$_SERVER['REMOTE_ADDR'];
include 'includes/header.php'; 
include 'includes/sidebar.php';

$uid= $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

        
function randString($length, $charset='0123456789'){
            $str = '';
            $count = strlen($charset);
            while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
            }
            return $str;
            }
            $unique_id = randString(8);
    
$codequery ="SELECT * FROM `transactions` WHERE `code`='$unique_id' ";
$result = mysqli_query($con, $codequery);
$count=mysqli_num_rows($result);
if($count>0)
{
$unique_id = randString(8);
}
$code="$unique_id";

if(isset($_POST['submit']))
{
    $coin=$_POST['coin'];
    $amount=$_POST['amount'];

    $sql1="INSERT INTO `transactions` (`user_id`,`coin`,`type`,`amount`,`code`)
    VALUES  ('$uid','$coin','Deposit','$amount','$code')";
    $result1=mysqli_query($con,$sql1);
    if($result1){ 
    $msg="Deposit created successfully! Redirecting you to replenishment process";
    $type = "success";
    ?>
     <script>
    setTimeout(function () {
    window.location ='replenishment-process.php?amount=<?php echo $amount ?>&coin=<?php echo $coin ?>&code=<?php echo $code ?>';
    }, 3000);
    </script>;
    <?php
    }else{
    $msg="something went wrong,please try again";
    $type = "warning";
    }  
}

			?>

 <!-- partial -->
 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Cold Wallet Deposit Address </h3>
            
            </div>
            <div class="row">
              
            <div class="col-12  stretch-card">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">Select crypto and enter amount</h4>
                    <p class="card-description">To replenish the balance, please select a currency and enter the amount. </p>
                    <div class="custom-row">
                    <div class="col-12 ">
                        <br>
                    <?php if(isset($msg)) { ?>
                <div class="error-wrapper-<?php echo $type?>">
                <span class="message-<?php echo $type?>"><?php echo $msg; ?></span>
                </div>
                <?php }?>
                    <form class="" method="post" action="">
                    <div class="form-group">
                        <label>Select cryptocurrency</label>
                        <select name="coin"  class="form-control form-control-white" required>
                        <?php 
                        $coinquery="SELECT * FROM `coins`";
                        $result=mysqli_query($con,$coinquery);
                        while($data=mysqli_fetch_array($result))
                        {?>
                      <option value="<?php echo $data['symbol'];?>"><?php echo $data['name'];?></option>
                      <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Enter amount</label>
                        <input type="text" name="amount" class="form-control form-control-white"  
                        placeholder="0.005" required>
                      </div>
                     
                     
                     
                      <button type="submit" name="submit" class="btn btn-primary  create-new-button">Continue</button>
                    </form>
                    </div>
                    </div>

                  </div>
                </div>
              </div>
             
            
              
        </div>
        </div>

<?php include 'includes/footer.php' ?>
