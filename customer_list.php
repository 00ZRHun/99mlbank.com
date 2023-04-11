<?php 
include('header.php');
$search = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$search = true;
	$date_from = $_POST['date_from'];
	$date_to = $_POST['date_to'];

	$master = $_POST['master'];
	$risk = $_POST['risk'];

	$search_bank = $_POST['search_bank'];
	$search_text = $_POST['search_text'];
	$sql = "SELECT * FROM a_customer WHERE center_id = '".$_SESSION['center_id']."' AND created_date BETWEEN '".$date_from."' AND '".$date_to."'";

    if ($search_bank != "") {
        $sql .= " AND (bank_account LIKE '%".$search_bank."%' OR bank_holder LIKE '%".$search_bank."%')";
    }

    if ($search_text != "") {
        $sql .= " AND (name LIKE '%".$search_text."%' OR ic LIKE '%".$search_text."%' OR mobile LIKE '%".$search_text."%' OR email LIKE '%".$search_text."%')";
    }
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Customer List</h1></center>
         
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
<?php }?>
    <section>
    	<div class="container" >
        	<div class="row">
                <div class="col-md-12">
                	<form method="post">
                    	<div class="row form-group">
                			<div class="col-md-2"></div>
                        	<div class="col-md-2"><label>Date From: </label></div>
                            <div class="col-md-2"><input type="date" name="date_from" class="form-control" value="<?php if (isset($date_from)) { echo $date_from; } else { echo "2017-01-01"; }?>"></div>
                        	<div class="col-md-2"><label>Date To: </label></div>
                            <div class="col-md-2"><input type="date" name="date_to" class="form-control" value="<?php if (isset($date_to)) { echo $date_to; } else { echo date("Y-m-d"); }?>"></div>
                			<div class="col-md-2"></div>
                        </div>
                    	<div class="row form-group">
                			<div class="col-md-2"></div>
                        	<div class="col-md-2"><label>Master: </label></div>
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
                			<div class="col-md-2"><label>High Risk: </label></div>
                            <div class="col-md-2">
                            	<select name="risk" class="form-control">
                            		<option value="All">-- Show All --</option>
<?php
if (isset($risk)) {
	if ($risk == "yes") {?>
                            		<option value="yes" selected>Yes</option>
                            		<option value="no">No</option>
<?php 	} elseif ($risk == "no") {?>
                            		<option value="yes">Yes</option>
                            		<option value="no" selected>No</option>
<?php 	}
} else {?>
                            		<option value="yes">Yes</option>
                            		<option value="no">No</option>
<?php }?>
                            	</select>
                            </div>
                			<div class="col-md-2"></div>
                        </div>
                    	<div class="row form-group">
                			<div class="col-md-2"></div>
                        	<div class="col-md-2"><label>Search Bank: </label></div>
                            <div class="col-md-2"><input type="text" name="search_bank" class="form-control" placeholder="Bank Holder / Bank Number" value="<?php if (isset($search_bank)) { echo $search_bank; }?>"></div>
                        	<div class="col-md-2"><label>Search: </label></div>
                            <div class="col-md-2"><input type="text" name="search_text" class="form-control" placeholder="Name / IC Number / Contact No / Email" value="<?php if (isset($search_text)) { echo $search_text; }?>"></div>
                			<div class="col-md-2"></div>
                        </div>
                        <div class="row form-group">
                        	<div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" name="search">Search</button>
                                &nbsp;&nbsp;
                                <button type="reset" name="reset" class="btn btn-success">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <br/>    
    <section>
    	<div class="container" style="overflow:auto;">
        	<div class="row" >
                <table cellspacing="0" cellpadding="2" class="table table-striped table-bordered" style="width: 100%;">
                    <caption class="menu-header">
                    Customer Information
                    </caption>
                    <thead style="text-align: center;">
                        <tr class="customer_table">
                            <th rowspan="2" >No</th>
                            <th rowspan="2">Customer Code</th>
                            <th rowspan="2">IC</th>
                            <th rowspan="2">Name</th>
                            <th rowspan="2">Phone No</th>
                            <th rowspan="2">Race</th>
                            <th rowspan="2">Family</th>
                            <th rowspan="2">Create Date</th>
                            <th rowspan="2">Remark</th>
                            <th colspan="6">Loans</th>
                            <th colspan="2" rowspan="2"></th>
                        </tr>
                        <tr>
                        	<th>Normal</th>
                        	<th>Completed</th>
                        	<th>Bad Debt</th>
                        	<th>Bad Debt Completed</th>
                        	<th>Total</th>
                        	<th>High Risk</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$i = 1;
if ($search == false) {
	$sql = "SELECT * FROM a_customer WHERE center_id = '".$_SESSION['center_id']."';";
}
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
						<tr style="text-align: center;">
							<td><?php echo $i++;?></td>
							<td><?php echo $myrow['id'];?></td>
							<td><?php echo $myrow['ic'];?></td>
							<td><?php echo $myrow['name'];?></td>
							<td><?php echo $myrow['tel'];?></td>
							<td><?php echo $myrow['race']."<br>".$myrow['gender'];?></td>
							<td><?php if ($myrow['martial'] != "--- Select Martial Status ---") { echo $myrow['martial']; } echo "<br>"; if ($myrow['no_child'] != "") { if ($myrow['no_child'] == "1" || $myrow['no_child'] == "0") { echo $myrow['no_child']." Child"; } else { echo $myrow['no_child']." Children"; } } else { echo "0 Child"; }?></td>
							<td><?php echo $myrow['created_date']."<br>".$myrow['created_time'];?></td>
							<td><?php echo $myrow['personal_remark'];?></td>
							<td>---</td>
							<td>---</td>
							<td>---</td>
							<td>---</td>
							<td>---</td>
							<td>---</td>
							<td><a href="add_customer.php?c=<?php echo $myrow['id'];?>">Edit</a></td>
						</tr>
<?php }?>
                    </tbody>
                    <tfoot>
                        <tr style="text-align: center;">
                            <th colspan="15"><a href="add_customer.php" class="btn btn-success">Create New Customer</a></th>
                        </tr>
                    </tfoot>
                </table>
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
	width: 10%;
	
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

.container222 {
    width: 80%; 
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