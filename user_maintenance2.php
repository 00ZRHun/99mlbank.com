<?php 
include('header.php');

if(isset($_POST['confirm_user']))
{
	$t_user_id = $_POST['t_user_id'];
	$t_user_name = $_POST['t_user_name'];
	$t_group = $_POST['t_group'];
	$t_center_id = $_POST['t_center_id'];
	$t_password = $_POST['t_password'];
	
	$insert_user = "INSERT INTO users (user_id,user_name,group_name,center_id,password) VALUES('$t_user_id','$t_user_name','$t_group','$t_center_id','$t_password')";
	if(mysqli_query($conn,$insert_user))
	{
		$success = "User added successfully.";
	?>
	<script>
    	location.replace('<?php echo SITEURL."/user_maintenance.php?success=".$success; ?>');
    </script>
	<?php
	}
}
elseif(isset($_POST['Newuser']))
{
	
	$t_user_id = $_POST['t_user_id'];
	$t_user_name = $_POST['t_user_name'];
	$t_group = $_POST['t_group'];
	$t_center_id = $_POST['t_center_id'];
	$t_password = $_POST['t_password'];
	if(isset($_POST['edit_user_id']) && !empty($_POST['edit_user_id']))
	{
		$update_user = "UPDATE users SET user_id='$t_user_id',user_name='$t_user_name',group_name='$t_group',center_id='$t_center_id',password = '$t_password' WHERE id=".$_POST['edit_user_id'];
		if(mysqli_query($conn,$update_user))
		{
			$success = "User updated successfully.";
		?>
		<script>
            location.replace('<?php echo SITEURL."/user_maintenance.php?success=".$success; ?>');
        </script>
        <?php
		}
	}
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>User Maintenance</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="conatiner">
            <form id="form1" name="form1" method="post">
                <div class="row form-group">
                    <div class="col-md-2"></div>                    
                    <div class="col-md-2">
                    	<label>User ID</label>
                    </div>
                    <div class="col-md-6">
                        <input name="t_user_id" type="hidden" class="form-control" id="t_user_id" value="<?php echo $t_user_id; ?>">
                        <span><?php echo $t_user_id;?></span>
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
                        <input name="t_user_name" type="hidden" class="form-control" id="t_user_name" value="<?php echo $t_user_name; ?>">
                        <span><?php echo $t_user_name;?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>                    
                    <div class="col-md-2">
                    	<label>Password</label>
                    </div>
                    <div class="col-md-6">
                        <input name="t_password" type="hidden" class="form-control" id="t_password" value="<?php echo $t_password; ?>">
                        <span>**********</span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>                    
                    <div class="col-md-2">
                    	<label>Group</label>
                    </div>
                    <div class="col-md-6">
                        <input name="t_group" type="hidden" class="form-control" id="t_group" value="<?php echo $t_group; ?>">
                        <span><?php echo $t_group;?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>                    
                    <div class="col-md-2">
                    	<label>Center ID</label>
                    </div>
                    <div class="col-md-6">
                        <input name="t_center_id" type="hidden" class="form-control" id="t_center_id" value="<?php echo $t_center_id; ?>">
                        <span><?php echo $t_center_id;?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <input name="confirm_user" type="submit" class="btn btn-success" id="confirm_user" value="Confirm">
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </form>
        </div>
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
    font-family: Arial, Helvetica, sans-serif;
    font-size: medium;
    font-weight: bold;
    color: #000000;
    background-color: #A7B5CE;
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