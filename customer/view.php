<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

if (isset($_GET['user'])) {
    $user_id = $_GET['user'];
    // echo "<script>alert('Debug: user_id = $user_id')</script>";   // D

    // get single data - find user by id
    $sql = "SELECT * FROM `user` WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
    } else {
        echo "<script>window.location.href='$url/user/index/Superadmins/index.php';</script>";   // ditto
    }

    // get upline user name
    // $row['upline_name'] = "Master Admin";
    $user_id = $row['upline'];
    $sql = "SELECT * FROM `user` WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row_temp = $result->fetch_assoc();
        $row['upline_name'] = $row_temp['name'];
        // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
    } else {   // redirect to prev user-management page (if id is invalid)
        echo "<script>window.location.href='$url/user/index/Superadmins/index.php';</script>";   // ditto
    }
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
        <div class="card card-profile cover-image " data-image-src="https://bankcardsample.system1906.com/assets/images/photos/gradient3.jpg">
            <div class="card-body text-center">
                <img class="card-profile-img" src="https://bankcardsample.system1906.com/assets/images/star.jpg" alt="img">
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
                            <h2 class="text-dark  mt-0 font-weight-bold">1</h2>
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:black">Total Card Price</h3>
                        </div>
                        <div class="card-body ">

                            <h2 class="text-dark  mt-0 font-weight-bold">RM 111</h2>
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:purple">Total Invoice</h3>
                        </div>
                        <div class="card-body ">

                            <h2 class="text-dark  mt-0 font-weight-bold">RM 70.3</h2>
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:brown">Total Payment</h3>
                        </div>
                        <div class="card-body ">
                            <h2 class="text-dark  mt-0 font-weight-bold">111</h2>
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:green">Outstanding</h3>
                        </div>
                        <div class="card-body ">
                            <h2 class="text-dark  mt-0 font-weight-bold">-40.7</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2 ">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:blue">All Outstanding</h3>
                        </div>
                        <div class="card-body ">

                            <h2 class="text-dark  mt-0  font-weight-bold">RM -40.7</h2>
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
                                            <tr>
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
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <a class="btn btn-info" style="float:right;color:white;margin-bottom:10px" onclick="if(confirm('Are you sure you want to generate invoice?')){ window.location.href='https://bankcardsample.system1906.com/customer/generateInvoice/2' }">Generate</a>
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
                                            <tr>
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
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3">
                                <a class="btn btn-info" onclick="openPayModal({&quot;id&quot;:2,&quot;name&quot;:&quot;1111&quot;,&quot;username&quot;:&quot;<?= $row['username'] ?>&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Customer&quot;,&quot;contact_no&quot;:&quot;111122&quot;,&quot;upline&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:25:14.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:25:37.000000Z&quot;,&quot;customer_cards&quot;:[{&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;}}],&quot;invoices&quot;:[{&quot;id&quot;:1,&quot;invoice_no&quot;:&quot;20230400001&quot;,&quot;customer_id&quot;:2,&quot;year&quot;:2023,&quot;month&quot;:4,&quot;created_at&quot;:&quot;2023-04-11T01:26:05.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:26:05.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;items&quot;:[{&quot;id&quot;:1,&quot;invoice_id&quot;:1,&quot;card_id&quot;:1,&quot;date_from&quot;:&quot;2023-04-12&quot;,&quot;date_to&quot;:&quot;2023-04-30&quot;,&quot;no_of_days&quot;:19,&quot;cost&quot;:111,&quot;price&quot;:70.3,&quot;year&quot;:2023,&quot;month&quot;:4,&quot;created_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;card&quot;:{&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;}}}]}],&quot;payments&quot;:[{&quot;id&quot;:1,&quot;customer_id&quot;:2,&quot;pay_date&quot;:&quot;2023-04-12&quot;,&quot;amount&quot;:111,&quot;month&quot;:&quot;4&quot;,&quot;year&quot;:&quot;2023&quot;,&quot;remarks&quot;:null,&quot;created_at&quot;:&quot;2023-04-11T01:42:17.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:42:17.000000Z&quot;,&quot;deleted_at&quot;:null}],&quot;upline_dt&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;Master Admin&quot;,&quot;username&quot;:&quot;masteradmin&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Masteradmin&quot;,&quot;contact_no&quot;:null,&quot;upline&quot;:null,&quot;is_active&quot;:1,&quot;created_at&quot;:null,&quot;updated_at&quot;:&quot;2023-04-13T20:15:19.000000Z&quot;}})" style="float:right;color:white;margin-bottom:10px">Pay</a>
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
                                            <tr>
                                                <td>2023-04-12</td>
                                                <td>April 2023</td>
                                                <td>111</td>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete payment?')){ window.location.href='https://bankcardsample.system1906.com/customer/destroyPayment/1' }">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
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
<div id="largeModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold">Assign Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/customer/storeCard/2">
                <input type="hidden" name="_token" value="fVXsMKMoXBBiLt6AAWzdiGvZsBa62PKKGG1LWxGX">
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <label class="form-label" for="exampleInputEmail1">Card</label>
                        <select class="form-control" name="select_card" id="select_card" required>
                            <option value="">-- Choose Card --</option>
                            <option value="2">
                                Am Card - AMBANK COMPANY
                            </option>
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
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/customer/updateCard">
                <input type="hidden" name="_token" value="fVXsMKMoXBBiLt6AAWzdiGvZsBa62PKKGG1LWxGX">
                <div class="modal-body pd-20">
                    <input type="text" class="form-control" name="card_id" id="card_id" required hidden>
                    <div class="form-group">
                        <label class="form-label">Date Start</label>
                        <input type="date" class="form-control" name="edit_from_date" id="edit_from_date" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date End</label>
                        <input type="date" class="form-control" name="edit_to_date" id="edit_to_date">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Price (RM)</label>
                        <input type="text" class="form-control" name="edit_to_price" id="edit_to_price" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Insurance (RM)</label>
                        <input type="text" class="form-control" name="edit_insurance" id="edit_insurance">
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/customer/editInvoiceItem">
                <input type="hidden" name="_token" value="fVXsMKMoXBBiLt6AAWzdiGvZsBa62PKKGG1LWxGX">
                <div class="modal-body pd-20">
                    <input type="text" class="form-control" name="invoice_item_id" id="invoice_item_id" hidden>
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
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/customer/caseCard">
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
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/customer/pay_receive">
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
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
        $("#invoiceItemModal").modal();
        document.getElementById("invoice_item_id").value = data.id;
        document.getElementById("date_from").value = data.date_from;
        document.getElementById("date_to").value = data.date_to;
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