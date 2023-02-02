<?php
session_start();
include('../../config/config.php');
error_reporting(0);
$ref_id=$_GET['ref'];//referal ID
if(isset($_POST['submit']))
{
$username=trim($_POST['username']);
$email=trim($_POST['email']);
$password=trim($_POST['password']);
$repassword=trim($_POST['repassword']);
$terms=trim($_POST['terms']);
$ref=trim($_POST['ref']);

//we will make regular expressions(search pattern) FOR VALIDATION as FOLLOWS:
$emailValidation = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z]{2,3})$/';
$number="/^[0-9]+$/";

$regpass1="@[a-z]@";//here @ searches for minimum one SMALL letter from the string
$regpass2="@[A-Z]@";
$regpass3="@[0-9]@";
$regpass4="@[^\w]@";

if(empty($username) || empty($email) || empty($password) ){
    $msg="All fields are required";
    $type = "warning";
}elseif(!preg_match($emailValidation,$email)){ 
        $msg = 'Please enter a valid email'; 
        $type = "warning";
}elseif($_POST['password'] != $_POST['repassword']){ 
    $msg = 'Passwords should be the same!'; 
    $type = "warning";
}elseif(!isset($terms)){ 
    $msg = 'Accept Terms and conditions before submit'; 
    $type = "warning";
}else{
$username=mysqli_real_escape_string($con,$username);
$email=mysqli_real_escape_string($con,$email);
$ref=mysqli_real_escape_string($con,$ref);

//Strip Tags
$username=htmlspecialchars(strip_tags($username));
$email=htmlspecialchars(strip_tags($email));
$ref=htmlspecialchars(strip_tags($ref));
$password=htmlspecialchars(strip_tags($password));
$password=md5($password);

//check if email already exists in the database
$sql="SELECT `email` FROM users WHERE `email`='$email' LIMIT 1";
$result=mysqli_query($con,$sql);
//check if username already exists in the database
$sql2="SELECT `username` FROM users WHERE `username`='$username' LIMIT 1";
$result2=mysqli_query($con,$sql2);

if(mysqli_num_rows($result)>0){
         $msg="An account with the email '$email' already exists";
         $type = "warning";                   
}elseif(mysqli_num_rows($result2)>0){ 
  $msg = 'An account with the same username already exists'; 
  $type = "warning";
}else{
  function randString($length, $charset='123456789')
  {
                          $str = '';
                          $count = strlen($charset);
                          while ($length--) {
                              $str .= $charset[mt_rand(0, $count-1)];
                          }
                          return $str;
  }
                      $otp = randString(6);

                      $codesql ="SELECT * FROM users WHERE `code`='$otp' ";
                      $countresult=mysqli_query($con,$codesql);
                      $count=mysqli_num_rows($countresult);
                      if($count>0)
                      {
                      $otp = randString(6);
                      }
                      $code=$otp;

   $sql1="INSERT INTO `users` (`username`, `email`, `password`,`code`,`ref`)
                VALUES  ('$username','$email','$password','$code','$ref')";

    $result1=mysqli_query($con,$sql1);
    if($result1){ 
        $msg="Account created successfully. Redirecting you to login...";
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

}//end of else (form validation)
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BitScopia</title>
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
    <link rel="shortcut icon" href="assets/images/logo.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper  align-items-center auth login-bg">
          <div class="logo-container">
          <img src="assets/images/logo.png" class="logo" style="width:200px;">
            </div>
            <div class="card col-lg-4 mx-auto" style="background:#fff;padding:0px;">
            <div class="login-text-wrapper">
                <h3 class="card-title text-left mb-3 black-font">Sign up</h3>
                    </div>
              <div class="card-body"  style="width:106%;margin-left:-3%">
<?php if(isset($msg)) { ?>
<div class="error-wrapper-<?php echo $type?>">
<span class="message-<?php echo $type?>"><?php echo $msg; ?></span>
</div>
<?php }?>
                <form method="post" action="">
                <input type="hidden" name="ref" value="<?php if(isset($ref_id)) echo $ref_id; ?>" >

                <div class="form-group">
                    <label>Username *</label>
                    <input type="text" name="username" class="form-control p_input" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" class="form-control p_input" placeholder="example@email.com">
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" class="form-control p_input" placeholder="********">
                  </div>
                  <div class="form-group">
                    <label>Confirm Password *</label>
                    <input type="password" name="repassword" class="form-control p_input" placeholder="********">
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check" style="color:black;font-size:15px">
                        <input type="checkbox" name="terms" class="form-check-input" >
                          I agree to the <a href="terms.php"> Terms & Conditions</a> 
                    </div>
                  </div>
                 
                  <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn">Sign up</button>
                  </div>
                
                  <p class="sign-up">Already have an Account?<a href="index.php"> Sign In</a></p>
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