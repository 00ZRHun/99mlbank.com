<?php 
include('header.php');
$error = $success ='';
if(isset($_REQUEST['id']))
{
	$user_id = $_REQUEST['id'];
	
	$sql = "SELECT * FROM users WHERE id = ".$user_id;
	$result = mysqli_query($conn,$sql);
	//$row = '';
	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
	}
}

if(isset($_POST['change_password']))
{
	$current_password = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];
	
	
	if($row['password'] == '')
	{
		if($new_password != $confirm_password)
		{
			$error = "Confirm password is not same with new password";
		}
		else
		{
			$sql12 = "UPDATE users SET password = '".$new_password."' WHERE id = ".$user_id;
			if(mysqli_query($conn,$sql12))
			{
				$success = "Password updated succesfully.";
			}
		}
	}
	elseif($row['password'] != $current_password)
	{
		$error1 = "Current password is not same with existing password.";
	}
	else
	{
		$sql12 = "UPDATE users SET password = '".$new_password."' WHERE id = ".$user_id;
		if(mysqli_query($conn,$sql12))
		{
			$success = "Password updated succesfully.";
		}
	}
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Change Password</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
	if(isset($success) && !empty($success))
	{
	?>
    <section>
    	<div class="container">
        	<div class="row">
            	<div class="col-md-3"></div>
                <div class="col-md-6" style="color: green;font-size: 22px;">
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
    	<form id="form1" name="form1" method="post">
        <div class="row">
        	<div class="col-md-4"></div>
            <div class="col-md-4 heading_title">Change User Password</div>
            <div class="col-md-4"></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <label for="customer_id">User ID</label>
            </div>
            <div class="col-md-6">
                <span class="span_hwe"><?php echo $row['user_id'];?></span>
            </div>
            <div class="col-md-2"></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <label for="customer_id">Name</label>
            </div>
            <div class="col-md-6">
                <span class="span_hwe"><?php echo $row['user_name'];?></span>
            </div>
            <div class="col-md-2"></div>
        </div>
        <br/>
        <div class="row form-group">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <label for="customer_id">Current Password</label>
            </div>
            <div class="col-md-6">
                <input type="password" name="current_password" value="" class="form-control"/>
                 <?php  
				if(isset($error1) && !empty($error1))
				{
				?>
                <span style="color:red;" id="error">
                	<?php echo $error1; ?>
                </span>
               	<?php }?>  
            </div>
            <div class="col-md-2"></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <label for="customer_id">New Password</label>
            </div>
            <div class="col-md-6">
                <input type="password" name="new_password" value="" id="new_password" class="form-control"/>
            </div>
            <div class="col-md-2"></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <label for="customer_id">Confirm Password</label>
            </div>
            <div class="col-md-6">
                <input type="password" name="confirm_password" id="confirm_password" value="" class="form-control"/>
                <?php  
				if(isset($error) && !empty($error))
				{
				?>
                <span style="color:red;" id="error">
                	<?php echo $error; ?>
                </span>
               	<?php }?>        
            </div>
            <div class="col-md-2"></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <input type="submit" id="change_password" name="change_password" value="Change Password" class="btn btn-success"/>
            </div>
            <div class="col-md-2"></div>
        </div>
        <br/>
        
          <!--<table cellspacing="2" cellpadding="2" border="0" align="center">
            <tbody><tr>
              <td colspan="2" class="SubMenuCaption"><div align="center">Change User Password </div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="ErrMsg"></td>
            </tr>
            <tr>
              <td><p>User ID </p>      </td>
              <td><input name="t_user_id" type="hidden" id="t_user_id" value="Ck" size="50" maxlength="100">Ck</td>
            </tr>
            <tr>
              <td>Name</td>
              <td><label>
                <input name="t_user_name" type="hidden" id="t_user_name" value="Soon" size="50" maxlength="100">Soon
              </label></td>
            </tr>
            
        
            <tr>
              <td>Current Password </td>
              <td><input name="txtCurPass" type="password" id="txtCurPass" size="20" maxlength="15">
                <span class="ErrMsg"></span></td>
            </tr>
            <tr>
              <td>New Password </td>
              <td><input name="txtNewPass" type="password" id="txtNewPass" size="20" maxlength="15">
                <span class="ErrMsg"></span></td>
            </tr>
            <tr>
              <td>Confirm Password </td>
              <td><input name="txtConPass" type="password" id="txtConPass" size="20" maxlength="15">
                <span class="ErrMsg"></span></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><div align="center">
                <input name="cmdPass" type="submit" id="cmdPass" value="Change Password">
              </div>
             </td>
            </tr>
          </tbody></table>-->
        </form>
    </section>
</div>
<style>
body
{
	color:#000;
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
.heading_title
{
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
.btn-success
{
	background:#038603 !important;
}
</style>
<script>
/*$("#change_password").on("click",function(){
	var new_password = $("#new_password").val();
	var confirm_password = $("#confirm_password").val();
	if(new_password != confirm_password)
	{
		$("#error").text("Confirm password not same.");
	}
	else
	{
		$("#form1").submit();
	}
	
});*/
</script>