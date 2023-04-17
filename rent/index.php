<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

// create rent
if (isset($_POST['create'])) {

    $user_id = $_POST['user_id'];
    $pay_date = $_POST['pay_date'];
    $amount = $_POST['amount'];
    $remarks = $_POST['remarks'];

    /* $role = "Superadmins";
    $upline = $_SESSION["upline"];
    $status = "Active"; */

    // if id empty, then create new rent, else update old rent
    $id = $_POST['rent_id'];   // use to determine if CREATE or EDIT mode
    // echo "<script>alert('id = $id';)</script>";   // D

    if ($id == "") {
        // echo "<script>alert('CREATE')</script>";   // D
        $sql = "INSERT INTO rent (user_id, pay_date, amount, remarks) VALUES
            ('$user_id', '$pay_date', '$amount', '$remarks')";
    } else {
        // echo "<script>alert('EDIT')</script>";   // D
        $sql = "UPDATE rent SET user_id = '$user_id', pay_date = '$pay_date', amount = '$amount', remarks = '$remarks' WHERE id = $id";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Created successfully.')</script>";
    } else {
        echo "<script>alert('user_id = $user_id ; pay_date = $pay_date; amount = $amount; remarks = $remarks; id = $id')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}
?>

<div class="app-content  my-3 my-md-5">
    <div class="side-app">
        <marquee style="padding:8px;background-color:#FDD58C"><b>要好好的做，努力赚钱，美好未来！</b></marquee>
        <div class="page-header">
            <h4 class="page-title">Rent</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"></a>Rent Details</li>
                <li class="breadcrumb-item active" aria-current="page">rent</li>
            </ol>

        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Table List</div>

                        <a class="btn btn-primary" onclick="openModal()" style="float:right;color:white">Create</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="hover table-bordered border-top-0 border-bottom-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Superadmin</th>
                                        <th>Amount (RM)</th>
                                        <th>Month ~ Year</th>
                                        <th>Remarks</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- list users -->
                                    <?php
                                    /* // get upline from SESSION (index.php)
                                    $upline = $_SESSION["upline"];
                                    // echo '$upline = ' . $upline; */
                                    // $sql = "SELECT * FROM users WHERE upline = $upline";
                                    $sql = "SELECT rt.*, us.name FROM rent as rt left join users as us ON rt.user_id = us.id";
                                    // echo "<script>alert('sql = $sql')</script>";   // D
                                    $result = mysqli_query($conn, $sql);
                                    if ($result->num_rows > 0) {
                                        $count = 0;

                                        while ($row = $result->fetch_assoc()) {
                                            /* echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                                            echo "<script>alert('Debug: username = " . $row["username"] . "')</script>";   // D */
                                    ?>
                                            <tr>
                                                <td><?= $row['pay_date'] ?></td> <!-- OPT: 2023-04-11 -->
                                                <!-- <td><?= date('Y-d-m', strtotime($row['pay_date'])) ?></td> --> <!-- ditto -->
                                                <td><?= $row['name'] ?></td> <!-- OPT: 12122 -->
                                                <td><?= $row['amount'] ?></td> <!-- OPT: 1111 -->
                                                <td><?= date('F Y', strtotime($row['pay_date'])) ?> <!-- OPT: April 2023 -->
                                                <td><?= $row['remarks'] ?></td> <!-- OPT: for emergency -->
                                                <td>
                                                    <!-- <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:2,&quot;pay_date&quot;:&quot;2023-04-11&quot;,&quot;month&quot;:&quot;4&quot;,&quot;year&quot;:&quot;2023&quot;,&quot;user_id&quot;:3,&quot;amount&quot;:1111,&quot;remarks&quot;:&quot;for emergency&quot;,&quot;created_at&quot;:&quot;2023-04-11T02:17:22.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T02:18:04.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;rental&quot;:{&quot;id&quot;:3,&quot;name&quot;:&quot;12122&quot;,&quot;username&quot;:&quot;admin111&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Superadmins&quot;,&quot;contact_no&quot;:&quot;11112&quot;,&quot;upline&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:34:53.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-13T20:21:32.000000Z&quot;}})"> -->
                                                    <button class="btn btn-sm btn-info" onclick='editModal(<?= json_encode($row) ?>)'>
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/rent/destroy/2' }">
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
                </div>
            </div>
        </div>
        <div id="largeModal" class="modal fade">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content ">
                    <div class="modal-header pd-x-20">
                        <h4 class="modal-title font-weight-bold">Create Rent</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form enctype="multipart/form-data" method="post"> <!-- OPT:  action="https://bankcardsample.system1906.com/rent/store" -->
                        <input type="hidden" name="_token" value="CPFPhQYqgjmerci3K7AcwkfKWNWFDBWeRvcTb2pe">
                        <div class="modal-body pd-20">
                            <input type="text" class="form-control" name="rent_id" id="rent_id" hidden>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Superadmin</label>
                                <select class="form-control" name="user_id" id="user_id">
                                    <!-- list users -->
                                    <?php
                                    // get upline from SESSION (index.php)
                                    $upline = $_SESSION["upline"];
                                    // echo '$upline = ' . $upline;
                                    $sql = "SELECT * FROM users WHERE upline = $upline";
                                    // echo "<script>alert('sql = $sql')</script>";   // D
                                    $result = mysqli_query($conn, $sql);
                                    if ($result->num_rows > 0) {
                                        $count = 0;

                                        while ($row = $result->fetch_assoc()) {
                                            /* echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                                            echo "<script>alert('Debug: username = " . $row["username"] . "')</script>";   // D */
                                    ?>
                                            <!-- <option value="3">12122</option> -->
                                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Pay Date</label>
                                <input type="date" class="form-control" name="pay_date" id="pay_date" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Amount</label>
                                <input type="number" step="0.01" class="form-control" name="amount" id="amount" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Remarks</label>
                                <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Enter Remarks">
                            </div>
                        </div><!-- modal-body -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="create">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div><!-- modal-dialog -->
        </div>

        <script>
            function openModal() {

                $("#largeModal").modal();
                document.getElementById("rent_id").value = '';
                document.getElementById("user_id").value = '';
                document.getElementById("remarks").value = '';
                document.getElementById("pay_date").value = '';
                document.getElementById("amount").value = '';
            }

            function editModal(data) {
                /* // alert("DEBUG: data = " + data);   // D
                alert("DEBUG: data = " + JSON.stringify(data));
                alert("DEBUG: data['contact'] = " + data['contact']);
                alert("DEBUG: data.contact = " + data.contact); */

                // open modal
                $("#largeModal").modal();

                // get data from json & assign to dom field
                document.getElementById("rent_id").value = data.id;
                document.getElementById("user_id").value = data.user_id;
                document.getElementById("remarks").value = data.remarks;
                document.getElementById("pay_date").value = data.pay_date;
                document.getElementById("amount").value = data.amount;
            }
        </script>
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
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/user/changePassword">
                <input type="hidden" name="_token" value="CPFPhQYqgjmerci3K7AcwkfKWNWFDBWeRvcTb2pe">
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
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>