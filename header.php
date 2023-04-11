<?php 

include('auth.php');
//include('config.php'); 
//include('auth.php');
                        
    date_default_timezone_set("Asia/Kuala_Lumpur");
    //echo date('d-m-Y H:i:s'); //Returns IST

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

<?php
$sql = "SELECT * FROM center_detail WHERE id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
$myrow = mysqli_fetch_assoc($res);
?>
    <title><?php echo $myrow['center_name'];?> | </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">
       
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">   
    <style type="text/css">
        .checkbox {
            margin-right: 5px;
        }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a class="site_title" href="dashboard.php"><i class="fa fa-paw"></i> <span><?php echo $myrow['center_name'];?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
           <!-- <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>-->
            <!-- /menu profile quick info -->

            <br />
    
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                 <ul class="nav side-menu">
              <!--    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                      <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li>
                    </ul>
                  </li> -->
                <!--<li><a href="#"><i class="fa fa-table"></i>Search List </a></li>-->
<?php 
if ($_SESSION['center_id'] == "5") {?>
                <li><a href="account88.php"><i class="fa fa-plus"></i>Account Card</a></li>
<?php } elseif ($_SESSION['center_id'] == "9") {?>
                <li><a href="add_customer.php"><i class="fa fa-plus"></i>Register New Customer</a></li>
                <li><a href="customer_list.php"><i class="fa fa-plus"></i>Customer List</a></li>
                <li><a href="inquiry_list.php"><i class="fa fa-plus"></i>Inquiry List</a></li>
                <!-- <li><a href="loan_list.php"><i class="fa fa-plus"></i>Loan List</a></li> -->
<?php } else {
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Customer Card' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
                <li><a href="register_new_customer.php"><i class="fa fa-plus"></i>Register New Customer</a></li>
                <li><a href="customer_card.php"><i class="fa fa-plus"></i>Customer Card</a></li>
<?php  }
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Customer' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {
    if ($_SESSION['center_id'] == "6") {?>
                <li><a href="ax_register_new_customer.php"><i class="fa fa-plus"></i>Register New Customer</a></li>
<?php    } else {?>
                <li><a href="register_new_customer.php"><i class="fa fa-plus"></i>Register New Customer</a></li>
<?php    }?>
                <li><a href="customer.php"><i class="fa fa-plus"></i>Customer Card</a></li>
  <?php }

  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Order List' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {
    if ($_SESSION['group_name'] == "admin") {?>
                <li><a href="new_c&quotation.php" onclick="return confirmNew()"><i class="fa fa-plus"></i>New Quotation</a></li>
                <li><a href="order_list.php"><i class="fa fa-plus"></i>Pending Order</a></li>
                <li><a href="appointment_list.php"><i class="fa fa-plus"></i>Job Appointment</a></li>
                <li><a href="complete_order_list.php"><i class="fa fa-plus"></i>Completed Order</a></li>
    
  <?php }}

  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Collection' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
                <li><a href="collection.php"><i class="fa fa-plus"></i>Collection</a></li>
<?php  }
}?>

<?php
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Monthly Report' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
                <li><a href="monthly_report.php"><i class="fa fa-plus"></i>Monthly report</a></li>
<?php  }?>

<?php
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Monthly Report' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
                <li><a href="collection.php"><i class="fa fa-plus"></i>Loan report</a></li>
<?php  }?>

<?php
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Daily Report' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
                <li><a href="daily_report.php"><i class="fa fa-plus"></i>Daily Report</a></li>
<?php  }?>

<?php
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Uncollected Report' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
                <li><a href="uncollected_report.php"><i class="fa fa-plus"></i>Uncollected Report</a></li>
<?php  }?>


<?php
  $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Customer Status Check' ORDER BY date_time DESC LIMIT 1;";
  $res = mysqli_query($conn, $sql);
  $myrow = mysqli_fetch_assoc($res);
  if ($myrow['status'] == 1) {?>
                <li><a href="customer_status_check.php"><i class="fa fa-plus"></i>Customer Status Inquiry</a></li>
<?php  }?>
<?php 
    
    if($_SESSION["group_name"] =='superadmin'){     
      ?>
                <li id="hwe_center_maintainace"><a href="center_maintenance.php"><i class="fa fa-plus"></i>Center Management</a></li>
                <li id="id_user_maintainance"><a href="user_maintenance.php"><i class="fa fa-plus"></i>User Management</a></li>
                  <?php 
      }
       ?>
                  <?php 
    
    if($_SESSION["group_name"] =='admin'){
      $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'User Maintenance' ORDER BY date_time DESC LIMIT 1;";
      $res = mysqli_query($conn, $sql);
      $myrow = mysqli_fetch_assoc($res);
      if ($myrow['status'] == 1) {?>
                <li id="id_user_maintainance"><a href="user_maintenance.php"><i class="fa fa-plus"></i>User Management</a></li>
       <?php }
      $sql = "SELECT * FROM function_authorized WHERE center_id = '".$_SESSION['center_id']."' AND function = 'Product List' ORDER BY date_time DESC LIMIT 1;";
      $res = mysqli_query($conn, $sql);
      $myrow = mysqli_fetch_assoc($res);
      if ($myrow['status'] == 1) {?>
                <li><a href="product_list.php"><i class="fa fa-plus"></i>Product Management</a></li>
                <li><a href="track_list.php"><i class="fa fa-plus"></i>Track Management</a></li>
                <li><a href="design_list.php"><i class="fa fa-plus"></i>Design Management</a></li>
       <?php }
      }
       ?>
                <li><a href="change_password.php?id=<?php echo $_SESSION["agent_id"];?>"><i class="fa fa-plus"></i>Change Password</a></li>
                <li><a href="logout.php"><i class="fa fa-plus"></i>Logout</a></li>
                
                  
                  
                   </div>     
    
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <!--<img src="images/img.jpg" alt="">John Doe-->
                    
                     <?php 
      if(isset($_SESSION["group_name"]) && $_SESSION["group_name"]=='superadmin')
      {
        echo 'Admin';
      }
      elseif(isset($_SESSION["agent_id"]) && $_SESSION["agent_id"]!='')
      {
        $result= mysqli_query($conn,"SELECT * FROM users WHERE id = ".$_SESSION["agent_id"]);
        if(mysqli_num_rows($result))
        {
          $row = mysqli_fetch_assoc($result);
          
          echo ucfirst($row['user_name']);
        }
      }
      
      
      ?>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                   <!-- <a class="dropdown-item"  href="javascript:;"> Profile</a>
                      <a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                  <a class="dropdown-item"  href="javascript:;">Help</a>-->
                    <a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i>Logout</a>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                <!--  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>-->
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

    
    
        <!-- page content -->
        <div class="right_col" role="main">
        
        <!-- /page content -->

        <!-- footer content -->
       
        <!-- /footer content -->
  
  
    <!-- jQuery -->
  

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
 

    <!-- Custom Theme Scripts -->
    <script src="js/custom.min.js"></script>
    <script>
      function confirmNew() {
        var x = confirm("Is this new customer?");
        if (x == true) {
          return true;
        } else {
          window.location = 'old_c&quotation.php';
          return false;
        }
      }
    </script>
 
   
  </body>
</html>
<style>
body
{
  font-family: 'Open Sans', sans-serif;
  font-size: 15px;
  line-height: 1.5;
}
</style>
