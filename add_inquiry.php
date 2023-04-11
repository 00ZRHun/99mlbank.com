<?php 
include('header.php');

$show = false;

if (isset($_GET['i']) && $_GET['i'] != "") {
    $inquiry_id = $_GET['i'];
    $sql = "SELECT * FROM inquiry WHERE id = '".$inquiry_id."';";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $show = true;
}

$agent_id = $_SESSION['agent_id'];
$center = $_SESSION['center_id'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create'])) {
        $type = $_POST['type'];
        $type2 = $_POST['type2'];
        $item = $_POST['pawn_item'];
        $website = $_POST['website'];
        $source = $_POST['source'];
        $insert_date = date("Y-m-d H:i:s");
        $branch = $_POST['branch'];
        $name = $_POST['name'];
        $ic = $_POST['ic'];
        $contact_no = $_POST['contact_no'];
        $email = $_POST['email'];
        $race = $_POST['race'];
        $gender = $_POST['gender'];
        $occupation = $_POST['occupation'];
        $job = $_POST['job'];
        $income = $_POST['income'];
        $bank_name = $_POST['bank_name'];
        $bank_acc = $_POST['bank_acc'];
        $bank_holder = $_POST['bank_holder'];
        $address = $_POST['address'];
        $post_code = $_POST['post_code'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $state_confirmation = $_POST['state_confirmation'];
        $amount = $_POST['amount'];
        $customer_remark = $_POST['customer_remark'];
        $cs_remark = $_POST['cs_remark'];
        $status = $_POST['status'];
        $cus_status = $_POST['cus_status'];
        $sql = "INSERT INTO inquiry (type, type2, item, website, source, insert_date, branch, name, ic, contact_no, email, race, gender, occupation, job, income, bank_name, bank_acc, bank_holder, address, post_code, city, state, state_confirmation, amount, customer_remark, cs_remark, status, cus_status, center, agent_id) VALUES ('".$type."', '".$type2."', '".$item."', '".$website."', '".$source."', '".$insert_date."', '".$branch."', '".$name."', '".$ic."', '".$contact_no."', '".$email."', '".$race."', '".$gender."', '".$occupation."', '".$job."', '".$income."', '".$bank_name."', '".$bank_acc."', '".$bank_holder."', '".$address."', '".$post_code."', '".$city."', '".$state."', '".$state_confirmation."', '".$amount."', '".$customer_remark."', '".$cs_remark."', '".$status."', '".$cus_status."', '".$center."', '".$agent_id."');";
            // echo $sql;
        if ($res = mysqli_query($conn, $sql)) {
            echo "<script>alert('Created successfully.')</script>";
            echo "<script>window.location = 'inquiry_list.php';</script>";
        } else {
            echo "<script>alert('Please fill out the form.')</script>";
        }
    } elseif (isset($_POST['update'])) {
        $type = $_POST['type'];
        $type2 = $_POST['type2'];
        $item = $_POST['pawn_item'];
        $website = $_POST['website'];
        $source = $_POST['source'];
        $branch = $_POST['branch'];
        $name = $_POST['name'];
        $ic = $_POST['ic'];
        $contact_no = $_POST['contact_no'];
        $email = $_POST['email'];
        $race = $_POST['race'];
        $gender = $_POST['gender'];
        $occupation = $_POST['occupation'];
        $job = $_POST['job'];
        $income = $_POST['income'];
        $bank_name = $_POST['bank_name'];
        $bank_acc = $_POST['bank_acc'];
        $bank_holder = $_POST['bank_holder'];
        $address = $_POST['address'];
        $post_code = $_POST['post_code'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $state_confirmation = $_POST['state_confirmation'];
        $amount = $_POST['amount'];
        $customer_remark = $_POST['customer_remark'];
        $cs_remark = $_POST['cs_remark'];
        $status = $_POST['status'];
        $cus_status = $_POST['cus_status'];
        $sql = "UPDATE inquiry SET type = '".$type."', type2 = '".$type2."', item = '".$item."', website = '".$website."', source = '".$source."', branch = '".$branch."', name = '".$name."', ic = '".$ic."', contact_no = '".$contact_no."', email = '".$email."', race = '".$race."', gender = '".$gender."', occupation = '".$occupation."', job = '".$job."', income = '".$income."', bank_name = '".$bank_name."', bank_acc = '".$bank_acc."', bank_holder = '".$bank_holder."', address = '".$address."', post_code = '".$post_code."', city = '".$city."', state = '".$state."', state_confirmation = '".$state_confirmation."', amount = '".$amount."', customer_remark = '".$customer_remark."', cs_remark = '".$cs_remark."', status = '".$status."', cus_status = '".$cus_status."' WHERE id = '".$inquiry_id."';";
            // echo $sql;
        if ($res = mysqli_query($conn, $sql)) {
            echo "<script>alert('Update successfully.')</script>";
            echo "<script>window.location = 'add_inquiry.php?i=".$inquiry_id."';</script>";
        } else {
            echo "<script>alert('Something error. Please try again later.')</script>";
        }
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Inquiry List</h1></center>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <a href="inquiry_list.php" class="btn btn-info">Back</a>
    <section>
    	<div class="container">
            <form method="post" id="myForm">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Inquiry Type Details</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Inquiry Type</label>
                    </div>
                    <div class="col-md-6">
                        <select name="type" class="form-control" style="width:50%;" required="required" onchange="changeType(this.value)">
                            <option value="Normal" <?php if ($show == true) { if ($row['type'] == "Normal") { echo "selected"; } }?>>Normal</option>
                            <option value="Pawn" <?php if ($show == true) { if ($row['type'] == "Pawn") { echo "selected"; } }?>>Pawn</option>
                            <option value="OBL Method" <?php if ($show == true) { if ($row['type'] == "OBL Method") { echo "selected"; } }?>>OBL Method</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
            <div id="pawn" style="display: <?php if ($show == true) { if ($row['type'] == "Pawn") { echo "block"; } else { echo "none"; } } else { echo "none"; }?>;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Inquiry Type</label>
                    </div>
                    <div class="col-md-6">
                        <select name="type2" class="form-control" style="width:50%;">
                            <option value="-- None --" <?php if ($show == true) { if ($row['type2'] == "-- None --") { echo "selected"; } }?>>-- None --</option>
                            <option value="Gold & Jewelry" <?php if ($show == true) { if ($row['type2'] == "Gold & Jewelry") { echo "selected"; } }?>>Gold & Jewelry</option>
                            <option value="Diamond & Gem" <?php if ($show == true) { if ($row['type2'] == "Diamond & Gem") { echo "selected"; } }?>>Diamond & Gem</option>
                            <option value="Luxury Watches" <?php if ($show == true) { if ($row['type2'] == "Luxury Watches") { echo "selected"; } }?>>Luxury Watches</option>
                            <option value="Luxury Bags & Garments" <?php if ($show == true) { if ($row['type2'] == "Luxury Bags & Garments") { echo "selected"; } }?>>Luxury Bags & Garments</option>
                            <option value="Electronics Goods" <?php if ($show == true) { if ($row['type2'] == "Electronics Goods") { echo "selected"; } }?>>Electronics Goods</option>
                            <option value="Others" <?php if ($show == true) { if ($row['type2'] == "Others") { echo "selected"; } }?>>Others</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Pawn Item(s)</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="pawn_item" <?php if ($show == true) { echo "value='".$row['item']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
            </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Inquiry Details</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Website</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="website" <?php if ($show == true) { echo "value='".$row['website']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Source</label>
                    </div>
                    <div class="col-md-6">
                        <select name="source" class="form-control" style="width:50%;">
                            <option value="Website" <?php if ($show == true) { if ($row['source'] == "Website") { echo "selected"; } }?>>Website</option>
                            <option value="App" <?php if ($show == true) { if ($row['source'] == "App") { echo "selected"; } }?>>App</option>
                            <option value="Leadform" <?php if ($show == true) { if ($row['source'] == "Leadform") { echo "selected"; } }?>>Leadform</option>
                            <option value="Shared" <?php if ($show == true) { if ($row['source'] == "Shared") { echo "selected"; } }?>>Shared</option>
                            <option value="Sms" <?php if ($show == true) { if ($row['source'] == "Sms") { echo "selected"; } }?>>Sms</option>
                            <option value="Yahoo" <?php if ($show == true) { if ($row['source'] == "Yahoo") { echo "selected"; } }?>>Yahoo</option>
                            <option value="Yahoo(cn)" <?php if ($show == true) { if ($row['source'] == "Yahoo(cn)") { echo "selected"; } }?>>Yahoo(cn)</option>
                            <option value="Facebook(pm)" <?php if ($show == true) { if ($row['source'] == "Facebook(pm)") { echo "selected"; } }?>>Facebook(pm)</option>
                            <option value="Friendintro" <?php if ($show == true) { if ($row['source'] == "Friendintro") { echo "selected"; } }?>>Friendintro</option>
                            <option value="Outsource" <?php if ($show == true) { if ($row['source'] == "Outsource") { echo "selected"; } }?>>Outsource</option>
                            <option value="Whatsapp" <?php if ($show == true) { if ($row['source'] == "Whatsapp") { echo "selected"; } }?>>Whatsapp</option>
                            <option value="Pawn" <?php if ($show == true) { if ($row['source'] == "Pawn") { echo "selected"; } }?>>Pawn</option>
                            <option value="Playstore" <?php if ($show == true) { if ($row['source'] == "Playstore") { echo "selected"; } }?>>Playstore</option>
                            <option value="Phonebook" <?php if ($show == true) { if ($row['source'] == "Phonebook") { echo "selected"; } }?>>Phonebook</option>
                            <option value="Tiktok" <?php if ($show == true) { if ($row['source'] == "Tiktok") { echo "selected"; } }?>>Tiktok</option>
                            <option value="Blacklisting" <?php if ($show == true) { if ($row['source'] == "Blacklisting") { echo "selected"; } }?>>Blacklisting</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Inquiry Insert Date</label>
                    </div>
                    <div class="col-md-6">
                        <?php if ($show == true) { echo $row['insert_date']; } else { echo date("Y-m-d H:i:s"); }?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Branch</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="branch" <?php if ($show == true) { echo "value='".$row['branch']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Name</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" <?php if ($show == true) { echo "value='".$row['name']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>IC</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="ic" <?php if ($show == true) { echo "value='".$row['ic']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Contact No</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="contact_no" <?php if ($show == true) { echo "value='".$row['contact_no']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Email</label>
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" <?php if ($show == true) { echo "value='".$row['email']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Race</label>
                    </div>
                    <div class="col-md-6">
                        <select name="race" class="form-control" style="width:50%;">
                            <option value="--- Select Race ---" <?php if ($show == true) { if ($row['race'] == "--- Select Race ---") { echo "selected"; } }?>>--- Select Race ---</option>
                            <option value="Malay" <?php if ($show == true) { if ($row['race'] == "Malay") { echo "selected"; } }?>>Malay</option>
                            <option value="Chinese" <?php if ($show == true) { if ($row['race'] == "Chinese") { echo "selected"; } }?>>Chinese</option>
                            <option value="Indian" <?php if ($show == true) { if ($row['race'] == "Indian") { echo "selected"; } }?>>Indian</option>
                            <option value="Dusun" <?php if ($show == true) { if ($row['race'] == "Dusun") { echo "selected"; } }?>>Dusun</option>
                            <option value="Iban" <?php if ($show == true) { if ($row['race'] == "Iban") { echo "selected"; } }?>>Iban</option>
                            <option value="Kadazan" <?php if ($show == true) { if ($row['race'] == "Kadazan") { echo "selected"; } }?>>Kadazan</option>
                            <option value="Indonesian" <?php if ($show == true) { if ($row['race'] == "Indonesian") { echo "selected"; } }?>>Indonesian</option>
                            <option value="Kristian" <?php if ($show == true) { if ($row['race'] == "Kristian") { echo "selected"; } }?>>Kristian</option>
                            <option value="Others" <?php if ($show == true) { if ($row['race'] == "Others") { echo "selected"; } }?>>Others</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Gender</label>
                    </div>
                    <div class="col-md-6">
                        <select name="gender" class="form-control" style="width:50%;">
                            <option value="--- Select Gender ---" <?php if ($show == true) { if ($row['gender'] == "--- Select Gender ---") { echo "selected"; } }?>>--- Select Gender ---</option>
                            <option value="Male" <?php if ($show == true) { if ($row['gender'] == "Male") { echo "selected"; } }?>>Male</option>
                            <option value="Female" <?php if ($show == true) { if ($row['gender'] == "Female") { echo "selected"; } }?>>Female</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Ocupation Category</label>
                    </div>
                    <div class="col-md-6">
                        <select name="occupation" class="form-control" style="width:50%;">
                            <option value="--- Select Ocupation Category ---" <?php if ($show == true) { if ($row['occupation'] == "--- Select Ocupation Category ---") { echo "selected"; } }?>>--- Select Ocupation Category ---</option>
                            <option value="Sales and Promoter Related" <?php if ($show == true) { if ($row['occupation'] == "Sales and Promoter Related") { echo "selected"; } }?>>Sales and Promoter Related</option>
                            <option value="Office and Admin Related" <?php if ($show == true) { if ($row['occupation'] == "Office and Admin Related") { echo "selected"; } }?>>Office and Admin Related</option>
                            <option value="Farmer, Fisher and Market Related" <?php if ($show == true) { if ($row['occupation'] == "Farmer, Fisher and Market Related") { echo "selected"; } }?>>Farmer, Fisher and Market Related</option>
                            <option value="Hawker and Small Business Owner" <?php if ($show == true) { if ($row['occupation'] == "Hawker and Small Business Owner") { echo "selected"; } }?>>Hawker and Small Business Owner</option>
                            <option value="Hospital Related Job" <?php if ($show == true) { if ($row['occupation'] == "Hospital Related Job") { echo "selected"; } }?>>Hospital Related Job</option>
                            <option value="Food Preparation and Server" <?php if ($show == true) { if ($row['occupation'] == "Food Preparation and Server") { echo "selected"; } }?>>Food Preparation and Server</option>
                            <option value="Installation, Maintenance, Repair Related" <?php if ($show == true) { if ($row['occupation'] == "Installation, Maintenance, Repair Related") { echo "selected"; } }?>>Installation, Maintenance, Repair Related</option>
                            <option value="Legal / Goverment Related" <?php if ($show == true) { if ($row['occupation'] == "Legal / Goverment Related") { echo "selected"; } }?>>Legal / Goverment Related</option>
                            <option value="Education / Training" <?php if ($show == true) { if ($row['occupation'] == "Education / Training") { echo "selected"; } }?>>Education / Training</option>
                            <option value="Building and Structure" <?php if ($show == true) { if ($row['occupation'] == "Building and Structure") { echo "selected"; } }?>>Building and Structure</option>
                            <option value="Warehouse and Transportation Related Job" <?php if ($show == true) { if ($row['occupation'] == "Warehouse and Transportation Related Job") { echo "selected"; } }?>>Warehouse and Transportation Related Job</option>
                            <option value="Beauty and Saloon" <?php if ($show == true) { if ($row['occupation'] == "Beauty and Saloon") { echo "selected"; } }?>>Beauty and Saloon</option>
                            <option value="Operator and Security Related" <?php if ($show == true) { if ($row['occupation'] == "Operator and Security Related") { echo "selected"; } }?>>Operator and Security Related</option>
                            <option value="Information Technology" <?php if ($show == true) { if ($row['occupation'] == "Information Technology") { echo "selected"; } }?>>Information Technology</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Job</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="job" <?php if ($show == true) { echo "value='".$row['job']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Income</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="income" value="<?php if ($show == true) { echo $row['income']; } else { echo "0"; }?>">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Bank Name</label>
                    </div>
                    <div class="col-md-6">
                        <select name="bank_name" class="form-control" style="width:50%;">
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
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Bank Account No.</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="bank_acc" <?php if ($show == true) { echo "value='".$row['bank_acc']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Bank Holder</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="bank_holder" <?php if ($show == true) { echo "value='".$row['bank_holder']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Address</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="address" <?php if ($show == true) { echo "value='".$row['address']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Post Code</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="post_code" <?php if ($show == true) { echo "value='".$row['post_code']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>City</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="city" <?php if ($show == true) { echo "value='".$row['city']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>State</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="state" <?php if ($show == true) { echo "value='".$row['state']."'"; }?>>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>State Confirmation</label>
                    </div>
                    <div class="col-md-6">
                        <select name="state_confirmation" class="form-control" style="width:50%;">
                            <option value="--- Select State ---" <?php if ($show == true) { if ($row['state_confirmation'] == "--- Select State ---") { echo "selected"; } }?>>--- Select State ---</option>
                            <option value="Kuala Lumpur" <?php if ($show == true) { if ($row['state_confirmation'] == "Kuala Lumpur") { echo "selected"; } }?>>Kuala Lumpur</option>
                            <option value="Selangor" <?php if ($show == true) { if ($row['state_confirmation'] == "Selangor") { echo "selected"; } }?>>Selangor</option>
                            <option value="Putrajaya" <?php if ($show == true) { if ($row['state_confirmation'] == "Putrajaya") { echo "selected"; } }?>>Putrajaya</option>
                            <option value="Johor" <?php if ($show == true) { if ($row['state_confirmation'] == "Johor") { echo "selected"; } }?>>Johor</option>
                            <option value="Kedah" <?php if ($show == true) { if ($row['state_confirmation'] == "Kedah") { echo "selected"; } }?>>Kedah</option>
                            <option value="Kelantan" <?php if ($show == true) { if ($row['state_confirmation'] == "Kelantan") { echo "selected"; } }?>>Kelantan</option>
                            <option value="Melaka" <?php if ($show == true) { if ($row['state_confirmation'] == "Melaka") { echo "selected"; } }?>>Melaka</option>
                            <option value="Negeri Sembilan" <?php if ($show == true) { if ($row['state_confirmation'] == "Negeri Sembilan") { echo "selected"; } }?>>Negeri Sembilan</option>
                            <option value="Pahang" <?php if ($show == true) { if ($row['state_confirmation'] == "Pahang") { echo "selected"; } }?>>Pahang</option>
                            <option value="Perak" <?php if ($show == true) { if ($row['state_confirmation'] == "Perak") { echo "selected"; } }?>>Perak</option>
                            <option value="Perlis" <?php if ($show == true) { if ($row['state_confirmation'] == "Perlis") { echo "selected"; } }?>>Perlis</option>
                            <option value="Pulau Pinang" <?php if ($show == true) { if ($row['state_confirmation'] == "Pulau Pinang") { echo "selected"; } }?>>Pulau Pinang</option>
                            <option value="Terengganu" <?php if ($show == true) { if ($row['state_confirmation'] == "Terengganu") { echo "selected"; } }?>>Terengganu</option>
                            <option value="Labuan" <?php if ($show == true) { if ($row['state_confirmation'] == "Labuan") { echo "selected"; } }?>>Labuan</option>
                            <option value="Sabah" <?php if ($show == true) { if ($row['state_confirmation'] == "Sabah") { echo "selected"; } }?>>Sabah</option>
                            <option value="Sarawak" <?php if ($show == true) { if ($row['state_confirmation'] == "Sarawak") { echo "selected"; } }?>>Sarawak</option>
                            <option value="Others" <?php if ($show == true) { if ($row['state_confirmation'] == "Others") { echo "selected"; } }?>>Others</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Amount</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="amount" value=" <?php if ($show == true) { echo $row['amount']; } else { echo "0"; }?>">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <label>Customer Remark</label>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <textarea name="customer_remark" style="width: 100%;"><?php if ($show == true) { echo $row['customer_remark']; }?></textarea>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <label>CS Remark</label>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <textarea name="cs_remark" style="width: 100%;"><?php if ($show == true) { echo $row['cs_remark']; }?></textarea>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <label>Status</label>
                    </div>
                    <div class="col-md-6">
                        <select name="status" class="form-control" style="width:50%;">
                            <option value="Pending" <?php if ($show == true) { if ($row['status'] == "Pending") { echo "selected"; } }?>>Pending</option>
                            <option value="Incomplete" <?php if ($show == true) { if ($row['status'] == "Incomplete") { echo "selected"; } }?>>Incomplete</option>
                            <option value="Called" <?php if ($show == true) { if ($row['status'] == "Called") { echo "selected"; } }?>>Called</option>
                            <option value="Waiting Reply" <?php if ($show == true) { if ($row['status'] == "Waiting Reply") { echo "selected"; } }?>>Waiting Reply</option>
                            <option value="Potential" <?php if ($show == true) { if ($row['status'] == "Potential") { echo "selected"; } }?>>Potential</option>
                            <option value="Processing" <?php if ($show == true) { if ($row['status'] == "Processing") { echo "selected"; } }?>>Processing</option>
                            <option value="Reprocessing" <?php if ($show == true) { if ($row['status'] == "Reprocessing") { echo "selected"; } }?>>Reprocessing</option>
                            <option value="Outstation" <?php if ($show == true) { if ($row['status'] == "Outstation") { echo "selected"; } }?>>Outstation</option>
                            <option value="No Response" <?php if ($show == true) { if ($row['status'] == "No Response") { echo "selected"; } }?>>No Response</option>
                            <option value="Rejected" <?php if ($show == true) { if ($row['status'] == "Rejected") { echo "selected"; } }?>>Rejected</option>
                            <option value="Agent Rejected" <?php if ($show == true) { if ($row['status'] == "Agent Rejected") { echo "selected"; } }?>>Agent Rejected</option>
                            <option value="Success" <?php if ($show == true) { if ($row['status'] == "Success") { echo "selected"; } }?>>Success</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <label style="text-decoration: underline;">Customer Status:</label>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Incomplete Documents" <?php if ($show == true) { if ($row['cus_status'] == "Incomplete Documents") { echo "checked"; } }?>>Incomplete Documents</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Dealing In Progress" <?php if ($show == true) { if ($row['cus_status'] == "Dealing In Progress") { echo "checked"; } }?>>Dealing In Progress</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Considering" <?php if ($show == true) { if ($row['cus_status'] == "Considering") { echo "checked"; } }?>>Considering</label>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Seen, But No Reply" <?php if ($show == true) { if ($row['cus_status'] == "Seen, But No Reply") { echo "checked"; } }?>>Seen, But No Reply</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Unreachable" <?php if ($show == true) { if ($row['cus_status'] == "Unreachable") { echo "checked"; } }?>>Unreachable</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Blacklist (Money Lender)" <?php if ($show == true) { if ($row['cus_status'] == "Blacklist (Money Lender)") { echo "checked"; } }?>>Blacklist (Money Lender)</label>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Over-Commitment" <?php if ($show == true) { if ($row['cus_status'] == "Over-Commitment") { echo "checked"; } }?>>Over-Commitment</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Committing" <?php if ($show == true) { if ($row['cus_status'] == "Committing") { echo "checked"; } }?>>Committing Multiple Loans</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Blacklist (Company)" <?php if ($show == true) { if ($row['cus_status'] == "Blacklist (Company)") { echo "checked"; } }?>>Blacklist (Company)</label>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Unstable Income" <?php if ($show == true) { if ($row['cus_status'] == "Unstable Income") { echo "checked"; } }?>>Unstable Income</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Salary By Cash" <?php if ($show == true) { if ($row['cus_status'] == "Salary By Cash") { echo "checked"; } }?>>Salary By Cash</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Uncompliable Request" <?php if ($show == true) { if ($row['cus_status'] == "Uncompliable Request") { echo "checked"; } }?>>Uncompliable Request</label>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="High Interest" <?php if ($show == true) { if ($row['cus_status'] == "High Interest") { echo "checked"; } }?>>High Interest</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Low Salary" <?php if ($show == true) { if ($row['cus_status'] == "Low Salary") { echo "checked"; } }?>>Low Salary</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Got A New Job" <?php if ($show == true) { if ($row['cus_status'] == "Got A New Job") { echo "checked"; } }?>>Got A New Job</label>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Got Better Loan Offer" <?php if ($show == true) { if ($row['cus_status'] == "Got Better Loan Offer") { echo "checked"; } }?>>Got Better Loan Offer</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Competitor Cut-in" <?php if ($show == true) { if ($row['cus_status'] == "Competitor Cut-in") { echo "checked"; } }?>>Competitor Cut-in</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Rejected Without Reason" <?php if ($show == true) { if ($row['cus_status'] == "Rejected Without Reason") { echo "checked"; } }?>>Rejected Without Reason</label>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Foreigner" <?php if ($show == true) { if ($row['cus_status'] == "Foreigner") { echo "checked"; } }?>>Foreigner</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Underage" <?php if ($show == true) { if ($row['cus_status'] == "Underage") { echo "checked"; } }?>>Underage</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Not Interested" <?php if ($show == true) { if ($row['cus_status'] == "Not Interested") { echo "checked"; } }?>>Not Interested</label>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Government" <?php if ($show == true) { if ($row['cus_status'] == "Government") { echo "checked"; } }?>>Government Official</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Unstable Hawker" <?php if ($show == true) { if ($row['cus_status'] == "Unstable Hawker") { echo "checked"; } }?>>Unstable Hawker</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="iPhone User" <?php if ($show == true) { if ($row['cus_status'] == "iPhone User") { echo "checked"; } }?>>iPhone User</label>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Double Inquiry" <?php if ($show == true) { if ($row['cus_status'] == "Double Inquiry") { echo "checked"; } }?>>Double Inquiry</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Pencen / Retired" <?php if ($show == true) { if ($row['cus_status'] == "Pencen / Retired") { echo "checked"; } }?>>Pencen / Retired</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Admin Rejected" <?php if ($show == true) { if ($row['cus_status'] == "Admin Rejected") { echo "checked"; } }?>>Admin Rejected</label>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Scammer" <?php if ($show == true) { if ($row['cus_status'] == "Scammer") { echo "checked"; } }?>>Scammer</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Confirm Don't Want" <?php if ($show == true) { if ($row['cus_status'] == "Confirm Don't Want") { echo "checked"; } }?>>Confirm Don't Want</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Unemployed" <?php if ($show == true) { if ($row['cus_status'] == "Unemployed") { echo "checked"; } }?>>Unemployed</label>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Chinese" <?php if ($show == true) { if ($row['cus_status'] == "Chinese") { echo "checked"; } }?>>Chinese</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Company's Client" <?php if ($show == true) { if ($row['cus_status'] == "Company's Client") { echo "checked"; } }?>>Company's Client</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="Unqualified" <?php if ($show == true) { if ($row['cus_status'] == "Unqualified") { echo "checked"; } }?>>Unqualified</label>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="No Apply" <?php if ($show == true) { if ($row['cus_status'] == "No Apply") { echo "checked"; } }?>>No Apply</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="No Online Banking" <?php if ($show == true) { if ($row['cus_status'] == "No Online Banking") { echo "checked"; } }?>>No Online Banking</label>
                    </div>
                    <div class="col-md-3">
                        <label><input type="checkbox" class="checkbox" name="cus_status" value="No Pick Up" <?php if ($show == true) { if ($row['cus_status'] == "No Pick Up") { echo "checked"; } }?>>No Pick Up</label>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <br>
                <div class="row form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <?php if ($show == true) {?>
                        <button type="submit" class="btn btn-success" name="update">Update</button>
                        <?php } else {?>
                        <button type="submit" class="btn btn-success" name="create">Create</button>
                        <?php }?>
                        &nbsp;&nbsp;
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
<script>
    // the selector will match all input controls of type :checkbox
    // and attach a click event handler 
    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    function changeType(input) {
        const myArray = input.split("|");
        var pawn = document.getElementById("pawn");
        if (input == "Pawn") {
            pawn.style.display = "block";
        } else {
            pawn.style.display = "none";
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
