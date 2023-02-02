<?php
session_start();
error_reporting(0);
include('../../config/config.php');
include('includes/checklogin.php');
check_login();
$title="Dashboard";
$uid=$_SESSION['id'];
$uip=$_SERVER['REMOTE_ADDR'];
include 'includes/header.php'; 
include 'includes/sidebar.php';

$uid= $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
?>


<div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
              <?php 
                if($row['status'] == 0){?> 
                <div class="card  bg-primary" >
                  <div class="card-body py-0 px-0 px-sm-3" >
                    <div class="row align-items-center" >
                      <div class="col-4 col-sm-3 col-xl-2" >
                        <img src="assets/images/email-error.png" class="gradient-corona-img img-fluid" style="width:80px;padding:10px;" alt="">
                      </div>
                      <div class="col-5 col-sm-7 col-xl-8 p-0">
                        <h4 class="mb-1 mb-sm-0">Mail not confirmed!</h4>
                        <p class="mb-0 font-weight-normal d-none d-sm-block">
                        Your mail not confirmed, please confirm your email <?php echo $row['email'] ?>
                        </p>
                      </div>
                      <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                        <span>
                          <a href="confirm-mail.php?stats=<?php echo $row['status'] ?>" class="btn btn-outline-light btn-rounded get-started-btn">Confirm Mail</a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?> 
              </div>
            </div>
          
            <div class="row">
              <div class="col-md-6 grid-margin ">
                <div class="card">  
                  <div class="card-body">        
                    <?php
                    $uid= $_SESSION['id'];
                    $sql4 = "SELECT * FROM `userslog` WHERE `uid`='$uid' ORDER BY id DESC LIMIT 1";
                    $res4 = mysqli_query($con, $sql4);
                    if(mysqli_num_rows($res4)>0){
                    while ($d=mysqli_fetch_array($res4)) {
                        ?> 
                    <div class="row user-login-info-wrapper">  
                    <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Last Login</h6>
                    <p class="text-muted mb-0"><?php echo $d['loginTime'] ?></p>
                    </div>
                    <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Total Log:</h6>
                    <p class="text-muted mb-0">
                    <?php 
                        $query="SELECT * FROM `userslog` WHERE uid='$uid'";
                        $result=mysqli_query($con,$query);
                        $num_rows = mysqli_num_rows($result);
                        {
                            echo htmlentities($num_rows); 
                        } 
                        if($num_rows >1){
                            echo ' Times';
                         }else{
                         echo ' Time';
                          }
                        ?> 
                        </p>
                    </div>
                    <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Last IP</h6>
                    <p class="text-muted mb-0"><?php echo $d['userip'] ?></p>
                    </div>
                        </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Capital Invested:</h6>
                    <p class="text-muted mb-0">
                    <?php 
                      $query="SELECT * FROM `investment` WHERE `user_id`='$uid' ";
                      $result=mysqli_query($con,$query);
					  
					            $sum = 0;
                      while($row=mysqli_fetch_array($result)){ 
                      $amount = $row['amount'];
                      $sum += (int)$amount;          
						          }  
		                  ?>
			                $<?php echo $sum?>
                    </p>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                    </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Current Balance</h6>
                    <p class="text-muted mb-0">
                    <?php 
                      $query="SELECT * FROM `users` WHERE `id`='$uid' ";
                      $result=mysqli_query($con,$query);
                      while($row=mysqli_fetch_array($result)){ 
                      $balance = $row['balance'];
						          }  
		                  ?>
			                $<?php echo $balance?>
                    </p>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                    </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                    <h6 class="mb-1">Interest Accumulated</h6>
                    <p class="text-muted mb-0">
                    <?php 
                      $query="SELECT * FROM `earnings` WHERE `uid`='$uid' ";
                      $result=mysqli_query($con,$query);
					  
					            $sum = 0;
                      while($row=mysqli_fetch_array($result)){ 
                      $amount = $row['amount'];
                      $sum += (int)$amount;          
						          }  
		                  ?>
			                $<?php echo $sum?>
                    </p>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                    </div>
                    </div>
                    </div>
                    <?php  }}?>


                    <div class="" style="width:100%;">
                    <div class="card">     
                   <div class="card-body">
                    <h4 class="card-title">Transactions History</h4>
                    </p>
                    <div class="table-responsive">
                        <?php 
                         $query="SELECT * FROM `transactions` WHERE `user_id`='$uid' ";
                         $result=mysqli_query($con,$query);
                         $cnt=1;
                         if(mysqli_num_rows($result)>0){
                            ?>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>SN</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                    while($trx=mysqli_fetch_array($result)){
                      ?>
                          <tr>
                           <td><?php echo $cnt++; ?></td>
                            <td><?php echo $trx['date']; ?></td>
                            <td><?php echo $trx['type']; ?></td>
                            <td class="uppercase-text"><?php echo $trx['amount']; ?> <?php echo $trx['coin']; ?></td>
                            <td>
                            <?php if($trx['status'] == 'Pending'){   
                            ?>
                             <label class="badge badge-danger"><?php echo $trx['status']; ?></label>
                             <?php }else{
                                ?>
                            <label class="badge badge-success"><?php echo $trx['status']; ?></label>
                              
                             <?php }?>
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

<?php 

$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);?>

              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                 
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title mb-1">Available Balance</h4>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="preview-list">
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/btc.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Bitcoin</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['btc'] ?> BTC</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/eth.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Etherium</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['eth'] ?> ETH</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/bch.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Bitcoin Cash</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['bch'] ?> BCH</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/btg.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Bitcoin Gold</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['btg'] ?> BTG</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/usdt.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Tether ERC-20</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['tether-erc'] ?> USDT</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/usdt.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Tether TRC-20</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['tether-trc'] ?> USDT</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/usdt.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Tether BEP-20</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['tether-bep20'] ?> USDT</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/etc.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Ethereum Classic</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['etc'] ?> ETC</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/ltc.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Litecoin</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['ltc'] ?> LTC</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/bnb.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Binance Coin BEP-2</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['bnb-bep2'] ?> BNB</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/bnb.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Binance Coin BEP-20</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['bnb-bep20'] ?> BNB</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/xrp.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Ripple</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['xrp'] ?> XRP</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/ada.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Cardano</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['ada'] ?> ADA</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/doge.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Dogecoin</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['doge'] ?> DOGE</p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item  border-bottom row-wrapper" >
                            <div class="preview-thumbnail">
                               <img src="assets/images/coins/trx.svg">
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow" >
                              <div class="flex-grow">
                                <h6 class="preview-subject coin-name">Tron</h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-10 pt-sm-0">
                                <p class="text-muted coin-value"><?php echo $row['trx'] ?> TRX</p>
                              </div>
                            </div>
                          </div>

                          <div class="preview-item  row-wrapper-buttons" >
                          <a class="nav-link btn btn-primary create-new-button"  href="deposit.php">Deposit</a>
                          <a class="nav-link btn btn-danger create-new-button"  href="withdrawal.php">Withdraw</a>
                          </div>

                        

                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>

            </div>
           


<?php include 'includes/footer.php' ?>
