<?php
session_start();
error_reporting(0);
include('../../config/config.php');
include('includes/checklogin.php');
check_login();
$title="Investment Form";
include 'includes/header.php'; 
include 'includes/sidebar.php';

$uid=($_GET['uid']);

$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

?>

<!-- partial -->
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Add Investment - <?php echo $row['name'] ?> </h3>
            
            </div>
            <div class="row">
              
            <div class="col-12  stretch-card">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">
                    <?php 
                    $query = "SELECT * FROM `investment` WHERE `user_id`=$uid";
                    $result = mysqli_query($con, $query);
		    		$sum = 0;
                    while($r=mysqli_fetch_array($result))
                    { 
					   $amount = $r['amount'];
					   $sum += (int)$amount;
                    }  
		            ?>
                    Current Investment: $<?php echo $sum?>
                    </h4>
                    <p class="card-description">To replenish the balance, please select a currency and enter the amount. </p>
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
                      <button type="submit" name="submit" class="btn btn-primary  create-new-button">Add Investment</button>
                    </form>
                    </div>
                    </div>

                  </div>
                </div>
              </div>
             
            
              
        </div>
        </div>

<?php include 'includes/footer.php' ?>
