<?php 
include('header.php');
$center_id = $_SESSION['center_id'];
$dir="customer_pictures";

if (isset($_GET['l'])) {
    $loan_id = $_GET['l'];
    $sql = "SELECT * FROM a_loan WHERE id = '".$loan_id."';";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $sql = "SELECT * FROM a_customer WHERE id = '".$row['customer']."';";
    $res = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_assoc($res);

    $sql = "SELECT * FROM  a_instalment WHERE loan_id = '".$loan_id."';";
    $res = mysqli_query($conn, $sql);
    $no_instalment = 0;
    while ($myrow = mysqli_fetch_array($res)) {
        $no_instalment++;
    }
} else {
    echo "<script>window.location = 'customer_list.php';</script>";
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $success = true;
    $update_image = false;
    $status = $_POST['status'];
    $collection_in_progress = $_POST['collection_in_progress'];

    $sql = "UPDATE a_loan SET status = '".$status."', collection_in_progress = '".$collection_in_progress."'";

    $dir="customer_pictures";
    $rename = 'upload'.date('Ymd').time();

    if (!is_dir($dir."/".$rename)) {
        mkdir($dir."/".$rename);
    }

    if (isset($_FILES['loan_agreement']['name']) && $_FILES['loan_agreement']['name'] != "") {
        $loan_agreement = $_FILES['loan_agreement']['name'];
        move_uploaded_file($_FILES['loan_agreement']['tmp_name'], $dir."/".$rename."/".$loan_agreement);
        $sql .= ", loan_agreement = '".$rename."/".$loan_agreement."'";
        $update_image = true;
    }

    if (isset($_FILES['loan_stamping']['name']) && $_FILES['loan_stamping']['name'] != "") {
        $loan_stamping = $_FILES['loan_stamping']['name'];
        move_uploaded_file($_FILES['loan_stamping']['tmp_name'], $dir."/".$rename."/".$loan_stamping);
        $sql .= ", loan_stamping = '".$rename."/".$loan_stamping."'";
        $update_image = true;
    }

    $sql .= " WHERE id = '".$loan_id."';";


    // echo $sql."<br>";

    if ($no_instalment != 0) {
        for ($i = 1; $i <= $no_instalment; $i++) {
            $cs_remark = $_POST['cs_remark'.$i];
            $cs_collector_remark = $_POST['cs_collector_remark'.$i];
            $settle_by = $_POST['settle_by'.$i];
            $instalment_id = $_POST['instalment_id'.$i];
            $status = $_POST['status'.$i];
            $sql1 = "UPDATE a_instalment SET cs_remark = '".$cs_remark."', cs_collector_remark = '".$cs_collector_remark."', settle_by = '".$settle_by."', status = '".$status."' WHERE id = '".$instalment_id."';";
            // echo $sql1."<br>";
            if (mysqli_query($conn, $sql1)) {} else {
                $success = false;
            }
        }

        if ($success != false) {
            if (mysqli_query($conn, $sql)) {
                $payment_type = $_POST['payment_type'];
                $payment_instalment_id = $_POST['payment_instalment_id'];
                $payment_on_date = $_POST['payment_on_date'];
                $payment_on_time = $_POST['payment_on_time'];
                $payment_amount = $_POST['payment_amount'];
                $bank_charge = $_POST['bank_charge'];
                $out_bank = $_POST['out_bank'];
                // $in_bank = $_POST['in_bank'];
                // $in_holder = $_POST['in_holder'];
                // $in_account = $_POST['in_account'];
                $payment_remark = $_POST['payment_remark'];
                $payment_status = $_POST['payment_status'];


                for ($i = 0; $i < count($payment_type); $i++) {
                    $payment_on = $payment_on_date[$i]." ".$payment_on_time[$i];

                    $out = explode(" : ", $out_bank[$i]);

                    if ($payment_instalment_id[$i] != "None" && $out_bank[$i] != "--- Select Out Bank ---" && $out_bank[$i] != "--- Select Bank ---") {
                        if ($payment_amount[$i] == "")
                            $payment_amount[$i] = 0;
                        if ($bank_charge[$i] == "")
                            $bank_charge[$i] = 0;
                        $sql2 = "INSERT INTO a_payment (loan_id, instalment_id, slip, payment_type, payment_on, payment_amount, bank_charge, out_bank, out_name, out_account, in_bank, in_name, in_account, remark, status) VALUES ('".$loan_id."', '".$payment_instalment_id[$i]."', '', '".$payment_type[$i]."', '".$payment_on."', '".$payment_amount[$i]."', '".$bank_charge[$i]."', '".$out[0]."', '".$out[1]."', '".$out[2]."', '', '', '', '".$payment_remark[$i]."', '".$payment_status[$i]."');";
                        // echo $sql2."<br>";
                        if (mysqli_query($conn, $sql2)) {} else {
                            $success = false;
                        }
                    } else { echo "123";}
                }




            } else {
                echo "<script>alert('Updated error, please try again later.')</script>";
                echo "<script>window.location = 'edit_loan.php?l=".$loan_id."';</script>";
            }
        } else {
            echo "<script>alert('Something error in instalment, Please try again later.')</script>";
            echo "<script>window.location = 'edit_loan.php?l=".$loan_id."';</script>";
        }

        if ($success != false || $update_image != false) {
            echo "<script>alert('Updated successfully.')</script>";
            echo "<script>window.location = 'edit_loan.php?l=".$loan_id."';</script>";
        }
    }
}
?>
<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center><h1>Loan List</h1></center>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container">
            <form method="post" id="myForm" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Branch</label></div>
                    <div class="col-md-2"><label><?php echo $row['branch1'];?></label></div>
                    <div class="col-md-2"><label>Loan ID</label></div>
                    <div class="col-md-2"><label><?php echo $row['id'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Personal & Company Information</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Name as NRIC</label></div>
                    <div class="col-md-2"><label><?php echo $row1['name'];?></label></div>
                    <div class="col-md-2"><label>Company Name</label></div>
                    <div class="col-md-2"><label><?php echo $row1['company_name'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>IC</label></div>
                    <div class="col-md-2"><label><?php echo $row1['ic'];?></label></div>
                    <div class="col-md-2"><label>Tel No.</label></div>
                    <div class="col-md-2"><label><?php echo $row1['company_tel'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Current Address</label></div>
                    <div class="col-md-2"><label><?php echo $row1['current_address'];?></label></div>
                    <div class="col-md-2"><label>Office Address</label></div>
                    <div class="col-md-2"><label><?php echo $row1['company_address'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Mobile No.</label></div>
                    <div class="col-md-2"><label><?php echo $row1['mobile'];?></label></div>
                    <div class="col-md-6"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Tel No.</label></div>
                    <div class="col-md-2"><label><?php echo $row1['tel'];?></label></div>
                    <div class="col-md-2"><label>Customer Status</label></div>
                    <div class="col-md-2"><label style="color: <?php if ($row1['status'] == "Active") { echo "green"; } else { echo "red"; } ?>"><?php echo $row1['status'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-2"><label>Black List</label></div>
                    <div class="col-md-2"><label style="color: green;">Clear</label></div>
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
                    <div class="col-md-2"><label><?php echo $row1['guarantor1_name'];?></label></div>
                    <div class="col-md-2"><label>Relationship</label></div>
                    <div class="col-md-2"><label><?php echo $row1['guarantor1_relationship'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>IC</label></div>
                    <div class="col-md-2"><label><?php echo $row1['guarantor1_ic'];?></label></div>
                    <div class="col-md-2"><label>Verify</label></div>
                    <div class="col-md-2"><label><?php if ($row1['guarantor1_verify'] != "--- Select Verify ---") { echo $row1['guarantor1_verify']; }?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Tel No.</label></div>
                    <div class="col-md-2"><label><?php echo $row1['guarantor1_tel'];?></label></div>
                    <div class="col-md-6"></div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Name</label></div>
                    <div class="col-md-2"><label><?php echo $row1['guarantor2_name'];?></label></div>
                    <div class="col-md-2"><label>Relationship</label></div>
                    <div class="col-md-2"><label><?php echo $row1['guarantor2_relationship'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>IC</label></div>
                    <div class="col-md-2"><label><?php echo $row1['guarantor2_ic'];?></label></div>
                    <div class="col-md-2"><label>Verify</label></div>
                    <div class="col-md-2"><label><?php if ($row1['guarantor2_verify'] != "--- Select Verify ---") { echo $row1['guarantor2_verify']; }?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Tel No.</label></div>
                    <div class="col-md-2"><label><?php echo $row1['guarantor2_tel'];?></label></div>
                    <div class="col-md-6"></div>
                </div>
                <br>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Pawn Details (If Applicable)</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Is Pawn</label></div>
                    <div class="col-md-2"><label><?php echo $row['is_pawn'];?></label></div>
                    <div class="col-md-2"><label>Pawn Category</label></div>
                    <div class="col-md-2"><label><?php if ($row['pawn_category'] != "") { echo $row['pawn_category']; } else { echo "---"; }?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Pawn Item(s)</label></div>
                    <div class="col-md-2"><label><?php if ($row['pawn_item'] != "") { echo $row['pawn_item']; } else { echo "---"; }?></label></div>
                    <div class="col-md-6"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-1"><label>Pawn Image</label></div>
                    <div class="col-md-2">
<?php
if ($row['pawn_image1'] != "") {?>
                    <a href="<?php echo $dir."/".$row['pawn_image1'];?>" target="_blank"><img src="<?php echo $row['pawn_image1'];?>" style="width: 146px;"></a>
<?php } else {
    echo "---";
}
?>
                    </div>
                    <div class="col-md-1"><label>Pawn Image</label></div>
                    <div class="col-md-2">
<?php
if ($row['pawn_image2'] != "") {?>
                    <a href="<?php echo $dir."/".$row['pawn_image2'];?>" target="_blank"><img src="<?php echo $row['pawn_image2'];?>" style="width: 146px;"></a>
<?php } else {
    echo "---";
}
?>
                    </div>
                    <div class="col-md-1"><label>Pawn Image</label></div>
                    <div class="col-md-2">
<?php
if ($row['pawn_image3'] != "") {?>
                    <a href="<?php echo $dir."/".$row['pawn_image3'];?>" target="_blank"><img src="<?php echo $row['pawn_image3'];?>" style="width: 146px;"></a>
<?php } else {
    echo "---";
}
?>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Loan Details</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row" style="text-align: center;">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <label>Loan Agreement</label><br>
<?php
if ($row['loan_agreement'] != "") {?>
                        <a href="<?php echo $dir."/".$row['loan_agreement'];?>" target="_blank"><img src="<?php echo $dir."/".$row['loan_agreement'];?>" style="width: 146px;"></a>
<?php } else {?>
                        <div style="display: inline-block; border: dashed 2px; width: 150px; line-height: 160px; vertical-align: middle; font-weight: bold;">No Image</div>
<?php }?>
                    <br>
                    <input type="file" name="loan_agreement" style="margin-top: 5px;">
                    </div>
                    <div class="col-md-4">
                        <label>Loan Stamping</label><br>
<?php
if ($row['loan_stamping'] != "") {?>
                        <a href="<?php echo $dir."/".$row['loan_stamping'];?>" target="_blank"><img src="<?php echo $dir."/".$row['loan_stamping'];?>" style="width: 146px;"></a>
<?php } else {?>
                        <div style="display: inline-block; border: dashed 2px; width: 150px; line-height: 160px; vertical-align: middle; font-weight: bold;">No PDF</div>
<?php }?>
                    <br>
                    <input type="file" name="loan_stamping" style="margin-top: 5px;">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Contra Loan ID</label></div>
                    <div class="col-md-2"><label><?php if ($row['contra_loan'] != "") { echo $row['contra_loan']; } else { echo "---"; } ?></label></div>
                    <div class="col-md-2"><label>Loan Source</label></div>
                    <div class="col-md-2"><label><?php echo $row['loan_source'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Application Date</label></div>
                    <div class="col-md-2"><label><?php echo $row['application_date'];?></label></div>
                    <div class="col-md-2"><label>Loan Method</label></div>
                    <div class="col-md-2"><label><?php echo $row['loan_method'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Loan Period</label></div>
<?php
$temp = explode(" ", $row['start_date']);
$start_date = $temp[0];
$temp = explode(" ", $row['end_date']);
$end_date = $temp[0];
$loan_period = $start_date." ~ ".$end_date;
?>
                    <div class="col-md-2"><label><?php echo $loan_period;?></label></div>
                    <div class="col-md-2"><label>Loan Package</label></div>
                    <div class="col-md-2"><label><?php echo $row['loan_package'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Dept Term</label></div>
<?php
switch ($row['dept_type']) {
    case 'Daily':
        $dept_term = $row['dept_period']." Day";
        break;
    case 'Weekly':
        $dept_term = $row['dept_period']." Week";
        break;
    case 'Monthly':
        $dept_term = $row['dept_period']." Month";
        break;
}
?>
                    <div class="col-md-2"><label><?php echo $dept_term;?></div>
                    <div class="col-md-2"><label>Remark</label></div>
                    <div class="col-md-2"><label><?php echo $row['remark'];?></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Interest (%)</label></div>
                    <div class="col-md-2"><label><?php printf("%0.2f", $row['interest']);?></label></div>
                    <div class="col-md-2"><label>Principal Amount</label></div>
                    <div class="col-md-2"><label><?php printf("%0.2f", $row['principal_amount']);?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Principal Amount</label></div>
                    <div class="col-md-2"><label><?php printf("%0.2f", $row['principal_amount']);?></label></div>
                    <div class="col-md-2"><label>Contra Amount</label></div>
                    <div class="col-md-2"><label><?php printf("%0.2f", $row['contra_amount']);?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Total Interest</label></div>
                    <div class="col-md-2"><label>0.00</label></div>
                    <div class="col-md-2"><label>Deposit Amount</label></div>
                    <div class="col-md-2"><label><?php printf("%0.2f", $row['deposit_amount']);?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Total Payment</label></div>
<?php
$total_payment = $row['principal_amount'] - $row['payment_upfront'];
$payment_per_term = $total_payment / $row['dept_period'];
$total_to_hand = $row['principal_amount'] - $row['payment_upfront'] - $row['application_fee'];
?>
                    <div class="col-md-2"><label><?php printf("%0.2f", $total_payment);?></label></div>
                    <div class="col-md-2"><label>Application Fee</label></div>
                    <div class="col-md-2"><label><?php printf("%0.2f", $row['application_fee']);?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Payment Per Term</label></div>
                    <div class="col-md-2"><label><?php printf("%0.2f", $payment_per_term);?></label></div>
                    <div class="col-md-2"><label>Payment Upfront</label></div>
                    <div class="col-md-2"><label><?php printf("%0.2f", $row['payment_upfront']);?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Rounded Up</label></div>
                    <div class="col-md-2" style="border-top: solid 1px; border-bottom: double;"><label><?php printf("%0.2f", $payment_per_term);?></label></div>
                    <div class="col-md-2"><label>Total To Hand</label></div>
                    <div class="col-md-2" style="border-top: solid 1px; border-bottom: double;"><label><?php printf("%0.2f", $total_to_hand);?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-2"><label style="font-style: italic;">(First Term Upfront Payment: RM <?php printf("%0.2f", $row['payment_upfront']);?>)</label></div>
                    <div class="col-md-6"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-2"><label style="font-style: italic;">(Standard Last Term Payment)</label></div>
                    <div class="col-md-2"><label>CS Collector</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="cs_collector">
                            <option value="None">None</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-2"><label>Dept Collector</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="dept_collector">
                            <option value="None">None</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-2"><label>Loan Status</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="status">
                            <option value="Normal" <?php if ($row['status'] == "Normal") { echo "selected"; }?>>Normal</option>
                            <option value="Bad Dept" <?php if ($row['status'] == "Bad Dept") { echo "selected"; }?>>Bad Dept</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Payment Delay</label></div>
                    <div class="col-md-2"><label>None</label></div>
                    <div class="col-md-2"><label>Auto Payment</label></div>
                    <div class="col-md-2"><label>No</label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Refinanced</label></div>
                    <div class="col-md-2"><label>No</label></div>
                    <div class="col-md-2"><label>Collection In Progress</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="collection_in_progress">
                            <option value="Yes" <?php if ($row['collection_in_progress'] == "Yes") { echo "selected"; }?>>Yes</option>
                            <option value="No" <?php if ($row['collection_in_progress'] == "No") { echo "selected"; }?>>No</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Instalment List</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8" style="text-align: center;"><label>Next Follow Up Date</label><input type="date" name="follow_up_date" value="<?php echo $row['follow_up_date'];?>" style="margin-left: 10px; margin-right: 10px;"><label><input type="checkbox" name="no_more_follow_up" style="margin-right: 5px; margin-left: 5px;">Tick if no more follow ups</label></div>
                    <div class="col-md-2"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div style="overflow-x: auto;">
                    <table cellspacing="0" cellpadding="2" class="table table-striped table-bordered" style="width: 100%; white-space: nowrap;">
                        <thead style="text-align: center;">
                            <tr>
                                <th>NO.</th>
                                <th>Instalment ID</th>
                                <th>Payment Due <span style="color: red;">*</span></th>
                                <th>Due Amount <span style="color: red;">*</span></th>
                                <th>Expected Balance</th>
                                <th>Late Charges</th>
                                <th>Expected To Receive</th>
                                <th>Total Expected To Receive</th>
                                <th style="min-width: 200px;">Remark</th>
                                <th style="min-width: 200px;">Settled by</th>
                                <th style="min-width: 120px;">Status <span style="color: red;">*</span></th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <tr>
                                <td></td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td style="text-align: right;"><?php printf("%0.2f", $total_payment);?></td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                            </tr>
<?php
$i = 1;
$expected_balance = $total_payment;
$total_expected_receive = 0;
$sql = "SELECT * FROM a_instalment WHERE loan_id = '".$loan_id."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {
$due_amount = $myrow['due_amount'];
$late_charge = $myrow['late_charge'];
$expected_balance -= $due_amount;
$expected_receive = $due_amount;
$total_expected_receive += $expected_receive;
?>
                            <input type="hidden" name="instalment_id<?php echo $i;?>" value="<?php echo $myrow['id'];?>">
                            <tr style="background-color: <?php if ($myrow['status'] != "Unpaid") { echo "white"; } else { echo "#FFCCCC"; };?>;">
                                <td><?php echo $i;?></td>
                                <td><?php echo $myrow['id'];?></td>
                                <td><?php echo $myrow['payment_due'];?></td>
                                <td><?php echo number_format($due_amount, 2);?></td>
                                <td style="text-align: right;"><?php echo number_format($expected_balance, 2);?></td>
                                <td><?php echo number_format($late_charge, 2);?></td>
                                <td style="text-align: right;"><?php echo number_format($expected_receive, 2);?></td>
                                <td style="text-align: right;"><?php echo number_format($total_expected_receive, 2);?></td>
                                <td>CS Remark: <br><input type="text" name="cs_remark<?php echo $i;?>" class="form-control" <?php if ($myrow['cs_remark'] != "") { echo "value='".$myrow['cs_remark']."'";} ?>>CS Collector Remark: <br><input type="text" name="cs_collector_remark<?php echo $i;?>" class="form-control" <?php if ($myrow['cs_collector_remark'] != "") { echo "value='".$myrow['cs_collector_remark']."'";} ?>>Debt Collector Remark:</td>
                                <td>
                                    <select class="form-control" name="settle_by<?php echo $i;?>">
                                        <option value="Not Yet Settle/Confirm" <?php if ($myrow['settle_by'] == "Not Yet Settle/Confirm") { echo "Selected"; }?>>Not Yet Settle/Confirm</option>
                                        <option value="Customer" <?php if ($myrow['settle_by'] == "Customer") { echo "Selected"; }?>>Customer</option>
                                        <option value="Guarantor" <?php if ($myrow['settle_by'] == "Guarantor") { echo "Selected"; }?>>Guarantor</option>
                                        <option value="Others" <?php if ($myrow['settle_by'] == "Others") { echo "Selected"; }?>>Others</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="status<?php echo $i;?>">
                                        <option value="Paid" <?php if ($myrow['status'] == "Paid") { echo "Selected"; }?>>Paid</option>
                                        <option value="Unpaid" <?php if ($myrow['status'] == "Unpaid") { echo "Selected"; }?>>Unpaid</option>
                                        <option value="Contra" <?php if ($myrow['status'] == "Contra") { echo "Selected"; }?>>Contra</option>
                                        <option value="Void" <?php if ($myrow['status'] == "Void") { echo "Selected"; }?>>Void</option>
                                        <option value="Late" <?php if ($myrow['status'] == "Late") { echo "Selected"; }?>>Late</option>
                                        <option value="Delete" <?php if ($myrow['status'] == "Delete") { echo "Selected"; }?>>Delete</option>
                                    </select>
                                </td>
                            </tr>
<?php
$i++;
}?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="11"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Payment List</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div style="overflow-x: auto;">
                    <table cellspacing="0" cellpadding="2" class="table table-striped table-bordered" style="width: 100%; white-space: nowrap; text-align: center;">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>By Agent</th>
                                <th>Slip</th>
                                <th style="min-width: 200px;">Payment Type <span style="color: red;">*</span></th>
                                <th>Payment ID</th>
                                <th>Instalment ID</th>
                                <th>Payment On <span style="color: red;">*</span></th>
                                <th>Payment Amount <span style="color: red;">*</span></th>
                                <th>Bank Charges</th>
                                <th>Received Total</th>
                                <th style="min-width: 200px;">Out Bank</th>
                                <th style="min-width: 200px;">In Bank</th>
                                <th style="min-width: 200px;">Remark</th>
                                <th style="min-width: 200px;">Status</th>
                            </tr>
                        </thead>
                        <tbody id="show_item">
<?php
$i = 1;
$received_total = 0;
$sql = "SELECT * FROM a_payment WHERE loan_id = '".$loan_id."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                            <tr>
                                <td><?php echo $i++;?></td>
                                <td><?php echo $myrow['by_agent'];?></td>
                                <td><?php if ($myrow['slip'] != "") { echo $myrow['slip']; } else { echo "---"; }?></td>
                                <td style="color: <?php if ($myrow['payment_type'] == "Out") { echo "red"; $received_total -= $myrow['payment_amount']; } else { echo "green"; $received_total += $myrow['payment_amount']; }?>;"><?php echo $myrow['payment_type'];?></td>
                                <td><?php echo $myrow['id'];?></td>
                                <td><?php echo $myrow['instalment_id'];?></td>
                                <td><?php echo $myrow['payment_on'];?></td>
                                <td><?php echo number_format($myrow['payment_amount'], 2);?></td>
                                <td><?php echo number_format($myrow['bank_charge'], 2);?></td>
                                <td><?php echo number_format($received_total, 2);?></td>
                                <td><?php if ($myrow['payment_type'] == "Out") { echo $myrow['out_bank']."<br>".$myrow['out_name']."<br>".$myrow['out_account']; }?></td>
                                <td><?php if ($myrow['payment_type'] == "In") { echo $myrow['in_bank']."<br>".$myrow['in_name']."<br>".$myrow['in_account']; }?></td>
                                <td><?php echo $myrow['remark'];?></td>
                                <td><?php echo $myrow['status'];?></td>
                            </tr>
<?php }?>
                            <tr>
                                <td></td>
                                <td>---</td>
                                <td>---</td>
                                <td>
                                    <select class="form-control" name="payment_type[]">
                                        <!-- <option value="--- Select Payment Type ---" selected disabled hidden>--- Select Payment Type ---</option> -->
                                        <option value="Out" selected>Out</option>
                                        <option value="In" selected>In</option>
                                    </select>
                                </td>
                                <td>---</td>
                                <td>
                                    <select class="form-control" name="payment_instalment_id[]">
                                        <option value="None" selected hidden disabled>None</option>
<?php
$sql = "SELECT id FROM a_instalment WHERE loan_id = '".$loan_id."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                                        <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['id'];?></option>
<?php }?>
                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="payment_on_date[]" class="form-control" value="<?php echo date("Y-m-d");?>">
                                    <br>
                                   <input type="time" name="payment_on_time[]" class="form-control" value="<?php echo date('H:i', time()); ?>" step="3600">
                                </td>
                                <td><input type="text" name="payment_amount[]" class="form-control"></td>
                                <td><input type="text" name="bank_charge[]" class="form-control"></td>
                                <td>---</td>
                                <td>
                                    <!-- <div id="bank">
                                        <select name="" class="form-control">
                                            <option value="--- Select Bank ---">--- Select Bank ---</option>
                                            <option value="Public Bank">Public Bank</option>
                                            <option value="Maybank">Maybank</option>
                                            <option value="CIMB Bank">CIMB Bank</option>
                                            <option value="RHB Bank">RHB Bank</option>
                                            <option value="Bank Rakyat">Bank Rakyat</option>
                                            <option value="Bank Islam">Bank Islam</option>
                                            <option value="AM Bank">AM Bank</option>
                                            <option value="Hong Leong Bank">Hong Leong Bank</option>
                                            <option value="Bank Simpanan Nasional (BSN)">Bank Simpanan Nasional (BSN)</option>
                                            <option value="Alliance Bank">Alliance Bank</option>
                                            <option value="Affin Bank">Affin Bank</option>
                                            <option value="HSBC Bank">HSBC Bank</option>
                                            <option value="Agro Bank">Agro Bank</option>
                                            <option value="Standard Chartered Bank">Standard Chartered Bank</option>
                                            <option value="Muamalat Bank">Muamalat Bank</option>
                                            <option value="UOB Bank">UOB Bank</option>
                                            <option value="OCBC Bank">OCBC Bank</option>
                                            <option value="Al-Rajhi Bank">Al-Rajhi Bank</option>
                                            <option value="Citi Bank">Citi Bank</option>
                                            <option value="Kuwait Finance House">Kuwait Finance House</option>
                                            <option value="CREDIT">CREDIT</option>
                                            <option value="CASH">CASH</option>
                                            <option value="BILLPLZ">BILLPLZ</option>
                                            <option value="BIZAPPAY">BIZAPPAY</option>
                                            <option value="PAYXSPACE">PAYXSPACE</option>
                                        </select>
                                        <br>
                                        <input type="text" name="" class="form-control" placeholder="Holder Name">
                                        <br>
                                        <input type="text" name="" class="form-control" placeholder="Account No.">
                                    </div> -->
                                    <div id="bank_out">
                                        <select class="form-control" name="out_bank[]">
                                            <option value="--- Select Out Bank ---" selected disabled hidden>--- Select Out Bank ---</option>
<?php
$sql = "SELECT * FROM a_bank WHERE center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                                            <option value="<?php echo $myrow['bank_name']." : ".$myrow['holder_name']." : ".$myrow['account_number'];?>"><?php echo $myrow['bank_name']." : ".$myrow['holder_name']." : ".$myrow['account_number'];?></option>
<?php }?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <select name="in_bank[]" class="form-control">
                                        <option value="--- Select Bank ---">--- Select Bank ---</option>
                                        <option value="Public Bank">Public Bank</option>
                                        <option value="Maybank">Maybank</option>
                                        <option value="CIMB Bank">CIMB Bank</option>
                                        <option value="RHB Bank">RHB Bank</option>
                                        <option value="Bank Rakyat">Bank Rakyat</option>
                                        <option value="Bank Islam">Bank Islam</option>
                                        <option value="AM Bank">AM Bank</option>
                                        <option value="Hong Leong Bank">Hong Leong Bank</option>
                                        <option value="Bank Simpanan Nasional (BSN)">Bank Simpanan Nasional (BSN)</option>
                                        <option value="Alliance Bank">Alliance Bank</option>
                                        <option value="Affin Bank">Affin Bank</option>
                                        <option value="HSBC Bank">HSBC Bank</option>
                                        <option value="Agro Bank">Agro Bank</option>
                                        <option value="Standard Chartered Bank">Standard Chartered Bank</option>
                                        <option value="Muamalat Bank">Muamalat Bank</option>
                                        <option value="UOB Bank">UOB Bank</option>
                                        <option value="OCBC Bank">OCBC Bank</option>
                                        <option value="Al-Rajhi Bank">Al-Rajhi Bank</option>
                                        <option value="Citi Bank">Citi Bank</option>
                                        <option value="Kuwait Finance House">Kuwait Finance House</option>
                                        <option value="CREDIT">CREDIT</option>
                                        <option value="CASH">CASH</option>
                                        <option value="BILLPLZ">BILLPLZ</option>
                                        <option value="BIZAPPAY">BIZAPPAY</option>
                                        <option value="PAYXSPACE">PAYXSPACE</option>
                                    </select>
                                    <br>
                                    <input type="text" name="in_holder[]" class="form-control" placeholder="Holder Name">
                                    <br>
                                    <input type="text" name="in_account[]" class="form-control" placeholder="Account No.">
                                </td>
                                <td><input type="text" name="payment_remark[]" class="form-control"></td>
                                <td>
                                    <select class="form-control" name="payment_status[]">
                                        <!-- <option value="--- Select Status ---" selected disabled hidden>--- Select Status ---</option> -->
                                        <option value="Approved" selected>Approved</option>
                                        <option value="Pending" selected>Pending</option>
                                        <option value="Contra" selected>Contra</option>
                                        <option value="Failed" selected>Failed</option>
                                        <option value="Delete" selected>Delete</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr style="text-align: center;">
                                <th colspan="14"><input type="submit" value="Add More Payment" class="add_item_btn" style="background-color: #F7F7F7; border: none;"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Payment Reminder</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div>
                    <table cellspacing="0" cellpadding="2" class="table table-striped table-bordered" style="white-space: nowrap; text-align: center;">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>Payment ID</th>
                                <th>Payment To <span style="color: red;">*</span></th>
                                <th>Payment On <span style="color: red;">*</span></th>
                                <th>Collected Amount</th>
                                <th>Percentage</th>
                                <th>Payment Amount <span style="color: red;">*</span></th>
                                <th>Remark</th>
                                <th>Status <span style="color: red;">*</span></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="9"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div> -->
                <br>
                <div class="row form-group">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success" name="function" value="update">Update</button>
                    </div>
                </div>
                <br>
            </form>
        </div>
    </section>
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
<script src="https://cdnjs.cloudflare.com/ajax/ibs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".add_item_btn").click(function(e) {
            e.preventDefault ();
             $("#show_item").append(`<tr>
                                <td></td>
                                <td>---</td>
                                <td>---</td>
                                <td>
                                    <select class="form-control" name="payment_type[]">
                                        <option value="Out" selected>Out</option> 
                                        <option value="In" selected>In</option>
                                    </select>
                                </td>
                                <td>---</td>
                                <td>
                                    <select class="form-control" name="payment_instalment_id[]">
                                        <option value="None" selected hidden disabled>None</option>
<?php
$sql = "SELECT id FROM a_instalment WHERE loan_id = '".$loan_id."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                                        <option value="<?php echo $myrow['id'];?>"><?php echo $myrow['id'];?></option>
<?php }?>
                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="payment_on_date[]" class="form-control" value="<?php echo date("Y-m-d");?>">
                                    <br>
                                    <input type="time" name="payment_on_time[]" class="form-control" value="<?php echo date('H:i', time()); ?>" step="3600">
                                </td>
                                <td><input type="text" name="payment_amount[]" class="form-control"></td>
                                <td><input type="text" name="bank_charge[]" class="form-control"></td>
                                <td>---</td>
                                <td>
                                    <!-- <div id="bank">
                                        <select name="" class="form-control">
                                            <option value="--- Select Bank ---">--- Select Bank ---</option>
                                            <option value="Public Bank">Public Bank</option>
                                            <option value="Maybank">Maybank</option>
                                            <option value="CIMB Bank">CIMB Bank</option>
                                            <option value="RHB Bank">RHB Bank</option>
                                            <option value="Bank Rakyat">Bank Rakyat</option>
                                            <option value="Bank Islam">Bank Islam</option>
                                            <option value="AM Bank">AM Bank</option>
                                            <option value="Hong Leong Bank">Hong Leong Bank</option>
                                            <option value="Bank Simpanan Nasional (BSN)">Bank Simpanan Nasional (BSN)</option>
                                            <option value="Alliance Bank">Alliance Bank</option>
                                            <option value="Affin Bank">Affin Bank</option>
                                            <option value="HSBC Bank">HSBC Bank</option>
                                            <option value="Agro Bank">Agro Bank</option>
                                            <option value="Standard Chartered Bank">Standard Chartered Bank</option>
                                            <option value="Muamalat Bank">Muamalat Bank</option>
                                            <option value="UOB Bank">UOB Bank</option>
                                            <option value="OCBC Bank">OCBC Bank</option>
                                            <option value="Al-Rajhi Bank">Al-Rajhi Bank</option>
                                            <option value="Citi Bank">Citi Bank</option>
                                            <option value="Kuwait Finance House">Kuwait Finance House</option>
                                            <option value="CREDIT">CREDIT</option>
                                            <option value="CASH">CASH</option>
                                            <option value="BILLPLZ">BILLPLZ</option>
                                            <option value="BIZAPPAY">BIZAPPAY</option>
                                            <option value="PAYXSPACE">PAYXSPACE</option>
                                        </select>
                                        <br>
                                        <input type="text" name="" class="form-control" placeholder="Holder Name">
                                        <br>
                                        <input type="text" name="" class="form-control" placeholder="Account No.">
                                    </div> -->
                                    <div id="bank_out">
                                        <select class="form-control" name="out_bank[]">
                                            <option value="--- Select Out Bank ---" selected disabled hidden>--- Select Out Bank ---</option>
<?php
$sql = "SELECT * FROM a_bank WHERE center_id = '".$_SESSION['center_id']."';";
$res = mysqli_query($conn, $sql);
while ($myrow = mysqli_fetch_array($res)) {?>
                                            <option value="<?php echo $myrow['bank_name']." : ".$myrow['holder_name']." : ".$myrow['account_number'];?>"><?php echo $myrow['bank_name']." : ".$myrow['holder_name']." : ".$myrow['account_number'];?></option>
<?php }?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <select name="in_bank[]" class="form-control">
                                        <option value="--- Select Bank ---">--- Select Bank ---</option>
                                        <option value="Public Bank">Public Bank</option>
                                        <option value="Maybank">Maybank</option>
                                        <option value="CIMB Bank">CIMB Bank</option>
                                        <option value="RHB Bank">RHB Bank</option>
                                        <option value="Bank Rakyat">Bank Rakyat</option>
                                        <option value="Bank Islam">Bank Islam</option>
                                        <option value="AM Bank">AM Bank</option>
                                        <option value="Hong Leong Bank">Hong Leong Bank</option>
                                        <option value="Bank Simpanan Nasional (BSN)">Bank Simpanan Nasional (BSN)</option>
                                        <option value="Alliance Bank">Alliance Bank</option>
                                        <option value="Affin Bank">Affin Bank</option>
                                        <option value="HSBC Bank">HSBC Bank</option>
                                        <option value="Agro Bank">Agro Bank</option>
                                        <option value="Standard Chartered Bank">Standard Chartered Bank</option>
                                        <option value="Muamalat Bank">Muamalat Bank</option>
                                        <option value="UOB Bank">UOB Bank</option>
                                        <option value="OCBC Bank">OCBC Bank</option>
                                        <option value="Al-Rajhi Bank">Al-Rajhi Bank</option>
                                        <option value="Citi Bank">Citi Bank</option>
                                        <option value="Kuwait Finance House">Kuwait Finance House</option>
                                        <option value="CREDIT">CREDIT</option>
                                        <option value="CASH">CASH</option>
                                        <option value="BILLPLZ">BILLPLZ</option>
                                        <option value="BIZAPPAY">BIZAPPAY</option>
                                        <option value="PAYXSPACE">PAYXSPACE</option>
                                    </select>
                                    <br>
                                    <input type="text" name="in_holder[]" class="form-control" placeholder="Holder Name">
                                    <br>
                                    <input type="text" name="in_account[]" class="form-control" placeholder="Account No.">
                                </td>
                                <td><input type="text" name="payment_remark[]" class="form-control"></td>
                                <td>
                                    <select class="form-control" name="payment_status[]">
                                        <option value="Approved" selected>Approved</option>
                                        <option value="Pending" selected>Pending</option>
                                        <option value="Contra" selected>Contra</option>
                                        <option value="Failed" selected>Failed</option>
                                        <option value="Delete" selected>Delete</option>
                                    </select>
                                </td>
                            </tr>`);
        });
    });







</script>

