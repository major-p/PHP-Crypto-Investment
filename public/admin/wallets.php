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


if(isset($_GET['del']))
		  {
		          mysqli_query($con,"DELETE FROM  `coins` WHERE id = '".$_GET['id']."'");
                  echo "<script>window.location.href='wallets.php';</script>";

		  }

if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $symbol=$_POST['symbol'];
    $address=$_POST['address'];

    $sql1="INSERT INTO `coins` (`name`,`symbol`,`address`)
                        VALUES ('$name','$symbol','$address')";
    $result1=mysqli_query($con,$sql1);
    if($result1){ 
    $msg="Address Added Successfully";
    $type = "success";
    }else{
    $msg="Something went wrong,please try again";
    $type = "warning";
    }  
}
?> 



<!-- partial -->
 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Wallets </h3>
            
            </div>
            <div class="row">  
            <div class="col-12  stretch-card">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">Add A New Wallet</h4>
                    <p class="card-description"></p>
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
                        <label>Name</label>
                        <input type="text" name="name"  class="form-control" placeholder="Bitcoin,USDT,Tron" required>
                      </div>
                      <div class="form-group">
                        <label>Symbol <span style="font-size:13px;color:red;">
                        *Please enter the symbol in lower-case letters e.g btc,eth,trx</span></label>
                        <input type="text" name="symbol"  class="form-control" placeholder="btc,eth,usdt,ltc" required>
                      </div>
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address"  class="form-control" placeholder="Wallet address" required>
                      </div>
                      <button type="submit" class="btn btn-primary" name="submit">Save</button>
                     
                    </div>
                    </form>
                    </div>

                  </div>
                </div>
              </div>
     
              <div class="col-12 stretch-card" style="margin-top:20px">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title">Your Wallet Addresses</h4>
                    <div class="table-responsive">
                        <?php 
                         $query="SELECT * FROM `coins`  ";
                         $result=mysqli_query($con,$query);
                         $cnt=1;
                         if(mysqli_num_rows($result)>0){
                            ?>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Symbol</th>
                            <th>Address</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                    while($trx=mysqli_fetch_array($result)){
                      ?>
                          <tr>
                           <td><?php echo $cnt++; ?></td>
                            <td><?php echo $trx['name']; ?></td>
                            <td><?php echo $trx['symbol']; ?></td>
                            <td class="uppercase-text"><?php echo $trx['address']; ?></td>
                            <td>
                            <a href="?id=<?php echo $trx['id'];?>&del=delete" 
                        onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">
                        Delete Address</a>
                           </td>
                          </tr>
                          <?php } 
                    }else{
                      echo"
                      <div class='card-body'>
                     <p style='text-align:left'> No Transaction yet!</p>
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

  

<?php include 'includes/footer.php' ?>
