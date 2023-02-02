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
$uid= $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

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
    $coin=$_POST['coin'];
    $amount=$_POST['amount'];
    $address=$_POST['address'];

    $oldbal=$row[$coin];
    $newbal=($oldbal-$amount);

    if($amount > $oldbal){ 
        $msg="Sorry your balance is lower than the entered withdrawal amount.";
        $type = "warning";
    }else{
    $sql1="INSERT INTO `transactions` (`user_id`,`coin`,`type`,`amount`,`address`,`code`)
    VALUES  ('$uid','$coin','Withdrawal','$amount','$address','$code')";
    $result1=mysqli_query($con,$sql1);
    if($result1){  
    $updateQuery="UPDATE `users` SET `$coin`='$newbal' WHERE `id`='$uid'";   
    $result2=mysqli_query($con,$updateQuery);  
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

}

			?>

 <!-- partial -->
 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Affiliate Program </h3>
            
            </div>
            <div class="row">  
            <div class="col-12  stretch-card">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">Affiliate Link</h4>
                    <div class="custom-row">
                    <div class="col-12 row ">
                    <br>
                    <?php if(isset($msg)) { ?>
                <div class="error-wrapper-<?php echo $type?>">
                <span class="message-<?php echo $type?>"><?php echo $msg; ?></span>
                </div>
                <?php }?>
                <div class="">
                <p> Copy and paste this link to send to friends or use in your articles. When users sign up using this link, 
                    your account will be credited with referral bonuses in the form of bitcoin.
                </p>
                </div>
                <div class="">
                <?php 
                            $query2="select * from users WHERE id='$uid' ";
                            $query_run=mysqli_query($con,$query2);
                            $data = mysqli_fetch_array($query_run);
                            $rid=$data['username'];
                ?>

                <div class=" form-group" > 
                <input type="text"  class="form-control"
                value="http://bitscopia.com/dashboard/signup.php?ref=<?php echo $rid; ?>" id="myInput">
                </div>
                <button class="btn btn-primary" onclick="myFunction()">Copy Link</button>
                </div>
                    </div>
                    </div>

                  </div>
                </div>
              </div>
     
              <div class="col-12 stretch-card" style="margin-top:20px">
              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Affiliate Status</h4>
                    <p class="card-description"> Your refferals
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> S/N </th>
                            <th> Username </th>
                            <th> Status </th>
                          </tr>
                        </thead>
                        <?php 
                  $query="SELECT * FROM `users` WHERE `ref`='$uname' ";
                  $result=mysqli_query($con,$query);
                  $cnt=1;
                  if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                      ?>
                        <tbody>
                          <tr>
                            <td> <?php echo $cnt;?> </td>
                            <td> <?php echo $row['username'];?> </td>
                            <td><?php 
                                if($row['status'] == 1){?> 
                <label class="badge badge-success">Verified</label>
                                  <?php 
                                   }else{
                                   ?>   
                <label class="badge badge-danger">Unverified</label>
                             <?php } ?>
                            </td>
                          </tr>
                          <?php } 
                    }else{

                      echo"
                      <div class='card-body'>
                      <p style='text-align:left'> No Referral yet!</p>
                       </div>
                      ";
                    }
                    ?>
                        </tbody>
                      </table>
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
  alert("Link copied to bash clipboard");
} 
</script>
<?php include 'includes/footer.php' ?>
