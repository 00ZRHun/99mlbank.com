<?php
include('header.php');

if (isset($_GET['c'])) {
	$loan_id = $_GET['c'];
} else {
	echo "<script>window.location = 'account88.php';</script>";
}

$sql = "SELECT * FROM customers_card WHERE id = '".$loan_id."';";
$res = mysqli_query($conn, $sql);
$myrow = mysqli_fetch_assoc($res);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $card_id = $_POST['card_id'];
    $center_id = $_POST['center_id'];
    $amount = $_POST['amount'];
    $interest = $_POST['interest'];
    $d_date_disp = strtotime($_POST['d_date_disp']);
    $days = $_POST['daycount'];
    $remark1 = $_POST['remark1'];
    $remark2 = $_POST['remark2'];
    $daycount = $_POST['daycount'];

    if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
        $sql = "INSERT INTO collection (card_id, amount, interest, center_id, d_date_disp, days, remark1, remark2) VALUES ('".$card_id."', '".$amount."', '".$interest."', '".$center_id."', '".$d_date_disp."', '".$days."', '".$remark1."', '".$remark2."');";
    } else {
        $image_data = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_type = $_FILES['image']['type'];
        $image = addslashes(fread(fopen($image_data, "r"), filesize($image_data)));
        $sql = "INSERT INTO collection (card_id, amount, interest, center_id, d_date_disp, days, remark1, remark2, image, image_name, image_size, image_type) VALUES ('".$card_id."', '".$amount."', '".$interest."', '".$center_id."', '".$d_date_disp."', '".$days."', '".$remark1."', '".$remark2."', '".$image."', '".$iamge_name."', '".$image_size."', '".$image_type."');";
    }

	if (mysqli_query($conn, $sql)) {
        if ($remark1 == "清") {
            $sql = "UPDATE customers_card SET clear_payment = '1' WHERE id = '".$loan_id."';";
            mysqli_query($conn, $sql);
        } else {
            $sql = "SELECT * FROM customers_card WHERE id = '".$loan_id."';";
            $res = mysqli_query($conn, $sql);
            $myrow = mysqli_fetch_assoc($res);
            $crossed_date = $myrow['crossed_date'];
            $new_crossed_date = date("d-m-Y", strtotime($crossed_date.' + '.$daycount.' days'));

            $sql = "UPDATE customers_card SET crossed_date = '".$new_crossed_date."' WHERE id = '".$loan_id."';";
            mysqli_query($conn, $sql);
        }

	    echo "<script>alert('Successful payment.')</script>";
	    echo "<script>window.location = 'account88.php';</script>";
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
          <center><h1><?php echo $myrow['code'];?> - Payment</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}?>
	<a href="account88.php" class="btn btn-info">Back</a>
	<section>
    	<div class="container">
        	<form id="form1" name="form1" method="post" enctype="multipart/form-data">
                <input name="center_id" type="hidden" id="t_cust_id" value="<?php echo $myrow['center_id']; ?>" size="30" maxlength="30">
                <input name="card_id" type="hidden" id="t_cust_id" value="<?php echo $myrow['id']; ?>" size="30" maxlength="30">
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Payment Date</label>
                    </div>
                    <div class="col-md-6">
                    	
                    	<input name="d_date_disp" type="date" required  id="d_startDate" class="form-control">

                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Amount</label>
                    </div>
                    <div class="col-md-6">
                    
                    	<input name="amount" type="text" id="code" class="form-control" required value="0">
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Interest</label>
                    </div>
                    <div class="col-md-6">
                    	
                    	<input name="interest" required class="form-control" type="text" id="f_profit" value="0">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Description</label>
                    </div>
                    <div class="col-md-6">
                        
                        <select name="remark1" class="form-control" style="width:50%">
                            <option value="利">利</option>
                            <option value="來利">來利</option>
                            <option value="來錢">來錢</option>
                            <option value="來期">來期</option>
                            <option value="捕魚">捕魚</option>
                            <option value="結清">結清</option>
                            <option value="談清">談清</option>
                            <option value="分期">分期</option>
                            <option value="分期清">分期清</option>
                            <option value="分天">分天</option>
                            <option value="分天清">分天清</option>
                            <option value="清">清</option>
                            <option value="罰">罰</option>
                            <option value="砍帳">砍帳</option>
                        </select>
                       
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>天期/月期</label>
                    </div>
                    <div class="col-md-6">
                        
                        <select name="days" class="form-control" style="width:50%">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                       
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Days</label>
                    </div>
                    <div class="col-md-6">
                        
                        <input name="daycount" class="form-control" type="text" id="f_deposit" required value="0">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Receipt</label>
                    </div>
                    <div class="col-md-6">
                        
                        <!-- <input name="daycount" class="form-control" type="text" id="f_deposit" required value="0"> -->
                        <input type="file" name="image" accept="image/*"><br>

                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Remarks</label>
                    </div>
                    <div class="col-md-6">
                        
                        <input name="remark2" class="form-control" type="text" id="f_deposit">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>






                
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                    	
                    	<input name="NewCard" class="btn btn-success" type="submit" id="NewCard" value="Payment">&nbsp;&nbsp; <input type="reset" class="btn btn-success" name="Submit2" value="Reset">
                       
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
            </form>
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