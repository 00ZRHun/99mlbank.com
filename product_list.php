<?php
include('header.php');

$search = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['AddCard'])) {
	    echo "<script>window.location = 'add_product.php';</script>";
	} elseif ($_POST['search']) {
		$search = true;
		$searchText = $_POST['searchText'];
	}
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Product List</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}?>
	<a href="dashboard.php" class="btn btn-info">Back</a>
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
	<form method="post">
		<label>Product：</label>
		<input type="text" name="searchText" <?php if ($search != false) { echo 'value="'.$searchText.'"';} ?>>
		<br>
		<input type="submit" name="search" class="btn btn-success" value="Search">
	</form>
	<section>
    	<div class="container" style="overflow-x: auto;">
        	<table cellspacing="0" cellpadding="2" align="center" class="table table-bordered table-striped">
        		<caption class="menu-header">
        			Product List
                </caption>
                <thead>
                	<tr style="text-align: center;">
	                    <th>&nbsp;</th>
	                    <th>No</th>
	                    <th style="text-align: left;">Product</th>
	                    <th>Type</th>
	                    <th style="text-align: right;">Unit Price</th>
	                    <th>&nbsp;</th>
	                </tr>
	            </thead>
	            <tbody>
<?php
if ($search != false) {
	$sql = "SELECT * FROM product_list WHERE center_id = '".$_SESSION['center_id']."' AND product LIKE '%".$searchText."%' ORDER BY product ASC;";
} else {
	$sql = "SELECT * FROM product_list WHERE center_id = '".$_SESSION['center_id']."' ORDER BY product ASC;";
}
$res = mysqli_query($conn, $sql);
$i = 0;
while ($myrow = mysqli_fetch_assoc($res)) {
	$i++;?>
					<tr style="text-align: center;">
						<td></td>
						<td><?php echo $i;?></td>
						<td style="text-align: left;"><?php echo $myrow['product'];?></td>
						<td><?php echo $myrow['type'];?></td>
						<td style="text-align: right;"><?php printf("RM%0.2f", $myrow['price']);?></td>
						<td></td>
					</tr>
<?php }?>
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
                  <input name="AddCard" type="submit" class="btn btn-success" id="AddCard" value="Add New Product">
                  </label>
                  <input name="t_cust_id" type="hidden" id="t_cust_id" value="<?php echo $_REQUEST['t_cust_id'];?>">
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