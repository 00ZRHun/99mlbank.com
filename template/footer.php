<?php
/* echo '$url = ' . $url;
$url = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST);
echo '$url = ' . $url;
$base_url = trim($url, '/');
echo '$base_url = ' . $base_url; */
// echo '$base_url = ' . $url;
/* echo '$url = ' . $url;
$base_url = "http://localhost:8080"; */
// echo '$url = ' . $url;

// change password
if (isset($_POST['changePassword'])) {

    // get user table & id
    $user_table = $_SESSION["user_table"];
    $user_id = $_SESSION["user_id"];
    // echo "<script>alert('Debug: user_table = $user_table; user_id = $user_id')</script>";   // D

    // get password (eg. current_password, password, password_confirmation) from user input
    $current_password = $_POST['current_password'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    // get stored_password
    // get single data - find user by id
    // TODO: chk "$var", "'$var'", "'" . $var . "'"
    $sql = "SELECT password FROM $user_table WHERE id = $user_id";
    // echo "<script>alert('Debug: sql = $sql')</script>";   // D
    // $search_query = "SELECT * FROM `user` WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        /* while ($row = $result->fetch_assoc()) {
            echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
            echo "<script>alert('Debug: username = " . $row['username'] . "')</script>";   // D
        } */

        $row = $result->fetch_assoc();
        $stored_password = $row["password"];
        // echo "<script>alert('Debug: username = $username')</script>";   // D
    }

    // pop err msg if incorrect old password or confirmation password not match 
    // echo "<script>alert('Debug: current_password = $current_password; stored_password = $stored_password; password = $password; password_confirmation = $password_confirmation')</script>";   // D
    if ($current_password != $stored_password) {
        echo "<script>alert('Current password is incorrect!')</script>";
    } else if ($password != $password_confirmation) {
        echo "<script>alert('Confirmation password not match!')</script>";
    } else {
        // update password
        // $password = "123456789";
        // $sql = "UPDATE `user` SET password = '" . $password . "' WHERE id = $id";
        // $sql = "UPDATE $user_table SET password = '" . $password . "' WHERE id = $user_id";
        $sql = "UPDATE $user_table SET password = $password WHERE id = $user_id";   // ditto
        // echo "<script>alert('Debug: sql = $sql')</script>";   // D

        if (mysqli_query($conn, $sql)) {
            // echo "<script>alert('Password change successfully.')</script>";
            // echo "<script>window.location.replace('$url/user/index/Superadmins/index.php');</script>";
        } else {
            // echo "<script>alert('id = $id')</>";
            echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
        }
    }
}
?>

</div>
</div>
</div>
<div id="changePassModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post"> <!-- OPT:  action="https://bankcardsample.system1906.com/user/changePassword" // action="../user/changePassword" -->
                <input type="hidden" name="_token" value="CPFPhQYqgjmerci3K7AcwkfKWNWFDBWeRvcTb2pe"> <!-- OPT: value="zZmMzS63qa18RXY01BZGv6chzLXG1ppo7j1x0Zub" // 9B3G2dwuUKn73RAbFXEmH43EsCyyg3ylJzuxxmjP // PqtUCFMuJNkIkZ2y5bubR3BkrqRCILp7VRQexTwP -->
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <label for="change-password"><b>Current password</b></label>
                        <input type="password" class="form-control " name="current_password" autocomplete="current_password" placeholder="Current Password..">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control " name="password" autocomplete="password" placeholder="New Password..">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control " name="password_confirmation" autocomplete="password_confirmation" placeholder="Confirm Password..">
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="changePassword">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>

<!--footer-->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                Copyright © 2022 <a>Card Management System</a>. All rights reserved.
            </div>
        </div>
    </div>
</footer>
<!-- End Footer-->

</div>

<!-- Back to top -->
<a href="#top" id="back-to-top"><i class="fa fa-rocket"></i></a>

<!-- Dashboard Core -->
<script src="<?= SITEURL ?>/assets/js/vendors/jquery-3.2.1.min.js"></script>
<script src="<?= SITEURL ?>/assets/plugins/bootstrap-4.3.1-dist/js/popper.min.js"></script>
<script src="<?= SITEURL ?>/assets/plugins/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script src="<?= SITEURL ?>/assets/js/vendors/jquery.sparkline.min.js"></script>
<script src="<?= SITEURL ?>/assets/js/vendors/selectize.min.js"></script>
<script src="<?= SITEURL ?>/assets/js/vendors/jquery.tablesorter.min.js"></script>
<script src="<?= SITEURL ?>/assets/js/vendors/circle-progress.min.js"></script>
<script src="<?= SITEURL ?>/assets/plugins/rating/jquery.rating-stars.js"></script>

<!--Counters -->
<script src="<?= SITEURL ?>/assets/plugins/counters/counterup.min.js"></script>
<script src="<?= SITEURL ?>/assets/plugins/counters/waypoints.min.js"></script>
<!-- Fullside-menu Js-->
<script src="<?= SITEURL ?>/assets/plugins/toggle-sidebar/sidemenu.js"></script>


<!-- Data tables -->
<script src="<?= SITEURL ?>/assets/plugins/datatable/jquery.dataTables.min.js"></script>
<script src="<?= SITEURL ?>/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?= SITEURL ?>/assets/js/datatable.js"></script>

<!-- Select2 js -->
<script src="<?= SITEURL ?>/assets/plugins/select2/select2.full.min.js"></script>

<!-- CHARTJS CHART -->
<script src="<?= SITEURL ?>/assets/plugins/chart/Chart.bundle.js"></script>
<script src="<?= SITEURL ?>/assets/plugins/chart/utils.js"></script>

<!-- p-scroll bar Js-->
<script src="<?= SITEURL ?>/assets/plugins/pscrollbar/pscrollbar.js"></script>
<script src="<?= SITEURL ?>/assets/plugins/pscrollbar/pscroll.js"></script>

<!-- ECharts Plugin -->
<script src="<?= SITEURL ?>/assets/plugins/echarts/echarts.js"></script>
<script src="<?= SITEURL ?>/assets/js/index1.js"></script>

<!-- Custom Js-->
<script src="<?= SITEURL ?>/assets/js/admin-custom.js"></script>
<script src="<?= SITEURL ?>/assets/js/select2.js"></script>

</body>

</html>