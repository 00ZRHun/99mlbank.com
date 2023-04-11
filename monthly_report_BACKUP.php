<?php 
include('header.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['rpt01'])) {
		$report = "rpt01";
	} elseif (isset($_POST['rpt02'])) {
		$report = "rpt02";
	} elseif (isset($_POST['rpt03'])) {
		$report = "rpt03";
	} elseif (isset($_POST['rpt04'])) {
		$report = "rpt04";
	} elseif (isset($_POST['rpt05'])) {
		$report = "rpt05";
	} elseif (isset($_POST['rpt06'])) {
		$report = "rpt06";
	}

	$t_center_id = $_POST['t_center_id'];
	$all_center = $_POST['all_center'];
	$d_startMonth = $_POST['d_startMonth'];
	$d_startYear = $_POST['d_startYear'];	

	if (isset($_POST['search'])) {
		$searchText = $_POST['searchText'];
		if ($_POST['searchDate'] != "") {
			$searchDate = date("d-m-Y", strtotime($_POST['searchDate']));
		}
		$report = $_POST['report'];
	}

}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Monthly report</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
	<?php 
if($report == "rpt01")
{?>


<section>
	<div class="">
		<p><strong>		
		<?php echo $d_startMonth.'-'.$d_startYear;?></strong>
		Monthly Report<span class="ConfirmValue">  </span></p>
	</div>
	<a href="monthly_report.php" class="btn btn-info">Back</a>
<?php
if ($_SESSION['center_id'] == 5) {?>
	<form method="post">
		<input type="hidden" name="report" value="rpt01">
		<input type="hidden" name="t_center_id" value="<?php echo $t_center_id;?>">
		<input type="hidden" name="all_center" value="<?php echo $all_center;?>">
		<input type="hidden" name="d_startYear" value="<?php echo $d_startYear;?>">
		<input type="hidden" name="d_startMonth" value="<?php echo $d_startMonth;?>">
		<label>Lend Date/Deadline：</label>
		<input type="date" name="searchDate">
		<br>
		<label>Code/Dealer：</label>
		<input type="text" name="searchText">
		<br>
		<input type="submit" name="search" class="btn btn-success" value="Search">
	</form>
<?php }?>
	<?php 
	$where='';
	if ($_SESSION["group_name"] == 'superadmin') {
		$abc_hwe="SELECT * from customers";
	}
	else{
		$abc_hwe="SELECT * from customers where user_agent_id=".$_SESSION['agent_id'];	
	}
	
	$result_hwe = mysqli_query($conn,$abc_hwe);
	$customer_id=array();
	
	if(mysqli_num_rows($result_hwe)>0)
	{
		while($rows = $result_hwe->fetch_assoc()) 	
		{
			$customer_id[]=$rows['id'];
		}
		$where = ' and customer_id IN ('.implode(',',$customer_id).')';
	}
	
	if ($_SESSION["group_name"] == 'superadmin') {
		//$abc_hwe="SELECT * from customers";
	}
	elseif ($_SESSION['group_name'] != "admin") {
		$where=" and user_agent_id=".$_SESSION['agent_id'];	
	} else {
		$where="";
	}
	
	
			
		if(isset($all_center) && !empty($all_center))
		{
			
			$sql_center = "SELECT * FROM center_detail ORDER BY id ASC";
			
			$results = mysqli_query($conn,$sql_center);
			
			if($results->num_rows > 0)
			{
				while($rows = $results->fetch_assoc())
				{
					
				?>
				<div>
					<p>Center<span class="ConfirmValue"> <strong>
					<?php echo $rows['id'].' - '.$rows['center_name'];?>
					</strong> </span></p>
				</div>
				<table cellspacing="1" cellpadding="1" style="width:80%" class="table table-striped table-bordered" align="center">
				<caption class="menu-header">Monthly Collection Report</caption>
				<?php if ($_SESSION['center_id'] != 5) {?>
					<thead>
						<tr>
							<th>Customer - Card</th>
							<th>Customer Name</th>
							<th>Collection</th>
							<th>Interest</th>
						</tr>
					</thead>
					<tbody>
					
					<?php 
					
						$get_customer_card = mysqli_query($conn,'SELECT * FROM customers_card WHERE center_id = '.$rows['id'].$where);
						$customer_card_id = array();
						if(mysqli_num_rows($get_customer_card)>0)
						{
							while($customer_cardrow = mysqli_fetch_assoc($get_customer_card))
							{
								$customer_card_id[]=$customer_cardrow['id'];
							}
						}
						$whereand_card = ' and card_id IN ('.implode(',',$customer_card_id).')';
						
						$sql_collection = "SELECT * FROM collection WHERE center_id = ".$t_center_id.$whereand_card." ORDER BY id ASC";
						
						$sql_collection = "SELECT * FROM collection WHERE center_id = ".$rows['id']." ORDER BY id ASC";
						
						$resultcollection = mysqli_query($conn,$sql_collection);
						
						if($resultcollection->num_rows > 0)
						{
							
							$total_colletion = 0;
							$total_interest = 0;
							while($rowss = $resultcollection->fetch_assoc())
							{
								$date_hwe = date('d-m-Y',$rowss['d_date_disp']);
								$date = explode("-",$date_hwe);
								if($date[1] == $d_startMonth &&  $date[2] == $d_startYear )
								{
									$total_colletion += $rowss['amount'];
									$total_interest += $rowss['interest'];	

								?>
								<tr>
									<td>
									<?php 
									$sql_customer_id = "SELECT customer_id FROM customers_card WHERE id = ". $rowss['card_id'];
									$res = mysqli_query($conn,$sql_customer_id);
									
										if($res->num_rows > 0)
										{
											$row_res = $res->fetch_assoc();
											echo $row_res['customer_id'].'-';
										}
										$customer_id = $row_res['customer_id'];
								
									$customer_data = "SELECT * FROM customers WHERE id = ".$customer_id;	
									$cust_data = mysqli_query($conn,$customer_data);
								    $customer = $cust_data -> fetch_assoc();
										
										
									echo $rowss['card_id'];?>
									</td>
                                    <td><?php echo $customer['name'];?></td>
									<td><?php echo $rowss['amount'];?></td>
									<td><?php echo $rowss['interest'];?></td>
								</tr>
								<?php
								}
							}
							?>
							<tr>
								<td>Total</td>
                                <td> </td>
								<td class="total_td"><?php echo $total_colletion;?></td>
								<td class="total_td"><?php echo $total_interest;?></td>
							</tr>
							
							<?php 
						}
					?>						
					</tbody>
				<?php } else {?>
		  		<thead>
		  			<tr>
                    <th>Date</th>
                    <th>Lend Date</th>
                    <th>Code</th>
                    <th>Lend Amount</th>
                    <th>Interest</th>
                    <th>Deposit</th>
                    <th>STP</th>
                    <th>On Hand</th>
                    <th>Days</th>
                    <th>Deadline</th>
                    <th>Statement Date</th>
                    <th>Dealer</th>
                    <th>Repayment Amount</th>
                    <th>Repayment Interest</th>
                    <th>Remark</th>
                </tr>
    		</thead><tbody>
<?php
$total_loan_out = 0;
$total_profit = 0;
$total_deposit = 0;
$total_advance = 0;
$total_onhand = 0;
$total_amount_paid = 0;
$total_profit_paid = 0;

if ($_SESSION['group_name'] != "admin") {
	if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != "")) {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND b.user_agent_id = '".$_SESSION['user_agent_id']."' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%' OR b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchText) && $searchText != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND b.user_agent_id = '".$_SESSION['user_agent_id']."' AND (b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchDate) && $searchDate != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND b.user_agent_id = '".$_SESSION['user_agent_id']."' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%') ORDER BY a.d_date_disp;";
	} else {
		$sql = "SELECT a.* FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id WHERE a.center_id = '5' AND b.user_agent_id = '".$_SESSION['user_agent_id']."' ORDER BY a.d_date_disp;";
	}
} else {
	if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != "")) {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%' OR b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchText) && $searchText != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND (b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchDate) && $searchDate != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%') ORDER BY a.d_date_disp;";
	} else {
		$sql = "SELECT a.* FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id WHERE a.center_id = '5' ORDER BY a.d_date_disp;";
	}
}

$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
	$date = date("d-m-Y", $myrow['d_date_disp']);
	$d_date = explode("-", $date);

	if ($d_startMonth == $d_date[1] && $d_startYear == $d_date[2]) {
	$total_amount_paid += $myrow['amount'];
	$total_profit_paid += $myrow['interest'];
	$onhand = 0;
	$sql2 = "SELECT * FROM customers_card WHERE id = '".$myrow['card_id']."';";
	$res2 = mysqli_query($conn, $sql2);
	$myrow2 = mysqli_fetch_assoc($res2);

	$onhand = $myrow2['loan_out'] - $myrow2['profit'] - $myrow2['deposit'] - $myrow2['advance'];
	$total_loan_out += $myrow2['loan_out'];
	$total_profit += $myrow2['profit'];
	$total_deposit += $myrow2['deposit'];
	$total_advance += $myrow2['advance'];
	$total_onhand += $onhand;
?>
				<tr>
					<td><?php echo date("d-m-Y", $myrow['d_date_disp']);?></td>
					<td><?php echo $myrow2['start_date'];?></td>
					<td><?php echo $myrow2['code'];?></td>
					<td><?php echo $myrow2['loan_out'];?></td>
					<td><?php echo $myrow2['profit'];?></td>
					<td><?php echo $myrow2['deposit'];?></td>
					<td><?php echo $myrow2['advance'];?></td>
					<td><?php echo $onhand;?></td>
					<td><?php echo $myrow2['no_of_terms'];?></td>
					<td><?php echo $myrow2['crossed_date'];?></td>
					<td>

<?php
if ($myrow2['clear_payment'] != '1') {

} else {
	$sql3 = "SELECT * FROM collection WHERE card_id = '".$myrow2['id']."' AND remark1 = '清' ORDER BY id DESC LIMIT 1;";
	$res3 = mysqli_query($conn, $sql3);
	$myrow3 = mysqli_fetch_assoc($res3);

	echo date("d-m-Y", $myrow3['d_date_disp']);
}

$sql3 = "SELECT * FROM users WHERE id = '".$myrow2['user_agent_id']."';";
$res3 = mysqli_query($conn, $sql3);
$myrow3 = mysqli_fetch_assoc($res3);
?>

					</td>

					<td><?php echo $myrow3['user_name'];?></td>
					<td><?php echo $myrow['amount'];?></td>
					<td><?php echo $myrow['interest'];?></td>
					<td><?php echo $myrow['remark1']; if ($myrow['remark1'] == "分期" || $myrow['remark1'] == "分天") {echo $myrow['days'];}?></td>
				</tr>
<?php
}
	}
?>
            <tr>
            <td colspan="12">Total :  </td>
            <td class="total_td"><?php echo $total_amount_paid;?></td>
            <td class="total_td"><?php echo $total_profit_paid;?></td>
            <td class="total_td"></td>
          </tr>
          
       
      
      <tr>
        <td class="ConfirmValue" colspan="15">printed at<font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> <?php echo date("d/m/Y H:i:s");?></strong></font></td>
      </tr>
    		</tbody>
				<?php }?>
				</table>
				<?php
				}
			}
		}
		else
		{								
			$sql_center = "SELECT * FROM center_detail WHERE id = ".$t_center_id." ORDER BY id ASC";
			
			$results = mysqli_query($conn,$sql_center);
			
			if($results->num_rows > 0)
			{
				$rows = $results->fetch_assoc();
			?>
				<div>
					<p>Center<span class="ConfirmValue"> <strong>
					<?php echo $rows['id'].' - '.$rows['center_name'];?>
					</strong> </span></p>
				</div>
            <?php }?>
			<table cellspacing="1" cellpadding="1" style="width:80%" class="table table-striped table-bordered" align="center">
			<caption class="menu-header">Monthly Collection Report</caption>
			<?php if ($_SESSION['center_id']!= 5) {?>
				<thead>
					<tr>
						<th>Customer - Card</th>
            <th>Customer Name</th>
            <th>Collection</th>
            <th>Interest</th>
					</tr>
				</thead>
				<tbody>
				<?php 	
				
				$get_customer_card = mysqli_query($conn,'SELECT * FROM customers_card WHERE center_id = '.$t_center_id.$where);
				$customer_card_id = array();
				if(mysqli_num_rows($get_customer_card)>0)
				{
					while($customer_cardrow = mysqli_fetch_assoc($get_customer_card))
					{
						$customer_card_id[]=$customer_cardrow['id'];
					}
				}
				$whereand_card = ' and card_id IN ('.implode(',',$customer_card_id).')';
				
				$sql_collection = "SELECT * FROM collection WHERE center_id = ".$t_center_id.$whereand_card." ORDER BY id ASC";
				
				$resultcollection = mysqli_query($conn,$sql_collection);
				
				if($resultcollection->num_rows > 0)
				{
					$total_colletion = 0;
					$total_interest = 0;
					while($rowss = $resultcollection->fetch_assoc())
					{
						$date_hwe = date('d-m-Y',$rowss['d_date_disp']);
						$date = explode("-",$date_hwe);
						if($date[1] == $d_startMonth &&  $date[2] == $d_startYear )
						{
							$total_colletion += $rowss['amount'];
							$total_interest += $rowss['interest'];	
	
						?>
						<tr>
							<td>
							<?php 
							$sql_customer_id = "SELECT customer_id FROM customers_card WHERE id = ". $rowss['card_id'];
							$res = mysqli_query($conn,$sql_customer_id);
							
								if($res->num_rows > 0)
								{
									$row_res = $res->fetch_assoc();
									echo $row_res['customer_id'].'-';
								}
								$customer_id = $row_res['customer_id'];
						
							$customer_data = "SELECT * FROM customers WHERE id = ".$customer_id;	
							$cust_data = mysqli_query($conn,$customer_data);
							$customer = $cust_data -> fetch_assoc();
								
							echo $rowss['card_id'];?>
							</td>
							<td><?php echo $customer['name'];?></td>
							<td><?php echo $rowss['amount'];?></td>
							<td><?php echo $rowss['interest'];?></td>
						</tr>
						<?php
						}
					}
					?>
					<tr>
						<td>Total</td>
						<td> </td>
						<td><?php echo $total_colletion;?></td>
						<td><?php echo $total_interest;?></td>
					</tr>
					
					<?php 
				}
			?>						
			</tbody>
		<?php } else {?>
    		<thead>
    			<tr>
                    <th>Date</th>
                    <th>Lend Date</th>
                    <th>Code</th>
                    <th>Lend Amount</th>
                    <th>Interest</th>
                    <th>Deposit</th>
                    <th>STP</th>
                    <th>On Hand</th>
                    <th>Days</th>
                    <th>Deadline</th>
                    <th>Statement Date</th>
                    <th>Dealer</th>
                    <th>Repayment Amount</th>
                    <th>Repayment Interest</th>
                    <th>Remark</th>
                </tr>
    		</thead><tbody>
<?php
$total_loan_out = 0;
$total_profit = 0;
$total_deposit = 0;
$total_advance = 0;
$total_onhand = 0;
$total_amount_paid = 0;
$total_profit_paid = 0;

if ($_SESSION['group_name'] != "admin") {
	if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != "")) {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND b.user_agent_id = '".$_SESSION['user_agent_id']."' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%' OR b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchText) && $searchText != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND b.user_agent_id = '".$_SESSION['user_agent_id']."' AND (b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchDate) && $searchDate != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND b.user_agent_id = '".$_SESSION['user_agent_id']."' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%') ORDER BY a.d_date_disp;";
	} else {
		$sql = "SELECT a.* FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id WHERE a.center_id = '5' AND b.user_agent_id = '".$_SESSION['user_agent_id']."' ORDER BY a.d_date_disp;";
	}
} else {
	if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != "")) {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%' OR b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchText) && $searchText != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND (b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchDate) && $searchDate != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%') ORDER BY a.d_date_disp;";
	} else {
		$sql = "SELECT a.* FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id WHERE a.center_id = '5' ORDER BY a.d_date_disp;";
	}
}

$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
	$date = date("d-m-Y", $myrow['d_date_disp']);
	$d_date = explode("-", $date);

	if ($d_startMonth == $d_date[1] && $d_startYear == $d_date[2]) {
	$total_amount_paid += $myrow['amount'];
	$total_profit_paid += $myrow['interest'];
	$onhand = 0;
	$sql2 = "SELECT * FROM customers_card WHERE id = '".$myrow['card_id']."';";
	$res2 = mysqli_query($conn, $sql2);
	$myrow2 = mysqli_fetch_assoc($res2);

	$onhand = $myrow2['loan_out'] - $myrow2['profit'] - $myrow2['deposit'] - $myrow2['advance'];
	$total_loan_out += $myrow2['loan_out'];
	$total_profit += $myrow2['profit'];
	$total_deposit += $myrow2['deposit'];
	$total_advance += $myrow2['advance'];
	$total_onhand += $onhand;
?>
				<tr>
					<td><?php echo $date;?></td>
					<td><?php echo $myrow2['start_date'];?></td>
					<td><?php echo $myrow2['code'];?></td>
					<td><?php echo $myrow2['loan_out'];?></td>
					<td><?php echo $myrow2['profit'];?></td>
					<td><?php echo $myrow2['deposit'];?></td>
					<td><?php echo $myrow2['advance'];?></td>
					<td><?php echo $onhand;?></td>
					<td><?php echo $myrow2['no_of_terms'];?></td>
					<td><?php echo $myrow2['crossed_date'];?></td>
					<td>

<?php
if ($myrow2['clear_payment'] != '1') {

} else {
	$sql3 = "SELECT * FROM collection WHERE card_id = '".$myrow2['id']."' AND remark1 = '清' ORDER BY id DESC LIMIT 1;";
	$res3 = mysqli_query($conn, $sql3);
	$myrow3 = mysqli_fetch_assoc($res3);

	echo date("d-m-Y", $myrow3['d_date_disp']);
}

$sql3 = "SELECT * FROM users WHERE id = '".$myrow2['user_agent_id']."';";
$res3 = mysqli_query($conn, $sql3);
$myrow3 = mysqli_fetch_assoc($res3);
?>

					</td>

					<td><?php echo $myrow3['user_name'];?></td>
					<td><?php echo $myrow['amount'];?></td>
					<td><?php echo $myrow['interest'];?></td>
					<td><?php echo $myrow['remark1']; if ($myrow['remark1'] == "分期" || $myrow['remark1'] == "分天") {echo $myrow['days'];}?></td>
				</tr>
<?php
}
	}
?>
            <tr>
            <td colspan="12">Total :  </td>
            <td class="total_td"><?php echo $total_amount_paid;?></td>
            <td class="total_td"><?php echo $total_profit_paid;?></td>
            <td class="total_td"></td>
          </tr>
          
       
      
      <tr>
        <td class="ConfirmValue" colspan="15">printed at<font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> <?php echo date("d/m/Y H:i:s");?></strong></font></td>
      </tr>
    		</tbody>
		<?php }?>
		</table>
		<?php
				
		}
	?>

</section>








<?php
}
elseif($report == "rpt02")
{
	if ($_SESSION['center_id'] != 5){
?>








<section>
	<div class="">
    <p><span class="ConfirmValue"> <strong><?php 
		
		if(isset($all_center) && !empty($all_center))
		{
			echo "All Center";
		}
		else
		{
			echo $t_center_id;
		}?> : <?php echo $d_startYear.$d_startMonth;?></strong> Monthly Balance Report</span></p>
    </div>
        <table cellspacing="1" cellpadding="1" style="width:100%" class="table table-striped table-bordered">
        <caption class="menu-header">Monthly Balance Report</caption>
        <thead>
            <tr>
                <th>Date</th>
                <th>Loan</th>
                <th>Collect</th>
                <th>Interest</th>
                <th>Miscellaneous</th>
                <th>Advances</th>
                <th>Repair</th>
                <th>Kongsi</th>
                <th>Profit</th>
            </tr>
        </thead>
		<tbody>
            <?php 
			// /*
			 
			// $records = array();
					  
			// $where = '';
			// $customercard_id=array();
			// if(isset($all_center) && !empty($all_center))
			// {
			// 	$where ='WHERE 1=1';
			// }
			// else
			// {
			// 	$where ="WHERE center_id = ".$t_center_id;
			// }
		
			// if ($_SESSION["group_name"] == 'superadmin') {
	    	// $sql12="SELECT SUM(`loan_out`) as loan_out, SUM(`profit`) as profit, `start_date`,id FROM `customers_card` ".$where." GROUP BY start_date";
				
			// }
			// else{
				
			// 	$sql12="SELECT SUM(`loan_out`) as loan_out, SUM(`profit`) as profit, `start_date`,id FROM `customers_card` ".$where." AND user_agent_id=".$_SESSION['agent_id']." GROUP BY `start_date`";
				
			// }
			
			// $result12 = mysqli_query($conn,$sql12);
			// if($result12->num_rows>0)
			// {
			// 	while($row1 = $result12->fetch_assoc())
			// 	{
			// 		$date=explode('-',$row1['start_date']);
			// 		if($date[1]== $d_startMonth && $date[2]==$d_startYear)
			// 		{
			// 		 	$records[$row1['start_date']]['loan_out'] =$row1['loan_out'];
			// 			$records[$row1['start_date']]['profit'] =$row1['profit'];
			// 			$customercard_id[]=$row1['id']; 
			// 		} 
			// 	}
			// }
			// if(count($records)>0)
			// {
			// 	if(count($customercard_id)>0)
			// 	{
			// 		$where .= ' and card_id IN ('.implode(',',$customercard_id).')';
			// 	}
			// 	$sql123 = "Select d_date_disp, Sum(amount) as totalamount,Sum(interest) as totalinterest from collection ".$where." group by d_date_disp"; 
				
			// 	$result123 = mysqli_query($conn,$sql123);
					
			// 	if($result123->num_rows > 0)
			// 	{
			// 		while($row = $result123->fetch_assoc())
			// 		{
						
			// 			$datedisp = date('d-m-Y',$row['d_date_disp']);
			// 			$datedisp2=explode('-',$datedisp);
			// 			if($datedisp2[1]== $d_startMonth && $datedisp2[2]==$d_startYear)
			// 			{
			// 				if(array_key_exists($datedisp,$records))
			// 				{
			// 					$records[$datedisp]['collection'] = $row['totalamount'];
			// 					$records[$datedisp]['interest'] = $row['totalinterest'];
			// 				}
			// 				else
			// 				{
			// 					$records[$datedisp]['collection'] = $row['totalamount'];
			// 					$records[$datedisp]['interest'] = $row['totalinterest'];
			// 				}
			// 			}
			// 		}
			// 	}
			// $sql_hwe1 ="SELECT * FROM customer_expenses ".$where." group by date";
			// 	$result_hwe1 = mysqli_query($conn,$sql_hwe1);
			// 	if($result_hwe1->num_rows > 0)
			// 	{
			// 		while($rows_hwe1 = $result_hwe1->fetch_assoc())
			// 		{
			// 		    //print_r($rows_hwe1);
			// 			 $datedisp_exp = date('d-m-Y',$rows_hwe1['date']);
						
			// 		$datedisp_exp2=explode('-',$datedisp_exp);
					
			// 			if($datedisp_exp2[1]== $d_startMonth && $datedisp_exp2[2]==$d_startYear)
			// 			{
			// 				if(array_key_exists($datedisp_exp,$records))
			// 				{
			// 					$records[$datedisp_exp]['misc'] = $rows_hwe1['misc'];
			// 					$records[$datedisp_exp]['repair'] = $rows_hwe1['repair'];
			// 					$records[$datedisp_exp]['advance'] = $rows_hwe1['advance'];
			// 					$records[$datedisp_exp]['outbalance'] = $rows_hwe1['outbalance'];
			// 				}
			// 				else
			// 				{
			// 					$records[$datedisp_exp]['misc'] = $rows_hwe1['misc'];
			// 					$records[$datedisp_exp]['repair'] = $rows_hwe1['repair'];
			// 					$records[$datedisp_exp]['advance'] = $rows_hwe1['advance'];
			// 					$records[$datedisp_exp]['outbalance'] = $rows_hwe1['outbalance'];
			// 				}
			// 			}
			// 		}
			// 	}
			// }
			// $totalloan = 0;
			// $totalcollection = 0;
			// $totalinterest = 0;
			// $totalmisc = 0;
			// $totaladvance = 0;
			// $totalrepair = 0;
			// $totaloutbalance = 0;
			// $totalprofit = 0;
			
	        // ksort($records);
			
			// foreach($records as $key => $record_row)
			// {
			// 	$totalloan +=$record_row['loan_out'];
			// 	$totalcollection +=$record_row['collection'];
			// 	$totalinterest +=$record_row['interest'];
			// 	$totalmisc +=$record_row['misc'];
			// 	$totaladvance +=$record_row['advance'];
			// 	$totalrepair +=$record_row['repair'];
			// 	$totaloutbalance +=$record_row['outbalance'];
			// 	$totalprofit +=$record_row['profit'];*/
			$where = '';
			$center_type='';
			if(isset($all_center) && !empty($all_center))
			{
				$where ='WHERE 1=1';
				$center_type="all";
			}
			else
			{
				$where ="WHERE center_id = ".$t_center_id;
				$center_type=$t_center_id;
			}
		
			if ($_SESSION["group_name"] == 'superadmin') {
				$abc_hwe="SELECT * from customers";
			}
			else{
				$abc_hwe="SELECT * from customers where user_agent_id=".$_SESSION['agent_id'];
			}
			
			$result_hwe = mysqli_query($conn,$abc_hwe);
			
			$customer_id=array();
			while($rows = $result_hwe->fetch_assoc())
			{
			  
			 $customer_id[]=$rows['id'];
			
			}
			
			$where_card_hwe = $where;
			$where_card_hwe .= ' and customer_id IN ('.implode(',',$customer_id).')';
			
			$result_collection = array();
			$customercard_id=array();
			$sql_query ="SELECT * FROM customers_card ".$where_card_hwe."";
			
			$results = mysqli_query($conn,$sql_query);
	
			if($results->num_rows > 0)
			{
			  
				while($rows = $results->fetch_assoc())
				{
					$date_of_record = explode('-',$rows['start_date']);
				 
					$d_startMonth = $_POST['d_startMonth'];
					$d_startYear = $_POST['d_startYear'];
					
					if($d_startMonth == $date_of_record[1] && $d_startYear == $date_of_record[2])
					{
						$customercard_id[]=$rows['id'];
						$result_collection[$rows['start_date']]['loan_out']+=$rows['loan_out'];
						$result_collection[$rows['start_date']]['profit']+=$rows['profit'];
						
					}
				}
			}
			
			$where .= ' and card_id IN ('.implode(',',$customercard_id).')';
			$sql ="SELECT * FROM collection ".$where."";
			$result = mysqli_query($conn,$sql );
			
			if($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
				{
					/*echo "<pre>";
					print_r($row);
					echo "</pre>";
					echo date('d-m-Y',$row['d_date_disp']);*/
					$date_hwe ='';
					$date_hwe = date('d-m-Y',$row['d_date_disp']);
					$date_hwe2 =  explode('-',$date_hwe);
					if($d_startMonth == $date_hwe2[1] && $d_startYear == $date_hwe2[2])
					{
						$result_collection[$date_hwe]['collection'] += $row['amount'];
						$result_collection[$date_hwe]['interest'] += $row['interest'];
						$result_collection[$date_hwe]['card_id'][]=$row['card_id'];
					}
				}
			}
			
			$misc=0;
			$repair=0;
			$advance=0;
			$out= 0;
			$inbalance = 0;


			$misc_array = array();
			$repair_array=array();
			$advance_array= array();
			$out_array= array();
			$inbalance_array = array();
			if($_SESSION["group_name"]!='superadmin')			
			{
				$get_expenses_result = "SELECT * FROM `customer_expenses` WHERE center_id = $t_center_id and card_id IN(".implode(',',$customercard_id).")"; 
				$result1 = mysqli_query($conn,$get_expenses_result);
				if($result1->num_rows > 0)
				{
					while($row = $result1->fetch_assoc())
					{
						$date_hwe_expns = date('d-m-Y',$row['date']);
						$date_hwe2_expns =  explode('-',$date_hwe_expns);
						if($d_startMonth == $date_hwe2_expns[1] && $d_startYear == $date_hwe2_expns[2])
						{
							/*$result_collection[$date_hwe_expns]['misc'] += $row['misc'];
							$result_collection[$date_hwe_expns]['repair'] += $row['repair'];
							$result_collection[$date_hwe_expns]['advance'] += $row['advance'];
							$result_collection[$date_hwe_expns]['outbalance'] += $row['outbalance'];
							$result_collection[$date_hwe_expns]['inbalance'] += $row['inbalance'];*/
							if(!in_array($row['misc'],$misc_array[$date_hwe_expns]))
							{
								$misc_array[$date_hwe_expns][] = $row['misc'];
								$result_collection[$date_hwe_expns]['misc'] =array_sum($misc_array[$date_hwe_expns]);
							}
							if(!in_array($row['repair'],$repair_array[$date_hwe_expns]))
							{
								$repair_array[$date_hwe_expns][] = $row['repair'];
								
								$result_collection[$date_hwe_expns]['repair'] =array_sum($repair_array[$date_hwe_expns]);
								
							}
							if(!in_array($row['advance'],$advance_array[$date_hwe_expns]))
							{
								$advance_array[$date_hwe_expns][] = $row['advance'];
								
								$result_collection[$date_hwe_expns]['advance']  =array_sum($advance_array[$date_hwe_expns]);
								
							}
							if(!in_array($row['outbalance'],$out_array[$date_hwe_expns]))
							{
								$out_array[$date_hwe_expns][] = $row['outbalance'];
								
								$result_collection[$date_hwe_expns]['outbalance'] =array_sum($out_array[$date_hwe_expns]);
								
							}
							if(!in_array($row['inbalance'],$inbalance_array[$date_hwe_expns]))
							{
								$inbalance_array[$date_hwe_expns][]=$row['inbalance'];
								
								$result_collection[$date_hwe_expns]['inbalance'] =array_sum($inbalance_array[$date_hwe_expns]);
							}
						}
						
						
					}
					
				}
			}
			else
			{
				$get_expenses_result = "SELECT * FROM `customer_expenses` WHERE center_id = $t_center_id"; 
				
				$result1 = mysqli_query($conn,$get_expenses_result);
				if($result1->num_rows > 0)
				{
					while($row = $result1->fetch_assoc())
					{
						
						$date_hwe_expns2 = date('d-m-Y',$row['date']);
						$date_hwe2_expns2 =  explode('-',$date_hwe_expns2);
						if($d_startMonth == $date_hwe2_expns2[1] && $d_startYear == $date_hwe2_expns2[2])
						{
							
							if(!in_array($row['misc'],$misc_array[$date_hwe_expns2]))
							{
								$misc_array[$date_hwe_expns2][] = $row['misc'];
								$result_collection[$date_hwe_expns2]['misc'] =array_sum($misc_array[$date_hwe_expns2]);
							}
							if(!in_array($row['repair'],$repair_array[$date_hwe_expns2]))
							{
								$repair_array[$date_hwe_expns2][] = $row['repair'];
								
								$result_collection[$date_hwe_expns2]['repair'] =array_sum($repair_array[$date_hwe_expns2]);
								
							}
							if(!in_array($row['advance'],$advance_array[$date_hwe_expns2]))
							{
								$advance_array[$date_hwe_expns2][] = $row['advance'];
								
								$result_collection[$date_hwe_expns2]['advance']  =array_sum($advance_array[$date_hwe_expns2]);
								
							}
							if(!in_array($row['outbalance'],$out_array[$date_hwe_expns2]))
							{
								$out_array[$date_hwe_expns2][] = $row['outbalance'];
								
								$result_collection[$date_hwe_expns2]['outbalance'] =array_sum($out_array[$date_hwe_expns2]);
								
							}
							if(!in_array($row['inbalance'],$inbalance_array[$date_hwe_expns2]))
							{
								$inbalance_array[$date_hwe_expns2][]=$row['inbalance'];
								
								$result_collection[$date_hwe_expns2]['inbalance'] =array_sum($inbalance_array[$date_hwe_expns2]);
							}
						}						
					}
				}
				/*$misc=array_sum($misc_array);
				$repair = array_sum($repair_array);
				
				$advance=array_sum($advance_array);
				$out=array_sum($out_array);
				$inbalance =array_sum($inbalance_array);*/
				
			}
			/*$totalmisc+=$misc;
			$totalrepair+=$repair;
			$totaladvance+=$advance;
			$totaloutbalance+=$out;
			$totalinbalance+=$inbalance;
			
			*/
			$total_loan_out =0;
			$total_amount=0;
			$totalprofit=0;
			$total_interest = 0;
			
			$totalmisc=0;
			$totalrepair=0;
			$totaladvance=0;
			$totaloutbalance= 0;
			$totalinbalance = 0;
			ksort($result_collection);
			echo "<pre>";
			//print_r($result_collection);
			echo "</pre>";
			foreach($result_collection as $key=>$record_row)
			{
				$total_loan_out +=$record_row['loan_out'];
				$total_amount+=$record_row['collection'];
				$totalprofit+=$record_row['profit'];
				$total_interest+=$record_row['interest'];
				$totalmisc+=$record_row['misc'];
				$totalrepair+=$record_row['repair'];
				$totaladvance+=$record_row['advance'];
				$totaloutbalance+=$record_row['outbalance'];
				$totalinbalance+=$record_row['inbalance'];
				
				
			?>
            <tr>
                <td><?php echo $key;?></td>
				<td><?php if(empty($record_row['loan_out'])){ echo 0; }else{ echo $record_row['loan_out']; }?></td>
                <td><?php if(empty($record_row['collection'])){ echo 0; }else{ echo $record_row['collection']; }?></td>
                <td><?php if(empty($record_row['interest'])){ echo 0; }else{ echo $record_row['interest']; }?></td>
                <td><?php if(empty($record_row['misc'])){ echo 0; }else{ echo $record_row['misc']; }?></td>
                <td><?php if(empty($record_row['advance'])){ echo 0; }else{ echo $record_row['advance']; }?></td>
                <td><?php if(empty($record_row['repair'])){ echo 0; }else{ echo $record_row['repair']; }?></td>
                <td><?php if(empty($record_row['outbalance'])){ echo 0; }else{ echo $record_row['outbalance']; }?></td>
                <td><?php if(empty($record_row['inbalance'])){ echo 0; }else{ echo $record_row['inbalance']; }?></td>
            </tr>
            <?php 
            }
			?>
                    		
            <tr>
            <td>Total : </td>
			<td class="total_td"><?php echo $total_loan_out;?></td>
            <td class="total_td"><?php echo $total_amount;?></td>
            <td class="total_td"><?php echo $total_interest;?></td>
            <td class="total_td"><?php echo $totalmisc;?></td>
            <td class="total_td"><?php echo $totaladvance;?></td>
            <td class="total_td"><?php echo $totalrepair;?></td>
            <td class="total_td"><?php echo $totaloutbalance;?></td>
            <td class="total_td"><?php echo $totalprofit;?></td>
            <?php /*?><td class="total_td"><?php echo $totalloan;?></td>
            <td class="total_td"><?php echo $totalcollection;?></td>
            <td class="total_td"><?php echo $totalinterest;?></td>
            <td class="total_td"><?php echo $totalmisc;?></td>
            <td class="total_td"><?php echo $totaladvance;?></td>
            <td class="total_td"><?php echo $totalrepair;?></td>
            <td class="total_td"><?php echo $totaloutbalance;?></td>
            <td class="total_td"><?php echo $totalprofit;?></td><?php */?>
          </tr>

      <tr>
        <td class="ConfirmValue">printed at<font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> <?php echo date("d/m/Y H:i:s");?></strong></font></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
    </table>
</section>
<?php	
} else {?>
<section>
	<div>
		<p><span class="ConfirmValue"> <strong><?php 
		if(isset($all_center) && !empty($all_center))
		{
			echo "All Center";
		}
		else
		{
			echo $t_center_id;
		}?> : <?php echo $d_startYear.$d_startMonth;?></strong>的月度結單列表</span></p>
	</div>
	<form method="post">
		<a href="monthly_report.php" class="btn btn-info">返回</a>
		<br>
		<input type="hidden" name="t_center_id" value="<?php echo $t_center_id;?>">
		<input type="hidden" name="all_center" value="<?php echo $all_center;?>">
		<input type="hidden" name="d_startYear" value="<?php echo $d_startYear;?>">
		<input type="hidden" name="d_startMonth" value="<?php echo $d_startMonth;?>">
		<input type="hidden" name="report" value="rpt02">
		<label>借出日期/截止日期：</label>
		<input type="date" name="searchDate">
		<br>
		<label>Code/经手人：</label>
		<input type="text" name="searchText">
		<br>
		<input type="submit" name="search" class="btn btn-success" value="搜索">
	</form>

	<table cellspacing="1" cellpadding="1" style="width:100%" class="table table-striped table-bordered">
        <caption class="menu-header">月度結單报告</caption>
        <thead>
            <tr>
                <th>開始日期</th>
                <th>Code</th>
                <th>數額</th>
                <th>利息</th>
                <th>抵押金</th>
                <th>STP</th>
                <th>天數</th>
                <th>截止日期</th>
                <th>結單日期</th>
                <th>到手</th>
                <th>已還數額</th>
                <th>已收利息</th>
                <th>利潤</th>
                <th>利潤-利息</th>
                <th>經手人</th>
            </tr>
        </thead>
		<tbody>
<?php 
if ($_SESSION['group_name'] != "admin") {
	if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != ""))  {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.remark1 = '清' a.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%' OR b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchText) && $searchText != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.remark1 = '清' a.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchDate) && $searchDate != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.remark1 = '清' a.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%') ORDER BY a.d_date_disp;";
	} else {
		$sql = "SELECT a.* FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id WHERE a.remark1 = '清' a.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' ORDER BY a.d_date_disp;";
	}
} else {
	if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != ""))  {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.remark1 = '清' AND a.center_id = '5' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%' OR b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchText) && $searchText != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.remark1 = '清' AND a.center_id = '5' AND (b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchDate) && $searchDate != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.remark1 = '清' AND a.center_id = '5' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%') ORDER BY a.d_date_disp;";
	} else {
		$sql = "SELECT * FROM collection WHERE remark1 = '清' AND center_id = '5' ORDER BY d_date_disp;";
	}
}
$res = mysqli_query($conn, $sql);

$total_loan_out = 0;
$total_profit = 0;
$total_deposit = 0;
$total_advance = 0;

$total_onhand = 0;
$total_amount_paid = 0;
$total_interest_paid = 0;
$total_profit_paid = 0;
$total_profit_interest_paid = 0;

while ($myrow = mysqli_fetch_array($res)) {
	$date = date("d-m-Y", $myrow['d_date_disp']);
	$e_date = explode("-", $date);
	if ($e_date[1] == $d_startMonth && $e_date[2] == $d_startYear) {
		$sql1 = "SELECT * FROM customers_card WHERE id = '".$myrow['card_id']."';";
		$res1 = mysqli_query($conn, $sql1);
		$myrow1 = mysqli_fetch_assoc($res1);
		$onhand = $myrow1['loan_out'] - $myrow1['profit'] - $myrow1['deposit'] - $myrow1['advance'];
		$total_loan_out += $myrow1['loan_out'];
		$total_profit += $myrow1['profit'];
		$total_deposit += $myrow1['deposit'];
		$total_advance += $myrow1['advance'];
?>
			<tr>
                <td><?php echo $myrow1['start_date'];?></td>
                <td><?php echo $myrow1['code'];?></td>
                <td><?php echo $myrow1['loan_out'];?></td>
                <td><?php echo $myrow1['profit'];?></td>
                <td><?php echo $myrow1['deposit'];?></td>
                <td><?php echo $myrow1['advance'];?></td>
                <td><?php echo $myrow1['no_of_terms'];?></td>
                <td><?php echo $myrow1['crossed_date'];?></td>
                <td><?php echo $date;?></td>
                <td><?php echo $onhand;?></td>
<?php 
$amount_paid = 0;
$interest_paid = 0;
$profit_paid = 0;
$profit_interest_paid = 0;
$sql2 = "SELECT * FROM collection WHERE card_id = '".$myrow1['id']."';";
$res2 = mysqli_query($conn, $sql2);
while ($myrow2 = mysqli_fetch_array($res2)) {
	$amount_paid += $myrow2['amount'];
	$interest_paid += $myrow2['interest'];
}
$profit_paid = $amount_paid - $onhand + $interest_paid;
$profit_interest_paid = $profit_paid - $interest_paid;
?>
                <td><?php echo $amount_paid;?></td>
                <td><?php echo $interest_paid;?></td>
                <td><?php echo $profit_paid;?></td>
                <td><?php echo $profit_interest_paid;?></td>
<?php
$sql5 = "SELECT * FROM users WHERE id = '".$myrow1['user_agent_id']."';";
$res5 = mysqli_query($conn, $sql5);
$myrow5 = mysqli_fetch_assoc($res5);
?>
                <td><?php echo $myrow5['user_name'];?></td>
			</tr>
<?php 
$total_onhand += $onhand;
$total_amount_paid += $amount_paid;
$total_interest_paid += $interest_paid;
$total_profit_paid += $profit_paid;
$total_profit_interest_paid += $profit_interest_paid;
	}
}

?>    		

      		<tr>
            <td colspan="2">總額 : </td>
            <td class="total_td"><?php echo $total_loan_out;?></td>
            <td class="total_td"><?php echo $total_profit;?></td>
            <td class="total_td"><?php echo $total_deposit;?></td>
            <td class="total_td"><?php echo $total_advance;?></td>
            <td class="total_td"><?php ?></td>
            <td class="total_td"><?php ?></td>
            <td class="total_td"><?php ?></td>
            <td class="total_td"><?php echo $total_onhand;?></td>
            <td class="total_td"><?php echo $total_amount_paid;?></td>
            <td class="total_td"><?php echo $total_interest_paid;?></td>
            <td class="total_td"><?php echo $total_profit_paid;?></td>
            <td class="total_td"><?php echo $total_profit_interest_paid;?></td>
            <td class="total_td"></td>
          </tr>
          
      <tr>
        <td class="ConfirmValue" colspan="15">printed at<font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> <?php echo date("d/m/Y H:i:s");?></strong></font></td>
      </tr>





		</tbody>
	</table>
</section>







<?php }
} elseif($report == "rpt03"){
	$d_startMonth = $_POST['d_startMonth'];
	$d_startYear = $_POST['d_startYear'];
	?>
<section>
	<div class="">
		<p><strong>		
		<?php echo $d_startMonth.'-'.$d_startYear;?></strong>
		Monthly Statement<span class="ConfirmValue"></span></p>
	</div>
	<a href="monthly_report.php" class="btn btn-info">Back</a>
<?php
if ($_SESSION['center_id'] == 5) {?>
	<form method="post">
		<input type="hidden" name="report" value="rpt01">
		<input type="hidden" name="t_center_id" value="<?php echo $t_center_id;?>">
		<input type="hidden" name="all_center" value="<?php echo $all_center;?>">
		<input type="hidden" name="d_startYear" value="<?php echo $d_startYear;?>">
		<input type="hidden" name="d_startMonth" value="<?php echo $d_startMonth;?>">
		<label>Lend Date/Deadline：</label>
		<input type="date" name="searchDate">
		<br>
		<label>Code/Dealer：</label>
		<input type="text" name="searchText">
		<br>
		<input type="submit" name="search" class="btn btn-success" value="Search">
	</form>
<?php }?>
    <?php 
    $sql = "SELECT * FROM center_detail WHERE id = '".$_SESSION['center_id']."';";
    $res = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($res);
    ?>
				<div>
					<p>Center<span class="ConfirmValue"> <strong>
					<?php echo $rows['id'].' - '.$rows['center_name'];?>
					</strong> </span></p>
				</div>

	<table cellspacing="1" cellpadding="1" style="width:100%" class="table table-striped table-bordered">
        <caption class="menu-header">Monthly Statement Report</caption>
        <thead>
            <tr>
                <th>Start Date</th>
                <th>Code</th>
                <th>Amount</th>
                <th>Interest</th>
                <th>Deposit</th>
                <th>STP</th>
                <th>Days</th>
                <th>Deadline</th>
                <th>Statement Date</th>
                <th>On Hand</th>
                <th>Repaid Amount</th>
                <th>Interest Received</th>
                <th>Profit</th>
                <th>Profit-Interest</th>
                <th>Dealer</th>
            </tr>
        </thead>
		<tbody>
<?php 
if ($_SESSION['group_name'] != "admin") {
	if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != "")) {
		$sql = "SELECT a.* FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.remark1 = '清' a.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%' OR b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchText) && $searchText != "") {
		$sql = "SELECT a.* FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.remark1 = '清' a.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchDate) && $searchDate != "") {
		$sql = "SELECT a.* FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.remark1 = '清' a.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%') ORDER BY a.d_date_disp;";
	} else {
		$sql = "SELECT a.* FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id WHERE a.remark1 = '清' a.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' ORDER BY a.d_date_disp;";
	}
} else {
	if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != "")) {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.remark1 = '清' AND a.center_id = '5' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%' OR b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchText) && $searchText != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.remark1 = '清' AND a.center_id = '5' AND (b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') ORDER BY a.d_date_disp;";
	} elseif (isset($searchDate) && $searchDate != "") {
		$sql = "SELECT a.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.remark1 = '清' AND a.center_id = '5' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%') ORDER BY a.d_date_disp;";
	} else {
		$sql = "SELECT * FROM collection WHERE remark1 = '清' AND center_id = '5' ORDER BY d_date_disp;";
	}
}

$res = mysqli_query($conn, $sql);

$total_loan_out = 0;
$total_profit = 0;
$total_deposit = 0;
$total_advance = 0;

$total_onhand = 0;
$total_amount_paid = 0;
$total_interest_paid = 0;
$total_profit_paid = 0;
$total_profit_interest_paid = 0;

while ($myrow = mysqli_fetch_array($res)) {
	$date = date("d-m-Y", $myrow['d_date_disp']);
	$e_date = explode("-", $date);
	if ($e_date[1] == $d_startMonth && $e_date[2] == $d_startYear) {
		$sql1 = "SELECT * FROM customers_card WHERE id = '".$myrow['card_id']."';";
		$res1 = mysqli_query($conn, $sql1);
		$myrow1 = mysqli_fetch_assoc($res1);
		$onhand = $myrow1['loan_out'] - $myrow1['profit'] - $myrow1['deposit'] - $myrow1['advance'];
		$total_loan_out += $myrow1['loan_out'];
		$total_profit += $myrow1['profit'];
		$total_deposit += $myrow1['deposit'];
		$total_advance += $myrow1['advance'];
?>
			<tr>
                <td><?php echo $myrow1['start_date'];?></td>
                <td><?php echo $myrow1['code'];?></td>
                <td><?php echo $myrow1['loan_out'];?></td>
                <td><?php echo $myrow1['profit'];?></td>
                <td><?php echo $myrow1['deposit'];?></td>
                <td><?php echo $myrow1['advance'];?></td>
                <td><?php echo $myrow1['no_of_terms'];?></td>
                <td><?php echo $myrow1['crossed_date'];?></td>
                <td><?php echo $date;?></td>
                <td><?php echo $onhand;?></td>
<?php 
$amount_paid = 0;
$interest_paid = 0;
$profit_paid = 0;
$profit_interest_paid = 0;
$sql2 = "SELECT * FROM collection WHERE card_id = '".$myrow1['id']."';";
$res2 = mysqli_query($conn, $sql2);
while ($myrow2 = mysqli_fetch_array($res2)) {
	$amount_paid += $myrow2['amount'];
	$interest_paid += $myrow2['interest'];
}
$profit_paid = $amount_paid - $onhand + $interest_paid;
$profit_interest_paid = $profit_paid - $interest_paid;
?>
                <td><?php echo $amount_paid;?></td>
                <td><?php echo $interest_paid;?></td>
                <td><?php echo $profit_paid;?></td>
                <td><?php echo $profit_interest_paid;?></td>
<?php
$sql5 = "SELECT * FROM users WHERE id = '".$myrow1['user_agent_id']."';";
$res5 = mysqli_query($conn, $sql5);
$myrow5 = mysqli_fetch_assoc($res5);
?>
                <td><?php echo $myrow5['user_name'];?></td>
			</tr>
<?php 
$total_onhand += $onhand;
$total_amount_paid += $amount_paid;
$total_interest_paid += $interest_paid;
$total_profit_paid += $profit_paid;
$total_profit_interest_paid += $profit_interest_paid;
	}
}

?>    		

      		<tr>
            <td colspan="2">Total : </td>
            <td class="total_td"><?php echo $total_loan_out;?></td>
            <td class="total_td"><?php echo $total_profit;?></td>
            <td class="total_td"><?php echo $total_deposit;?></td>
            <td class="total_td"><?php echo $total_advance;?></td>
            <td class="total_td"><?php ?></td>
            <td class="total_td"><?php ?></td>
            <td class="total_td"><?php ?></td>
            <td class="total_td"><?php echo $total_onhand;?></td>
            <td class="total_td"><?php echo $total_amount_paid;?></td>
            <td class="total_td"><?php echo $total_interest_paid;?></td>
            <td class="total_td"><?php echo $total_profit_paid;?></td>
            <td class="total_td"><?php echo $total_profit_interest_paid;?></td>
            <td class="total_td"></td>
          </tr>
          
      <tr>
        <td class="ConfirmValue" colspan="15">printed at<font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> <?php echo date("d/m/Y H:i:s");?></strong></font></td>
      </tr>





		</tbody>
	</table>
</section>








<?php } elseif($report == "rpt04"){
	$d_startMonth = $_POST['d_startMonth'];
	$d_startYear = $_POST['d_startYear'];
	?>
<section>
	<div class="">
		<p><strong>		
		<?php echo $d_startMonth.'-'.$d_startYear;?></strong>
		 Monthly Deadline<span class="ConfirmValue"></span></p>
	</div>
	<a href="monthly_report.php" class="btn btn-info">Back</a>
<?php
if ($_SESSION['center_id'] == 5) {?>
	<form method="post">
		<input type="hidden" name="report" value="rpt01">
		<input type="hidden" name="t_center_id" value="<?php echo $t_center_id;?>">
		<input type="hidden" name="all_center" value="<?php echo $all_center;?>">
		<input type="hidden" name="d_startYear" value="<?php echo $d_startYear;?>">
		<input type="hidden" name="d_startMonth" value="<?php echo $d_startMonth;?>">
		<label>Lend Date/Deadline：</label>
		<input type="date" name="searchDate">
		<br>
		<label>Code/Dealer：</label>
		<input type="text" name="searchText">
		<br>
		<input type="submit" name="search" class="btn btn-success" value="Search">
	</form>
<?php }
    $sql = "SELECT * FROM center_detail WHERE id = '".$_SESSION['center_id']."';";
    $res = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($res);
    ?>
				<div>
					<p>Center<span class="ConfirmValue"> <strong>
					<?php echo $rows['id'].' - '.$rows['center_name'];?>
					</strong> </span></p>
				</div>

	<table cellspacing="1" cellpadding="1" style="width:100%" class="table table-striped table-bordered">
        <caption class="menu-header">Monthly Deadline Report</caption>
        <thead>
            <tr>
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
                <th>Interest paid</th>
                <th>Profit</th>
                <th>Dealer</th>
            </tr>
        </thead>

		<tbody>
            <?php 
            if ($_SESSION['center_id'] != 5){
			$where = '';
			$whereand = '';
			if(isset($all_center) && !empty($all_center))
			{
				$where ='WHERE 1=1';
			}
			else
			{
				 $where ="WHERE center_id = ".$t_center_id;
			}
			
			
			if ($_SESSION["group_name"] == 'superadmin') {	
					$whereand=$where;
					//$whereand.=" AND user_agent_id=".$_SESSION['last_login'];
			}
			else{
				$whereand=$where;
				$whereand.=" AND user_agent_id=".$_SESSION['agent_id'];
			}
			 $sqlcustomer_card ="SELECT * FROM customers_card ".$whereand." ORDER BY customer_id ASC";
				
			$result = mysqli_query($conn,$sqlcustomer_card);
			
			if($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
				{
					
					$crossed_date = explode("-",$row['crossed_date']);
					
					if($crossed_date[1] == $d_startMonth && $crossed_date[2] == $d_startYear)
					{
						
						$no_of_terms = $row['no_of_terms'];
						$no_of_days = '+'.$no_of_terms.' days';
										
						$end_date = date('d-m-Y', strtotime($no_of_days));
						
						$Variable2 = date('d-m-Y',strtotime($end_date));
						?>
                        <tr>
                            <td><?php echo $row['customer_id'].'-'.$row['id'];?></td>
                            <?php 
							$sql_customer = "SELECT name,new_IC FROM customers WHERE id = ".$row['customer_id'];
							$result_customer = mysqli_query($conn,$sql_customer);
							if($result_customer->num_rows > 0)
							{
								$row_cus = $result_customer->fetch_assoc();
							?>
                            <td><?php echo $row_cus['name'];?></td>
                            <td><?php echo $row_cus['new_IC'];?></td>
                            <?php
							}
							?>
                           
                            <td><?php echo $row['amt_per_day'];?></td>
                            <td><?php echo $no_of_terms;?></td>
                            <td><?php echo $row['start_date'];?></td>
                            <td><?php echo $row['duration'];?></td>
                            <td><?php echo $row['center_id'];?></td>
                            <td><?php echo $row['advance'];?></td>
                            <td><?php echo $row['loan_out'];?></td>
                            <td><?php echo $row['deposit'];?></td>
                            <td></td>
                            <td><?php echo $Variable2;?></td>
                            <td>
                            <?php 
							$total_collection = 0;
							$collection_sql = "SELECT amount FROM collection WHERE card_id = ".$row['id'];
							$res = mysqli_query($conn,$collection_sql);
							if($res->num_rows > 0)
							{
								$res1 = $res->fetch_assoc();
								$total_collection+=$res1['amount'];
							}
							echo $total_collection;
							?>
                            </td>
                            <td><?php echo $row['profit'];?></td>
                            <td><?php echo $row['crossed_date'];?></td>
                        </tr>
				<?php
					}				
				}
			}} else {
            	switch ($d_startMonth) {
            		case '01':
            		case '03':
            		case '05':
            		case '07':
            		case '08':
            		case '10':
            		case '12':
            			$d_days = 31;
            			break;
            		case '04':
            		case '06':
            		case '09':
            		case '11':
            			$d_days = 30;
            			break;
            		case '02':
            			if ($d_startYear % 4 == 0)
            				$d_days = 29;
            			else
            				$d_days = 28;
            			break;
            	}
            	$d_start_date = "01-".$d_startMonth."-".$d_startYear;
            	$d_end_date = str_pad($d_days, 2, "0", STR_PAD_LEFT)."-".$d_startMonth."-".$d_startYear;
            	$d_today = $d_startMonth."-".$d_startYear;

				if ($_SESSION['group_name'] != "admin") {
					if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != "")) {
						$sql = "SELECT a.* FROM customers_card AS a LEFT JOIN users AS b ON a.user_agent_id = b.id WHERE a.clear_payment != 1 AND a.center_id = '".$_SESSION['center_id']."' AND a.user_agent_id = '".$_SESSION['agent_id']."' AND (a.start_date LIKE '%".$searchDate."%' OR a.crossed_date LIKE '%".$searchDate."%' OR a.code LIKE '%".$searchText."%' OR b.user_name LIKE '%".$searchText."%');";
					} elseif (isset($searchText) && $searchText != "") {
						$sql = "SELECT a.* FROM customers_card AS a LEFT JOIN users AS b ON a.user_agent_id = b.id WHERE a.clear_payment != 1 AND a.center_id = '".$_SESSION['center_id']."' AND a.user_agent_id = '".$_SESSION['agent_id']."' AND (a.code LIKE '%".$searchText."%' OR b.user_name LIKE '%".$searchText."%');";
					} elseif (isset($searchDate) && $searchDate != "") {
						$sql = "SELECT a.* FROM customers_card AS a LEFT JOIN users AS b ON a.user_agent_id = b.id WHERE a.clear_payment != 1 AND a.center_id = '".$_SESSION['center_id']."' AND a.user_agent_id = '".$_SESSION['agent_id']."' AND (a.start_date LIKE '%".$searchDate."%' OR a.crossed_date LIKE '%".$searchDate."%');";
					} else {
						$sql = "SELECT * FROM customers_card WHERE clear_payment != 1 AND center_id = '".$_SESSION['center_id']."' AND user_agent_id = '".$_SESSION['agent_id']."';";
					}
				} else {
					if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != "")) {
						$sql = "SELECT a.* FROM customers_card AS a LEFT JOIN users AS b ON a.user_agent_id = b.id WHERE a.clear_payment != 1 AND a.center_id = '".$_SESSION['center_id']."' AND (a.start_date LIKE '%".$searchDate."%' OR a.crossed_date LIKE '%".$searchDate."%' OR a.code LIKE '%".$searchText."%' OR b.user_name LIKE '%".$searchText."%');";
					} elseif (isset($searchText) && $searchText != "") {
						$sql = "SELECT a.* FROM customers_card AS a LEFT JOIN users AS b ON a.user_agent_id = b.id WHERE a.clear_payment != 1 AND a.center_id = '".$_SESSION['center_id']."' AND (a.code LIKE '%".$searchText."%' OR b.user_name LIKE '%".$searchText."%');";
					} elseif (isset($searchDate) && $searchDate != "") {
						$sql = "SELECT a.* FROM customers_card AS a LEFT JOIN users AS b ON a.user_agent_id = b.id WHERE a.clear_payment != 1 AND a.center_id = '".$_SESSION['center_id']."' AND (a.start_date LIKE '%".$searchDate."%' OR a.crossed_date LIKE '%".$searchDate."%');";
					} else {
						$sql = "SELECT * FROM customers_card WHERE clear_payment != 1 AND center_id = '".$_SESSION['center_id']."';";
					}
				}

				$res = mysqli_query($conn, $sql);
$total_onhand = 0;
$total_amount_paid = 0;
$total_interest_paid = 0;
$total_profit_paid = 0;
				while ($myrow = mysqli_fetch_array($res)) {
					$s_day = explode("-", $myrow['crossed_date']);
					$s_days = $s_day[1]."-".$s_day[2];
					if ($s_days == $d_today) {?>
						<tr>
							<td><?php echo $myrow['start_date'];?></td>
							<td><?php echo $myrow['code'];?></td>
							<td><?php echo $myrow['loan_out'];?></td>
							<td><?php echo $myrow['profit'];?></td>
							<td><?php echo $myrow['deposit'];?></td>
							<td><?php echo $myrow['advance'];?></td>
							<td><?php echo $myrow['no_of_terms'];?></td>
							<td><?php echo $myrow['crossed_date'];?></td>
							<td><?php echo $myrow['loan_out'] - $myrow['profit'] - $myrow['deposit'] - $myrow['advance'];?></td>
<?php
$total_onhand += ($myrow['loan_out'] - $myrow['profit'] - $myrow['deposit'] - $myrow['advance']);
$sql2 = "SELECT * FROM collection WHERE card_id = '".$myrow['id']."';";
$res2 = mysqli_query($conn, $sql2);
$amount_paid = 0;
$interest_paid = 0;
while ($myrow2 = mysqli_fetch_array($res2)) {
	$amount_paid += $myrow2['amount'];
	$interest_paid += $myrow2['interest'];
}
$total_amount_paid += $amount_paid;
$total_interest_paid += $interest_paid;
$total_profit_paid += ($amount_paid - ($myrow['loan_out'] - $myrow['profit'] - $myrow['deposit'] - $myrow['advance']) + $interest_paid);

$sql5 = "SELECT * FROM users WHERE id = '".$myrow['user_agent_id']."';";
$res5 = mysqli_query($conn, $sql5);
$myrow5 = mysqli_fetch_assoc($res5);
?>
							<td><?php echo $amount_paid;?></td>
							<td><?php echo $interest_paid;?></td>
							<td><?php echo $amount_paid - ($myrow['loan_out'] - $myrow['profit'] - $myrow['deposit'] - $myrow['advance']) + $interest_paid;?></td>
							<td><?php echo $myrow5['user_name'];?></td>
						</tr>
					<?php }
				}
			}
			if ($_SESSION['center_id'] != 5) {?>
      <tr>
        <td colspan="6" class="ConfirmValue">printed at<font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> <?php echo date("d/m/Y H:i:s");?></strong></font></td>
        
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
			<?php } else {?>
      <tr>
        <td colspan="7" class="ConfirmValue">printed at<font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> <?php echo date("d/m/Y H:i:s");?></strong></font></td>
        
        <td>Total</td>
        <td class="total_td"><?php echo $total_onhand;?></td>
        <td class="total_td"><?php echo $total_amount_paid;?></td>
        <td class="total_td"><?php echo $total_interest_paid;?></td>
        <td class="total_td"><?php echo $total_profit_paid;?></td>
        <td class="total_td"></td>
      </tr>
			<?php }?>
    </tbody>
	</table>
</section>








<?php } elseif ($report == "rpt05") {
	$d_startMonth = $_POST['d_startMonth'];
	$d_startYear = $_POST['d_startYear'];
	?>
<section style="padding-bottom: 20px;">
	<div class="">
		<p><strong>		
		<?php echo $d_startMonth.'-'.$d_startYear;?></strong>
		Monthly Summary<span class="ConfirmValue"></span></p>
	</div>
	<a href="monthly_report.php" class="btn btn-info">Back</a>
	<form method="post">
		<input type="hidden" name="report" value="rpt05">
		<input type="hidden" name="t_center_id" value="<?php echo $t_center_id;?>">
		<input type="hidden" name="all_center" value="<?php echo $all_center;?>">
		<input type="hidden" name="d_startYear" value="<?php echo $d_startYear;?>">
		<input type="hidden" name="d_startMonth" value="<?php echo $d_startMonth;?>">
		<label>Lend Date/Dateline：</label>
		<input type="date" name="searchDate">
		<br>
		<label>Code/Dealer</label>
		<input type="text" name="searchText">
		<br>
		<input type="submit" name="search" class="btn btn-success" value="Search">
	</form>
    <?php 
    $sql = "SELECT * FROM center_detail WHERE id = '".$_SESSION['center_id']."';";
    $res = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($res);
    ?>
				<div>
					<p>Center<span class="ConfirmValue"> <strong>
					<?php echo $rows['id'].' - '.$rows['center_name'];?>
					</strong> </span></p>
				</div>

	<table cellspacing="1" cellpadding="1" style="width:100%;" class="table table-striped table-bordered">
        <caption class="menu-header">Monthly Summary Report</caption>
        <thead>
            <tr>
            	<th></th>
            	<th>Start Date</th>
            	<th>Code</th>
            	<th>Lend Amount</th>
            	<th>Interest</th>
            	<th>Deposit</th>
            	<th>STP</th>
            	<th>Days</th>
            	<th>Crossed Date</th>
            	<th>Collection Date</th>
            	<th>Total Collection Amount</th>
            	<th>Total Statement</th>
            	<th>Total Lend Amount</th>
            	<th><strong>Total</strong></th>
            	<th><strong>Profit</strong></th>
            	<th>Dealer</th>
            	<th></th>
            </tr>
        </thead>

		<tbody>
				<?php
				switch ($d_startMonth) {
					case '01':
					case '03':
					case '05':
					case '07':
					case '08':
					case '10':
					case '12':
						$days = 31;
						break;
					case '04':
					case '06':
					case '09':
					case '11':
						$days = 30;
						break;
					case '02':
						if ($d_startYear % 4 == 0) {
							$days = 29;
						} else {
							$days = 28;
						}
						break;
				}
				$j = 0;
				for ($i = 1; $i <= $days; $i++) {
					$datesss = str_pad($i, 2, "0", STR_PAD_LEFT)."-".$d_startMonth."-".$d_startYear;
					$datesssss = strtotime($datesss);
					if ($_SESSION['group_name'] != "admin") {
						if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != "")) {
							$sql = "SELECT a.id AS abc, a.amount, a.interest, a.d_date_disp, b.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%' OR b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') AND (a.d_date_disp = '".$datesssss."' OR b.start_date = '".$datesss."');";
						} elseif (isset($searchText) && $searchText != "") {
							$sql = "SELECT a.id AS abc, a.amount, a.interest, a.d_date_disp, b.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') AND (a.d_date_disp = '".$datesssss."' OR b.start_date = '".$datesss."');";
						} elseif (isset($searchDate) && $searchDate != "") {
							$sql = "SELECT a.id AS abc, a.amount, a.interest, a.d_date_disp, b.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%') AND (a.d_date_disp = '".$datesssss."' OR b.start_date = '".$datesss."');";
						} else {
							$sql = "SELECT a.id AS abc, a.amount, a.interest, a.d_date_disp, b.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (a.d_date_disp = '".$datesssss."' OR b.start_date = '".$datesss."');";
						}
					} else {
						if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != "")) {
							$sql = "SELECT a.id AS abc, a.amount, a.interest, a.d_date_disp, b.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%' OR b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') AND (a.d_date_disp = '".$datesssss."' OR b.start_date = '".$datesss."');";
						} elseif (isset($searchText) && $searchText != "") {
							$sql = "SELECT a.id AS abc, a.amount, a.interest, a.d_date_disp, b.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND (b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') AND (a.d_date_disp = '".$datesssss."');";
						} elseif (isset($searchDate) && $searchDate != "") {
							$sql = "SELECT a.id AS abc, a.amount, a.interest, a.d_date_disp, b.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%') AND (a.d_date_disp = '".$datesssss."' OR b.start_date = '".$datesss."');";
						} else {
							$sql = "SELECT a.id AS abc, a.amount, a.interest, a.d_date_disp, b.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.center_id = '5' AND (a.d_date_disp = '".$datesssss."' OR b.start_date = '".$datesss."');";
						}
					}

					// echo $sql."<br>";
					$res = mysqli_query($conn, $sql);
					while ($myrow = mysqli_fetch_array($res)) {
						$data[$j++] = $myrow['abc'];
					}
				}

				sort($data);
				$data2 = array_unique($data);
				sort($data2);
				// print_r($data2);
				// echo count($data2);
				// echo "<br>";

				$sql = "SELECT a.amount, a.interest, a.d_date_disp, b.*, c.user_name FROM collection AS a LEFT JOIN customers_card AS b ON a.card_id = b.id LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE a.id = '".$data2[0]."'";
				// echo $sql;

				for ($i = 1; $i < count($data2); $i++) { 
					$sql .= " OR a.id = '".$data2[$i]."'";
				}

				// echo $sql;

				$res = mysqli_query($conn, $sql);
				$total = 0;
				$total_collect = 0;
				$total_clear = 0;
				$total_out = 0;
				while ($myrow = mysqli_fetch_array($res)) {
					$collect = 0;
					$clear = 0;
					$out = 0;
					$dates = date("d-m-Y", $myrow['d_date_disp']);
					$exp_date = explode("-",$dates);
					if ($d_startMonth == $exp_date[1] && $d_startYear == $exp_date[2]) {
						$collect = $myrow['amount'] + $myrow['interest'];
						$total_collect += $myrow['amount'] + $myrow['interest'];
						if ($myrow['remark1'] == "清") {
							$clear = $myrow['amount'] + $myrow['interest'];
							$total_clear += $myrow['amount'] + $myrow['interest'];
						}
					}
					$temp = explode("-", $myrow['start_date']);

					if ($d_startMonth == $temp[1] && $d_startYear == $temp[2]) {
						$out = $myrow['loan_out'];
					} else {
						$out = 0;
					}
					$total_out += $out;
?>
			<tr>
				<td></td>
				<td><?php echo $myrow['start_date'];?></td>
				<td><?php echo $myrow['code'];?></td>
				<td><?php echo $myrow['loan_out'];?></td>
				<td><?php echo $myrow['profit'];?></td>
				<td><?php echo $myrow['deposit'];?></td>
				<td><?php echo $myrow['advance'];?></td>
				<td><?php echo $myrow['no_of_terms'];?></td>
				<td><?php echo $myrow['crossed_date'];?></td>
				<td><?php echo date("d-m-Y", $myrow['d_date_disp']);?></td>
				<td><?php echo $collect;?></td>
				<td><?php echo $clear;?></td>
				<td><?php echo $out;?></td>
				<td><?php echo $collect + $clear - $out;?></td>
				<td><?php echo "0";?></td>
				<td><?php echo $myrow['user_name'];?></td>
				<td></td>
			</tr>
<?php
				}
				$total = $total_collect + $total_clear - $total_out;
				?>
			<tr style="font-weight: bold;">
				<td></td>
				<td colspan="9" style="text-align: right;">Total: </td>
				<td><?php echo $total_collect;?></td>
				<td><?php echo $total_clear;?></td>
				<td><?php echo $total_out;?></td>
				<td><?php echo $total;?></td>
				<td><?php echo "0";?></td>
				<td></td>
				<td></td>
			</tr>
    </tbody>
	</table>
</section>








<?php } elseif ($report == "rpt06") {
	$d_startMonth = $_POST['d_startMonth'];
	$d_startYear = $_POST['d_startYear'];
	?>
<section>
	<div>
		<p><strong>		
		<?php echo $d_startMonth.'-'.$d_startYear;?></strong>
		Monthly Summary<span class="ConfirmValue"></span></p>
	</div>
	<a href="monthly_report.php" class="btn btn-info">Back</a>
	<form method="post">
		<input type="hidden" name="report" value="rpt06">
		<input type="hidden" name="t_center_id" value="<?php echo $t_center_id;?>">
		<input type="hidden" name="all_center" value="<?php echo $all_center;?>">
		<input type="hidden" name="d_startYear" value="<?php echo $d_startYear;?>">
		<input type="hidden" name="d_startMonth" value="<?php echo $d_startMonth;?>">
		<label>Lend Date/Dateline：</label>
		<input type="date" name="searchDate">
		<br>
		<label>Code/Dealer</label>
		<input type="text" name="searchText">
		<br>
		<input type="submit" name="search" class="btn btn-success" value="Search">
	</form>
    <?php 
    $sql = "SELECT * FROM center_detail WHERE id = '".$_SESSION['center_id']."';";
    $res = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($res);
    ?>
				<div>
					<p>Center<span class="ConfirmValue"> <strong>
					<?php echo $rows['id'].' - '.$rows['center_name'];?>
					</strong> </span></p>
				</div>

	<table cellspacing="1" cellpadding="1" style="width:100%" class="table table-striped table-bordered">
        <caption class="menu-header">Monthly Loan Report</caption>
        <thead>
            <tr>
            	<th></th>
            	<th>Start Date</th>
            	<th>Code</th>
            	<th>Lend Amount</th>
            	<th>Interest</th>
            	<th>Deposit</th>
            	<th>STP</th>
            	<th>Days</th>
            	<th>Deadline</th>
            	<th>Collection Date</th>
            	<th>Dealer</th>
            	<th></th>
            </tr>
        </thead>

		<tbody>
				<?php
				$datesss = $d_startMonth."-".$d_startYear;
				$datesssss = strtotime($datesss);
				if ($_SESSION['group_name'] != "admin") {
					if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != "")) {
						$sql = "SELECT b.*, c.user_name FROM customers_card AS b LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE c.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%' OR b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') AND b.start_date LIKE '%".$datesss."';";
					} elseif (isset($searchText) && $searchText != "") {
						$sql = "SELECT b.*, c.user_name FROM customers_card AS b LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE c.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') AND b.start_date LIKE '%".$datesss."';";
					} elseif (isset($searchDate) && $searchDate != "") {
						$sql = "SELECT b.*, c.user_name FROM customers_card AS b LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE c.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%') AND b.start_date LIKE '%".$datesss."';";
					} else {
						$sql = "SELECT b.*, c.user_name FROM customers_card AS b LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE c.center_id = '5' AND b.user_agent_id = '".$_SESSION['agent_id']."' AND b.start_date LIKE '%".$datesss."';";
					}
				} else {
					if ((isset($searchText) && $searchText != "") && (isset($searchDate) && $searchDate != "")) {
						$sql = "SELECT b.*, c.user_name FROM customers_card AS b LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE c.center_id = '5' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%' OR b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') AND b.start_date LIKE '%".$datesss."';";
					} elseif (isset($searchText) && $searchText != "") {
						$sql = "SELECT b.*, c.user_name FROM customers_card AS b LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE c.center_id = '5' AND (b.code LIKE '%".$searchText."%' OR c.user_name LIKE '%".$searchText."%') AND b.start_date LIKE '%".$datesss."';";
					} elseif (isset($searchDate) && $searchDate != "") {
						$sql = "SELECT b.*, c.user_name FROM customers_card AS b LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE c.center_id = '5' AND (b.start_date LIKE '%".$searchDate."%' OR b.crossed_date LIKE '%".$searchDate."%') AND b.start_date LIKE '%".$datesss."';";
					} else {
						$sql = "SELECT b.*, c.user_name FROM customers_card AS b LEFT JOIN users AS c ON b.user_agent_id = c.id WHERE c.center_id = '5' AND b.start_date LIKE '%".$datesss."';";
					}
				}

				$res = mysqli_query($conn, $sql);
				$total = 0;
				$total_collect = 0;
				$total_clear = 0;
				$total_out = 0;
				while ($myrow = mysqli_fetch_array($res)) {
					$collect = 0;
					$clear = 0;
					$out = 0;
					$dates = date("d-m-Y", $myrow['d_date_disp']);
					$exp_date = explode("-",$dates);
					if ($d_startMonth == $exp_date[1] && $d_startYear == $exp_date[2]) {
						$collect = $myrow['amount'] + $myrow['interest'];
						$total_collect += $myrow['amount'] + $myrow['interest'];
						if ($myrow['remark1'] == "清") {
							$clear = $myrow['amount'] + $myrow['interest'];
							$total_clear += $myrow['amount'] + $myrow['interest'];
						}
					}
					$out = $myrow['loan_out'];
					$total_out += $myrow['loan_out'];
?>
			<tr>
				<td></td>
				<td><?php echo $myrow['start_date'];?></td>
				<td><?php echo $myrow['code'];?></td>
				<td><?php echo $myrow['loan_out'];?></td>
				<td><?php echo $myrow['profit'];?></td>
				<td><?php echo $myrow['deposit'];?></td>
				<td><?php echo $myrow['advance'];?></td>
				<td><?php echo $myrow['no_of_terms'];?></td>
				<td><?php echo $myrow['crossed_date'];?></td>
				<td><?php echo date("d-m-Y", $myrow['d_date_disp']);?></td>
				<td><?php echo $myrow['user_name'];?></td>
				<td></td>
			</tr>
<?php
				}
				$total = $total_collect + $total_clear - $total_out;
				?>
			<!-- <tr style="font-weight: bold;">
				<td></td>
				<td colspan="9" style="text-align: right;">Total: </td>
				<td><?php // echo $total_collect;?></td>
				<td><?php // echo $total_clear;?></td>
				<td><?php // echo $total_out;?></td>
				<td><?php // echo $total;?></td>
				<td><?php // echo "0";?></td>
				<td></td>
				<td></td>
			</tr> -->
    </tbody>
	</table>
</section>













<?php } else {?>
    <section>
    <form id="form1" name="form1" method="post" action="monthly_report.php">
		<div class="row form-group">
			<div class="col-md-2"></div>
			<div class="col-md-2">
				<label>Center ID:</label>
			</div>
			<div class="col-md-6">
				<select name="t_center_id" class="form-control" style="width:50%;">
					<?php 
					
				
						$current_user_center= '';
						if($_SESSION["group_name"]!='superadmin')
						{
							$current_user_center = "WHERE id = ".$_SESSION["center_id"];
						}
						$select_center_deatil = "SELECT * FROM center_detail ".$current_user_center." ORDER BY show_sequence ASC";
						$result = mysqli_query($conn,$select_center_deatil);
						if($result->num_rows > 0)
						{
							//$count=0;
							
							while($row = $result->fetch_assoc()){
									
					?>
					<option value="<?php echo $row['id'];?>"><?php echo $row['center_name'];?></option>                            
					<?php }}?>
				</select>                </div>
			<div class="col-md-2"></div>
		</div>
		<!-- checkbox hide user  -->
			<?php
				if($_SESSION["group_name"]=='superadmin'){
					?>
				<br/>
				<div class="row form-group">
					<div class="col-md-2"></div>
					<div class="col-md-2"></div>
					<div class="col-md-6">
						<input type="checkbox" name="all_center" value="all"/>  All Center
					</div>
					<div class="col-md-2"></div>
				</div>
					<?php
				}
				else{
					
				}
			?>
	
		<br/>
		<div class="row form-group">
			<div class="col-md-2"></div>
			<div class="col-md-2">
				<label>Date:</label>
			</div>
			<div class="col-md-6">
				<div class="col-md-4">
					<select name="d_startMonth" class="form-control">
				 
					  <?php 
						for($i=1; $i<=12; $i++)
						{
							if($i<10)
							{
								$i = '0'.$i;
							}
						?>
						<option value="<?php echo $i; ?>" <?php if($i==date('m')){ echo 'selected="selected"';} ?>><?php echo $i; ?></option>
						<?php
						}
						?>
					</select>
				</div>
			   
				<div class="col-md-4">
					<select name="d_startYear" class="form-control">       
					 <?php 
						$current_year = date("Y")-10;
						for($i = $current_year; $i <= date('Y', strtotime('+5 year')); $i++)
						{
					?>
					<option value="<?php echo $i; ?>" <?php if($i==date('Y')){ echo 'selected="selected"';} ?>><?php echo $i; ?></option>
					<?php
						}
					?>
					
				</select>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<br/>
		<div class="row form-group">
			<div class="col-md-2"></div>
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<input name="rpt01" type="submit" class="btn btn-success" id="rpt01" value="Monthly Collection Report">
			</div>
			<div class="col-md-2"></div>
		</div>
		<?php if ($_SESSION['center_id'] != 5) {?>
		<div class="row form-group">
			<div class="col-md-2"></div>
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<input name="rpt02" type="submit" class="btn btn-success" id="rpt02" value="Monthly Balance Report">
			</div>
			<div class="col-md-2"></div>
		</div>
	<?php } else {?>
		<div class="row form-group">
			<div class="col-md-2"></div>
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<input name="rpt06" type="submit" class="btn btn-success" id="rpt06" value="Monthly Loan Report">
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row form-group">
			<div class="col-md-2"></div>
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<input name="rpt03" type="submit" class="btn btn-success" id="rpt03" value="Monthly Statement Report">
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row form-group">
			<div class="col-md-2"></div>
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<input name="rpt04" type="submit" class="btn btn-success" id="rpt04" value="Monthly Deadline Report">
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row form-group">
			<div class="col-md-2"></div>
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<input name="rpt05" type="submit" class="btn btn-success" id="rpt05" value="Monthly Summary Report">
			</div>
			<div class="col-md-2"></div>
		</div>
	<?php }?>
        </form>
    </section>
<?php 
}?>
</div>
<style>
.ConfirmValue {
    font-size: small;
    color: #0000FF;
    font-weight: normal;
}
body
{
	color:#000;
}
.SubMenuCaption {
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    color: #000000;
    background-color: #038603;
    border-top-style: none;
    border-right-style: none;
    border-bottom-style: none;
    border-left-style: none;
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
caption,.total_td {
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
.total_td
{
	text-align:left !important;
}
</style>



<style>
caption {
  padding-top: .75rem;
  padding-bottom: .75rem;
  color: #6c757d;
  text-align: center;
  caption-side: bottom;
  background-color: #038603;
  color: #FFF;
  caption-side: top;
}

	</style>


