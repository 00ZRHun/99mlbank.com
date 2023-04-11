<?php
include('header.php');
if (isset($_GET['q'])) {
	$quotation_id = $_GET['q'];
}
$sql = "SELECT * FROM quotation WHERE id = '".$quotation_id."';";
$res = mysqli_query($conn, $sql);
$myrow = mysqli_fetch_assoc($res);
$state = $myrow['state'];
$customer_id = $myrow['customer_id'];

if (isset($_POST['complete'])) {
	$date = date("Y-m-d");
	$sql = "UPDATE quotation SET state = 'Completed' WHERE id = '".$quotation_id."';";
	if ($res = mysqli_query($conn, $sql)){
		echo "<script>alert('Order Completed.')</script>";
		echo "<script>window.location = 'complete_order_list.php';</script>";
	}
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="">
        <center> <h1>Order Details</h1></center>
       
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section>
  	<!-- customer details -->
<?php
$sql = "SELECT * FROM customers WHERE id = '".$customer_id."';";
$res = mysqli_query($conn, $sql);
$myrow = mysqli_fetch_assoc($res);
?>
  	<table cellspacing="0" cellpadding="5">
  		<tr>
  			<td>Customer ID</td>
  			<td>:</td>
  			<td><?php echo $myrow['id'];?></td>
  		</tr>
  		<tr>
  			<td>Name</td>
  			<td>：</td>
  			<td><?php echo $myrow['name'];?></td>
  		</tr>
  		<tr>
  			<td>Address</td>
  			<td>：</td>
  			<td><?php echo $myrow['address_1'];?></td>
  		</tr>
  		<tr>
  			<td></td>
  			<td></td>
  			<td><?php echo $myrow['address_2'];?></td>
  		</tr>
  		<tr>
  			<td></td>
  			<td></td>
  			<td><?php echo $myrow['address_3'];?></td>
  		</tr>
  		<tr>
  			<td></td>
  			<td></td>
  			<td><?php echo $myrow['address_4'];?></td>
  		</tr>
  		<tr>
  			<td>Phone</td>
  			<td>：</td>
  			<td><?php echo $myrow['telephone_1'];?></td>
  		</tr>
  		<tr>
  			<td></td>
  			<td></td>
  			<td><?php echo $myrow['telephone_2'];?></td>
  		</tr>
  		<tr>
  			<td>Gender</td>
  			<td>：</td>
  			<td><?php echo $myrow['gender']." - "; if ($myrow['gender'] == "F") {echo "Female";} elseif ($myrow['gender'] == "M") {echo "Male";}?></td>
  		</tr>
  		<tr>
  			<td>How To Know</td>
  			<td>：</td>
  			<td><?php echo $myrow['how_to_know'];?></td>
  		</tr>
  		<tr>
  			<td>Remark</td>
  			<td>：</td>
  			<td><?php echo $myrow['remark'];?></td>
  		</tr>
  	</table>




  </section>
	<section style="overflow-x: auto;">
		<table cellspacing="0" cellpadding="2" border="1" class="table table-striped table-bordered" >
	    <caption class="menu-header">
	      Order Number: <?php echo $quotation_id;?>（<?php echo $state;?>）
	    </caption>
	    <thead>
	        <tr style="text-align: left;">
	            <th>&nbsp;</th>
                <th style="text-align: center;">No</th>
                <th>Product</th>
                <th>Size</th>
                <th>Details</th>
                <th style="text-align: center;">Quantity</th>
                <th style="text-align: right;">Total Amount</th>
	            <th>&nbsp;</th>
	        </tr>
	    </thead>
	    
	    <tbody>
<?php
$sql = "SELECT * FROM quotation_details WHERE quotation_id = '".$quotation_id."';";
$res = mysqli_query($conn, $sql);
$i = 1;
$total = 0;
while ($row = mysqli_fetch_array($res)) {
	$sql = "SELECT * FROM product_list WHERE id = '".$row['product_id']."';";
	$res1 = mysqli_query($conn, $sql);
	$myrow = mysqli_fetch_assoc($res1);

	$sql = "SELECT * FROM track_list WHERE id = '".$row['track_id']."';";
	$res2 = mysqli_query($conn, $sql);
	$myrow2 = mysqli_fetch_assoc($res2);

	$sql = "SELECT * FROM design_list WHERE id = '".$row['design_id']."';";
	$res3 = mysqli_query($conn, $sql);
	$myrow3 = mysqli_fetch_assoc($res3);

	$total += $row['price'];
	$quantity += $row['quantity'];
?>
				<tr style="text-align: left;">
					<td></td>
					<td style="text-align: center;"><?php echo $i++;?></td>
					<td><?php echo $myrow['product'];?></td>
					<td>
						<?php echo "Width: ".$row['width']."<br>Height: ".$row['height'];
						if ($row['track_id'] != 0 && $row['design_id'] != 0) {
							echo "<br>Fabric Size: ".$row['fabric_size'];
						}
						?>
					</td>
					<td>
						<?php
						if ($row['track_id'] != 0 && $row['design_id'] != 0) {
							echo $myrow2['name']."<br>".$myrow3['name'];
						} else {
							if ($row['install'] != 0) {
								echo "Installation ".$row['install_quantity']." Set";
							} else {
								echo "No Installation";
							}
						}
						?>
					</td>
					<td style="text-align: center;"><?php echo $row['quantity'];?></td>
					<td style="text-align: right;"><?php printf("RM%0.2f", $row['price']);?></td>
					<td></td>
				</tr>
<?php }?>
				<tr style="text-align: left; font-weight: bold;">
					<td></td>
					<td colspan="4">Total: </td>
					<td style="text-align: center;"><?php echo $quantity;?></td>
					<td style="text-align: right;"><?php printf("RM%0.2f", $total);?></td>
					<td></td>
				</tr>
			</tbody>
    </table>
<?php
if ($state == "Confirmed") {?>
    <br>
    <div class="container">
    	<form id="form1" name="form1" method="post">
            <p align="center">
              <label>
              <input name="complete" type="submit" class="btn btn-success" onclick="return confirm('Are you sure?')" value="Complete Order">
              </label>

            </p>
        </form>
    </div>
<?php }?>
  </section>
</div>
<style>
body
{
	color:#000;
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
	caption-side:top;
	padding-top:0px;
	padding-bottom:0px;
	text-align:center;
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