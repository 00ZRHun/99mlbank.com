<?php 
include('header.php');
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['customer_name'];
    $telephone_1 = $_POST['customer_telephone1'];
    $address_1 = $_POST['customer_address1'];
    $gender = $_POST['t_gender'];
    $how_to_know = $_POST['how_to_know'];
    $remark = $_POST['remark'];
    $name_areas = $_POST['name_area'];
    $types = $_POST['type'];
    $widths = $_POST['width'];
    $heights = $_POST['height'];
    $blind_widths = $_POST['blind_width'];
    $blind_heights = $_POST['blind_height'];
    $curtain_units = $_POST['curtain_unit'];
    $blind_units = $_POST['blind_unit'];
    $track_ids = $_POST['track_id'];
    $design_ids = $_POST['design_id'];
    $Jotexs = $_POST['Jotex'];
    $PROs = $_POST['PRO'];
    $ZMs = $_POST['ZM'];
    $Roller_Blinds = $_POST['Roller_Blind'];
    $Venetian_Blinds = $_POST['Venetian_Blind'];
    $Vertical_Blinds = $_POST['Vertical_Blind'];
    $Zebra_Blinds = $_POST['Zebra_Blind'];
    $installs = $_POST['install'];
    
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
            
            $quantity = "1";

            $sql = "SELECT * FROM quotation ORDER BY id DESC LIMIT 1;";
            $res = mysqli_query($conn, $sql);
            $myrow = mysqli_fetch_assoc($res);
            $quotation_id = $myrow['id'];
            
            
            
            
for ($i = 0; $i < count($name_areas); $i++) {
    $name_area = $name_areas[$i];
    $type_list = $types[$i];
    $width_list = $widths[$i];
    $height_list = $heights[$i];
    $blind_width_list = $blind_widths[$i];
    $blind_height_list = $blind_heights[$i];
    $curtain_unit_list = $curtain_units[$i];
    $blind_unit_list = $blind_units[$i];
    $track_id_list = $track_ids[$i]; 
    $design_id_list = $design_ids[$i];
    $Jotex_list = $Jotexs[$i];
    $PRO_list = $PROs[$i];
    $ZM_list = $ZMs[$i];
    $Roller_Blind_list = $Roller_Blinds[$i];
    $Venetian_Blind_list = $Venetian_Blinds[$i];
    $Vertical_Blinds_list = $Vertical_Blinds[$i];
    $Zebra_Blind_list = $Zebra_Blinds[$i];
    $install_list = $installs[$i];
    $product_id = 0;
            
    for ($key = 0; $key < count($width_list); $key++) {
        $product_id = 0;
        $width = $width_list[$key];
        $height = $height_list[$key];
        $type = $type_list[$key];
        $blind_width = $blind_width_list[$key];
        $blind_height = $blind_height_list[$key];
        $curtain_unit = $curtain_unit_list[$key];
        $blind_unit = $blind_unit_list[$key];
        $track_id = $track_id_list[$key]; 
        $design_id = $design_id_list[$key]; 
        $Jotex = $Jotex_list[$key];
        $PRO = $PRO_list[$key];
        $ZM = $ZM_list[$key];
        $Roller_Blind = $Roller_Blind_list[$key];
        $Venetian_Blind = $Venetian_Blind_list[$key];
        $Vertical_Blind = $Vertical_Blind_list[$key];
        $Zebra_Blind = $Zebra_Blind_list[$key];
        $install = $install_list[$key];
        
        $track_id_parts = explode("|", $track_id);
        $track_id_without_pipe = $track_id_parts[0];

        $design_id_parts = explode("|", $design_id);
        $design_id_without_pipe = $design_id_parts[0];
        
        
        if ($type == "Curtain") {

            if ($Jotex != "0") {
                $product_id = explode('|', $Jotex)[0];
                $fabric_size = explode('|', $Jotex)[1];
            } elseif ($PRO != "0") {
                $product_id = explode('|', $PRO)[0];
                $fabric_size = explode('|', $PRO)[1];
            } elseif ($ZM_ != "0") {
                $product_id = explode('|', $ZM)[0];
                $fabric_size = explode('|', $ZM)[1];
            }
                
                $sql = "SELECT * FROM product_list WHERE id = '".$product_id."';";
                $res = mysqli_query($conn, $sql);
                $myrow = mysqli_fetch_assoc($res);
                
                $sql1 = "SELECT * FROM track_list WHERE id = '".$track_id_without_pipe."';";
                $res1 = mysqli_query($conn, $sql1);
                $myrow1 = mysqli_fetch_assoc($res1);
                
                $sql2 = "SELECT * FROM design_list WHERE id = '".$design_id_without_pipe."';";
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
                
                $sql = "INSERT INTO quotation_details (quotation_id, name, type ,product_id, track_id, design_id, quantity, width, height, fabric_size, price_1, price_2, price_3, install, install_quantity, price, unit) VALUES ('$quotation_id', '$name_area', '$type' ,'$product_id', '$track_id_without_pipe', '".$design_id_without_pipe."', '".$quantity."', '".$width."', '".$height."', '".$fabric_size."', '".$price1."', '".$price2."', '".$price3."', '".$install."', '".$install_quantity."', '".$price."', '".$curtain_unit."')";
            } elseif ($type == "Blind") {
                
                if ($Roller_Blind != "0") {
                $product_id = explode('|', $Roller_Blind)[0];
            } elseif ($Venetian_Blind != "0") {
                $product_id = explode('|', $Venetian_Blind)[0];
            } elseif ($Vertical_Blind != "0") {
                $product_id = explode('|', $Vertical_Blind)[0];
            } elseif ($Zebra_Blind != "0") {
                $product_id = explode('|', $Zebra_Blind)[0];
            }
                
                $sql = "SELECT * FROM product_list WHERE id = '".$product_id."';";
                $res = mysqli_query($conn, $sql);
                $myrow = mysqli_fetch_assoc($res);
                
                $track_id = 0;
                $design_id = 0;
                $fabric_size = 0;
                $area = ceil($blind_width * $blind_height / 144);
                if ($area < 20) {
                    $price1 = 20 * $myrow['price'];
                } else {
                    $price1 = $area * $myrow['price'];
                }
                $price2 = 0;
                $price3 = 0;
                if ($install == "Yes") {
                    $install = 1;
                    $install_quantity = 1;
                    $price = ($price1 * $quantity) + ($install_quantity * 30);
                } else {
                    $install = 0;
                    $install_quantity = 0;
                    $price = ($price1 * $quantity);
                }
                $sql = "INSERT INTO quotation_details (quotation_id, name, type ,product_id, track_id, design_id, quantity, width, height, fabric_size, price_1, price_2, price_3, install, install_quantity, price, unit) VALUES ('$quotation_id', '$name_area', '$type' , '$product_id', '$track_id_without_pipe', '".$design_id_without_pipe."', '".$quantity."', '".$blind_width."', '".$blind_height."', '".$fabric_size."', '".$price1."', '".$price2."', '".$price3."', '".$install."', '".$install_quantity."', '".$price."', '".$blind_unit."')";
             }
       
             if (mysqli_query($conn, $sql)) {
            // echo $sql;
             echo "<script>window.location = 'quotation.php?c=".$customer_id."&q=".$quotation_id."';</script>";
            } else {
            $error_msg = mysqli_error($conn);
             echo "<script>alert('Error: " . mysqli_real_escape_string($conn, $error_msg) . "')</script>";
            // echo $sql;
            }
          }
       }
       
            
        }else {
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
                    <div class="col-md-1"><label>No. Layers</label></div>
                    <div class="col-md-2"><label>Product</label></div>
                    <div class="col-md-3"><label>Details</label></div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row form-group" id="area-container">
                    <div class="area"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-1"><label> 1.</label></div>
                
                    <div class="col-md-2">
                        <input type="text" name="name_area[]" id="name_area" class="form-control" required>
                        
                    </div>
                <div class="col-md-1">
                    <input type="number" name="num_products[]"  class="form-control" onchange="addProducts(this,0)">
                </div>
                
                <div class="products-container" id="products-container-0"></div>
                
                    <div class="col-md-2"></div>
                    <br>
                </div>
                <hr>

                <div id="show_additional_item"></div>

                <div id="show_item"></div>

                <div class="row form-group">
                    <!--<input type="submit" value="Add More Area" class="add_item_btn btn btn-success">-->
                    <button type="button" class="btn btn-success" onclick="addArea()">Add More Area</button><br>
                    <!--<button type="button"  class="add_layer_btn btn btn-success" onclick="addArea(0)">Add Layer</button><br>-->
                </div>

                <div class="row form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success" name="create">Create</button>&nbsp;&nbsp;
                        <button type="reset" class="btn btn-success" name="reset">Reset</button>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/ibs/jquery/3.6.0/jquery.min.js"></script>
<script>

function addProducts(element, areaIndex) {
    var numProducts = $(element).val();
    var productsContainer = $('#products-container-' + areaIndex);
    productsContainer.empty();

    for (var i = 0; i < numProducts; i++) {
        var count = i + 1;
        var productHtml = `
        <div class="product" data-area-index="` + areaIndex + `" data-product-index="` + i + `">
                <div class="row form-group">
                    <div class="col-md-5">
                        <select class="form-control" name="type[` + areaIndex + `][]" onchange="changeType(this, ` + areaIndex + `, ` + i + `)">">                
                            <option value="Curtain">Curtain</option>
                            <option value="Blind">Blind</option>
                        </select>
                    </div>
                    

                    <div class="col-md-5">
                <div class="curtain" id="curtain-` + areaIndex + `-` + i + `" style="display: block;">
                    <label style="white-space: nowrap;">Width: <input type="text" name="curtain-width[` + areaIndex + `][]" class="form-control" style="display: inline;"  onload="changeFabricPrice(this, ` + areaIndex + `, ` + i + `)" onchange="changeFabricPrice(this, ` + areaIndex + `, ` + i + `); changeDesign(this, ` + areaIndex + `, ` + i + `); changeFabricSize(this, ` + areaIndex + `, ` + i + `); changeTrack(this, ` + areaIndex + `, ` + i + `)"></label>
                    <br>
                    <label style="white-space: nowrap;">Height: <input type="text" name="curtain-height[` + areaIndex + `][]" class="form-control" style="display: inline;"  onload="changeFabricPrice(this, ` + areaIndex + `, ` + i + `)" onchange="changeFabricPrice(this, ` + areaIndex + `, ` + i + `); changeDesign(this, ` + areaIndex + `, ` + i + `); changeFabricSize(this, ` + areaIndex + `, ` + i + `); changeTrack(this, ` + areaIndex + `, ` + i + `)"></label>
                    <br>
                    <label style="white-space: nowrap;">Unit: 
                        <select class="form-control" style="display: inline;" name="curtain_unit[` + areaIndex + `][]" id="curtain_unit`+count+`" onchange="changeFabricPrice(this, ` + areaIndex + `, ` + i + `)">
                            <option value="inch">inch</option>
                            <option value="mm">mm</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Brand: 
                        <select class="form-control" style="display: inline;" name="brand[` + areaIndex + `][]" onchange="changeCurtain(this, ` + areaIndex + `, ` + i + `); changeFabricPrice(this, ` + areaIndex + `, ` + i + `)" id="brand`+count+`">
<?php
$i = 0;
$sql = "SELECT SUBSTRING_INDEX(product, ' - ', 1) AS a FROM product_list WHERE type = 'Curtain' AND center_id = '".$_SESSION['center_id']."' GROUP BY a;";
// $sql = "SELECT * FROM product_list WHERE type = 'Curtain' AND center_id = '".$_SESSION['center_id']."';";
// echo $sql;
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                            <option value="0" style="display:none;"></option>
                            <option value="<?php echo $myrow['a'];?>"><?php echo $myrow['a'];?></option>
<?php }?>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Fabric Code: 

                        <select id="Jotex`+count+`" class="form-control" style="display: inline;" name="Jotex[` + areaIndex + `][]" onload="changeFabricSize(this, ` + areaIndex + `, ` + i + `)" onchange="changeFabricSize(this, ` + areaIndex + `, ` + i + `); changeFabricPrice(this, ` + areaIndex + `, ` + i + `)">
<?php
$sql = "SELECT * FROM product_list WHERE product LIKE '%Jotex - %' AND center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
?>
                            <option value="0" style="display:none;"></option>
                            <option value="<?php echo $myrow['id']."|".$myrow['fabric_size']."|".$myrow['price'];?>"><?php echo $temp[1];?></option>
<?php }?>
                        </select>
                        <select id="PRO`+count+`" class="form-control" style="display: none;" name="PRO[` + areaIndex + `][]" onload="changeFabricSize(this, ` + areaIndex + `, ` + i + `)" onchange="changeFabricSize(this, ` + areaIndex + `, ` + i + `); changeFabricPrice(this, ` + areaIndex + `, ` + i + `)">
<?php
$sql = "SELECT * FROM product_list WHERE product LIKE '%PRO - %' AND center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
?>
                            <option value="0" style="display:none;"></option>
                            <option value="<?php echo $myrow['id']."|".$myrow['fabric_size']."|".$myrow['price'];?>"><?php echo $temp[1];?></option>
<?php }?>
                        </select>
                        <select id="ZM`+count+`" class="form-control" style="display: none;" name="ZM[` + areaIndex + `][]" onload="changeFabricSize(this, ` + areaIndex + `, ` + i + `)" onchange="changeFabricSize(this, ` + areaIndex + `, ` + i + `); changeFabricPrice(this, ` + areaIndex + `, ` + i + `)">
<?php
$sql = "SELECT * FROM product_list WHERE product LIKE '%ZM - %' AND center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
?>
                            <option value="0" style="display:none;"></option>
                            <option value="<?php echo $myrow['id']."|".$myrow['fabric_size']."|".$myrow['price'];?>"><?php echo $temp[1];?></option>
<?php }?>
                        </select>


                    </label>
                    <br>
                    <label>Fabric Size: <span id="fabric_size-` + areaIndex + `-` + i + `"></span></label>
                    <br>
                    <label>Fabric Price: <span id="fabric_price`+count+`"></span></label>
                    <br>
                    
                     <label style="white-space: nowrap;">Design: 
                        <select class="form-control" style="display: inline;" name="design_id[` + areaIndex + `][]" id="design`+count+`" onload="changeDesign(`+count+`)" onchange="changeDesign(`+count+`)">
<?php
$sql = "SELECT * FROM design_list WHERE center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);     
while ($myrow = mysqli_fetch_array($res)) {?>
                            <option value="<?php echo $myrow['id']."|".$myrow['price_within']."|".$myrow['price_above']?>"><?php echo $myrow['name'];?></option>
<?php }?>
                        </select>
                    </label>
                    
                    <br>
                    <label style="white-space: nowrap;">Sewing Price: <span id="design_price`+count+`"></span></label>
                    <br>
                    <label style="white-space: nowrap;">Track: 
                        <select class="form-control" style="display: inline;" name="track_id[` + areaIndex + `][]" id="track`+count+`" onchange="changeTrack(`+count+`)">
                            <option value="0|0">No Need</option>
<?php
$sql = "SELECT * FROM track_list WHERE center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                            <option value="<?php echo $myrow['id']."|".$myrow['price'];?>"><?php echo $myrow['name'];?></option>
<?php }?>
                        </select>
                    </label>
                    
                    
                    <br>
                    <label style="white-space: nowrap;">Track Price: <span id="track_price`+count+`"></span></label>
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


                <div class="blind" id="blind-` + areaIndex + `-` + i + `" style="display: none;">
                    <label style="white-space: nowrap;">Width: <input type="text" name="blind_width[` + areaIndex + `][]" class="form-control" style="display: inline;" id="blind_width`+count+`" value="0" onchange="changePrice(`+count+`)"></label>
                    <br>
                    <label style="white-space: nowrap;">Height: <input type="text" name="blind_height[` + areaIndex + `][]" class="form-control" style="display: inline;" id="blind_height`+count+`" value="0" onchange="changePrice(`+count+`)"></label>
                    <br>
                    <label style="white-space: nowrap;">Unit: 
                        <select class="form-control" style="display: inline;" name="blind_unit[` + areaIndex + `][]" id="blind_unit`+count+`" onchange="changePrice(`+count+`)">
                            <option value="inch">inch</option>
                            <option value="mm">mm</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Type: 
                        <select class="form-control" style="display: inline;" name="brand[` + areaIndex + `][]" id="brand`+count+`" onchange="changeBlind(this.value, `+count+`); changePrice(`+count+`)">
<?php
$i = 0;
$sql = "SELECT SUBSTRING_INDEX(product, ' - ', 1) AS a FROM product_list WHERE type = 'Blind' AND center_id = '".$_SESSION['center_id']."' GROUP BY a;";
// echo $sql;
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                            <option value="<?php echo str_replace(" ", "_", $myrow['a']);?>"><?php echo $myrow['a'];?></option>
<?php }?>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Code: 
                        <select id="Roller_Blind`+count+`" class="form-control" style="display: inline;" name="Roller_Blind[` + areaIndex + `][]"  onchange="changePrice(`+count+`)">

<?php
$sql = "SELECT * FROM product_list WHERE product LIKE '%Roller Blind - %' AND center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
?>
                            <option value="0" style="display:none;"></option>
                            <option value="<?php echo $myrow['id']."|".$myrow['price'];?>"><?php echo $temp[1];?></option>
                            
                            
                            
                            
<?php }?>
                        </select>
                        <select id="Venetian_Blind`+count+`" class="form-control" style="display: none;" name="Venetian_Blind[` + areaIndex + `][]" onchange="changePrice(`+count+`)">

<?php
$sql = "SELECT * FROM product_list WHERE product LIKE '%Venetian Blind - %' AND center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
?>
                            <option value="0" style="display:none;"></option>
                            <option value="<?php echo $myrow['id']."|".$myrow['price'];?>"><?php echo $temp[1];?></option>
<?php }?>
                        </select>
                        <select id="Vertical_Blind`+count+`" class="form-control" style="display: none;" name="Vertical_Blind[` + areaIndex + `][]" onchange="changePrice(`+count+`)">

<?php
$sql = "SELECT * FROM product_list WHERE product LIKE '%Vertical Blind - %' AND center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
?>
                            <option value="0" style="display:none;"></option>
                            <option value="<?php echo $myrow['id']."|".$myrow['price'];?>"><?php echo $temp[1];?></option>
<?php }?>|
                        </select>
                        <select id="Zebra_Blind`+count+`" class="form-control" style="display: none;" name="Zebra_Blind[` + areaIndex + `][]" onchange="changePrice(`+count+`)">

<?php
$sql = "SELECT * FROM product_list WHERE product LIKE '%Zebra Blind - %' AND center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $temp = explode(" - ", $myrow['product']);
?>                          <option value="0" style="display:none;"></option>
                            <option value="<?php echo $myrow['id']."|".$myrow['price'];?>"><?php echo $temp[1];?></option>
<?php }?>
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
                    <label style="white-space: nowrap;">Pulley:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Left">Left</option>
                            <option value="Right">Right</option>
                        </select>
                    </label>
                    <br>


                    <label style="white-space: nowrap;">Headtype:
                        <select class="form-control" style="display: inline;" name="">
                            <option value="Left">Headrail</option>
                            <option value="Right">Pelmet</option>
                        </select>
                    </label>
                    <br>


                    <label style="white-space: nowrap;">Installation:
                        <select class="form-control" style="display: inline;" name="install[` + areaIndex + `][]" id="install`+count+`" onchange="changePrice(`+count+`)">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </label>
                    <br>
                    <label style="white-space: nowrap;">Price: <span id="final_price`+count+`"></span></label>
                </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        `;

        productsContainer.append(productHtml);
    }
}

    localStorage.clear();
    $(document).ready(function() {
        $(".add_item_btn").click(function(e) {
            e.preventDefault ();
            var count = clickCounter();
             $("#show_item").append (``);
        });
    });
    
    
// $(document).ready(function() {
//     var widthCounter = 1; // initialize width counter
//     var nameCounter = 1;

//     // Attach event listener to parent element that exists in the DOM
//     $(document).on("click", ".add_layer_btn", function(e) {
//         e.preventDefault();

//         var widthValue = $("#curtain_width" + widthCounter).val(); // get width value from current row
//         var nameAreaValue = $("#name_area" + nameCounter).val(); // get name_area value from current row
//         widthCounter++; // increment width counter
//         nameCounter++;

//         $("#show_item").append(`
//             <div class="row form-group">
//                 <div class="col-md-2"></div>
//                 <div class="col-md-1"><label>` + nameCounter + `.</label></div>
//                 <div class="col-md-2">
                    
//                     <input type="text" name="name_area[]" class="form-control" id="name_area` + nameCounter + `" value="` + nameAreaValue + `" ` + (nameCounter > 1 ? 'readonly="readonly"' : '') + `">
                
//                 </div>
//                 <div >
//                     <input type="submit" value="Add Layer" class="add_layer_btn btn btn-success">
//                 </div>
//                 <div class="col-md-2">
//                     <select class="form-control"  name="type[]" onchange="changeType(this.value, ` + nameCounter + `)">
//                         <option value="Curtain">Curtain</option>
//                         <option value="Blind">Blind</option>
//                     </select>
//                 </div>
//                 <div class="col-md-3">
//                     <div id="curtain` + nameCounter + `" style="display: block;">
//                         <label style="white-space: nowrap;">Width: <input type="text" name="width[]" class="form-control" style="display: inline;" id="curtain_width` + nameCounter + `" value="` + widthValue + `" ` + (nameCounter > 1 ? 'readonly' : '') + ` onchange="changeFabricPrice(` + nameCounter + `); changeDesign(` + nameCounter + `); changeFabricSize(` + nameCounter + `); changeTrack(` + nameCounter + `)"></label>
                        

//                     </div>
//                 </div>
//             </div>
//         `);
//     });
// });
 
    let areaCounter = 1;
    
    // Function to add another area input field
   function addArea() {
        var areaContainer = $('#area-container');
        var areaIndex = areaContainer.children('.area').length;
        var areaHtml = `
        <div class="area"></div>
                    <div class="col-md-1"><label> 1.</label></div>
                
                    <div class="col-md-2">
                        <input type="text" name="name_area[]" id="name_area" class="form-control" required>
                        
                    </div>
                <div class="col-md-1">
                    <input type="number" name="num_products[]"  class="form-control" onchange="addProducts(this, ` + areaIndex + `)">
                </div>
                
                <div class="products-container" id="products-container-` + areaIndex + `"></div>
                
                    <div class="col-md-2"></div>`;

        areaContainer.append(areaHtml);

        addProducts(areaContainer.find('[name="num_products[]"]').last(), areaIndex);
    }

    function clickCounter() {
        if (typeof(Storage) !== "undefined") {
            if (localStorage.clickcount) {
                localStorage.clickcount = Number(localStorage.clickcount) + 1;
            } else {
                localStorage.clickcount = 2;
            }
            return localStorage.clickcount;
        }
    }

//     function changeType(value, count) {
//     // Hide all product options
//     $('.curtain' + count + ', .blind' + count).hide();

//     // Show product options based on selected type
//     if (value === 'Curtain') {
//         $('.curtain' + count).show();
//     } else if (value === 'Blind') {
//         $('.blind' + count).show();
//     }
// }

   function changeType(selectElement) {
    var selectedValue = selectElement.value;
    var productElement = $(selectElement).closest('.product');
    var areaIndex = productElement.data('area-index');
    var productIndex = productElement.data('product-index');
    var curtainElement = $('#curtain-' + areaIndex + '-' + productIndex);
    var blindElement = $('#blind-' + areaIndex + '-' + productIndex);

    if (selectedValue === 'Curtain') {
        curtainElement.show();
        blindElement.hide();
    } else if (selectedValue === 'Blind') {
        curtainElement.hide();
        blindElement.show();
    }
}

    function changeCurtain(input, x) {
        var jotex = document.getElementById("Jotex".concat(x));
        var pro = document.getElementById("PRO".concat(x));
        var zm = document.getElementById("ZM".concat(x));
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

    function changeBlind(input, x) {
        var roller = document.getElementById("Roller_Blind".concat(x));
        var venetian = document.getElementById("Venetian_Blind".concat(x));
        var vertical = document.getElementById("Vertical_Blind".concat(x));
        var zebra = document.getElementById("Zebra_Blind".concat(x));
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

    function changeFabricSize(x) {
        var brand = document.getElementById("brand".concat(x)).value;
        var code = document.getElementById(brand.concat(x)).value;
        const temp = code.split("|");
        let fabric_size = temp[1];
        document.getElementById("fabric_size".concat(x)).innerHTML = fabric_size;
    }
    
    // Function to show the width of the selected product
    function showFabric(element, areaIndex, productIndex) {
        var width =$(element).closest('.product').find('.width').val()
        var height =$(element).closest('.product').find('.height').val()
        $('#curtain-width-' + areaIndex + '-' + productIndex).text(width + ' cm');
        $('#curtain-height-' + areaIndex + '-' + productIndex).text(height + ' cm');
}

    function changeFabricPrice(x) {
    var brand = document.getElementById("brand".concat(x)).value;
    var width = document.getElementById("curtain_width".concat(x)).value;
    var height = document.getElementById("curtain_height".concat(x)).value;
    var unit = document.getElementById("curtain_unit".concat(x)).value;
    var code = document.getElementById(brand.concat(x)).value;
    var fabric_price = 0;

    const temp = code.split("|");
    let fabric_size = temp[1];
    let price = temp[2];

    if (unit == "mm") {
        width /= 25.4;
        height /= 25.4;
    }

    if (Number(height) > 120) {
        fabric_price = Math.ceil((Math.ceil(((Math.ceil(((width * 2) + 10) / fabric_size) * (Number(height) + 10)) / 39) * 10) / 10) * price * 100) / 100;
    } else {
        fabric_price = Math.ceil((Math.ceil((((width * 2) + 10) / 39) * 10) / 10) * price * 100) / 100;
    }
    
    // Format fabric_price with "RM%0.2f" format
    document.getElementById("fabric_price".concat(x)).innerHTML = "RM" + fabric_price.toFixed(2);
}


    function changeDesign(x) {
    var width = document.getElementById("curtain_width".concat(x)).value;
    var height = document.getElementById("curtain_height".concat(x)).value;
    var unit = document.getElementById("curtain_unit".concat(x)).value;
    var design = document.getElementById("design".concat(x)).value;
    var price = 0;
    var design_price = 0;

    const temp = design.split("|");

    if (unit == "mm") {
        width /= 2.54;
        height /= 2.54;
    }

    if (Number(height) > 120) {
        price = temp[2];
    } else {
        price = temp[1];
    }

    design_price = Math.ceil(Number(width) / 12) * price;
    var formatted_design_price = "RM" + design_price.toFixed(2);
    document.getElementById("design_price".concat(x)).innerHTML = formatted_design_price;
}


    function changeTrack(x) {
    var width = document.getElementById("curtain_width".concat(x)).value;
    var unit = document.getElementById("curtain_unit".concat(x)).value;
    var track = document.getElementById("track".concat(x)).value;
    var price = 0;
    var track_price = 0;

    const temp = track.split("|");
    price = temp[1];

    if (unit == "mm") {
        width /= 2.54;
    }

    track_price = Math.ceil(Number(width) / 12) * price;
    var formatted_track_price = "RM" + track_price.toFixed(2);
    document.getElementById("track_price".concat(x)).innerHTML = formatted_track_price;
}


function changePrice(x) {
    var type = document.getElementById("type".concat(x)).value;
    var width = document.getElementById("blind_width".concat(x)).value;
    var height = document.getElementById("blind_height".concat(x)).value;
    var unit = document.getElementById("blind_unit".concat(x)).value;
    var install = document.getElementById("install".concat(x)).value;
    var code = document.getElementById(type.concat(x)).value;
    var final_price = 0;
    var area = 0;

    const temp = code.split("|");
    let price = temp[1];

    if (unit == "mm") {
        width /= 25.4;
        height /= 25.4;
    }

    area = Math.ceil((width * height) / 144);

    if (area < 20) {
        area = 20;
    }

    final_price = area * price;

    if (install == "Yes") {
        final_price += 30;
    }

    // Format final_price with "RM%0.2f" format
    document.getElementById("final_price".concat(x)).innerHTML = "RM" + final_price.toFixed(2);
}

$(window).unload(function(){
    localStorage.myPageDataArr=undefined;
});

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