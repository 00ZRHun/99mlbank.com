<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');
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
                                    <tr>
                                        <td>2023-04-11</td>
                                        <td>12122</td>
                                        <td>1111</td>
                                        <td>April 2023</td>
                                        <td>for emergency</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:2,&quot;pay_date&quot;:&quot;2023-04-11&quot;,&quot;month&quot;:&quot;4&quot;,&quot;year&quot;:&quot;2023&quot;,&quot;user_id&quot;:3,&quot;amount&quot;:1111,&quot;remarks&quot;:&quot;for emergency&quot;,&quot;created_at&quot;:&quot;2023-04-11T02:17:22.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T02:18:04.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;rental&quot;:{&quot;id&quot;:3,&quot;name&quot;:&quot;12122&quot;,&quot;username&quot;:&quot;admin111&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Superadmins&quot;,&quot;contact_no&quot;:&quot;11112&quot;,&quot;upline&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:34:53.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-13T20:21:32.000000Z&quot;}})">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/rent/destroy/2' }">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2023-04-12</td>
                                        <td>12122</td>
                                        <td>1000</td>
                                        <td>April 2023</td>
                                        <td>for emergency111</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:3,&quot;pay_date&quot;:&quot;2023-04-12&quot;,&quot;month&quot;:&quot;4&quot;,&quot;year&quot;:&quot;2023&quot;,&quot;user_id&quot;:3,&quot;amount&quot;:1000,&quot;remarks&quot;:&quot;for emergency111&quot;,&quot;created_at&quot;:&quot;2023-04-11T02:29:14.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T02:29:14.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;rental&quot;:{&quot;id&quot;:3,&quot;name&quot;:&quot;12122&quot;,&quot;username&quot;:&quot;admin111&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Superadmins&quot;,&quot;contact_no&quot;:&quot;11112&quot;,&quot;upline&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:34:53.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-13T20:21:32.000000Z&quot;}})">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/rent/destroy/3' }">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2023-04-18</td>
                                        <td>Name</td>
                                        <td>100</td>
                                        <td>April 2023</td>
                                        <td>Remarks</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:4,&quot;pay_date&quot;:&quot;2023-04-18&quot;,&quot;month&quot;:&quot;4&quot;,&quot;year&quot;:&quot;2023&quot;,&quot;user_id&quot;:5,&quot;amount&quot;:100,&quot;remarks&quot;:&quot;Remarks&quot;,&quot;created_at&quot;:&quot;2023-04-17T12:04:37.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-17T13:47:12.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;rental&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;Name&quot;,&quot;username&quot;:&quot;Username 2&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Superadmins&quot;,&quot;contact_no&quot;:&quot;Contact No&quot;,&quot;upline&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-12T16:37:38.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-13T20:14:03.000000Z&quot;}})">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/rent/destroy/4' }">
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
                        <h4 class="modal-title font-weight-bold">Create Rent</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/rent/store">
                        <input type="hidden" name="_token" value="CPFPhQYqgjmerci3K7AcwkfKWNWFDBWeRvcTb2pe">
                        <div class="modal-body pd-20">
                            <input type="text" class="form-control" name="rent_id" id="rent_id" hidden>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Superadmin</label>
                                <select class="form-control" name="user_id" id="user_id">
                                    <option value="3">12122</option>
                                    <option value="5">Name</option>
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
                document.getElementById("rent_id").value = '';
                document.getElementById("user_id").value = '';
                document.getElementById("remarks").value = '';
                document.getElementById("pay_date").value = '';
                document.getElementById("amount").value = '';
            }

            function editModal(data) {

                $("#largeModal").modal();
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