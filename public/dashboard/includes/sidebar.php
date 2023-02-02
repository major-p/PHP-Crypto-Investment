<?php
$uid= $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
?>
<ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="../admin/uploads/<?php echo $row['image'] ?>" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal"><?php echo $row['username'] ?></h5>
                  <span><?php echo $row['email'] ?></span>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="settings.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                  </div>
                </a>
               
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Welcome back</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="dashboard.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer text-primary"></i>
              </span>
              <span class="menu-title">Overview</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="deposit.php">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play text-primary"></i>
              </span>
              <span class="menu-title">Deposit</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="withdrawal.php">
              <span class="menu-icon">
                <i class="mdi mdi-table-large text-primary"></i>
              </span>
              <span class="menu-title">Withdraw</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="investment-plans.php">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar"></i>
              </span>
              <span class="menu-title">Investment</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="interests.php">
              <span class="menu-icon">
                <i class="mdi mdi-contacts text-primary"></i>
              </span>
              <span class="menu-title">Interests</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="affiliates.php">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box text-primary"></i>
              </span>
              <span class="menu-title">Affiliates</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="settings.php">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box text-primary"></i>
              </span>
              <span class="menu-title">Settings</span>
            </a>
          </li>
        </ul>
      </nav>
          <!-- partial -->
        <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="assets/images/logo.png" alt="logo" style="width:30px;" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>

            <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link btn btn-primary create-new-button"  href="interests.php">Interests</a>
              </li>
              <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link btn btn-primary create-new-button"  href="investment-plans.php">Investment</a>
              </li> 
              <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link btn btn-primary create-new-button"  href="deposit.php">Deposit</a>
              </li>
              <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                  <i class="mdi mdi-view-grid"></i>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="../admin/uploads/<?php echo $row['image'] ?>" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $row['username'] ?></p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="settings.php">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle ">
                        <i class="mdi mdi-settings text-primary"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="logout.php">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Log out</p>
                    </div>
                  </a>
                 
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->