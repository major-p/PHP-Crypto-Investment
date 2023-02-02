<?php
session_start();
include('../../config/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{

$ret = "SELECT * FROM admin WHERE username='".$_POST['username']."' and password='".md5($_POST['password'])."'";
$result=mysqli_query($con,$ret);
$num=mysqli_fetch_array($result);

if($num>0)
{
$extra="dashboard.php";
$_SESSION['dlogin']=$_POST['username'];
$_SESSION['id']=$num['id'];
$_SESSION['name']=$num['fullname'];

$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log="INSERT INTO adminlog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['dlogin']."','$uip','$status')";
$result=mysqli_query($con,$log);
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
exit();
}
else
{
$host  = $_SERVER['HTTP_HOST'];
$_SESSION['dlogin']=$_POST['username'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log="INSERT INTO adminlog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['dlogin']."','$uip','$status')";
$result=mysqli_query($con,$log);$_SESSION['errmsg']="Invalid username or password";
$extra="index.php";
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
echo "<script type='text/javascript'> document.location ='index.php'; </script>";
exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bitscopia</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper  align-items-center auth login-bg">
          <div class="logo-container">
            <h3>Bitscopia</h3>
            </div>
            <div class="card col-lg-4 mx-auto" style="background:#fff;">
            <div class="login-text-wrapper">
                <h3 class="card-title text-left mb-3 black-font">Admin Sign in</h3>
            </div>
                <div class="card-body  "  style="width:106%;margin-left:-3%;">
                <?php if($_SESSION['errmsg'] !== '') { ?>

                <div class="error-wrapper-warning" style="background:none">
                <span class="message-warning"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
                </div>
                <?php }?>
                  <form method="post" action="">
                  <div class="form-group">
                    <label>Email *</label>
                    <input type="text" name="username" class="form-control p_input" placeholder="username">
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" class="form-control p_input" placeholder="********">
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="reset-password" class="forgot-pass">Reset password</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                
                  <p class="sign-up">Don't have an Account?<a href="signup.php"> Sign Up</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>