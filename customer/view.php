<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

// initialise variables
// $path = $url . "/bank/index.php";
$user_id = $_GET['user'];
$path = $url . "/customer/view.php?user=" . $user_id;
$prev_path = $url . "/customer/index.php";
// TODO: double chk without prefix (eg. us, rc, bk) will cause err on MySql syntax
$condition_user_id = "user_id = $user_id";   // current user
// $condition_non_cased = "rc.case_remarks IS NULL AND rc.cased_by IS NULL AND rc.cased_at IS NULL";   // filter out cased card
$condition_cased = "rc.case_remarks IS NOT NULL AND rc.cased_by IS NOT NULL AND rc.cased_at IS NOT NULL";   // get cased card

// === do calculation & display result ===
// loop thru data to calculate data START
// echo "<script>alert('Debug: HERE')</script>";   // D
$total_cards = 0;
$total_card_price = 0;
$total_invoice = 0;
$total_payment = 0;
$outstanding = 0;
$all_outstanding = 0;

// 1st table: payment
$sql = "SELECT SUM(amount) AS amount FROM `payment` WHERE $condition_user_id";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
    $total_payment += $row['amount'];
}

// 2nd table: rent_card
// filter non-cased rent card
$sql = "SELECT * FROM `rent_card` 
     WHERE $condition_user_id AND case_remarks IS NULL AND cased_by IS NULL AND cased_at IS NULL";
$result = mysqli_query($conn, $sql);

//if ($result->num_rows > 0) {
/* $row = $result->fetch_assoc();
    // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D */
// while ($row = $result->fetch_assoc()) {
while ($row = mysqli_fetch_array($result)) {
    $total_cards += 1;
    $total_card_price += $row['to_price'];
    if ($row['invoice_no'] != null)  $total_invoice += $row['total'];
    $outstanding = $total_invoice - $total_payment;
    $all_outstanding = $outstanding;   // TODO: resolve dummy data

    /* echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
    echo "<script>alert('Debug: row['id'] = " . $row['id'] . "')</script>";   // D */
}
// loop thru data to calculate data END

// === user details ===
if (isset($_GET['user'])) {
    // echo "<script>alert('Debug: user_id = $user_id')</script>";   // D

    // get single data - find user by id
    $sql = "SELECT * FROM `user` WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
    } else {
        echo "<script>window.location.href='$prev_path';</script>";   // ditto
    }

    // get upline user name
    // $row['upline_name'] = "Master Admin";
    $upline_user_id = $row['upline'];
    $sql = "SELECT * FROM `user` WHERE id = $upline_user_id";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row_temp = $result->fetch_assoc();
        $row['upline_name'] = $row_temp['name'];
        // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
    } else {   // redirect to prev customer page (if id is invalid)
        echo "<script>window.location.href='$prev_path';</script>";   // ditto
    }
}

// === Cards ===
// card -> rent_card
// create or edit rent_card
if (isset($_POST['create'])) {
    echo "<script>alert('DEBUG: HERE -1';)</script>";   // D

    // get user input data
    $card_id = $_POST['select_card'] ?? NULL;
    $from_date = $_POST['from_date'];
    $to_price = $_POST['to_price'];
    $insurance = $_POST['insurance'];

    // get to_date
    // $to_date = $_POST['to_date'] ?? ;
    // get last day of month from date
    // $end_of_month = date('Y-m-t', strtotime($from_date));   // for 64 bit only
    $d = new DateTime($from_date);
    $end_of_month = $d->format('Y-m-t');   // for 32 and 64 bit // TOOD: chk if got problem when use prev / next month (x curr)
    $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : $end_of_month;

    /* echo "<script>alert('DEBUG: HERE';)</script>";   // D
    echo "<script>alert('home_address = $home_address')</script>";   // D
    // echo "<script>alert('" . $trim($_POST['home_addres s']) . "';)</script>";   // D
    echo "<script>alert('" . empty($_POST['home_address']) . "';)</script>";   // D
    echo "<script>alert('DEBUG: home_address = $home_address';)</script>";   // D */

    // if id empty, then create new rent_card, else update old rent_card
    $id = $_POST['id'] ?? NULL;   // use to determine if CREATE or EDIT mode
    // echo "<script>alert('id = $id; card_id = $card_id; from_date = $from_date; to_price = $to_price; insurance = $insurance; to_date = $to_date')</script>";   // D

    // get no_of_days (to_date - from_date + 1 day) & total
    list($no_of_days, $total) = cal_days_and_total($from_date, $to_date, $to_price);

    if ($id == "") {
        // echo "<script>alert('CREATE')</script>";   // D
        $sql = "INSERT INTO `rent_card` (card_id, from_date, to_date, to_price, insurance, user_id, no_of_days, total) 
            VALUES ($card_id, '$from_date', '$to_date', $to_price, $insurance, $user_id, $no_of_days, $total)";
        echo "<script>alert('-2) sql = $sql')</script>";
    } else {
        // echo "<script>alert('EDIT')</script>";   // D
        $sql = "UPDATE `rent_card` SET from_date = '$from_date', to_date = '$to_date', to_price = $to_price, insurance = $insurance, user_id = $user_id, no_of_days = $no_of_days, total = $total WHERE id = $id";
        echo "<script>alert('1) sql = $sql')</script>";
    }
    echo "<script>alert('2) sql = $sql')</script>";

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Created successfully.')</script>";
    } else {
        echo "<script>alert('no_of_days = $no_of_days; days_of_month = $days_of_month; to_date = $to_date; total = $total;')</script>";
        echo "<script>alert('id = $id; card_id = $card_id; from_date = $from_date; to_price = $to_price; insurance = $insurance; to_date = $to_date')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

// delete rent_card
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];   // use to determine if CREATE or EDIT mode
    echo "<script>alert('id = $id';)</script>";   // D

    $sql = "DELETE FROM `rent_card` WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Created successfully.')</script>";
        echo "<script>window.location.href='$path';</script>";
        // echo "<script>window.location.href='" . SITEURL . "/rent_card/index.php';</script>";   // ditto
    } else {
        echo "<script>alert('id = $id')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

// case rent_card
if (isset($_POST['case'])) {
    // get required data
    $id = $_POST['card_iddd'];
    $case_remarks = $_POST['case_remarks'];
    /* $status = "Cased"; */
    $cased_by = $_SESSION["upline"];
    // $cased_at = date('Y-m-d');
    $cased_at = date('Y-m-d H:i:s');

    // update status
    /* $sql = "UPDATE `rent_card` SET case_remarks = '$case_remarks', status = '$status', cased_by = $cased_by, cased_at = '$cased_at' WHERE id = $id"; */
    $sql = "UPDATE `rent_card` SET case_remarks = '$case_remarks', cased_by = $cased_by, cased_at = '$cased_at' WHERE id = $id";
    // echo "<script>alert('case; id = $id; case_remarks = $case_remarks')</script>";   // D
    echo "<script>alert('sql = $sql')</script>";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Status updated successfully.')</script>";
        echo "<script>window.location.replace('$path');</script>";
    } else {
        echo "<script>alert('DEBUG: id = $id; status = $status')</script>";   // D
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

// === Invoices ===
// generate invoice
if (isset($_GET['generate'])) {

    // get required data
    $id = $_GET['generate'];

    // check if have null value for invoice_no in rent_card tbl
    $sql = "SELECT COUNT(*) AS count FROM `rent_card` WHERE $condition_user_id AND invoice_no IS NULL";
    $res = mysqli_query($conn, $sql);
    $invoice_no_null_count = ($myrow = mysqli_fetch_array($res)) ? $myrow['count'] : 0;

    if ($invoice_no_null_count > 0) {
        // get next_running_no START
        /* $d = new DateTime(now());
        $end_of_month = $d->format('Y-m-t'); */
        $curr_end_of_month = date('Y-m-t');

        $sql = "SELECT running_no FROM `invoice_no` WHERE end_of_month = '$curr_end_of_month'";
        /* echo "<script>alert('curr_end_of_month = $curr_end_of_month')</script>";
        echo "<script>alert('sql = $sql')</script>"; */
        $res = mysqli_query($conn, $sql);

        /* if ($myrow = mysqli_fetch_array($res)) {
            $next_running_no = $myrow['running_no'] + 1;
        } else {
            $next_running_no = 1;
        } */
        $next_running_no = ($myrow = mysqli_fetch_array($res)) ? $myrow['running_no'] + 1 : 1;
        /* echo "<script>alert('res = $res')</script>"; */

        if ($next_running_no == 1) {
            // create running_no
            $sql = "INSERT INTO `invoice_no` (end_of_month, running_no) VALUES ('$curr_end_of_month', $next_running_no)";
            /* echo "<script>alert('Debug: curr_end_of_month = $curr_end_of_month; next_running_no = $next_running_no')</script>";   // D
            echo "<script>alert('Debug: sql = $sql')</script>";   // D */
        } else {
            // update running_no
            $sql = "UPDATE `invoice_no` SET running_no = $next_running_no WHERE end_of_month = '$curr_end_of_month'";
            /* echo "<script>alert('Debug: next_running_no = $next_running_no')</script>";   // D
            echo "<script>alert('Debug: sql = $sql')</script>";   // D */
        }

        // get next invoice no
        $next_invoice_no = date('Ym') . str_pad($next_running_no, 5, "0", STR_PAD_LEFT);
        $sql .= "; UPDATE `rent_card` SET invoice_no = '$next_invoice_no' WHERE invoice_no IS NULL";
        /* echo "<script>alert('Debug: next_invoice_no = $next_invoice_no')</script>";   // D
        echo "<script>alert('Debug: sql = $sql')</script>";   // D */

        // if (mysqli_query($conn, $sql)) {
        if (mysqli_multi_query($conn, $sql)) {   // * use mysqli_multi_query(conn, sql) to run multi query
            // echo "<script>alert('Status updated successfully.')</script>";
            echo "<script>window.location.replace('$path');</script>";
        } else {
            echo "<script>alert('next_running_no = $next_running_no')</script>";
            echo "<script>alert('sql = $sql')</script>";
            echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
        }
        // get next_running_no END   
    } else {
        echo "<script>window.location.replace('$path');</script>";
    }
}

// edit invoice
if (isset($_POST['edit-invoice'])) {
    // get required data
    $id = $_POST['invoice_item_id'];
    $to_price = $_POST['to_priceee'];
    $from_date = $_POST['date_from'];
    $to_date = $_POST['date_to'];
    // echo "<script>alert('DEBUG: id = $id; to_price = $to_price; from_date = $from_date; to_date = $to_date')</script>";   // D

    // get no_of_days (to_date - from_date + 1 day) & total
    list($no_of_days, $total) = cal_days_and_total($from_date, $to_date, $to_price);
    // echo "<script>alert('DEBUG: no_of_days = $no_of_days; total = $total')</script>";   // D

    // update rent_card
    $sql = "UPDATE `rent_card` SET from_date = '$from_date', to_date = '$to_date', no_of_days = $no_of_days, total = $total WHERE id = $id";
    echo "<script>alert('sql = $sql')</script>";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Invoice updated successfully.')</script>";
        echo "<script>window.location.replace('$path');</script>";
    } else {
        echo "<script>alert('DEBUG: id = $id; from_date = $from_date; to_date = $to_date; no_of_days = $no_of_days; total = $total')</script>";   // D
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

// delete invoice
if (isset($_GET['delete-invoice'])) {

    $id = $_GET['delete-invoice'];   // use to determine if CREATE or EDIT mode
    echo "<script>alert('id = $id';)</script>";   // D

    // $sql = "DELETE FROM `payment` WHERE id = $id";
    $sql = "UPDATE `rent_card` SET invoice_no = NULL WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Created successfully.')</script>";
        echo "<script>window.location.href='$path';</script>";
        // echo "<script>window.location.href='" . SITEURL . "/rent_card/index.php';</script>";   // ditto
    } else {
        echo "<script>alert('id = $id')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

// === Payments ===
// create payment
if (isset($_POST['pay'])) {
    // initialise data
    // $customer_id = $_POST['customer_id'];   // TODO: do it later
    $customer_id = $user_id;
    // get user input data
    $pay_date = $_POST['pay_date'];
    // $pay_for = $_POST['pay_for'];
    $f_y = $_POST['pay_for'];
    $date = new DateTime($f_y);
    $pay_for = $date->format('Y-m-t');
    $amount = $_POST['amount'];

    /* // if id empty, then create new rent_card, else update old rent_card
    $id = $_POST['id'] ?? NULL;   // use to determine if CREATE or EDIT mode
    // echo "<script>alert('id = $id; card_id = $card_id; from_date = $from_date; to_price = $to_price; insurance = $insurance; to_date = $to_date')</script>";   // D */

    /* if ($id == "") { */
    // echo "<script>alert('CREATE')</script>";   // D
    $sql = "INSERT INTO `payment` (user_id, pay_date, pay_for, amount) 
            VALUES ($user_id, '$pay_date', '$pay_for', $amount)";
    echo "<script>alert('-2) sql = $sql')</script>";
    /* } else {
        // echo "<script>alert('EDIT')</script>";   // D
        $sql = "UPDATE `rent_card` SET from_date = '$from_date', to_date = '$to_date', to_price = $to_price, insurance = $insurance, user_id = $user_id WHERE id = $id";
        echo "<script>alert('1) sql = $sql')</script>";
    } */
    echo "<script>alert('2) sql = $sql')</script>";

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Created successfully.')</script>";
    } else {
        echo "<script>alert('id = $id; customer_id = $customer_id; pay_date = $pay_date; pay_for = $pay_for; amount = $amount;')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

// delete payment
if (isset($_GET['delete-payment'])) {

    $id = $_GET['delete-payment'];   // use to determine if CREATE or EDIT mode
    echo "<script>alert('id = $id';)</script>";   // D

    $sql = "DELETE FROM `payment` WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Created successfully.')</script>";
        echo "<script>window.location.href='$path';</script>";
        // echo "<script>window.location.href='" . SITEURL . "/rent_card/index.php';</script>";   // ditto
    } else {
        echo "<script>alert('id = $id')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

// funtion(s)
// round to 2 decimals & display in 2 decimals
function convert_to_2_decimal($number)
{
    // return number_format((float) round($number), 2, '.', '');   // no need to round
    return number_format((float) $number, 2, '.', '');             // ady round for us
}

// get no_of_days (to_date - from_date + 1 day) & total
function cal_days_and_total($from_date, $to_date, $to_price)
{
    /* $from_date = $row['from_date'];
    $to_date = $row['to_date']; */
    $from_date_str = strtotime($from_date);
    $to_date_str = strtotime($to_date);
    $no_of_days = round(($to_date_str - $from_date_str) / (60 * 60 * 24)) + 1;
    // get total
    // $year_month_day_arr = $from_date.split("-");   // CAN'T WORK
    $year_month_day_arr = explode("-", $from_date);
    /* echo "<script>alert('from_date = $from_date')</script>";   // D
    echo "<script>alert('from_date_str = $from_date_str')</script>";   // D
    echo "<script>alert('year_month_day_arr = " . json_encode($year_month_day_arr) . "')</script>";   // D
    echo "<script>alert('from_date = " . $from_date->format("Y") . "')</script>";   // D
    echo $year_month_day_arr; */
    $days_of_month = cal_days_in_month(CAL_GREGORIAN, $year_month_day_arr[1], $year_month_day_arr[0]);   // OPT: 28, 30, 31
    // $days_of_month = cal_days_in_month(CAL_GREGORIAN, $from_date->format("Y"), $from_date->format("m"));   // OPT: 28, 30, 31
    $total = $to_price * $no_of_days / $days_of_month;
    /* // $row['total'] = number_format((float) round($total), 2, '.', '')   // round to 2 decimals & display in 2 decimals
    $row['total'] = convert_to_2_decimal($total);   // round to 2 decimals & display in 2 decimals */

    /* echo "<script>alert('days_of_month = $days_of_month; total = $total')</script>";   // D
    echo "<script>alert('array = " . json_encode(array($days_of_month, $total)) . "')</script>";   // D */
    return array($no_of_days, $total);
}
?>

<div class="page-header">
    <h4 class="page-title"><?= $row['username'] ?></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><?= $row['username'] ?></a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>

</div>

<div class="row">
    <div class="col-lg-5 col-xl-4">
        <!-- <div class="card card-profile cover-image " data-image-src="https://bankcardsample.system1906.com/assets/images/photos/gradient3.jpg"> -->
        <div class="card card-profile cover-image " data-image-src="<?= SITEURL ?>/assets/images/photos/gradient3.jpg">
            <div class="card-body text-center">
                <!-- <img class="card-profile-img" src="https://bankcardsample.system1906.com/assets/images/star.jpg" alt="img"> -->
                <img class="card-profile-img" src="<?= SITEURL ?>/assets/images/star.jpg" alt="img">
                <h3 class="mb-1 text-white"><?= $row['username'] ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-xl-8">
        <div class="card">
            <div class="card-body">
                <div id="profile-log-switch">
                    <div class="fade show active ">
                        <div class="table-responsive border ">
                            <table class="table row table-borderless w-100 m-0 ">
                                <tbody class="col-lg-12 col-xl-6 p-0">
                                    <tr>
                                        <td><strong>Name :</strong> <?= $row['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Contact No :</strong> <?= $row['contact'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Username :</strong> <?= $row['username'] ?></td>
                                    </tr>
                                </tbody>
                                <tbody class="col-lg-12 col-xl-6 p-0">
                                    <tr>
                                        <td><strong>Role :</strong> <?= $row['role'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Created By :</strong> <?= $row['upline_name'] ?> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status :</strong>
                                            <!-- <div class="btn btn-sm" style="background-color:green;color:white">Active</div> -->
                                            <div class="btn btn-sm" style="background-color:<?= $row['status'] == "Active" ? "green" : "red" ?>;color:white"><?= $row['status'] ?></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
        <form class="form-inline" method="GET" style="float:right">
            <div class="form-group mb-2">
                <input type="month" class="form-control" id="filter" name="filter" style="margin-right:10px" value="2023-04">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Search</button>
        </form>
    </div>
    <div class="col-lg-12 col-xl-12">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2 ">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:red">Total Cards</h3>
                        </div>
                        <div class="card-body ">
                            <h2 class="text-dark  mt-0 font-weight-bold"><?= $total_cards ?></h2> <!-- OPT: 1 -->
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:black">Total Card Price</h3>
                        </div>
                        <div class="card-body ">

                            <h2 class="text-dark  mt-0 font-weight-bold">RM <?= convert_to_2_decimal($total_card_price) ?></h2> <!-- OPT: 111 -->
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:purple">Total Invoice</h3>
                        </div>
                        <div class="card-body ">

                            <h2 class="text-dark  mt-0 font-weight-bold">RM <?= convert_to_2_decimal($total_invoice) ?></h2> <!-- OPT: 70.3 -->
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:brown">Total Payment</h3>
                        </div>
                        <div class="card-body ">
                            <h2 class="text-dark  mt-0 font-weight-bold"><?= convert_to_2_decimal($total_payment) ?></h2> <!-- OPT: 111 -->
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:green">Outstanding</h3>
                        </div>
                        <div class="card-body ">
                            <h2 class="text-dark  mt-0 font-weight-bold"><?= convert_to_2_decimal($outstanding) ?></h2> <!-- OPT: -40.7 -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2 ">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:blue">All Outstanding</h3>
                        </div>
                        <div class="card-body ">

                            <h2 class="text-dark  mt-0  font-weight-bold">RM <?= convert_to_2_decimal($all_outstanding) ?></h2> <!-- OPT: -40.7 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Card and Invoices</h3>

            </div>
            <div class="card-body p-6">
                <div class="panel panel-primary">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu ">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class=""><a href="#tab1" class="active" data-toggle="tab">Cards</a></li>
                                <li><a href="#tab2" data-toggle="tab">Invoices</a></li>
                                <li><a href="#tab3" data-toggle="tab">Payments</a></li>
                                <li><a href="#tab4" data-toggle="tab">Cases</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            <div class="tab-pane active " id="tab1">
                                <a class="btn btn-info" onclick="openModal()" style="float:right;color:white;margin-bottom:10px">Assign Card</a>
                                <div class="table-responsive">
                                    <table id="example2" class="hover table-bordered border-top-0 border-bottom-0">
                                        <thead>
                                            <tr>
                                                <th>Card No</th>
                                                <th>Bank</th>
                                                <th>Card Name</th>
                                                <th>Start Date</th>
                                                <th>Monthly Price (RM)</th>
                                                <th>Insurance (RM)</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr>
                                                <td>111</td>
                                                <td>RHB</td>
                                                <td>RHB card</td>
                                                <td>2023-04-12</td>
                                                <td>111</td>
                                                <td>111</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;}})">
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete card from customer?')){ window.location.href='https://bankcardsample.system1906.com/customer/removeCard/1' }">
                                                        Delete
                                                    </button>
                                                    <button class="btn btn-sm btn-info" style="background-color:blue" onclick="if(confirm('Are you sure you want to Case this card?')){ caseModal({&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;}}) }">
                                                        Case
                                                    </button>
                                                    <button class="btn btn-sm btn-info" style="background-color:green" onclick="if(confirm('Are you sure that this card is rent ended?')){ window.location.href='https://bankcardsample.system1906.com/customer/cardRentEnd/1' }">
                                                        Rent Ended
                                                    </button>
                                                    <button class="btn btn-sm btn-info" style="background-color:orange" onclick="if(confirm('Are you sure remove this card for this month?')){ window.location.href='https://bankcardsample.system1906.com/customer/cardRemoveCurrent/1' }">
                                                        Remove This Month
                                                    </button>
                                                </td>
                                            </tr> -->
                                            <!-- list rent_cards
                                            - filter customer's rent card
                                            - filter non-cased rent card -->
                                            <?php
                                            $sql = "SELECT rc.id AS id, rc.from_date AS from_date, rc.to_date AS to_date, rc.to_price AS to_price, rc.insurance AS insurance, rc.card_id AS card_id, 
                                                cd.card_no AS card_no, cd.card_name AS card_name, 
                                                bk.name AS bank_name 
                                                FROM `rent_card` as rc 
                                                LEFT JOIN `card` as cd ON rc.card_id = cd.id 
                                                LEFT JOIN `bank` as bk ON cd.bank_id = bk.id 
                                                WHERE $condition_user_id AND NOT($condition_cased)";

                                            // echo "<script>alert('sql = $sql')</script>";   // D
                                            $result = mysqli_query($conn, $sql);
                                            if ($result->num_rows > 0) {

                                                while ($row = $result->fetch_assoc()) {
                                                    // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                                            ?>
                                                    <tr>
                                                        <td><?= $row['card_no'] ?></td>
                                                        <td><?= $row['bank_name'] ?></td>
                                                        <td><?= $row['card_name'] ?></td>
                                                        <td><?= $row['from_date'] ?></td>
                                                        <td><?= $row['to_price'] ?></td>
                                                        <td><?= $row['insurance'] ?></td>
                                                        <td>
                                                            <!-- <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;}})"> -->
                                                            <button class="btn btn-sm btn-info" onclick='editModal(<?= json_encode($row) ?>)'>
                                                                Edit
                                                            </button>
                                                            <!-- <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete card from customer?')){ window.location.href='https://bankcardsample.system1906.com/customer/removeCard/1' }"> -->
                                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete card from customer?')){ window.location.href='<?= $path ?>&delete=' + <?= $row['id'] ?> }">
                                                                Delete
                                                            </button>
                                                            <!-- <button class="btn btn-sm btn-info" style="background-color:blue" onclick="if(confirm('Are you sure you want to Case this card?')){ caseModal({&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;}}) }"> -->
                                                            <button class="btn btn-sm btn-info" style="background-color:blue" onclick='if(confirm("Are you sure you want to Case this card?")){ caseModal(<?= json_encode($row) ?>) }'>
                                                                Case
                                                            </button>
                                                            <!-- TODO: uncomment -> btn functions -->
                                                            <!-- <button class="btn btn-sm btn-info" style="background-color:green" onclick="if(confirm('Are you sure that this card is rent ended?')){ window.location.href='https://bankcardsample.system1906.com/customer/cardRentEnd/1' }">
                                                                Rent Ended
                                                            </button>
                                                            <button class="btn btn-sm btn-info" style="background-color:orange" onclick="if(confirm('Are you sure remove this card for this month?')){ window.location.href='https://bankcardsample.system1906.com/customer/cardRemoveCurrent/1' }">
                                                                Remove This Month
                                                            </button> -->
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <!-- <a class="btn btn-info" style="float:right;color:white;margin-bottom:10px" onclick="if(confirm('Are you sure you want to generate invoice?')){ window.location.href='https://bankcardsample.system1906.com/customer/generateInvoice/2' }"> -->
                                <a class="btn btn-info" style="float:right;color:white;margin-bottom:10px" onclick="if(confirm('Are you sure you want to generate invoice?')){ window.location.href='<?= $path ?>&generate=' + <?= $user_id ?> }">
                                    Generate
                                </a>

                                <!-- TODO: UPDATE rent_card SET invoice_no='20230400001'; -->
                                <div class="table-responsive">
                                    <table id="example" class="hover table-bordered border-top-0 border-bottom-0">
                                        <thead>
                                            <tr>
                                                <th>Invoice No</th>
                                                <th>Card No</th>
                                                <th>Bank</th>
                                                <th>Card Name</th>
                                                <th>Date From</th>
                                                <th>Date To</th>
                                                <th>Monthly (RM)</th>
                                                <th>No of Days</th>
                                                <th>Total (RM)</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr>
                                                <td>20230400001</td>
                                                <td>111</td>
                                                <td>RHB</td>
                                                <td>RHB card</td>
                                                <td>2023-04-12</td>
                                                <td>2023-04-30</td>
                                                <td>111</td>
                                                <td>19</td>
                                                <td>70.3</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" onclick="editInvoiceItem({&quot;id&quot;:1,&quot;invoice_id&quot;:1,&quot;card_id&quot;:1,&quot;date_from&quot;:&quot;2023-04-12&quot;,&quot;date_to&quot;:&quot;2023-04-30&quot;,&quot;no_of_days&quot;:19,&quot;cost&quot;:111,&quot;price&quot;:70.3,&quot;year&quot;:2023,&quot;month&quot;:4,&quot;created_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;card&quot;:{&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;}}})">
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete invoice item?')){ window.location.href='https://bankcardsample.system1906.com/customer/destroyItems/1' }">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr> -->

                                            <!-- list invoices -->
                                            <?php
                                            $sql = "SELECT rc.id AS id, rc.invoice_no AS invoice_no, rc.from_date AS from_date, rc.to_date AS to_date, rc.to_price AS to_price, rc.no_of_days AS no_of_days, rc.total AS total, 
                                                cd.card_no AS card_no, cd.card_name AS card_name, 
                                                bk.name AS bank_name 
                                                FROM `rent_card` as rc 
                                                LEFT JOIN `card` as cd ON rc.card_id = cd.id 
                                                LEFT JOIN `bank` as bk ON cd.bank_id = bk.id 
                                                WHERE $condition_user_id AND rc.invoice_no IS NOT NULL 
                                                AND NOT($condition_cased)";
                                            // echo "<script>alert('sql = $sql')</script>";   // D
                                            $result = mysqli_query($conn, $sql);
                                            if ($result->num_rows > 0) {

                                                while ($row = $result->fetch_assoc()) {
                                                    // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                                            ?>
                                                    <tr>
                                                        <td><?= $row['invoice_no'] ?></td>
                                                        <td><?= $row['card_no'] ?></td>
                                                        <td><?= $row['bank_name'] ?></td>
                                                        <td><?= $row['card_name'] ?></td>
                                                        <td><?= $row['from_date'] ?></td>
                                                        <td><?= $row['to_date'] ?></td>
                                                        <td><?= $row['to_price'] ?></td>
                                                        <td><?= $row['no_of_days'] ?></td>
                                                        <td><?= $row['total'] ?></td>
                                                        <td>
                                                            <!-- <button class="btn btn-sm btn-info" onclick="editInvoiceItem({&quot;id&quot;:1,&quot;invoice_id&quot;:1,&quot;card_id&quot;:1,&quot;date_from&quot;:&quot;2023-04-12&quot;,&quot;date_to&quot;:&quot;2023-04-30&quot;,&quot;no_of_days&quot;:19,&quot;cost&quot;:111,&quot;price&quot;:70.3,&quot;year&quot;:2023,&quot;month&quot;:4,&quot;created_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;card&quot;:{&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;}}})"> -->
                                                            <button class="btn btn-sm btn-info" onclick='editInvoiceItem(<?= json_encode($row) ?>)'>
                                                                Edit
                                                            </button>
                                                            <!-- <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete invoice item?')){ window.location.href='https://bankcardsample.system1906.com/customer/destroyItems/1' }"> -->
                                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete invoice item?')){ window.location.href='<?= $path ?>&delete-invoice=' + <?= $row['id'] ?> }">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3">
                                <!-- <a class="btn btn-info" onclick="openPayModal({&quot;id&quot;:2,&quot;name&quot;:&quot;1111&quot;,&quot;username&quot;:&quot;<?= $row['username'] ?>&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Customer&quot;,&quot;contact_no&quot;:&quot;111122&quot;,&quot;upline&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:25:14.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:25:37.000000Z&quot;,&quot;customer_cards&quot;:[{&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;}}],&quot;invoices&quot;:[{&quot;id&quot;:1,&quot;invoice_no&quot;:&quot;20230400001&quot;,&quot;customer_id&quot;:2,&quot;year&quot;:2023,&quot;month&quot;:4,&quot;created_at&quot;:&quot;2023-04-11T01:26:05.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:26:05.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;items&quot;:[{&quot;id&quot;:1,&quot;invoice_id&quot;:1,&quot;card_id&quot;:1,&quot;date_from&quot;:&quot;2023-04-12&quot;,&quot;date_to&quot;:&quot;2023-04-30&quot;,&quot;no_of_days&quot;:19,&quot;cost&quot;:111,&quot;price&quot;:70.3,&quot;year&quot;:2023,&quot;month&quot;:4,&quot;created_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;card&quot;:{&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;}}}]}],&quot;payments&quot;:[{&quot;id&quot;:1,&quot;customer_id&quot;:2,&quot;pay_date&quot;:&quot;2023-04-12&quot;,&quot;amount&quot;:111,&quot;month&quot;:&quot;4&quot;,&quot;year&quot;:&quot;2023&quot;,&quot;remarks&quot;:null,&quot;created_at&quot;:&quot;2023-04-11T01:42:17.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:42:17.000000Z&quot;,&quot;deleted_at&quot;:null}],&quot;upline_dt&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;Master Admin&quot;,&quot;username&quot;:&quot;masteradmin&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Masteradmin&quot;,&quot;contact_no&quot;:null,&quot;upline&quot;:null,&quot;is_active&quot;:1,&quot;created_at&quot;:null,&quot;updated_at&quot;:&quot;2023-04-13T20:15:19.000000Z&quot;}})" style="float:right;color:white;margin-bottom:10px">Pay</a> -->
                                <a class="btn btn-info" onclick="openPayModal()" style="float:right;color:white;margin-bottom:10px">Pay</a>
                                <div class="table-responsive">
                                    <table id="example3" class="hover table-bordered border-top-0 border-bottom-0">
                                        <thead>
                                            <tr>
                                                <th>Payment Date</th>
                                                <th>Pay for</th>
                                                <th>Amount (RM)</th>
                                                <th>Remarks</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr>
                                                <td>2023-04-12</td>
                                                <td>April 2023</td>
                                                <td>111</td>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete payment?')){ window.location.href='https://bankcardsample.system1906.com/customer/destroyPayment/1' }">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr> -->

                                            <!-- list payments -->
                                            <?php
                                            $sql = "SELECT * FROM `payment` WHERE $condition_user_id";
                                            // echo "<script>alert('sql = $sql')</script>";   // D
                                            $result = mysqli_query($conn, $sql);
                                            if ($result->num_rows > 0) {

                                                while ($row = $result->fetch_assoc()) {
                                                    // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D

                                                    // get pay_for in 'Mon yyyy' format
                                                    /* $row['pay_for'] = $row['pay_for']->date_format('Mon yyyy')
                                                    $abc = MONTH($row['pay_for']);
                                                    $year = YEAR($row['pay_for']); */
                                                    $row['pay_for'] = date('F Y', strtotime($row['pay_for']));   // OPT: M Y (F -> full month; M -> 3-char month name)
                                            ?>
                                                    <tr>
                                                        <!-- TODO: HERE - resolve dummy data -->
                                                        <td><?= $row['pay_date'] ?></td>
                                                        <td><?= $row['pay_for'] ?></td>
                                                        <td><?= $row['amount'] ?></td>
                                                        <td></td>
                                                        <td>
                                                            <!-- <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete payment?')){ window.location.href='https://bankcardsample.system1906.com/customer/destroyPayment/1' }"> -->
                                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete payment?')){ window.location.href='<?= $path ?>&delete-payment=' + <?= $row['id'] ?> }">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab4">
                                <div class="table-responsive">
                                    <table id="example4" class="hover table-bordered border-top-0 border-bottom-0">
                                        <thead>
                                            <tr>
                                                <th>Card Name</th>
                                                <th>Card No</th>
                                                <th>Bank</th>
                                                <th>Case Date</th>
                                                <th>Remarks</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr>
                                                <td>Name</td>
                                                <td>Card No/Company ID</td>
                                                <td>MBB</td>
                                                <td>2023-05-04 20:20:36</td>
                                                <td>This is a case remark!</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete case history?')){ window.location.href='https://bankcardsample.system1906.com/customer/destroyCaseHistory/1' }">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr> -->

                                            <!-- list cased rent card  -->
                                            <?php
                                            $sql = "SELECT rc.id AS id, rc.case_remarks AS case_remarks, rc.cased_at AS cased_at, 
                                                cd.card_no AS card_no, cd.card_name AS card_name, 
                                                bk.name AS bank_name 
                                                FROM `rent_card` as rc 
                                                LEFT JOIN `card` as cd ON rc.card_id = cd.id 
                                                LEFT JOIN `bank` as bk ON cd.bank_id = bk.id 
                                                WHERE $condition_user_id AND $condition_cased";
                                            // ";

                                            // echo "<script>alert('sql = $sql')</script>";   // D
                                            $result = mysqli_query($conn, $sql);
                                            if ($result->num_rows > 0) {

                                                while ($row = $result->fetch_assoc()) {
                                                    // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                                            ?>
                                                    <tr>
                                                        <td><?= $row['card_name'] ?></td>
                                                        <td><?= $row['card_no'] ?></td>
                                                        <td><?= $row['bank_name'] ?></td>
                                                        <td><?= $row['cased_at'] ?></td>
                                                        <td><?= $row['case_remarks'] ?></td>
                                                        <td>
                                                            <!-- <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete case history?')){ window.location.href='https://bankcardsample.system1906.com/customer/destroyCaseHistory/1' }"> -->
                                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete case history?')){ window.location.href='<?= $path ?>&delete=' + <?= $row['id'] ?> }">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="largeModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold">Assign Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/customer/storeCard/2"> -->
            <form enctype="multipart/form-data" method="post">
                <input type="hidden" name="_token" value="fVXsMKMoXBBiLt6AAWzdiGvZsBa62PKKGG1LWxGX">
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <label class="form-label" for="exampleInputEmail1">Card</label>
                        <select class="form-control" name="select_card" id="select_card" required>
                            <option value="">-- Choose Card --</option>
                            <!-- <option value="2">
                                Am Card - AMBANK COMPANY
                            </option> -->
                            <!-- list cards ({card_name} - {bank_name}) -->
                            <?php
                            // filter non-used rent card
                            // TODO: fix including cased card
                            $sql = "SELECT cd.id AS id, cd.card_name AS card_name, bk.name AS bank_name 
                                    FROM `card` as cd 
                                    LEFT JOIN `bank` as bk ON cd.bank_id = bk.id 
                                    LEFT JOIN `rent_card` AS rc ON cd.id = rc.card_id 
                                    WHERE cd.status = 'Approved' AND NOT($condition_cased) AND rc.card_id IS NULL";
                            // WHERE cd.status = 'Approved' AND (rc.card_id IS NULL OR $condition_cased)";
                            // TODO: fix in case 1 is cased & another is rented (add available field in card)
                            /* echo "<script>alert('condition_cased = $condition_cased')</script>";   // D
                            echo "<script>alert('sql = $sql')</script>";   // D */
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    /* echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                                                    echo "<script>alert('Debug: username = " . $row["username"] . "')</script>";   // D */
                            ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['card_name'] . ' - ' . $row['bank_name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Start Rent Date</label>
                        <input type="date" class="form-control" name="from_date" id="from_date" required>
                    </div>
                    <!-- <div class="form-group">
											<label class="form-label">Date End</label>
											<input type="date" class="form-control" name="to_date" id="to_date">
										</div> -->
                    <div class="form-group">
                        <label class="form-label">Monthly Price (RM)</label>
                        <input type="text" class="form-control" name="to_price" id="to_price" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Insurance (RM)</label>
                        <input type="text" class="form-control" name="insurance" id="insurance">
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
                    <button type="submit" class="btn btn-primary" name="create">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>
<div id="editModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/customer/updateCard"> -->
            <form enctype="multipart/form-data" method="post">
                <input type="hidden" name="_token" value="fVXsMKMoXBBiLt6AAWzdiGvZsBa62PKKGG1LWxGX">
                <div class="modal-body pd-20">
                    <!-- <input type="text" class="form-control" name="card_id" id="card_id" required hidden> -->
                    <input type="text" class="form-control" name="id" id="card_id" required hidden>
                    <div class="form-group">
                        <label class="form-label">Date Start</label>
                        <!-- <input type="date" class="form-control" name="edit_from_date" id="edit_from_date" required> -->
                        <input type="date" class="form-control" name="from_date" id="edit_from_date" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date End</label>
                        <!-- <input type="date" class="form-control" name="edit_to_date" id="edit_to_date"> -->
                        <input type="date" class="form-control" name="to_date" id="edit_to_date">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Price (RM)</label>
                        <!-- <input type="text" class="form-control" name="edit_to_price" id="edit_to_price" required> -->
                        <input type="text" class="form-control" name="to_price" id="edit_to_price" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Insurance (RM)</label>
                        <!-- <input type="text" class="form-control" name="edit_insurance" id="edit_insurance"> -->
                        <input type="text" class="form-control" name="insurance" id="edit_insurance">
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
                    <button type="submit" class="btn btn-primary" name="create">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>
<div id="invoiceItemModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title">Edit Invoice Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/customer/editInvoiceItem"> -->
            <form enctype="multipart/form-data" method="post">
                <input type="hidden" name="_token" value="fVXsMKMoXBBiLt6AAWzdiGvZsBa62PKKGG1LWxGX">
                <div class="modal-body pd-20">
                    <input type="text" class="form-control" name="invoice_item_id" id="invoice_item_id" hidden>
                    <input type="text" class="form-control" name="to_priceee" id="to_priceee" hidden>
                    <div class="form-group">
                        <label class="form-label">Date Start</label>
                        <input type="date" class="form-control" name="date_from" id="date_from" required readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date End</label>
                        <input type="date" class="form-control" name="date_to" id="date_to" required>
                    </div>
                    <!-- <div class="form-group">
											<label class="form-label">No of days</label>
											<input type="number" class="form-control" name="no_of_days" id="no_of_days" required>
										</div>
										<div class="form-group">
											<label class="form-label">Price (RM)</label>
											<input type="number" step="0.01" class="form-control" name="price" id="price" required>
										</div> -->
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary"> -->
                    <button type="submit" class="btn btn-primary" name="edit-invoice">
                        Save changes
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>

<div id="caseModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title">Case Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/customer/caseCard"> -->
            <form enctype="multipart/form-data" method="post">
                <input type="hidden" name="_token" value="fVXsMKMoXBBiLt6AAWzdiGvZsBa62PKKGG1LWxGX">
                <div class="modal-body pd-20">
                    <input type="text" class="form-control" name="card_iddd" id="card_iddd" hidden>
                    <!-- <div class="form-group">
											<label class="form-label">Initial Cost (RM)</label>
											<input type="number" step="0.01" class="form-control" name="initial_cost" id="initial_cost" required>
										</div> -->
                    <div class="form-group">
                        <label class="form-label">Case Remarks</label>
                        <textarea class="form-control" name="case_remarks" id="case_remarks" required rows="5"></textarea>
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
                    <button type="submit" class="btn btn-primary" name="case">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>

<div id="payModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title">Edit Invoice Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/customer/pay_receive"> -->
            <form enctype="multipart/form-data" method="post">
                <input type="hidden" name="_token" value="fVXsMKMoXBBiLt6AAWzdiGvZsBa62PKKGG1LWxGX">
                <div class="modal-body pd-20">
                    <input type="text" class="form-control" name="customer_id" id="customer_id" hidden>
                    <div class="form-group">
                        <label class="form-label">Payment Date</label>
                        <input type="date" class="form-control" name="pay_date" id="pay_date" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pay For</label>
                        <input type="month" class="form-control" name="pay_for" id="pay_for" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Amount Pay (RM)</label>
                        <input type="number" step="0.01" class="form-control" name="amount" id="amount" required>
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
                    <button type="submit" class="btn btn-primary" name="pay">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>

<script>
    function openModal() {
        $("#largeModal").modal();

        $('select').select2();
    }

    function editModal(data) {
        console.log(data);
        $("#editModal").modal();
        document.getElementById("title").innerHTML = "Edit " + data.card_no;
        document.getElementById("card_id").value = data.id;
        document.getElementById("edit_from_date").value = data.from_date;
        document.getElementById("edit_to_date").value = data.to_date;
        document.getElementById("edit_to_price").value = data.to_price;
        document.getElementById("edit_insurance").value = data.insurance;
    }

    function editInvoiceItem(data) {
        /* alert(data);
        alert(JSON.stringify(data));
        alert(data.to_price); */

        $("#invoiceItemModal").modal();
        document.getElementById("invoice_item_id").value = data.id;
        document.getElementById("to_priceee").value = data.to_price;
        /* document.getElementById("date_from").value = data.date_from;
        document.getElementById("date_to").value = data.date_to; */
        document.getElementById("date_from").value = data.from_date;
        document.getElementById("date_to").value = data.to_date;
        var min = new Date(data.date_from);
        var lastDayOfMonth = new Date(min.getFullYear(), min.getMonth() + 1, 0);
        var yyyy = lastDayOfMonth.getFullYear();
        var mm = lastDayOfMonth.getMonth() + 1;
        var dd = lastDayOfMonth.getDate();
        var max = yyyy + '-' + padTo2Digits(mm) + '-' + padTo2Digits(dd);
        console.log(data.date_from);
        console.log(max);
        document.getElementById("date_to").min = data.date_from;
        document.getElementById("date_to").max = max;
        // document.getElementById("no_of_days").value=data.no_of_days;
        // document.getElementById("price").value=data.price;
    }

    function padTo2Digits(num) {
        return num.toString().padStart(2, '0');
    }

    function openPayModal(data) {
        $("#payModal").modal();
        document.getElementById("customer_id").value = data.id;
    }

    function caseModal(data) {
        $("#caseModal").modal();
        document.getElementById("card_iddd").value = data.id;
    }
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>