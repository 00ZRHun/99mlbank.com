<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php'); ?>

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
                            <tr>
                                <td>MBB</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:1,&quot;name&quot;:&quot;MBB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/1' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>PBB</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:2,&quot;name&quot;:&quot;PBB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:56:55.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:56:55.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/2' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>CIMB</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:3,&quot;name&quot;:&quot;CIMB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:02.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:02.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/3' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>HLB</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:4,&quot;name&quot;:&quot;HLB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:10.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:10.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/4' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>RHB</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/5' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>BSN</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:6,&quot;name&quot;:&quot;BSN&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:41.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:41.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/6' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>AMBANK</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:7,&quot;name&quot;:&quot;AMBANK&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:51.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:51.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/7' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>MBB COMPANY</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:8,&quot;name&quot;:&quot;MBB COMPANY&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:59:13.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:59:13.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/8' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>RHB COMPANY</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:9,&quot;name&quot;:&quot;RHB COMPANY&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:59:23.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-08-01T06:27:38.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/9' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>HLB COMPANY</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:10,&quot;name&quot;:&quot;HLB COMPANY&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:59:38.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:59:38.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/10' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>CIMB COMPANY</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:11,&quot;name&quot;:&quot;CIMB COMPANY&quot;,&quot;created_at&quot;:&quot;2022-07-14T15:00:24.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T15:00:24.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/11' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>BSN COMPANY</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:12,&quot;name&quot;:&quot;BSN COMPANY&quot;,&quot;created_at&quot;:&quot;2022-07-14T15:00:34.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T15:00:34.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/12' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>AMBANK COMPANY</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:13,&quot;name&quot;:&quot;AMBANK COMPANY&quot;,&quot;created_at&quot;:&quot;2022-07-14T15:01:09.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T15:01:09.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/13' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>PBB COMPANY</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:14,&quot;name&quot;:&quot;PBB COMPANY&quot;,&quot;created_at&quot;:&quot;2022-07-14T15:01:33.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T15:01:33.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/14' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>CIMB COMPANY TNG+DUITNOW</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:15,&quot;name&quot;:&quot;CIMB COMPANY TNG+DUITNOW&quot;,&quot;created_at&quot;:&quot;2022-07-14T15:02:02.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T15:02:02.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/15' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>CIMB CREDIT CARD</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:16,&quot;name&quot;:&quot;CIMB CREDIT CARD&quot;,&quot;created_at&quot;:&quot;2022-07-17T14:47:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-17T14:47:21.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/16' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>HLB CREDIT CARD</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:17,&quot;name&quot;:&quot;HLB CREDIT CARD&quot;,&quot;created_at&quot;:&quot;2022-07-17T14:47:28.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-17T14:47:28.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/17' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>ARGO COMPANY</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:18,&quot;name&quot;:&quot;ARGO COMPANY&quot;,&quot;created_at&quot;:&quot;2022-07-17T14:47:49.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-17T14:47:49.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/18' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>ARGO</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:19,&quot;name&quot;:&quot;ARGO&quot;,&quot;created_at&quot;:&quot;2022-07-17T14:47:55.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-17T14:47:55.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/19' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>UOB COMPANY</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:20,&quot;name&quot;:&quot;UOB COMPANY&quot;,&quot;created_at&quot;:&quot;2022-08-01T06:26:54.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-08-01T06:26:54.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/20' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>MBB TNG</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:21,&quot;name&quot;:&quot;MBB TNG&quot;,&quot;created_at&quot;:&quot;2022-08-01T06:27:06.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-08-01T06:27:06.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/21' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>ALLIANCE BANK</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:22,&quot;name&quot;:&quot;ALLIANCE BANK&quot;,&quot;created_at&quot;:&quot;2022-09-30T12:56:09.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-09-30T12:56:09.000000Z&quot;})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/bank/destroy/22' }">
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
                <h4 class="modal-title font-weight-bold">Create Bank</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/bank/store">
                <input type="hidden" name="_token" value="PqtUCFMuJNkIkZ2y5bubR3BkrqRCILp7VRQexTwP">
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <input type="text" class="form-control" name="bank_id" id="bank_id" hidden>
                        <label class="form-label" for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
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