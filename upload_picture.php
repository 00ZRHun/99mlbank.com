<?php
include('header.php');
$success = $update_image = '';
$picfor = $_REQUEST['picfor'];
$cust_id = $_REQUEST['cust_id'];

$query = "SELECT * FROM customers WHERE id = $cust_id";
$result = mysqli_query($conn, $query);
if($result->num_rows > 0)
{
	$row = $result->fetch_assoc();
	$customer_pic = $row['customer_pic'];
	$customer_pic_ic = $row['customer_pic_ic'];
	$customer_guarantor = $row['customer_guarantor_pic'];	
}

if(isset($_POST['upload_image']))
{
	$image=$_FILES['file']['name'];
	
	$dir="customer_pictures";
	if(!is_dir($dir))
	{
		mkdir($dir,0777);
		
	}
	if(!empty($image))
	{
		move_uploaded_file($_FILES['file']['tmp_name'],$dir.'/'.$image);	
		
	}
	if($picfor == 'customer_pic')
	{
		$update_image = "UPDATE customers SET customer_pic = '$image' WHERE id = $cust_id";
	}
	if($picfor == 'customer_ic')
	{
		$update_image = "UPDATE customers SET customer_pic_ic = '$image' WHERE id = $cust_id";
	}
	if($picfor == 'customer_Guarantor')
	{
		$update_image = "UPDATE customers SET customer_guarantor_pic = '$image' WHERE id = $cust_id";
	}
	if (mysqli_query($conn, $update_image)) {
		$success = "Image Uploaded successfully.";
		
	?>
    <script>
	
    	location.replace('<?php echo SITEURL."/customer_card.php?t_cust_id=".$cust_id."&amp;Submit=1";?>');
    </script>
	<?php
	} 
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Upload Picture</h1></center>
         
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
                <div class="col-md-6" style="color:#093">
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
        	<div class="row">
            	<div class="col-md-3"></div>
                <div class="col-md-6">
                	<form method="post" enctype="multipart/form-data">
                    	<div class="row">
                            <div class="col-md-6">
                            	<?php 
									if(isset($picfor) && $picfor == "customer_pic")
									{
								?>
                                <label for="image"> Customer Picture</label>
								<?php	
									}
									elseif(isset($picfor) && $picfor == "customer_ic")
									{
								?>
                                <label for="image"> Customer IC Picture</label>
								<?php		
									}
									elseif(isset($picfor) && $picfor == "customer_Guarantor")
									{
								?>
                                <label for="image"> Customer Guarantor Picture</label>
                                <?php	
									}
								?>
                            </div>
                            <div class="col-md-6">
                                <input type="file" name="file" value=""/>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-md-6"></div>
                            <div class="col-md-6">
                              	<input type="submit" name="upload_image" value="Upload Image" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
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
	font-family: Arial, Helvetica, sans-serif;
	font-size: medium;
	font-weight: bold;
	color: #000000;
	background-color: #A7B5CE;
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
    color: #000000;
    background-color: #A7B5CE;
    border-top-style: none;
    border-right-style: none;
    border-bottom-style: none;
    border-left-style: none;
}
.customer_info td
{
	padding:0px !important;	
}
.SpecialHeader {
    color: #0000FF;
}
</style>