<?php 
include('header.php');

if (isset($_GET['q'])) {
    $quotation_id = $_GET['q'];
} else {
    $sql = "SELECT * FROM quotation ORDER BY id DESC LIMIT 1;";
    $res = mysqli_query($conn, $sql);
    $myrow = mysqli_fetch_assoc($res);
    if ($myrow['id'] > 0) {
        $quotation_id = $myrow['id'] + 1;
    }

}

if(isset($_POST['create'])) {

    if (isset($_GET['q'])) {
        $quotation_id = $_GET['q'];
    } else {
        $sql = "SELECT * FROM quotation ORDER BY id DESC LIMIT 1;";
        $res = mysqli_query($conn, $sql);
        $myrow = mysqli_fetch_assoc($res);
        if ($myrow['id'] > 0) {
            $quotation_id = $myrow['id'] + 1;
        }

    }

    $counter = 0;
    $center_id = $_SESSION['center_id'];
    $agent_id = $_SESSION['agent_id'];
    $date = date("Y-m-d");
    $customer_id = $_GET['c'];
    $sql = "SELECT * FROM quotation WHERE id = '".$_POST['quotation_id']."';";
    $res = mysqli_query($conn, $sql);
    while ($myrow = mysqli_fetch_array($res)) {
        $counter++;
    }

    if($counter == 0) {
        $sql = "INSERT INTO quotation (center_id, customer_id, date, agent_id) VALUES ('".$center_id."','".$customer_id."','".$date."','".$agent_id."');";
        mysqli_query($conn, $sql);
        $sql = "SELECT * FROM quotation ORDER BY id DESC LIMIT 1;";
        $res = mysqli_query($conn, $sql);
        $myrow = mysqli_fetch_assoc($res);
        $quotation_id = $myrow['id'];
    }

    $temp = explode("|", $_POST['product']);
    $product_id = $temp[0];
    $type = $temp[1];

    $sql = "SELECT * FROM product_list WHERE id = '".$product_id."';";
    $res = mysqli_query($conn, $sql);
    $myrow = mysqli_fetch_assoc($res);

    $width = $_POST['width'];
    $height = $_POST['height'];
    $quantity = $_POST['quantity'];
    if ($type == "Curtain") {
        $track_id = $_POST['track_id'];
        $design_id = $_POST['design_id'];
        $fabric_size = $_POST['fabric_size'];

        $sql1 = "SELECT * FROM track_list WHERE id = '".$track_id."';";
        $res1 = mysqli_query($conn, $sql1);
        $myrow1 = mysqli_fetch_assoc($res1);
        
        $sql2 = "SELECT * FROM design_list WHERE id = '".$design_id."';";
        $res2 = mysqli_query($conn, $sql2);
        $myrow2 = mysqli_fetch_assoc($res2);

        if ($height > 120) {
            $panel = ceil((($width * 2) + 10) / $fabric_size);
            $area = ceil(((($height + 10) * $panel) / 39) * 10) / 10;
            $price1 = $area * $myrow['price'];
            $price3 = ceil($width / 12) * $myrow2['price_above'];
        } else {
            $area = ceil(((($width * 2) + 10) / 39) * 10) / 10;
            $price1 = $area * $myrow['price'];
            $price3 = ceil($width / 12) * $myrow2['price_within'];
        }

        $price2 = ceil($width / 12) * $myrow1['price'];
        $install = 0;
        $install_quantity = 0;
        $price = ($price1 + $price2 + $price3) * $quantity;
    } elseif ($type == "Blind") {
        $track_id = 0;
        $design_id = 0;
        $fabric_size = 0;
        $area = ceil($width * $height / 144);
        if ($area < 20) {
            $price1 = 20 * $myrow['price'];
        } else {
            $price1 = $area * $myrow['price'];
        }
        $price2 = 0;
        $price3 = 0;
        if ($_POST['install'] == "on") {
            $install = 1;
            $install_quantity = $_POST['install_quantity'];
        } else {
            $install = 0;
            $install_quantity = 0;
        }
        $price = ($price1 * $quantity) + ($install_quantity * 30);
    }

    $sql = "INSERT INTO quotation_details (quotation_id, product_id, track_id, design_id, quantity, width, height, fabric_size, price_1, price_2, price_3, install, install_quantity, price) VALUES ('".$quotation_id."', '".$product_id."', '".$track_id."', '".$design_id."', '".$quantity."', '".$width."', '".$height."', '".$fabric_size."', '".$price1."', '".$price2."', '".$price3."', '".$install."', '".$install_quantity."', '".$price."');";
    $res = mysqli_query($conn, $sql);
    echo "<script>window.location = 'quotation.php?c=".$customer_id."&q=".$quotation_id."';</script>";
} elseif (isset($_POST['edit'])) {

    if (isset($_GET['q'])) {
        $quotation_id = $_GET['q'];
    } else {
        $sql = "SELECT * FROM quotation ORDER BY id DESC LIMIT 1;";
        $res = mysqli_query($conn, $sql);
        $myrow = mysqli_fetch_assoc($res);
        if ($myrow['id'] > 0) {
            $quotation_id = $myrow['id'] + 1;
        }

    }

    $temp = explode("|", $_POST['product']);
    $product_id = $temp[0];
    $type = $temp[1];

    $sql = "SELECT * FROM product_list WHERE id = '".$product_id."';";
    $res = mysqli_query($conn, $sql);
    $myrow = mysqli_fetch_assoc($res);
    
    $width = $_POST['width'];
    $height = $_POST['height'];
    $quantity = $_POST['quantity'];
    if ($type == "Curtain") {
        $track_id = $_POST['track_id'];
        $design_id = $_POST['design_id'];
        $fabric_size = $_POST['fabric_size'];

        $sql1 = "SELECT * FROM track_list WHERE id = '".$track_id."';";
        $res1 = mysqli_query($conn, $sql1);
        $myrow1 = mysqli_fetch_assoc($res1);
        
        $sql2 = "SELECT * FROM design_list WHERE id = '".$design_id."';";
        $res2 = mysqli_query($conn, $sql2);
        $myrow2 = mysqli_fetch_assoc($res2);

        if ($height > 120) {
            $panel = ceil((($width * 2) + 10) / $fabric_size);
            $area = ceil(((($height + 10) * $panel) / 39) * 10) / 10;
            $price1 = $area * $myrow['price'];
            $price3 = ceil($width / 12) * $myrow2['price_above'];
        } else {
            $area = ceil(((($width * 2) + 10) / 39) * 10) / 10;
            $price1 = $area * $myrow['price'];
            $price3 = ceil($width / 12) * $myrow2['price_within'];
        }

        $price2 = ceil($width / 12) * $myrow1['price'];
        $install = 0;
        $install_quantity = 0;
        $price = ($price1 + $price2 + $price3) * $quantity;
    } elseif ($type == "Blind") {
        $track_id = 0;
        $design_id = 0;
        $fabric_size = 0;
        $area = ceil($width * $height / 144);
        if ($area < 20) {
            $price1 = 20 * $myrow['price'];
        } else {
            $price1 = $area * $myrow['price'];
        }
        $price2 = 0;
        $price3 = 0;
        if ($_POST['install'] == "on") {
            $install = 1;
            $install_quantity = $_POST['install_quantity'];
        } else {
            $install = 0;
            $install_quantity = 0;
        }
        $price = ($price1 * $quantity) + ($install_quantity * 30);
    }

    $sql = "UPDATE quotation_details SET product_id = '".$product_id."', track_id = '".$track_id."', design_id = '".$design_id."', quantity = '".$quantity."', width = '".$width."', height = '".$height."', fabric_size = '".$fabric_size."', price_1 = '".$price1."', price_2 = '".$price2."', price_3 = '".$price3."', install = '".$install."', install_quantity = '".$install_quantity."', price = '".$price."' WHERE id = '".$_GET['p']."';";
    $res = mysqli_query($conn, $sql);
    echo "<script>window.location = 'quotation.php?c=".$customer_id."&q=".$quotation_id."';</script>";
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
            <?php if(isset($_GET['p'])) {?>
          <center> <h1>Edit Product</h1></center>
            <?php } else {?>
          <center> <h1>Add Product To Quotation</h1></center>
            <?php }?>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <a href="quotation.php?c=<?php echo $_GET['c'];if (isset($_GET['q'])) {echo "&q=".$_GET['q'];} ?>" class="btn btn-info">Back</a>
    <section>
    	<div class="container">
            <form method="post" id="myForm">
            	<input type="hidden" name="quotation_id" value="<?php echo $quotation_id;?>"/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="product">Product</label>
                    </div>
                    <div class="col-md-6">                    
                   
                        <select id="product" name="product" class="form-control" style="width:50%;" required="required" onchange="changeType(this.value)">
                            <?php
                            if (isset($_GET['p'])) {
                                $sql = "SELECT * FROM quotation_details WHERE id = '".$_GET['p']."';";
                                $res = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($res);
                                $qwe = $row['product_id'];
                                $qwf = $row['track_id'];
                                $qwg = $row['design_id'];
                            }

                            $sql = "SELECT * FROM product_list WHERE center_id = '".$_SESSION['center_id']."';";
                            $res = mysqli_query($conn, $sql);
                            while ($myrow = mysqli_fetch_array($res)) {
                                if (isset($qwe)) {
                                    if ($qwe == $myrow['id']) {?>
                            <option value="<?php echo $myrow['id'];?>|<?php echo $myrow['type'];?>" selected><?php echo $myrow['product'];?></option>
                                    <?php } else {?>
                            <option value="<?php echo $myrow['id'];?>|<?php echo $myrow['type'];?>"><?php echo $myrow['product'];?></option>
                                    <?php }
                                } else {?>
                            <option value="<?php echo $myrow['id'];?>|<?php echo $myrow['type'];?>"><?php echo $myrow['product'];?></option>
                                <?php }
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
                        <label for="quantity">Quantity</label>
                    </div>
                    <div class="col-md-6">
                        <input id="quantity" type="text" name="quantity" class="form-control" required="required" value="<?php if (isset($_GET['p'])) { echo $row['quantity'];} else { echo "0";}?>">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Width</label>
                    </div>
                    <div class="col-md-6">
                        <input id="width" type="text" name="width" class="form-control" required="required" value="<?php if (isset($_GET['p'])) { echo $row['width'];} else { echo "0";}?>">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>height</label>
                    </div>
                    <div class="col-md-6">
                        <input id="height" type="text" name="height" class="form-control" required="required" value="<?php if (isset($_GET['p'])) { echo $row['height'];} else { echo "0";}?>">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>

            <div id="curtain" style="display: <?php if (isset($_GET['p'])) {if ($row['track_id'] != "0" && $row['design_id'] != "0") { echo "block";} else { echo "none"; }} else { echo "block"; }?>;">
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Fabric Size</label>
                    </div>
                    <div class="col-md-6">
                        <input id="fabric_size" type="text" name="fabric_size" class="form-control" required="required" value="<?php if (isset($_GET['p'])) { echo $row['fabric_size'];} else { echo "0";}?>">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Track</label>
                    </div>
                    <div class="col-md-6">
                        <select id="track" name="track_id" class="form-control" style="width:50%;" required="required">
                            <?php
                            $sql = "SELECT * FROM track_list WHERE center_id = '".$_SESSION['center_id']."';";
                            $res = mysqli_query($conn, $sql);
                            while ($myrow = mysqli_fetch_array($res)) {
                                if (isset($qwf)) {
                                    if ($qwf == $myrow['id']) {?>
                            <option value="<?php echo $myrow['id'];?>" selected><?php echo $myrow['name'];?></option>
                                    <?php } else {?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['name'];?></option>
                                    <?php }
                                } else {?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['name'];?></option>
                                <?php }
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
                        <label>Design</label>
                    </div>
                    <div class="col-md-6">
                        <select id="design" name="design_id" class="form-control" style="width:50%;" required="required">
                            <?php
                            $sql = "SELECT * FROM design_list WHERE center_id = '".$_SESSION['center_id']."';";
                            $res = mysqli_query($conn, $sql);
                            while ($myrow = mysqli_fetch_array($res)) {
                                if (isset($qwg)) {
                                    if ($qwg == $myrow['id']) {?>
                            <option value="<?php echo $myrow['id'];?>" selected><?php echo $myrow['name'];?></option>
                                    <?php } else {?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['name'];?></option>
                                    <?php }
                                } else {?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['name'];?></option>
                                <?php }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
            </div>

            <div id="blind" style="display: <?php if (isset($_GET['p'])) { if ($row['track_id'] == 0 && $row['design_id'] == 0) { echo "block"; } else { echo "none"; } } else { echo "none"; }?>;">
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Installation</label>
                    </div>
                    <div class="col-md-6">
                        <input id="install" type="checkbox" name="install" <?php if ($row['install'] == "1") { echo "checked"; }?> onclick="changeInstall()">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row form-group" id="install_quantity" style="display: <?php if ($row['install'] == "1") { echo "block"; } else { echo "none"; }?>;">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>No. of set</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="install_quantity" class="form-control" required="required" value="<?php if (isset($_GET['p'])) { echo $row['install_quantity'];} else { echo "0";}?>">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <br/>
            </div>

                <div class="row form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success" name="<?php if(isset($_GET['p'])) { echo "edit"; } else { echo "create";}?>"><?php if (isset($_GET['p'])) { echo "Edit Product"; } else { echo "Add Product"; }?></button>&nbsp;&nbsp;
                        <button type="reset" class="btn btn-success" name="reset">Reset</button>
                    </div>
                    <div class="col-md-2"></div>
                </div>
        	</form>
        </div>
    </section>
</div>
<script>
    function changeType(input) {
        const myArray = input.split("|");
        var curtain = document.getElementById("curtain");
        var blind = document.getElementById("blind");
        if (myArray[1] == "Curtain") {
            curtain.style.display = "block";
            blind.style.display = "none";
        } else if (myArray[1] == "Blind") {
            curtain.style.display = "none";
            blind.style.display = "block";
        }
    }

    function changeInstall() {
        var checkBox = document.getElementById("install");
        var text = document.getElementById("install_quantity");
        if (checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
</script>
<style>
.span_hwe
{
	float:left;
	color: #000;
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
label
{
	font-size: 14px;
	color: #000;
}
.btn-success
{
	background:#038603 !important;
}

</style>
