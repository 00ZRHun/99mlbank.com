<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php'); ?>

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
                            <tr>
                                <td>Testing Testing 123</td>
                                <td></td>
                                <td>
                                    <button class="btn btn-sm btn-success" onclick="if(confirm('Are you sure you want to active this announcement?')){ window.location.href='https://bankcardsample.system1906.com/announcement/setActive/1' }">
                                        Active
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:1,&quot;announcement&quot;:&quot;Testing Testing 123&quot;,&quot;is_active&quot;:null,&quot;created_at&quot;:&quot;2022-10-15T09:38:29.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:27:03.000000Z&quot;,&quot;deleted_at&quot;:null})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/announcement/destroy/1' }">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>要好好的做，努力赚钱，美好未来！</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="if(confirm('Are you sure you want to active this announcement?')){ window.location.href='https://bankcardsample.system1906.com/announcement/setInActive/2' }">
                                        InActive
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:2,&quot;announcement&quot;:&quot;\u8981\u597d\u597d\u7684\u505a\uff0c\u52aa\u529b\u8d5a\u94b1\uff0c\u7f8e\u597d\u672a\u6765\uff01&quot;,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2022-10-15T09:38:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:27:03.000000Z&quot;,&quot;deleted_at&quot;:null})">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="if(confirm('Are you sure you want to delete?')){ window.location.href='https://bankcardsample.system1906.com/announcement/destroy/2' }">
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
                <h4 class="modal-title font-weight-bold">Create Announcement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/announcement/store">
                <input type="hidden" name="_token" value="PqtUCFMuJNkIkZ2y5bubR3BkrqRCILp7VRQexTwP">
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <input type="text" class="form-control" name="announcement_id" id="announcement_id" hidden>
                        <label class="form-label" for="exampleInputEmail1">Announcement</label>
                        <textarea class="form-control" name="announcement" id="announcement" required></textarea>
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
        document.getElementById("announcement_id").value = '';
        document.getElementById("announcement").value = '';
    }

    function editModal(data) {

        $("#largeModal").modal();
        document.getElementById("announcement_id").value = data.id;
        document.getElementById("announcement").value = data.announcement;
    }
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>