<?php
include('header.php');
// $selected_date = $d_startDay.'-'.$d_startMonth.'-'.$d_startYear;
function getDatesFromRange($start, $end, $format = 'd-m-Y')
{

	// Declare an empty array 
	$array = array();

	// Variable that store the date interval 
	// of period 1 day 
	$interval = new DateInterval('P1D');

	$realEnd = new DateTime($end);
	$realEnd->add($interval);

	$period = new DatePeriod(new DateTime($start), $interval, $realEnd);

	// Use loop to store date into array 
	foreach ($period as $date) {
		$array[] = $date->format($format);
	}

	// Return the array elements 

	return $array;
}

$customer_card_table = "CREATE TABLE IF NOT EXISTS " . $table_prefix . "collection (
    id INT AUTO_INCREMENT PRIMARY KEY,
	card_id VARCHAR(255) NOT NULL,
	amount INT(11) DEFAULT 0,
	interest INT(11) DEFAULT 0,
	center_id VARCHAR(255),
	d_date_disp VARCHAR(255)
)";

if (mysqli_query($conn, $customer_card_table)) {
} else {
	echo "Error creating table: " . mysqli_error($conn);
}
$agent_id = $_SESSION["agent_id"];

$customer_expenses_table = "CREATE TABLE IF NOT EXISTS " . $table_prefix . "customer_expenses (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
	center_id INT(11) NOT NULL,
	date VARCHAR(255),
	misc VARCHAR(255),
	repair VARCHAR(255),
	advance VARCHAR(255),
	outbalance VARCHAR(255),
	inbalance VARCHAR(255),
	card_id INT(11)
)";

if (mysqli_query($conn, $customer_expenses_table)) {
} else {
	echo "Error creating table: " . mysqli_error($conn);
}


?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="">
				<center>
					<h1>Loan Report</h1>
				</center>

			</div>
		</div><!-- /.container-fluid -->
	</section>
	<?php
	if (isset($_REQUEST['Search']) || isset($_POST['confirm']) || isset($_POST['cmdLock'])) {
		$t_center_id = $_REQUEST['t_center_id'];
		// use date-type input to improve ui
		/* $d_startDay = $_REQUEST['d_startDay'];
		$d_startMonth = $_REQUEST['d_startMonth'];
		$d_startYear = $_REQUEST['d_startYear']; */
		$date_arr1 =  $_REQUEST['d_startDate'];
		$date_arr = explode("-", $_REQUEST['d_startDate']);   // Format: YYYY-mm-dd; Eg: 2023-03-29
		$d_startDay = $date_arr[2];
		$d_startMonth = $date_arr[1];
		$d_startYear = $date_arr[0];
		/* echo ('$d_startDate = ' . json_encode($d_startDate));   // D
		echo ('$d_startDay = ' . $d_startDay);
		echo ('$d_startMonth = ' . $d_startMonth);
		echo ('$d_startYear = ' . $d_startYear); */

		if (isset($_POST['confirm'])) { //echo $d_startDay ;

			$collection = $_POST['collection'];
			//print_r($collection);
			$d_date_disp = $_POST['d_date_disp'];
			$t_center_id = $_POST['t_center_id'];
			//print_r($collection);
			$cross_check = $_POST['cross_check'];
			$clear_payment = $_POST['clear_payment'];
			$d_startDay = $_POST['startDay'];
			$d_startMonth = $_POST['startMonth'];
			$d_startYear = $_POST['startYear'];

			$misc = $_POST['misc'];
			$repair = $_POST['repair'];
			$advance = $_POST['advance'];
			$out = $_POST['out'];
			$in = $_POST['in'];
			$card_ids = $_POST['card_id'];
			foreach ($card_ids as $card_id) {
				$sql123 = "SELECT * FROM " . $table_prefix . "customer_expenses WHERE center_id = $t_center_id AND date = '" . strtotime($d_date_disp) . "' AND card_id =" . $card_id;
				$result_expenses = mysqli_query($conn, $sql123);
				if (mysqli_num_rows($result_expenses) > 0) {
					$update_expenses = "UPDATE " . $table_prefix . "customer_expenses SET misc ='" . $misc . "',repair='" . $repair . "',advance='" . $advance . "',outbalance='" . $out . "',inbalance='" . $in . "' WHERE center_id = $t_center_id AND date = '" . strtotime($d_date_disp) . "' AND card_id=" . $card_id;

					mysqli_query($conn, $update_expenses);
				} else {
					$insert_expenses = "INSERT INTO " . $table_prefix . "customer_expenses (`center_id`,`date`,`misc`,`repair`,`advance`,`outbalance`,`inbalance`,`card_id`) VALUES($t_center_id,'" . strtotime($d_date_disp) . "','" . $misc . "','" . $repair . "','" . $advance . "','" . $out . "','" . $in . "'," . $card_id . ")";
					mysqli_query($conn, $insert_expenses);
				}
			}
			//strtotime($d_date_disp);

			foreach ($cross_check as $key => $cross_value) {
				if ($cross_value == 1) {
					$sql_customer_card = "UPDATE " . $table_prefix . "customers_card SET crossed_date = '" . date("d-m-Y") . "', crossed = '1' WHERE id = " . $key;
					mysqli_query($conn, $sql_customer_card);
				}
			}

			foreach ($clear_payment as $key => $clear_payment_value) {
				if ($clear_payment_value == 1) {
					$sql_clear_payment = "UPDATE " . $table_prefix . "customers_card SET clear_payment = '1' WHERE id = " . $key;
					mysqli_query($conn, $sql_clear_payment);
				}
			}

			foreach ($collection as $key => $value) {
				$card_id = $key;

				$amount = $value['amount'];
				$interest = $value['interest'];
				if (empty($amount)) {
					$amount = 0;
				}
				if (empty($interest)) {
					$interest = 0;
				}



				$sql_collection = "SELECT * FROM " . $table_prefix . "collection WHERE center_id = '$t_center_id' AND d_date_disp = '" . strtotime($d_date_disp) . "' AND card_id='$card_id'";
				$result_collection = mysqli_query($conn, $sql_collection);
				//echo $result_collection->num_rows.'/';
				if ($result_collection->num_rows > 0) {

					$sql = "UPDATE " . $table_prefix . "collection SET amount=$amount,interest=$interest WHERE card_id = '$card_id' AND center_id = '$t_center_id' AND d_date_disp = '" . strtotime($d_date_disp) . "'";

					if (mysqli_query($conn, $sql)) {
						$success = "collection updated successfully.";
					}
				} else {
					$date123 = strtotime($d_date_disp);
					$sql = "INSERT INTO " . $table_prefix . "collection (
					card_id,amount,interest,center_id,d_date_disp) VALUES ('$card_id' ,
					$amount,
					$interest,
					'$t_center_id',
					'$date123')";

					if (mysqli_query($conn, $sql)) {
						$success = "collection added successfully.";
					}
				}
			}
		}

	?>

		<section>
			<div class="container" style="overflow-x: scroll;">
				<form id="form1" name="form1" method="post" action="collection.php">

					<table border="1" align="center" width="100%">
						<tbody>
							<tr>
								<td>
									<table cellspacing="0" cellpadding="0" border="0">
										<tbody>
											<tr>
												<td colspan="3">
													<div align="left">Center ID :<span class="SpecialHeader"><?php echo $t_center_id; ?>
															<input name="t_center_id" type="hidden" id="t_center_id" value="<?php echo $t_center_id; ?>">
														</span></div>
												</td>
												<td>&nbsp;</td>
												<td rowspan="2">
													<?php
													if (isset($_POST['cmdLock']) &&  $_POST['cmdLock'] == "Lock") {
													?>
														<table bgcolor="#FF0000">
															<tbody>
																<tr>
																	<td><strong>Lock</strong></td>
																	<td> <input type="submit" name="cmdLock" value="Open"> <!-- OPT: 打開 -->
																		<?php echo date('Y-m-d H:i:s'); ?> </td>
																</tr>
															</tbody>
														</table>
													<?php
													} else {
													?>
														<table bgcolor="#00FF00">
															<tbody>
																<tr>
																	<td><strong>Open</strong></td>
																	<td>
																		<input type="submit" name="cmdLock" value="Lock"> <!-- OPT: 關閉 -->
																	</td>
																</tr>
															</tbody>
														</table>
													<?php
													}
													?>
												</td>
											</tr>

											<tr>
												<td colspan="3">
													<div align="left">Date : <span class="SpecialHeader"><?php echo $d_startDay . '-' . $d_startMonth . '-' . $d_startYear; ?></span>
														<!--<input name="d_date" type="hidden" id="d_date" value="2020-10-17">-->
														<input name="d_date_disp" type="hidden" id="d_date_disp" value="<?php echo $d_startDay . '-' . $d_startMonth . '-' . $d_startYear; ?>">
														<input name="d_startDate" type="hidden" value="<?= $_REQUEST['d_startDate'] ?>"> <!-- keep a copy of this value for 'open & lock' toggle btn -->
													</div>
												</td>
												<td>&nbsp;</td>
											</tr>
										</tbody>
									</table>
									<table cellspacing="1" cellpadding="1" border="1" style="width: 100%;">
										<thead>
											<tr>
												<th>
													<div align="center">Customer Name:</div>
												</th>
												<th>
													<div align="center">Date</div>
												</th>
												<th>
													<div align="center">QTY</div>
												</th>
												<th>
													<div align="center">Instalment Due</div>
												</th>
												<th>
													<div align="center">Instalment Paid</div>
												</th>
												<th>
													<div align="center">Instalment QTY Paid %</div>
												</th>
												<th>
													<div align="center">Payment Paid %</div>
												</th>
												<th>
													<div align="center">Instalment Unpaid Qty</div>
												</th>
												<th>
													<div align="center">Instalment Unpaid %</div>
												</th>
												<th>
													<div align="center">Instalment Unpaid Normal Loan</div>
												</th>
												<th>
													<div align="center">Instalment Unpaid(Bad debt) Qty</div>
												</th>
												<th>
													<div align="center">Instalment Unpaid(Bad debt) %</div>
												</th>
												<th>
													<div align="center">Bad debt</div>
												</th>
												<th>
													<div align="center">Variance</div>
												</th>
												<th>
													<div align="center">Avr instalment</div>
												</th>
											</tr>

											<?php
											$amt = 0;
											$int = 0;
											$customer_ids = array();
											$selected_date = $d_startDay . '-' . $d_startMonth . '-' . $d_startYear;
											/*
			if($_SESSION["group_name"]!='superadmin')			
			{
				 $sql = "SELECT * FROM customers_card WHERE center_id = $t_center_id AND user_agent_id =".$agent_id." ";
				
			}
			else
			{
				 $sql = "SELECT * FROM customers_card WHERE center_id = $t_center_id ";
			}
		 
	    */
											if ($_SESSION["group_name"] == 'superadmin') {
												//$sql = "SELECT * FROM customers_card WHERE center_id = $t_center_id  where user_agent_id=".$_SESSION['last_login'];
												$sql = "SELECT * FROM " . $table_prefix . "customers_card WHERE center_id = $t_center_id AND clear_payment != 1";
											} else {
												if ($_SESSION['group_name'] != "admin")
													//$sql = "SELECT * FROM " . $table_prefix . "customers_card WHERE center_id = $t_center_id AND user_agent_id =" . $agent_id . " AND clear_payment != 1";
												      $sql = "SELECT *,i.status as Instalment_Status,(SELECT COUNT(*) FROM a_instalment) as count1,l.status as loan_status1,c.name as c_name
												            FROM  a_instalment i
												            LEFT JOIN a_payment p ON i.id = p.instalment_id
												            LEFT JOIN a_loan l ON i.loan_id = l.id
												            LEFT JOIN a_customer c ON l.customer = c.id 
												            WHERE DATE(i.payment_due) = '$date_arr1'";
												           // $sql = "SELECT COUNT(a_instalment.id) as count1 FROM  a_instalment";
												else
													$sql = "SELECT * FROM " . $table_prefix . "customers_card WHERE center_id = $t_center_id AND clear_payment != 1";
											}
											$result = mysqli_query($conn, $sql);
/*	if ($result->num_rows > 0) {
	    echo "1";die;
	}
	else{
	    echo "2";die;
	}*/
											if ($result->num_rows > 0) {
												$count = 0;
												$total_instalment = 0;
												$total_paymentamount = 0;
												$Instalment_Paid_Quantity = 0;
												$Instalment_Unpaid_Quantity = 0;
												$total_unpaid_instalment = 0;
												$avr_instalment = 0;
												$baddebt_quantity = 0;
												$baddebt_amount = 0;
												$paidorunpaid = "";

												while ($row = $result->fetch_assoc()) {
												    $C_name = $row['c_name'];
													$loan_id = $row['loan_id'];
													$due_amount = $row['due_amount'];
													$payment_amount = $row['payment_amount'];
													$amt_per_day = $row['amt_per_day'];
													$status = $row['Instalment_Status'];
													$loan_status = $row['loan_status1'];
													$advance = $row['advance'];
													$loan_out = $row['loan_out'];
													$deposit = $row['deposit'];
													$crossed = $row['crossed'];
													$crossed_date = $row['crossed_date'];
													$count1 = $row['count1'];
													
													$no_of_days = '+' . $no_of_terms . ' days';

													$end_date = date('d-m-Y', strtotime($no_of_days));
													
													$total_instalment +=  $due_amount;
                                                    $total_paymentamount += $payment_amount;
                                                    
                                                    
                                                    
                                                    // Paid or Unpaid
                                                    if($status == 'Unpaid'){
                                                        $paidorunpaid = "Unpaid";
                                                        $Instalment_Unpaid_Quantity ++;
                                                        $total_unpaid_instalment += $due_amount; 
                                                    }else if($status == 'Paid'){
                                                        $paidorunpaid = "Paid";
                                                        $Instalment_Paid_Quantity ++;
                                                    }
                                                    
                                                    
                                                    // Bad Debt or Normal
                                                    if($loan_status == 'Normal'){
                                                        
                                                    }else if($loan_status == 'Bad Dept'){
                                                        $baddebt_quantity ++;
                                                        $baddebt_amount += $due_amount; 
                                                    }
                                                    
                                                
                                                    
													//$array = array(); 

													// Use strtotime function 
													$Variable1 = date('d-m-Y', strtotime($start_date));
													$Variable2 = date('d-m-Y', strtotime($end_date));
													$Date = '';
													// Function call with passing the start date and end date 
													$Date = getDatesFromRange($Variable1, $Variable2);
													$blue_color_time = 0;
													foreach ($Date as $d) {
														if ($d != $Variable1) {
															if (strtotime($d) < strtotime(date("d-m-Y"))) {
																$blue_color_time++;
																//$style = 'style="background:blue;color:#fff;"';
															} else {
																//$style = 'style="background:red;color:#fff;"';
															}
														}
													}
													//print_r($Date).'<br/>';
													if (in_array($selected_date, $Date)) {
														//$customer_ids[] =$customer_id;

														//echo $customer_id.'/';
														$select_user = "SELECT * FROM " . $table_prefix . "customers WHERE id = $customer_id";
														$resultuser = mysqli_query($conn, $select_user);
														$name = $telephone = '';

														if ($resultuser->num_rows > 0) {
															$row = $resultuser->fetch_assoc(); {
																$name = $row['name'];
																$telephone = $row['telephone_1'];
															}
														}

														$sql2 = "SELECT * FROM `" . $table_prefix . "collection` WHERE d_date_disp = '" . strtotime($selected_date) . "' and center_id = $center_id and card_id = $card_id";
														$result1 = mysqli_query($conn, $sql2);
														if ($result1->num_rows > 0) {
															$row = $result1->fetch_assoc();
															$amt += $row['amount'];
															$int += $row['interest'];
														}
														
													}
													$count ++;
												    $instalment_Unpaid_baddebt1 = $baddebt_quantity/$count*100;
												    $Instalment_Unpaid_baxian1 = 1/$count1*100;	
												    $total_paymentpaid1 = $payment_amount/$due_amount;
											    	$instalment_Qty_Paid1 = $Instalment_Paid_Quantity/$due_amount;
											    	$variance1 = $payment_amount-$due_amount;
													?>
														<tr>
												<th>
													<div align="center"><?php echo $C_name; ?></div>
												</th>
												<th>
													<div align="center"><?php echo $date_arr1; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "1"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo $due_amount; ?></div>
												</th>
												<th>
													<div align="center"><?php echo $total_paymentamount; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$instalment_Qty_Paid1%"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$total_paymentpaid1%"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$paidorunpaid"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$Instalment_Unpaid_baxian1%"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$due_amount"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$instalment_Unpaid_baddebt1%"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$instalment_Unpaid_baddebt1"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$baddebt_amount"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$variance1"; ?></div>
												</th>
											</tr>
										<?php
										}
												$total_paymentpaid = $total_paymentamount/$total_instalment;
												$avr_instalment = $total_instalment/$count;
												$Instalment_Unpaid_baxian = $count/$count1*100;
												$instalment_Qty_Paid = $Instalment_Paid_Quantity/$total_instalment;
												$variance = $total_paymentamount - $total_instalment;
												$instalment_Unpaid_baddebt = $baddebt_quantity/$count*100;
									

											?>
											<tr>
												<th>
													<div align="center"><?php echo "Total"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo $date_arr1; ?></div>
												</th>
												<th>
													<div align="center"><?php echo $count; ?></div>
												</th>
												<th>
													<div align="center"><?php echo $total_instalment; ?></div>
												</th>
												<th>
													<div align="center"><?php echo $total_paymentamount; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$instalment_Qty_Paid%"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$total_paymentpaid%"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$Instalment_Unpaid_Quantity"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$Instalment_Unpaid_baxian%"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$total_unpaid_instalment"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$instalment_Unpaid_baddebt%"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$instalment_Unpaid_baddebt"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$baddebt_amount"; ?></div>
												</th>
												<th>
													<div align="center"><?php echo "$variance"; ?></div>
												</th>
												<th colspan="2">
													<div align="center"><?php echo "$avr_instalment"; ?></div>
												</th>
											</tr>
										</thead>
										<?php
										}else { ?>

												<tr>
													<td colspan="15" class="ErrMsg">
														<div align="center">***** No Record for this Center. Please add a select again ***** </div>
													</td>
												</tr>
											<?php } 
										?>
										<tbody>
											<?php
											$selected_date = $d_startDay . '-' . $d_startMonth . '-' . $d_startYear;
											$customer_ids = array();

											if ($_SESSION["group_name"] != 'superadmin') {
												if ($_SESSION['group_name'] != "admin") {
													$sql = "SELECT * FROM " . $table_prefix . "customers_card WHERE center_id = $t_center_id AND user_agent_id =" . $agent_id . " AND clear_payment != 1";
												} else {
													$sql = "SELECT * FROM " . $table_prefix . "customers_card WHERE center_id = $t_center_id AND clear_payment != 1";
												}
											} else {
												$sql = "SELECT * FROM " . $table_prefix . "customers_card WHERE center_id = $t_center_id AND clear_payment != 1";
											}

											//$sql = "SELECT * FROM customers_card WHERE center_id = $t_center_id AND user_agent_id =".$agent_id." ";
											$result = mysqli_query($conn, $sql);

											if ($result->num_rows > 0) {
												$count = 0;
												while ($row = $result->fetch_assoc()) {
													$card_id = $row['id'];
													$customer_id = $row['customer_id'];
													$center_id = $row['center_id'];
													$amt_per_day = $row['amt_per_day'];
													$no_of_terms = $row['no_of_terms'];
													$start_date = $row['start_date'];
													$duration = $row['duration'];
													$advance = $row['advance'];
													$loan_out = $row['loan_out'];
													$deposit = $row['deposit'];
													$crossed = $row['crossed'];
													$crossed_date = $row['crossed_date'];
													$profit = $row['profit'];
													$code = $row['code'];

													$no_of_days = '+' . $no_of_terms . ' days';

													$end_date = date('d-m-Y', strtotime($no_of_days));

													//$array = array(); 

													// Use strtotime function 
													$Variable1 = date('d-m-Y', strtotime($start_date));
													$Variable2 = date('d-m-Y', strtotime($end_date));
													$Date = '';
													// Function call with passing the start date and end date 
													$Date = getDatesFromRange($Variable1, $Variable2);
													$blue_color_time = 0;
													foreach ($Date as $d) {
														if ($d != $Variable1) {
															if (strtotime($d) < strtotime(date("d-m-Y"))) {
																$blue_color_time++;
																//$style = 'style="background:blue;color:#fff;"';
															} else {
																//$style = 'style="background:red;color:#fff;"';
															}
														}
													}
													//print_r($Date).'<br/>';
													if (in_array($selected_date, $Date)) {
														//$customer_ids[] =$customer_id;

														//echo $customer_id.'/';
														$select_user = "SELECT * FROM " . $table_prefix . "customers WHERE id = $customer_id ";
														$resultuser = mysqli_query($conn, $select_user);
														$name = $telephone = '';

														if ($resultuser->num_rows > 0) {
															$row111111 = $resultuser->fetch_assoc(); {
																$name = $row111111['name'];
																$telephone = $row111111['telephone_1'];
															}
														}
														$selected_date = $d_startDay . '-' . $d_startMonth . '-' . $d_startYear;
														$sql2 = "SELECT * FROM `" . $table_prefix . "collection` WHERE d_date_disp = '" . strtotime($selected_date) . "' and center_id = $center_id and card_id = $card_id";
														$result1 = mysqli_query($conn, $sql2);
														if ($result1->num_rows > 0) {
															$row = $result1->fetch_assoc();
														}


											?>
														<tr>
															<td><a class="btn btn-success" href="history.php?cust_cardid=<?php echo $card_id; ?>&amp;cardid=1" target="_self">歷史紀錄</a></td>
															<td><?php echo ++$count; ?></td>
															<td><input type="checkbox" name="cross_check[<?php echo $card_id; ?>]" value="1" /></td>
															<td><input type="checkbox" name="clear_payment[<?php echo $card_id; ?>]" value="1" /></td>
															<td>
																<div align="right"><input name="collection[<?php echo $card_id; ?>][amount]" type="text" id="amount" value="<?php echo $amount = $row['amount'] ?? 0; ?>"></div>
															</td>
															<td>
																<div align="right"><input name="collection[<?php echo $card_id; ?>][interest]" type="text" id="interest" value="<?php echo $interest = $row['interest'] ?? 0; ?>"></div>
															</td>
															<?php
															if ($t_center_id != 5) { ?>
																<td><?php echo $name; ?></td>
																<td><?php echo $telephone; ?></td>
																<td><?php echo $amt_per_day; ?></td>
																<td><?php echo $start_date; ?></td>
																<td><?php echo $blue_color_time; ?></td>
																<td><?php echo $crossed_date; ?></td>
																<td><?php echo $no_of_terms; ?></td>
															<?php } else { ?>
																<td colspan="2"><?php echo $code; ?></td>
																<td><?php echo $start_date; ?></td>
																<td><?php echo $no_of_terms; ?></td>
																<td><?php echo $crossed_date; ?></td>
															<?php } ?>
															<td><?php echo $duration; ?></td>
															<?php
															if ($t_center_id != 5) { ?>
																<td><?php echo $customer_id; ?><input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" /></td>
															<?php } ?>
															<td><?php echo $card_id; ?> <input type="hidden" name="card_id[]" value="<?php echo $card_id; ?>" /></td>
														</tr>
												<?php
													}
												}
											} ?>
										</tbody>
									</table>
								</td>
							</tr>
							<?php
							if ($_SESSION["group_name"] != 'superadmin') {
								$sql = "SELECT * FROM " . $table_prefix . "customers_card WHERE center_id = $t_center_id AND user_agent_id =" . $agent_id . " AND clear_payment != 1";
							} else {
								$sql = "SELECT * FROM " . $table_prefix . "customers_card WHERE center_id = $t_center_id AND clear_payment != 1";
							}
							$result_hwe22 = mysqli_query($conn, $sql);
							$customer_card = array();
							if (mysqli_num_rows($result_hwe22) > 0) {
								while ($rowssss = mysqli_fetch_assoc($result_hwe22)) {
									$customer_card[] = $rowssss['id'];
								}
							}



							$misc = 0;
							$repair = 0;
							$advance = 0;
							$out = 0;
							$inbalance = 0;
							$selected_date = $d_startDay . '-' . $d_startMonth . '-' . $d_startYear;
							if ($_SESSION["group_name"] != 'superadmin') {
								$sql = "SELECT * FROM `" . $table_prefix . "customer_expenses` WHERE date = '" . strtotime($selected_date) . "' and center_id = $t_center_id and card_id IN(" . implode(',', $customer_card) . ")";
								$result1 = mysqli_query($conn, $sql);
								if ($result1->num_rows > 0) {
									$row = $result1->fetch_assoc();
									$misc = $row['misc'];
									$repair = $row['repair'];
									$advance = $row['advance'];
									$out = $row['outbalance'];
									$inbalance = $row['inbalance'];
								}
							} else {
								$misc_array = array();
								$repair_array = array();
								$advance_array = array();
								$out_array = array();
								$inbalance_array = array();
								$sql = "SELECT * FROM `" . $table_prefix . "customer_expenses` WHERE date = '" . strtotime($selected_date) . "' and center_id = $center_id";


								$result1 = mysqli_query($conn, $sql);
								if ($result1->num_rows > 0) {
									while ($row = $result1->fetch_assoc()) {
										/*$misc+=$row['misc'];
					$repair+=$row['repair'];
					$advance+= $row['advance'];
					$out+= $row['outbalance'];
					$inbalance+= $row['inbalance'];*/

										if (!in_array($row['misc'], $misc_array)) {
											$misc_array[] = $row['misc'];
										}
										if (!in_array($row['repair'], $repair_array)) {
											$repair_array[] = $row['repair'];
										}
										if (!in_array($row['advance'], $advance_array)) {
											$advance_array[] = $row['advance'];
										}
										if (!in_array($row['outbalance'], $out_array)) {
											$out_array[] = $row['outbalance'];
										}
										if (!in_array($row['inbalance'], $inbalance_array)) {
											$inbalance_array[] = $row['inbalance'];
										}
									}
								}
								$misc = array_sum($misc_array);
								$repair = array_sum($repair_array);
								$advance = array_sum($advance_array);
								$out = array_sum($out_array);
								$inbalance = array_sum($inbalance_array);
							}

							?>
							<tr>
								<td>
									<table border="1">
										<tbody>

											<?php if ($_SESSION["group_name"] != 'superadmin') { ?>
												<tr>
													<td>Expenses</td>
													<td>Amount</td>
												</tr>
												<tr>
													<td>Misc.</td>
													<td><input name="misc" type="text" id="misc" value="<?php if (empty($misc)) echo '';
																										else echo $misc; ?>"></td>
												</tr>
												<tr>
													<td>Repair</td>
													<td><input name="repair" type="text" id="repair" value="<?php if (empty($repair)) echo '';
																											else echo $repair; ?>"></td>
												</tr>
												<tr>
													<td>Advance</td>
													<td><input name="advance" type="text" id="advance" value="<?php if (empty($advance)) echo '';
																												else echo $advance; ?>"></td>
												</tr>
												<tr>
													<td>Out</td>
													<td><input name="out" type="text" id="out" value="<?php if (empty($out)) echo '';
																										else echo $out; ?>"></td>
												</tr>
												<tr>
													<td>In</td>
													<td><input name="in" type="text" id="in" value="<?php if (empty($inbalance)) echo '';
																									else echo $inbalance; ?>"></td>
												</tr>
											<?php } else { ?>
												<tr>
													<td style="width:10%">Expenses</td>
													<td style="width:20%">Amount</td>
												</tr>
												<tr>
													<td>Misc.</td>
													<td><?php if (empty($misc)) echo '';
														else echo $misc; ?></td>
												</tr>
												<tr>
													<td>Repair</td>
													<td><?php if (empty($repair)) echo '';
														else echo $repair; ?></td>
												</tr>
												<tr>
													<td>Advance</td>
													<td><?php if (empty($advance)) echo '';
														else echo $advance; ?></td>
												</tr>
												<tr>
													<td>Out</td>
													<td><?php if (empty($out)) echo '';
														else echo $out; ?></td>
												</tr>
												<tr>
													<td>In</td>
													<td><?php if (empty($inbalance)) echo '';
														else echo $inbalance; ?></td>
												</tr>
											<?php } ?>

										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<?php
									if (isset($_POST['cmdLock']) &&  $_POST['cmdLock'] == "Lock") {
									} else {
									?>

										<!--<input name="d_date_disp" type="hidden" id="d_date_disp" value="<?php echo $d_startDay . '-' . $d_startMonth . '-' . $d_startYear; ?>">-->
										<input type="hidden" name="startDay" value="<?php echo $d_startDay; ?>" />
										<input type="hidden" name="startMonth" value="<?php echo $d_startMonth; ?>" />
										<input type="hidden" name="startYear" value="<?php echo $d_startYear; ?>" />

										<input name="confirm" class="btn btn-success" type="submit" id="confirm" value="確認 &amp; 保存">
									<?php } ?>
								</td>
							</tr>
						</tbody>
					</table>

				</form>

				<br />
				<form action="joblisting.php" method="post" name="form2" target="_self" id="form2">
					<div align="center">
						<input name="joblisting" type="submit" class="btn btn-success" id="joblisting" value="Print Job Listing">
						<span class="SpecialHeader">
							<input type="hidden" name="t_center_id" value="<?php echo $t_center_id; ?>" />
							<input type="hidden" name="startDay" value="<?php echo $d_startDay; ?>" />
							<input type="hidden" name="startMonth" value="<?php echo $d_startMonth; ?>" />
							<input type="hidden" name="startYear" value="<?php echo $d_startYear; ?>" />
					</div>

				</form>
			</div>
		</section>
	<?php
	} else {
	?>
		<section>
			<form id="form1" name="form1" method="get" action="collection.php">
				<div class="row form-group">
					<div class="col-md-2"></div>
					<div class="col-md-2">
						<label>Center ID:</label>
					</div>
					<div class="col-md-6">
						<select name="t_center_id" class="form-control" style="width:50%;">
							<?php
							$current_user_center = '';
							if ($_SESSION["group_name"] != 'superadmin') {
								$current_user_center = "WHERE id = " . $_SESSION["center_id"];
							}
							$select_center_deatil = "SELECT * FROM " . $table_prefix . "center_detail " . $current_user_center . " ORDER BY show_sequence ASC";
							$result = mysqli_query($conn, $select_center_deatil);
							if ($result->num_rows > 0) {
								//$count=0;

								while ($row = $result->fetch_assoc()) {

							?>
									<option value="<?php echo $row['id']; ?>"><?php echo $row['center_name']; ?></option>
							<?php }
							} ?>
						</select>
					</div>
					<div class="col-md-2"></div>
				</div>
				<br />
				<div class="row form-group">
					<div class="col-md-2"></div>
					<div class="col-md-2">
						<label>Date:</label>
					</div>
					<!-- <div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">

						<div class="col-md-4">

							<select name="d_startDay" class="form-control">
								<?php
								echo date('d');
								for ($i = 1; $i <= 31; $i++) {
									if ($i < 10) {
										$i = '0' . $i;
									}
								?>
									<option value="<?php echo $i; ?>" <?php if ($i == date('d')) {
																			echo 'selected="selected"';
																		} ?>><?php echo $i; ?></option>
								<?php
								}
								?>
							</select>
						</div>

						<div class="col-md-4">
							<select name="d_startMonth" class="form-control">

								<?php
								for ($i = 1; $i <= 12; $i++) {
									if ($i < 10) {
										$i = '0' . $i;
									}
								?>
									<option value="<?php echo $i; ?>" <?php if ($i == date('m')) {
																			echo 'selected="selected"';
																		} ?>><?php echo $i; ?></option>
								<?php
								}
								?>
							</select>
						</div>

						<div class="col-md-4">
							<select name="d_startYear" class="form-control">
								<?php
								$current_year = date("Y");
								for ($i = date('Y'); $i <= date('Y', strtotime('+2 year')); $i++) {
								?>
									<option value="<?php echo $i; ?>" <?php if ($i == date('Y')) {
																			echo 'selected="selected"';
																		} ?>><?php echo $i; ?></option>
								<?php
								}
								?>

							</select>
						</div>

					</div> -->
					<!-- use date-type input to improve ui  -->
					<div class="col-md-6">
						<input type="date" name="d_startDate" class="form-control" style="width:50%;" value="<?= date('Y-m-d') ?>" required>
					</div>
					<div class="col-md-2"></div>
				</div>
				
				<br />
				<div class="row form-group">
					<div class="col-md-2"></div>
					<div class="col-md-2"></div>
					<div class="col-md-6">
						<input name="Search" type="submit" class="btn btn-success" id="Search" value="Search">
						<input name="step" type="hidden" id="step" value="1">
					</div>
					<div class="col-md-2"></div>
				</div>

			</form>
		</section>
	<?php } ?>
</div>
<style>
	body {
		color: #000;
	}

	.span_hwe {
		float: left;
	}

	.width_hwe {
		float: right;
		width: 95%;
	}

	.content-header {
		background: #f1f1f1;
		box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.05);
		border-bottom: 1px solid #d0d0d0;
		min-height: 54px;
		height: auto;
		margin-bottom: 20px;
	}

	.ErrMsg {
		font-family: Arial, Helvetica, sans-serif;
		color: #FF0000;
	}

	.content-header h1 {
		color: #0e0d0d;
		font-size: 22px;
		font-weight: 500;
	}

	.container-fluid {
		width: 100%;
		padding-right: 0px !important;
		padding-left: 0px !important;
		margin-right: auto;
		margin-left: auto;
		left: 0;
	}

	label {
		font-size: 14px;
		color: #000;
	}

	.btn-success {
		background: #038603 !important;
	}

	.main_div {
		border: 1px solid #000;
		background: #DEE3ED;
		padding: 1%;
	}

	.main_div_col2 {
		background: #00FF00;
	}
</style>