<?php
session_start();
error_reporting(0);
include('../../config/config.php');
include('includes/checklogin.php');
check_login();
$title="Add Investment";
include 'includes/header.php'; 
include 'includes/sidebar.php';
?>

 <!-- partial -->
 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Add Capital to User </h3>
            </div>
            <div class="card">
            <div class="card-body">
            <div class="table-responsive">
                        <?php 
                         $query="SELECT * FROM `users` ";
                         $result=mysqli_query($con,$query);
                         $cnt=1;
                         if(mysqli_num_rows($result)>0){
                            ?>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>SN</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                    while($row=mysqli_fetch_array($result)){
                      ?>
                          <tr>
                           <td><?php echo $cnt++; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['country']; ?></td>
                            <td>
                           <a class="badge badge-success" href="investment-form.php?uid=<?php echo $row['id']; ?>">
                            Add Capital
                           </a>
                            </td>

                          
                          </tr>
                          <?php } 
                    }else{
                      echo"
                      <div class='card-body'>
                     <p style='text-align:left'> No User yet!</p>
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

<?php include 'includes/footer.php' ?>
