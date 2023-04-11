<?php 
include('header.php');

if(isset($_POST['joblisting']))
{ 
	$t_center_id = $_POST['t_center_id'];
	$d_startDay = $_POST['startDay'];
	$d_startMonth = $_POST['startMonth'];
	$d_startYear = $_POST['startYear'];
	
	 $selected_date = $d_startDay.'-'.$d_startMonth.'-'.$d_startYear;
	 function getDatesFromRange($start, $end, $format = 'd-m-Y') { 
		  
		// Declare an empty array 
		$array = array(); 
		  
		// Variable that store the date interval 
		// of period 1 day 
		$interval = new DateInterval('P1D'); 
	  
		$realEnd = new DateTime($end); 
		$realEnd->add($interval); 
	  
		$period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
	  
		// Use loop to store date into array 
		foreach($period as $date) {                  
			$array[] = $date->format($format);  
		} 

		// Return the array elements 
		
		return $array; 
	}
		
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Job Listing</h1></center>
         
        </div>
		
      </div><!-- /.container-fluid -->
	  
    </section>
	 <div>
		<button onclick="window.print()" class="btn btn-success">Print</button>
		</div>
<section>
	<table border="1" align="center" class="table">
    <tbody><tr>
      <td>
	    <table cellspacing="0" cellpadding="0" border="0">
          <tbody><tr>
           <!-- <td><div align="left">Center ID :<span class="SpecialHeader"> <?php //echo $t_center_id;?>
                  <input name="t_center_id" type="hidden" id="t_center_id" value="<?php //echo $t_center_id;?>">
            </span></div></td> -->
			<td><div align="left">Center ID :<span class="SpecialHeader"> <?php 
			//echo $t_center_id;
			//die;
				$select_center_deatil_hwe = "SELECT * FROM center_detail where id = '$t_center_id' ";
					$result = mysqli_query($conn,$select_center_deatil_hwe);
					$row_login_hwe = mysqli_fetch_assoc($result);
					echo  $row_login_hwe['center_name'];
					
			?>
                 <input name="t_center_id" type="hidden" id="t_center_id" value="<?php echo $t_center_id;?>">
            </span></div></td>
          </tr>
          <tr>
            <td><div align="left">Date : <span class="SpecialHeader"><?php echo $d_startDay.'-'.$d_startMonth.'-'.$d_startYear; ?></span>
                   <!-- <input type="hidden" name="startDay" value="<?php echo $d_startDay;?>"/>
		<input type="hidden" name="startMonth" value="<?php echo $d_startMonth;?>"/>
		<input type="hidden" name="startYear" value="<?php echo $d_startYear;?>"/>-->
            </div></td>
          </tr>
        </tbody></table>
	    <table cellspacing="1" cellpadding="1" border="0" class="table" style="width:100%">
        <tbody><tr>
          <td><div align="center">No</div></td>
          <td><div align="center">Amount</div></td>
          <td><div align="center">Interest</div></td>
          <td><div align="center">Name</div></td>
          <td><div align="center">Phone</div></td>
          <td><div align="center">Z</div></td>
          <td><div align="center">Start</div></td>
          <td><div align="center">nT</div></td>
          <td><div align="center">Last</div></td>
          <td><div align="center">xT</div></td>
          <td><div align="center">DU</div></td>
          <td><div align="center">Customer's Card ID </div></td>
          </tr>
		  
		  
		<?php
		$customer_ids = array();
		if($_SESSION["group_name"]!='superadmin')			
		{
			 $sql = "SELECT * FROM customers_card WHERE center_id = $t_center_id AND user_agent_id =".$_SESSION["agent_id"]." AND clear_payment != 1";
			
		}
		else
		{
			$sql = "SELECT * FROM customers_card WHERE center_id = $t_center_id AND clear_payment != 1";	
		}
		$result = mysqli_query($conn,$sql);
		//print_r($result );
		if($result->num_rows > 0)
		{
			$count=0;
			while($row = $result->fetch_assoc())
			{
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
				
				$no_of_days = '+'.$no_of_terms.' days';
				
				$end_date = date('d-m-Y', strtotime($no_of_days));
				
				//$array = array(); 
	  
				// Use strtotime function 
				$Variable1 = date('d-m-Y',strtotime($start_date)); 
				$Variable2 = date('d-m-Y',strtotime($end_date));
					$Date='';			  
				// Function call with passing the start date and end date 
				$Date = getDatesFromRange($Variable1, $Variable2);
				$blue_color_time =0; 
				foreach($Date as $d)
				{
					if($d != $Variable1)
					{
						 if(strtotime($d) < strtotime(date("d-m-Y"))){
							$blue_color_time++;
							 //$style = 'style="background:blue;color:#fff;"';
						 }
						 else
						 {
							 //$style = 'style="background:red;color:#fff;"';
						 }
					}
				}
				//print_r($Date).'<br/>';
				if(in_array($selected_date,$Date))
				{
					//$customer_ids[] =$customer_id;
					
					//echo $customer_id.'/';
					$select_user = "SELECT * FROM customers WHERE id = $customer_id";
					$resultuser = mysqli_query($conn,$select_user);
					$name =$telephone='';
					
					if($resultuser->num_rows > 0)
					{
						$row = $resultuser->fetch_assoc();
						
							$name = $row['name'];
							$telephone = $row['telephone_1'];
						
					}
					
					?>
					<tr>
					<!--<td colspan="12" class="ErrMsg"><div align="center">***** No Record for this Center. Please add a select again***** </div></td>-->
                        <td><div align="center"><?php echo ++$count;?></div></td>
                        <?php 
						 $sql_query="SELECT * FROM collection WHERE card_id=$card_id AND center_id = $t_center_id";
						$results = mysqli_query($conn,$sql_query);
						$total_amount_hwe = $interest_hwe=0;
						if($results->num_rows > 0)
						{
							while($rows_hwe = $results->fetch_assoc())
							{
								//print_r($rows_hwe );
								$interest_hwe += $rows_hwe['interest'];
								$total_amount_hwe += $rows_hwe['amount'];
							}
						}
						?>
                        <td><div align="center"><?php echo $total_amount_hwe;?></div></td>
                        <td><div align="center"><?php echo $interest_hwe;?></div></td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $telephone;?></td>
                         <td><?php echo $amt_per_day;?></td>
                        <td><?php echo $start_date;?></td>
                         <td><?php echo $blue_color_time;?></td>
                        <td><?php echo $Variable2;?></td>
                        <td><?php echo $no_of_terms;?></td>
                        <td><?php echo $duration;?></td>
                        <td><?php echo $card_id.'-'.$customer_id;?></td>
					</tr>
					<?php
							
		
				}
			}
		}
		?>
		  
		  
		  
          
              </tbody></table></td>
    </tr>
  </tbody></table>
</section>
</div>
<style>
.SpecialHeader {
    color: #0000FF;
}
body
{
	color:#000;
}
.span_hwe
{
	float:left;
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
.btn-success
{
	background:#038603 !important;
}

</style>