<?php 
include('header.php');
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['search'])) {
		$searchText = $_POST['searchText'];
	}
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Uncollected Report</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php
if ($_SESSION['center_id'] == 5) {?>
    <form method="post">
			<a href="dashboard.php" class="btn btn-info">Back</a>
			<br>
			<label>Start Date/Deadline/Code：</label>
			<input type="text" name="searchText">
			<input type="submit" name="search" class="btn btn-success" value="Search">
		</form>
<?php }?>
    <section id="id_center_table">
	<table cellspacing="1" cellpadding="1" style="width:80%" class="table table-striped table-bordered" align="center">
		<caption class="menu-header">Uncollected Report</caption>
<?php
if ($_SESSION['center_id'] != 5) {?>
		<thead>
			<tr>
				<th>Center ID</th>
				<th>Amount</th>
				<th>Total Collection</th>
				<th>Remaining</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$total_loanouts = 0;
			$total_collections = 0;
			$total_balance = 0;
			$current_user_center= '';
			if($_SESSION["group_name"]!='superadmin')			
			{
				$current_user_center = " WHERE id = ".$_SESSION["center_id"];
			}
			//$sql ="SELECT * FROM center_detail";
			
			$sql ="SELECT * FROM ".$table_prefix."center_detail".$current_user_center;

			$result = mysqli_query($conn,$sql);
			if($result->num_rows > 0)
			{
				while($rowss = $result->fetch_assoc())
				{
					$customercard_id=array();
					$where_card_hwe='';
				?>
				<tr>
					<td><span id="id_date_monthly" style="color:#0066FF; cursor:pointer" class="cls_centers" data-id="<?php echo $rowss['id']; ?>"><?php echo $rowss['id'].'-'.$rowss['center_name'];?></span></td>
					<td><?php 
					
						$loan_outs = 0;
						/*
						if($_SESSION["group_name"]!='superadmin')			
						{
							$sql1 = "SELECT id,loan_out FROM customers_card WHERE user_agent_id=".$_SESSION['agent_id']." and center_id=".$rowss['id']." AND clear_payment!=1";
							
						}
						else
						{
							$sql1 = "SELECT id,loan_out FROM customers_card WHERE center_id=".$rowss['id']." AND clear_payment!=1";
						}
						*/
						if($_SESSION["group_name"]=='superadmin')			
						{
						$sql1 = "SELECT id,loan_out FROM ".$table_prefix."customers_card WHERE center_id=".$rowss['id']." AND clear_payment!=1";
							
						}
						else
						{
							if ($_SESSION['group_name'] != 'admin') {
								$sql1 = "SELECT id,loan_out FROM ".$table_prefix."customers_card WHERE user_agent_id=".$_SESSION['agent_id']." and center_id=".$rowss['id']." AND clear_payment!=1";
							} else {
								$sql1 = "SELECT id,loan_out FROM ".$table_prefix."customers_card WHERE center_id=".$rowss['id']." AND clear_payment!=1";
							}
						}
						
						$results = mysqli_query($conn,$sql1);
						
						if($results->num_rows > 0)
						{
							while($rowss12 = $results->fetch_assoc())
							{
								
								$customercard_id[]=$rowss12['id'];
								$loan_outs += $rowss12['loan_out'];
							}
						}
				
						echo number_format($loan_outs,2);
					?></td>
					<td>
					<?php 
					
					$where_card_hwe = ' WHERE card_id IN ('.implode(',',$customercard_id).')';
						$collections = 0;
						//$sql2 = "SELECT amount FROM collection WHERE user_agent_id=".$_SESSION['agent_id'];
						$sql2 = "SELECT amount FROM ".$table_prefix."collection".$where_card_hwe;
						$results12 = mysqli_query($conn,$sql2);
						if($results12->num_rows > 0)
						{
							while($rowss123 = $results12->fetch_assoc())
							{
								$collections += $rowss123['amount'];
							}
						}
						echo number_format($collections,2);
					?>
					</td>
					<td>				
						<?php 
						$total_loanouts += $loan_outs;
						$total_collections += $collections;
						$total_balance += $collections-$loan_outs;
						
						echo number_format($collections-$loan_outs,2);?>
					</td>
				</tr>
				<?php
					
					
				}
			}
			?>
			<tr style="background-color:#038603;color:white;";>
				<td>Total:</td>
				<td><?php echo number_format($total_loanouts,2);?></td>
				<td><?php echo number_format($total_collections,2);?></td>
				<td><?php echo number_format($total_balance,2);?></td>
			</tr>
	
		 <tr>
    <td class="ConfirmValue">printed at<font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> <?php echo date("d/m/Y H:i:s");?></strong></font></td>
  </tr>
		</tbody>
<?php } else {?>
		<thead>
			<th>Start Date</th>
	        <th>Code</th>
	        <th>Amount</th>
	        <th>Interest</th>
	        <th>Deposit</th>
	        <th>STP</th>
	        <th>Days</th>
	        <th>Deadline</th>
	        <th>On Hand</th>
	        <th>Repaid Amount</th>
	        <th>Interest Received</th>
	        <th>Profit</th>
	        <th>Remaining</th>
		</thead>
		<tbody>
<?php
if ($_SESSION['group_name'] != "admin") {
	$sql = "SELECT * FROM customers_card WHERE user_agent_id = '".$_SESSION['agent_id']."' AND center_id = '5' AND clear_payment != '1'";
} else {
	$sql = "SELECT * FROM customers_card WHERE center_id = '5' AND clear_payment != '1'";
}

if (isset($searchText)) {
	$sql .= " AND (start_date LIKE '%".$searchText."%' OR crossed_date LIKE '%".$searchText."%' OR code LIKE '%".$searchText."%')";
}

$total_loan_out = 0;
$total_profit = 0;
$total_deposit = 0;
$total_advance = 0;

$total_onhand = 0;
$total_amount_paid = 0;
$total_interest_paid = 0;
$total_profit_paid = 0;
$total_remainig = 0;

$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
	$onhand = $myrow['loan_out'] - $myrow['profit'] - $myrow['deposit'] - $myrow['advance'];
	$total_loan_out += $myrow['loan_out'];
	$total_profit += $myrow['profit'];
	$total_deposit += $myrow['deposit'];
	$total_advance += $myrow['advance'];

	$total_onhand += $onhand;
?>
			<tr>
				<td><?php echo $myrow['start_date'];?></td>
				<td><?php echo $myrow['code'];?></td>
				<td><?php echo $myrow['loan_out'];?></td>
				<td><?php echo $myrow['profit'];?></td>
				<td><?php echo $myrow['deposit'];?></td>
				<td><?php echo $myrow['advance'];?></td>
				<td><?php echo $myrow['no_of_terms'];?></td>
				<td><?php echo $myrow['crossed_date'];?></td>
				<td><?php echo $onhand;?></td>
<?php
$amount_paid = 0;
$interest_paid = 0;
$profit_paid = 0;
$remaining = 0;
$sql1 = "SELECT * FROM collection WHERE card_id = '".$myrow['id']."';";
$res1 = mysqli_query($conn, $sql1);
while ($myrow1 = mysqli_fetch_array($res1)) {
	$amount_paid += $myrow1['amount'];
	$interest_paid += $myrow1['interest'];
}
$profit_paid = $amount_paid - $onhand + $interest_paid;
$remaining = $onhand - $amount_paid;

$total_amount_paid += $amount_paid;
$total_interest_paid += $interest_paid;
$total_profit_paid += $profit_paid;
$total_remaining += $remaining;
?>
				<td><?php echo $amount_paid;?></td>
				<td><?php echo $interest_paid;?></td>
				<td><?php echo $profit_paid;?></td>
				<td><?php echo $remaining;?></td>
			</tr>
<?php }?>
			<tr style="background-color:#038603;color:white;";>
				<td colspan="2">Total</td>
				<td><?php echo $total_loan_out;?></td>
				<td><?php echo $total_profit;?></td>
				<td><?php echo $total_deposit;?></td>
				<td><?php echo $total_advance;?></td>
				<td></td>
				<td></td>
				<td><?php echo $total_onhand;?></td>
				<td><?php echo $total_amount_paid;?></td>
				<td><?php echo $total_interest_paid;?></td>
				<td><?php echo $total_profit_paid;?></td>
				<td><?php echo $total_remaining;?></td>
			</tr>
	
		 <tr>
    <td class="ConfirmValue" colspan="13">printed at<font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> <?php echo date("d/m/Y H:i:s");?></strong></font></td>
  </tr>
		</tbody>
<?php }?>
	</table>
    </section>
    <section id="id_new_hwe_table">
    <button type="button" class="btn btn-info back">Back</button>
	<table cellspacing="1" cellpadding="1" style="width:80%" class="table table-striped table-bordered show_center_card_list" align="center">
		<caption class="menu-header">Customer Information</caption>
		<thead>
			<tr>
				<th>Customer ID</th>
				<th>Name</th>
				<th>Card ID</th>
                <th>Loan Out</th>
                <th>Collection</th>
                <th>Balance</th>
			</tr>
		</thead>
		<tbody>
		
				<tr>
					<td></td>
					<td></td>
					
				</tr>
			
			<tr style="background-color:#038603;color:white;";>
				<td>Total</td>
				<td></td>
				
			</tr>
		</tbody>
	</table>
    </section>
</div>
<style>
.ConfirmValue
{
	font-size: small;
	color: #0000FF;
	font-weight: normal;
}
.ErrMsg
{
	color:#F00;
}
body
{
	color:#000;
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
.SubMenuCaption {
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    color: #000000;
    background-color: #A7B5CE;
    border-top-style: none;
    border-right-style: none;
    border-bottom-style: none;
    border-left-style: none;
}

.width_hwe
{
	float:right;
	width:95%;
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
.btn-success
{
	background:#038603 !important;
}
</style>
<script>
$(document).ready(function(){
	$("#id_new_hwe_table").hide();
  
  $(".cls_centers").click(function(){
		var center_id_hwe = jQuery(this).attr("data-id");
	
		$(".show_center_card_list tbody").empty();
		$.ajax({
		  type: 'post',
		  url: 'get_center_id_base_record.php',
		  data: {center_id_hwe:center_id_hwe},
		  success: function (data){
			 console.log(data);
			$(".show_center_card_list tbody").html(data);
			$("#id_center_table").hide();
   			$("#id_new_hwe_table").show();
		 
			}
		  
		});
   
  });
  
  $(".back").click(function(){
		$("#id_new_hwe_table").hide();	
		$("#id_center_table").show();
	});
  
});
</script>