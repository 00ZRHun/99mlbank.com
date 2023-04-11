<?php
include('header.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$agent_id = $_SESSION["agent_id"];
    $center_id = $_SESSION['center_id'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $type = $_POST['type'];

    if ($type == "Blind") {
        $fabric_size = 0;
    } else {
        $fabric_size = $_POST['fabric_size'];
    }

	$sql = "INSERT INTO product_list (center_id, product, fabric_size, type, price, agent_id) VALUES ('".$center_id."', '".$product."', '".$fabric_size."', '".$type."', '".$price."', '".$agent_id."');";

	if (mysqli_query($conn, $sql)) {
	    echo "<script>alert('Added successfully.')</script>";
	    echo "<script>window.location = 'product_list.php';</script>";
	} else {
	    echo "<script>alert('An unknown problem occurred, please try again later.')</script>";
	}
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Add Product</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}?>
	<a href="product_list.php" class="btn btn-info">Back</a>
	<section>
    	<div class="container">
        	<form id="form1" name="form1" method="post">
            	<input name="t_cust_id" type="hidden" id="t_cust_id" value="<?php echo $t_cust_id; ?>" size="30" maxlength="30">
            	<!-- <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>身分證/護照</label>
                    </div>
                    <div class="col-md-6">
                    	<span class="SpecialHeader"><?php echo $new_IC; ?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>姓名</label>
                    </div>
                    <div class="col-md-6">
                    	<span class="SpecialHeader"><?php echo $name; ?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/> -->
                <!-- <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>卡 No </label>
                    </div>
                    <div class="col-md-6">
                    	<span class="ErrMsg">自動生成</span> 
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/> -->
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Product</label>
                    </div>
                    <div class="col-md-6">
                    
                    	<input name="product" type="text" required id="code" class="form-control" value="">
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Unit Price</label>
                    </div>
                    <div class="col-md-6">
                    
                        <input name="price" required class="form-control" type="text" id="f_loan_out" value="">
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Type</label>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" name="type" onchange="changeType(this.value)">
                            <option value="Curtain">Curtain</option>
                            <option value="Blind">Blind</option>
                        </select>
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
            <div id="curtain" style="display: block;">
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Fabric Size</label>
                    </div>
                    <div class="col-md-6">
                        <input name="fabric_size" class="form-control" type="text" value="0">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
            </div>





                
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                    	
                    	<input name="NewCard" class="btn btn-success" type="submit" id="NewCard" value="Add New Product">&nbsp;&nbsp;
                        <input type="reset" class="btn btn-success" name="Submit2" value="Reset">
                       
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
            </form>
        </div>
    </section>
</div>
<script>
    function changeType(input) {
        var curtain = document.getElementById("curtain");
        if (input == "Blind") {
            curtain.style.display = "none";
        } else {
            curtain.style.display = "block";
        }
    }
</script>
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