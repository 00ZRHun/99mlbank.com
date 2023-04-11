<?php 
include('header.php');

$success = $customer_id = $customer_name = $customer_ic = $customer_address1 = $customer_address2 = $customer_address3 = $customer_address4 = $customer_Occupation = $customer_telephone1 = $customer_telephone2 = $customer_fax = $t_gender = $customer_guaranty_name = $customer_guaranty_ic_passport = $customer_guaranty_telephone = $customer_guaranty_info = '';

if(isset($_REQUEST['cust']))
{
	$id = $_REQUEST['cust'];
	$query = "SELECT * FROM customers where id = $id";
	$result = mysqli_query($conn, $query);
	
	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc() ;
		$customer_id = $row['id'];
		$customer_name = $row['name'];
		$customer_address1 = $row['address_1'];
		$customer_telephone1 = $row['telephone_1'];
		$t_gender = $row['gender'];
        $how_to_know = $row['how_to_know'];
        $remark = $row['remark'];
	}
}

if(isset($_POST['create']))
{
	$agent_id = $_SESSION["agent_id"];
	
	$customer_name = mysqli_real_escape_string($conn,$_POST['customer_name']);
	$customer_address1 = mysqli_real_escape_string($conn,$_POST['customer_address1']);
	$customer_telephone1 = $_POST['customer_telephone1'];
	$t_gender = $_POST['t_gender'];	
    $how_to_know = $_POST['how_to_know'];
    $remark = $_POST['remark'];
	
	if(isset($_POST['customer_edit_id']) && $_POST['customer_edit_id']!='')
	{
			
		$sql = "UPDATE customers SET
		 name = '$customer_name',
		 address_1 = '$customer_address1',
		 telephone_1 = '$customer_telephone1',
		 gender = '$t_gender',
         how_to_know = '$how_to_know',
         remark = '$remark',
		 created_at = '".date("Y-m-d H:i:s")."',user_agent_id = $agent_id WHERE id = ".$_POST['customer_edit_id'];	
		if (mysqli_query($conn, $sql)) {
			$success = "Customer updated successfully.";
			
		} 
	}
	else
	{
			
		$sql = "INSERT INTO customers (name,address_1,telephone_1,gender,how_to_know,remark,created_at,user_agent_id) VALUES ('$customer_name','$customer_address1','$customer_telephone1','$t_gender','$how_to_know','$remark','".date("Y-m-d H:i:s")."',$agent_id)";	
		if (mysqli_query($conn, $sql)) {
			$success = "Customer added successfully.";
		} 
	}
	$customer_id = $customer_name = $customer_ic = $customer_address1 = $customer_address2 = $customer_address3 = $customer_address4 = $customer_Occupation = $customer_telephone1 = $customer_telephone2 = $customer_fax = $t_gender = $customer_guaranty_name = $customer_guaranty_ic_passport = $customer_guaranty_telephone = $customer_guaranty_info = '';
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1><?php if(isset($customer_id) && $customer_id!=''){?>Edit Customer<?php }else{?>New Customer<?php }?></h1></center>
         
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
                <div class="col-md-6">
                	<?php echo $success;?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
   <br/>
    <?php
	}
	?> 
    <section>
    	<div class="container">
            <form method="post" id="myForm">
            	<input type="hidden" name="customer_edit_id" value="<?php echo $customer_id;?>"/>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_id">Customer ID</label>
                    </div>
                    <div class="col-md-6">
                    	<?php 
							if(isset($customer_id) && $customer_id!='')
							{
								
						?>
                        <span style="color:red;"><?php echo $customer_id; ?></span>
                        <?php
							}
							else
							{
						?>
                        <span style="color:red;">Auto Generated</span>
                        <?php }?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_name">Name</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="customer_name" class="form-control" required="required" value="<?php echo $customer_name;?>"/>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_telephone">Phone</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="customer_telephone1" required="required" class="form-control" value="<?php echo $customer_telephone1;?>"/><br/>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_address">Address</label>
                    </div>
                    <div class="col-md-6">
                        <textarea name="customer_address1" required="required" class="form-control" style="height: 100px;"><?php echo $customer_address1;?></textarea>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_gender">Gender</label>
                    </div>
                    <div class="col-md-6">
                        <select name="t_gender" class="form-control" style="width:50%;">
                            <option value="F" <?php if(isset($t_gender) && $t_gender=="F"){ echo 'selected="selected"';} ?>>F - Female</option>
                            <option value="M" <?php if(isset($t_gender) && $t_gender=="M"){ echo 'selected="selected"';} ?>>M - Male</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_guaranty_name">How to know</label>
                    </div>
                    <div class="col-md-6">
                        <select name="how_to_know" class="form-control" style="width:50%;">
                            <option value="Google" <?php if ($how_to_know == "Google") { echo "Selected"; } ?>>Google</option>
                            <option value="Facebook" <?php if ($how_to_know == "Facebook") { echo "Selected"; } ?>>Facebook</option>
                            <option value="Introduced" <?php if ($how_to_know == "Introduced") { echo "Selected"; } ?>>Introduced</option>
                            <option value="Others" <?php if ($how_to_know == "Others") { echo "Selected"; } ?>>Others</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_guaranty_ic_passpost">Remark</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="remark" class="form-control" value="<?php echo $remark;?>"/>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success" name="create"><?php if(isset($customer_id) && $customer_id!=''){?>Edit Customer<?php }else{?>Create New Customer<?php }?></button>&nbsp;&nbsp;
                        <button type="reset" class="btn btn-success" name="reset">Reset</button>
                    </div>
                    <div class="col-md-2"></div>
                </div>
        	</form>
        </div>
    </section>
    <?php
	//}
	?>
</div>
<style>
.span_hwe
{
	float:left;
	color: #000;
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
