<?php 
include('header.php');

$create_users_table = "CREATE TABLE IF NOT EXISTS ".$table_prefix."users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL,
	user_name VARCHAR(255) NOT NULL,
	group_name VARCHAR(255),
	center_id VARCHAR(255),
	password VARCHAR(255)
)";

if (mysqli_query($conn, $create_users_table)) {
  
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>User Management</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php 
$user_id = $user_name = $group_name = $center_id='';	
if(isset($_POST['cmdNew']) || (isset($_REQUEST['uid']) && isset($_REQUEST['cmdEdit'])))
{
	$select_user = "SELECT * FROM ".$table_prefix."users WHERE id = ".$_REQUEST['uid'];
	$result = mysqli_query($conn,$select_user);
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc()){
			$user_id = $row['user_id'];
			$user_name = $row['user_name'];
			$group_name = $row['group_name'];
			$center_id = $row['center_id'];
			$password_t = $row['password'];			
		}
	}	
?>
    <section>
    	<div class="container">
            <form id="form1" name="form1" method="post" action="user_maintenance2.php">
            	<input type="hidden" name="edit_user_id" value="<?php echo $_REQUEST['uid'];?>"/>
            	<div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Company ID</label>
                    </div>
                    <div class="col-md-6">
                        <input name="t_user_id" type="text" id="t_user_id" class="form-control" value="<?php echo $_SESSION['company_id'];?>" disabled>
                        <input name="t_user_id" type="hidden" id="t_user_id" class="form-control" value="<?php echo $_SESSION['company_id'];?>">
                    </div>
                    <div class="col-md-2"></div>
                </div> 
                <br/>   
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Login ID</label>
                    </div>
                    <div class="col-md-6">
                    	<input name="t_user_name" type="text" class="form-control" id="t_user_name" value="<?php echo $user_name;?>">
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
                    	<input name="t_password" type="password" class="form-control" id="t_password" value="<?php echo $password_t;?>">
                    </div>
                    <div class="col-md-2"></div>
                </div> 
                <br/>   
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Permissions</label>
                    </div>
                    <div class="col-md-6">
                    	<select name="t_group" id="t_group" class="form-control" style="width:50%">
                            <option value="" <?php if($group_name==''){ echo 'selected="selected"';}?>>--Select Group--</option>
                            <option value="admin" <?php if($group_name=='admin'){ echo 'selected="selected"';}?>>Admin</option>
                            <option value="center" <?php if($group_name=='center'){ echo 'selected="selected"';}?>>Center</option>
                        </select> 
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
                    	<select name="t_center_id" class="form-control" style="width:50%">
                    	<?php 
						$current_user_center= '';
						if($_SESSION["group_name"]!='superadmin')
						{
							$current_user_center = "WHERE id = ".$_SESSION["center_id"];
						}
							$select_center_deatil = "SELECT * FROM ".$table_prefix."center_detail ".$current_user_center." ORDER BY show_sequence ASC";
							$result = mysqli_query($conn,$select_center_deatil);
							if($result->num_rows > 0)
							{
								//$count=0;
								
								while($row = $result->fetch_assoc()){
										
						?>
                        <option value="<?php echo $row['id'];?>" <?php if($center_id==$row['id']){ echo 'selected="selected"';}?>><?php echo $row['center_name'];?></option>                            
                        <?php }}?>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div> 
                <br/>  
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                    	
                    	<input name="Newuser" class="btn btn-success" type="submit" id="Newuser" value="<?php if(isset($_REQUEST['uid'])){?>Update<?php }else {?>Create<?php }?>">&nbsp;&nbsp; <input type="reset" class="btn btn-success" name="Submit2" value="Reset">
                       
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>    
            </form>
        </div>
    </section>
<?php
}
else
{
	if(isset($_REQUEST['success']))
	{
	?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6" style="color: green;font-size: 26px;">
					<?php echo $_REQUEST['success'];?>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
	</section>
	<br/>
	<?php
	}
	?>
    <section style="overflow-x: auto;">
    	<table cellspacing="0" cellpadding="2" border="1" class="table table-striped table-bordered" >
        <caption class="menu-header">
          User Information
        </caption>
        <thead>
            <tr style="text-align: center;">
                <th>&nbsp;</th>
                <th><strong>No.</strong></th>
                <th><strong>Company Name</strong></th>
                <th><strong>Company ID</strong></th>
                <th><strong>Login ID</strong></th>
                <th><strong>User Permissions</strong></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        
        <tbody>
        	<?php 
			$current_user_center= '';
			if($_SESSION["group_name"]!='superadmin')
			{
				$current_user_center = " WHERE center_id = ".$_SESSION["center_id"];
			}
				$select_user = "SELECT * FROM ".$table_prefix."users".$current_user_center;
				$result = mysqli_query($conn,$select_user);
					if($result->num_rows > 0)
					{
						$count=0;
						while($row = $result->fetch_assoc()){
							
							$select_center_name = "SELECT center_name FROM ".$table_prefix."center_detail WHERE ID = ".$row['center_id'];
							$center='';
							$res = mysqli_query($conn,$select_center_name);
							if($res->num_rows > 0)
							{
								$center = $res->fetch_assoc();
							}						
			?>
            <tr style="text-align: center;">
                <td>
                	<a href="user_maintenance.php?uid=<?php echo $row['id'];?>&amp;cmdEdit=Edit" class="btn btn-success">Edit</a>
                </td>
                <td><?php echo ++$count; ?></td>
                <td><?php echo $center['center_name'];?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['group_name']; ?></td>
                <td>
                	<!--<form id="form2" name="form2" method="post" action="change_password.php">
                    	<input type="hidden" name="user_id_pass" value="<?php echo $row['id'];?>"/>									
                    	<input type="submit" name="change_password" class="btn btn-success" value="Password">
                        <input name="uid" type="hidden" id="uid" value="B">
                    </form> -->  
                    <a href="change_password.php?id=<?php echo $row['id'];?>" class="btn btn-success">Change Password</a>
                </td>
            </tr>
            <?php }}?>
        
            
        <tr>
            <td colspan="7" class="ErrMsg">
                <div align="center">
                    <form id="form1" name="form1" method="post" action="user_maintenance.php">
                        <input name="cmdNew" type="submit" class="btn btn-success" id="cmdNew" value="New User">
                    </form>
                </div>
            </td>
        </tr>
        </tbody>
        </table>
    </section>
<?php }?>
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