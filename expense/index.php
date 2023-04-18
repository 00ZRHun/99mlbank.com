<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

// create or edit expense
if (isset($_POST['create'])) {

    $description = $_POST['description'];
    $claim_date = $_POST['claim_date'];
    $amount = $_POST['amount'];

    /* $role = "Superadmins";
    $upline = $_SESSION["upline"];
    $status = "Active"; */

    // if id empty, then create new expense, else update old expense
    $id = $_POST['expense_id'];   // use to determine if CREATE or EDIT mode
    // echo "<script>alert('id = $id';)</script>";   // D

    if ($id == "") {
        // echo "<script>alert('CREATE')</script>";   // D
        $sql = "INSERT INTO expense (description, claim_date, amount) VALUES
            ('$description', '$claim_date', '$amount')";
    } else {
        // echo "<script>alert('EDIT')</script>";   // D
        $sql = "UPDATE expense SET description = '$description', claim_date = '$claim_date', amount = '$amount' WHERE id = $id";
    }

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Created successfully.')</script>";
    } else {
        echo "<script>alert('description = $description ; claim_date = $claim_date; amount = $amount; id = $id')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}

// delete expense
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];   // use to determine if CREATE or EDIT mode
    // echo "<script>alert('id = $id';)</script>";   // D

    $sql = "DELETE FROM expense WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // echo "<script>alert('Created successfully.')</script>";
        echo "<script>window.location.href='$url/expense/index.php';</script>";
        // echo "<script>window.location.href='" . SITEURL . "/expense/index.php';</script>";   // ditto
    } else {
        echo "<script>alert('id = $id')</script>";
        echo "<script>alert('sql = $sql')</script>";
        echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
    }
}
?>

<div class="app-content  my-3 my-md-5">
    <div class="side-app">
        <marquee style="padding:8px;background-color:#FDD58C"><b>要好好的做，努力赚钱，美好未来！</b></marquee>
        <div class="page-header">
            <h4 class="page-title">Expense</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"></a>Expense Details</li>
                <li class="breadcrumb-item active" aria-current="page">expense</li>
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
                                        <th>Description</th>
                                        <th>Amount (RM)</th>
                                        <th>Month ~ Year</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- list expenses -->
                                    <?php
                                    /* // get upline from SESSION (index.php)
                                    $upline = $_SESSION["upline"];
                                    // echo '$upline = ' . $upline; */
                                    // $sql = "SELECT * FROM users WHERE upline = $upline";
                                    $sql = "SELECT * FROM expense";
                                    // echo "<script>alert('sql = $sql')</script>";   // D
                                    $result = mysqli_query($conn, $sql);
                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_assoc()) {
                                            /* echo "<script>alert('Debug: row = " . json_encode($row) . "')</script>";   // D
                                            echo "<script>alert('Debug: username = " . $row["username"] . "')</script>";   // D */
                                    ?>
                                            <tr>
                                                <td><?= $row['claim_date'] ?></td> <!-- OPT: 2023-05-17 -->
                                                <td><?= $row['description'] ?></td> <!-- OPT: Description -->
                                                <td><?= $row['amount'] ?></td> <!-- OPT: 100 -->
                                                <td><?= date('F y', strtotime($row['claim_date'])) ?></td> <!-- OPT: May 2023 -->
                                                <td>
                                                    <!-- <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:3,&quot;claim_date&quot;:&quot;2023-05-17&quot;,&quot;month&quot;:&quot;5&quot;,&quot;year&quot;:&quot;2023&quot;,&quot;description&quot;:&quot;Description&quot;,&quot;amount&quot;:100,&quot;created_at&quot;:&quot;2023-04-17T13:53:52.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-17T13:53:52.000000Z&quot;,&quot;deleted_at&quot;:null})"> -->
                                                    <button class="btn btn-sm btn-info" onclick='editModal(<?= json_encode($row) ?>)'>
                                                        Edit
                                                    </button>
                                                    <!-- <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/expense/destroy/3' }"> -->
                                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='<?= $url ?>/expense/index.php?delete=' + <?= $row['id'] ?> }">
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
                        <h4 class="modal-title font-weight-bold">Create Expense</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form enctype="multipart/form-data" method="post"> <!-- OPT:  action="https://bankcardsample.system1906.com/expense/store" -->
                        <input type="hidden" name="_token" value="CPFPhQYqgjmerci3K7AcwkfKWNWFDBWeRvcTb2pe">
                        <div class="modal-body pd-20">
                            <div class="form-group">
                                <input type="text" class="form-control" name="expense_id" id="expense_id" hidden>
                                <label class="form-label" for="exampleInputEmail1">Description</label>
                                <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Claim Date</label>
                                <input type="date" class="form-control" name="claim_date" id="claim_date" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Amount</label>
                                <input type="number" step="0.01" class="form-control" name="amount" id="amount" required>
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
                document.getElementById("expense_id").value = '';
                document.getElementById("description").value = '';
                document.getElementById("claim_date").value = '';
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
                $("#largeModal").modal();
                document.getElementById("expense_id").value = data.id;
                document.getElementById("description").value = data.description;
                document.getElementById("claim_date").value = data.claim_date;
                document.getElementById("amount").value = data.amount;
            }
        </script>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>