<?php
session_start();
error_reporting(0);
include('../../config/config.php');
include('includes/checklogin.php');
check_login();
$title="Add Earning";
include 'includes/header.php'; 
include 'includes/sidebar.php';
$currentTime = date( 'd-m-Y h:i:s A', time () );
$uid=($_GET['uid']);
$iamount=($_GET['stats']);
$iplan=($_GET['plan']);

$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);


if(isset($_POST['submit']))
{
    $amount=$_POST['amount'];

    $sql1="INSERT INTO `earnings` (`uid`,`amount`,`status`)
                          VALUES  ('$uid','$iamount','0')";
    $result1=mysqli_query($con,$sql1);
    if($result1){ 
    $msg="Earning Added Successfully";
    $type = "success";
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
              <h3 class="page-title">Add Earnings to User</h3>
            </div>
            <div class="card">  
                <br>
                  <div class="card-body">
                    <div class="row" style="justify-content:space-around;">   
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Investor</h6>
                    <p class="text-muted mb-0">
                    <?php echo $row['name'] ?>
                    </p>
                    </div>
                </div>
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Investment Plan</h6>
                    <p class="text-muted mb-0">
                     <?php echo $iplan?>
                    </p>
                    </div>
                </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                     <div class="text-md-center text-xl-left">
                      <h6 class="mb-1">Invesment Amount</h6>
                      <p class="text-muted mb-0">
                      <?php echo $iamount?>
                      </p >
                      </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                     <div class="text-md-center text-xl-left">
                      <h6 class="mb-1">Total Earnings</h6>
                      <p class="text-muted mb-0">
                      <?php  
					  $query = "SELECT * FROM `earnings` WHERE `uid`=$uid";
                      $result = mysqli_query($con, $query);
					  $sum = 0;
                      while($row2=mysqli_fetch_array($result))
                      { 
						$amount = $row2['amount'];
						$sum += (int)$amount;
					  }  
		      ?>
                    $<?php echo $sum?>
                      </p >
                      </div>
                    </div>
                </div>
</div>


            <div class="row">
            <div class="col-12  stretch-card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">Add Earning</h4>
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
                        <label>Enter amount(USD)</label>
                        <input type="text" name="amount" class="form-control form-control-white"  
                        placeholder="0" required>
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