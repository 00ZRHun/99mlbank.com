<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

if (isset($_GET['user'])) {
    $user_id = $_GET['user'];
    // echo "<script>alert('Debug: user_id = $user_id')</script>";   // D

    // get single data - find user by id
    $sql = "SELECT * FROM users WHERE id = $user_id";
    // $search_query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        /* while ($row = $result->fetch_assoc()) {
            echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
            echo "<script>alert('Debug: username = " . $row['username'] . "')</script>";   // D
            
            echo $row["username"];
        } */

        $row = $result->fetch_assoc();
        $name = $row["name"];
        $contact = $row["contact"];
        $username = $row["username"];
        $role = $row["role"];
        $upline = $row["upline"];
        $status = $row["status"];
        // echo "<script>alert('Debug: username = $username')</script>";   // D
    }
}
?>
<?= $row["username"] ?>

<div class="page-header">
    <!--  -->
    <h4 class="page-title"><?= $username ?></h4> <!-- OPT: admin111 -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><?= $username ?></a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>

</div>

<div class="row">
    <div class="col-lg-5 col-xl-4">
        <div class="card card-profile cover-image " data-image-src="https://bankcardsample.system1906.com/assets/images/photos/gradient3.jpg">
            <div class="card-body text-center">
                <img class="card-profile-img" src="https://bankcardsample.system1906.com/assets/images/star.jpg" alt="img">
                <h3 class="mb-1 text-white"><?= $username ?></h3>
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
                                        <td><strong>Name :</strong> <?= $name ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Contact No :</strong> <?= $contact ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Username :</strong> <?= $username ?></td>
                                    </tr>
                                </tbody>
                                <tbody class="col-lg-12 col-xl-6 p-0">
                                    <tr>
                                        <td><strong>Role :</strong> <?= $role ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Upline :</strong> <?= $upline ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status :</strong>
                                            <div class="btn btn-sm" style="background-color:<?= $status == "Active" ? "green" : "red" ?>;color:white"><?= $status ?></div>
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
    <!-- TODO: resolve dummy data START -->
    <div class="col-lg-12 col-xl-12">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2 ">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:red">Total Cards <br>(Teams)</h3>
                        </div>
                        <div class="card-body ">
                            <h2 class="text-dark  mt-0 font-weight-bold">0</h2>
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:orange">Rent / Approved<br>(Teams)</h3>
                        </div>
                        <div class="card-body ">
                            <h2 class="text-dark  mt-0 font-weight-bold">0/0</h2>
                        </div>
                    </div>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:purple">Approved Cost <br>(12122)</h3>
                        </div>
                        <div class="card-body ">

                            <h2 class="text-dark  mt-0 font-weight-bold">RM 0</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2 ">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h3 class="card-title" style="color:blue">Approved Cost <br>(Teams)</h3>
                        </div>
                        <div class="card-body ">

                            <h2 class="text-dark  mt-0  font-weight-bold">RM 0</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Admins</h3>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="hover table-bordered border-top-0 border-bottom-0">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Approved Card</th>
                                <th>Rent Card</th>
                                <th>Rent Cost</th>
                                <th>Status</th>
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
    <div class="col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cards Details</h3>

            </div>
            <div class="card-body">
                <div class="panel panel-primary">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu ">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class=""><a href="#tab1" class="active" data-toggle="tab">Approved</a></li>
                                <li><a href="#tab2" data-toggle="tab">Others</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            <div class="tab-pane active " id="tab1">
                                <div class="table-responsive">
                                    <table id="example" class="hover table-bordered border-top-0 border-bottom-0">
                                        <thead>
                                            <tr>
                                                <th>Card No</th>
                                                <th>Card Owner Name</th>
                                                <th>Card Owner IC</th>
                                                <th>Bank</th>
                                                <th>Monthly (RM)</th>
                                                <th>Price This Month (RM)</th>
                                                <th>Card Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <div class="table-responsive">
                                    <table id="example3" class="hover table-bordered border-top-0 border-bottom-0">
                                        <thead>
                                            <tr>
                                                <th>Card No</th>
                                                <th>Card Owner Name</th>
                                                <th>Card Owner IC</th>
                                                <th>Bank</th>
                                                <th>Monthly (RM)</th>
                                                <th>Price This Month (RM)</th>
                                                <th>Card Status</th>
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
    <!-- TODO: resolve dummy data END -->
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
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/card/store">
                <input type="hidden" name="_token" value="9B3G2dwuUKn73RAbFXEmH43EsCyyg3ylJzuxxmjP">
                <div class="modal-body pd-20">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <input type="text" class="form-control" name="card_id" id="card_id" hidden>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Bank</label>
                                <select class="form-control" id="bank_id" name="bank_id" required>
                                    <option value="1">MBB</option>
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
                                    <option value="22">ALLIANCE BANK</option>
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
                    <button type="submit" class="btn btn-primary" id="button_submit">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>
<div id="secondlargeModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold">Create Admins</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/user/store">
                <input type="hidden" name="_token" value="9B3G2dwuUKn73RAbFXEmH43EsCyyg3ylJzuxxmjP">
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_id" id="user_id" hidden>
                        <input type="text" class="form-control" name="role" id="role" value="Admins" hidden>
                        <label class="form-label" for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="exampleInputEmail1">Contact No</label>
                        <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Enter Contact No" required>
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
<div id="approveModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title">Approve Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/card/setApprove">
                <input type="hidden" name="_token" value="9B3G2dwuUKn73RAbFXEmH43EsCyyg3ylJzuxxmjP">
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
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>
<div id="CostModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title">Set Card Cost</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/card/setCost">
                <input type="hidden" name="_token" value="9B3G2dwuUKn73RAbFXEmH43EsCyyg3ylJzuxxmjP">
                <div class="modal-body pd-20">
                    <input type="text" class="form-control" name="card_iddd" id="card_iddd" hidden>
                    <div class="form-group">
                        <label class="form-label">Monthly Cost (RM)</label>
                        <input type="number" step="0.01" class="form-control" name="set_cost" id="set_cost" required>
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Set</button>
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
                                <th>Month</th>
                                <th>Amount (RM)</th>
                                <th></th>
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
    function editModal(data) {
        console.log(data);
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
        document.getElementById("from_price").value = data.from_price;
        document.getElementById("mother_name").value = data.mother_name;
        document.getElementById("home_address").value = data.home_address;
        //document.getElementById("from_price").value=data.from_price;
        if (data.is_approved == 1) {
            document.getElementById("bank_id").disabled = true;
            document.getElementById("card_name").readOnly = true;
            document.getElementById("ic").readOnly = true;
            document.getElementById("online_user_id").readOnly = true;
            document.getElementById("online_password").readOnly = true;
            document.getElementById("atm_password").readOnly = true;
            document.getElementById("account_no").readOnly = true;
            document.getElementById("otp_no").readOnly = true;
            document.getElementById("card_no").readOnly = true;
            document.getElementById("address_of_bank").readOnly = true;
            document.getElementById("secure_word").readOnly = true;
            document.getElementById("gmail_of_bank").readOnly = true;
            document.getElementById("token_key").readOnly = true;
            //document.getElementById("from_price").readOnly=true;
            document.getElementById("button_submit").hidden = true;
            document.getElementById("mother_name").readOnly = true;
            document.getElementById("home_address").readOnly = true;
        }
    }

    function editUserModal(data) {
        $("#secondlargeModal").modal();
        document.getElementById("user_id").value = data.id;
        document.getElementById("role").value = data.role;
        document.getElementById("username").value = data.username;
        document.getElementById("username").readOnly = true;
        document.getElementById("name").value = data.name;
        document.getElementById("contact_no").value = data.contact_no;

    }


    function approveModal(data) {
        $("#approveModal").modal();
        document.getElementById("card_idd").value = data.id;
        document.getElementById("monthly_cost").value = data.from_price;
    }


    function setCostModal(data) {
        $("#CostModal").modal();
        document.getElementById("card_iddd").value = data.id;
    }

    function viewRent(role, data) {
        var date_selected = "2023-04";
        const myArray = date_selected.split("-");
        var year = myArray[0];
        var month = parseInt(myArray[1]);
        console.log(month);
        $("#rentingModal").modal();

        $('#items_details').empty();
        data.forEach(function(row) {
            if (row.year == year && row.month == month) {
                var amount = row.amount;
                if (role == "Admins") {
                    amount = row.admin_price;
                }
                if (role == "Agents") {
                    amount = row.agent_price;
                }
                var lastTd = '<td></td>';
                if (role == "Masteradmin") {
                    lastTD = '<td><button class="btn btn-sm btn-info" onclick="deleteRent(' + row.id + ')">Delete</button></td>';
                }
                $('#items_details').append('<tr><td>' + row.date_from + '</td><td>' + row.date_to + '</td><td>' + row.no_of_days + '</td><td>' + amount + '</td><td>' + row.month + '</td>' + lastTd + '</tr>');
            }
        });
    }

    function deleteRent(id) {
        if (confirm('Are you sure you want to delete this rent?')) {
            window.location.href = "https://bankcardsample.system1906.com/card/destroy_rentItem/" + id;
        }
    }
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>