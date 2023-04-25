<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php'); ?>

<div class="page-header">
    <h4 class="page-title">Card</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"></a>Card Details</li>
        <li class="breadcrumb-item active" aria-current="page">cards</li>
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
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2 ">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title" style="color:red">Total Cards</h3>
                            </div>
                            <div class="card-body ">
                                <h2 class="text-dark  mt-0 font-weight-bold">3</h2>
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title" style="color:purple">Total Cost</h3>
                            </div>
                            <div class="card-body ">

                                <h2 class="text-dark  mt-0 font-weight-bold">RM 505123</h2>
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title" style="color:orange">Approved Cards</h3>
                            </div>
                            <div class="card-body ">
                                <h2 class="text-dark  mt-0 font-weight-bold">3</h2>
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title" style="color:orange">Rent Count</h3>
                            </div>
                            <div class="card-body ">
                                <h2 class="text-dark  mt-0 font-weight-bold">1</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2 ">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title" style="color:blue">Rent Cost</h3>
                            </div>
                            <div class="card-body ">

                                <h2 class="text-dark  mt-0  font-weight-bold">RM 316666.67</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="hover table-bordered border-top-0 border-bottom-0">
                        <thead>
                            <tr>
                                <th>Card No</th>
                                <th>Card Owner Name</th>
                                <th>Card Owner IC</th>
                                <th>Bank</th>
                                <th>Price (RM)</th>
                                <th>Card Status</th>
                                <th>This Month Rent(RM)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>111</td>
                                <td>RHB card</td>
                                <td>111111</td>
                                <td>RHB</td>
                                <td>316666.67</td>
                                <td><b style='color:green'>Approved</b></td>
                                <td>316666.67</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="rentModal('Masteradmin',[{&quot;id&quot;:1,&quot;card_id&quot;:1,&quot;year&quot;:2023,&quot;month&quot;:4,&quot;amount&quot;:316666.67,&quot;created_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;date_from&quot;:&quot;2023-04-12&quot;,&quot;date_to&quot;:&quot;2023-04-30&quot;,&quot;no_of_days&quot;:19,&quot;cost&quot;:500000,&quot;invoice_item_id&quot;:1,&quot;admin_cost&quot;:500000,&quot;admin_price&quot;:316666.67,&quot;agent_cost&quot;:500000,&quot;agent_price&quot;:316666.67}])">
                                        View Rent
                                    </button>

                                </td>
                            </tr>
                            <tr>
                                <td>1212</td>
                                <td>Am Card</td>
                                <td>121212</td>
                                <td>AMBANK COMPANY</td>
                                <td>0</td>
                                <td><b style='color:green'>Approved</b></td>
                                <td>0</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="rentModal('Masteradmin',[])">
                                        View Rent
                                    </button>

                                </td>
                            </tr>
                            <tr>
                                <td>Card No/Company ID</td>
                                <td>Name</td>
                                <td>IC</td>
                                <td>MBB</td>
                                <td>0</td>
                                <td><b style='color:green'>Approved</b></td>
                                <td>0</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="rentModal('Masteradmin',[])">
                                        View Rent
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold">Create Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="<?= SITEURL ?>/card/store">
                <input type="hidden" name="_token" value="84KWmXSLFpmKezgSqIsfUD2nIpemJgaikK4hpnuW">
                <div class="modal-body pd-20">
                    <input type="text" class="form-control" name="card_id" id="card_id" hidden>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Bank</label>
                                <select class="form-control" id="bank_id" name="bank_id" required>
                                    <option value="1">MBB</option>
                                    <option value="2">PBB</option>
                                    <option value="3">CIMB</option>
                                    <option value="4">HLB</option>
                                    <option value="5">RHB</option>
                                    <option value="6">BSN</option>
                                    <option value="7">AMBANK</option>
                                    <option value="8">MBB COMPANY</option>
                                    <option value="9">RHB COMPANY</option>
                                    <option value="10">HLB COMPANY</option>
                                    <option value="11">CIMB COMPANY</option>
                                    <option value="12">BSN COMPANY</option>
                                    <option value="13">AMBANK COMPANY</option>
                                    <option value="14">PBB COMPANY</option>
                                    <option value="15">CIMB COMPANY TNG+DUITNOW</option>
                                    <option value="16">CIMB CREDIT CARD</option>
                                    <option value="17">HLB CREDIT CARD</option>
                                    <option value="18">ARGO COMPANY</option>
                                    <option value="19">ARGO</option>
                                    <option value="20">UOB COMPANY</option>
                                    <option value="21">MBB TNG</option>
                                    <option value="22">ALLIANCE BANK</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="card_name" id="card_name" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">IC</label>
                                <input type="text" class="form-control" name="ic" id="ic" placeholder="Enter IC" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Online User ID</label>
                                <input type="text" class="form-control" name="online_user_id" id="online_user_id" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Online Password</label>
                                <input type="text" class="form-control" name="online_password" id="online_password" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Atm Password</label>
                                <input type="text" class="form-control" name="atm_password" id="atm_password" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Account No</label>
                                <input type="text" class="form-control" name="account_no" id="account_no" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">OTP No</label>
                                <input type="text" class="form-control" name="otp_no" id="otp_no" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Card No/Company ID</label>
                                <input type="text" class="form-control" name="card_no" id="card_no" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Address of Bank</label>
                                <input type="text" class="form-control" name="address_of_bank" id="address_of_bank" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Secure word</label>
                                <input type="text" class="form-control" name="secure_word" id="secure_word" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Gmail of Bank</label>
                                <input type="text" class="form-control" name="gmail_of_bank" id="gmail_of_bank" placeholder="..." required>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Home Address</label>
                                <input type="text" class="form-control" name="home_address" id="home_address" placeholder="...">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Mother Name</label>
                                <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="...">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Company Name</label>
                                <input type="text" class="form-control" name="token_key" id="token_key" placeholder="...">
                            </div>
                        </div>
                        <!-- <div class="col-md-6 col-lg-6">
									<div class="form-group">
										<label class="form-label" for="exampleInputEmail1">Card Cost (RM)</label>
										<input type="text" class="form-control" name="from_price" id="from_price"  placeholder="..." >
									</div>
								</div> -->
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
<div id="approveModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title">Approve Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="<?= SITEURL ?>/card/setApprove">
                <input type="hidden" name="_token" value="84KWmXSLFpmKezgSqIsfUD2nIpemJgaikK4hpnuW">
                <div class="modal-body pd-20">
                    <input type="text" class="form-control" name="card_idd" id="card_idd" hidden>
                    <!-- <div class="form-group">
								<label class="form-label">Initial Cost (RM)</label>
								<input type="number" step="0.01" class="form-control" name="initial_cost" id="initial_cost" required>
							</div> -->
                    <div class="form-group">
                        <label class="form-label">Monthly Cost (RM)</label>
                        <input type="number" step="0.01" class="form-control" name="monthly_cost" id="monthly_cost" required>
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

<div id="rentingModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title">Rent Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <div class="table-responsive">
                    <table id="example5" class="hover table-bordered border-top-0 border-bottom-0">
                        <thead>
                            <tr>
                                <th>From</th>
                                <th>To</th>
                                <th>No of Days</th>
                                <th>Amount (RM)</th>
                            </tr>
                        </thead>
                        <tbody id="items_details">
                        </tbody>
                    </table>
                </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div>

<script>
    function openModal() {

        $("#largeModal").modal();
        document.getElementById("card_id").value = '';
        document.getElementById("bank_id").value = '';
        document.getElementById("card_name").value = '';
        document.getElementById("ic").value = '';
        document.getElementById("online_user_id").value = '';
        document.getElementById("online_password").value = '';
        document.getElementById("atm_password").value = '';
        document.getElementById("account_no").value = '';
        document.getElementById("otp_no").value = '';
        document.getElementById("card_no").value = '';
        document.getElementById("address_of_bank").value = '';
        document.getElementById("secure_word").value = '';
        document.getElementById("gmail_of_bank").value = '';
        document.getElementById("token_key").value = '';
        document.getElementById("mother_name").value = '';
        document.getElementById("home_address").value = '';
        //document.getElementById("from_price").value='';
    }

    function editModal(data) {

        $("#largeModal").modal();
        document.getElementById("card_id").value = data.id;
        document.getElementById("bank_id").value = data.bank_id;
        document.getElementById("card_name").value = data.card_name;
        document.getElementById("ic").value = data.ic;
        document.getElementById("online_user_id").value = data.online_user_id;
        document.getElementById("online_password").value = data.online_password;
        document.getElementById("atm_password").value = data.atm_password;
        document.getElementById("account_no").value = data.account_no;
        document.getElementById("otp_no").value = data.otp_no;
        document.getElementById("card_no").value = data.card_no;
        document.getElementById("address_of_bank").value = data.address_of_bank;
        document.getElementById("secure_word").value = data.secure_word;
        document.getElementById("gmail_of_bank").value = data.gmail_of_bank;
        document.getElementById("token_key").value = data.token_key;
        document.getElementById("mother_name").value = data.mother_name;
        document.getElementById("home_address").value = data.home_address;
        //document.getElementById("from_price").value=data.from_price;
    }


    function approveModal(data) {
        $("#approveModal").modal();
        document.getElementById("card_idd").value = data.id;
        document.getElementById("monthly_cost").value = data.from_price;
    }



    function rentModal(role, data) {
        console.log(role);
        $("#rentingModal").modal();

        $('#items_details').empty();
        data.forEach(function(row) {
            var amount = row.amount;
            if (role == "Admins") {
                amount = row.admin_price;
            }
            if (role == "Agents") {
                amount = row.agent_price;
            }
            $('#items_details').append('<tr><td>' + row.date_from + '</td><td>' + row.date_to + '</td><td>' + row.no_of_days + '</td><td>' + amount + '</td></tr>');
        });
    }
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>