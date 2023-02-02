<?php
session_start();
error_reporting(0);
include('../../config/config.php');
include('includes/checklogin.php');
check_login();
$title="Dashboard";
$uid=$_SESSION['id'];
$uip=$_SERVER['REMOTE_ADDR'];
$currentTime = date( 'd-m-Y h:i:s A', time () );
include 'includes/header.php'; 
include 'includes/sidebar.php';

$status=$_GET['stats'];//status code
$vcode=$status-433456644;

$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

        
if(isset($_POST['submit']))
{
    $code=$_POST['digits'];
    $dcode=$row['code'];

   if($row['status'] !== '0'){
    $msg="Your account has already been verified";
    $type = "warning"; 
    echo "<script>window.location ='dashboard.php</script>;";
    }elseif($code != $vcode){ 
    $msg = "Invalid Verification Code : $code "; 
    $type = "warning";
    }elseif($code != $dcode){ 
    $msg = "Invalid Verification Code"; 
    $type = "warning";
    }else{
        $sql1="UPDATE `users` SET `status`='1',`code`='',`updationDate`='$currentTime' WHERE `id`='$uid'";
        $result1=mysqli_query($con,$sql1);
        if($result1){ 
        $msg="Email Verification Successful. Redirecting you to dashboard...";
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
              <h3 class="page-title">Email Verfication </h3>
            
            </div>
            <div class="row">
              
            <div class="col-12  stretch-card">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">Confirm Code</h4>
                    <p class="card-description">Please Enter the 6-Digits confirmation code sent to your email </p>
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
                        <label>Enter code</label>
                        <input type="text" name="digits" class="form-control form-control-white"  
                        placeholder="123456" required>
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
