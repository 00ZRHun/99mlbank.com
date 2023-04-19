<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

// initialise variables // TODO: do in other file as well
$path = $url . "/announcement/index.php";

// create or edit announcement
if (isset($_POST['create'])) {

    // get user input data
    $name = $_POST['announcement'];

    // if id empty, then create new announcement, else update old announcement
    $id = $_POST['announcement_id'];   // use to determine if CREATE or EDIT mode
    // echo "<script>alert('id = $id';)</script>";   // D

    if ($id == "") {
        $status = 'Inactive';
        // echo "<script>alert('CREATE')</script>";   // D
        $sql = "INSERT INTO `announcement` (name, status) VALUES ('$name', '$status')";
    } else {
        // echo "<script>alert('EDIT')</script>";   // D
        $sql = "UPDATE `announcement` SET name = '$name' WHERE id = $id";
    }

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Created successfully.')</script>";
    } else {
        echo "<script>alert('name = $name; id = $id')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

// inactive / active announcement
if (isset($_GET['setInactive'])) {
    // get required data
    $id = $_GET['setInactive'];
    $status = "";
    // $status = "Inactive";
    $sql = "SELECT status FROM `announcement` WHERE id = $id";
    // echo "<script>alert('sql = $sql')</script>";
    $res = mysqli_query($conn, $sql);
    while ($myrow = mysqli_fetch_array($res)) {
        $status = $myrow['status'];
        $status = getOppositeStatus($status);   // inverse status
    }
    /* echo "<script>alert('status = $status')</script>";
    echo "<script>alert('res = $res')</script>"; */

    // update status
    // $sql = "UPDATE `announcement` SET status = '" . $status . "' WHERE id = $id";   // TODO: chg '" . $status . "' -> '$status'
    $sql = "UPDATE `announcement` SET status = '$status' WHERE id = $id";
    // echo "<script>alert('Debug: sql = $sql')</script>";   // D
    // can active one announcement only
    if ($status == "Active") {
        /* $status = "Inactive";
        $sql .= "UPDATE `announcement` SET status = '$status' WHERE id != $id";   // OPT: MySQL not equal operator: <>, != */
        // $sql = $sql . "; UPDATE `announcement` SET status = 'Inactive' WHERE id != $id";
        $sql .= "; UPDATE `announcement` SET status = 'Inactive' WHERE id != $id";
    }
    // echo "<script>alert('Debug: setInactive; id = $id; status = $status')</script>";   // D
    // echo "<script>alert('Debug: sql = $sql')</script>";   // D

    // if (mysqli_query($conn, $sql)) {
    if (mysqli_multi_query($conn, $sql)) {   // * use mysqli_multi_query(conn, sql) to run multi query
        // echo "<script>alert('Status updated successfully.')</script>";
        echo "<script>window.location.replace('$path');</script>";
    } else {
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

// delete announcement
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];   // use to determine if CREATE or EDIT mode
    // echo "<script>alert('id = $id';)</script>";   // D

    $sql = "DELETE FROM `announcement` WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Created successfully.')</script>";
        echo "<script>window.location.href='$path';</script>";
        // echo "<script>window.location.href='" . SITEURL . "/announcement/index.php';</script>";   // ditto
    } else {
        echo "<script>alert('id = $id')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}
?>

<div class="page-header">
    <h4 class="page-title">Announcement</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"></a>Announcement Details</li>
        <li class="breadcrumb-item active" aria-current="page">announcements</li>
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
                                <th>Announcement Name</th>
                                <th>Is Active</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- list announcements -->
                            <?php
                            $sql = "SELECT * FROM `announcement`";
                            // echo "<script>alert('sql = $sql')</script>";   // D
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                            ?>
                                    <tr>
                                        <td><?= $row['name'] ?></td>
                                        <!-- <td><?= $row['status'] ?></td> -->
                                        <td><?= $row['status'] == "Active" ? "Active" : "" ?></td>
                                        <td>
                                            <!-- <button class="btn btn-sm btn-primary" onclick="if(confirm('Are you sure you want to active this announcement?')){ window.location.href='https://bankcardsample.system1906.com/announcement/setInActive/2' }">
                                                InActive
                                            </button> -->
                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to <?= strtolower(getOppositeStatus($row['status'])) ?> announcement?')){ window.location.href='<?= $path ?>?setInactive=' + <?= $row['id'] ?> }"><?= getOppositeStatus($row["status"]) ?></button> <!-- OPT: Superadmins/index.php?inactive=<?= $row["contact"] ?> -->
                                            <!-- <button class="btn btn-sm btn-info" onclick="window.location.href='<?= $path ?>?setInactive=' + <?= $row['id'] ?>"><?= getOppositeStatus($row["status"]) ?></button> OPT: Superadmins/index.php?inactive=<?= $row["contact"] ?> -->
                                            <!-- <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:2,&quot;announcement&quot;:&quot;\u8981\u597d\u597d\u7684\u505a\uff0c\u52aa\u529b\u8d5a\u94b1\uff0c\u7f8e\u597d\u672a\u6765\uff01&quot;,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2022-10-15T09:38:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:27:03.000000Z&quot;,&quot;deleted_at&quot;:null})"> -->
                                            <button class="btn btn-sm btn-info" onclick='editModal(<?= json_encode($row) ?>)'>
                                                Edit
                                            </button>
                                            <!-- <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/announcement/destroy/2' }"> -->
                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='<?= $path ?>?delete=' + <?= $row['id'] ?> }">
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
                <h4 class="modal-title font-weight-bold">Create Announcement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/announcement/store"> -->
            <form enctype="multipart/form-data" method="post">
                <input type="hidden" name="_token" value="PqtUCFMuJNkIkZ2y5bubR3BkrqRCILp7VRQexTwP">
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <input type="text" class="form-control" name="announcement_id" id="announcement_id" hidden>
                        <label class="form-label" for="exampleInputEmail1">Announcement</label>
                        <textarea class="form-control" name="announcement" id="announcement" required></textarea>
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
        document.getElementById("announcement_id").value = '';
        document.getElementById("announcement").value = '';
    }

    function editModal(data) {

        $("#largeModal").modal();
        document.getElementById("announcement_id").value = data.id;
        // document.getElementById("announcement").value = data.announcement;
        document.getElementById("announcement").value = data.name;
    }
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>