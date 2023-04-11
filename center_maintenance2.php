<?php 
include('header.php');

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Center Maintenance</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php
if(isset($_POST['confirm_center_create']))
{
	$c_name = $_POST['c_name'];
	$center_address1= $_POST['center_address1'];
	$center_address2 = $_POST['center_address2'];
	$center_address3 = $_POST['center_address3'];
	$center_address4 = $_POST['center_address4'];
	$center_telephone1 = $_POST['center_telephone1'];
	$center_telephone2 = $_POST['center_telephone2'];
	$center_fax = $_POST['center_fax'];
	$show_sequence = $_POST['show_sequence'];
	
	$sql = "INSERT INTO center_detail (center_name,address_1,address_2,address_3,address_4,telephone_1,telephone_2,fax,show_sequence) VALUES('$c_name','$center_address1','$center_address2','$center_address3','$center_address4','$center_telephone1','$center_telephone2','$center_fax','$show_sequence')";
	if(mysqli_query($conn,$sql))
	{
		$success = "Center added successfully";
	?>
	<script>
    location.replace('<?php echo SITEURL."/center_maintenance.php?success=".$success; ?>');
    </script>
	<?php
	}
}
elseif(isset($_POST['cmdNewcreate']))
{	
	$c_name = $_POST['c_name'];
	$center_address1= $_POST['center_address1'];
	$center_address2 = $_POST['center_address2'];
	$center_address3 = $_POST['center_address3'];
	$center_address4 = $_POST['center_address4'];
	$center_telephone1 = $_POST['center_telephone1'];
	$center_telephone2 = $_POST['center_telephone2'];
	$center_fax = $_POST['center_fax'];
	$show_sequence = $_POST['show_sequence'];
	
	if (!is_numeric($show_sequence)) 
	{
		$error = "This must be number.";
	?>
	<script>
    	location.replace('<?php echo SITEURL."/center_maintenance.php?error=".$error; ?>');
    </script>
	<?php
	}
	if(isset($_POST['edit_center_id']))
	{
		$sql = "UPDATE center_detail SET center_name='$c_name',address_1='$center_address1',address_2='$center_address2',address_3='$center_address3',address_4='$center_address4',telephone_1='$center_telephone1',telephone_2='$center_telephone2',fax='$center_fax',show_sequence='$show_sequence' WHERE id =".$_POST['edit_center_id'];
		if(mysqli_query($conn,$sql))
		{
			$success = "Center update successfully";
		?>
		<script>
		location.replace('<?php echo SITEURL."/center_maintenance.php?success=".$success; ?>');
		</script>
		<?php
		}
	}
?>
<section>
	<div class="conatiner">
    	<form id="form1" name="form1" method="post">
    		<div class="row form-group">
            	<div class="col-md-2"></div>
                <div class="col-md-2">
                	<label>Center ID</label>
                </div>
                <div class="col-md-6">
                	<span style="color:red;">Auto Generate</span>
                </div>
                <div class="col-md-2"></div>
            </div>
            <br/>
            <div class="row form-group">
            	<div class="col-md-2"></div>
                <div class="col-md-2">
                	<label>Name</label>
                </div>
                <div class="col-md-6">
                	<input name="c_name" type="hidden" class="form-control" id="c_name" value="<?php echo $c_name; ?>">
                    <span><?php echo $c_name;?></span>
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
                    <div>
                        <span class="span_hwe">1.</span>
                         <span><?php echo $center_address1;?></span>
                        <input type="hidden" name="center_address1" class="form-control width_hwe" value="<?php echo $center_address1; ?>"/><br/>
                    </div>
                    <br/>
                    <div>
                        <span class="span_hwe">2.</span>
                        <span><?php echo $center_address2;?></span>
                        <input type="hidden" name="center_address2" class="form-control width_hwe" value="<?php echo $center_address2; ?>"/><br/>
                    </div>
                    <br/>
                    <div>
                        <span class="span_hwe">3.</span>
                        <span><?php echo $center_address3;?></span>
                        <input type="hidden" name="center_address3" class="form-control width_hwe" value="<?php echo $center_address3; ?>"/><br/>
                    </div><br/>
                    <div>
                        <span class="span_hwe">4.</span>
                        <span><?php echo $center_address4;?></span>
                        <input type="hidden" name="center_address4" class="form-control width_hwe" value="<?php echo $center_address4; ?>"/><br/>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <br/>
            <div class="row form-group">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <label for="customer_telephone">Telephone</label>
                </div>
                <div class="col-md-6">
                    <div>
                        <span class="span_hwe">1.</span>
                        <span><?php echo $center_telephone1;?></span>
                       	<input type="hidden" name="center_telephone1" class="form-control width_hwe" value="<?php echo $center_telephone1; ?>"/><br/>
                    </div>
                    <br/>
                    <div>
                        <span class="span_hwe">2.</span>
                        <span><?php echo $center_fax;?></span>
                        <input type="hidden" name="center_telephone2" class="form-control width_hwe" value="<?php echo $center_telephone2; ?>"/><br/>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <br/>
            <div class="row form-group">
            	<div class="col-md-2"></div>
                <div class="col-md-2">
                	<label>Fax</label>
                </div>
                <div class="col-md-6">
                 	<span><?php echo $center_fax;?></span>
                	<input name="center_fax" class="form-control" type="hidden" id="center_fax" value="<?php echo $center_fax; ?>">
                </div>
                <div class="col-md-2"></div>
            </div>
            <br/>
            <div class="row form-group">
            	<div class="col-md-2"></div>
                <div class="col-md-2">
                	<label>Show Sequence</label>
                </div>
                <div class="col-md-6">
                	 <span><?php echo $show_sequence;?></span>
                	<input name="show_sequence" class="form-control" type="hidden" id="show_sequence" value="<?php echo $show_sequence; ?>">
                </div>
                <div class="col-md-2"></div>
            </div>
            <br/>
            <div class="row form-group">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                    <input name="confirm_center_create" type="submit" class="btn btn-success" id="confirm_center_create" value="Create">
                </div>
                <div class="col-md-2"></div>
            </div>
    	</form>
    </div>
</section>
<?php
}
?>
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
	height: 42px;
	padding-top: 6px !important;
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