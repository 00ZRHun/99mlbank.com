<?php 
include('header.php');

$center_detail_table = "CREATE TABLE IF NOT EXISTS ".$table_prefix."center_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    center_name VARCHAR(255) NOT NULL,
	address_1 VARCHAR(255) NOT NULL,
	address_2 VARCHAR(255),
	address_3 VARCHAR(255),
	address_4 VARCHAR(255),
	telephone_1 VARCHAR(255),
	telephone_2 VARCHAR(255),
	fax VARCHAR(255),
	show_sequence VARCHAR(255)
)";

if (mysqli_query($conn, $center_detail_table)) {
  
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
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

$center_name =$address_1 =$address_2  =	$address_3 =$address_4 =$telephone_1 =$telephone_2 =$fax =$show_sequence =''; 
if(isset($_POST['cmdNewcenter']) || isset($_REQUEST['error']) || (isset($_REQUEST['cid']) && isset($_REQUEST['cmdEdit'])))
{
	$center_id = $_REQUEST['cid'];
	$select_sql = "SELECT * FROM ".$table_prefix."center_detail WHERE id = $center_id ";
	$result = mysqli_query($conn,$select_sql);
	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$center_name =$row['center_name']; 
		$address_1 =$row['address_1']; 
		$address_2  =$row['address_2 ']; 
		$address_3 =$row['address_3']; 
		$address_4 =$row['address_4']; 
		$telephone_1 =$row['telephone_1']; 
		$telephone_2 =$row['telephone_2']; 
		$fax =$row['fax']; 
		$show_sequence =$row['show_sequence']; 
	}
	
?>
<section>
	<div class="conatiner">
    	<form id="form1" name="form1" method="post" action="center_maintenance2.php">
        	<input type="hidden" name="edit_center_id" value="<?php echo $center_id;?>"/>
    		<div class="row form-group">
            	<div class="col-md-2"></div>
                <div class="col-md-2">
                	<label>Center ID</label>
                </div>
                <div class="col-md-6">
                	<?php 
                    if(isset($center_id))
                    {
					?>
                    <span class="SpecialHeader"><?php echo $center_id;?></span>
                    <?php
                    }
					else
					{
					?>
                	<span style="color:red;">Auto Generate</span>
                    <?php }?>
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
                	<input name="c_name" type="text" required="required" class="form-control" id="c_name" value="<?php echo $center_name;?>">
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
                        <span class="span_hwe">1.</span><input type="text" name="center_address1"  required="required" class="form-control width_hwe" value="<?php echo $address_1;?>"/><br/>
                    </div>
                    <br/>
                    <div>
                        <span class="span_hwe">2.</span><input type="text" name="center_address2" class="form-control width_hwe" value="<?php echo $address_2;?>"/><br/>
                    </div>
                    <br/>
                    <div>
                        <span class="span_hwe">3.</span><input type="text" name="center_address3" class="form-control width_hwe" value="<?php echo $address_3;?>"/><br/>
                    </div><br/>
                    <div>
                        <span class="span_hwe">4.</span><input type="text" name="center_address4" class="form-control width_hwe" value="<?php echo $address_4;?>"/><br/>
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
                        <span class="span_hwe">1.</span><input type="text" name="center_telephone1"  required="required" class="form-control width_hwe" value="<?php echo $telephone_1;?>"/><br/>
                    </div>
                    <br/>
                    <div>
                        <span class="span_hwe">2.</span><input type="text" name="center_telephone2" class="form-control width_hwe" value="<?php echo $telephone_2;?>"/><br/>
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
                	<input name="center_fax" required="required"  class="form-control" type="text" id="center_fax" value="<?php echo $fax;?>">
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
                	
                	<input name="show_sequence" required="required"  class="form-control" type="text" id="show_sequence" value="<?php echo $show_sequence;?>">
                    <?php
                	if(isset($_REQUEST['error']))
                    {
                    ?>
                    <span style="color: red;font-size: 16px;">
                         <?php echo $_REQUEST['error'];?>
                    </span><br/>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-2"></div>
            </div>
            <br/>
            <div class="row form-group">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                    <input name="cmdNewcreate" type="submit" class="btn btn-success" id="cmdNewcreate" value="<?php if(isset($center_id)){?>Update<?php }else{?>Create<?php }?>">&nbsp;&nbsp;
                    <input type="reset" name="Submit2" class="btn btn-success" value="Reset">
                </div>
                <div class="col-md-2"></div>
            </div>
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
    <section>
    <form id="form1" name="form1" method="post" action="center_maintenance.php">
      <table cellspacing="0" cellpadding="2" border="1" align="center" class="table table-striped table-bordered" style="width: 100%;">
        <caption class="menu-header">
          Center's Information
        </caption>
        <thead>
        	<tr>
              <th>&nbsp;</th>
              <th>No</th>
              <th>Center ID </th>
              <th>Center Name </th>
              <th>Show Sequence </th>
              <th>&nbsp;</th>
            </tr>        
        </thead>
        <tbody>
        	<?php 
				$select_center_deatil = "SELECT * FROM ".$table_prefix."center_detail";
				$result = mysqli_query($conn,$select_center_deatil);
				if($result->num_rows > 0)
				{
					$count=0;
					while($row = $result->fetch_assoc()){	
			?>
            <tr>
                <td><a href="center_maintenance.php?cid=<?php echo $row['id'];?>&amp;cmdEdit=Edit" class="btn btn-success">Edit</a></td>
                <td><?php echo ++$count;?></td>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['center_name'];?></td>
                <td><?php echo $row['show_sequence'];?></td>
                <td>&nbsp;</td>	
            </tr>            
            <?php
				}}
			?>
        <td colspan="6"><div align="center">
          <input name="cmdNewcenter" type="submit" class="btn btn-success" id="cmdNew" value="New Center">
        </div></td>
      </tr>
      </tbody></table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </form>
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
.SpecialHeader {
    color: #0000FF;
}
.btn-success
{
	background:#038603 !important;
}
</style>