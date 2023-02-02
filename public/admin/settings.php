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
$uid= $_SESSION['id'];

// Update Password
if(isset($_POST['submit']))
{

$sql5 = "SELECT * FROM `admin` WHERE `id`='$uid' ";
$res5 = mysqli_query($con, $sql5);
$row2 = mysqli_fetch_assoc($res5);

    $password=$row2['password'];
    $oldpassword=md5($_POST['oldpassword']);
    $newpassword = mysqli_real_escape_string($con, $_POST['newpassword']);
    $confirmpassword = mysqli_real_escape_string($con, $_POST['confirmpassword']);


    if(empty($oldpassword) || empty($newpassword) || empty($confirmpassword)){
      $msg="All password fields must be filled";
      $type = "warning";
  }elseif($password !== $oldpassword){ 
      $msg = 'Old password not correct'; 
      $type = "warning";
  }elseif($newpassword !== $confirmpassword){ 
    $msg="Passwords do not match!";
    $type = "warning";
  }else{
    $newpasswordhash=md5($_POST['newpassword']);
    $sql1="UPDATE `admin` SET `password`='$newpasswordhash',updationDate='$currentTime'
    WHERE `id` = '$uid' ";
    $result1=mysqli_query($con,$sql1);
    if($result1){ 
      $msg="Password Successfully Updated!!";
      $type = "success";
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
              <h3 class="page-title">Change Password</h3>
            
            </div>
            <div class="row">
              
            <div class="col-12  stretch-card">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">Update Your Password</h4>
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
                        <label>Old Password</label>
                        <input type="password" name="oldpassword" class="form-control"  value="">
                      </div>
                      <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="newpassword" class="form-control"  value="">
                      </div>
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmpassword" class="form-control"  value="">
                      </div>
                     
                      <button type="submit" name="submit" class="btn btn-primary mr-2">Save</button>
                    </form>
                    </div>
                    </div>

                  </div>
                </div>
              </div>
             
            
              
        </div>
        </div>

<?php include 'includes/footer.php' ?>
