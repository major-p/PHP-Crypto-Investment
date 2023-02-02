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
$amount=($_GET['amount']);
$code=($_GET['code']);

$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);


if(isset($_POST['submit']))
{
    $ref=$_POST['ref'];

    $sql1="UPDATE `transactions` SET `ref`='$ref',`updationDate`='$currentTime' WHERE `code`='$code'";
    $result1=mysqli_query($con,$sql1);
    if($result1){ 
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
                    <h4 class="card-title">Replenishment process</h4>
                    <p class="card-description">Send the exact specified amount to the specified address</p>
                    <div class="custom-row">
                    <div class="col-12 ">
                    <br>
                    <?php if(isset($msg)) { ?>
                <div class="error-wrapper-<?php echo $type?>">
                <span class="message-<?php echo $type?>"><?php echo $msg; ?></span>
                </div>
                <?php }?>
                    <div class="form-group">
                        <label>Send exactly</label>
                        <div class="coin-amount form-control">
                        $<?php echo $amount?>
                        </div>
                        
                      </div>
                      <?php 
                            $query2="select * from investment_address  where name='usdt' ";
                            $query_run=mysqli_query($con,$query2);
                            $data = mysqli_fetch_array($query_run);
                            ?>
                      <div class="form-group">
                        <label>to this address</label>
                        <input type="text" name="amount" value="<?php echo $data['address'];?>" class="form-control" id="myInput" >
                      </div>
                     
                      <button  class="btn btn-primary" onclick="myFunction()">Copy Address</button>
                     
                    </div>
                    </div>

                  </div>
                </div>
              </div>
     
              <div class="col-12 stretch-card" style="margin-top:20px">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">Confirm Payment</h4>
                    <p class="card-description">Please enter the transaction reference and click "Confirm Payment</p>
                    <div class="custom-row">
                    <div class="col-8 ">
                    <form class="" method="post" action="">
                      <div class="form-group">
                        <label>Transaction Reference</label>
                        <input type="text" name="ref" placeholder="Enter Transaction Reference" class="form-control form-control-white" >
                      </div>
                     
                      <button type="submit" name="submit" class="btn btn-success  create-new-button">Confirm Payment</button>
                    </form>
                    </div>
                    </div>

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
