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
                                <h3 class="card-title" style="color:purple">Cost (monthly)</h3>
                            </div>
                            <div class="card-body ">

                                <h2 class="text-dark  mt-0 font-weight-bold">RM 505123</h2>
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-2">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title" style="color:brown">Rent Count</h3>
                            </div>
                            <div class="card-body ">

                                <h2 class="text-dark  mt-0 font-weight-bold">1</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2 ">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title" style="color:blue">Cost(current)</h3>
                            </div>
                            <div class="card-body ">

                                <h2 class="text-dark  mt-0  font-weight-bold">RM 316666.67</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Status</h3>

                        </div>
                        <div class="card-body p-6">
                            <div class="panel panel-primary">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu ">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs">
                                            <li class=""><a href="#tab1" class="active" data-toggle="tab">Waiting Approval</a></li>
                                            <li><a href="#tab2" data-toggle="tab">Rejected</a></li>
                                            <li><a href="#tab3" data-toggle="tab">Case</a></li>
                                            <li><a href="#tab4" data-toggle="tab">Approved</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active " id="tab1">
                                            <div class="table-responsive">
                                                <table id="example" class="hover table-bordered border-top-0 border-bottom-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Card No</th>
                                                            <th>Bank</th>
                                                            <th>Card Owner Name</th>
                                                            <th>Card Owner IC</th>
                                                            <!-- <th>Initial Price (RM)</th> -->
                                                            <th>Monthly Price (RM)</th>
                                                            <th>Created By</th>
                                                            <th>Card Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <div class="table-responsive">
                                                <table id="example2" class="hover table-bordered border-top-0 border-bottom-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Card No</th>
                                                            <th>Bank</th>
                                                            <th>Card Owner Name</th>
                                                            <th>Card Owner IC</th>
                                                            <!-- <th>Initial Price (RM)</th> -->
                                                            <th>Monthly Price (RM)</th>
                                                            <th>Created By</th>
                                                            <th>Card Status</th>
                                                            <th>Remarks</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <div class="table-responsive">
                                                <table id="example3" class="hover table-bordered border-top-0 border-bottom-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Card No</th>
                                                            <th>Bank</th>
                                                            <th>Card Owner Name</th>
                                                            <th>Card Owner IC</th>
                                                            <!-- <th>Initial Price (RM)</th> -->
                                                            <th>Monthly Price (RM)</th>
                                                            <th>Created By</th>
                                                            <th>Card Status</th>
                                                            <th>Remarks</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab4">
                                            <div class="table-responsive">
                                                <table id="example4" class="hover table-bordered border-top-0 border-bottom-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Card No</th>
                                                            <th>Bank</th>
                                                            <th>Card Owner Name</th>
                                                            <th>Card Owner IC</th>
                                                            <th>R Price (RM)</th>
                                                            <th>Approved Date</th>
                                                            <th>Created By</th>
                                                            <th>Rent To</th>
                                                            <th>C Price (RM)</th>
                                                            <th>Card Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>111</td>
                                                            <td>RHB</td>
                                                            <td>RHB card</td>
                                                            <td>111111</td>
                                                            <td>500000</td>
                                                            <td>2023-04-11</td>
                                                            <td>Master Admin</td>
                                                            <td>hihihi</td>
                                                            <td>111</td>
                                                            <td><b style='color:green'>Approved</b></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-info" onclick="rentModal([{&quot;id&quot;:1,&quot;card_id&quot;:1,&quot;year&quot;:2023,&quot;month&quot;:4,&quot;amount&quot;:316666.67,&quot;created_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;date_from&quot;:&quot;2023-04-12&quot;,&quot;date_to&quot;:&quot;2023-04-30&quot;,&quot;no_of_days&quot;:19,&quot;cost&quot;:500000,&quot;invoice_item_id&quot;:1,&quot;admin_cost&quot;:500000,&quot;admin_price&quot;:316666.67,&quot;agent_cost&quot;:500000,&quot;agent_price&quot;:316666.67}])">
                                                                    View Rent
                                                                </button>
                                                                <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:1,&quot;bank_id&quot;:5,&quot;card_name&quot;:&quot;RHB card&quot;,&quot;ic&quot;:&quot;111111&quot;,&quot;online_user_id&quot;:&quot;1111&quot;,&quot;online_password&quot;:&quot;1111&quot;,&quot;atm_password&quot;:&quot;1111&quot;,&quot;account_no&quot;:&quot;111&quot;,&quot;otp_no&quot;:&quot;1111&quot;,&quot;card_no&quot;:&quot;111&quot;,&quot;address_of_bank&quot;:&quot;111&quot;,&quot;secure_word&quot;:&quot;11&quot;,&quot;gmail_of_bank&quot;:&quot;111&quot;,&quot;token_key&quot;:&quot;11&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:500000,&quot;to_who&quot;:2,&quot;to_price&quot;:111,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:35:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;from_date&quot;:&quot;2023-04-12&quot;,&quot;to_date&quot;:null,&quot;remarks&quot;:null,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:111,&quot;home_address&quot;:&quot;111&quot;,&quot;mother_name&quot;:&quot;11&quot;,&quot;superadmin_cost&quot;:500000,&quot;admin_cost&quot;:500000,&quot;agent_cost&quot;:500000,&quot;bank&quot;:{&quot;id&quot;:5,&quot;name&quot;:&quot;RHB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:57:21.000000Z&quot;},&quot;from_user&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;Master Admin&quot;,&quot;username&quot;:&quot;masteradmin&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Masteradmin&quot;,&quot;contact_no&quot;:null,&quot;upline&quot;:null,&quot;is_active&quot;:1,&quot;created_at&quot;:null,&quot;updated_at&quot;:&quot;2023-04-13T20:15:19.000000Z&quot;},&quot;to_user&quot;:{&quot;id&quot;:2,&quot;name&quot;:&quot;1111&quot;,&quot;username&quot;:&quot;hihihi&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Customer&quot;,&quot;contact_no&quot;:&quot;111122&quot;,&quot;upline&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T01:25:14.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:25:37.000000Z&quot;},&quot;rent_pay&quot;:[{&quot;id&quot;:1,&quot;card_id&quot;:1,&quot;year&quot;:2023,&quot;month&quot;:4,&quot;amount&quot;:316666.67,&quot;created_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T01:41:24.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;date_from&quot;:&quot;2023-04-12&quot;,&quot;date_to&quot;:&quot;2023-04-30&quot;,&quot;no_of_days&quot;:19,&quot;cost&quot;:500000,&quot;invoice_item_id&quot;:1,&quot;admin_cost&quot;:500000,&quot;admin_price&quot;:316666.67,&quot;agent_cost&quot;:500000,&quot;agent_price&quot;:316666.67}]})">
                                                                    Edit
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>1212</td>
                                                            <td>AMBANK COMPANY</td>
                                                            <td>Am Card</td>
                                                            <td>121212</td>
                                                            <td>5000</td>
                                                            <td>2023-04-11</td>
                                                            <td>Master Admin</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><b style='color:green'>Approved</b></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-info" onclick="rentModal([])">
                                                                    View Rent
                                                                </button>
                                                                <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:2,&quot;bank_id&quot;:13,&quot;card_name&quot;:&quot;Am Card&quot;,&quot;ic&quot;:&quot;121212&quot;,&quot;online_user_id&quot;:&quot;2121&quot;,&quot;online_password&quot;:&quot;1212&quot;,&quot;atm_password&quot;:&quot;12121&quot;,&quot;account_no&quot;:&quot;12&quot;,&quot;otp_no&quot;:&quot;211&quot;,&quot;card_no&quot;:&quot;1212&quot;,&quot;address_of_bank&quot;:&quot;121&quot;,&quot;secure_word&quot;:&quot;121&quot;,&quot;gmail_of_bank&quot;:&quot;212&quot;,&quot;token_key&quot;:&quot;111&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:5000,&quot;to_who&quot;:null,&quot;to_price&quot;:null,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T02:26:54.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T02:28:18.000000Z&quot;,&quot;from_date&quot;:null,&quot;to_date&quot;:null,&quot;remarks&quot;:&quot;no success&quot;,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:null,&quot;home_address&quot;:&quot;121&quot;,&quot;mother_name&quot;:&quot;1212&quot;,&quot;superadmin_cost&quot;:5000,&quot;admin_cost&quot;:5000,&quot;agent_cost&quot;:5000,&quot;bank&quot;:{&quot;id&quot;:13,&quot;name&quot;:&quot;AMBANK COMPANY&quot;,&quot;created_at&quot;:&quot;2022-07-14T15:01:09.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T15:01:09.000000Z&quot;},&quot;from_user&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;Master Admin&quot;,&quot;username&quot;:&quot;masteradmin&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Masteradmin&quot;,&quot;contact_no&quot;:null,&quot;upline&quot;:null,&quot;is_active&quot;:1,&quot;created_at&quot;:null,&quot;updated_at&quot;:&quot;2023-04-13T20:15:19.000000Z&quot;},&quot;to_user&quot;:null,&quot;rent_pay&quot;:[]})">
                                                                    Edit
                                                                </button>
                                                                <button class="btn btn-sm btn-info" style="background-color:red" onclick="if(confirm('Are you sure you want to reject this card?')){ rejectModal({&quot;id&quot;:2,&quot;bank_id&quot;:13,&quot;card_name&quot;:&quot;Am Card&quot;,&quot;ic&quot;:&quot;121212&quot;,&quot;online_user_id&quot;:&quot;2121&quot;,&quot;online_password&quot;:&quot;1212&quot;,&quot;atm_password&quot;:&quot;12121&quot;,&quot;account_no&quot;:&quot;12&quot;,&quot;otp_no&quot;:&quot;211&quot;,&quot;card_no&quot;:&quot;1212&quot;,&quot;address_of_bank&quot;:&quot;121&quot;,&quot;secure_word&quot;:&quot;121&quot;,&quot;gmail_of_bank&quot;:&quot;212&quot;,&quot;token_key&quot;:&quot;111&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:5000,&quot;to_who&quot;:null,&quot;to_price&quot;:null,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T02:26:54.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T02:28:18.000000Z&quot;,&quot;from_date&quot;:null,&quot;to_date&quot;:null,&quot;remarks&quot;:&quot;no success&quot;,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:null,&quot;home_address&quot;:&quot;121&quot;,&quot;mother_name&quot;:&quot;1212&quot;,&quot;superadmin_cost&quot;:5000,&quot;admin_cost&quot;:5000,&quot;agent_cost&quot;:5000,&quot;bank&quot;:{&quot;id&quot;:13,&quot;name&quot;:&quot;AMBANK COMPANY&quot;,&quot;created_at&quot;:&quot;2022-07-14T15:01:09.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T15:01:09.000000Z&quot;},&quot;from_user&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;Master Admin&quot;,&quot;username&quot;:&quot;masteradmin&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Masteradmin&quot;,&quot;contact_no&quot;:null,&quot;upline&quot;:null,&quot;is_active&quot;:1,&quot;created_at&quot;:null,&quot;updated_at&quot;:&quot;2023-04-13T20:15:19.000000Z&quot;},&quot;to_user&quot;:null,&quot;rent_pay&quot;:[]}) }">Reject</button>
                                                                <button class="btn btn-sm btn-info" style="background-color:blue" onclick="if(confirm('Are you sure you want to case this card?')){ caseModal({&quot;id&quot;:2,&quot;bank_id&quot;:13,&quot;card_name&quot;:&quot;Am Card&quot;,&quot;ic&quot;:&quot;121212&quot;,&quot;online_user_id&quot;:&quot;2121&quot;,&quot;online_password&quot;:&quot;1212&quot;,&quot;atm_password&quot;:&quot;12121&quot;,&quot;account_no&quot;:&quot;12&quot;,&quot;otp_no&quot;:&quot;211&quot;,&quot;card_no&quot;:&quot;1212&quot;,&quot;address_of_bank&quot;:&quot;121&quot;,&quot;secure_word&quot;:&quot;121&quot;,&quot;gmail_of_bank&quot;:&quot;212&quot;,&quot;token_key&quot;:&quot;111&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:5000,&quot;to_who&quot;:null,&quot;to_price&quot;:null,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-11T02:26:54.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-11T02:28:18.000000Z&quot;,&quot;from_date&quot;:null,&quot;to_date&quot;:null,&quot;remarks&quot;:&quot;no success&quot;,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-11&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:null,&quot;home_address&quot;:&quot;121&quot;,&quot;mother_name&quot;:&quot;1212&quot;,&quot;superadmin_cost&quot;:5000,&quot;admin_cost&quot;:5000,&quot;agent_cost&quot;:5000,&quot;bank&quot;:{&quot;id&quot;:13,&quot;name&quot;:&quot;AMBANK COMPANY&quot;,&quot;created_at&quot;:&quot;2022-07-14T15:01:09.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T15:01:09.000000Z&quot;},&quot;from_user&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;Master Admin&quot;,&quot;username&quot;:&quot;masteradmin&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Masteradmin&quot;,&quot;contact_no&quot;:null,&quot;upline&quot;:null,&quot;is_active&quot;:1,&quot;created_at&quot;:null,&quot;updated_at&quot;:&quot;2023-04-13T20:15:19.000000Z&quot;},&quot;to_user&quot;:null,&quot;rent_pay&quot;:[]}) }">Case</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Card No/Company ID</td>
                                                            <td>MBB</td>
                                                            <td>Name</td>
                                                            <td>IC</td>
                                                            <td>123</td>
                                                            <td>2023-04-25</td>
                                                            <td>Master Admin</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><b style='color:green'>Approved</b></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-info" onclick="rentModal([])">
                                                                    View Rent
                                                                </button>
                                                                <button class="btn btn-sm btn-info" onclick="editModal({&quot;id&quot;:3,&quot;bank_id&quot;:1,&quot;card_name&quot;:&quot;Name&quot;,&quot;ic&quot;:&quot;IC&quot;,&quot;online_user_id&quot;:&quot;Online User ID&quot;,&quot;online_password&quot;:&quot;Online Password&quot;,&quot;atm_password&quot;:&quot;Atm Password&quot;,&quot;account_no&quot;:&quot;Account No&quot;,&quot;otp_no&quot;:&quot;OTP No&quot;,&quot;card_no&quot;:&quot;Card No\/Company ID&quot;,&quot;address_of_bank&quot;:&quot;Address of Bank&quot;,&quot;secure_word&quot;:&quot;Secure word&quot;,&quot;gmail_of_bank&quot;:&quot;Gmail of Bank&quot;,&quot;token_key&quot;:&quot;Company Name&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:123,&quot;to_who&quot;:null,&quot;to_price&quot;:null,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-25T15:24:07.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-25T15:28:46.000000Z&quot;,&quot;from_date&quot;:null,&quot;to_date&quot;:null,&quot;remarks&quot;:&quot;Case Remarks&quot;,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-25&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:null,&quot;home_address&quot;:&quot;Home Address&quot;,&quot;mother_name&quot;:&quot;Mother Name&quot;,&quot;superadmin_cost&quot;:123,&quot;admin_cost&quot;:123,&quot;agent_cost&quot;:123,&quot;bank&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;MBB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;},&quot;from_user&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;Master Admin&quot;,&quot;username&quot;:&quot;masteradmin&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Masteradmin&quot;,&quot;contact_no&quot;:null,&quot;upline&quot;:null,&quot;is_active&quot;:1,&quot;created_at&quot;:null,&quot;updated_at&quot;:&quot;2023-04-13T20:15:19.000000Z&quot;},&quot;to_user&quot;:null,&quot;rent_pay&quot;:[]})">
                                                                    Edit
                                                                </button>
                                                                <button class="btn btn-sm btn-info" style="background-color:red" onclick="if(confirm('Are you sure you want to reject this card?')){ rejectModal({&quot;id&quot;:3,&quot;bank_id&quot;:1,&quot;card_name&quot;:&quot;Name&quot;,&quot;ic&quot;:&quot;IC&quot;,&quot;online_user_id&quot;:&quot;Online User ID&quot;,&quot;online_password&quot;:&quot;Online Password&quot;,&quot;atm_password&quot;:&quot;Atm Password&quot;,&quot;account_no&quot;:&quot;Account No&quot;,&quot;otp_no&quot;:&quot;OTP No&quot;,&quot;card_no&quot;:&quot;Card No\/Company ID&quot;,&quot;address_of_bank&quot;:&quot;Address of Bank&quot;,&quot;secure_word&quot;:&quot;Secure word&quot;,&quot;gmail_of_bank&quot;:&quot;Gmail of Bank&quot;,&quot;token_key&quot;:&quot;Company Name&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:123,&quot;to_who&quot;:null,&quot;to_price&quot;:null,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-25T15:24:07.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-25T15:28:46.000000Z&quot;,&quot;from_date&quot;:null,&quot;to_date&quot;:null,&quot;remarks&quot;:&quot;Case Remarks&quot;,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-25&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:null,&quot;home_address&quot;:&quot;Home Address&quot;,&quot;mother_name&quot;:&quot;Mother Name&quot;,&quot;superadmin_cost&quot;:123,&quot;admin_cost&quot;:123,&quot;agent_cost&quot;:123,&quot;bank&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;MBB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;},&quot;from_user&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;Master Admin&quot;,&quot;username&quot;:&quot;masteradmin&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Masteradmin&quot;,&quot;contact_no&quot;:null,&quot;upline&quot;:null,&quot;is_active&quot;:1,&quot;created_at&quot;:null,&quot;updated_at&quot;:&quot;2023-04-13T20:15:19.000000Z&quot;},&quot;to_user&quot;:null,&quot;rent_pay&quot;:[]}) }">Reject</button>
                                                                <button class="btn btn-sm btn-info" style="background-color:blue" onclick="if(confirm('Are you sure you want to case this card?')){ caseModal({&quot;id&quot;:3,&quot;bank_id&quot;:1,&quot;card_name&quot;:&quot;Name&quot;,&quot;ic&quot;:&quot;IC&quot;,&quot;online_user_id&quot;:&quot;Online User ID&quot;,&quot;online_password&quot;:&quot;Online Password&quot;,&quot;atm_password&quot;:&quot;Atm Password&quot;,&quot;account_no&quot;:&quot;Account No&quot;,&quot;otp_no&quot;:&quot;OTP No&quot;,&quot;card_no&quot;:&quot;Card No\/Company ID&quot;,&quot;address_of_bank&quot;:&quot;Address of Bank&quot;,&quot;secure_word&quot;:&quot;Secure word&quot;,&quot;gmail_of_bank&quot;:&quot;Gmail of Bank&quot;,&quot;token_key&quot;:&quot;Company Name&quot;,&quot;from_who&quot;:1,&quot;from_price&quot;:123,&quot;to_who&quot;:null,&quot;to_price&quot;:null,&quot;is_approved&quot;:1,&quot;is_active&quot;:1,&quot;created_at&quot;:&quot;2023-04-25T15:24:07.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-04-25T15:28:46.000000Z&quot;,&quot;from_date&quot;:null,&quot;to_date&quot;:null,&quot;remarks&quot;:&quot;Case Remarks&quot;,&quot;initial_payment&quot;:null,&quot;approved_date&quot;:&quot;2023-04-25&quot;,&quot;approved_by&quot;:&quot;1&quot;,&quot;insurance&quot;:null,&quot;home_address&quot;:&quot;Home Address&quot;,&quot;mother_name&quot;:&quot;Mother Name&quot;,&quot;superadmin_cost&quot;:123,&quot;admin_cost&quot;:123,&quot;agent_cost&quot;:123,&quot;bank&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;MBB&quot;,&quot;created_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-07-14T14:56:42.000000Z&quot;},&quot;from_user&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;Master Admin&quot;,&quot;username&quot;:&quot;masteradmin&quot;,&quot;email&quot;:null,&quot;email_verified_at&quot;:null,&quot;role&quot;:&quot;Masteradmin&quot;,&quot;contact_no&quot;:null,&quot;upline&quot;:null,&quot;is_active&quot;:1,&quot;created_at&quot;:null,&quot;updated_at&quot;:&quot;2023-04-13T20:15:19.000000Z&quot;},&quot;to_user&quot;:null,&quot;rent_pay&quot;:[]}) }">Case</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/card/store">
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
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Card Cost (RM)</label>
                                <input type="text" class="form-control" name="from_price" id="from_price" placeholder="...">
                            </div>
                        </div>
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
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/card/setApprove">
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

<div id="caseModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title">Case Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/card/setCase">
                <input type="hidden" name="_token" value="84KWmXSLFpmKezgSqIsfUD2nIpemJgaikK4hpnuW">
                <div class="modal-body pd-20">
                    <input type="text" class="form-control" name="card_iddd" id="card_iddd" hidden>
                    <!-- <div class="form-group">
								<label class="form-label">Initial Cost (RM)</label>
								<input type="number" step="0.01" class="form-control" name="initial_cost" id="initial_cost" required>
							</div> -->
                    <div class="form-group">
                        <label class="form-label">Case Remarks</label>
                        <textarea class="form-control" name="case_remarks" id="case_remarks" required rows="5"></textarea>
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

<div id="rejectModal" class="modal fade">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h4 class="modal-title font-weight-bold" id="title">Reject Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="https://bankcardsample.system1906.com/card/setReject">
                <input type="hidden" name="_token" value="84KWmXSLFpmKezgSqIsfUD2nIpemJgaikK4hpnuW">
                <div class="modal-body pd-20">
                    <input type="text" class="form-control" name="card_idddd" id="card_idddd" hidden>
                    <!-- <div class="form-group">
								<label class="form-label">Initial Cost (RM)</label>
								<input type="number" step="0.01" class="form-control" name="initial_cost" id="initial_cost" required>
							</div> -->
                    <div class="form-group">
                        <label class="form-label">Reject Remarks</label>
                        <textarea class="form-control" name="reject_remarks" id="reject_remarks" required rows="5"></textarea>
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
                                <th></th>
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
        document.getElementById("from_price").value = '';
        document.getElementById("mother_name").value = '';
        document.getElementById("home_address").value = '';
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
        document.getElementById("from_price").value = data.from_price;
        document.getElementById("mother_name").value = data.mother_name;
        document.getElementById("home_address").value = data.home_address;
    }

    function approveModal(data) {
        $("#approveModal").modal();
        document.getElementById("card_idd").value = data.id;
        document.getElementById("monthly_cost").value = data.from_price;
    }

    function caseModal(data) {
        $("#caseModal").modal();
        document.getElementById("card_iddd").value = data.id;
    }

    function rejectModal(data) {
        $("#rejectModal").modal();
        document.getElementById("card_idddd").value = data.id;
    }

    function rentModal(data) {
        $("#rentingModal").modal();

        $('#items_details').empty();
        data.forEach(function(row) {
            $('#items_details').append('<tr><td>' + row.date_from + '</td><td>' + row.date_to + '</td><td>' + row.no_of_days + '</td><td>' + row.amount + '</td><td><button class="btn btn-sm btn-info" onclick="deleteRent(' + row.id + ')">Delete</button></td></tr>');
        });
    }

    function toMonthName(monthNumber) {
        const date = new Date();
        date.setMonth(monthNumber - 1);

        return date.toLocaleString('en-US', {
            month: 'long',
        });
    }

    function deleteRent(id) {
        if (confirm('Are you sure you want to delete this rent?')) {
            window.location.href = "https://bankcardsample.system1906.com/card/destroy_rentItem/" + id;
        }
    }
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php'); ?>