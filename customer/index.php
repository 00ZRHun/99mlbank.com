<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php'); ?>

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
                            <tr>
                                <td>hihihi</td>
                                <td>1111</td>
                                <td>111122</td>
                                <td>
                                    <div class="btn btn-sm" style="background-color:green;color:white">Active</div>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="window.location.href='https://bankcardsample.system1906.com/customer/view/2' ">
                                        View
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:2,&quot;name&quot;:&quot;1111&quot;,&quot;username&quot;:&quot;hihihi&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Customer&quot;,&quot;contact_no&quot;:&quot;111122&quot;,&quot;upline&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:25:14.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:25:37.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to reset password?')){ window.location.href='https://bankcardsample.system1906.com/user/resetPassword/2' }">
                                        Reset Pass
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to inactive user?')){ window.location.href='https://bankcardsample.system1906.com/user/setInactive/2' }">Inactive</button>

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
                <h4 class="modal-title font-weight-bold">Create Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/user/store">
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
        document.getElementById("user_id").value = '';
        document.getElementById("role").value = 'Customer';
        document.getElementById("username").value = '';
        document.getElementById("username").readOnly = false;
        document.getElementById("name").value = '';
        document.getElementById("contact_no").value = '';
    }

    function editModal(data) {

        $("#largeModal").modal();
        document.getElementById("user_id").value = data.id;
        document.getElementById("role").value = data.role;
        document.getElementById("username").value = data.username;
        document.getElementById("username").readOnly = true;
        document.getElementById("name").value = data.name;
        document.getElementById("contact_no").value = data.contact_no;
    }
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>