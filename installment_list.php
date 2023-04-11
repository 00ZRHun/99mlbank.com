<?php 
include('header.php');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Installment List</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}?>
	<a href="<?php echo $previous;?>" class="btn btn-info">Back</a>
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
    	<div class="container">
        	<div class="row" style="overflow-x: auto;">
                <table cellspacing="0" cellpadding="2" class="table table-striped table-bordered" style="width: 100%; text-align: center;">
                    <caption class="menu-header">Installment List</caption>
                    <thead>
                        <tr class="customer_table">
                            <th>No.</th>
                            <th>Installment ID</th>
                            <th>Branch</th>
                            <th>Application Date</th>
                            <th>Customer</th>
                            <th>Loan Amount</th>
                            <th>Payment Due Date</th>
                            <th>Installment Amount</th>
                            <th>Lates Charges</th>
                            <th>Payment Made</th>
                            <th>Payment Amount</th>
                            <th>Loan Remark</th>
                            <th>Loan Status</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
$i = 1;
$sql = "SELECT a.*, b.name FROM installment AS a LEFT JOIN customers AS b ON a.user = b.id WHERE a.center = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                    	<tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $myrow['id'];?></td>
                            <td><?php echo $myrow['branch'];?></td>
                            <td><?php echo $myrow['application_date'];?></td>
                            <td><?php echo $myrow['name'];?></td>
                            <td><?php echo $myrow['loan_amount'];?></td>
                            <td><?php echo $myrow['payment_due_date'];?></td>
                            <td><?php echo $myrow['installment_amount'];?></td>
                            <td><?php echo $myrow['lates_charge'];?></td>
                            <td><?php echo $myrow['payment_made'];?></td>
                            <td><?php echo $myrow['payment_amount'];?></td>
                            <td><?php echo $myrow['loan_remark'];?></td>
                            <td><?php echo $myrow['loan_status'];?></td>
                            <td><?php echo $myrow['status'];?></td>
                            <td></td>
                    	</tr>
<?php }?>
                        <tr style="font-weight: bold;">
                            <td colspan="7" style="text-align: right;">Total</td>
                            <td style="text-align: right;"><?php printf("%.2f", "0");?></td>
                            <td style="text-align: right;"><?php printf("%.2f", "0");?></td>
                            <td style="text-align: right;"><?php printf("%.2f", "0");?></td>
                            <td>0</td>
                            <td colspan="4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <br/>
        
	        <div class="container">
	        	<form id="form1" name="form1" method="post">
	                <p align="center">
	                  <label>
	                  <input name="AddCard" type="submit" class="btn btn-success" id="AddCard" value="Create New">
	                  </label>
	                </p>
	            </form>
	        </div>
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