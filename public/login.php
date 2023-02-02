<?php
session_start();
include('../config/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
    $ret = "SELECT * FROM users WHERE email='".$_POST['username']."' and password='".md5($_POST['password'])."'";
    $result=mysqli_query($con,$ret);
    $num=mysqli_fetch_array($result);
    
    if($num>0)
    {
    $extra="dashboard.php";
    $_SESSION['dlogin']=$_POST['username'];
    $_SESSION['id']=$num['id'];
    $uip2=$_SERVER['REMOTE_ADDR'];
    $uip = getenv("REMOTE_ADDR");//fetch ip address in PHP    
    $status="Successful";

    $log="INSERT INTO userslog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['dlogin']."','$uip','$status')";
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
    $uip2=$_SERVER['REMOTE_ADDR'];
    $uip = getenv("REMOTE_ADDR");//fetch ip address in PHP
    $status="Failed";

    $log="INSERT INTO userslog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['dlogin']."','$uip','$status')";
    $result=mysqli_query($con,$log);$_SESSION['errmsg']="Invalid username or password";
    $extra="index.php";
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    echo "<script type='text/javascript'> document.location ='index.php'; </script>";
    exit();
    }
    }
?>
<?php 
include 'includes/header.php';
?>

<div class="container-xxl py-5 bg-primary  mb-5">
               
            </div>
        </div>
    <!-- Contact Start -->
    <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                            <h2 class="mt-2">Sign in</h2>
                        </div>
                        <div class="wow fadeInUp" data-wow-delay="0.3s">
                       <div class="error-wrapper">
                       <span style="color:red;text-align:center;width:100%;">
                <?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?>
                        </span>
                        </div>
                            <form method="post" action="">
                                <div class="row g-3">
                                 
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="username" name="username" placeholder="Email">
                                            <label for="subject">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                            <label for="subject">Password</label>
                                        </div>
                                    </div>
                                  
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" name="submit" type="submit">Sign in</button>
                                    </div>
                                    <div class="col-12">
                                      <p>Don't have an account? <a href="register.php">Sign up </a> </p>
                                    </div>
                                    <div class="col-12">
                                      <p>Forgot your password? <a href="reset-password.php">Reset password </a> </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
        

<?php include 'includes/footer.php';?>