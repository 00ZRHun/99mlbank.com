<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

// initialise variables
// $path = $url . "/bank/index.php";
// $user_id = $_GET['user'];
$user_id = $_SESSION['user_id'];
$path = $url . "/customer_view.php";
// TODO: double chk without prefix (eg. us, rc, bk) will cause err on MySql syntax
$condition_user_id = "user_id = $user_id";   // current user
// $condition_non_cased = "rc.case_remarks IS NULL AND rc.cased_by IS NULL AND rc.cased_at IS NULL";   // filter out cased card
$condition_cased = "rc.case_remarks IS NOT NULL AND rc.cased_by IS NOT NULL AND rc.cased_at IS NOT NULL";   // get cased card

///
///
///

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
    $total_invoice += $row['total'];
    $outstanding = $total_invoice - $total_payment;
    $all_outstanding = $outstanding;   // TODO: resolve dummy data

    /* echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
    echo "<script>alert('Debug: row['id'] = " . $row['id'] . "')</script>";   // D */
}
// loop thru data to calculate data END

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

<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Successfully Login</strong>
</div>



<?php
// === user details ===
/* echo "<script>alert('Debug: isset = " . isset($_SESSION['user_id']) . "')</script>";   // D
echo "<script>alert('Debug: user_id = " . $_SESSION['user_id'] . "')</script>";   // D */
if (isset($_SESSION['user_id'])) {
    // echo "<script>alert('Debug: user_id = $user_id')</script>";   // D

    // get single data - find user by id
    $sql = "SELECT * FROM `user` WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
    } else {
        echo "<script>window.location.href='$prev_path';</script>";   // ditto
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

    // echo "<script>alert('1) Debug: username = " . $row['username'] . "')</script>";   // D
}
// echo "<script>alert('2) Debug: username = " . $row['username'] . "')</script>";   // D
?>
<div class="page-header">
    <h4 class="page-title"><?= $row['username'] ?></h4> <!-- OPT: hihihi -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><?= $row['username'] ?></a></li> <!-- OPT: hihihi -->
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>

</div>

<div class="row">
    <div class="col-lg-5 col-xl-4">
        <!-- <div class="card card-profile cover-image " data-image-src="https://bankcardsample.system1906.com/assets/images/photos/gradient3.jpg"> -->
        <div class="card card-profile cover-image " data-image-src="<?= $url ?>/assets/images/photos/gradient3.jpg">
            <div class="card-body text-center">
                <!-- <img class="card-profile-img" src="https://bankcardsample.system1906.com/assets/images/star.jpg" alt="img"> -->
                <img class="card-profile-img" src="<?= $url ?>/assets/images/star.jpg" alt="img">
                <h3 class="mb-1 text-white"><?= $row['username'] ?></h3> <!-- OPT: hihihi -->
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
                                        <td><strong>Name :</strong> <?= $row['name'] ?></td> <!-- OPT: 1111 -->
                                    </tr>
                                    <tr>
                                        <td><strong>Contact No :</strong> <?= $row['contact'] ?></td> <!-- OPT: 111122 -->
                                    </tr>
                                    <tr>
                                        <td><strong>Username :</strong> <?= $row['username'] ?></td> <!-- OPT: hihihi -->
                                    </tr>
                                </tbody>
                                <tbody class="col-lg-12 col-xl-6 p-0">
                                    <tr>
                                        <td><strong>Role :</strong> <?= $row['role'] ?></td> <!-- OPT: Customer -->
                                    </tr>
                                    <tr>
                                        <td><strong>Status :</strong>
                                            <!-- <div class="btn btn-sm" style="background-color:green;color:white">Active</div> -->
                                            <div class="btn btn-sm" style="background-color:<?= $row['status'] == "Active" ? "green" : "red" ?>;color:white"><?= $row['status'] ?></div>
                                        </td>
                                    </tr>
                                    <tr>
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
                <input type="month" class="form-control" id="filter" name="filter" style="margin-right:10px" value="2023-05">
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
                            <h2 class="text-dark  mt-0 font-weight-bold"><?= $total_cards ?></h2> <!-- OPT: 2 -->
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:black">Total Card Price</h3>
                        </div>
                        <div class="card-body ">

                            <h2 class="text-dark  mt-0 font-weight-bold">RM <?= convert_to_2_decimal($total_card_price) ?></h2> <!-- OPT: 1111 -->
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:purple">Total Invoice</h3>
                        </div>
                        <div class="card-body ">

                            <h2 class="text-dark  mt-0 font-weight-bold">RM <?= convert_to_2_decimal($total_invoice) ?></h2> <!-- OPT: 188.42 -->
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:brown">Total Payment</h3>
                        </div>
                        <div class="card-body ">
                            <h2 class="text-dark  mt-0 font-weight-bold"><?= convert_to_2_decimal($total_payment) ?></h2> <!-- OPT: 201 -->
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:green">Outstanding</h3>
                        </div>
                        <div class="card-body ">
                            <h2 class="text-dark  mt-0 font-weight-bold"><?= convert_to_2_decimal($outstanding) ?></h2> <!-- OPT: -12.58 -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2 ">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:blue">All Outstanding</h3>
                        </div>
                        <div class="card-body ">

                            <h2 class="text-dark  mt-0  font-weight-bold">RM <?= convert_to_2_decimal($all_outstanding) ?></h2> <!-- OPT: -54.28 -->
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
                                                        Card Details
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Card No/Company ID</td>
                                                <td>MBB</td>
                                                <td>Name</td>
                                                <td>2023-05-04</td>
                                                <td>1000</td>
                                                <td>2000</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:3,&quot;bank_id&quot;:1,&quot;card_name&quot;:&quot;Name&quot;,&quot;ic&quot;:&quot;IC&quot;,&quot;online_user_id&quot;:&quot;Online User ID&quot;,&quot;online_password&quot;:&quot;Online Password&quot;,&quot;atm_password&quot;:&quot;Atm Password&quot;,&quot;account_no&quot;:&quot;Account No&quot;,&quot;otp_no&quot;:&quot;OTP No&quot;,&quot;card_no&quot;:&quot;Card No\/Company ID&quot;,&quot;address_of_bank&quot;:&quot;Address of Bank&quot;,&quot;secure_word&quot;:&quot;Secure word&quot;,&quot;gmail_of_bank&quot;:&quot;Gmail of Bank&quot;,&quot;token_key&quot;:&quot;Company Name&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:123,&quot;to_who&quot;:2,&quot;to_price&quot;:1000,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-25T15:24:07.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-05-04T13:29:47.000000Z&quot;,&quot;from_date&quot;:&quot;2023-05-04&quot;,&quot;to_date&quot;:&quot;2023-05-01&quot;,&quot;remarks&quot;:&quot;This is a case remark!&quot;,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-05-04&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:2000,&quot;home_address&quot;:&quot;Home Address&quot;,&quot;mother_name&quot;:&quot;Mother Name&quot;,&quot;superadmin_cost&quot;:123,&quot;admin_cost&quot;:123,&quot;agent_cost&quot;:123,&quot;bank&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;MBB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;}})">
                                                        Card Details
                                                    </button>
                                                </td>
                                            </tr> -->
                                            <!-- list rent_cards
                                            - filter customer's rent card
                                            - filter non-cased rent card -->
                                            <?php
                                            $sql = "SELECT rc.id AS id, rc.from_date AS from_date, rc.to_date AS to_date, rc.to_price AS to_price, rc.insurance AS insurance, rc.card_id AS card_id, 
                                                cd.card_no AS card_no, cd.bank_id AS bank_id, cd.card_name AS card_name, cd.ic AS ic, cd.online_user_id AS online_user_id, cd.online_password AS online_password, cd.atm_password AS atm_password, cd.account_no AS account_no, cd.otp_no AS otp_no, cd.address_of_bank AS address_of_bank, cd.secure_word AS secure_word, cd.gmail_of_bank AS gmail_of_bank, cd.token_key AS token_key, cd.monthly_cost AS from_price, cd.mother_name AS mother_name, cd.home_address AS home_address, 
                                                bk.name AS bank_name 
                                                FROM `rent_card` as rc 
                                                LEFT JOIN `card` as cd ON rc.card_id = cd.id 
                                                LEFT JOIN `bank` as bk ON cd.bank_id = bk.id 
                                                WHERE $condition_user_id AND not($condition_cased)";

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
                                                                Card Details
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
                            <div class="tab-pane" id="tab2">
                                <div class="table-responsive">
                                    <table id="example" class="hover table-bordered border-top-0 border-bottom-0">
                                        <thead>
                                            <tr>
                                                <th>Invoice No</th>
                                                <th>Month Year</th>
                                                <th>Total (RM)</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr>
                                                <td>20230500001</td>
                                                <td>May 2023</td>
                                                <td>188.42</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" onclick="editInvoiceItem([{&quot;id&quot;:2,&quot;invoice_id&quot;:2,&quot;card_id&quot;:3,&quot;date_from&quot;:&quot;2023-05-04&quot;,&quot;date_to&quot;:&quot;2023-05-27&quot;,&quot;no_of_days&quot;:24,&quot;cost&quot;:100,&quot;price&quot;:77.42,&quot;year&quot;:2023,&quot;month&quot;:5,&quot;created_at&quot;:&quot;2023-05-04T12:11:26.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-05-04T12:16:22.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;card_name&quot;:&quot;Name&quot;,&quot;bank_name&quot;:&quot;MBB&quot;,&quot;card_no&quot;:&quot;Card No\/Company ID&quot;,&quot;card&quot;:{&quot;id&quot;:3,&quot;bank_id&quot;:1,&quot;card_name&quot;:&quot;Name&quot;,&quot;ic&quot;:&quot;IC&quot;,&quot;online_user_id&quot;:&quot;Online User ID&quot;,&quot;online_password&quot;:&quot;Online Password&quot;,&quot;atm_password&quot;:&quot;Atm Password&quot;,&quot;account_no&quot;:&quot;Account No&quot;,&quot;otp_no&quot;:&quot;OTP No&quot;,&quot;card_no&quot;:&quot;Card No\/Company ID&quot;,&quot;address_of_bank&quot;:&quot;Address of Bank&quot;,&quot;secure_word&quot;:&quot;Secure word&quot;,&quot;gmail_of_bank&quot;:&quot;Gmail of Bank&quot;,&quot;token_key&quot;:&quot;Company Name&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:123,&quot;to_who&quot;:2,&quot;to_price&quot;:1000,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-25T15:24:07.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-05-04T13:29:47.000000Z&quot;,&quot;from_date&quot;:&quot;2023-05-04&quot;,&quot;to_date&quot;:&quot;2023-05-01&quot;,&quot;remarks&quot;:&quot;This is a case remark!&quot;,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-05-04&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:2000,&quot;home_address&quot;:&quot;Home Address&quot;,&quot;mother_name&quot;:&quot;Mother Name&quot;,&quot;superadmin_cost&quot;:123,&quot;admin_cost&quot;:123,&quot;agent_cost&quot;:123,&quot;bank&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;MBB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;}}},{&quot;id&quot;:3,&quot;invoice_id&quot;:2,&quot;card_id&quot;:1,&quot;date_from&quot;:&quot;2023-05-01&quot;,&quot;date_to&quot;:&quot;2023-05-31&quot;,&quot;no_of_days&quot;:31,&quot;cost&quot;:111,&quot;price&quot;:111,&quot;year&quot;:2023,&quot;month&quot;:5,&quot;created_at&quot;:&quot;2023-05-04T12:16:45.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-05-04T12:16:45.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;bank_name&quot;:&quot;RHB&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;card&quot;:{&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;}}}])">
                                                        View Invoice
                                                    </button>
                                                </td>
                                            </tr> -->

                                            <!-- list invoices -->
                                            <?php
                                            /* $sql = "SELECT rc.id AS id, rc.invoice_no AS invoice_no, rc.from_date AS from_date, rc.to_date AS to_date, rc.to_price AS to_price, rc.no_of_days AS no_of_days, rc.total AS total, 
                                                cd.card_no AS card_no, cd.card_name AS card_name, 
                                                bk.name AS bank_name 
                                                FROM `rent_card` as rc 
                                                LEFT JOIN `card` as cd ON rc.card_id = cd.id 
                                                LEFT JOIN `bank` as bk ON cd.bank_id = bk.id 
                                                WHERE $condition_user_id AND rc.invoice_no IS NOT NULL 
                                                AND NOT($condition_cased)"; */
                                            /* rc.id AS id, rc.from_date AS from_date, rc.to_date AS to_date, rc.to_price AS to_price, rc.no_of_days AS no_of_days, rc.total AS total, 
                                                cd.card_no AS card_no, cd.card_name AS card_name, 
                                                bk.name AS bank_name  */
                                            // $sql = "SELECT rc.invoice_no AS invoice_no, YEAR(rc.from_date) MONTH(rc.from_date) AS month_year, SUM(total) as total 
                                            $sql = "SELECT rc.invoice_no AS invoice_no, YEAR(rc.from_date) as year, MONTH(rc.from_date) AS month, SUM(total) as total 
                                                FROM `rent_card` as rc 
                                                WHERE $condition_user_id AND rc.invoice_no IS NOT NULL 
                                                AND not($condition_cased) 
                                                GROUP BY invoice_no, YEAR(rc.from_date), MONTH(rc.from_date)";
                                            // echo "<script>alert('sql = $sql')</script>";   // D
                                            $result = mysqli_query($conn, $sql);
                                            if ($result->num_rows > 0) {

                                                /* list rent_cards
                                                - filter customer's rent card
                                                - filter non-cased rent card */
                                                $sql_all = "SELECT rc.id AS id, rc.from_date AS from_date, rc.to_date AS to_date, rc.to_price AS to_price, rc.insurance AS insurance, rc.card_id AS card_id, rc.no_of_days AS no_of_days, rc.total AS total, rc.invoice_no AS invoice_no, 
                                                    cd.card_no AS card_no, cd.bank_id AS bank_id, cd.card_name AS card_name, cd.ic AS ic, cd.online_user_id AS online_user_id, cd.online_password AS online_password, cd.atm_password AS atm_password, cd.account_no AS account_no, cd.otp_no AS otp_no, cd.address_of_bank AS address_of_bank, cd.secure_word AS secure_word, cd.gmail_of_bank AS gmail_of_bank, cd.token_key AS token_key, cd.monthly_cost AS from_price, cd.mother_name AS mother_name, cd.home_address AS home_address, 
                                                    bk.name AS bank_name 
                                                    FROM `rent_card` as rc 
                                                    LEFT JOIN `card` as cd ON rc.card_id = cd.id 
                                                    LEFT JOIN `bank` as bk ON cd.bank_id = bk.id 
                                                    WHERE $condition_user_id AND not($condition_cased)";

                                                // echo "<script>alert('sql = $sql')</script>";   // D
                                                $result_all = mysqli_query($conn, $sql_all);
                                                // $result_all = mysqli_query($conn, $sql_all)->fetch_object();
                                                while ($row_all = $result_all->fetch_array(MYSQLI_BOTH)) {
                                                    $user_data[] = $row_all;
                                                }

                                                while ($row = $result->fetch_assoc()) {
                                                    // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D

                                                    // get 'Month Year'
                                                    $day = 1;
                                                    // $time = strtotime("$day/$row['month']/$row['year']")   // NOT WORK
                                                    // $row['year'] . ' ' . $row['month']
                                                    $date = strtotime($day . '/' . $row['month'] . '/' . $row['year']);
                                                    // $row['month_year'] = date('Y Mon', $date);
                                                    // $row['month_year'] = date('Y Mon', $date);
                                                    $row['month_year'] = date('M y', $date);
                                            ?>
                                                    <tr>
                                                        <td><?= $row['invoice_no'] ?></td>
                                                        <td><?= $row['month_year'] ?></td>
                                                        <td><?= $row['total'] ?></td>
                                                        <td>
                                                            <!-- <button class="btn btn-sm btn-info" onclick="editInvoiceItem([{&quot;id&quot;:2,&quot;invoice_id&quot;:2,&quot;card_id&quot;:3,&quot;date_from&quot;:&quot;2023-05-04&quot;,&quot;date_to&quot;:&quot;2023-05-27&quot;,&quot;no_of_days&quot;:24,&quot;cost&quot;:100,&quot;price&quot;:77.42,&quot;year&quot;:2023,&quot;month&quot;:5,&quot;created_at&quot;:&quot;2023-05-04T12:11:26.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-05-04T12:16:22.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;card_name&quot;:&quot;Name&quot;,&quot;bank_name&quot;:&quot;MBB&quot;,&quot;card_no&quot;:&quot;Card No\/Company ID&quot;,&quot;card&quot;:{&quot;id&quot;:3,&quot;bank_id&quot;:1,&quot;card_name&quot;:&quot;Name&quot;,&quot;ic&quot;:&quot;IC&quot;,&quot;online_user_id&quot;:&quot;Online User ID&quot;,&quot;online_password&quot;:&quot;Online Password&quot;,&quot;atm_password&quot;:&quot;Atm Password&quot;,&quot;account_no&quot;:&quot;Account No&quot;,&quot;otp_no&quot;:&quot;OTP No&quot;,&quot;card_no&quot;:&quot;Card No\/Company ID&quot;,&quot;address_of_bank&quot;:&quot;Address of Bank&quot;,&quot;secure_word&quot;:&quot;Secure word&quot;,&quot;gmail_of_bank&quot;:&quot;Gmail of Bank&quot;,&quot;token_key&quot;:&quot;Company Name&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:123,&quot;to_who&quot;:2,&quot;to_price&quot;:1000,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-25T15:24:07.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-05-04T13:29:47.000000Z&quot;,&quot;from_date&quot;:&quot;2023-05-04&quot;,&quot;to_date&quot;:&quot;2023-05-01&quot;,&quot;remarks&quot;:&quot;This is a case remark!&quot;,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-05-04&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:2000,&quot;home_address&quot;:&quot;Home Address&quot;,&quot;mother_name&quot;:&quot;Mother Name&quot;,&quot;superadmin_cost&quot;:123,&quot;admin_cost&quot;:123,&quot;agent_cost&quot;:123,&quot;bank&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;MBB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;}}},{&quot;id&quot;:3,&quot;invoice_id&quot;:2,&quot;card_id&quot;:1,&quot;date_from&quot;:&quot;2023-05-01&quot;,&quot;date_to&quot;:&quot;2023-05-31&quot;,&quot;no_of_days&quot;:31,&quot;cost&quot;:111,&quot;price&quot;:111,&quot;year&quot;:2023,&quot;month&quot;:5,&quot;created_at&quot;:&quot;2023-05-04T12:16:45.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-05-04T12:16:45.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;bank_name&quot;:&quot;RHB&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;card&quot;:{&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;}}}])"> -->
                                                            <button class="btn btn-sm btn-info" onclick='editInvoiceItem(<?= json_encode($user_data) ?>, <?= $row["invoice_no"] ?>)'>
                                                                View Invoice
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
                                <div class="table-responsive">
                                    <table id="example3" class="hover table-bordered border-top-0 border-bottom-0">
                                        <thead>
                                            <tr>
                                                <th>Payment Date</th>
                                                <th>Pay for</th>
                                                <th>Amount (RM)</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr>
                                                <td>2023-05-08</td>
                                                <td>May 2023</td>
                                                <td>1</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>2023-05-08</td>
                                                <td>May 2023</td>
                                                <td>200</td>
                                                <td></td>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr>
                                                <td>Name</td>
                                                <td>Card No/Company ID</td>
                                                <td>MBB</td>
                                                <td>2023-05-04 20:20:36</td>
                                                <td>This is a case remark!</td>
                                            </tr> -->

                                            <!-- list cased rent card  -->
                                            <?php
                                            $sql = "SELECT rc.id AS id, rc.case_remarks AS case_remarks, rc.cased_at AS cased_at, 
                                                cd.card_no AS card_no, cd.card_name AS card_name, 
                                                bk.name AS bank_name 
                                                FROM `rent_card` as rc 
                                                LEFT JOIN `card` as cd ON rc.card_id = cd.id 
                                                LEFT JOIN `bank` as bk ON cd.bank_id = bk.id 
                                                WHERE $condition_user_id AND 
                                                rc.case_remarks IS NOT NULL AND rc.cased_by IS NOT NULL AND rc.cased_at IS NOT NULL";

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
                                                    </tr>
                                            <?php
                                                }
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
        </div>
    </div>
</div>
<div id="editModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Bank</label>
                            <select class="form-control" id="bank_id" name="bank_id" disabled>
                                <!-- <option value="1">MBB</option>
                                <option value="2">PBB</option>
                                <option value="3">CIMB</option>
                                <option value="4">HLB</option>
                                <option value="5">RHB</option>
                                <option value="6">BSN</option>
                                <option value="7">AMBANK</option>
                                <option value="8">MBB COMPANY</option>
                                <option value="9">RHB COMPANY</option>
                                <option value="10">HLB COMPANY</option>
                                <option value="11">CIMB COMPANY</option>
                                <option value="12">BSN COMPANY</option>
                                <option value="13">AMBANK COMPANY</option>
                                <option value="14">PBB COMPANY</option>
                                <option value="15">CIMB COMPANY TNG+DUITNOW</option>
                                <option value="16">CIMB CREDIT CARD</option>
                                <option value="17">HLB CREDIT CARD</option>
                                <option value="18">ARGO COMPANY</option>
                                <option value="19">ARGO</option>
                                <option value="20">UOB COMPANY</option>
                                <option value="21">MBB TNG</option>
                                <option value="22">ALLIANCE BANK</option> -->
                                <!-- list banks -->
                                <?php
                                $sql = "SELECT * FROM `bank`";
                                // echo "<script>alert('sql = $sql')</script>";   // D
                                $result = mysqli_query($conn, $sql);
                                if ($result->num_rows > 0) {
                                    $count = 0;   // TODO: remove var & its usage

                                    while ($row = $result->fetch_assoc()) {
                                        /* echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                                                    echo "<script>alert('Debug: username = " . $row["username"] . "')</script>";   // D */
                                ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" name="card_name" id="card_name" placeholder="Enter Name" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">IC</label>
                            <input type="text" class="form-control" name="ic" id="ic" placeholder="Enter IC" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Online User ID</label>
                            <input type="text" class="form-control" name="online_user_id" id="online_user_id" placeholder="..." readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Online Password</label>
                            <input type="text" class="form-control" name="online_password" id="online_password" placeholder="..." readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Atm Password</label>
                            <input type="text" class="form-control" name="atm_password" id="atm_password" placeholder="..." readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Account No</label>
                            <input type="text" class="form-control" name="account_no" id="account_no" placeholder="..." readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">OTP No</label>
                            <input type="text" class="form-control" name="otp_no" id="otp_no" placeholder="..." readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Card No/Company ID</label>
                            <input type="text" class="form-control" name="card_no" id="card_no" placeholder="..." readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Address of Bank</label>
                            <input type="text" class="form-control" name="address_of_bank" id="address_of_bank" placeholder="..." readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Secure word</label>
                            <input type="text" class="form-control" name="secure_word" id="secure_word" placeholder="..." readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Gmail of Bank</label>
                            <input type="text" class="form-control" name="gmail_of_bank" id="gmail_of_bank" placeholder="..." readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Home Address</label>
                            <input type="text" class="form-control" name="home_address" id="home_address" placeholder="..." readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Mother Name</label>
                            <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="..." readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="exampleInputEmail1">Company Name</label>
                            <input type="text" class="form-control" name="token_key" id="token_key" placeholder="..." readonly>
                        </div>
                    </div>
                </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div>
<div id="invoiceItemModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title">Invoice Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">

                <div class="table-responsive">
                    <table id="example5" class="hover table-bordered border-top-0 border-bottom-0">
                        <thead>
                            <tr>
                                <th>Card No</th>
                                <th>Bank</th>
                                <th>Card Name</th>
                                <th>Date From</th>
                                <th>Date To</th>
                                <th>Monthly (RM)</th>
                                <th>No of Days</th>
                                <th>Amount (RM)</th>
                            </tr>
                        </thead>
                        <tbody id="items_details">
                        </tbody>
                    </table>
                </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div>

<script>
    function openModal() {
        $("#largeModal").modal();
    }

    function editModal(data) {
        console.log(data);
        $("#editModal").modal();
        document.getElementById("title").innerHTML = data.card_no;
        document.getElementById("bank_id").value = data.bank_id;
        document.getElementById("card_name").value = data.card_name;
        document.getElementById("ic").value = data.ic;
        document.getElementById("online_user_id").value = data.online_user_id;
        document.getElementById("online_password").value = data.online_password;
        document.getElementById("atm_password").value = data.atm_password;
        document.getElementById("account_no").value = data.account_no;
        document.getElementById("otp_no").value = data.otp_no;
        document.getElementById("card_no").value = data.card_no;
        document.getElementById("address_of_bank").value = data.address_of_bank;
        document.getElementById("secure_word").value = data.secure_word;
        document.getElementById("gmail_of_bank").value = data.gmail_of_bank;
        document.getElementById("token_key").value = data.token_key;
        document.getElementById("from_price").value = data.from_price;
        document.getElementById("mother_name").value = data.mother_name;
        document.getElementById("home_address").value = data.home_address;
    }

    function editInvoiceItem(data, invoice_no) {
        /* alert(data);   // D
        alert(JSON.stringify(data));   // D
        alert(invoice_no);   // D */

        $("#invoiceItemModal").modal();
        // console.log(data);   // D
        $('#items_details').empty();
        data.forEach(function(row) {
            /* alert(row.invoice_no);   // D
            alert(invoice_no == row.invoice_no);   // D */
            if (row.invoice_no == invoice_no)
                // OPT: row.date_from, row.date_to, row.cost, row.price
                $('#items_details').append('<tr><td>' + row.card_no + '</td><td>' + row.bank_name + '</td><td>' + row.card_name + '</td><td>' + row.from_date + '</td><td>' + row.to_date + '</td><td>' + row.to_price + '</td><td>' + row.no_of_days + '</td><td>' + row.total + '</td></tr>');
        });
    }
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>