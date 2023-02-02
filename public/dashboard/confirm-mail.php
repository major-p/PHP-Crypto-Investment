<?php
session_start();
error_reporting(0);
include('../../config/config.php');
include('includes/checklogin.php');
include('includes/confirm-mail-settings.php');

check_login();
$title="Confirm Email";
include 'includes/header.php'; 
include 'includes/sidebar.php';

$uid=$_SESSION['id'];
$status=$_GET['stats'];//status code
if(isset($_GET['stats']) && $status == '0' )
{

$sql = "SELECT * FROM `users` WHERE id=$uid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

if($row['status'] !== '0'){
         $msg="Your account has already been verified";
         $type = "warning"; 
         
}elseif(!isset($row['code'])){ 
  $msg = 'Your account seems to have an unusual complication.Please contact support.'; 
  $type = "warning";
}else{
  $code = $row['code']; 
  $name = $row['username'];
  $email = $row['email'];


  $toEmail = $email;
  $subject = "$form_type";
  $mailHeaders = "MIME-Version: 1.0" . "\r\n";
  $mailHeaders .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";	
  $mailHeaders .= 'From: BitScopia <' . $noreply_email . '>' . "\r\n";

  $mailHeaders .= "Date: ". date('r'). " \r\n";
  $mailHeaders .= "Return-Path:' . $site_email . '\r\n";
  $mailHeaders .= "Errors-To:'. $site_email .'\r\n";
  $mailHeaders .= "Reply-to:' . $site_email . ' \r\n";
  $mailHeaders .= "Organization: ' . $site_title . ' \r\n";
  $mailHeaders .= "X-Sender:' . $site_email . ' \r\n";
  $mailHeaders .= "X-Priority: 3 \r\n";
  $mailHeaders .= "X-MSMail-Priority: Normal \r\n";
  $mailHeaders .= "X-Mailer: PHP/" . phpversion();

  $content = '
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office"
  >
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="format-detection" content="telephone=no" />
      <meta name="x-apple-disable-message-reformatting" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
      <style>
        /* Reset styles */
        body {
          margin: 0;
          padding: 0;
          min-width: 100%;
          width: 100% !important;
          height: 100% !important;
        }
        body,
        table,
        td,
        div,
        p,
        a {
          -webkit-font-smoothing: antialiased;
          text-size-adjust: 100%;
          -ms-text-size-adjust: 100%;
          -webkit-text-size-adjust: 100%;
          line-height: 100%;
        }
        table,
        td {
          mso-table-lspace: 0pt;
          mso-table-rspace: 0pt;
          border-collapse: collapse !important;
          border-spacing: 0;
        }
        img {
          border: 0;
          line-height: 100%;
          outline: none;
          text-decoration: none;
          -ms-interpolation-mode: bicubic;
        }
        #outlook a {
          padding: 0;
        }
        .ReadMsgBody {
          width: 100%;
        }
        .ExternalClass {
          width: 100%;
        }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%;
        }
  
        /* Rounded corners for advanced mail clients only */
        @media all and (min-width: 560px) {
          .container {
            border-radius: 8px;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            -khtml-border-radius: 8px;
          }
        }
  
        /* Set color for auto links (addresses, dates, etc.) */
        a,
        a:hover {
          color: #127db3;
        }
        .footer a,
        .footer a:hover {
          color: #999999;
        }
      </style>
  
      <!-- MESSAGE SUBJECT -->
      <title>Email Verification</title>
      <![endif]-->
      <!--[if gte mso 9]>
        <xml>
          <o:OfficeDocumentSettings>
            <o:AllowPNG />
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
      <![endif]-->
    </head>
  
    <!-- BODY -->
    <!-- Set message background color (twice) and text color (twice) -->
    <body
      topmargin="0"
      rightmargin="0"
      bottommargin="0"
      leftmargin="0"
      marginwidth="0"
      marginheight="0"
      width="100%"
      style="
        border-collapse: collapse;
        border-spacing: 0;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        -webkit-font-smoothing: antialiased;
        text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
        line-height: 100%;
        background-color: #f0f0f0;
        color: #000000;
      "
      bgcolor="#F0F0F0"
      text="#000000"
    >
      <!-- SECTION / BACKGROUND -->
      <!-- Set message background color one again -->
      <table
        width="100%"
        align="center"
        border="0"
        cellpadding="0"
        cellspacing="0"
        style="
          border-collapse: collapse;
          border-spacing: 0;
          margin: 0;
          padding: 0;
          width: 100%;
        "
        class="background"
      >
        <tr>
          <td
            align="center"
            valign="top"
            style="
              border-collapse: collapse;
              border-spacing: 0;
              margin: 0;
              padding: 0;
            "
            bgcolor="#F0F0F0"
          >
            <!-- WRAPPER -->
            <!-- Set wrapper width (twice) -->
            <table
              border="0"
              cellpadding="0"
              cellspacing="0"
              align="center"
              width="560"
              style="
                border-collapse: collapse;
                border-spacing: 0;
                padding: 0;
                width: inherit;
                max-width: 560px;
              "
              class="wrapper"
            >
              <tr>
                <td
                  align="center"
                  valign="top"
                  style="
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0;
                    padding: 0;
                    padding-left: 6.25%;
                    padding-right: 6.25%;
                    width: 87.5%;
                    padding-top: 20px;
                    padding-bottom: 20px;
                  "
                >
                  <!-- LOGO -->
                  <!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2. URL format: http://domain.com/?utm_source={{Campaign-Source}}&utm_medium=email&utm_content=logo&utm_campaign={{Campaign-Name}} -->
                  <a
                    target="_blank"
                    style="text-decoration: none"
                    href="http://www.bitscopia.com"
                    ><img
                      border="0"
                      vspace="0"
                      hspace="0"
                      src="http://www.bitscopia.com/emails/logo.svg"
                      width="100"
                      height="30"
                      alt="Logo"
                      title="BitScopia"
                      style="
                        color: #000000;
                        font-size: 10px;
                        margin: 0;
                        padding: 0;
                        outline: none;
                        text-decoration: none;
                        -ms-interpolation-mode: bicubic;
                        border: none;
                        display: block;
                      "
                  /></a>
                </td>
              </tr>
  
              <!-- End of WRAPPER -->
            </table>
  
            <!-- WRAPPER / CONTEINER -->
            <!-- Set conteiner background color -->
            <table
              border="0"
              cellpadding="0"
              cellspacing="0"
              align="center"
              bgcolor="#FFFFFF"
              width="560"
              style="
                border-collapse: collapse;
                border-spacing: 0;
                padding: 0;
                width: inherit;
                max-width: 560px;
              "
              class="container"
            >
              <!-- HEADER -->
              <!-- Set text color and font family ("sans-serif" or "Georgia, serif") -->
              <tr>
                <td
                  align="center"
                  valign="top"
                  style="
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0;
                    padding: 0;
                    padding-left: 6.25%;
                    padding-right: 6.25%;
                    width: 87.5%;
                    font-size: 24px;
                    font-weight: bold;
                    line-height: 130%;
                    padding-top: 25px;
                    color: #2124b1;
                    font-family: sans-serif;
                  "
                  class="header"
                >
                  Email Verification
                </td>
              </tr>
  
              <!-- HERO IMAGE -->
              <!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2 (wrapper x2). Do not set height for flexible images (including "auto"). URL format: http://domain.com/?utm_source={{Campaign-Source}}&utm_medium=email&utm_content={{Ìmage-Name}}&utm_campaign={{Campaign-Name}} -->
              <tr>
                <td
                  align="center"
                  valign="top"
                  style="
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0;
                    padding: 0;
                    padding-top: 20px;
                  "
                  class="hero"
                >
                  <a
                    target="_blank"
                    style="text-decoration: none"
                    href="http://www.bitscopia.com"
                  >
                    <img
                      border="0"
                      vspace="0"
                      hspace="0"
                      src="http://www.bitscopia.com/emails/lock.png"
                      alt="Please enable images to view this content"
                      title="Email Confirmation"
                      style="
                        width: 50%;
                        height: auto;
                        color: #000000;
                        font-size: 13px;
                        margin: 0;
                        padding: 0;
                        outline: none;
                        text-decoration: none;
                        -ms-interpolation-mode: bicubic;
                        border: none;
                        display: block;
                      "
                  /></a>
                </td>
              </tr>
  
              <!-- PARAGRAPH -->
              <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
              <tr>
                <td
                  align="left"
                  valign="top"
                  style="
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0;
                    padding: 0;
                    padding-left: 6.25%;
                    padding-right: 6.25%;
                    width: 87.5%;
                    font-size: 15px;
                    font-weight: 400;
                    line-height: 160%;
                    padding-top: 25px;
                    color: #000000;
                    font-family: sans-serif;
                  "
                  class="paragraph"
                >
                  <b>Hello</b> '.$name.', <br />
                  Thanks for getting started with BitScopia! We need a little more
                  information to complete your registration,including confirmation
                  of email address. <br />
                  Please use the 6-Digit code below on the BitScopia website to
                  verify your email
                </td>
              </tr>
              <!-- VERFICATION CODE -->
              <tr>
                <td
                  align="center"
                  valign="top"
                  style="
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0;
                    padding: 0;
                    padding-left: 6.25%;
                    padding-right: 6.25%;
                    width: 87.5%;
                    font-size: 30px;
                    font-weight: 600;
                    line-height: 160%;
                    padding-top: 5px;
                    color: #2124b1;
                    text-transform: uppercase;
                    font-family: sans-serif;
                  "
                  class="paragraph"
                >
                  '.$code.'
                </td>
              </tr>
              <tr>
                <td
                  align="left"
                  valign="top"
                  style="
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0;
                    padding: 0;
                    padding-left: 6.25%;
                    padding-right: 6.25%;
                    width: 87.5%;
                    font-size: 14px;
                    font-weight: 400;
                    line-height: 160%;
                    padding-top: 25px;
                    color: #000000;
                    font-family: sans-serif;
                  "
                  class="paragraph"
                >
                  Thanks<br />
                  BitScopia support
                </td>
              </tr>
              <!-- PARAGRAPH -->
              <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
              <tr>
                <td
                  align="center"
                  valign="top"
                  style="
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0;
                    padding: 0;
                    padding-left: 6.25%;
                    padding-right: 6.25%;
                    width: 87.5%;
                    font-size: 13px;
                    font-weight: 400;
                    line-height: 160%;
                    padding-top: 20px;
                    padding-bottom: 25px;
                    color: #000000;
                    font-family: sans-serif;
                  "
                  class="paragraph"
                >
                  If you did not create an account with BitScopia, please ignore
                  this message
                </td>
              </tr>
  
              <!-- End of WRAPPER -->
            </table>
  
            <!-- WRAPPER -->
            <!-- Set wrapper width (twice) -->
            <table
              border="0"
              cellpadding="0"
              cellspacing="0"
              align="center"
              width="560"
              style="
                border-collapse: collapse;
                border-spacing: 0;
                padding: 0;
                width: inherit;
                max-width: 560px;
              "
              class="wrapper"
            >
              <!-- FOOTER -->
              <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
              <tr>
                <td
                  align="center"
                  valign="top"
                  style="
                    border-collapse: collapse;
                    border-spacing: 0;
                    margin: 0;
                    padding: 0;
                    padding-left: 6.25%;
                    padding-right: 6.25%;
                    width: 87.5%;
                    font-size: 13px;
                    font-weight: 400;
                    line-height: 150%;
                    padding-top: 20px;
                    padding-bottom: 20px;
                    color: #999999;
                    font-family: sans-serif;
                  "
                  class="footer"
                >
                  This email verfication was sent to&nbsp;you because
                  you&nbsp;created an&nbsp;account&nbsp;with BitScopia&nbsp;
                  <!-- ANALYTICS -->
                </td>
              </tr>
  
              <!-- End of WRAPPER -->
            </table>
  
            <!-- End of SECTION / BACKGROUND -->
          </td>
        </tr>
      </table>
    </body>
  </html>    
  ';

  if(mail($toEmail, $subject, $content, $mailHeaders)) {
    $msg="We have sent a 6-Digit verification code to your mail. Redirecting you ...";
    $type = "success"; 
  ?>
 <script>
   setTimeout(function () {
   window.location ='email-verification-code.php?stats=<?php echo $code+433456644 ?>';
   }, 3000);
   </script>;
  <?php
   }else{
    $msg="An Error Occured! Couldn't send mail. Please try again later";
    $type = "warning"; 
    $code = $row['code']; 
   }

 }

}else{
    echo '<script>window.location ="dashboard.php";</script>';
}
?>
<!-- partial -->
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Email Verification </h3>
            
            </div>
            <div class="row">
              
            <div class="col-12  stretch-card">
                <div class="card">
                  <div class="card-body custom-column">
                    <h4 class="card-title"> </h4>
                    <p class="card-description">We are sending a 6-Digit verification code to your mail: "<?php echo $row['email'];?>" </p>
                    <div class="custom-row">
                    <div class="col-12 ">
                        <br>
                    <?php if(isset($msg)) { ?>
                <div class="error-wrapper-<?php echo $type?>">
                <span class="message-<?php echo $type?>"><?php echo $msg; ?></span>
                </div>
                <?php }?>

              
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>