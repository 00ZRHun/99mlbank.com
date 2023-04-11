<?php
include('header.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$quotation_id = $_POST['quotation_id'];

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
        <center> <h1>Appointment List</h1></center>
       
      </div>
    </div><!-- /.container-fluid -->
  </section>
	<section style="overflow-x: auto;">
<?php
$i = 1;
$sql = "SELECT * FROM job_appointment AS a LEFT JOIN quotation AS b ON a.quotation_id = b.id WHERE b.state != 'Completed' AND b.center_id = '".$_SESSION['center_id']."' ORDER BY a.date;";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res)) {
	$sql1 = "SELECT * FROM customers WHERE id = '".$row['customer_id']."';";
	$res1 = mysqli_query($conn, $sql1);
	$myrow = mysqli_fetch_assoc($res1);?>
		<button type="button" class="collapsible" style="margin: 5px 0; padding: 20px 5px; width: 100%;">
			<table style="table-layout: fixed; width: 100%; border-collapse: collapse;">
				<tbody>
					<tr>
						<td>No. <?php echo $i++;?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Date: <?php echo $row['date'];?></td>
					</tr>
					<tr>
						<td>Name: </td>
						<td><?php echo $myrow['name'];?></td>
						<td></td>
						<td></td>
						<td></td>
						<td>State: <?php echo $row['state'];?></td>
					</tr>
					<tr>
						<td>Phone: </td>
						<td><?php echo $myrow['telephone_1'];?></td>
						<td></td>
						<td>Gender: </td>
						<td><?php if ($myrow['gender'] == 'M') { echo "Male"; } elseif ($myrow['gender'] == 'F') { echo "Female"; }?></td>
						<td></td>
					</tr>
					<tr>
						<td>Address: </td>
						<td colspan="3"><?php echo $myrow['address_1'];?></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="6"></td>
					</tr>
					<tr>
						<td>How To Know: </td>
						<td><?php echo $myrow['how_to_know'];?></td>
						<td></td>
						<td>Remark: </td>
						<td><?php echo $myrow['remark'];?></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</button>
		<div class="content" style="overflow-x:auto;">
			<table cellspacing="0" cellpadding="2" border="1" class="table table-striped table-bordered" style="background-color: #F7F7F7;">
		    <caption class="menu-header">Order Number <?php echo $row['quotation_id'];?></caption>
		    <thead>
	        <tr style="text-align: center;">
            <th>&nbsp;</th>
            <th>No</th>
            <th>Product</th>
            <th>Details</th>
            <th>Quantity</th>
            <th>Total Amount</th>
            <th>&nbsp;</th>
	        </tr>
		    </thead>
		    <tbody>
<?php
$j = 1;
$sql = "SELECT * FROM quotation_details WHERE quotation_id = '".$row['quotation_id']."';";
$res5 = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res5)) {
	$sql = "SELECT * FROM product_list WHERE id = '".$myrow['product_id']."';";
	$res1 = mysqli_query($conn, $sql);
	$myrow1 = mysqli_fetch_assoc($res1);

	$sql = "SELECT * FROM track_list WHERE id = '".$myrow['track_id']."';";
	$res2 = mysqli_query($conn, $sql);
	$myrow2 = mysqli_fetch_assoc($res2);

	$sql = "SELECT * FROM design_list WHERE id = '".$myrow['design_id']."';";
	$res3 = mysqli_query($conn, $sql);
	$myrow3 = mysqli_fetch_assoc($res3);

	$total += $myrow['price'];
	$quantity += $myrow['quantity'];
?>
					<tr style="text-align: left;">
						<td></td>
						<td style="text-align: center;"><?php echo $j++;?></td>
						<td><?php echo $myrow1['product'];?></td>
						<td>
							<?php echo "Width: ".$myrow['width']."<br>Height: ".$myrow['height'];
							if ($myrow['track_id'] != 0 && $myrow['design_id'] != 0) {
								echo "<br>Fabric Size: ".$myrow['fabric_size'];
							}
							?>
						</td>
						<td>
							<?php
							if ($myrow['track_id'] != 0 && $myrow['design_id'] != 0) {
								echo $myrow2['name']."<br>".$myrow3['name'];
							} else {
								if ($myrow['install'] != 0) {
									echo "Installation ".$myrow['install_quantity']." Set";
								} else {
									echo "No Installation";
								}
							}
							?>
						</td>
						<td style="text-align: center;"><?php echo $myrow['quantity'];?></td>
						<td style="text-align: right;"><?php printf("RM%0.2f", $myrow['price']);?></td>
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
				<tr style="text-align: center;">
					<td colspan="8">
						<form>
							<input name="complete" type="submit" class="btn btn-success" onclick="return confirm('Are you sure?')" value="Complete Order">
							<input type="hidden" name="quotation_id" value="<?php echo $row['quotation_id'];?>">
						</form>
					</td>
				</tr>
		    </tbody>
		  </table>
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
.collapsible {
  background-color: #038603;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}
.content {
	max-height: 0;
	background-color: #777;
}
</style>
<script>
	var coll = document.getElementsByClassName("collapsible");
	var i;

	for (i = 0; i < coll.length; i++) {
		coll[i].addEventListener("click", function() {
			this.classList.toggle("active1");
			var content = this.nextElementSibling;
			if (content.style.maxHeight){
				content.style.maxHeight = null;
			} else {
				content.style.maxHeight = content.scrollHeight + "px";
			}
		});
	}
</script>