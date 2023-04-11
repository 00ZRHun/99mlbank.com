<?php
include('header.php');

if (isset($_GET['c'])) {
	$collection_id = $_GET['c'];
} else {
	echo "<script>window.location = 'account88.php';</script>";
}

$sql = "SELECT * FROM collection WHERE id = '".$collection_id."';";
$res = mysqli_query($conn, $sql);
$myrow = mysqli_fetch_assoc($res);
$old_daycount = $myrow['days'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];
    $interest = $_POST['interest'];
    $d_date_disp = strtotime($_POST['d_date_disp']);
    $days = $_POST['daycount'];
    $remark1 = $_POST['remark1'];
    $remark2 = $_POST['remark2'];
    $daycount = $_POST['daycount'];

    $extra_daycount = $daycount - $old_daycount;

    $sql = "SELECT * FROM customers_card WHERE id = '".$myrow['card_id']."';";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $crossed_date = $row['crossed_date'];

    if ($extra_daycount < 0) {
        $new_crossed_date = date("d-m-Y", strtotime($crossed_date.' - '.$extra_daycount.' days'));
    } else {
        $new_crossed_date = date("d-m-Y", strtotime($crossed_date.' + '.$extra_daycount.' days'));
    }

	$sql = "UPDATE collection SET amount = '".$amount."', interest = '".$interest."', d_date_disp = '".$d_date_disp."', days = '".$days."', remark1 = '".$remark1."', remark2 = '".$remark2."' WHERE id = '".$collection_id."';";

	if (mysqli_query($conn, $sql)) {
        if ($remark1 == "清") {
            $sql = "UPDATE customers_card SET clear_payment = '1', crossed_date = '".$new_crossed_date."' WHERE id = '".$myrow['card_id']."';";
        } else {
            $sql = "UPDATE customers_card SET crossed_date = '".$new_crossed_date."' WHERE id = '".$myrow['card_id']."';";
        }
        mysqli_query($conn, $sql);

	    echo "<script>alert('Successfully modified.')</script>";
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
          <center><h1>Edit Record</h1></center>
         
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
        	<form id="form1" name="form1" method="post">
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Repayment Date</label>
                    </div>
                    <div class="col-md-6">
                        
                        <input name="d_date_disp" type="date" required id="d_startDate" class="form-control" value="<?php echo date("Y-m-d", $myrow['d_date_disp']);?>">

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
                    
                    	<input name="amount" type="text" id="code" class="form-control" required value="<?php echo $myrow['amount'];?>">
                        
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
                    	
                    	<input name="interest" required class="form-control" type="text" id="f_profit" value="<?php echo $myrow['interest'];?>">
                      
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
                            <?php
                            switch ($myrow['remark1']) {
                                case '利':?>
                            <option value="利" selected>利</option>
                            <option value="來利">來利</option>
                            <option value="來錢">來錢</option>
                            <option value="來期">來期</option>
                            <option value="捕魚">捕魚</option>
                            <option value="結清">結清</option>
                            <option value="談清">談清</option>
                            <option value="分期">分期</option>
                            <option value="分天">分天</option>
                            <option value="清">清</option>
                                <?php    break;
                                case '來利':?>
                            <option value="利">利</option>
                            <option value="來利" selected>來利</option>
                            <option value="來錢">來錢</option>
                            <option value="來期">來期</option>
                            <option value="捕魚">捕魚</option>
                            <option value="結清">結清</option>
                            <option value="談清">談清</option>
                            <option value="分期">分期</option>
                            <option value="分天">分天</option>
                            <option value="清">清</option>
                                <?php    break;
                                case '來錢':?>
                            <option value="利">利</option>
                            <option value="來利">來利</option>
                            <option value="來錢" selected>來錢</option>
                            <option value="來期">來期</option>
                            <option value="捕魚">捕魚</option>
                            <option value="結清">結清</option>
                            <option value="談清">談清</option>
                            <option value="分期">分期</option>
                            <option value="分天">分天</option>
                            <option value="清">清</option>
                                <?php    break;
                                case '來期':?>
                            <option value="利">利</option>
                            <option value="來利">來利</option>
                            <option value="來錢">來錢</option>
                            <option value="來期" selected>來期</option>
                            <option value="捕魚">捕魚</option>
                            <option value="結清">結清</option>
                            <option value="談清">談清</option>
                            <option value="分期">分期</option>
                            <option value="分天">分天</option>
                            <option value="清">清</option>
                                <?php    break;
                                case '捕魚':?>
                            <option value="利">利</option>
                            <option value="來利">來利</option>
                            <option value="來錢">來錢</option>
                            <option value="來期">來期</option>
                            <option value="捕魚" selected>捕魚</option>
                            <option value="結清">結清</option>
                            <option value="談清">談清</option>
                            <option value="分期">分期</option>
                            <option value="分天">分天</option>
                            <option value="清">清</option>
                                <?php    break;
                                case '結清':?>
                            <option value="利">利</option>
                            <option value="來利">來利</option>
                            <option value="來錢">來錢</option>
                            <option value="來期">來期</option>
                            <option value="捕魚">捕魚</option>
                            <option value="結清" selected>結清</option>
                            <option value="談清">談清</option>
                            <option value="分期">分期</option>
                            <option value="分天">分天</option>
                            <option value="清">清</option>
                                <?php    break;
                                case '談清':?>
                            <option value="利">利</option>
                            <option value="來利">來利</option>
                            <option value="來錢">來錢</option>
                            <option value="來期">來期</option>
                            <option value="捕魚">捕魚</option>
                            <option value="結清">結清</option>
                            <option value="談清" selected>談清</option>
                            <option value="分期">分期</option>
                            <option value="分天">分天</option>
                            <option value="清">清</option>
                                <?php    break;
                                case '分期':?>
                            <option value="利">利</option>
                            <option value="來利">來利</option>
                            <option value="來錢">來錢</option>
                            <option value="來期">來期</option>
                            <option value="捕魚">捕魚</option>
                            <option value="結清">結清</option>
                            <option value="談清">談清</option>
                            <option value="分期" selected>分期</option>
                            <option value="分天">分天</option>
                            <option value="清">清</option>
                                <?php    break;
                                case '分天':?>
                            <option value="利">利</option>
                            <option value="來利">來利</option>
                            <option value="來錢">來錢</option>
                            <option value="來期">來期</option>
                            <option value="捕魚">捕魚</option>
                            <option value="結清">結清</option>
                            <option value="談清">談清</option>
                            <option value="分期">分期</option>
                            <option value="分天" selected>分天</option>
                            <option value="清">清</option>
                                <?php    break;
                                case '清':?>
                            <option value="利">利</option>
                            <option value="來利">來利</option>
                            <option value="來錢">來錢</option>
                            <option value="來期">來期</option>
                            <option value="捕魚">捕魚</option>
                            <option value="結清">結清</option>
                            <option value="談清">談清</option>
                            <option value="分期">分期</option>
                            <option value="分天">分天</option>
                            <option value="清" selected>清</option>
                                <?php    break;
                                default:?>
                            <option value="利">利</option>
                            <option value="來利">來利</option>
                            <option value="來錢">來錢</option>
                            <option value="來期">來期</option>
                            <option value="捕魚">捕魚</option>
                            <option value="結清">結清</option>
                            <option value="談清">談清</option>
                            <option value="分期">分期</option>
                            <option value="分天">分天</option>
                            <option value="清">清</option>
                                <?php break;
                            }
                            ?>
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
                            <?php
                            for ($i = 0; $i <= 31; $i++) {
                                if ($myrow['days'] == $i) {?>
                            <option value="<?php echo $i;?>" selected><?php echo $i;?></option>
                                <?php } else {?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }
                            }?>
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
                        
                        <input name="daycount" class="form-control" type="text" id="f_deposit" required value="<?php echo $myrow['days'];?>">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Remark</label>
                    </div>
                    <div class="col-md-6">
                        
                        <input name="remark2" class="form-control" type="text" id="f_deposit" value="<?php echo $myrow['remark2'];?>">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>






                
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                    	
                    	<input name="NewCard" class="btn btn-success" type="submit" id="NewCard" value="Save Changes">&nbsp;&nbsp; <input type="reset" class="btn btn-success" name="Submit2" value="Reset">
                       
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