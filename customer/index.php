<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

// initialise variables
$role = "Customer";
$path = $url . "customer/index.php";
$password = "123456789";

// create user
if (isset($_POST['create'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $contact = $_POST['contact_no'];
    $upline = $_SESSION["upline"];
    $status = "Active";

    // popup err msg if Username is taken under same role
    $sql = "SELECT * FROM `user` WHERE role = '$role' AND username = '$username'";   // * REMEMBER to use single quote (else got error if user enter 'testing')
    // echo "<script>alert('Debug: sql = $sql')</script>";   // D
    $result = mysqli_query($conn, $sql);
    $available = ($result->num_rows > 0) ? false : true;
    // echo "<script>alert('available = $available')</script>";

    // if id empty, then create new user, else update old user
    $id = $_POST['user_id'];   // use to determine if CREATE or EDIT mode
    // echo "<script>alert('id = $id';)</script>";   // D

    if ($available || $id != "") {   // filter available username only

        if ($id == "") {
            // echo "<script>alert('CREATE')</script>";   // D
            // add default password when create
            $sql = "INSERT INTO `user` (username, name, contact, role, upline, status, password) VALUES
                ('$username', '$name', '$contact', '$role', '$upline', '$status', '$password')";
        } else {
            // echo "<script>alert('EDIT')</script>";   // D
            $sql = "UPDATE `user` SET name = '$name', 
                contact = '$contact' WHERE id = $id";
        }

        // show success message is successful else error message
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Created successfully.')</script>";
        } else {
            echo "<script>alert('available = $available')</script>";
            echo "<script>alert('sql = $sql')</script>";
            echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
        }
    } else {
        echo "<script>alert('Your username has been duplicated, please modify it and try again.')</script>";
    }
}

// reset password
if (isset($_GET['resetPassword'])) {
    // get id
    $id = $_GET['resetPassword'];

    // update password
    $sql = "UPDATE `user` SET password = '" . $password . "' WHERE id = $id";
    /* echo "<script>alert('resetPassword; id = $id; password = $password')</script>";   // D
    echo "<script>alert('sql = $sql')</script>"; */

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Password reset successfully.')</script>";
        echo "<script>window.location.replace('$path');</script>";
    } else {
        echo "<script>alert('id = $id')</>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

// inactive / active user
if (isset($_GET['setInactive'])) {
    // get required data
    $id = $_GET['setInactive'];
    $status = "";
    // $status = "Inactive";
    $sql = "SELECT status FROM `user` WHERE id = $id";
    // echo "<script>alert('sql = $sql')</script>";
    $res = mysqli_query($conn, $sql);
    while ($myrow = mysqli_fetch_array($res)) {
        $status = $myrow['status'];
        $status = getOppositeStatus($status);   // inverse status
    }
    /* echo "<script>alert('status = $status')</script>";
    echo "<script>alert('res = $res')</script>"; */

    // update status
    $sql = "UPDATE `user` SET status = '" . $status . "' WHERE id = $id";   // TODO: make it better
    /* echo "<script>alert('setInactive; id = $id; status = $status')</script>";   // D
    echo "<script>alert('sql = $sql')</script>"; */

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Status updated successfully.')</script>";
        echo "<script>window.location.replace('$path');</script>";
    } else {
        echo "<script>alert('available = $available')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

function getOppositeStatus($status)
{
    /* if ($status == "Active")   $status = "Inactive";
    else                       $status = "Active";
    return $status; */
    return ($status == "Active") ? "Inactive" : "Active";   // ternary operator as above
}
?>

<div class="page-header">
    <h4 class="page-title">Customer</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"></a>Customer Settings</li>
        <li class="breadcrumb-item active" aria-current="page">customer</li>
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
                                <th>Username</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- list customers -->
                            <?php
                            // get upline from SESSION (index.php)
                            $upline = $_SESSION["upline"];
                            // echo '$upline = ' . $upline;
                            // echo "<script>alert('upline = $upline')</script>";   // D
                            $sql = "SELECT * FROM `user` WHERE role = '$role' AND upline = $upline";   // filter Customer role only
                            // echo "<script>alert('sql = $sql')</script>";   // D
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {
                                $count = 0;   // TODO: remove var & its usage

                                while ($row = $result->fetch_assoc()) {
                                    /* echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                                            echo "<script>alert('Debug: username = " . $row["username"] . "')</script>";   // D */
                            ?>
                                    <tr>
                                        <td><?= $row["username"] ?></td>
                                        <td><?= $row["name"] ?></td>
                                        <td><?= $row["contact"] ?></td>
                                        <td>
                                            <!-- <div class="btn btn-sm" style="background-color:green;color:white">Active</div> -->
                                            <div class="btn btn-sm" style="background-color:<?= $row["status"] == "Active" ? "green" : "red" ?>;color:white"><?= $row["status"] ?></div>
                                        </td>
                                        <td>
                                            <!-- <button class="btn btn-sm btn-info" onclick="window.location.href='https://bankcardsample.system1906.com/customer/view/2' "> -->
                                            <button class="btn btn-sm btn-info" onclick="window.location.href='<?= $url ?>/customer/view.php?user=' + <?= $row['id'] ?> ">
                                                View
                                            </button>
                                            <!-- <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:2,&quot;name&quot;:&quot;1111&quot;,&quot;username&quot;:&quot;hihihi&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Customer&quot;,&quot;contact_no&quot;:&quot;111122&quot;,&quot;upline&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:25:14.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:25:37.000000Z&quot;})"> -->
                                            <button class="btn btn-sm btn-info" onclick='editModal(<?= json_encode($row) ?>)'>
                                                Edit
                                            </button>
                                            <!-- <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to reset password?')){ window.location.href='https://bankcardsample.system1906.com/user/resetPassword/2' }"> -->
                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to reset password?')){ window.location.href='<?= $path ?>?resetPassword=' + <?= $row['id'] ?> }"> <!-- OPT: '../user/resetPassword/3' -->
                                                Reset Pass
                                            </button>
                                            <!-- <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to inactive user?')){ window.location.href='https://bankcardsample.system1906.com/user/setInactive/2' }">Inactive</button> -->
                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to <?= strtolower(getOppositeStatus($row['status'])) ?> user?')){ window.location.href='<?= $path ?>?setInactive=' + <?= $row['id'] ?> }"><?= getOppositeStatus($row["status"]) ?></button> <!-- OPT: Superadmins/index.php?inactive=<?= $row["contact"] ?> -->
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
                <h4 class="modal-title font-weight-bold">Create Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post"> <!-- OPT: action="https://bankcardsample.system1906.com/user/store" -->
                <input type="hidden" name="_token" value="PqtUCFMuJNkIkZ2y5bubR3BkrqRCILp7VRQexTwP">
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_id" id="user_id" hidden>
                        <input type="text" class="form-control" name="role" id="role" value="Customer" hidden>
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
                    <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
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
        document.getElementById("user_id").value = '';
        document.getElementById("role").value = 'Customer';
        document.getElementById("username").value = '';
        document.getElementById("username").readOnly = false;
        document.getElementById("name").value = '';
        document.getElementById("contact_no").value = '';
    }

    function editModal(data) {
        /* // alert("DEBUG: data = " + data);   // D
        alert("DEBUG: data = " + JSON.stringify(data));
        alert("DEBUG: data['contact'] = " + data['contact']);
        alert("DEBUG: data.contact = " + data.contact); */

        // open modal
        $("#largeModal").modal();

        // get data from json & assign to dom field
        document.getElementById("user_id").value = data.id;
        document.getElementById("role").value = data.role;
        document.getElementById("username").value = data.username;
        document.getElementById("username").readOnly = true;
        document.getElementById("name").value = data.name;
        document.getElementById("contact_no").value = data.contact;
    }
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>