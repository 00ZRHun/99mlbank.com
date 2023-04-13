<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

// create user
if (isset($_POST['create'])) {
    $available = true;

    $username = $_POST['username'];
    $name = $_POST['name'];
    $contact = $_POST['contact_no'];
    $role = "Superadmins";
    $upline = $_SESSION["upline"];
    $status = "Active";

    // if id empty, then create new user, else update old user
    $id = $_POST['user_id'];   // use to determine if CREATE or EDIT mode
    // echo "<script>alert('id = $id';)</script>";   // D

    if ($id == "") {
        // echo "<script>alert('CREATE')</script>";   // D
        $sql = "INSERT INTO users (username, name, contact, role, upline, status) VALUES
            ('$username', '$name', '$contact', '$role', '$upline', '$status')";
    } else {
        // echo "<script>alert('EDIT')</script>";   // D
        $sql = "UPDATE users SET name = '$name', 
            contact = '$contact'";
    }

    // TODO: popup err msg if Username is taken 

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Created successfully.')</script>";
    } else {
        echo "<script>alert('available = $available')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}
?>

<div class="app-content  my-3 my-md-5">
    <div class="side-app">
        <marquee style="padding:8px;background-color:#FDD58C"><b>要好好的做，努力赚钱，美好未来！</b></marquee>
        <div class="page-header">
            <h4 class="page-title">Superadmins</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"></a>User Settings</li>
                <li class="breadcrumb-item active" aria-current="page">Superadmins</li>
            </ol>

        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title" style="margin-bottom:10px">Table List</div>

                        <a class="btn btn-primary" onclick="openModal('Superadmins')" style="float:right;color:white;margin-left:10px;margin-bottom:10px">Create</a>
                        <form class="form-inline" method="GET" style="float:right">
                            <div class="form-group mb-2">
                                <input type="month" class="form-control" id="filter" name="filter" style="margin-right:10px" value="2023-04">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Search</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="hover table-bordered border-top-0 border-bottom-0">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Total Cards (Teams)</th>
                                        <th>Approved Cards (Teams)</th>
                                        <th>Rent Cards (2023-04)</th>
                                        <th>Rent Cost (2023-04)</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- list users -->
                                    <?php
                                    // get upline from SESSION (index.php)
                                    $upline = $_SESSION["upline"];
                                    // echo '$upline = ' . $upline;
                                    $sql = "SELECT * FROM users WHERE upline = $upline";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result->num_rows > 0) {
                                        $count = 0;

                                        while ($row = $result->fetch_assoc()) {
                                            /* echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                                            echo "<script>alert('Debug: username = " . $row["username"] . "')</script>";   // D */
                                    ?>
                                            <tr>
                                                <td><?= $row["username"] ?></td>
                                                <td><?= $row["name"] ?></td>
                                                <td><?= $row["contact"] ?></td>
                                                <td>0</td> <!-- TODO: resolve dummy data -->
                                                <td>0</td> <!-- TODO: resolve dummy data -->
                                                <td>0</td> <!-- TODO: resolve dummy data -->
                                                <td>0</td> <!-- TODO: resolve dummy data -->
                                                <td>
                                                    <div class="btn btn-sm" style="background-color:green;color:white">Active</div>
                                                </td>
                                                <td>
                                                    <!-- <button class="btn btn-sm btn-info" onclick="window.location.href='../view/' + <?= $row['id'] ?> "> --> <!-- OPT: ../user/view/3 -->
                                                    <button class="btn btn-sm btn-info" onclick="window.location.href='../view?user=' + <?= $row['id'] ?> ">
                                                        View
                                                    </button>
                                                    <button class="btn btn-sm btn-info" onclick='editModal(<?= json_encode($row) ?>)'>
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to reset password?')){ window.location.href='../user/resetPassword/3' }">
                                                        Reset Pass
                                                    </button>
                                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to inactive user?')){ window.location.href='../user/setInactive/3' }">Inactive</button>
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
                        <h4 class="modal-title font-weight-bold">Create Superadmins</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form enctype="multipart/form-data" method="post"> <!--  OPT: action="../user/store" -->
                        <input type="hidden" name="_token" value="zZmMzS63qa18RXY01BZGv6chzLXG1ppo7j1x0Zub">
                        <div class="modal-body pd-20">
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_id" id="user_id" hidden>
                                <input type="text" class="form-control" name="role" id="role" value="Superadmins" hidden>
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
                            <button type="submit" class="btn btn-primary" name="create">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div><!-- modal-dialog -->
        </div>

        <script>
            function openModal(role) {

                $("#largeModal").modal();
                document.getElementById("user_id").value = '';
                document.getElementById("role").value = role;
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
            <form enctype="multipart/form-data" method="post" action="../user/changePassword">
                <input type="hidden" name="_token" value="zZmMzS63qa18RXY01BZGv6chzLXG1ppo7j1x0Zub">
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