<?php 
include('header.php');
$center_id = $_SESSION['center_id'];
$show = false;
$dir="customer_pictures";

if (isset($_GET['c'])) {
    $customer_id = $_GET['c'];
    $show = true;
    $sql = "SELECT * FROM a_customer WHERE id = '".$customer_id."';";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $created_date = date("Y-m-d");
    $created_time = date("H:i:s");

    if ($_POST['function'] == "create") {
        $name = $_POST['name'];
        $race = $_POST['race'];
        $ic = $_POST['ic'];
        $gender = $_POST['gender'];
        $passport_on_hand = $_POST['passport_on_hand'];
        $martial = $_POST['martial'];
        $no_child = $_POST['no_child'];
        $current_address = $_POST['current_address'];
        $current_city = $_POST['current_city'];
        $current_post_code = $_POST['current_post_code'];
        $current_state = $_POST['current_state'];
        $current_remark = $_POST['current_remark'];
        $current_ownership = $_POST['current_ownership'];
        $current_stay = $_POST['current_stay'];
        $fixed_address = $_POST['fixed_address'];
        $fixed_city = $_POST['fixed_city'];
        $fixed_post_code = $_POST['fixed_post_code'];
        $fixed_state = $_POST['fixed_state'];
        $fixed_remark = $_POST['fixed_remark'];
        $fixed_ownership = $_POST['fixed_ownership'];
        $fixed_stay = $_POST['fixed_stay'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $fb = $_POST['fb'];
        $personal_remark = $_POST['personal_remark'];
        $car_plate = $_POST['car_plate'];
        $company_name = $_POST['company_name'];
        $company_date = $_POST['company_date'];
        $employment_type = $_POST['employment_type'];
        $employment_no = $_POST['employment_no'];
        $company_address = $_POST['company_address'];
        $company_city = $_POST['company_city'];
        $company_post_code = $_POST['company_post_code'];
        $company_state = $_POST['company_state'];
        $business_remark = $_POST['business_remark'];
        $company_ownership = $_POST['company_ownership'];
        $business_type = $_POST['business_type'];
        $income_type = $_POST['income_type'];
        $occupation = $_POST['occupation'];
        $income_date = $_POST['income_date'];
        $department_position = $_POST['department_position'];
        $income_per_term = $_POST['income_per_term'];
        $company_tel = $_POST['company_tel'];
        $company_remark = $_POST['company_remark'];
        $guarantor1_name = $_POST['guarantor1_name'];
        $guarantor1_relationship = $_POST['guarantor1_relationship'];
        $guarantor1_ic = $_POST['guarantor1_ic'];
        $guarantor1_verify = $_POST['guarantor1_verify'];
        $guarantor1_tel = $_POST['guarantor1_tel'];
        $guarantor2_name = $_POST['guarantor2_name'];
        $guarantor2_relationship = $_POST['guarantor2_relationship'];
        $guarantor2_ic = $_POST['guarantor2_ic'];
        $guarantor2_verify = $_POST['guarantor2_verify'];
        $guarantor2_tel = $_POST['guarantor2_tel'];
        $bank_name = $_POST['bank_name'];
        $bank_card = $_POST['bank_card'];
        $bank_account = $_POST['bank_account'];
        $bank_pin = $_POST['bank_pin'];
        $bank_holder = $_POST['bank_holder'];
        $bank_remark = $_POST['bank_remark'];

        $dir="customer_pictures";
        $rename = 'upload'.date('Ymd').time();

        if (!is_dir($dir."/".$rename)) {
            mkdir($dir."/".$rename);
        }

        $temp1 = "";
        $temp2 = "";

        if (isset($_FILES['ic_copy']['name']) && $_FILES['ic_copy']['name'] != "") {
            $ic_copy = $_FILES['ic_copy']['name'];
            move_uploaded_file($_FILES['ic_copy']['tmp_name'], $dir."/".$rename."/".$ic_copy);
            $temp1 .= ", ic_copy";
            $temp2 .= ", '".$rename."/".$ic_copy."'";
        }

        if (isset($_FILES['portrait']['name']) && $_FILES['portrait']['name'] != "") {
            $portrait = $_FILES['portrait']['name'];
            move_uploaded_file($_FILES['portrait']['tmp_name'], $dir."/".$rename."/".$portrait);
            $temp1 .= ", portrait";
            $temp2 .= ", '".$rename."/".$portrait."'";
        }

        if (isset($_FILES['ctos']['name']) && $_FILES['ctos']['name'] != "") {
            $ctos = $_FILES['ctos']['name'];
            move_uploaded_file($_FILES['ctos']['tmp_name'], $dir."/".$rename."/".$ctos);
            $temp1 .= ", ctos";
            $temp2 .= ", '".$rename."/".$ctos."'";
        }

        if (isset($_FILES['photo_consent']['name']) && $_FILES['photo_consent']['name'] != "") {
            $photo_consent = $_FILES['photo_consent']['name'];
            move_uploaded_file($_FILES['photo_consent']['tmp_name'], $dir."/".$rename."/".$photo_consent);
            $temp1 .= ", photo_consent";
            $temp2 .= ", '".$rename."/".$photo_consent."'";
        }

        if (isset($_FILES['vehicle_photo']['name']) && $_FILES['vehicle_photo']['name'] != "") {
            $vehicle_photo = $_FILES['vehicle_photo']['name'];
            move_uploaded_file($_FILES['vehicle_photo']['tmp_name'], $dir."/".$rename."/".$vehicle_photo);
            $temp1 .= ", vehicle_photo";
            $temp2 .= ", '".$rename."/".$vehicle_photo."'";
        }

        if (isset($_FILES['bank_statement1']['name']) && $_FILES['bank_statement1']['name'] != "") {
            $bank_statement1 = $_FILES['bank_statement1']['name'];
            move_uploaded_file($_FILES['bank_statement1']['tmp_name'], $dir."/".$rename."/".$bank_statement1);
            $temp1 .= ", bank_statement1";
            $temp2 .= ", '".$rename."/".$bank_statement1."'";
        }

        if (isset($_FILES['bank_statement2']['name']) && $_FILES['bank_statement2']['name'] != "") {
            $bank_statement2 = $_FILES['bank_statement2']['name'];
            move_uploaded_file($_FILES['bank_statement2']['tmp_name'], $dir."/".$rename."/".$bank_statement2);
            $temp1 .= ", bank_statement2";
            $temp2 .= ", '".$rename."/".$bank_statement2."'";
        }

        if (isset($_FILES['bank_statement3']['name']) && $_FILES['bank_statement3']['name'] != "") {
            $bank_statement3 = $_FILES['bank_statement3']['name'];
            move_uploaded_file($_FILES['bank_statement3']['tmp_name'], $dir."/".$rename."/".$bank_statement3);
            $temp1 .= ", bank_statement3";
            $temp2 .= ", '".$rename."/".$bank_statement3."'";
        }

        if (isset($_FILES['pay_slip1']['name']) && $_FILES['pay_slip1']['name'] != "") {
            $pay_slip1 = $_FILES['pay_slip1']['name'];
            move_uploaded_file($_FILES['pay_slip1']['tmp_name'], $dir."/".$rename."/".$pay_slip1);
            $temp1 .= ", pay_slip1";
            $temp2 .= ", '".$rename."/".$pay_slip1."'";
        }

        if (isset($_FILES['pay_slip2']['name']) && $_FILES['pay_slip2']['name'] != "") {
            $pay_slip2 = $_FILES['pay_slip2']['name'];
            move_uploaded_file($_FILES['pay_slip2']['tmp_name'], $dir."/".$rename."/".$pay_slip2);
            $temp1 .= ", pay_slip2";
            $temp2 .= ", '".$rename."/".$pay_slip2."'";
        }

        if (isset($_FILES['pay_slip3']['name']) && $_FILES['pay_slip3']['name'] != "") {
            $pay_slip3 = $_FILES['pay_slip3']['name'];
            move_uploaded_file($_FILES['pay_slip3']['tmp_name'], $dir."/".$rename."/".$pay_slip3);
            $temp1 .= ", pay_slip3";
            $temp2 .= ", '".$rename."/".$pay_slip3."'";
        }

        $sql = "INSERT INTO a_customer (center_id, name, race, ic, gender, passport_on_hand, martial, no_child, current_address, current_city, current_post_code, current_state, current_remark, current_ownership, current_stay, fixed_address, fixed_city, fixed_post_code, fixed_state, fixed_remark, fixed_ownership, fixed_stay, mobile, email, tel, fb, personal_remark, car_plate, company_name, company_date, employment_type, employment_no, company_address, company_city, company_post_code, company_state, business_remark, company_ownership, business_type, income_type, occupation, income_date, department_position, income_per_term, company_tel, company_remark, guarantor1_name, guarantor1_relationship, guarantor1_ic, guarantor1_verify, guarantor1_tel, guarantor2_name, guarantor2_relationship, guarantor2_ic, guarantor2_verify, guarantor2_tel, bank_name, bank_card, bank_account, bank_pin, bank_holder, bank_remark, created_date, created_time".$temp1.") VALUES ('".$center_id."', '".$name."', '".$race."', '".$ic."', '".$gender."', '".$passport_on_hand."', '".$martial."', '".$no_child."', '".$current_address."', '".$current_city."', '".$current_post_code."', '".$current_state."', '".$current_remark."', '".$current_ownership."', '".$current_stay."', '".$fixed_address."', '".$fixed_city."', '".$fixed_post_code."', '".$fixed_state."', '".$fixed_remark."', '".$fixed_ownership."', '".$fixed_stay."', '".$mobile."', '".$email."', '".$tel."', '".$fb."', '".$personal_remark."', '".$car_plate."', '".$company_name."', '".$company_date."', '".$employment_type."', '".$employment_no."', '".$company_address."', '".$company_city."', '".$company_post_code."', '".$company_state."', '".$business_remark."', '".$company_ownership."', '".$business_type."', '".$income_type."', '".$occupation."', '".$income_date."', '".$department_position."', '".$income_per_term."', '".$company_tel."', '".$company_remark."', '".$guarantor1_name."', '".$guarantor1_relationship."', '".$guarantor1_ic."', '".$guarantor1_verify."', '".$guarantor1_tel."', '".$guarantor2_name."', '".$guarantor2_relationship."', '".$guarantor2_ic."', '".$guarantor2_verify."', '".$guarantor2_tel."', '".$bank_name."', '".$bank_card."', '".$bank_account."', '".$bank_pin."', '".$bank_holder."', '".$bank_remark."', '".$created_date."', '".$created_time."'".$temp2.");";

        // echo $sql;
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Created successfully.')</script>";
            echo "<script>window.location = 'customer_list.php';</script>";
        }
    } elseif ($_POST['function'] == "update") {
        $no_child = $_POST['no_child'];
        $current_address = $_POST['current_address'];
        $current_city = $_POST['current_city'];
        $current_post_code = $_POST['current_post_code'];
        $current_state = $_POST['current_state'];
        $current_remark = $_POST['current_remark'];
        $current_ownership = $_POST['current_ownership'];
        $current_stay = $_POST['current_stay'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $fb = $_POST['fb'];
        $personal_remark = $_POST['personal_remark'];
        $car_plate = $_POST['car_plate'];
        $company_name = $_POST['company_name'];
        $company_date = $_POST['company_date'];
        $employment_type = $_POST['employment_type'];
        $employment_no = $_POST['employment_no'];
        $company_address = $_POST['company_address'];
        $company_city = $_POST['company_city'];
        $company_post_code = $_POST['company_post_code'];
        $company_state = $_POST['company_state'];
        $business_remark = $_POST['business_remark'];
        $company_ownership = $_POST['company_ownership'];
        $business_type = $_POST['business_type'];
        $income_type = $_POST['income_type'];
        $occupation = $_POST['occupation'];
        $income_date = $_POST['income_date'];
        $department_position = $_POST['department_position'];
        $income_per_term = $_POST['income_per_term'];
        $company_tel = $_POST['company_tel'];
        $company_remark = $_POST['company_remark'];
        $guarantor1_name = $_POST['guarantor1_name'];
        $guarantor1_relationship = $_POST['guarantor1_relationship'];
        $guarantor1_ic = $_POST['guarantor1_ic'];
        $guarantor1_verify = $_POST['guarantor1_verify'];
        $guarantor1_tel = $_POST['guarantor1_tel'];
        $guarantor2_name = $_POST['guarantor2_name'];
        $guarantor2_relationship = $_POST['guarantor2_relationship'];
        $guarantor2_ic = $_POST['guarantor2_ic'];
        $guarantor2_verify = $_POST['guarantor2_verify'];
        $guarantor2_tel = $_POST['guarantor2_tel'];
        $bank_name = $_POST['bank_name'];
        $bank_card = $_POST['bank_card'];
        $bank_account = $_POST['bank_account'];
        $bank_pin = $_POST['bank_pin'];
        $bank_holder = $_POST['bank_holder'];
        $bank_remark = $_POST['bank_remark'];

        $sql = "UPDATE a_customer SET no_child = '".$no_child."', current_address = '".$current_address."', current_city = '".$current_city."', current_post_code = '".$current_post_code."', current_state = '".$current_state."', current_remark = '".$current_remark."', current_ownership = '".$current_ownership."', current_stay = '".$current_stay."', mobile = '".$mobile."', email = '".$email."', tel = '".$tel."', fb = '".$fb."', personal_remark = '".$personal_remark."', car_plate = '".$car_plate."', company_name = '".$company_name."', company_date = '".$company_date."', employment_type = '".$employment_type."', employment_no = '".$employment_no."', company_address = '".$company_address."', company_city = '".$company_city."', company_post_code = '".$company_post_code."', company_state = '".$company_state."', business_remark = '".$business_remark."', company_ownership = '".$company_ownership."', business_type = '".$business_type."', income_type = '".$income_type."', occupation = '".$occupation."', income_date = '".$income_date."', department_position = '".$department_position."', income_per_term = '".$income_per_term."', company_tel = '".$company_tel."', company_remark = '".$company_remark."', guarantor1_name = '".$guarantor1_name."', guarantor1_relationship = '".$guarantor1_relationship."', guarantor1_ic = '".$guarantor1_ic."', guarantor1_verify = '".$guarantor1_verify."', guarantor1_tel = '".$guarantor1_tel."', guarantor2_name = '".$guarantor2_name."', guarantor2_relationship = '".$guarantor2_relationship."', guarantor2_ic = '".$guarantor2_ic."', guarantor2_verify = '".$guarantor2_verify."', guarantor2_tel = '".$guarantor2_tel."', bank_name = '".$bank_name."', bank_card = '".$bank_card."', bank_account = '".$bank_account."', bank_pin = '".$bank_pin."', bank_holder = '".$bank_holder."', bank_remark = '".$bank_remark."'";

        $dir="customer_pictures";
        $rename = 'upload'.date('Ymd').time();

        if (!is_dir($dir."/".$rename)) {
            mkdir($dir."/".$rename);
        }

        if (isset($_FILES['ic_copy']['name']) && $_FILES['ic_copy']['name'] != "") {
            $ic_copy = $_FILES['ic_copy']['name'];
            move_uploaded_file($_FILES['ic_copy']['tmp_name'], $dir."/".$rename."/".$ic_copy);
            $sql .= ", ic_copy = '".$rename."/".$ic_copy."'";
        }

        if (isset($_FILES['portrait']['name']) && $_FILES['portrait']['name'] != "") {
            $portrait = $_FILES['portrait']['name'];
            move_uploaded_file($_FILES['portrait']['tmp_name'], $dir."/".$rename."/".$portrait);
            $sql .= ", portrait = '".$rename."/".$portrait."'";
        }

        if (isset($_FILES['ctos']['name']) && $_FILES['ctos']['name'] != "") {
            $ctos = $_FILES['ctos']['name'];
            move_uploaded_file($_FILES['ctos']['tmp_name'], $dir."/".$rename."/".$ctos);
            $sql .= ", ctos = '".$rename."/".$ctos."'";
        }

        if (isset($_FILES['photo_consent']['name']) && $_FILES['photo_consent']['name'] != "") {
            $photo_consent = $_FILES['photo_consent']['name'];
            move_uploaded_file($_FILES['photo_consent']['tmp_name'], $dir."/".$rename."/".$photo_consent);
            $sql .= ", photo_consent = '".$rename."/".$photo_consent."'";
        }

        if (isset($_FILES['vehicle_photo']['name']) && $_FILES['vehicle_photo']['name'] != "") {
            $vehicle_photo = $_FILES['vehicle_photo']['name'];
            move_uploaded_file($_FILES['vehicle_photo']['tmp_name'], $dir."/".$rename."/".$vehicle_photo);
            $sql .= ", vehicle_photo = '".$rename."/".$vehicle_photo."'";
        }

        if (isset($_FILES['bank_statement1']['name']) && $_FILES['bank_statement1']['name'] != "") {
            $bank_statement1 = $_FILES['bank_statement1']['name'];
            move_uploaded_file($_FILES['bank_statement1']['tmp_name'], $dir."/".$rename."/".$bank_statement1);
            $sql .= ", bank_statement1 = '".$rename."/".$bank_statement1."'";
        }

        if (isset($_FILES['bank_statement2']['name']) && $_FILES['bank_statement2']['name'] != "") {
            $bank_statement2 = $_FILES['bank_statement2']['name'];
            move_uploaded_file($_FILES['bank_statement2']['tmp_name'], $dir."/".$rename."/".$bank_statement2);
            $sql .= ", bank_statement2 = '".$rename."/".$bank_statement2."'";
        }

        if (isset($_FILES['bank_statement3']['name']) && $_FILES['bank_statement3']['name'] != "") {
            $bank_statement3 = $_FILES['bank_statement3']['name'];
            move_uploaded_file($_FILES['bank_statement3']['tmp_name'], $dir."/".$rename."/".$bank_statement3);
            $sql .= ", bank_statement3 = '".$rename."/".$bank_statement3."'";
        }

        if (isset($_FILES['pay_slip1']['name']) && $_FILES['pay_slip1']['name'] != "") {
            $pay_slip1 = $_FILES['pay_slip1']['name'];
            move_uploaded_file($_FILES['pay_slip1']['tmp_name'], $dir."/".$rename."/".$pay_slip1);
            $sql .= ", pay_slip1 = '".$rename."/".$pay_slip1."'";
        }

        if (isset($_FILES['pay_slip2']['name']) && $_FILES['pay_slip2']['name'] != "") {
            $pay_slip2 = $_FILES['pay_slip2']['name'];
            move_uploaded_file($_FILES['pay_slip2']['tmp_name'], $dir."/".$rename."/".$pay_slip2);
            $sql .= ", pay_slip2 = '".$rename."/".$pay_slip2."'";
        }

        if (isset($_FILES['pay_slip3']['name']) && $_FILES['pay_slip3']['name'] != "") {
            $pay_slip3 = $_FILES['pay_slip3']['name'];
            move_uploaded_file($_FILES['pay_slip3']['tmp_name'], $dir."/".$rename."/".$pay_slip3);
            $sql .= ", pay_slip3 = '".$rename."/".$pay_slip3."'";
        }

        // echo $sql;

        $sql .= " WHERE id = '".$customer_id."';";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Updated successfully.')</script>";
            echo "<script>window.location = 'add_customer.php?c=".$customer_id."';</script>";
        }
    }
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center><h1>Customer List</h1></center>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container">
            <form method="post" id="myForm" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Personal Information</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
<?php
if ($show == true) {?>
                <div class="row" style="text-align: center;">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Portait</label><br>
<?php
if ($row['portrait'] != "") {?>
                        <a href="<?php echo $dir."/".$row['portrait'];?>" target="_blank"><img src="<?php echo $dir."/".$row['portrait'];?>" style="width: 146px;"></a>
<?php } else {?>
                        <div style="display: inline-block; border: dashed 2px; width: 150px; line-height: 160px; vertical-align: middle; font-weight: bold;">No Image / PDF</div>
<?php }?>
                    </div>
                    <div class="col-md-2">
                        <label>Photo Consent</label><br>
<?php
if ($row['photo_consent'] != "") {?>
                        <a href="<?php echo $dir."/".$row['photo_consent'];?>" target="_blank"><img src="<?php echo $dir."/".$row['photo_consent'];?>" style="width: 146px;"></a>
<?php } else {?>
                        <div style="display: inline-block; border: dashed 2px; width: 150px; line-height: 160px; vertical-align: middle; font-weight: bold;">No Image / PDF</div>
<?php }?>
                        <label>Customer Code: <?php echo $row['id'];?></label>
                    </div>
                    <div class="col-md-2">
                        <label>Loan Agreement</label><br>
<?php
if ($row['loan_agreement'] != "") {?>
                        <a href="<?php echo $dir."/".$row['loan_agreement'];?>" target="_blank"><img src="<?php echo $dir."/".$row['loan_agreement'];?>" style="width: 146px;"></a>
<?php } else {?>
                        <div style="display: inline-block; border: dashed 2px; width: 150px; line-height: 160px; vertical-align: middle; font-weight: bold;">No Image / PDF</div>
<?php }?>
                    </div>
                    <div class="col-md-2">
                        <label>Vehicle</label><br>
<?php
if ($row['vehicle_photo'] != "") {?>
                        <a href="<?php echo $dir."/".$row['vehicle_photo'];?>" target="_blank"><img src="<?php echo $dir."/".$row['vehicle_photo'];?>" style="width: 146px;"></a>
<?php } else {?>
                        <div style="display: inline-block; border: dashed 2px; width: 150px; line-height: 160px; vertical-align: middle; font-weight: bold;">No Image / PDF</div>
<?php }?>
                        <label>Car Plate: <?php if ($row['car_plate'] != "") { echo $row['car_plate']; } else { echo "---"; }?></label>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
<?php }?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label><span style="color: red;">*</span> Name as NRIC</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {?>
                        <label><?php echo $row['name'];?></label>
                        <input type="text" name="name" class="form-control" hidden value="<?php echo $row['name'];?>">
<?php } else {?>
                        <input type="text" name="name" class="form-control" required>
<?php }?>
                    </div>
                    <div class="col-md-2"><label><span style="color: red;">*</span> Race</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {?>
                        <label><?php echo $row['race'];?></label>
                        <input type="text" name="race" class="form-control" hidden value="<?php echo $row['race'];?>">
<?php } else {?>
                        <select name="race" class="form-control" required>
                            <option value="--- Select Race ---" selected disabled hidden>--- Select Race ---</option>
                            <option value="Malay">Malay</option>
                            <option value="Chinese">Chinese</option>
                            <option value="Indian">Indian</option>
                            <option value="Dusun">Dusun</option>
                            <option value="Iban">Iban</option>
                            <option value="Kadazan">Kadazan</option>
                            <option value="Indonesian">Indonesian</option>
                            <option value="Kristian">Kristian</option>
                            <option value="Others">Others</option>
                        </select>
<?php }?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label><span style="color: red;">*</span> IC</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {?>
                        <label><?php echo $row['ic'];?></label>
                        <input type="text" name="ic" class="form-control" placeholder="Example: 991231449999" hidden value="<?php echo $row['ic'];?>">
<?php } else {?>
                        <input type="text" name="ic" class="form-control" placeholder="Example: 991231449999" required>
<?php }?>
                    </div>
                    <div class="col-md-2"><label><span style="color: red;">*</span> Gender</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {?>
                        <label><?php echo $row['gender'];?></label>
                        <input type="text" name="gender" class="form-control" hidden value="<?php echo $row['gender'];?>">
<?php } else {?>
                        <select name="gender" class="form-control" required>
                            <option value="--- Select Gender ---" selected disabled hidden>--- Select Gender ---</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
<?php }?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Passport On Hand</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {?>
                        <label><?php echo $row['passport_on_hand'];?></label>
                        <input type="text" name="passport_on_hand" class="form-control" hidden value="<?php echo $row['passport_on_hand'];?>">
<?php } else {?>
                        <select class="form-control" name="passport_on_hand">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
<?php }?>
                    </div>
                    <div class="col-md-2"><label>Martial Status</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {
    if ($row['martial'] != "--- Select Martial Status ---") {?>
                        <label><?php echo $row['martial'];?></label>
                        <input type="text" name="martial" class="form-control" hidden value="<?php echo $row['martial'];?>">
<?php     } else {?>
                        <input type="text" name="martial" class="form-control" hidden value="<?php echo $row['martial'];?>">
<?php     }
} else {?>
                        <select class="form-control" name="martial">
                            <option value="--- Select Martial Status ---">--- Select Martial Status ---</option>
                            <option value="Single">Single</option>
                            <option value="Maried">Maried</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
<?php }?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2"><label>No. of Child</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {
    if ($row['no_child'] == "0" || $row['no_child'] == "") {?>
                        <input type="text" name="no_child" class="form-control" value="0">
<?php     } else {?>
                        <input type="text" name="no_child" class="form-control" value="<?php echo $row['no_child'];?>">
<?php     }
} else {?>
                        <input type="text" name="no_child" class="form-control">
<?php }?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
<?php 
if ($show == true) {?>
                <br>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-2"><label>BlackList</label></div>
                    <div class="col-md-2"><label>Clear</label></div>
                    <div class="col-md-2"></div>
                </div>
<?php }?>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Current Address</label></div>
                    <div class="col-md-6"><input type="text" name="current_address" class="form-control" <?php if ($show == true) { echo 'value="'.$row['current_address'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>City</label></div>
                    <div class="col-md-2"><input type="text" name="current_city" class="form-control" <?php if ($show == true) { echo 'value="'.$row['current_city'].'"'; }?>></div>
                    <div class="col-md-2"><label>Post Code</label></div>
                    <div class="col-md-2"><input type="text" name="current_post_code" class="form-control" <?php if ($show == true) { echo 'value="'.$row['current_post_code'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>State</label></div>
                    <div class="col-md-2">
                        <select name="current_state" class="form-control">
                            <option value="--- Select State ---" <?php if ($show == true) { if ($row['current_state'] == "--- Select State ---") { echo "selected"; } }?>>--- Select State ---</option>
                            <option value="Kuala Lumpur" <?php if ($show == true) { if ($row['current_state'] == "Kuala Lumpur") { echo "selected"; } }?>>Kuala Lumpur</option>
                            <option value="Selangor" <?php if ($show == true) { if ($row['current_state'] == "Selangor") { echo "selected"; } }?>>Selangor</option>
                            <option value="Putrajaya" <?php if ($show == true) { if ($row['current_state'] == "Putrajaya") { echo "selected"; } }?>>Putrajaya</option>
                            <option value="Johor" <?php if ($show == true) { if ($row['current_state'] == "Johor") { echo "selected"; } }?>>Johor</option>
                            <option value="Kedah" <?php if ($show == true) { if ($row['current_state'] == "Kedah") { echo "selected"; } }?>>Kedah</option>
                            <option value="Kelantan" <?php if ($show == true) { if ($row['current_state'] == "Kelantan") { echo "selected"; } }?>>Kelantan</option>
                            <option value="Melaka" <?php if ($show == true) { if ($row['current_state'] == "Melaka") { echo "selected"; } }?>>Melaka</option>
                            <option value="Negeri Sembilan" <?php if ($show == true) { if ($row['current_state'] == "Negeri Sembilan") { echo "selected"; } }?>>Negeri Sembilan</option>
                            <option value="Pahang" <?php if ($show == true) { if ($row['current_state'] == "Pahang") { echo "selected"; } }?>>Pahang</option>
                            <option value="Perak" <?php if ($show == true) { if ($row['current_state'] == "Perak") { echo "selected"; } }?>>Perak</option>
                            <option value="Perlis" <?php if ($show == true) { if ($row['current_state'] == "Perlis") { echo "selected"; } }?>>Perlis</option>
                            <option value="Pulau Pinang" <?php if ($show == true) { if ($row['current_state'] == "Pulau Pinang") { echo "selected"; } }?>>Pulau Pinang</option>
                            <option value="Terengganu" <?php if ($show == true) { if ($row['current_state'] == "Terengganu") { echo "selected"; } }?>>Terengganu</option>
                            <option value="Labuan" <?php if ($show == true) { if ($row['current_state'] == "Labuan") { echo "selected"; } }?>>Labuan</option>
                            <option value="Sabah" <?php if ($show == true) { if ($row['current_state'] == "Sabah") { echo "selected"; } }?>>Sabah</option>
                            <option value="Sarawak" <?php if ($show == true) { if ($row['current_state'] == "Sarawak") { echo "selected"; } }?>>Sarawak</option>
                            <option value="Others" <?php if ($show == true) { if ($row['current_state'] == "Others") { echo "selected"; } }?>>Others</option>
                        </select>
                    </div>
                    <div class="col-md-2"><label>Remark</label></div>
                    <div class="col-md-2"><input type="text" name="current_remark" class="form-control" <?php if ($show == true) { echo 'value="'.$row['current_remark'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Ownership</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="current_ownership">
                            <option value="--- Select Ownership ---" <?php if ($show == true) { if ($row['current_ownership'] == "--- Select Ownership ---") { echo "selected"; } }?>>--- Select Ownership ---</option>
                            <option value="Owner" <?php if ($show == true) { if ($row['current_ownership'] == "Owner") { echo "selected"; } }?>>Owner</option>
                            <option value="Family" <?php if ($show == true) { if ($row['current_ownership'] == "Family") { echo "selected"; } }?>>Family</option>
                            <option value="Rent" <?php if ($show == true) { if ($row['current_ownership'] == "Rent") { echo "selected"; } }?>>Rent</option>
                            <option value="Hostel" <?php if ($show == true) { if ($row['current_ownership'] == "Hostel") { echo "selected"; } }?>>Hostel</option>
                            <option value="Company" <?php if ($show == true) { if ($row['current_ownership'] == "Company") { echo "selected"; } }?>>Company</option>
                        </select>
                    </div>
                    <div class="col-md-2"><label>Staying Since</label></div>
                    <div class="col-md-2"><input type="datetime-local" name="current_stay" class="form-control" <?php if ($show == true) { echo 'value="'.$row['current_stay'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Fixed Address</label></div>
                    <div class="col-md-6">
<?php
if ($show == true) {?>
                        <label><?php echo $row['fixed_address'];?></label>
                        <input type="text" name="fixed_address" class="form-control" hidden value="<?php echo $row['fixed_address'];?>"></div>
<?php } else {?>
                        <input type="text" name="fixed_address" class="form-control"></div>
<?php }?>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>City</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {?>
                        <label><?php echo $row['fixed_city'];?></label>
                        <input type="text" name="fixed_city" class="form-control" hidden value="<?php echo $row['fixed_city'];?>"></div>
<?php } else {?>
                        <input type="text" name="fixed_city" class="form-control"></div>
<?php }?>
                    <div class="col-md-2"><label>Post Code</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {?>
                        <label><?php echo $row['fixed_post_code'];?></label>
                        <input type="text" name="fixed_post_code" class="form-control" hidden value="<?php echo $row['fixed_post_code'];?>"></div>
<?php } else {?>
                        <input type="text" name="fixed_post_code" class="form-control"></div>
<?php }?>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>State</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {
    if ($row['fixed_state'] != "--- Select State ---") {?>
                        <label><?php echo $row['fixed_state'];?></label>
<?php    }?>
                        <input type="text" name="fixed_state" class="form-control" hidden value="<?php echo $row['fixed_state'];?>">
<?php } else {?>
                        <select name="fixed_state" class="form-control">
                            <option value="--- Select State ---">--- Select State ---</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Putrajaya">Putrajaya</option>
                            <option value="Johor">Johor</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Kelantan">Kelantan</option>
                            <option value="Melaka">Melaka</option>
                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                            <option value="Pahang">Pahang</option>
                            <option value="Perak">Perak</option>
                            <option value="Perlis">Perlis</option>
                            <option value="Pulau Pinang">Pulau Pinang</option>
                            <option value="Terengganu">Terengganu</option>
                            <option value="Labuan">Labuan</option>
                            <option value="Sabah">Sabah</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Others">Others</option>
                        </select>
<?php }?>
                    </div>
                    <div class="col-md-2"><label>Remark</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {?>
                        <label><?php echo $row['fixed_remark'];?></label>
                        <input type="text" name="fixed_remark" class="form-control" hidden value="<?php echo $row['fixed_remark'];?>">
<?php } else {?>
                        <input type="text" name="fixed_remark" class="form-control">
<?php }?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Ownership</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {
    if ($row['fixed_ownership'] != "--- Select Ownership ---") {?>
                        <label><?php echo $row['fixed_ownership'];?></label>
<?php    }?>
                        <input type="text" name="fixed_ownership" class="form-control" hidden value="<?php echo $row['fixed_ownership'];?>">
<?php } else {?>
                        <select class="form-control" name="fixed_ownership">
                            <option value="--- Select Ownership ---">--- Select Ownership ---</option>
                            <option value="Owner">Owner</option>
                            <option value="Family">Family</option>
                            <option value="Rent">Rent</option>
                            <option value="Hostel">Hostel</option>
                            <option value="Company">Company</option>
                        </select>
<?php }?>
                    </div>
                    <div class="col-md-2"><label>Staying Since</label></div>
                    <div class="col-md-2">
<?php
if ($show == true) {?>
                        <label><?php echo $row['fixed_stay'];?></label>
                        <input type="datetime-local" name="fixed_stay" class="form-control" hidden value="<?php echo $row['fixed_stay'];?>">
<?php } else {?>
                        <input type="datetime-local" name="fixed_stay" class="form-control">
<?php }?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Mobile No.</label></div>
                    <div class="col-md-2"><input type="text" name="mobile" class="form-control" <?php if ($show == true) { echo 'value="'.$row['mobile'].'"'; }?>>
                    </div>
                    <div class="col-md-2"><label>Email</label></div>
                    <div class="col-md-2"><input type="email" name="email" class="form-control" <?php if ($show == true) { echo 'value="'.$row['email'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Tel No.</label></div>
                    <div class="col-md-2"><input type="text" name="tel" class="form-control" <?php if ($show == true) { echo 'value="'.$row['tel'].'"'; }?>></div>
                    <div class="col-md-2"><label>Email FB</label></div>
                    <div class="col-md-2"><input type="text" name="fb" class="form-control" <?php if ($show == true) { echo 'value="'.$row['fb'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Personal Remark</label></div>
                    <div class="col-md-2"><input type="text" name="personal_remark" class="form-control" <?php if ($show == true) { echo 'value="'.$row['personal_remark'].'"'; }?>></div>
                    <div class="col-md-2"><label>Car Plate</label></div>
                    <div class="col-md-2"><input type="text" name="car_plate" class="form-control" <?php if ($show == true) { echo 'value="'.$row['car_plate'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Employment & Company Information</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Company Name</label></div>
                    <div class="col-md-2"><input type="text" name="company_name" class="form-control" <?php if ($show == true) { echo 'value="'.$row['company_name'].'"'; }?>>
                    </div>
                    <div class="col-md-2"><label>Date Of Entry</label></div>
                    <div class="col-md-2"><input type="datetime-local" name="company_date" class="form-control" <?php if ($show == true) { echo 'value="'.$row['company_date'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Employment Type</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="employment_type">
                            <option value="--- Select Employment Type ---" <?php if ($show == true) { if ($row['employment_type'] == "--- Select Employment Type ---") { echo "selected"; } }?>>--- Select Employment Type ---</option>
                            <option value="Full Time" <?php if ($show == true) { if ($row['employment_type'] == "Full Time") { echo "selected"; } }?>>Full Time</option>
                            <option value="Part Time" <?php if ($show == true) { if ($row['employment_type'] == "Part Time") { echo "selected"; } }?>>Part Time</option>
                            <option value="Contract" <?php if ($show == true) { if ($row['employment_type'] == "Contract") { echo "selected"; } }?>>Contract</option>
                            <option value="Owner" <?php if ($show == true) { if ($row['employment_type'] == "Owner") { echo "selected"; } }?>>Owner</option>
                        </select>
                    </div>
                    <div class="col-md-2"><label>Employment No.</label></div>
                    <div class="col-md-2"><input type="text" name="employment_no" class="form-control" <?php if ($show == true) { echo 'value="'.$row['employment_no'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Office Address</label></div>
                    <div class="col-md-6"><input type="text" name="company_address" class="form-control" <?php if ($show == true) { echo 'value="'.$row['company_address'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>City</label></div>
                    <div class="col-md-2"><input type="text" name="company_city" class="form-control" <?php if ($show == true) { echo 'value="'.$row['company_city'].'"'; }?>></div>
                    <div class="col-md-2"><label>Post Code</label></div>
                    <div class="col-md-2"><input type="text" name="company_post_code" class="form-control" <?php if ($show == true) { echo 'value="'.$row['company_post_code'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>State</label></div>
                    <div class="col-md-2">
                        <select name="company_state" class="form-control">
                            <option value="--- Select State ---" <?php if ($show == true) { if ($row['company_state'] == "--- Select State ---") { echo "selected"; } }?>>--- Select State ---</option>
                            <option value="Kuala Lumpur" <?php if ($show == true) { if ($row['company_state'] == "Kuala Lumpur") { echo "selected"; } }?>>Kuala Lumpur</option>
                            <option value="Selangor" <?php if ($show == true) { if ($row['company_state'] == "Selangor") { echo "selected"; } }?>>Selangor</option>
                            <option value="Putrajaya" <?php if ($show == true) { if ($row['company_state'] == "Putrajaya") { echo "selected"; } }?>>Putrajaya</option>
                            <option value="Johor" <?php if ($show == true) { if ($row['company_state'] == "Johor") { echo "selected"; } }?>>Johor</option>
                            <option value="Kedah" <?php if ($show == true) { if ($row['company_state'] == "Kedah") { echo "selected"; } }?>>Kedah</option>
                            <option value="Kelantan" <?php if ($show == true) { if ($row['company_state'] == "Kelantan") { echo "selected"; } }?>>Kelantan</option>
                            <option value="Melaka" <?php if ($show == true) { if ($row['company_state'] == "Melaka") { echo "selected"; } }?>>Melaka</option>
                            <option value="Negeri Sembilan" <?php if ($show == true) { if ($row['company_state'] == "Negeri Sembilan") { echo "selected"; } }?>>Negeri Sembilan</option>
                            <option value="Pahang" <?php if ($show == true) { if ($row['company_state'] == "Pahang") { echo "selected"; } }?>>Pahang</option>
                            <option value="Perak" <?php if ($show == true) { if ($row['company_state'] == "Perak") { echo "selected"; } }?>>Perak</option>
                            <option value="Perlis" <?php if ($show == true) { if ($row['company_state'] == "Perlis") { echo "selected"; } }?>>Perlis</option>
                            <option value="Pulau Pinang" <?php if ($show == true) { if ($row['company_state'] == "Pulau Pinang") { echo "selected"; } }?>>Pulau Pinang</option>
                            <option value="Terengganu" <?php if ($show == true) { if ($row['company_state'] == "Terengganu") { echo "selected"; } }?>>Terengganu</option>
                            <option value="Labuan" <?php if ($show == true) { if ($row['company_state'] == "Labuan") { echo "selected"; } }?>>Labuan</option>
                            <option value="Sabah" <?php if ($show == true) { if ($row['company_state'] == "Sabah") { echo "selected"; } }?>>Sabah</option>
                            <option value="Sarawak" <?php if ($show == true) { if ($row['company_state'] == "Sarawak") { echo "selected"; } }?>>Sarawak</option>
                            <option value="Others" <?php if ($show == true) { if ($row['company_state'] == "Others") { echo "selected"; } }?>>Others</option>
                        </select>
                    </div>
                    <div class="col-md-2"><label>Remark</label></div>
                    <div class="col-md-2"><input type="text" name="business_remark" class="form-control" <?php if ($show == true) { echo 'value="'.$row['business_remark'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Ownership</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="company_ownership">
                            <option value="--- Select Ownership ---" <?php if ($show == true) { if ($row['company_ownership'] == "--- Select Ownership ---") { echo "selected"; } }?>>--- Select Ownership ---</option>
                            <option value="Owner" <?php if ($show == true) { if ($row['company_ownership'] == "Owner") { echo "selected"; } }?>>Owner</option>
                            <option value="Family" <?php if ($show == true) { if ($row['company_ownership'] == "Family") { echo "selected"; } }?>>Family</option>
                            <option value="Rent" <?php if ($show == true) { if ($row['company_ownership'] == "Rent") { echo "selected"; } }?>>Rent</option>
                            <option value="Hostel" <?php if ($show == true) { if ($row['company_ownership'] == "Hostel") { echo "selected"; } }?>>Hostel</option>
                            <option value="Company" <?php if ($show == true) { if ($row['company_ownership'] == "Company") { echo "selected"; } }?>>Company</option>
                        </select>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Business Type</label></div>
                    <div class="col-md-2"><input type="text" name="business_type" class="form-control" <?php if ($show == true) { echo 'value="'.$row['business_type'].'"'; }?>></div>
                    <div class="col-md-2"><label>Income Type</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="income_type">
                            <option value="--- Select Income Type ---" <?php if ($show == true) { if ($row['income_type'] == "--- Select Income Type ---") { echo "selected"; } }?>>--- Select Income Type ---</option>
                            <option value="Daily" <?php if ($show == true) { if ($row['income_type'] == "Daily") { echo "selected"; } }?>>Daily</option>
                            <option value="Weekly" <?php if ($show == true) { if ($row['income_type'] == "Weekly") { echo "selected"; } }?>>Weekly</option>
                            <option value="Monthly" <?php if ($show == true) { if ($row['income_type'] == "Monthly") { echo "selected"; } }?>>Monthly</option>
                            <option value="Others" <?php if ($show == true) { if ($row['income_type'] == "Others") { echo "selected"; } }?>>Others</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Occupation Category</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="occupation">
                            <option value="--- Select Occupation Category ---" <?php if ($show == true) { if ($row['occupation'] == "--- Select Occupation Category ---") { echo "selected"; } }?>>--- Select Occupation Category ---</option>
                            <option value="Sales and Promoter Related" <?php if ($show == true) { if ($row['occupation'] == "Sales and Promoter Related") { echo "selected"; } }?>>Sales and Promoter Related</option>
                            <option value="Office and Admin Related" <?php if ($show == true) { if ($row['occupation'] == "Office and Admin Related") { echo "selected"; } }?>>Office and Admin Related</option>
                            <option value="Farmer, Fisher and Market Related" <?php if ($show == true) { if ($row['occupation'] == "Farmer, Fisher and Market Related") { echo "selected"; } }?>>Farmer, Fisher and Market Related</option>
                            <option value="Hawker and Small Business Owner" <?php if ($show == true) { if ($row['occupation'] == "Hawker and Small Business Owner") { echo "selected"; } }?>>Hawker and Small Business Owner</option>
                            <option value="Hospital Related Job" <?php if ($show == true) { if ($row['occupation'] == "Hospital Related Job") { echo "selected"; } }?>>Hospital Related Job</option>
                            <option value="Food Preparation and Server" <?php if ($show == true) { if ($row['occupation'] == "Food Preparation and Server") { echo "selected"; } }?>>Food Preparation and Server</option>
                            <option value="Installation, Maintenance, Repair Related" <?php if ($show == true) { if ($row['occupation'] == "Installation, Maintenance, Repair Related") { echo "selected"; } }?>>Installation, Maintenance, Repair Related</option>
                            <option value="Legal, Goverment Related" <?php if ($show == true) { if ($row['occupation'] == "Legal, Goverment Related") { echo "selected"; } }?>>Legal, Goverment Related</option>
                            <option value="Education / Trainning" <?php if ($show == true) { if ($row['occupation'] == "Education / Trainning") { echo "selected"; } }?>>Education / Trainning</option>
                            <option value="Building and Structure" <?php if ($show == true) { if ($row['occupation'] == "Building and Structure") { echo "selected"; } }?>>Building and Structure</option>
                            <option value="Warehouse & Transportation Related Job" <?php if ($show == true) { if ($row['occupation'] == "Warehouse & Transportation Related Job") { echo "selected"; } }?>>Warehouse & Transportation Related Job</option>
                            <option value="Beauty and Saloon" <?php if ($show == true) { if ($row['occupation'] == "Beauty and Saloon") { echo "selected"; } }?>>Beauty and Saloon</option>
                            <option value="Operator & Security Related" <?php if ($show == true) { if ($row['occupation'] == "Operator & Security Related") { echo "selected"; } }?>>Operator & Security Related</option>
                            <option value="Information Technology" <?php if ($show == true) { if ($row['occupation'] == "Information Technology") { echo "selected"; } }?>>Information Technology</option>
                        </select>
                    </div>
                    <div class="col-md-2"><label>Income Date</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="income_date">
                            <option value="--- Select Income Date ---" <?php if ($show == true) { if ($row['income_date'] == "--- Select Income Date ---") { echo "selected"; } }?>>--- Select Income Date ---</option>
                            <option value="1" <?php if ($show == true) { if ($row['income_date'] == "1") { echo "selected"; } }?>>1</option>
                            <option value="2" <?php if ($show == true) { if ($row['income_date'] == "2") { echo "selected"; } }?>>2</option>
                            <option value="3" <?php if ($show == true) { if ($row['income_date'] == "3") { echo "selected"; } }?>>3</option>
                            <option value="4" <?php if ($show == true) { if ($row['income_date'] == "4") { echo "selected"; } }?>>4</option>
                            <option value="5" <?php if ($show == true) { if ($row['income_date'] == "5") { echo "selected"; } }?>>5</option>
                            <option value="6" <?php if ($show == true) { if ($row['income_date'] == "6") { echo "selected"; } }?>>6</option>
                            <option value="7" <?php if ($show == true) { if ($row['income_date'] == "7") { echo "selected"; } }?>>7</option>
                            <option value="8" <?php if ($show == true) { if ($row['income_date'] == "8") { echo "selected"; } }?>>8</option>
                            <option value="9" <?php if ($show == true) { if ($row['income_date'] == "9") { echo "selected"; } }?>>9</option>
                            <option value="10" <?php if ($show == true) { if ($row['income_date'] == "10") { echo "selected"; } }?>>10</option>
                            <option value="11" <?php if ($show == true) { if ($row['income_date'] == "11") { echo "selected"; } }?>>11</option>
                            <option value="12" <?php if ($show == true) { if ($row['income_date'] == "12") { echo "selected"; } }?>>12</option>
                            <option value="13" <?php if ($show == true) { if ($row['income_date'] == "13") { echo "selected"; } }?>>13</option>
                            <option value="14" <?php if ($show == true) { if ($row['income_date'] == "14") { echo "selected"; } }?>>14</option>
                            <option value="15" <?php if ($show == true) { if ($row['income_date'] == "15") { echo "selected"; } }?>>15</option>
                            <option value="16" <?php if ($show == true) { if ($row['income_date'] == "16") { echo "selected"; } }?>>16</option>
                            <option value="17" <?php if ($show == true) { if ($row['income_date'] == "17") { echo "selected"; } }?>>17</option>
                            <option value="18" <?php if ($show == true) { if ($row['income_date'] == "18") { echo "selected"; } }?>>18</option>
                            <option value="19" <?php if ($show == true) { if ($row['income_date'] == "19") { echo "selected"; } }?>>19</option>
                            <option value="20" <?php if ($show == true) { if ($row['income_date'] == "20") { echo "selected"; } }?>>20</option>
                            <option value="21" <?php if ($show == true) { if ($row['income_date'] == "21") { echo "selected"; } }?>>21</option>
                            <option value="22" <?php if ($show == true) { if ($row['income_date'] == "22") { echo "selected"; } }?>>22</option>
                            <option value="23" <?php if ($show == true) { if ($row['income_date'] == "23") { echo "selected"; } }?>>23</option>
                            <option value="24" <?php if ($show == true) { if ($row['income_date'] == "24") { echo "selected"; } }?>>24</option>
                            <option value="25" <?php if ($show == true) { if ($row['income_date'] == "25") { echo "selected"; } }?>>25</option>
                            <option value="26" <?php if ($show == true) { if ($row['income_date'] == "26") { echo "selected"; } }?>>26</option>
                            <option value="27" <?php if ($show == true) { if ($row['income_date'] == "27") { echo "selected"; } }?>>27</option>
                            <option value="28" <?php if ($show == true) { if ($row['income_date'] == "28") { echo "selected"; } }?>>28</option>
                            <option value="29" <?php if ($show == true) { if ($row['income_date'] == "29") { echo "selected"; } }?>>29</option>
                            <option value="30" <?php if ($show == true) { if ($row['income_date'] == "30") { echo "selected"; } }?>>30</option>
                            <option value="31" <?php if ($show == true) { if ($row['income_date'] == "31") { echo "selected"; } }?>>31</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Department & Position</label></div>
                    <div class="col-md-2"><input type="text" name="department_position" class="form-control" <?php if ($show == true) { echo 'value="'.$row['department_position'].'"'; }?>></div>
                    <div class="col-md-2"><label>Income Per Term</label></div>
                    <div class="col-md-2"><input type="text" name="income_per_term" class="form-control" <?php if ($show == true) { echo 'value="'.$row['income_per_term'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Tel No.</label></div>
                    <div class="col-md-2"><input type="text" name="company_tel" class="form-control" <?php if ($show == true) { echo 'value="'.$row['company_tel'].'"'; }?>></div>
                    <div class="col-md-2"><label>Company Remark</label></div>
                    <div class="col-md-2"><input type="text" name="company_remark" class="form-control" <?php if ($show == true) { echo 'value="'.$row['company_remark'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Family & Guarantor Information</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Name</label></div>
                    <div class="col-md-2"><input type="text" name="guarantor1_name" class="form-control" <?php if ($show == true) { echo 'value="'.$row['guarantor1_name'].'"'; }?>></div>
                    <div class="col-md-2"><label>Relationship</label></div>
                    <div class="col-md-2"><input type="text" name="guarantor1_relationship" class="form-control" <?php if ($show == true) { echo 'value="'.$row['guarantor1_relationship'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>IC</label></div>
                    <div class="col-md-2"><input type="text" name="guarantor1_ic" class="form-control" placeholder="Example: 991231449999" <?php if ($show == true) { echo 'value="'.$row['guarantor1_ic'].'"'; }?>></div>
                    <div class="col-md-2"><label>Verify</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="guarantor1_verify">
                            <option value="--- Select Verify ---" <?php if ($show == true) { if ($row['guarantor1_verify'] == "--- Select Verify ---") { echo "selected"; } }?>>--- Select Verify ---</option>
                            <option value="Verified" <?php if ($show == true) { if ($row['guarantor1_verify'] == "Verified") { echo "selected"; } }?>>Verified</option>
                            <option value="Unverified" <?php if ($show == true) { if ($row['guarantor1_verify'] == "Unverified") { echo "selected"; } }?>>Unverified</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Tel No.</label></div>
                    <div class="col-md-2"><input type="text" name="guarantor1_tel" class="form-control" <?php if ($show == true) { echo 'value="'.$row['guarantor1_tel'].'"'; }?>></div>
                    <div class="col-md-6"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Name</label></div>
                    <div class="col-md-2"><input type="text" name="guarantor2_name" class="form-control" <?php if ($show == true) { echo 'value="'.$row['guarantor2_name'].'"'; }?>></div>
                    <div class="col-md-2"><label>Relationship</label></div>
                    <div class="col-md-2"><input type="text" name="guarantor2_relationship" class="form-control" <?php if ($show == true) { echo 'value="'.$row['guarantor2_relationship'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>IC</label></div>
                    <div class="col-md-2"><input type="text" name="guarantor2_ic" class="form-control" placeholder="Example: 991231449999" <?php if ($show == true) { echo 'value="'.$row['guarantor2_ic'].'"'; }?>></div>
                    <div class="col-md-2"><label>Verify</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="guarantor2_verify">
                            <option value="--- Select Verify ---" <?php if ($show == true) { if ($row['guarantor2_verify'] == "--- Select Verify ---") { echo "selected"; } }?>>--- Select Verify ---</option>
                            <option value="Verified" <?php if ($show == true) { if ($row['guarantor2_verify'] == "Verified") { echo "selected"; } }?>>Verified</option>
                            <option value="Unverified" <?php if ($show == true) { if ($row['guarantor2_verify'] == "Unverified") { echo "selected"; } }?>>Unverified</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Tel No.</label></div>
                    <div class="col-md-2"><input type="text" name="guarantor2_tel" class="form-control" <?php if ($show == true) { echo 'value="'.$row['guarantor2_tel'].'"'; }?>></div>
                    <div class="col-md-6"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Banking Information</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Bank Name</label></div>
                    <div class="col-md-2">
                        <select name="bank_name" class="form-control">
                            <option value="--- Select Bank ---" <?php if ($show == true) { if ($row['bank_name'] == "--- Select Bank ---") { echo "selected"; } }?>>--- Select Bank ---</option>
                            <option value="Public Bank" <?php if ($show == true) { if ($row['bank_name'] == "Public Bank") { echo "selected"; } }?>>Public Bank</option>
                            <option value="Maybank" <?php if ($show == true) { if ($row['bank_name'] == "Maybank") { echo "selected"; } }?>>Maybank</option>
                            <option value="CIMB Bank" <?php if ($show == true) { if ($row['bank_name'] == "CIMB Bank") { echo "selected"; } }?>>CIMB Bank</option>
                            <option value="RHB Bank" <?php if ($show == true) { if ($row['bank_name'] == "RHB Bank") { echo "selected"; } }?>>RHB Bank</option>
                            <option value="Bank Rakyat" <?php if ($show == true) { if ($row['bank_name'] == "Bank Rakyat") { echo "selected"; } }?>>Bank Rakyat</option>
                            <option value="Bank Islam" <?php if ($show == true) { if ($row['bank_name'] == "Bank Islam") { echo "selected"; } }?>>Bank Islam</option>
                            <option value="AM Bank" <?php if ($show == true) { if ($row['bank_name'] == "AM Bank") { echo "selected"; } }?>>AM Bank</option>
                            <option value="Hong Leong Bank" <?php if ($show == true) { if ($row['bank_name'] == "Hong Leong Bank") { echo "selected"; } }?>>Hong Leong Bank</option>
                            <option value="Bank Simpanan Nasional (BSN)" <?php if ($show == true) { if ($row['bank_name'] == "Bank Simpanan Nasional (BSN)") { echo "selected"; } }?>>Bank Simpanan Nasional (BSN)</option>
                            <option value="Alliance Bank" <?php if ($show == true) { if ($row['bank_name'] == "Alliance Bank") { echo "selected"; } }?>>Alliance Bank</option>
                            <option value="Affin Bank" <?php if ($show == true) { if ($row['bank_name'] == "Affin Bank") { echo "selected"; } }?>>Affin Bank</option>
                            <option value="HSBC Bank" <?php if ($show == true) { if ($row['bank_name'] == "HSBC Bank") { echo "selected"; } }?>>HSBC Bank</option>
                            <option value="Agro Bank" <?php if ($show == true) { if ($row['bank_name'] == "Agro Bank") { echo "selected"; } }?>>Agro Bank</option>
                            <option value="Standard Chartered Bank" <?php if ($show == true) { if ($row['bank_name'] == "Standard Chartered Bank") { echo "selected"; } }?>>Standard Chartered Bank</option>
                            <option value="Muamalat Bank" <?php if ($show == true) { if ($row['bank_name'] == "Muamalat Bank") { echo "selected"; } }?>>Muamalat Bank</option>
                            <option value="UOB Bank" <?php if ($show == true) { if ($row['bank_name'] == "UOB Bank") { echo "selected"; } }?>>UOB Bank</option>
                            <option value="OCBC Bank" <?php if ($show == true) { if ($row['bank_name'] == "OCBC Bank") { echo "selected"; } }?>>OCBC Bank</option>
                            <option value="Al-Rajhi Bank" <?php if ($show == true) { if ($row['bank_name'] == "Al-Rajhi Bank") { echo "selected"; } }?>>Al-Rajhi Bank</option>
                            <option value="Citi Bank" <?php if ($show == true) { if ($row['bank_name'] == "Citi Bank") { echo "selected"; } }?>>Citi Bank</option>
                            <option value="Kuwait Finance House" <?php if ($show == true) { if ($row['bank_name'] == "Kuwait Finance House") { echo "selected"; } }?>>Kuwait Finance House</option>
                            <option value="CREDIT" <?php if ($show == true) { if ($row['bank_name'] == "CREDIT") { echo "selected"; } }?>>CREDIT</option>
                            <option value="CASH" <?php if ($show == true) { if ($row['bank_name'] == "CASH") { echo "selected"; } }?>>CASH</option>
                            <option value="BILLPLZ" <?php if ($show == true) { if ($row['bank_name'] == "BILLPLZ") { echo "selected"; } }?>>BILLPLZ</option>
                            <option value="BIZAPPAY" <?php if ($show == true) { if ($row['bank_name'] == "BIZAPPAY") { echo "selected"; } }?>>BIZAPPAY</option>
                            <option value="PAYXSPACE" <?php if ($show == true) { if ($row['bank_name'] == "PAYXSPACE") { echo "selected"; } }?>>PAYXSPACE</option>
                        </select>
                    </div>
                    <div class="col-md-2"><label>Bank Card</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="bank_card">
                            <option value="Not Available" <?php if ($show == true) { if ($row['bank_card'] == "Not Available") { echo "selected"; } }?>>Not Available</option>
                            <option value="Available" <?php if ($show == true) { if ($row['bank_card'] == "Available") { echo "selected"; } }?>>Available</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Account No.</label></div>
                    <div class="col-md-2"><input type="text" name="bank_account" class="form-control" <?php if ($show == true) { echo 'value="'.$row['bank_account'].'"'; }?>></div>
                    <div class="col-md-2"><label>Pin No.</label></div>
                    <div class="col-md-2"><input type="text" name="bank_pin" class="form-control" <?php if ($show == true) { echo 'value="'.$row['bank_pin'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Bank Holder</label></div>
                    <div class="col-md-2"><input type="text" name="bank_holder" class="form-control" <?php if ($show == true) { echo 'value="'.$row['bank_holder'].'"'; }?>></div>
                    <div class="col-md-2"><label>Remark</label></div>
                    <div class="col-md-2"><input type="text" name="bank_remark" class="form-control" <?php if ($show == true) { echo 'value="'.$row['bank_remark'].'"'; }?>></div>
                    <div class="col-md-2"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Documents</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-1"><label>IC Copy</label></div>
                    <div class="col-md-2"><input type="file" name="ic_copy"></div>
                    <div class="col-md-1"><label>Portrait</label></div>
                    <div class="col-md-2"><input type="file" name="portrait"></div>
                    <div class="col-md-1"><label>CTOS</label></div>
                    <div class="col-md-2"><input type="file" name="ctos"></div>
                    <div class="col-md-1"></div>
                </div>
                <br>
<?php
if ($show == true) {?>
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-2"><label>Customer Code: <?php echo $row['id'];?></label></div>
                    <div class="col-md-1"></div>
                </div>
                <br>
<?php }?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-1"><label>Photo Consent</label></div>
                    <div class="col-md-2"><input type="file" name="photo_consent"></div>
                    <div class="col-md-1"><label>Vehicle Photo</label></div>
                    <div class="col-md-2"><input type="file" name="vehicle_photo"></div>
                    <div class="col-md-1"></div>
                </div>
                <br>
<?php
if ($show == true) {?>
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-2"><label>Car Plate: <?php if ($row['car_plate'] != "") { echo $row['car_plate']; } else { echo "---"; }?></label></div>
                    <div class="col-md-1"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-1"><label>Loan Agreement</label></div>
                    <div class="col-md-9">
                        <!-- <input type="file" name="loan_agreement"> -->
                        <textarea style="resize: none; color: red;" disabled>Disabled, please upload in loan page below</textarea>
                    </div>
                </div>
                <hr style="border-color: lightgrey;">
<?php }?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-1"><label>Bank Statement</label></div>
                    <div class="col-md-2"><input type="file" name="bank_statement1"></div>
                    <div class="col-md-1"><label>Bank Statement</label></div>
                    <div class="col-md-2"><input type="file" name="bank_statement2"></div>
                    <div class="col-md-1"><label>Bank Statement </label></div>
                    <div class="col-md-2"><input type="file" name="bank_statement3"></div>
                    <div class="col-md-1"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-1"><label>Pay Slip</label></div>
                    <div class="col-md-2"><input type="file" name="pay_slip1"></div>
                    <div class="col-md-1"><label>Pay Slip</label></div>
                    <div class="col-md-2"><input type="file" name="pay_slip2"></div>
                    <div class="col-md-1"><label>Pay Slip</label></div>
                    <div class="col-md-2"><input type="file" name="pay_slip3"></div>
                    <div class="col-md-1"></div>
                </div>
                <br>
                <div class="row form-group">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
<?php
if ($show == true) {?>
                        <button type="submit" class="btn btn-success" name="function" value="update">Update</button>
<?php } else {?>
                        <button type="submit" class="btn btn-success" name="function" value="create">Create</button>
<?php }?>
                        &nbsp;&nbsp;
                        <button type="reset" name="reset" class="btn btn-success">Reset</button>
                    </div>
                </div>
                <br>
            </form>
        </div>
    </section>
    <br>
<?php
if ($show == true) {
    $total_loan_amount = 0;
    $total_application_fee = 0;
    $total_processing_fee = 0;
    $total_current_nett_balance = 0;
?>
    <section>
        <div class="container" style="overflow:auto;">
            <div class="row">
                <table cellspacing="0" cellpadding="2" class="table table-striped table-bordered" style="overflow:auto;">
                    <caption class="menu-header">Loan List</caption>
                    <thead style="text-align: center;">
                        <tr class="customer_table">
                            <th>NO.</th>
                            <th>Loan ID</th>
                            <th>Branch</th>
                            <th>Application Date</th>
                            <th>Period / Type</th>
                            <th>Interest</th>
                            <th>Loan Amount</th>
                            <th>Application Fee</th>
                            <th>Processing Fee</th>
                            <th>Current Nett Balance</th>
                            <th>Remark</th>
                            <th>Status</th>
                            <th>Loan Agreement</th>
                            <th>Loan Stamping</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$i = 1;
$sql = "SELECT * FROM a_loan WHERE customer = '".$customer_id."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
    $total_loan_amount += $myrow['principal_amount'];
    $total_application_fee += $myrow['application_fee'];
?>
                        <tr style="text-align: center;">
                            <td><?php echo $i++;?></td>
                            <td><?php echo $myrow['id'];?></td>
                            <td><?php echo $myrow['branch1'];?></td>
                            <td><?php echo $myrow['application_date'];?></td>
<?php
switch ($myrow['dept_type']) {
    case 'Daily':
        $period = $myrow['dept_period']." Day";
        break;
    case 'Weekly':
        $period = $myrow['dept_period']." Week";
        break;
    case 'Monthly':
        $period = $myrow['dept_period']." Month";
        break;
}?>
                            <td><?php echo $period;?></td>
                            <td><?php printf("%0.2f", $myrow['interest']); echo "%";?></td>
                            <td style="text-align: right;"><?php printf("%0.2f", $myrow['principal_amount']);?></td>
                            <td style="text-align: right;"><?php printf("%0.2f", $myrow['application_fee']);?></td>
                            <td style="text-align: right;"></td>
                            <td style="text-align: right;"></td>
                            <td><?php echo $myrow['remark'];?></td>
                            <td><?php echo $myrow['status'];?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><a href="edit_loan.php?l=<?php echo $myrow['id'];?>">Edit</a></td>
                        </tr>
<?php }?>
                    </tbody>
                    <tfoot style="text-align: right;">
                        <tr>
                            <th colspan="6">Total</th>
                            <th><?php printf("%0.2f", $total_loan_amount);?></th>
                            <th><?php printf("%0.2f", $total_application_fee);?></th>
                            <th><?php printf("%0.2f", $total_processing_fee);?></th>
                            <th><?php printf("%0.2f", $total_current_nett_balance);?></th>
                            <th colspan="6"></th>
                        </tr>
                        <tr style="text-align: center;">
                            <th colspan="16"><a href="add_loan.php?c=<?php echo $row['id'];?>" class="btn btn-success">Add More Loan</a></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
<?php }?>
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
.customer_table{
    overflow:auto
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
.btn-success
{
    background:#038603 !important;
}

</style>
