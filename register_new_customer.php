<?php 
include('header.php');

$user_table = "CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    new_IC VARCHAR(255) NOT NULL,
    address_1 VARCHAR(255),
    address_2 VARCHAR(255),
    address_3 VARCHAR(255),
    address_4 VARCHAR(255),
    occupation VARCHAR(255),
    telephone_1 VARCHAR(255),
    telephone_2 VARCHAR(255),
    fax VARCHAR(255),
    gender VARCHAR(100),
    Guarantor_Name VARCHAR(255),
    Guarantor_IC VARCHAR(255),
    Guarantor_Telephone VARCHAR(255),
    Guarantor_Info VARCHAR(255),
    password  VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    customer_pic VARCHAR(255),
    customer_pic_ic VARCHAR(255),
    customer_guarantor_pic VARCHAR(255),
    user_agent_id INT(11)
)";

if (mysqli_query($conn, $user_table)) {
  
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

$success = $customer_id = $customer_name = $customer_ic = $customer_address1 = $customer_address2 = $customer_address3 = $customer_address4 = $customer_Occupation = $customer_telephone1 = $customer_telephone2 = $customer_fax = $t_gender = $customer_guaranty_name = $customer_guaranty_ic_passport = $customer_guaranty_telephone = $customer_guaranty_info = '';

if(isset($_REQUEST['cust']))
{
    $id = $_REQUEST['cust'];
    $query = "SELECT * FROM customers where id = $id";
    $result = mysqli_query($conn, $query);
    
    if($result->num_rows > 0)
    {
        
        $row = $result->fetch_assoc() ;
        $customer_id = $row['id'];
        $customer_name = $row['name'];  
        $customer_ic = $row['new_IC'];  
        $customer_address1 = $row['address_1']; 
        $customer_address2 = $row['address_2']; 
        $customer_address3 = $row['address_3']; 
        $customer_address4 = $row['address_4']; 
        $customer_Occupation = $row['occupation'];  
        $customer_telephone1 = $row['telephone_1']; 
        $customer_telephone2 = $row['telephone_2']; 
        $customer_fax = $row['fax'];    
        $t_gender = $row['gender']; 
        $customer_guaranty_name = $row['Guarantor_Name'];   
        $customer_guaranty_ic_passport = $row['Guarantor_IC'];  
        $customer_guaranty_telephone = $row['Guarantor_Telephone']; 
        $customer_guaranty_info = $row['Guarantor_Info'];
        
    }
}

if(isset($_POST['create']))
{
    $agent_id = $_SESSION["agent_id"];
    
    $customer_name = mysqli_real_escape_string($conn,$_POST['customer_name']);  
    $customer_ic =$_POST['customer_ic'];    
    $customer_address1 = mysqli_real_escape_string($conn,$_POST['customer_address1']);  
    $customer_address2 = mysqli_real_escape_string($conn,$_POST['customer_address2']);  
    $customer_address3 = mysqli_real_escape_string($conn,$_POST['customer_address3']);  
    $customer_address4 = mysqli_real_escape_string($conn,$_POST['customer_address4']);  
    $customer_Occupation = mysqli_real_escape_string($conn,$_POST['customer_Occupation']);  
    $customer_telephone1 = $_POST['customer_telephone1'];   
    $customer_telephone2 = $_POST['customer_telephone2'];   
    $customer_fax = $_POST['customer_fax']; 
    $t_gender = $_POST['t_gender']; 
    $customer_guaranty_name = mysqli_real_escape_string($conn,$_POST['customer_guaranty_name']);    
    $customer_guaranty_ic_passport = $_POST['customer_guaranty_ic_passport'];   
    $customer_guaranty_telephone = $_POST['customer_guaranty_telephone'];   
    $customer_guaranty_info = mysqli_real_escape_string($conn,$_POST['customer_guaranty_info']);
    
    if(isset($_POST['customer_edit_id']) && $_POST['customer_edit_id']!='')
    {
            
        $sql = "UPDATE customers SET
         name = '$customer_name',
         new_IC = '$customer_ic',
         address_1 = '$customer_address1',
         address_2 = '$customer_address2',
         address_3 = '$customer_address3',
         address_4 = '$customer_address4',
         occupation = '$customer_Occupation',
         telephone_1 = '$customer_telephone1',
         telephone_2 = '$customer_telephone2',
         fax = '$customer_fax',
         gender = '$t_gender',
         Guarantor_Name = '$customer_guaranty_name',
         Guarantor_IC = '$customer_guaranty_ic_passport',
         Guarantor_Telephone = '$customer_guaranty_telephone',
         Guarantor_Info = '$customer_guaranty_info' , 
         password = '',
         created_at = '".date("Y-m-d H:i:s")."',user_agent_id = $agent_id WHERE id = ".$_POST['customer_edit_id'];  
        if (mysqli_query($conn, $sql)) {
            $success = "Customer updated successfully.";
            
        } 
    }
    else
    {
            
        $sql = "INSERT INTO customers (name,new_IC,address_1,address_2,address_3,address_4,occupation,telephone_1,telephone_2,fax,gender,Guarantor_Name,Guarantor_IC,Guarantor_Telephone,Guarantor_Info, password,created_at,user_agent_id) VALUES ('$customer_name' ,'$customer_ic','$customer_address1','$customer_address2','$customer_address3','$customer_address4','$customer_Occupation','$customer_telephone1','$customer_telephone2','$customer_fax','$t_gender','$customer_guaranty_name','$customer_guaranty_ic_passport','$customer_guaranty_telephone','$customer_guaranty_info','','".date("Y-m-d H:i:s")."',$agent_id)"; 
        if (mysqli_query($conn, $sql)) {
            $success = "Customer added successfully.";
            
        } 
    }
    $customer_id = $customer_name = $customer_ic = $customer_address1 = $customer_address2 = $customer_address3 = $customer_address4 = $customer_Occupation = $customer_telephone1 = $customer_telephone2 = $customer_fax = $t_gender = $customer_guaranty_name = $customer_guaranty_ic_passport = $customer_guaranty_telephone = $customer_guaranty_info = '';
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1><?php if(isset($customer_id) && $customer_id!=''){?>Edit Customer<?php }else{?>New Customer<?php }?></h1></center>
         
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
                <div class="col-md-6">
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
            <form method="post" id="myForm">
                <input type="hidden" name="customer_edit_id" value="<?php echo $customer_id;?>"/>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_id">Customer ID</label>
                    </div>
                    <div class="col-md-6">
                        <?php 
                            if(isset($customer_id) && $customer_id!='')
                            {
                                
                        ?>
                        <span style="color:red;"><?php echo $customer_id; ?></span>
                        <?php
                            }
                            else
                            {
                        ?>
                        <span style="color:red;">Auto Generated</span>
                        <?php }?>
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
                        <label for="customer_ic">IC Number</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="customer_ic" class="form-control" required="required" value="<?php echo $customer_ic;?>"/>
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
                            <span class="span_hwe">1.</span><input type="text" name="customer_address1"  required="required" class="form-control width_hwe" value="<?php echo $customer_address1;?>"/><br/>
                        </div>
                        <br/>
                        <div>
                            <span class="span_hwe">2.</span><input type="text" name="customer_address2" class="form-control width_hwe" value="<?php echo $customer_address2;?>"/><br/>
                        </div>
                        <br/>
                        <div>
                            <span class="span_hwe">3.</span><input type="text" name="customer_address3" class="form-control width_hwe" value="<?php echo $customer_address3;?>"/><br/>
                        </div><br/>
                        <div>
                            <span class="span_hwe">4.</span><input type="text" name="customer_address4" class="form-control width_hwe" value="<?php echo $customer_address4;?>"/><br/>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_Occupation">Occupation</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="customer_Occupation" class="form-control"  required="required" value="<?php echo $customer_Occupation;?>"/>
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
                        <div>
                            <span class="span_hwe">1.</span><input type="text" name="customer_telephone1"  required="required" class="form-control width_hwe" value="<?php echo $customer_telephone1;?>"/><br/>
                        </div>
                        <br/>
                        <div>
                            <span class="span_hwe">2.</span><input type="text" name="customer_telephone2" class="form-control width_hwe" value="<?php echo $customer_telephone2;?>"/><br/>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_fax">Fax</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="customer_fax" class="form-control" value="<?php echo $customer_fax;?>"/>
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
                   
                        <select name="t_gender" class="form-control" style="width:50%;"  required="required">
                            <option value="F" <?php if(isset($t_gender) && $t_gender=="F"){ echo 'selected="selected"';} ?>>Female</option>
                            <option value="M" <?php if(isset($t_gender) && $t_gender=="M"){ echo 'selected="selected"';} ?>>Male</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_guaranty_name">Guarantor Name</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="customer_guaranty_name" class="form-control" value="<?php echo $customer_guaranty_name;?>"/>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_guaranty_ic_passpost">Guarantor IC/Passport</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="customer_guaranty_ic_passport" class="form-control" value="<?php echo $customer_guaranty_ic_passport;?>"/>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_guaranty_telephone">Guarantor Phone Number</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="customer_guaranty_telephone" class="form-control" value="<?php echo $customer_guaranty_telephone;?>"/>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label for="customer_guaranty_info">Guarantor Information</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="customer_guaranty_info" class="form-control" value="<?php echo $customer_guaranty_info;?>"/>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success" name="create"><?php if(isset($customer_id) && $customer_id!=''){?>Update Customer<?php }else{?>Create Customer<?php }?></button>&nbsp;&nbsp;
                        <button type="reset" class="btn btn-success" name="reset">Reset</button>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </form>
        </div>
    </section>
    <?php
    //}
    ?>
</div>
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
