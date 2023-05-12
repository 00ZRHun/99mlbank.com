<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

// initialise variables
$path = $url . "/card/index.php";
// get upline from SESSION (index.php)
$upline = $_SESSION["upline"];
// $condition_upline = "upline = $upline";
$condition_created_by = "created_by = $upline";
$condition_cased = "rc.case_remarks IS NOT NULL AND rc.cased_by IS NOT NULL AND rc.cased_at IS NOT NULL";   // get cased card

// loop thru data to calculate data
// echo "<script>alert('Debug: HERE')</script>";   // D
$sql = "SELECT * FROM `card` WHERE $condition_created_by";
$result = mysqli_query($conn, $sql);

$total_cards = 0;
$total_cost = 0;
$approved_cards = 0;
$rent_count = 0;
$rent_cost = 0;
//if ($result->num_rows > 0) {
/* $row = $result->fetch_assoc();
    // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D */
// while ($row = $result->fetch_assoc()) {
while ($row = mysqli_fetch_array($result)) {
    // from db
    $price = $row['monthly_cost'];

    // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
    // echo "<script>alert('Debug: row['id'] = " . $row['id'] . "')</script>";   // D
    // $abc = $row['id'];
    $total_cards += 1;
    $total_cost += $price;   // TODO: resolve dummy data
    // $total_cost = $total_cost + $row['price'];   // TODO: resolve dummy data
    // $total_cost = ($price);   // TODO: resolve dummy data
    if ($row['status'] == 'Approved')   $approved_cards += 1;
    // if ($price > 0)   $rent_count += 1;   // TODO: resolve dummy data
    if ($price > 0)   $rent_count += 0;

    // $rent_cost += $price;   // TODO: resolve dummy data
    $rent_cost += 0;
}
//}
/*  else {   // redirect to current card page (if id is invalid)
    echo "<script>window.location.href='$path';</script>";   // ditto
} */
// echo "<script>alert('Debug: total_cards = $total_cards; total_cost = $total_cost; approved_cards = $approved_cards; rent_count = $rent_count; rent_cost = $rent_cost')</script>";   // D

// // get upline user name
// // $row['upline_name'] = "Master Admin";
// $user_id = $row['upline'];
// $sql = "SELECT * FROM `user` WHERE id = $user_id";
// $result = mysqli_query($conn, $sql);
// if ($result->num_rows > 0) {
//     $row_temp = $result->fetch_assoc();
//     $row['upline_name'] = $row_temp['name'];
//     // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
// } else {   // redirect to current card page (if id is invalid)
//     echo "<script>window.location.href='$path';</script>";   // ditto
// }


// create or edit card
if (isset($_POST['create'])) {
    echo "<script>alert('DEBUG: HERE -1';)</script>";   // D

    // get user input data
    $bank_id = $_POST['bank_id'];
    $card_name = $_POST['card_name'];
    $ic = $_POST['ic'];
    $online_user_id = $_POST['online_user_id'];
    $online_password = $_POST['online_password'];
    $atm_password = $_POST['atm_password'];
    $account_no = $_POST['account_no'];
    $otp_no = $_POST['otp_no'];
    $card_no = $_POST['card_no'];
    $address_of_bank = $_POST['address_of_bank'];
    $secure_word = $_POST['secure_word'];
    $gmail_of_bank = $_POST['gmail_of_bank'];
    // $home_address = $_POST['home_address'] != "" ? $_POST['home_address'] : NULL;
    // $home_address = isset($_POST['home_address']) ? $_POST['home_address'] : NULL;
    $home_address = $_POST['home_address'] ?? NULL;
    $mother_name = $_POST['mother_name'] ?? NULL;
    $token_key = $_POST['token_key'] ?? NULL;
    /* $home_address = trim($_POST['home_address']) === "" ? "NULL" : $_POST['home_address'];
    $mother_name = trim($_POST['mother_name']) === "" ? "NULL" : $_POST['mother_name'];
    $token_key = trim($_POST['token_key']) === "" ? "NULL" : $_POST['token_key']; */
    /* $home_address = empty($_POST['home_address']) ? "NULL" : $_POST['home_address'];
    $mother_name = empty($_POST['mother_name']) ? "NULL" : $_POST['mother_name'];
    $token_key = empty($_POST['token_key']) ? "NULL" : $_POST['token_key']; */
    $created_by = $_SESSION["upline"];
    $created_at = date('Y-m-d');

    /* echo "<script>alert('DEBUG: HERE';)</script>";   // D
    echo "<script>alert('home_address = $home_address')</script>";   // D
    // echo "<script>alert('" . $trim($_POST['home_addres s']) . "';)</script>";   // D
    echo "<script>alert('" . empty($_POST['home_address']) . "';)</script>";   // D
    echo "<script>alert('DEBUG: home_address = $home_address';)</script>";   // D */

    // if id empty, then create new card, else update old card
    $id = $_POST['card_id'];   // use to determine if CREATE or EDIT mode
    // echo "<script>alert('id = $id';)</script>";   // D
    $monthly_cost = 0;
    $status = 'Waiting for Approval';

    if ($id == "") {
        // echo "<script>alert('CREATE')</script>";   // D
        $sql = "INSERT INTO `card` (bank_id, card_name, ic, online_user_id, online_password, atm_password, account_no, otp_no, card_no, address_of_bank, secure_word, gmail_of_bank, home_address, mother_name, token_key, monthly_cost, status, created_by, created_at) 
            VALUES ($bank_id, '$card_name', '$ic', '$online_user_id', '$online_password', '$atm_password', '$account_no', '$otp_no', '$card_no', '$address_of_bank', '$secure_word', '$gmail_of_bank', '$home_address', '$mother_name', '$token_key', $monthly_cost, '$status', $created_by, '$created_at')";
        echo "<script>alert('-2) sql = $sql')</script>";
    } else {
        // echo "<script>alert('EDIT')</script>";   // D
        $sql = "UPDATE `card` SET bank_id = $bank_id, card_name = '$card_name', ic = '$ic', online_user_id = '$online_user_id', online_password = '$online_password', atm_password = '$atm_password', account_no = '$account_no', otp_no = '$otp_no', card_no = '$card_no', address_of_bank = '$address_of_bank', secure_word = '$secure_word', gmail_of_bank = '$gmail_of_bank', home_address = '$home_address', mother_name = '$mother_name', token_key = '$token_key', created_by = $created_by, created_at = '$created_at' WHERE id = $id";
    }

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Created successfully.')</script>";
    } else {
        echo "<script>alert('id = $id; bank_id = $bank_id; card_name = $card_name; ic = $ic; online_user_id = $online_user_id; online_password = $online_password; atm_password = $atm_password; account_no = $account_no; otp_no = $otp_no; card_no = $card_no; address_of_bank = $address_of_bank; secure_word = $secure_word; gmail_of_bank = $gmail_of_bank; home_address = $home_address; mother_name = $mother_name; token_key = $token_key; status = $status; created_by = $created_by; created_at = $created_at')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

// approve card
if (isset($_POST['approve'])) {
    // get required data
    $id = $_POST['card_idd'];
    $monthly_cost = $_POST['monthly_cost'];
    $status = "Approved";
    $approved_by = $_SESSION["upline"];
    $approved_at = date('Y-m-d');

    // update status
    $sql = "UPDATE `card` SET monthly_cost = $monthly_cost, status = '$status', approved_by = $approved_by, approved_at = '$approved_at' WHERE id = $id";
    /* echo "<script>alert('approve; id = $id; status = $status')</script>";   // D
    echo "<script>alert('sql = $sql')</script>"; */

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Status updated successfully.')</script>";
        echo "<script>window.location.replace('$path');</script>";
    } else {
        echo "<script>alert('DEBUG: id = $id; status = $status')</script>";   // D
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}
?>

<div class="page-header">
    <h4 class="page-title">Card</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"></a>Card Details</li>
        <li class="breadcrumb-item active" aria-current="page">cards</li>
    </ol>

</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Table List</div>
                <a class="btn btn-primary" onclick="openModal()" style="float:right;color:white">Create</a>
            </div>
            <!-- TODO: resolve dummy data -->
            <div class="card-body">
                <!-- TODO: Total Cost vs Rent Cost? -->
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2 ">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title" style="color:red">Total Cards</h3>
                            </div>
                            <div class="card-body ">
                                <h2 class="text-dark  mt-0 font-weight-bold"><?= $total_cards ?></h2> <!-- OPT: 3 -->
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title" style="color:purple">Total Cost</h3>
                            </div>
                            <div class="card-body ">

                                <h2 class="text-dark  mt-0 font-weight-bold">RM <?= $total_cost ?></h2> <!-- OPT: RM 505123 -->
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title" style="color:orange">Approved Cards</h3>
                            </div>
                            <div class="card-body ">
                                <h2 class="text-dark  mt-0 font-weight-bold"><?= $approved_cards ?></h2> <!-- OPT: 3 -->
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title" style="color:orange">Rent Count</h3>
                            </div>
                            <div class="card-body ">
                                <h2 class="text-dark  mt-0 font-weight-bold"><?= $rent_count ?></h2> <!-- OPT: 1 -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2 ">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title" style="color:blue">Rent Cost</h3>
                            </div>
                            <div class="card-body ">

                                <h2 class="text-dark  mt-0  font-weight-bold">RM <?= $rent_cost ?></h2> <!-- OPT: 316666.67 -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="hover table-bordered border-top-0 border-bottom-0">
                        <thead>
                            <tr>
                                <th>Card No</th>
                                <th>Card Owner Name</th>
                                <th>Card Owner IC</th>
                                <th>Bank</th>
                                <th>Price (RM)</th>
                                <th>Card Status</th>
                                <th>This Month Rent(RM)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- list cards -->
                            <?php
                            // $sql = "SELECT * FROM `card` as cd LEFT JOIN `bank` as bk ON cd.bank_id = bk.id";
                            // TODO: handle logic when has >1 record from rc (can rent aft rent)
                            $sql = "SELECT cd.id AS id, bk.id AS bank_id, bk.name AS name, cd.card_name AS card_name, cd.ic AS ic, cd.online_user_id AS online_user_id, cd.online_password AS online_password, cd.atm_password AS atm_password, cd.account_no AS account_no, cd.otp_no AS otp_no, cd.card_no AS card_no, cd.address_of_bank AS address_of_bank, cd.secure_word AS secure_word, cd.gmail_of_bank AS gmail_of_bank, cd.home_address AS home_address, cd.mother_name AS mother_name, cd.token_key AS token_key, 
                                cd.monthly_cost AS monthly_cost, cd.status AS status, 
                                rc.from_date AS from_date, rc.to_date AS to_date, rc.no_of_days AS no_of_days, rc.total AS total 
                                FROM `card` as cd 
                                LEFT JOIN `bank` as bk ON cd.bank_id = bk.id 
                                LEFT JOIN `rent_card` as rc ON cd.id = rc.card_id 
                                WHERE $condition_created_by AND NOT($condition_cased)";
                            /* echo "<script>alert('condition_created_by = $condition_created_by')</script>";   // D
                            echo "<script>alert('sql = $sql')</script>";   // D */
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                            ?>
                                    <tr>
                                        <td><?= $row['card_no'] ?></td>
                                        <td><?= $row['card_name'] ?></td>
                                        <td><?= $row['ic'] ?></td>
                                        <td><?= $row['name'] ?></td> <!-- TODO: chk how to do -> bk.name -->
                                        <!-- TODO: resolve dummy data -->
                                        <td><?= $row['monthly_cost'] ?></td>
                                        <!-- <td><b style='color:green'>Approved</b></td>
                                    <td><b style='color:orange'>Waiting for Approval</b></td> -->
                                        <td><b style='color:<?= $row['status'] == "Waiting for Approval" ? "orange" : "green" ?>'><?= $row['status'] ?></b></td>
                                        <td><?= $row['monthly_cost'] ?></td> <!-- TODO: rent price -->
                                        <td>
                                            <!-- <button class="btn btn-sm btn-info" onclick="rentModal('Masteradmin',[{&quot;id&quot;:1,&quot;card_id&quot;:1,&quot;year&quot;:2023,&quot;month&quot;:4,&quot;amount&quot;:316666.67,&quot;created_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;date_from&quot;:&quot;2023-04-12&quot;,&quot;date_to&quot;:&quot;2023-04-30&quot;,&quot;no_of_days&quot;:19,&quot;cost&quot;:500000,&quot;invoice_item_id&quot;:1,&quot;admin_cost&quot;:500000,&quot;admin_price&quot;:316666.67,&quot;agent_cost&quot;:500000,&quot;agent_price&quot;:316666.67}])"> -->
                                            <button class="btn btn-sm btn-info" onclick='rentModal("Masteradmin",<?= json_encode(array($row)) ?>)'>
                                                View Rent
                                            </button>
                                            <?php
                                            if ($row['status'] == "Waiting for Approval") {
                                            ?>
                                                <!-- <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:4,&quot;bank_id&quot;:1,&quot;card_name&quot;:&quot;1&quot;,&quot;ic&quot;:&quot;1&quot;,&quot;online_user_id&quot;:&quot;1&quot;,&quot;online_password&quot;:&quot;1&quot;,&quot;atm_password&quot;:&quot;1&quot;,&quot;account_no&quot;:&quot;1&quot;,&quot;otp_no&quot;:&quot;1&quot;,&quot;card_no&quot;:&quot;1&quot;,&quot;address_of_bank&quot;:&quot;1&quot;,&quot;secure_word&quot;:&quot;1&quot;,&quot;gmail_of_bank&quot;:&quot;1&quot;,&quot;token_key&quot;:null,&quot;from_who&quot;:1,&quot;from_price&quot;:null,&quot;to_who&quot;:null,&quot;to_price&quot;:null,&quot;is_approved&quot;:null,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-26T02:49:37.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-26T02:49:37.000000Z&quot;,&quot;from_date&quot;:null,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:null,&quot;approved_by&quot;:null,&quot;insurance&quot;:null,&quot;home_address&quot;:null,&quot;mother_name&quot;:null,&quot;superadmin_cost&quot;:null,&quot;admin_cost&quot;:null,&quot;agent_cost&quot;:null,&quot;bank&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;MBB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;},&quot;get_last_rent_pay&quot;:null,&quot;rent_pay&quot;:[]})"> -->
                                                <button class="btn btn-sm btn-info" onclick='editModal(<?= json_encode($row) ?>)'>
                                                    Edit
                                                </button>
                                                <!-- <button class="btn btn-sm btn-info" style="background-color:green" onclick="if(confirm('Are you sure you want to approve card?')){ approveModal({&quot;id&quot;:4,&quot;bank_id&quot;:1,&quot;card_name&quot;:&quot;1&quot;,&quot;ic&quot;:&quot;1&quot;,&quot;online_user_id&quot;:&quot;1&quot;,&quot;online_password&quot;:&quot;1&quot;,&quot;atm_password&quot;:&quot;1&quot;,&quot;account_no&quot;:&quot;1&quot;,&quot;otp_no&quot;:&quot;1&quot;,&quot;card_no&quot;:&quot;1&quot;,&quot;address_of_bank&quot;:&quot;1&quot;,&quot;secure_word&quot;:&quot;1&quot;,&quot;gmail_of_bank&quot;:&quot;1&quot;,&quot;token_key&quot;:null,&quot;from_who&quot;:1,&quot;from_price&quot;:null,&quot;to_who&quot;:null,&quot;to_price&quot;:null,&quot;is_approved&quot;:null,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-26T02:49:37.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-26T02:49:37.000000Z&quot;,&quot;from_date&quot;:null,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:null,&quot;approved_by&quot;:null,&quot;insurance&quot;:null,&quot;home_address&quot;:null,&quot;mother_name&quot;:null,&quot;superadmin_cost&quot;:null,&quot;admin_cost&quot;:null,&quot;agent_cost&quot;:null,&quot;bank&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;MBB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;},&quot;get_last_rent_pay&quot;:null,&quot;rent_pay&quot;:[]}) }"> -->
                                                <button class="btn btn-sm btn-info" style="background-color:green" onclick='if(confirm("Are you sure you want to approve card?")){ approveModal(<?= json_encode($row) ?>) }'>
                                                    Approve
                                                </button>
                                            <?php
                                            }
                                            ?>
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
        </div>
    </div>
</div>
<div id="largeModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold">Create Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/card/store"> -->
            <form enctype="multipart/form-data" method="post">
                <input type="hidden" name="_token" value="84KWmXSLFpmKezgSqIsfUD2nIpemJgaikK4hpnuW">
                <div class="modal-body pd-20">
                    <input type="text" class="form-control" name="card_id" id="card_id" hidden>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Bank</label>
                                <select class="form-control" id="bank_id" name="bank_id" required>
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
                                <input type="text" class="form-control" name="card_name" id="card_name" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">IC</label>
                                <input type="text" class="form-control" name="ic" id="ic" placeholder="Enter IC" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Online User ID</label>
                                <input type="text" class="form-control" name="online_user_id" id="online_user_id" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Online Password</label>
                                <input type="text" class="form-control" name="online_password" id="online_password" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Atm Password</label>
                                <input type="text" class="form-control" name="atm_password" id="atm_password" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Account No</label>
                                <input type="text" class="form-control" name="account_no" id="account_no" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">OTP No</label>
                                <input type="text" class="form-control" name="otp_no" id="otp_no" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Card No/Company ID</label>
                                <input type="text" class="form-control" name="card_no" id="card_no" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Address of Bank</label>
                                <input type="text" class="form-control" name="address_of_bank" id="address_of_bank" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Secure word</label>
                                <input type="text" class="form-control" name="secure_word" id="secure_word" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Gmail of Bank</label>
                                <input type="text" class="form-control" name="gmail_of_bank" id="gmail_of_bank" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Home Address</label>
                                <input type="text" class="form-control" name="home_address" id="home_address" placeholder="...">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Mother Name</label>
                                <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="...">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Company Name</label>
                                <input type="text" class="form-control" name="token_key" id="token_key" placeholder="...">
                            </div>
                        </div>
                        <!-- <div class="col-md-6 col-lg-6">
									<div class="form-group">
										<label class="form-label" for="exampleInputEmail1">Card Cost (RM)</label>
										<input type="text" class="form-control" name="from_price" id="from_price"  placeholder="..." >
									</div>
								</div> -->
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
<div id="approveModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title">Approve Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form enctype="multipart/form-data" method="post" action="<?= SITEURL ?>/card/setApprove"> -->
            <form enctype="multipart/form-data" method="post">
                <input type="hidden" name="_token" value="84KWmXSLFpmKezgSqIsfUD2nIpemJgaikK4hpnuW">
                <div class="modal-body pd-20">
                    <input type="text" class="form-control" name="card_idd" id="card_idd" hidden>
                    <!-- <div class="form-group">
								<label class="form-label">Initial Cost (RM)</label>
								<input type="number" step="0.01" class="form-control" name="initial_cost" id="initial_cost" required>
							</div> -->
                    <div class="form-group">
                        <label class="form-label">Monthly Cost (RM)</label>
                        <input type="number" step="0.01" class="form-control" name="monthly_cost" id="monthly_cost" required>
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary"> -->
                    <!-- <button type="submit" class="btn btn-primary" onclick="window.location.href='<?= $path ?>?approve=' + <?= $row['id'] ?> + '&monthly_cost='  + <?= $row['monthly_cost'] ?>"> -->
                    <button class="btn btn-primary" name="approve">
                        Save changes
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>

<div id="rentingModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title">Rent Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <div class="table-responsive">
                    <table id="example5" class="hover table-bordered border-top-0 border-bottom-0">
                        <thead>
                            <tr>
                                <th>From</th>
                                <th>To</th>
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
        document.getElementById("card_id").value = '';
        document.getElementById("bank_id").value = '';
        document.getElementById("card_name").value = '';
        document.getElementById("ic").value = '';
        document.getElementById("online_user_id").value = '';
        document.getElementById("online_password").value = '';
        document.getElementById("atm_password").value = '';
        document.getElementById("account_no").value = '';
        document.getElementById("otp_no").value = '';
        document.getElementById("card_no").value = '';
        document.getElementById("address_of_bank").value = '';
        document.getElementById("secure_word").value = '';
        document.getElementById("gmail_of_bank").value = '';
        document.getElementById("token_key").value = '';
        document.getElementById("mother_name").value = '';
        document.getElementById("home_address").value = '';
        //document.getElementById("from_price").value='';
    }

    function editModal(data) {
        // alert("DEBUG: data = " + JSON.stringify(data));

        $("#largeModal").modal();
        document.getElementById("card_id").value = data.id;
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
        document.getElementById("mother_name").value = data.mother_name;
        document.getElementById("home_address").value = data.home_address;
        //document.getElementById("from_price").value=data.from_price;
    }


    function approveModal(data) {
        $("#approveModal").modal();
        document.getElementById("card_idd").value = data.id;
        document.getElementById("monthly_cost").value = data.from_price;
    }



    function rentModal(role, data) {
        /* console.log(role);   // D
        alert(role);   // D
        alert(data);   // D
        alert(JSON.stringify(data));   // D */

        $("#rentingModal").modal();

        $('#items_details').empty();
        // TODO: handle logic when has >1 record from rc (can rent aft rent)
        data.forEach(function(row) {
            if (row.from_date != null) { // discard null data row
                var amount = row.amount;
                // TODO: role agent
                /* if (role == "Admins") {
                    amount = row.admin_price;
                }
                if (role == "Agents") {
                    amount = row.agent_price;
                } */
                amount = row.total;

                // OPT: row.date_from, row.date_to
                $('#items_details').append('<tr><td>' + row.from_date + '</td><td>' + row.to_date + '</td><td>' + row.no_of_days + '</td><td>' + amount + '</td></tr>');
            }
        });
    }
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>