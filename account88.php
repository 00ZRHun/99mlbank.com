<?php
include('header.php');
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['search'])) {
		$searchText = $_POST['searchText'];
	}
	else if (isset($_POST['AddCard'])) {
	    echo "<script>window.location = 'add_account88.php';</script>";
	}
}
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
	}
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
	<form method="post">
		<a href="dashboard.php" class="btn btn-info">Back</a>
		<br>
		<label>Lending Date/Expiration Date/Statement Date/Code/Handler:</label>
		<input type="text" name="searchText">
		<input type="submit" name="search" class="btn btn-success" value="Search">
	</form>
	<section>
    	<div class="container">
        	<table cellspacing="0" cellpadding="2" align="center" class="table table-bordered table-striped">
        		<caption class="menu-header">
        			Account Card Information
                </caption>
                <thead>
                	<tr>
	                    <th>&nbsp;</th>
	                    <th>No</th>
	                    <th>Loan Date</th>
	                    <th>Code</th>
	                    <th>Loan Amount</th>
	                    <th>Interest</th>
	                    <th>Deposit</th>
	                    <th>STP</th>
	                    <th>Get It</th>
	                    <th>Days</th>
	                    <th>Expiration Date</th>
	                    <th>Statement date</th>
	                    <th>Handler</th>
	                    <th>&nbsp;</th>
	                </tr>
	            </thead>
	            <tbody>
                  <?php 
					$customer_id= "0";
					$current_user_center= '';
					if($_SESSION["group_name"]!='superadmin')
					{
						$current_user_center = " AND a.center_id = ".$_SESSION["center_id"];
					}
					if ($_SESSION['group_name'] != "admin") {
						$current_user_center .= " AND a.user_agent_id = ".$_SESSION["agent_id"];
					}

					if (isset($searchText)) {
						$current_user_center .= " AND (a.start_date LIKE '%".$searchText."%' OR a.crossed_date LIKE '%".$searchText."%' OR a.code LIKE '%".$searchText."%' OR b.user_name LIKE '%".$searchText."%' OR c.end_date LIKE '%".$searchText."%')";
					}
					//$sql = "SELECT * FROM customers_card WHERE customer_id = $customer_id".$current_user_center." AND clear_payment!=1";
					$sql = "SELECT a.*, b.user_name FROM ".$table_prefix."customers_card AS a LEFT JOIN users AS b ON a.user_agent_id = b.id LEFT JOIN (SELECT card_id, MAX(d_date_disp) AS end_date FROM `collection` GROUP BY card_id) AS c ON a.id = c.card_id WHERE a.customer_id = $customer_id".$current_user_center;
					$result = mysqli_query($conn,$sql); 
					if($result->num_rows > 0)
					{
						$count=0;
						
						while($row = $result->fetch_assoc()) {	  
				  ?>

				  	<tr>
				  		<td>
				  			<a href="edit_history.php?c=<?php echo $row['id'];?>" class="btn btn-success">Edit</a>
				  			<a href="history.php?cust_cardid=<?php echo $row['id']; ?>&amp;cardid=1" target="_self" class="btn btn-success">History</a>
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
				  		<td><?php echo $row['crossed_date'];?></td>
				  		<td>
<?php
if ($row['clear_payment'] == 1) {
	$sql2 = "SELECT * FROM collection WHERE card_id = '".$row['id']."' AND remark1 = '清' ORDER BY d_date_disp DESC LIMIT 1;";
	$res2 = mysqli_query($conn, $sql2);
	$myrow2 = mysqli_fetch_assoc($res2);
	echo date("d-m-Y",$myrow2['d_date_disp']);
}?>
						</td>
				  		<td><?php echo $row['user_name'];?></td>
				  		<td>
				  		<?php if ($row['clear_payment'] != 1) {?>
				  			<a href="collection88.php?c=<?php echo $row['id'];?>" class="btn btn-success">Payment</a>
				  		<?php }?>
				  		</td>
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