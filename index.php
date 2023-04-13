<?php

require_once('config.php');

$error_msg = '';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo '$username = ' . $username;
    echo '$password = ' . $password;

    // TODO: chk if password is matched in database record
    // $error_msg = 'Wrong password. Try Again.';

?>
    <script>
        window.location.replace("<?php echo SITEURL ?>/home.php");
    </script>
<?php
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

    <?= $error_msg ?>

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