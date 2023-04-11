<?php 
include('header.php');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Daily Report</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
	<?php 
if(isset($_POST['rpt01']))
{
	$t_center_id = $_POST['t_center_id'];
	$all_center = $_POST['all_center'];
	$d_startDay = $_POST['d_startDay'];
	$d_startMonth = $_POST['d_startMonth'];
	$d_startYear = $_POST['d_startYear'];	
	
?>
<section>
	<div class="">
		<p>Daily Collection For<span class="ConfirmValue"> <strong>		
		<?php echo $d_startDay.'-'.$d_startMonth.'-'.$d_startYear;?></strong> </span></p>
    </div>
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
	else{
		$where=" and user_agent_id=".$_SESSION['agent_id'];	
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
				<caption class="menu-header">Daily Collection Report</caption>
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
					
						$get_customer_card = mysqli_query($conn,'SELECT * FROM customers_card WHERE center_id = '.$rows['id'].$where.' AND clear_payment!=1');
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
								if($date[0]==$d_startDay && $date[1] == $d_startMonth &&  $date[2] == $d_startYear )
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
			<caption class="menu-header">Daily Collection Report</caption>
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
				
				$get_customer_card = mysqli_query($conn,'SELECT * FROM customers_card WHERE center_id = '.$t_center_id.$where.' AND clear_payment!=1');
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
						if($date[0]==$d_startDay && $date[1] == $d_startMonth &&  $date[2] == $d_startYear )
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
		</table>
		<?php
				
		}
	?>

</section>
<?php
}
elseif(isset($_POST['rpt02']))
{
	$t_center_id = $_POST['t_center_id'];
	$all_center = $_POST['all_center'];
	$d_startDay = $_POST['d_startDay'];
	$d_startMonth = $_POST['d_startMonth'];
	$d_startYear = $_POST['d_startYear'];	
	$totalcollection = 0;
    $date=$d_startDay.'-'.$d_startMonth.'-'.$d_startYear;
	//$previousdate =  $dateselected=($d_startDay-1).'-'.$d_startMonth.'-'.$d_startYear;
	
	function getPreviousDate($date)
	{
		$currentDate = new DateTime($date);
		//Subtract a day using DateInterval
		$yesterdayDT = $currentDate->sub(new DateInterval('P1D'));
		//Get the date in a DD-MM-YYYY format.
		$yesterday = $yesterdayDT->format('d-m-Y');
		return $yesterday;
	}
	
	
	function getPreviousBalance($conn,$date_data_array,$t_center_id,$date,$previous_balance)
	{
		//include('config.php');
	//	$date = getPreviousDate($date);
		if($t_center_id=='all')
		{
			$where ='WHERE 1=1';
		}
		else
		{
			$where ="WHERE center_id = ".$t_center_id;
		}
		
		if ($_SESSION["group_name"] == 'superadmin') {
			$whereand.= $where;
		}
		else{
			$whereand.= $where;
			$whereand .=" AND user_agent_id=".$_SESSION['agent_id'];
		}
		//start for loan out	
		if($_SESSION["group_name"]!='superadmin')			
		{
			$sql = "SELECT * FROM customers_card $whereand AND clear_payment != 1";
		}
		else
		{
			$sql = "SELECT * FROM customers_card $whereand AND clear_payment != 1";
		}
		
		$result_hwe22 = mysqli_query($conn,$sql);
		
		$customercard_id = array();
		if(mysqli_num_rows($result_hwe22)>0)
		{
			while($rowssss = mysqli_fetch_assoc($result_hwe22))
			{
				$customercard_id[] =$rowssss['id']; 
			}
		}
		//end for loan out
		
		//start for collection
			
		if ($_SESSION["group_name"] == 'superadmin') {
			$sqlloan_out = "SELECT * FROM `customers_card` $where AND start_date = '$date' AND clear_payment!=1";
		}
		else{
			$sqlloan_out = "SELECT * FROM `customers_card` $where AND user_agent_id=".$_SESSION['agent_id']." AND start_date = '$date' AND clear_payment!=1";
		}
		//echo $sqlloan_out;
		//echo "<br/>";
		$result12 = mysqli_query($conn,$sqlloan_out);
		$loanout =0;
		if(mysqli_num_rows($result12) > 0)
		{
			while($row21 = mysqli_fetch_assoc($result12))
			{
				//print_r($row21);
				//$customercard_id[]=$row21['id'];
				$loanout+= $row21['loan_out'];
			}
		}
	
		//start for collection
			
		$total_collection = 0;
				
		$sql_collection = "SELECT * FROM collection $where and card_id IN (".implode(',',$customercard_id).")";
		
		//$sql_collection = "SELECT * FROM collection $where";
		$results = mysqli_query($conn,$sql_collection);
			
		if($results->num_rows > 0)
		{
			while($rows = $results->fetch_assoc())
			{
				$d_date_disp = $rows['d_date_disp'];
				$d_date_disp = date('d-m-Y',$d_date_disp);
				
				if($d_date_disp==$date)
				{
					$total_collection += $rows['amount'];
				}	
			}
		}
		//echo $total_collection;
		//end for collection
			
			
		//start for expenses
		/*$total_collection_previous = 0;
			
		$misc_previous= 0;
		$repair_previous= 0;
		$advance_previous= 0;
		$outbalance_previous= 0;
		$inbalance_previous= 0;*/
		
		$misc=0;
		$repair=0;
		$advance=0;
		$outbalance= 0;
		$inbalance = 0;
		
		$misc_array = array();
		$repair_array=array();
		$advance_array= array();
		$out_array= array();
		$inbalance_array = array();
		if($_SESSION["group_name"]!='superadmin')			
		{
			$get_expenses_result = "SELECT * FROM `customer_expenses` WHERE date = '".strtotime($date)."' and center_id = $t_center_id and card_id IN(".implode(',',$customercard_id).")";
			$result1 = mysqli_query($conn,$get_expenses_result);
			if($result1->num_rows > 0)
			{
				while($row = $result1->fetch_assoc())
				{
					if(!in_array($row['misc'],$misc_array[$selected_date]))
					{
						$misc_array[$selected_date][] = $row['misc'];
						$misc =array_sum($misc_array[$selected_date]);
					}
					if(!in_array($row['repair'],$repair_array[$selected_date]))
					{
						$repair_array[$selected_date][] = $row['repair'];
						$repair =array_sum($repair_array[$selected_date]);
					}
					if(!in_array($row['advance'],$advance_array[$selected_date]))
					{
						$advance_array[$selected_date][] = $row['advance'];
						$advance=array_sum($advance_array[$selected_date]);
					}
					if(!in_array($row['outbalance'],$out_array[$selected_date]))
					{
						$out_array[$selected_date][] = $row['outbalance'];
						$outbalance =array_sum($out_array[$selected_date]);
					}
					if(!in_array($row['inbalance'],$inbalance_array[$selected_date]))
					{
						$inbalance_array[$selected_date][]=$row['inbalance'];
						$inbalance =array_sum($inbalance_array[$selected_date]);
					}
				}
			}
		}
		else
		{
			$get_expenses_result = "SELECT * FROM `customer_expenses` $where AND date = '".strtotime($date)."' and card_id IN(".implode(',',$customercard_id).")"; 
			$result1 = mysqli_query($conn,$get_expenses_result);
			if($result1->num_rows > 0)
			{
				while($row = $result1->fetch_assoc())
				{
					if(!in_array($row['misc'],$misc_array[$selected_date]))
					{
						$misc_array[$selected_date][] = $row['misc'];
						$misc =array_sum($misc_array[$selected_date]);
					}
					if(!in_array($row['repair'],$repair_array[$selected_date]))
					{
						$repair_array[$selected_date][] = $row['repair'];
						$repair=array_sum($repair_array[$selected_date]);
						
					}
					if(!in_array($row['advance'],$advance_array[$selected_date]))
					{
						$advance_array[$selected_date][] = $row['advance'];
						$advance =array_sum($advance_array[$selected_date]);
						
					}
					if(!in_array($row['outbalance'],$out_array[$selected_date]))
					{
						$out_array[$selected_date][] = $row['outbalance'];
						$outbalance =array_sum($out_array[$selected_date]);
						
					}
					if(!in_array($row['inbalance'],$inbalance_array[$selected_date]))
					{
						$inbalance_array[$selected_date][]=$row['inbalance'];
						$inbalance  =array_sum($inbalance_array[$selected_date]);
					}						
				}
			}
		}	
		/*echo $date;
		echo "<br/>";
		echo $previous_balance;
		echo "<br/>";
		echo $total_collection;
		echo "<br/>";
		echo $inbalance;
		echo "<br/>";
		echo $advance;
		echo "<br/>";
		echo $outbalance;
		echo "<br/>";
		echo $misc;
		echo "<br/>";
		echo $repair;
		echo "<br/>";
		echo $loanout;
		echo "<br/>";*/
	
		$preivousbalnce = $previous_balance + $total_collection + $inbalance - ($advance+$outbalance+$misc+$repair) - $loanout;
		$stop_date = date('d-m-Y', strtotime($date . ' +1 day'));
		$date_data_array[$date]=$preivousbalnce;
		//echo date('d-m-Y');echo "<br/>";
		if(strtotime($stop_date) < strtotime(date('d-m-Y')))
		{
			//echo "case1";
			return getPreviousBalance($conn,$date_data_array,$t_center_id,$stop_date,$preivousbalnce);
		}
		else
		{
			return $date_data_array;
		}
	}
	
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
		$whereand.= $where;
	}
	else{
		$whereand.= $where;
		$whereand .=" AND user_agent_id=".$_SESSION['agent_id'];
	}
	//start for loan out	
	if($_SESSION["group_name"]!='superadmin')			
	{
		$sql = "SELECT * FROM customers_card $whereand AND clear_payment != 1";
	}
	else
	{
		$sql = "SELECT * FROM customers_card $whereand AND clear_payment != 1";
	}
	
	$result_hwe22 = mysqli_query($conn,$sql);
	$customercard_id = array();
	if(mysqli_num_rows($result_hwe22)>0)
	{
		while($rowssss = mysqli_fetch_assoc($result_hwe22))
		{
			$customercard_id[] =$rowssss['id']; 
		}
	}
	//end for loan out
	//start for collection
		
	if ($_SESSION["group_name"] == 'superadmin') {
		$sqlloan_out = "SELECT loan_out FROM `customers_card` $where AND start_date = '$date' AND clear_payment!=1";
	}
	else{
		$sqlloan_out = "SELECT * FROM `customers_card` $where AND user_agent_id=".$_SESSION['agent_id']." AND start_date = '$date' AND clear_payment!=1";
	}
	
	$result12 = mysqli_query($conn,$sqlloan_out);
	$loanout =0;
	if(mysqli_num_rows($result12) > 0)
	{
		while($row21 = mysqli_fetch_assoc($result12))
		{
			//$customercard_id[]=$row21['id'];
			$loanout+= $row21['loan_out'];
		}
	}
	
	//start for collection
		
	$total_collection = 0;
			
	$sql_collection = "SELECT * FROM collection $where and card_id IN (".implode(',',$customercard_id).")";
	//$sql_collection = "SELECT * FROM collection $where";
	
	$results = mysqli_query($conn,$sql_collection);
		
	if($results->num_rows > 0)
	{
		while($rows = $results->fetch_assoc())
		{
			$d_date_disp = $rows['d_date_disp'];
			$d_date_disp = date('d-m-Y',$d_date_disp);
			if($d_date_disp==$date)
			{
				$total_collection += $rows['amount'];
			}	
		}
	}
	//end for collection
		
		
	//start for expenses
	/*$total_collection_previous = 0;
		
	$misc_previous= 0;
	$repair_previous= 0;
	$advance_previous= 0;
	$outbalance_previous= 0;
	$inbalance_previous= 0;*/
	
	$misc=0;
	$repair=0;
	$advance=0;
	$outbalance= 0;
	$inbalance = 0;
	
	$misc_array = array();
	$repair_array=array();
	$advance_array= array();
	$out_array= array();
	$inbalance_array = array();
	if($_SESSION["group_name"]!='superadmin')			
	{
		//echo $date;
		$get_expenses_result = "SELECT * FROM `customer_expenses` WHERE date = '".strtotime($date)."' and center_id = $t_center_id and card_id IN(".implode(',',$customercard_id).")";
		//echo "<br/>";
		$result1 = mysqli_query($conn,$get_expenses_result);
		if($result1->num_rows > 0)
		{
			while($row = $result1->fetch_assoc())
			{
				if(!in_array($row['misc'],$misc_array[$selected_date]))
				{
					$misc_array[$selected_date][] = $row['misc'];
					$misc =array_sum($misc_array[$selected_date]);
				}
				if(!in_array($row['repair'],$repair_array[$selected_date]))
				{
					$repair_array[$selected_date][] = $row['repair'];
					$repair =array_sum($repair_array[$selected_date]);
				}
				if(!in_array($row['advance'],$advance_array[$selected_date]))
				{
					$advance_array[$selected_date][] = $row['advance'];
					$advance=array_sum($advance_array[$selected_date]);
				}
				if(!in_array($row['outbalance'],$out_array[$selected_date]))
				{
					$out_array[$selected_date][] = $row['outbalance'];
					$outbalance =array_sum($out_array[$selected_date]);
				}
				if(!in_array($row['inbalance'],$inbalance_array[$selected_date]))
				{
					$inbalance_array[$selected_date][]=$row['inbalance'];
					$inbalance =array_sum($inbalance_array[$selected_date]);
				}
			}
		}
	}
	else
	{
		$get_expenses_result = "SELECT * FROM `customer_expenses` $where AND date = '".strtotime($date)."'"; 
		
		$result1 = mysqli_query($conn,$get_expenses_result);
		if($result1->num_rows > 0)
		{
			while($row = $result1->fetch_assoc())
			{
			
				if(!in_array($row['misc'],$misc_array[$selected_date]))
				{
					$misc_array[$selected_date][] = $row['misc'];
					$misc =array_sum($misc_array[$selected_date]);
				}
				if(!in_array($row['repair'],$repair_array[$selected_date]))
				{
					$repair_array[$selected_date][] = $row['repair'];
					$repair=array_sum($repair_array[$selected_date]);
					
				}
				if(!in_array($row['advance'],$advance_array[$selected_date]))
				{
					$advance_array[$selected_date][] = $row['advance'];
					$advance =array_sum($advance_array[$selected_date]);
					
				}
				if(!in_array($row['outbalance'],$out_array[$selected_date]))
				{
					$out_array[$selected_date][] = $row['outbalance'];
					$outbalance =array_sum($out_array[$selected_date]);
					
				}
				if(!in_array($row['inbalance'],$inbalance_array[$selected_date]))
				{
					$inbalance_array[$selected_date][]=$row['inbalance'];
					$inbalance  =array_sum($inbalance_array[$selected_date]);
				}
									
			}
		}
	}
	
	if(isset($all_center) && !empty($all_center))
	{
		$getFirstLoanOut = "SELECT * FROM customers_card $whereand AND clear_payment != 1 order by id ASC LIMIT 0,1";
		$getFirstLoanOut_result = mysqli_query($conn,$getFirstLoanOut);
		$getFirstLoanOut_array = mysqli_fetch_assoc($getFirstLoanOut_result);
		$firstloandate = $getFirstLoanOut_array['start_date'];
		$date_data_array = array();
		$previous_balance = 0;
		$previous_balance = getPreviousBalance($conn,$date_data_array,$all_center,$firstloandate,$previous_balance);
	}
	else
	{
		$getFirstLoanOut = "SELECT * FROM customers_card $whereand AND clear_payment != 1 order by id ASC LIMIT 0,1";
		$getFirstLoanOut_result = mysqli_query($conn,$getFirstLoanOut);
		$getFirstLoanOut_array = mysqli_fetch_assoc($getFirstLoanOut_result);
		$firstloandate = $getFirstLoanOut_array['start_date'];
		$date_data_array = array();
		$previous_balance = 0;
		$previous_balance = getPreviousBalance($conn,$date_data_array,$t_center_id,$firstloandate,$previous_balance);
	}
	
	$PreviousDate = getPreviousDate($date);
	$previous_balance = $previous_balance[$PreviousDate];
	if($previous_balance=='')
	{
		$previous_balance =0;
	}
	//$previous_balance = 0;
	//$previous_balance = $loanout_previous+($misc_previous+$repair_previous+$advance_previous+$outbalance_previous+$inbalance_previous)-$total_collection_previous;
?>
<section>
    <form id="form1" name="form1" method="post" action="collection.php">
      <table align="center">
        <tr>
          <td><strong>Daily Balance For <?php echo $date ?></strong><br>
            <table width="150%" cellspacing="1" cellpadding="1" border="1">
			
              <tbody><tr>
                <td colspan="5"><strong>Previous Balance </strong></td>
                <td><div align="right"><?php 
				if($previous_balance>0){
					//echo '-';
				}
				echo $previous_balance;?></div></td>
              </tr>
              <tr>
                <td colspan="5"><strong>Total Collection </strong></td>
                <td><div align="right"><?php echo $total_collection; ?></div></td>
              </tr>
                        <tr>
                <td colspan="5"><strong>Kongsi In</strong></td>
                <td><div align="right"><?php echo $inbalance; ?></div></td>
              </tr>
              <tr>
                <td colspan="5"></td>
               <td><div align="right"><?php  
			   echo $total_collection + $inbalance;
			   ?></div></td>
                
              </tr>
              <tr>
                <td colspan="6"><strong>Expenses</strong></td>
              </tr>
               <tr>
                <td colspan="5"><strong>&nbsp;Advance</strong></td>
                <td><div align="right"><?php echo $advance; ?></div></td>
              </tr>
               <tr>
                <td colspan="5"><strong>&nbsp;KongsiOut</strong></td>
                <td><div align="right"><?php echo $outbalance; ?></div></td>
              </tr>
                <tr>
                 <tr>
                <td colspan="5"><strong>&nbsp;Miscelleneous</strong></td>
                <td><div align="right"><?php echo $misc; ?></div></td>
              </tr>
               <tr>
                <td colspan="5"><strong>&nbsp;Repair</strong></td>
                <td><div align="right"><?php echo $repair; ?></div></td>
              </tr>
        <td colspan="4"></td>
        <td><div align="right"></div></td>
        <td><div align="right"><?php echo $advance+$outbalance+$misc+$repair;?></div></td>
      </tr>
      <tr>
        <td colspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="5"><strong>Loan Out</strong> </td>
 		<td><div align="right"><?php echo  $loanout;?></div></td>
      </tr>
                <tr>
        <td colspan="4">&nbsp;</td>
        <td><div align="right"></div></td>
        <td><div align="right"></div></td>
      </tr>
      <tr>
    <td colspan="5">&nbsp;</td>
    <td><div align="right"></div></td>
  </tr>
  <tr>
    <td colspan="5"><strong>Today Balance </strong></td>
    <td><div class="SubMenuCaption" align="right"><?php //echo -$previous_balance +($total_collection + $inbalance)- ($advance+$outbalance+$misc+$repair) - $loanout;
	echo $total_collection + $inbalance- ($advance+$outbalance+$misc+$repair) - $loanout;?></div></td>
    
  </tr>
        </table></td>
    </tr>
  </tbody></table>
</form>
</section>
<?php
}
else
{
?>
    
    <section>
    <form id="form1" name="form1" method="post" action="daily_report_test.php">
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
					<select name="d_startDay" class="form-control">
						<?php 
						echo date('d');
						for($i=1; $i<=31; $i++)
						{
							if($i<10)
							{
								$i = '0'.$i;
							}
						?>
						<option value="<?php echo $i; ?>" <?php if($i==date('d')){ echo 'selected="selected"';} ?> ><?php echo $i; ?></option>
						<?php
						}
						?>
					</select>
				</div>
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
				<input name="rpt01" type="submit" class="btn btn-success" id="rpt01" value="Daily Collection Report">
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row form-group">
			<div class="col-md-2"></div>
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<input name="rpt02" type="submit" class="btn btn-success" id="rpt02" value="Daily Balance Report">
			</div>
			<div class="col-md-2"></div>
		</div>
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
</style>