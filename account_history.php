<?php
include('header.php');


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Account Card</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}?>
	<a href="account88.php" class="btn btn-info">Back</a>
	<section>
    	<div class="container">
        	<table cellspacing="0" cellpadding="2" align="center" class="table table-bordered table-striped">
        		<caption class="menu-header">
        			Account Card Collection Record
                </caption>
                <thead>
                	<tr>
	                    <th>Date</th>
	                    <th>Remark</th>
	                    <th>Lend Date</th>
	                    <th>Code</th>
	                    <th>$$</th>
	                    <th>INT</th>
	                    <th>DP</th>
	                    <th>STP</th>
	                    <th>On Hand</th>
	                    <th>No of Days</th>
	                    <th>Deadline</th>
	                </tr>
	            </thead>
	            <tbody>
                  <?php 
					$customer_id= "0";
					$current_user_center= '';
					if($_SESSION["group_name"]!='superadmin')
					{
						$current_user_center = " AND center_id = ".$_SESSION["center_id"];
					}
					//$sql = "SELECT * FROM customers_card WHERE customer_id = $customer_id".$current_user_center." AND clear_payment!=1";
					$sql = "SELECT * FROM ".$table_prefix."customers_card WHERE customer_id = $customer_id".$current_user_center;
					$result = mysqli_query($conn,$sql); 
					if($result->num_rows > 0)
					{
						$count=0;
						
						while($row = $result->fetch_assoc()) {	  
				  ?>

				  	<tr>
				  		<td>
				  			<a href="edit_history.php?c=<?php echo $row['id'];?>" class="btn btn-success">Edit</a>
				  			<a href="account_history.php?c=<?php echo $row['id'];?>" target="_self" class="btn btn-success">History</a>
				  		</td>
				  		<td><?php echo ++$count; ?></td>
				  		<td><?php echo $row['start_date']; ?></td>
				  		<td><?php echo $row['code']; ?></td>
				  		<td><?php echo $row['loan_out']; ?></td>
				  		<td><?php echo $row['profit']; ?></td>
				  		<td><?php echo $row['deposit']; ?></td>
				  		<td><?php echo $row['advance']; ?></td>
				  		<td><?php echo $row['loan_out'] - $row['profit'] - $row['deposit'] - $row['advance'];?></td>
				  		<td><?php echo $row['no_of_terms'];?></td>
				  		<td><?php echo $row['crossed_date']; ?></td>
                   </tr>
                   <?php }}?>
                </tbody>
            </table>
        </div>
        <br/>
        
        <div class="container">
        	<form id="form1" name="form1" method="post">
                <p align="center">
                  <label>
                  <input name="AddCard" type="submit" class="btn btn-success" id="AddCard" value="Add New Card">
                  </label>
                  <input name="t_cust_id" type="hidden" id="t_cust_id" value="<?php echo $_REQUEST['t_cust_id'];?>">
                </p>
            </form>
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