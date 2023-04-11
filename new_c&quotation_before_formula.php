<?php 
include('header.php');
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['customer_name'];
    $telephone_1 = $_POST['customer_telephone1'];
    $address_1 = $_POST['customer_address1'];
    $gender = $_POST['t_gender'];
    $how_to_know = $_POST['how_to_know'];
    $remark = $_POST['remark'];
    $user_agent_id = $_SESSION['agent_id'];
    $center_id = $_SESSION['center_id'];

    $sql = "INSERT INTO customers (name, address_1, telephone_1, gender, user_agent_id, how_to_know, remark) VALUES ('".$name."', '".$address_1."', '".$telephone_1."', '".$gender."', '".$user_agent_id."', '".$how_to_know."', '".$remark."');";
    
    if ($res = mysqli_query($conn, $sql)) {
        $sql = "SELECT * FROM customers ORDER BY id DESC LIMIT 1;";
        $res = mysqli_query($conn, $sql);
        $myrow = mysqli_fetch_assoc($res);
        $customer_id = $myrow['id'];

        $sql = "INSERT INTO quotation (center_id, customer_id, state, date, agent_id) VALUES ('".$center_id."', '".$customer_id."', 'Pending', '".date("Y-m-d")."', '".$user_agent_id."');";
        if ($res = mysqli_query($conn, $sql)) {
            $temp = explode("|", $_POST['product']);
            $product_id = $temp[0];
            $type = $temp[1];
            $quantity = $_POST['quantity'];
            $width = $_POST['width'];
            $height = $_POST['height'];
            $fabric_size = $_POST['fabric_size'];

            $sql = "SELECT * FROM product_list WHERE id = '".$product_id."';";
            $res = mysqli_query($conn, $sql);
            $myrow = mysqli_fetch_assoc($res);

            if ($type == "Curtain") {
                $track_id = $_POST['track_id'];
                $design_id = $_POST['design_id'];
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

            $sql = "SELECT * FROM quotation ORDER BY id DESC LIMIT 1;";
            $res = mysqli_query($conn, $sql);
            $myrow = mysqli_fetch_assoc($res);
            $quotation_id = $myrow['id'];

            $sql = "INSERT INTO quotation_details (quotation_id, product_id, track_id, design_id, quantity, width, height, fabric_size, price_1, price_2, price_3, install, install_quantity, price) VALUES ('".$quotation_id."', '".$product_id."', '".$track_id."', '".$design_id."', '".$quantity."', '".$width."', '".$height."', '".$fabric_size."', '".$price1."', '".$price2."', '".$price3."', '".$install."', '".$install_quantity."', '".$price."');";
            if ($res = mysqli_query($conn, $sql)) {
                echo "<script>window.location = 'quotation.php?c=".$customer_id."&q=".$quotation_id."';</script>";
            } else {
                echo "<script>alert('Something Error. Please try again later.')</script>";
                // echo $sql;
            }
        } else {
            echo "<script>alert('Something Error. Please try again later.')</script>";
        }
    } else {
        echo "<script>alert('Something Error. Please try again later.')</script>";
    }
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center><h1>New Quotation</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <a href="dashboard.php" class="btn btn-info">Back</a>
    <section>
    	<div class="container">
            <form method="post" id="myForm">
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_id">Customer ID</label>
                    </div>
                    <div class="col-md-6">
                        <span style="color:red;">Auto Generated</span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_name">Name</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="customer_name" class="form-control" required="required" value="<?php echo $customer_name;?>"/>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_telephone">Phone</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="customer_telephone1" required="required" class="form-control" value="<?php echo $customer_telephone1;?>"/><br/>
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
                        <textarea name="customer_address1" required="required" class="form-control" style="height: 100px;"><?php echo $customer_address1;?></textarea>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_gender">Gender</label>
                    </div>
                    <div class="col-md-6">                    
                   
                        <select name="t_gender" class="form-control" style="width:50%;">
                            <option value="F" <?php if(isset($t_gender) && $t_gender=="F"){ echo 'selected="selected"';} ?>>F - Female</option>
                            <option value="M" <?php if(isset($t_gender) && $t_gender=="M"){ echo 'selected="selected"';} ?>>M - Male</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_guaranty_name">How to know</label>
                    </div>
                    <div class="col-md-6">
                        <select name="how_to_know" class="form-control" style="width:50%;">
                            <option value="Google" <?php if ($how_to_know == "Google") { echo "Selected"; } ?>>Google</option>
                            <option value="Facebook" <?php if ($how_to_know == "Facebook") { echo "Selected"; } ?>>Facebook</option>
                            <option value="Introduced" <?php if ($how_to_know == "Introduced") { echo "Selected"; } ?>>Introduced</option>
                            <option value="Others" <?php if ($how_to_know == "Others") { echo "Selected"; } ?>>Others</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_guaranty_ic_passpost">Remark</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="remark" class="form-control" value="<?php echo $remark;?>"/>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <hr style="color: black; border-top-color: black;">
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_id">Quotation ID</label>
                    </div>
                    <div class="col-md-6">
                        <span style="color:red;">Auto Generated</span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-1"><label>Item No.</label></div>
                    <div class="col-md-2"><label>Name/Area</label></div>
                    <div class="col-md-2"><label>Product</label></div>
                    <div class="col-md-3"><label>Details</label></div>
                    <div class="col-md-2"></div>
                </div>










                <div class="row form-group">
                    <div class="col-md-2"></div>
<?php $x = 1;?>
                    <div class="col-md-1"><label><?php echo $x.".";?></label></div>
                    <div class="col-md-2">
                        <input type="text" name="" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" onchange="changeType(this.value, 1)">
                            <option value="Curtain">Curtain</option>
                            <option value="Blind">Blind</option>
                        </select>
                    </div>


                    <div class="col-md-3">
                <div id="curtain<?php echo $x;?>" style="display: block;">
                    <label style="white-space: nowrap;">Width: <input type="text" name="" class="form-control" style="display: inline;"></label>
                    <br>
                    <label style="white-space: nowrap;">Height: <input type="text" name="" class="form-control" style="display: inline;"></label>
                    <br>
                    <label style="white-space: nowrap;">Unit: 
                        <select class="form-control" style="display: inline;"name>
                            <option value="inch">inch</option>
                            <option value="mm">mm</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Brand: 
                        <select class="form-control" style="display: inline;" name="" onchange="changeCurtain(this.value)">
<?php
$i = 0;
$sql = "SELECT * FROM product_list WHERE type = 'Curtain' AND center_id = '".$_SESSION['center_id']."';";
// echo $sql;
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
    $product_type[$i++] = $temp[0];
}
$array = array_unique($product_type);
sort($array);
for ($j = 0; $j < count($array); $j++) { ?>
                            <option value="<?php echo $array[$j];?>"><?php echo $array[$j];?></option>
<?php }?>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Fabric Code: 
<?php
for ($j = 0; $j < count($array); $j++) {?>
                        <select id="<?php echo $array[$j];?>" class="form-control" style="display: <?php if ($j == 0) { echo "inline"; } else { echo "none"; }?>;" name="<?php echo $array[$j];?>">
<?php
$sql = "SELECT * FROM product_list WHERE product LIKE '%".$array[$j]."%' AND center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
    ?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $temp[1];?></option>
<?php }?>
                        </select>
<?php }?>
                    </label>
                    <br>
                    <label>Fabric Size: ??</label>
                    <br>
                    <label style="white-space: nowrap;">Design: 
                        <select class="form-control" style="display: inline;" name="">
<?php
$sql = "SELECT * FROM design_list WHERE center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['name'];?></option>
<?php }?>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Sewing Price: ??</label>
                    <br>
                    <label style="white-space: nowrap;">Track: 
                        <select class="form-control" style="display: inline;" name="">
                            <option value="0">No Need</option>
<?php
$sql = "SELECT * FROM track_list WHERE center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['name'];?></option>
<?php }?>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Track Price: ??</label>
                    <br>
                    <label style="white-space: nowrap;">Hook: 
                        <select class="form-control" style="display: inline;" name="">
                            <option value="101">101</option>
                            <option value="104">104</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Mount:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Wall">Wall</option>
                            <option value="Ceiling">Ceiling</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Tieback:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </label>
                </div>







                <div id="blind<?php echo $x;?>" style="display: none;">
                    <label style="white-space: nowrap;">Width: <input type="text" name="" class="form-control" style="display: inline;"></label>
                    <br>
                    <label style="white-space: nowrap;">Height: <input type="text" name="" class="form-control" style="display: inline;"></label>
                    <br>
                    <label style="white-space: nowrap;">Unit: 
                        <select class="form-control" style="display: inline;"name>
                            <option value="inch">inch</option>
                            <option value="mm">mm</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Type: 
                        <select class="form-control" style="display: inline;" name="" onchange="changeBlind(this.value)">
<?php
$i = 0;
$sql = "SELECT * FROM product_list WHERE type = 'Blind' AND center_id = '".$_SESSION['center_id']."';";
// echo $sql;
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
    $temp2 = explode(" ", $temp[0]);

    $product_type[$i++] = $temp2[0]."_".$temp2[1];
}
$array = array_unique($product_type);
sort($array);
for ($j = 0; $j < count($array); $j++) {
    $temp = explode("_", $array[$j]);
?>
                            <option value="<?php echo $array[$j];?>"><?php echo $temp[0]." ".$temp[1];?></option>
<?php }?>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Code: 
<?php
for ($j = 0; $j < count($array); $j++) {
?>
                        <select id="<?php echo $array[$j];?>" class="form-control" style="display: <?php if ($j == 0) { echo "inline"; } else { echo "none"; }?>;" name="<?php echo $array[$j];?>">
<?php
$sql = "SELECT * FROM product_list WHERE product LIKE '%".$array[$j]."%' AND center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
    ?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $temp[1];?></option>
<?php }?>
                        </select>
<?php }?>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Mount:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Wall">Wall</option>
                            <option value="Ceiling">Ceiling</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Pulley:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Left">Left</option>
                            <option value="Right">Right</option>
                        </select>
                    </label>
                    <br>


                    <label style="white-space: nowrap;">Headtype:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Left">Headnail</option>
                            <option value="Right">Pelmet</option>
                        </select>
                    </label>
                    <br>


                    <label style="white-space: nowrap;">Installation:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Price: ???</label>
                </div>
                    </div>










                    <div class="col-md-2"></div>
<?php $x++;?>
                </div>

                <div class="row form-group" id="show_item"></div>

                <div class="row form-group">
                    <input type="submit" value="Add More Product" class="add_item_btn btn btn-success">
                </div>









                
                <div class="row form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success" name="create" disabled>Create</button>&nbsp;&nbsp;
                        <button type="reset" class="btn btn-success" name="reset">Reset</button>
                    </div>
                    <div class="col-md-2"></div>
                </div>
        	</form>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/ibs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".add_item_btn").click(function(e) {
            e.preventDefault ();
             $("#show_item").prepend (`
                    <div class="col-md-2"></div>
                    <div class="col-md-1"><label>1.</label></div>
                    <div class="col-md-2">
                        <input type="text" name="" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" onchange="changeType(this.value)">
                            <option value="Curtain">Curtain</option>
                            <option value="Blind">Blind</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                <div id="curtain<?php echo $x;?>" style="display: block;">
                    <label style="white-space: nowrap;">Width: <input type="text" name="" class="form-control" style="display: inline;"></label>
                    <br>
                    <label style="white-space: nowrap;">Height: <input type="text" name="" class="form-control" style="display: inline;"></label>
                    <br>
                    <label style="white-space: nowrap;">Unit: 
                        <select class="form-control" style="display: inline;"name>
                            <option value="inch">inch</option>
                            <option value="mm">mm</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Brand: 
                        <select class="form-control" style="display: inline;" name="" onchange="changeCurtain(this.value)">
<?php
$i = 0;
$sql = "SELECT * FROM product_list WHERE type = 'Curtain' AND center_id = '".$_SESSION['center_id']."';";
// echo $sql;
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
    $product_type[$i++] = $temp[0];
}
$array = array_unique($product_type);
sort($array);
for ($j = 0; $j < count($array); $j++) { ?>
                            <option value="<?php echo $array[$j];?>"><?php echo $array[$j];?></option>
<?php }?>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Fabric Code: 
<?php
for ($j = 0; $j < count($array); $j++) {?>
                        <select id="<?php echo $array[$j];?>" class="form-control" style="display: <?php if ($j == 0) { echo "inline"; } else { echo "none"; }?>;" name="<?php echo $array[$j];?>">
<?php
$sql = "SELECT * FROM product_list WHERE product LIKE '%".$array[$j]."%' AND center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
    ?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $temp[1];?></option>
<?php }?>
                        </select>
<?php }?>
                    </label>
                    <br>
                    <label>Fabric Size: ??</label>
                    <br>
                    <label style="white-space: nowrap;">Design: 
                        <select class="form-control" style="display: inline;" name="">
<?php
$sql = "SELECT * FROM design_list WHERE center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['name'];?></option>
<?php }?>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Sewing Price: ??</label>
                    <br>
                    <label style="white-space: nowrap;">Track: 
                        <select class="form-control" style="display: inline;" name="">
                            <option value="0">No Need</option>
<?php
$sql = "SELECT * FROM track_list WHERE center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['name'];?></option>
<?php }?>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Track Price: ??</label>
                    <br>
                    <label style="white-space: nowrap;">Hook: 
                        <select class="form-control" style="display: inline;" name="">
                            <option value="101">101</option>
                            <option value="104">104</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Mount:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Wall">Wall</option>
                            <option value="Ceiling">Ceiling</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Tieback:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </label>
                </div>








                <div id="blind<?php echo $x;?>" style="display: none;">
                    <label style="white-space: nowrap;">Width: <input type="text" name="" class="form-control" style="display: inline;"></label>
                    <br>
                    <label style="white-space: nowrap;">Height: <input type="text" name="" class="form-control" style="display: inline;"></label>
                    <br>
                    <label style="white-space: nowrap;">Unit: 
                        <select class="form-control" style="display: inline;"name>
                            <option value="inch">inch</option>
                            <option value="mm">mm</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Type: 
                        <select class="form-control" style="display: inline;" name="" onchange="changeBlind(this.value)">
<?php
$i = 0;
$sql = "SELECT * FROM product_list WHERE type = 'Blind' AND center_id = '".$_SESSION['center_id']."';";
// echo $sql;
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
    $temp2 = explode(" ", $temp[0]);

    $product_type[$i++] = $temp2[0]."_".$temp2[1];
}
$array = array_unique($product_type);
sort($array);
for ($j = 0; $j < count($array); $j++) {
    $temp = explode("_", $array[$j]);
?>
                            <option value="<?php echo $array[$j];?>"><?php echo $temp[0]." ".$temp[1];?></option>
<?php }?>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Code: 
<?php
for ($j = 0; $j < count($array); $j++) {
?>
                        <select id="<?php echo $array[$j];?>" class="form-control" style="display: <?php if ($j == 0) { echo "inline"; } else { echo "none"; }?>;" name="<?php echo $array[$j];?>">
<?php
$sql = "SELECT * FROM product_list WHERE product LIKE '%".$array[$j]."%' AND center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
    ?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $temp[1];?></option>
<?php }?>
                        </select>
<?php }?>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Mount:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Wall">Wall</option>
                            <option value="Ceiling">Ceiling</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Pulley:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Left">Left</option>
                            <option value="Right">Right</option>
                        </select>
                    </label>
                    <br>


                    <label style="white-space: nowrap;">Headtype:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Left">Headnail</option>
                            <option value="Right">Pelmet</option>
                        </select>
                    </label>
                    <br>


                    <label style="white-space: nowrap;">Installation:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Price: ???</label>
                </div>
                    </div>










                    <div class="col-md-2"></div>
<?php $x++;?>`);
        });
    });

    function changeType(input, x) {
        var curtain = document.getElementById("curtain".concat(x));
        var blind = document.getElementById("blind".concat(x));
        if (input == "Curtain") {
            curtain.style.display = "block";
            blind.style.display = "none";
        } else {
            curtain.style.display = "none";
            blind.style.display = "block";
        }
    }

    function changeCurtain(input) {
        var jotex = document.getElementById("Jotex");
        var pro = document.getElementById("PRO");
        var zm = document.getElementById("ZM");
        if (input == "Jotex") {
            jotex.style.display = "inline";
            pro.style.display = "none";
            zm.style.display = "none";
        } else if (input == "PRO") {
            jotex.style.display = "none";
            pro.style.display = "inline";
            zm.style.display = "none";
        } else {
            jotex.style.display = "none";
            pro.style.display = "none";
            zm.style.display = "inline";
        }
    }

    function changeBlind(input) {
        var roller = document.getElementById("Roller_Blind");
        var venetian = document.getElementById("Venetian_Blind");
        var vertical = document.getElementById("Vertical_Blind");
        var zebra = document.getElementById("Zebra_Blind");
        if (input == "Roller_Blind") {
            roller.style.display = "inline";
            venetian.style.display = "none";
            vertical.style.display = "none";
            zebra.style.display = "none";
        } else if (input == "Venetian_Blind") {
            roller.style.display = "none";
            venetian.style.display = "inline";
            vertical.style.display = "none";
            zebra.style.display = "none";
        } else if (input == "Vertical_Blind") {
            roller.style.display = "none";
            venetian.style.display = "none";
            vertical.style.display = "inline";
            zebra.style.display = "none";
        } else {
            roller.style.display = "none";
            venetian.style.display = "none";
            vertical.style.display = "none";
            zebra.style.display = "inline";
        }
    }

    // function changeInstall() {
    //     var checkBox = document.getElementById("install");
    //     var text = document.getElementById("install_quantity");
    //     if (checkBox.checked == true) {
    //         text.style.display = "block";
    //     } else {
    //         text.style.display = "none";
    //     }
    // }
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