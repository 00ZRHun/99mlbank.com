<?php
session_start();
require_once('config.php');
$sql = "CREATE TABLE IF NOT EXISTS ".$table_prefix."recently_login
	(
	id int(11) NOT NULL AUTO_INCREMENT,
	user_id int(11) ,
	date varchar(100),
	PRIMARY KEY (id)
	)";
	
	if(mysqli_query($conn, $sql)){
			//echo "Table created successfully.";
		}
	 else{
			//echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		}


//include('auth.php');
$error_msg = '';

if(isset($_POST['submit']))
{
	$companyid = $_POST['companyid'];
	$user_id = $_POST['user_id'];
	$Password = $_POST['Password'];

if($domain_status==1){

	if(empty($companyid))
	{
		$get_admin_data = mysqli_query($conn,"SELECT * FROM administration where name = '$user_id' AND password = '$Password'");
		
		if(mysqli_num_rows($get_admin_data) > 0)
		{
			$rowadmin = mysqli_fetch_assoc($get_admin_data);
			$_SESSION["group_name"] = 'superadmin';
			$_SESSION["user_id"] = $rowadmin['id'];
			
			$sql_hwe = "select * from ".$table_prefix."recently_login order by date desc LIMIT 0,1";

				$results_hwe = mysqli_query($conn,$sql_hwe);

				if(mysqli_num_rows($results_hwe) > 0) {
					$row_login = mysqli_fetch_assoc($results_hwe);
					 $_SESSION['last_login']= $row_login['user_id'];
					
				}

			?>
			
			<script>
			window.location.replace("<?php echo SITEURL?>/dashboard.php");
			</script>
		<?php
		}
		else
		{
			$error_msg = 'Login Credential Incorrect.';
		}
	}
	else
	{
	
		/*$sql1="SELECT id from center_detail where center_name = '$companyid'";
		
		$result1 = mysqli_query($conn,$sql1);
		$center_id =0;
		if(mysqli_num_rows($result1) > 0)
		{
			$row = mysqli_fetch_assoc($result1);
			
			$center_id = $row['id'];
		}*/
			
		
		//$sql= "SELECT * FROM users WHERE user_id = '$user_id' AND Password = '$Password' AND center_id = '$center_id' ";
		$sql= "SELECT * FROM ".$table_prefix."users WHERE user_id = '$companyid' AND password = '$Password' AND user_name = '$user_id' ";
		// echo $sql;
		// die('gffghjfgf');
		$result = mysqli_query($conn,$sql);
		// print_r($result);
		if($result->num_rows>0)
		{
			$row123 = mysqli_fetch_assoc($result);
			// print_r($row123);
			// die;
			$_SESSION["company_id"] = $companyid;
			$_SESSION["center_id"] = $row123['center_id'];
			$_SESSION["group_name"] = $row123['group_name'];
			$_SESSION["user_id"] = $row123['user_id'];
			//$_SESSION["agent_id"] = $row123['id'];
			$user_id_table = $_SESSION["agent_id"] = $row123['id'];
			$current_time = time();
			
			// insert update 
			$query_hwe = "SELECT * FROM ".$table_prefix."recently_login where user_id=".$user_id_table;
			
				$result_hwe1 = mysqli_query($conn, $query_hwe);
				
			if(mysqli_num_rows($result_hwe1) > 0) {
				$sql ="UPDATE ".$table_prefix."recently_login SET date='$current_time' WHERE user_id = $user_id_table";
			}
			else{
				$sql = "INSERT INTO ".$table_prefix."recently_login (user_id, date)
				VALUES ('$user_id_table', '$current_time')";
			}
			if ($conn->query($sql) === TRUE) {
			  //echo "New record created successfully";
			} else {
			 // echo "Error: " . $sql . "<br>" . $conn->error;
			}
			//$_SESSION["user_id"] = $user_id;
			?>
			
			<script>
			//window.location.replace("http://readyforyourreview.com/Loan_software/dashboard.php");
			window.location.replace("<?php echo SITEURL?>/dashboard.php");
			</script>
		<?php
		}
		else
		{
			$error_msg = 'Login Credential Incorrect.';
		}
	}
}
else {
	$error_msg = 'Your Domain Status Inactive, Try Again.';
}
//$check = mysqli_fetch_array($result);

}
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</head>

<body style="background-color:#4e73df;">


<center style="margin-top:38px;">

<div class="card" style="width:22rem;">
  <div class="card-body" style="font-size: 18px;color: red;"><?php echo $error_msg;?></div>
<div class="card-body">
<form method="POST">
<div class="form-group">
  <input type="text" class="form-control" placeholder="Company Id" name="companyid" style="border-radius: 10rem;padding:1.0rem 1rem;width:260px;"><br>
  <input type="text" class="form-control" placeholder="Login Id" name="user_id" style="border-radius: 10rem;padding:1.0rem 1rem;width:260px;"><br>
 <input type="password" class="form-control" placeholder="Password" name="Password" style="border-radius: 10rem;padding:1.0rem 1rem;width:260px;"><br>
<input type="submit" class="form-control" placeholder="login" name="submit" style="border-radius:10rem;width:260px;background-color:#4e73df;text-align:center;color: #fff !important;" value="Login"><br>
<input type="reset" class="form-control" placeholder="reset" name="reset" style="border-radius:10rem;width:260px;background-color:#4e73df;text-align:center;color: #fff !important;" value="Reset"> 

 </div>
</form>
	

  </div>
</div>

</center>


</body>
</html>