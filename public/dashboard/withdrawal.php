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

$currentTime = date( 'd-m-Y h:i:s A', time () );
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
    $address=$_POST['address'];

    $oldbal=$row[$coin];
    $newbal=($oldbal-$amount);

    if($amount > $oldbal){ 
        $msg="Sorry your balance is lower than the entered withdrawal amount.";
        $type = "warning";
    }else{
    $sql1="INSERT INTO `transactions` (`user_id`,`coin`,`type`,`amount`,`address`,`code`)
    VALUES  ('$uid','$coin','Withdrawal','$amount','$address','$code')";
    $result1=mysqli_query($con,$sql1);
    if($result1){  
    $updateQuery="UPDATE `users` SET `$coin`='$newbal' WHERE `id`='$uid'";   
    $result2=mysqli_query($con,$updateQuery);  
    $msg="Transaction reference submitted successfully. Please Wait for confirmation.";
    $type = "success";
    echo '<script>
    setTimeout(function () {
      window.location ="dashboard.php";
  }, 3000);</script>';
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
              <h3 class="page-title">Cold Wallet Deposit Address </h3>
            
            </div>
            <div class="row">  
            <div class="col-12  stretch-card">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">Request Withdrawal</h4>
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
                        <label>Select Currency</label>
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
                        <label>Destination Address</label>
                        <input type="text" name="address" class="form-control form-control-white"  
                        placeholder="please enter recipient's address" required>
                      </div>
                      <div class="form-group">
                        <label>Enter amount</label>
                        <input type="text" name="amount" class="form-control form-control-white"  
                        placeholder="please enter an amount" required>
                      </div>        
                      <button type="submit" name="submit" class="btn btn-primary  create-new-button">Continue</button>
                    </form>
                    </div>
                    </div>

                  </div>
                </div>
              </div>
     
              <div class="col-12 stretch-card" style="margin-top:20px">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">Important Information</h4>
                    <p class="card-description">* We strongly recommend that you copy & paste the address to help avoid errors.
                     Please note that we are not responsible for coins mistakenly sent to the wrong address.
                     </p>
                     <p class="card-description">
                     * Transactions normally take about 30 to 60 minutes to send, on occasion it can take a few hours if the crypto network is slow. 
                     </p>

                  </div>
                </div>
              </div>
             
            
              
        </div>
        </div>

        <script>
    function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert("Address copied to bash clipboard");
} 
</script>
<?php include 'includes/footer.php' ?>
