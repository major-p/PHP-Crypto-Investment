<?php
session_start();
include('../config/config.php');
$currentTime = date( 'd-m-Y h:i:s A', time () );


$sql = "SELECT * FROM `investment` 
LEFT JOIN `investment_plans` ON investment_plans.name=investment.plan ";
$res = mysqli_query($con, $sql);
while($row=mysqli_fetch_array($res)){
    
$userid=$row['user_id'];
$pname=$row['plan'];
$hour=$row['hourly'];
$weekly=$hour*7;

?>



Major p should earn <?php echo "$userid"; ?> <br> <?php echo $hour?> and <?php echo $weekly?> weekly

<?php

$Query = "INSERT INTO `earnings` (`uid`, `amount`)
values  ('$userid','$weekly')";
$result=mysqli_query($con,$Query);

} 
?> 