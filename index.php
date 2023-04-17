<?php
require_once('config.php');

$error_msg = '';
$is_master_admin = "true";   // don't why cannot use bool (eg. true, false)

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    /* echo '$username = ' . $username;
    echo '$password = ' . $password; */

    // master superadmin START
    // chk if password is matched in database record
    $get_admin_data = mysqli_query($conn, "SELECT * FROM administration where username = '$username' AND password = '$password'");

    if (mysqli_num_rows($get_admin_data) > 0) {
        $rowadmin = mysqli_fetch_assoc($get_admin_data);

        // set SESSION
        // $_SESSION["group_name"] = 'superadmin';
        // TODO: double logic from 'users' or 'superadmin' table
        $_SESSION["user_id"] = $rowadmin['id'];
        $_SESSION["upline"] = $rowadmin['id'];

        // TODO: get last login
        // $sql_hwe = "select * from " . $table_prefix . "recently_login order by date desc LIMIT 0,1";

        // $results_hwe = mysqli_query($conn, $sql_hwe);

        // if (mysqli_num_rows($results_hwe) > 0) {
        // 	$row_login = mysqli_fetch_assoc($results_hwe);
        // 	$_SESSION['last_login'] = $row_login['user_id'];
        // }
?>
        <script>
            window.location.replace("<?= SITEURL ?>/home.php");
        </script>
        <?php
    } else {
        $is_master_admin = "false";
        // $error_msg = 'These credentials do not match our records.';   // OPT 'Wrong password. Try Again.', 'Login Credential Incorrect.';
    }
    // master superadmin END

    /* echo "<script>alert('error_msg = $error_msg')</script>";   // D
    echo "<script>alert('is_master_admin = $is_master_admin')</script>"; */

    if ($is_master_admin == "false") {
        // echo "<script>alert('is_master_admin = $is_master_admin')</script>";   // D

        // master superadmin START
        // chk if password is matched in database record
        $get_admin_data = mysqli_query($conn, "SELECT * FROM users where username = '$username' AND password = '$password' AND status = 'Active'");

        if (mysqli_num_rows($get_admin_data) > 0) {
            $rowadmin = mysqli_fetch_assoc($get_admin_data);

            // set SESSION
            // $_SESSION["group_name"] = 'superadmin';
            // TODO: double logic from 'users' or 'superadmin' table
            $_SESSION["user_id"] = $rowadmin['id'];
            $_SESSION["upline"] = $rowadmin['id'];

            // TODO: get last login
            // $sql_hwe = "select * from " . $table_prefix . "recently_login order by date desc LIMIT 0,1";

            // $results_hwe = mysqli_query($conn, $sql_hwe);

            // if (mysqli_num_rows($results_hwe) > 0) {
            // 	$row_login = mysqli_fetch_assoc($results_hwe);
            // 	$_SESSION['last_login'] = $row_login['user_id'];
            // }
        ?>
            <script>
                window.location.replace("<?= SITEURL ?>/home.php");
            </script>
<?php
        } else {
            // $is_master_admin = "false";
            $error_msg = 'These credentials do not match our records or this user is inactived.';   // OPT 'Wrong password. Try Again.', 'Login Credential Incorrect.';
        }
        // master superadmin END
    }
}
?>

<!doctype html>
<html lang="en" dir="ltr">

<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="Reallist- Bootstrap Responsive Real estate Classifieds, Dealer, Rentel, Builder and Agent Multipurpose HTML Template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="html template, real estate websites, real estate html template, property websites, premium html templates, real estate company website, bootstrap real estate template, real estate marketplace html template, listing website template, property listing html template, real estate bootstrap template, real estate html5 template, real estate listing template, property template, property dealer website" />

    <!-- Favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <!-- Title -->
    <title>(RM) Card Management System</title>
    <link rel="stylesheet" href="../assets/fonts/fonts/font-awesome.min.css">

    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css">

    <!-- Dashboard Css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin-custom.css">


    <link rel="stylesheet" href="../assets/plugins/charts-c3/c3-chart.css">

    <!-- Sidemenu Css -->
    <link rel="stylesheet" href="../assets/css/sidemenu.css">

    <!---Font icons-->
    <link rel="stylesheet" href="../assets/css/icons.css">
    <link rel="stylesheet" href="../assets/switcher/css/switcher-admin.css">



</head>

<body class="construction-image h-100">

    <!--Loader-->
    <div id="global-loader">
        <img src="../assets/images/loader.svg" class="loader-img" alt="">
    </div>

    <!--Page-->
    <div class="page h-100 ">
        <div class="page-content z-index-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-12 col-md-12 d-block mx-auto">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h3 class="card-title">Card Management System (RM)</h3>
                            </div>
                            <div class="card-body">

                                <!--Error message-->
                                <?php if ($error_msg != '') { ?>
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <div><?= $error_msg ?></div>
                                    </div>
                                <?php } ?>

                                <form method="POST" action="../login">
                                    <input type="hidden" name="_token" value="r9f3AQV6W4HNN5KkT5O7CZwsTnEAsSzIhdFgXXcg">
                                    <div class="form-group">
                                        <label class="form-label text-dark">Username</label>
                                        <input id="username" type="text" class="form-control " name="username" value="" placeholder="Enter username" required autocomplete="username" autofocus>

                                        <!--  -->
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-dark">Password</label>
                                        <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password">

                                        <!--  -->
                                    </div>
                                    <div class="form-group">
                                        <!-- <label class="custom-control custom-checkbox">
											<a href="forgot-password.html" class="float-right small text-dark mt-1">I forgot password</a>
											<input type="checkbox" class="custom-control-input">
											<span class="custom-control-label text-dark">Remember me</span>
										</label> -->
                                    </div>
                                    <div class="form-footer mt-2">
                                        <input type="submit" class="form-control" placeholder="login" name="login" style="border-radius:10rem;width:260px;background-color:#4e73df;text-align:center;color: #fff !important;" value="Login"><br>
                                        <!-- <button type="submit" class="btn btn-primary btn-block" name="login">
                      Login
                    </button> -->
                                    </div>
                                    <!-- <div class="text-center  mt-3 text-dark">
										Don't have account yet? <a href="register.html">SignUp</a>
									</div> -->

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="../assets/js/vendors/jquery-3.2.1.min.js"></script>
    <script src="../assets/plugins/bootstrap-4.3.1-dist/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/vendors/jquery.sparkline.min.js"></script>
    <script src="../assets/js/vendors/selectize.min.js"></script>
    <script src="../assets/js/vendors/jquery.tablesorter.min.js"></script>
    <script src="../assets/js/vendors/circle-progress.min.js"></script>
    <script src="../assets/plugins/rating/jquery.rating-stars.js"></script>
    <!-- p-scroll bar Js-->
    <script src="../assets/plugins/pscrollbar/pscrollbar.js"></script>
    <script src="../assets/plugins/pscrollbar/pscroll.js"></script>
    <!-- Fullside-menu Js-->
    <script src="../assets/plugins/toggle-sidebar/sidemenu.js"></script>
    <!--Counters -->
    <script src="../assets/plugins/counters/counterup.min.js"></script>
    <script src="../assets/plugins/counters/waypoints.min.js"></script>

    <!-- Custom Js-->
    <script src="../assets/js/admin-custom.js"></script>
</body>

</html>