<?php 
include('header.php');
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $user_agent_id = $_SESSION['agent_id'];
    $center_id = $_SESSION['center_id'];

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
                        <label for="customer_id">Customer</label>
                    </div>
                    <div class="col-md-6">
                        <select name="customer_id" class="form-control" style="width:50%;"  required="required">
<?php 
$sql = "SELECT a.* FROM customers AS a LEFT JOIN users AS b ON a.user_agent_id = b.id WHERE b.center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['name'];?></option>
<?php }?>
                        </select>
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
                <div class="row form-group" id="dynamic_field">
                    <div class="col-md-2"></div>
                    <div class="col-md-1">
                        <label for="product">Product</label>
                    </div>
                    <div class="col-md-6">
                        <select id="product" name="product" class="form-control" style="width:50%;" required="required" onchange="changeType(this.value)">
                            <?php
                            $sql = "SELECT * FROM product_list WHERE center_id = '".$_SESSION['center_id']."';";
                            $res = mysqli_query($conn, $sql);
                            while ($myrow = mysqli_fetch_array($res)) {?>
                            <option value="<?php echo $myrow['id'];?>|<?php echo $myrow['type'];?>"><?php echo $myrow['product'];?></option>
                        <?php }?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="quantity">Quantity</label>
                    </div>
                    <div class="col-md-1">
                        <input type="text" name="quantity" class="form-control" required="required" value="0">
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <br/>

                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Width</label>
                    </div>
                    <div class="col-md-2">
                        <input id="width" type="text" name="width" class="form-control" required="required" value="0">
                    </div>
                    <div class="col-md-2">
                        <label>height</label>
                    </div>
                    <div class="col-md-2">
                        <input id="height" type="text" name="height" class="form-control" required="required" value="0">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>

            <div id="curtain" style="display: block;">
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Fabric Size</label>
                    </div>
                    <div class="col-md-6">
                        <input id="fabric_size" type="text" name="fabric_size" class="form-control" required="required" value="0">
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
                            while ($myrow = mysqli_fetch_array($res)) {?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['name'];?></option>
                            <?php }?>
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
                            while ($myrow = mysqli_fetch_array($res)) {?>
                            <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
            </div>

            <div id="blind" style="display: none;">
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Installation</label>
                    </div>
                    <div class="col-md-6">
                        <input id="install" type="checkbox" name="install" onclick="changeInstall()">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row form-group" id="install_quantity" style="display: none;">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>No. of set</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="install_quantity" class="form-control" required="required" value="0">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <br/>
            </div>
                <div class="row form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success" name="create">Create</button>&nbsp;&nbsp;
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