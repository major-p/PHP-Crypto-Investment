<?php
session_start();
error_reporting(0);
include('../../config/config.php');
include('includes/checklogin.php');
check_login();
$title="Dashboard";
$uid=$_SESSION['id'];
$uname=$_SESSION['username'];
$uip=$_SERVER['REMOTE_ADDR'];
include 'includes/header.php'; 
include 'includes/sidebar.php';
$currentTime = date( 'd-m-Y h:i:s A', time () );

?>

 <!-- partial -->
 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Investment Plans </h3>
            
            </div>
            <div class="row">  
           

            <?php 
                        $coinquery="SELECT * FROM `investment_plans` ";
                        $result=mysqli_query($con,$coinquery);
                        while($data=mysqli_fetch_array($result))
                        {?>
                    
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><?php echo $data['name'];?></h4>
                    <p class="card-description"><?php echo $data['profit'];?>%<code><?php echo $data['description'];?></code></p>
                    <div class="template-demo">
                    <p>Min Deposit: <span>$<?php echo $data['min'];?></span> </p>
                    <p>Max Deposit: <span>$<?php echo $data['max'];?></span> </p>
                    <p>Referral Bonus: <span><?php echo $data['referral_bonus'];?>%</span> </p>
                    <p>Support: <span><?php echo $data['support'];?></span> </p>
                      <a class="btn btn-primary btn-lg btn-block" 
                       href="invest.php?plan=<?php echo $data['id']+433456644;?>">Invest</a>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
        
              
        </div>
        </div>

       
<?php include 'includes/footer.php' ?>
