<?php
include('header.php');

$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
	$previous = $_SERVER['HTTP_REFERER'];
}

if (isset($_GET['q'])) {
	$quotation_id = $_GET['q'];
} else {
	echo "<script>window.location = 'dashboard.php';</script>";
}

$sql = "SELECT * FROM quotation WHERE id = '".$quotation_id."';";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

if (isset($_POST['confirm'])) {
	$sql = "UPDATE quotation SET state = 'Confirmed' WHERE id = '".$quotation_id."';";
	mysqli_query($conn, $sql);
	echo '<script>alert("Order confirmed.")</script>';
	echo "<script>window.location = 'customer.php?t_cust_id=".$row['customer_id']."&Submit=1';</script>";
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Confirm Order Number: <?php echo $quotation_id;?></h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
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
    	<div class="container" style="overflow-x: auto;">
        	<table cellspacing="0" cellpadding="2" align="center" class="table table-bordered table-striped">
        		<caption class="menu-header">
        			Product List
                </caption>
                <thead>
                	<tr>
	                    <th>&nbsp;</th>
	                    <th style="text-align: center;">No</th>
	                    <th>Product</th>
	                    <th>Size</th>
	                    <th>Details</th>
	                    <th style="text-align: center;">Quantity</th>
	                    <th style="text-align: right;">Total</th>
	                    <th></th>
	                </tr>
	            </thead>
	            <tbody>
<?php
$sql = "SELECT a.*, b.product, c.name AS track_name, d.name AS design_name FROM quotation_details AS a LEFT JOIN product_list AS b ON a.product_id = b.id LEFT JOIN track_list AS c ON a.track_id = c.id LEFT JOIN design_list AS d ON a.design_id = d.id WHERE a.quotation_id = '".$quotation_id."';";
$res = mysqli_query($conn, $sql);
$i = 1;
$total_price = 0;
while ($myrow = mysqli_fetch_assoc($res)) {
?>
					<tr>
						<td></td>
						<td style="text-align: center;"><?php echo $i++;?></td>
						<td><?php echo $myrow['product'];?></td>
						<td>
							Width: <?php echo $myrow['width'];?><br>Height: <?php echo$myrow['height'];
							if ($myrow['track_id'] != "0" && $myrow['design_id'] != "0") {
								echo "<br>";
								echo "Fabric Size: ".$myrow['fabric_size'];
							}?>
						</td>
						<td>
							<?php
							if ($myrow['track_id'] != "0" && $myrow['design_id'] != "0") {
								echo $myrow['track_name'];
								echo "<br>";
								echo $myrow['design_name'];
							} else {
								if ($install != 0) {
									echo "Installation ".$myrow['install_quantity']." Set";
								} else {
									echo "No Installation";
								}
							}?>
						</td>
						<td style="text-align: center;"><?php echo $myrow['quantity'];?></td>
						<td style="text-align: right;"><?php printf("RM%0.2f", $myrow['price']);?></td>
						<td></td>
					</tr>
<?php
$total_price += $myrow['price'];
}?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td style="text-align: right; font-weight: bold;">Total: </td>
						<td class="total_td" style="text-align: right; font-weight: bold;"><?php printf("RM%0.2f", $total_price);?></td>
						<td></td>
					</tr>
                </tbody>
            </table>
        </div>
        <br/>
<?php
if ($_SESSION['group_name'] == "admin") {?>
        <div class="container">
        	<form id="form1" name="form1" method="post">
                <p align="center">
                  <label>
                  <input name="confirm" type="submit" class="btn btn-success" onclick="return confirm('Are you sure to confirm this order?')" value="Confirm Order">
                  </label>
                  <input name="quotation_id" type="hidden" id="quotation_id" value="<?php echo $quotation_id;?>">
                </p>
            </form>
        </div>
<?php }?>
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