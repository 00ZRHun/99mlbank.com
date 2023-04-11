<?php 
include('header.php');
$search = false;
$customer = true;
$cs = true;
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['AddCard'])) {
	    echo "<script>window.location = 'add_inquiry.php';</script>";
	}
    elseif (isset($_POST['search'])) {
        $search = true;
        $source = $_POST['source'];
        $page_name = $_POST['page_name'];
        $master = $_POST['master'];
        $branch = $_POST['branch'];
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];
        $reject_reason = $_POST['reject_reason'];
        $customer_remark = $_POST['customer_remark'];
        $cs_remark = $_POST['cs_remark'];
        $amount = $_POST['amount'];
        $status = $_POST['status'];
        $state_confirmation = $_POST['state_confirmation'];
        $search_word = $_POST['search_word'];

        $sql = "SELECT * FROM inquiry WHERE center = '".$_SESSION['center_id']."' AND amount ".$amount;

        if ($source != "All") {
            $sql .= " AND source = '".$source."'";
        }

        if ($page_name != "All") {
            $sql .= " AND page_name = '".$page_name."'";
        }

        if ($master != "All") {
            $sql .= " AND agent_id = '".$master."'";
        }

        if ($branch != "All") {
            $sql .= " AND branch = '".$branch."'";
        }

        if ($date_from != "" && $date_to != "") {
            $sql .= " AND insert_date BETWEEN '".$date_from." 00:00:00' AND '".$date_to." 23:59:59'";
        } elseif ($date_from != "") {
            $sql .= " AND insert_date >= '".$date_from." 00:00:00'";
        } elseif ($date_to != "") {
            $sql .= " AND insert_date <= '".$date_to." 23:59:59'";
        }

        if ($reject_reason != "All") {
            $sql .= " AND cus_status = '".$reject_reason."'";
        }

        if ($customer_remark == "hide") {
            $customer = false;
        }

        if ($cs_remark == "hide") {
            $cs = false;
        }

        if ($status != "All") {
            $sql .= " AND status = '".$status."'";
        }

        if ($state_confirmation != "All") {
            $sql .= " AND state_confirmation = '".$state_confirmation."'";
        }

        if ($search_word != "") {
            $sql .= " AND (name LIKE '%".$search_word."%' OR ic LIKE '%".$search_word."%' OR contact_no LIKE '%".$search_word."%' OR email LIKE '%".$search_word."%')";
        }
    }
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Inquiry List</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}?>
	<a href="<?php echo $previous;?>" class="btn btn-info">Back</a>
    <?php 
	if(isset($success))
	{
	?>
    <section>
    	<div class="container">
        	<div class="row">
            	<div class="col-md-3"></div>
                <div class="col-md-6" style="color: green;font-size: 26px;">
                	<?php echo $success;?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
    <br/>
    <?php
	}?>
    <section>
    	<div class="container">
        	<div class="row">
                <div class="col-md-12">
                	<form method="post">
                        <input type="hidden" name="search">
                        <div class="row form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-1"><label>Source From</label></div>
                            <div class="col-md-2">
                                <select name="source" class="form-control">
                                    <option value="All">-- Show All --</option>
<?php
$sql1 = "SELECT source FROM inquiry WHERE center = '".$_SESSION['center_id']."' GROUP BY source;";
$res1 = mysqli_query($conn, $sql1);
while ($myrow = mysqli_fetch_array($res1)) {
    if (isset($source) && $source == $myrow['source']) {?>
                                    <option value="<?php echo $myrow['source'];?>" selected><?php echo $myrow['source'];?></option>
<?php     } else {?>
                                    <option value="<?php echo $myrow['source'];?>"><?php echo $myrow['source'];?></option>
<?php     }
}?>
                                </select>
                            </div>
                            <div class="col-md-1"><label>Page Name</label></div>
                            <div class="col-md-2">
                                <select name="page_name" class="form-control">
                                    <option value="All">-- Show All --</option>
<?php
$sql1 = "SELECT page_name FROM inquiry WHERE center = '".$_SESSION['center_id']."' GROUP BY page_name;";
$res1 = mysqli_query($conn, $sql1);
while ($myrow = mysqli_fetch_array($res1)) {
    if (isset($page_name) && $page_name == $myrow['page_name']) {?>
                                    <option value="<?php echo $myrow['page_name'];?>" selected><?php echo $myrow['page_name'];?></option>
<?php     } else {?>
                                    <option value="<?php echo $myrow['page_name'];?>"><?php echo $myrow['page_name'];?></option>
<?php     }
}?>
                                </select>
                            </div>
                            <div class="col-md-1"><label>Master</label></div>
                            <div class="col-md-2">
                                <select name="master" class="form-control">
                                    <option value="All">-- Show All --</option>
<?php
$sql2 = "SELECT * FROM users WHERE center_id = '".$_SESSION['center_id']."';";
$res2 = mysqli_query($conn, $sql2);
while ($myrow2 = mysqli_fetch_array($res2)) {
    if (isset($master) && $master == $myrow2['id']) {?>
                                    <option value="<?php echo $myrow2['id'];?>" selected><?php echo $myrow2['user_name'];?></option>
<?php     } else {?>
                                    <option value="<?php echo $myrow2['id'];?>"><?php echo $myrow2['user_name'];?></option>
<?php     }
}?>
                                </select>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-1"><label>Branch</label></div>
                            <div class="col-md-2">
                                <select name="branch" class="form-control">
                                    <option value="All">-- Show All --</option>
<?php
$sql1 = "SELECT branch FROM inquiry WHERE center = '".$_SESSION['center_id']."' GROUP BY branch;";
$res1 = mysqli_query($conn, $sql1);
while ($myrow = mysqli_fetch_array($res1)) {
    if (isset($branch) && $branch == $myrow['branch']) {?>
                                    <option value="<?php echo $myrow['branch'];?>" selected><?php echo $myrow['branch'];?></option>
<?php     } else {?>
                                    <option value="<?php echo $myrow['branch'];?>"><?php echo $myrow['branch'];?></option>
<?php     }
}?>
                                </select>
                            </div>
                            <div class="col-md-1"><label>Date From</label></div>
                            <div class="col-md-2">
                                <input type="date" name="date_from" class="form-control" value="<?php if (isset($date_from) && $date_from != "") { echo $date_from;}?>">
                            </div>
                            <div class="col-md-1"><label>Date To</label></div>
                            <div class="col-md-2">
                                <input type="date" name="date_to" class="form-control" value="<?php if (isset($date_to) && $date_to != "") { echo $date_to;}?>">
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-1"><label>Reject Reason</label></div>
                            <div class="col-md-2">
                                <select name="reject_reason" class="form-control">
                                    <option value="All" <?php if (isset($reject_reason) && $reject_reason == "All") { echo "selected";} ?>>-- Show All --</option>
                                    <option value="Incomplete Documents" <?php if (isset($reject_reason) && $reject_reason == "Incomplete Documents") { echo "selected";} ?>>Incomplete Documents</option>
                                    <option value="Dealing In Progress" <?php if (isset($reject_reason) && $reject_reason == "Dealing In Progress") { echo "selected";} ?>>Dealing In Progress</option>
                                    <option value="Considering" <?php if (isset($reject_reason) && $reject_reason == "Considering") { echo "selected";} ?>>Considering</option>
                                    <option value="Seen, But No Reply" <?php if (isset($reject_reason) && $reject_reason == "Seen, But No Reply") { echo "selected";} ?>>Seen, But No Reply</option>
                                    <option value="Unreachable" <?php if (isset($reject_reason) && $reject_reason == "Unreachable") { echo "selected";} ?>>Unreachable</option>
                                    <option value="Blacklist (Money Lender)" <?php if (isset($reject_reason) && $reject_reason == "Blacklist (Money Lender)") { echo "selected";} ?>>Blacklist (Money Lender)</option>
                                    <option value="Over-Commitment" <?php if (isset($reject_reason) && $reject_reason == "Over-Commitment") { echo "selected";} ?>>Over-Commitment</option>
                                    <option value="Committing Multiple Loans" <?php if (isset($reject_reason) && $reject_reason == "Committing Multiple Loans") { echo "selected";} ?>>Committing Multiple Loans</option>
                                    <option value="Blacklist (Company)" <?php if (isset($reject_reason) && $reject_reason == "Blacklist (Company)") { echo "selected";} ?>>Blacklist (Company)</option>
                                    <option value="Unstable Income" <?php if (isset($reject_reason) && $reject_reason == "Unstable Income") { echo "selected";} ?>>Unstable Income</option>
                                    <option value="Salary By Cash" <?php if (isset($reject_reason) && $reject_reason == "Salary By Cash") { echo "selected";} ?>>Salary By Cash</option>
                                    <option value="Uncompliable Request" <?php if (isset($reject_reason) && $reject_reason == "Uncompliable Request") { echo "selected";} ?>>Uncompliable Request</option>
                                    <option value="High Interest" <?php if (isset($reject_reason) && $reject_reason == "High Interest") { echo "selected";} ?>>High Interest</option>
                                    <option value="Low Salary" <?php if (isset($reject_reason) && $reject_reason == "Low Salary") { echo "selected";} ?>>Low Salary</option>
                                    <option value="Got A New Job" <?php if (isset($reject_reason) && $reject_reason == "Got A New Job") { echo "selected";} ?>>Got A New Job</option>
                                    <option value="Got Better Loan Offer" <?php if (isset($reject_reason) && $reject_reason == "Got Better Loan Offer") { echo "selected";} ?>>Got Better Loan Offer</option>
                                    <option value="Competitor Cut-in" <?php if (isset($reject_reason) && $reject_reason == "Competitor Cut-in") { echo "selected";} ?>>Competitor Cut-in</option>
                                    <option value="Rejected Without Reason" <?php if (isset($reject_reason) && $reject_reason == "Rejected Without Reason") { echo "selected";} ?>>Rejected Without Reason</option>
                                    <option value="Foreigner" <?php if (isset($reject_reason) && $reject_reason == "Foreigner") { echo "selected";} ?>>Foreigner</option>
                                    <option value="Underage" <?php if (isset($reject_reason) && $reject_reason == "Underage") { echo "selected";} ?>>Underage</option>
                                    <option value="Not Interested" <?php if (isset($reject_reason) && $reject_reason == "Not Interested") { echo "selected";} ?>>Not Interested</option>
                                    <option value="Government Official" <?php if (isset($reject_reason) && $reject_reason == "Government Official") { echo "selected";} ?>>Government Official</option>
                                    <option value="Unstable Hawker" <?php if (isset($reject_reason) && $reject_reason == "Unstable Hawker") { echo "selected";} ?>>Unstable Hawker</option>
                                    <option value="iPhone User" <?php if (isset($reject_reason) && $reject_reason == "iPhone User") { echo "selected";} ?>>iPhone User</option>
                                    <option value="Double Inquiry" <?php if (isset($reject_reason) && $reject_reason == "Double Inquiry") { echo "selected";} ?>>Double Inquiry</option>
                                    <option value="Pencen / Retired" <?php if (isset($reject_reason) && $reject_reason == "Pencen / Retired") { echo "selected";} ?>>Pencen / Retired</option>
                                    <option value="Admin Rejected" <?php if (isset($reject_reason) && $reject_reason == "Admin Rejected") { echo "selected";} ?>>Admin Rejected</option>
                                    <option value="Scammer" <?php if (isset($reject_reason) && $reject_reason == "Scammer") { echo "selected";} ?>>Scammer</option>
                                    <option value="Confirm Don't Want" <?php if (isset($reject_reason) && $reject_reason == "Confirm Don't Want") { echo "selected";} ?>>Confirm Don't Want</option>
                                    <option value="Unemployed" <?php if (isset($reject_reason) && $reject_reason == "Unemployed") { echo "selected";} ?>>Unemployed</option>
                                    <option value="Chinese" <?php if (isset($reject_reason) && $reject_reason == "Chinese") { echo "selected";} ?>>Chinese</option>
                                    <option value="Company's Client" <?php if (isset($reject_reason) && $reject_reason == "Company's Client") { echo "selected";} ?>>Company's Client</option>
                                    <option value="Unqualified" <?php if (isset($reject_reason) && $reject_reason == "Unqualified") { echo "selected";} ?>>Unqualified</option>
                                    <option value="No Apply" <?php if (isset($reject_reason) && $reject_reason == "No Apply") { echo "selected";} ?>>No Apply</option>
                                    <option value="No Online Banking" <?php if (isset($reject_reason) && $reject_reason == "No Online Banking") { echo "selected";} ?>>No Online Banking</option>
                                    <option value="No Pick Up" <?php if (isset($reject_reason) && $reject_reason == "No Pick Up") { echo "selected";} ?>>No Pick Up</option>
                                </select>
                            </div>
                            <div class="col-md-1"><label>Customer Remark</label></div>
                            <div class="col-md-2">
                                <select name="customer_remark" class="form-control">
                                    <option value="show" <?php if ($customer == true) { echo "selected"; }?>>Show</option>
                                    <option value="hide" <?php if ($customer == false) { echo "selected"; }?>>Hide</option>
                                </select>
                            </div>
                            <div class="col-md-1"><label>CS Remark</label></div>
                            <div class="col-md-2">
                                <select name="cs_remark" class="form-control">
                                    <option value="show" <?php if ($cs == true) { echo "selected"; }?>>Show</option>
                                    <option value="hide" <?php if ($cs == false) { echo "selected"; }?>>Hide</option>
                                </select>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-1"><label>Amount</label></div>
                            <div class="col-md-2">
                                <select name="amount" class="form-control">
<?php 
if (isset($amount)) {
    switch ($amount) {
        case '>= 0':?>
                                    <option value=">= 0" selected>-- Show All --</option>
                                    <option value="< 3000">< 3000</option>
                                    <option value="BETWEEN 3000 AND 5000">3000~5000</option>
                                    <option value="> 5000">> 5000</option>
<?php             break;
        case '< 3000':?>
                                    <option value=">= 0">-- Show All --</option>
                                    <option value="< 3000" selected>< 3000</option>
                                    <option value="BETWEEN 3000 AND 5000">3000~5000</option>
                                    <option value="> 5000">> 5000</option>
<?php             break;
        case 'BETWEEN 3000 AND 5000':?>
                                    <option value=">= 0">-- Show All --</option>
                                    <option value="< 3000">< 3000</option>
                                    <option value="BETWEEN 3000 AND 5000" selected>3000~5000</option>
                                    <option value="> 5000">> 5000</option>
 <?php            break;
        case '> 5000':?>
                                    <option value=">= 0">-- Show All --</option>
                                    <option value="< 3000">< 3000</option>
                                    <option value="BETWEEN 3000 AND 5000">3000~5000</option>
                                    <option value="> 5000" selected>> 5000</option>
 <?php            break;
    }
} else {?>
                                    <option value=">= 0" selected>-- Show All --</option>
                                    <option value="< 3000">< 3000</option>
                                    <option value="BETWEEN 3000 AND 5000">3000~5000</option>
                                    <option value="> 5000">> 5000</option>
<?php }?>
                                </select>
                            </div>
                            <div class="col-md-1"><label>Status</label></div>
                            <div class="col-md-2">
                                <select name="status" class="form-control">
                                    <option value="All" <?php if (isset($status) && $status == "All") { echo "selected"; }?>>-- Show All --</option>
                                    <option value="Pending" <?php if (isset($status) && $status == "Pending") { echo "selected"; }?>>Pending</option>
                                    <option value="Incomplete" <?php if (isset($status) && $status == "Incomplete") { echo "selected"; }?>>Incomplete</option>
                                    <option value="Called" <?php if (isset($status) && $status == "Called") { echo "selected"; }?>>Called</option>
                                    <option value="Waiting Reply" <?php if (isset($status) && $status == "Waiting Reply") { echo "selected"; }?>>Waiting Reply</option>
                                    <option value="Potential" <?php if (isset($status) && $status == "Potential") { echo "selected"; }?>>Potential</option>
                                    <option value="Processing" <?php if (isset($status) && $status == "Processing") { echo "selected"; }?>>Processing</option>
                                    <option value="Reprocessing" <?php if (isset($status) && $status == "Reprocessing") { echo "selected"; }?>>Reprocessing</option>
                                    <option value="Outstation" <?php if (isset($status) && $status == "Outstation") { echo "selected"; }?>>Outstation</option>
                                    <option value="No Response" <?php if (isset($status) && $status == "No Response") { echo "selected"; }?>>No Response</option>
                                    <option value="Rejected" <?php if (isset($status) && $status == "Rejected") { echo "selected"; }?>>Rejected</option>
                                    <option value="Agent Rejected" <?php if (isset($status) && $status == "Agent Rejected") { echo "selected"; }?>>Agent Rejected</option>
                                    <option value="Success" <?php if (isset($status) && $status == "Success") { echo "selected"; }?>>Success</option>
                                </select>
                            </div>
                            <div class="col-md-1"><label>State Confirmation</label></div>
                            <div class="col-md-2">
                                <select name="state_confirmation" class="form-control">
                                    <option value="All" <?php if (isset($state_confirmation) && $state_confirmation == "All") { echo "selected"; }?>>-- Show All --</option>
                                    <option value="Kuala Lumpur" <?php if (isset($state_confirmation) && $state_confirmation == "Kuala Lumpur") { echo "selected"; }?>>Kuala Lumpur</option>
                                    <option value="Selangor" <?php if (isset($state_confirmation) && $state_confirmation == "Selangor") { echo "selected"; }?>>Selangor</option>
                                    <option value="Putrajaya" <?php if (isset($state_confirmation) && $state_confirmation == "Putrajaya") { echo "selected"; }?>>Putrajaya</option>
                                    <option value="Johor" <?php if (isset($state_confirmation) && $state_confirmation == "Johor") { echo "selected"; }?>>Johor</option>
                                    <option value="Kedah" <?php if (isset($state_confirmation) && $state_confirmation == "Kedah") { echo "selected"; }?>>Kedah</option>
                                    <option value="Kelantan" <?php if (isset($state_confirmation) && $state_confirmation == "Kelantan") { echo "selected"; }?>>Kelantan</option>
                                    <option value="Melaka" <?php if (isset($state_confirmation) && $state_confirmation == "Melaka") { echo "selected"; }?>>Melaka</option>
                                    <option value="Negeri Sembilan" <?php if (isset($state_confirmation) && $state_confirmation == "Negeri Sembilan") { echo "selected"; }?>>Negeri Sembilan</option>
                                    <option value="Pahang" <?php if (isset($state_confirmation) && $state_confirmation == "Pahang") { echo "selected"; }?>>Pahang</option>
                                    <option value="Perak" <?php if (isset($state_confirmation) && $state_confirmation == "Perak") { echo "selected"; }?>>Perak</option>
                                    <option value="Perlis" <?php if (isset($state_confirmation) && $state_confirmation == "Perlis") { echo "selected"; }?>>Perlis</option>
                                    <option value="Pulau Pinang" <?php if (isset($state_confirmation) && $state_confirmation == "Pulau Pinang") { echo "selected"; }?>>Pulau Pinang</option>
                                    <option value="Terengganu" <?php if (isset($state_confirmation) && $state_confirmation == "Terengganu") { echo "selected"; }?>>Terengganu</option>
                                    <option value="Labuan" <?php if (isset($state_confirmation) && $state_confirmation == "Labuan") { echo "selected"; }?>>Labuan</option>
                                    <option value="Sabah" <?php if (isset($state_confirmation) && $state_confirmation == "Sabah") { echo "selected"; }?>>Sabah</option>
                                    <option value="Sarawak" <?php if (isset($state_confirmation) && $state_confirmation == "Sarawak") { echo "selected"; }?>>Sarawak</option>
                                    <option value="Others" <?php if (isset($state_confirmation) && $state_confirmation == "Others") { echo "selected"; }?>>Others</option>
                                </select>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-1"><label>Search</label></div>
                            <div class="col-md-4">
                                <input type="text" name="search_word" class="form-control" placeholder="Name / IC Number / Contact No / Email" value="<?php if (isset($search_word) && $search_word != "") { echo $search_word;}?>">
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-1"><label></label></div>
                            <div class="col-md-2"></div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3"></div>
                        	<div class="col-md-3"></div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success" name="search">Search</button>
                                &nbsp;&nbsp;
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <br/>    
    <section>
    	<div class="container">
        	<div class="row" style="overflow-x: auto;">
                <table cellspacing="0" cellpadding="2" class="table table-striped table-bordered" style="width: 100%;">
                    <caption class="menu-header">Inquiry List</caption>
                    <thead>
                        <tr class="customer_table">
                            <th>&nbsp;</th>
                            <th>No.</th>
                            <th>Page Name</th>
                            <th>Source From</th>
                            <th>Branch</th>
                            <th>Name</th>
                            <th>Contact No</th>
                            <th>Location</th>
                            <th>Amount</th>
<?php if ($customer == true) {?>
                            <th>Customer Remark</th>
<?php }
if ($cs == true) {?>
                            <th>CS Remark</th>
<?php }?>
                            <th>Insert Date</th>
                            <th>Passing Date</th>
                            <th>First Seen</th>
                            <th>Time to Success</th>
                            <th>Inquiry Type</th>
                            <th>Status</th>
                            <th>Customer Status</th>
                            <th>Notes</th>
                            <th>Loans</th>
                            <th>Customer Data</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$i = 1;
if ($search == false) {
    $sql = "SELECT * FROM inquiry WHERE center = '".$_SESSION['center_id']."';";
}
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                    	<tr>
                    		<td></td>
                    		<td><?php echo $i++;?></td>
                    		<td><?php echo $myrow['page_name'];?></td>
                    		<td><?php echo $myrow['source'];?></td>
                    		<td><?php echo $myrow['branch'];?></td>
                    		<td><?php echo $myrow['name'];?></td>
                    		<td><?php echo $myrow['contact_no'];?></td>
                    		<td><?php echo $myrow['state']." (".$myrow['state_confirmation'].")";?></td>
                    		<td><?php echo $myrow['amount'];?></td>
<?php if ($customer == true) {?>
                            <td><?php echo $myrow['customer_remark'];?></td>
<?php }
if ($cs == true) {?>
                            <td><?php echo $myrow['cs_remark'];?></td>
<?php }?>
                    		<td><?php echo $myrow['insert_date'];?></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td><?php echo $myrow['type'];?></td>
                    		<td><?php echo $myrow['status'];?></td>
                    		<td><?php echo $myrow['CUS_status'];?></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td><a style="color: #2980dd;" href="add_inquiry.php?i=<?php echo $myrow['id'];?>">Edit</a></td>
                    	</tr>
<?php }?>
                    </tbody>
                </table>
            </div>
        <br/>
        
	        <div class="container">
	        	<form id="form1" name="form1" method="post">
	                <p align="center">
	                  <label>
	                  <input name="AddCard" type="submit" class="btn btn-success" id="AddCard" value="Create">
	                  </label>
	                </p>
	            </form>
	        </div>
        </div>
    </section>
</div>
<style>
body
{
	color: #000;
}
.customer_table
{
	color: #000;
}
.content-header {
	background: #f1f1f1;
	box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.05);
	border-bottom: 1px solid #d0d0d0;
	min-height: 54px;
	height: auto;
	margin-bottom: 20px;
}
.content-header h1 {
	color: #0e0d0d;
	font-size: 22px;
	font-weight: 500;
}

.container-fluid {
	 width: 100%; 
	 padding-right:0px !important; 
	 padding-left:0px !important;
	 margin-right: auto; 
	 margin-left: auto; 
	left: 0;
}
label
{
	font-size: 14px;
	color: #000;
}
caption {
	height: 42px;
	padding-top: 6px !important;
	font-family: Arial, Helvetica, sans-serif;
	font-size: medium;
	font-weight: bold;
	color: #FFF;
	background-color: #038603;
	border-top-style: double;
	border-right-style: double;
	border-bottom-style: double;
	border-left-style: double;
	padding-top:0px;
	padding-bottom:0px;
	text-align: center;
	caption-side: top;
}
.ErrMsg {
    font-family: Arial, Helvetica, sans-serif;
    color: #FF0000;
}
.SubMenuCaption {
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    color: #FFFFFF;
    /*background-color: #A7B5CE;*/
    border-top-style: none;
    border-right-style: none;
    border-bottom-style: none;
    border-left-style: none;
}

.SpecialHeader {
    color: #0000FF;
}
.btn-success
{
	background:#038603 !important;
}
</style>