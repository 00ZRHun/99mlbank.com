<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

// create or edit bank
if (isset($_POST['create'])) {

    // get user input data
    $name = $_POST['name'];

    // if id empty, then create new bank, else update old bank
    $id = $_POST['bank_id'];   // use to determine if CREATE or EDIT mode
    // echo "<script>alert('id = $id';)</script>";   // D

    if ($id == "") {
        // echo "<script>alert('CREATE')</script>";   // D
        $sql = "INSERT INTO `bank` (name) VALUES ('$name')";
    } else {
        // echo "<script>alert('EDIT')</script>";   // D
        $sql = "UPDATE `bank` SET name = '$name' WHERE id = $id";
    }

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Created successfully.')</script>";
    } else {
        echo "<script>alert('name = $name; id = $id')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

// delete bank
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];   // use to determine if CREATE or EDIT mode
    // echo "<script>alert('id = $id';)</script>";   // D

    $sql = "DELETE FROM `bank` WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Created successfully.')</script>";
        echo "<script>window.location.href='$url/bank/index.php';</script>";
        // echo "<script>window.location.href='" . SITEURL . "/bank/index.php';</script>";   // ditto
    } else {
        echo "<script>alert('id = $id')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}
?>

<div class="page-header">
    <h4 class="page-title">Bank</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"></a>Bank Details</li>
        <li class="breadcrumb-item active" aria-current="page">banks</li>
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
                                <th>Bank Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- list banks -->
                            <?php
                            $sql = "SELECT * FROM `bank`";
                            // echo "<script>alert('sql = $sql')</script>";   // D
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    // echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                            ?>
                                    <tr>
                                        <td><?= $row['name'] ?></td>
                                        <td>
                                            <!-- <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:22,&quot;name&quot;:&quot;ALLIANCE BANK&quot;,&quot;created_at&quot;:&quot;2022-09-30T12:56:09.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-30T12:56:09.000000Z&quot;})"> -->
                                            <button class="btn btn-sm btn-info" onclick='editModal(<?= json_encode($row) ?>)'>
                                                Edit
                                            </button>
                                            <!-- <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/22' }"> -->
                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='<?= $url ?>/bank/index.php?delete=' + <?= $row['id'] ?> }">
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
                <h4 class="modal-title font-weight-bold">Create Bank</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/bank/store"> -->
            <form enctype="multipart/form-data" method="post">
                <input type="hidden" name="_token" value="PqtUCFMuJNkIkZ2y5bubR3BkrqRCILp7VRQexTwP">
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <input type="text" class="form-control" name="bank_id" id="bank_id" hidden>
                        <label class="form-label" for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
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
        document.getElementById("bank_id").value = '';
        document.getElementById("name").value = '';
    }

    function editModal(data) {

        $("#largeModal").modal();
        document.getElementById("bank_id").value = data.id;
        document.getElementById("name").value = data.name;
    }
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>