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
$plan=($_GET['plan']);
$planID=$plan-433456644;

$sql = "SELECT * FROM `investment_plans` WHERE `id`='$planID' ";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
if($row<1)
{
echo "<script type='text/javascript'> document.location ='investment-plans.php'; </script>";
}
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
    $amount=$_POST['amount'];
    $plan=$_POST['type'];
    $min=$row['min'];
    $max=$row['max'];
    
if(empty($amount) || empty($plan) ){
    $msg="An Error Occured! Please try again";
    $type = "warning";
}elseif($amount < $min){ 
    $msg = 'The amount you entered is lower than the minimum investment amount for this plan.Please choose a different plan or enter an higher amount'; 
    $type = "warning";
}elseif($amount > $max){ 
    $msg = 'The amount you entered is higher than the maximum investment amount for this plan.Please choose a different plan or enter a low amount'; 
    $type = "warning";
}else{
    $sql1="INSERT INTO `transactions` (`user_id`,`coin`,`type`,`amount`,`code`)
    VALUES  ('$uid','$coin','$plan Plan','$amount','$code')";
    $result1=mysqli_query($con,$sql1);
    if($result1){ 
    $msg="Investment request created successfully! Redirecting you to replenishment process";
    $type = "success";
    ?>
     <script>
    setTimeout(function () {
    window.location ='investment-replenishment-process.php?amount=<?php echo $amount ?>&code=<?php echo $code ?>';
    }, 3000);
    </script>;
    <?php
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
              <h3 class="page-title">Investment </h3>
            
            </div>
            <div class="row">
              
            <div class="col-12  stretch-card">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">Plan - <?php echo $row['name']?></h4>
                    <p class="card-description">Please enter your desired investment amount to create an investment</p>
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
                        <input type="hidden" name="type" value="<?php echo $row['name']?>">
                      </div>
                      <div class="form-group">
                        <label>Amount (USD)</label>
                        <input type="text" name="amount" class="form-control form-control-white"  
                        placeholder="Enter Amount" required>
                      </div>
                      <p class="" style="color:red;">*Minimum investment is $<?php echo $row['min']?> and maximum investment is $<?php echo $row['max']?> </p>

                     
                     
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
