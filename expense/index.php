<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');
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
                                    <tr>
                                        <td>2023-04-12</td>
                                        <td>buy ps</td>
                                        <td>222</td>
                                        <td>April 2023</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:1,&quot;claim_date&quot;:&quot;2023-04-12&quot;,&quot;month&quot;:&quot;4&quot;,&quot;year&quot;:&quot;2023&quot;,&quot;description&quot;:&quot;buy ps&quot;,&quot;amount&quot;:222,&quot;created_at&quot;:&quot;2023-04-11T01:24:53.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T02:19:03.000000Z&quot;,&quot;deleted_at&quot;:null})">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/expense/destroy/1' }">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2023-04-12</td>
                                        <td>buy car</td>
                                        <td>100</td>
                                        <td>April 2023</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:2,&quot;claim_date&quot;:&quot;2023-04-12&quot;,&quot;month&quot;:&quot;4&quot;,&quot;year&quot;:&quot;2023&quot;,&quot;description&quot;:&quot;buy car&quot;,&quot;amount&quot;:100,&quot;created_at&quot;:&quot;2023-04-11T02:28:42.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T02:28:42.000000Z&quot;,&quot;deleted_at&quot;:null})">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/expense/destroy/2' }">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2023-05-17</td>
                                        <td>Description</td>
                                        <td>100</td>
                                        <td>May 2023</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:3,&quot;claim_date&quot;:&quot;2023-05-17&quot;,&quot;month&quot;:&quot;5&quot;,&quot;year&quot;:&quot;2023&quot;,&quot;description&quot;:&quot;Description&quot;,&quot;amount&quot;:100,&quot;created_at&quot;:&quot;2023-04-17T13:53:52.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-17T13:53:52.000000Z&quot;,&quot;deleted_at&quot;:null})">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/expense/destroy/3' }">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
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
                    <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/expense/store">
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
                document.getElementById("expense_id").value = '';
                document.getElementById("description").value = '';
                document.getElementById("claim_date").value = '';
                document.getElementById("amount").value = '';
            }

            function editModal(data) {

                $("#largeModal").modal();
                document.getElementById("expense_id").value = data.id;
                document.getElementById("description").value = data.description;
                document.getElementById("claim_date").value = data.claim_date;
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