<?php 
include('header.php');
$center_id = $_SESSION['center_id'];

if (isset($_GET['c'])) {
    $customer_id = $_GET['c'];
    $sql = "SELECT * FROM a_customer WHERE id = '".$customer_id."';";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
} else {
    echo "<script>window.location = 'customer_list.php';</script>";
}

$insert = true;
$dir="customer_pictures";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $rename = 'upload'.date('Ymd').time();

    if (!is_dir($dir."/".$rename)) {
        mkdir($dir."/".$rename);
    }

    $branch1 = $_POST['branch1'];

    if ($_POST['branch2'] == "--- Select Branch ---") {
        $branch2 = "";
    } else {
        $branch2 = $_POST['branch2'];
    }

    $is_pawn = $_POST['is_pawn'];

    if ($is_pawn != "No") {
        
        if ($_POST['pawn_category'] != "-- None --") {
            $pawn_category = $_POST['pawn_category'];
        } else {
            $pawn_category = "";
        }
        $pawn_item = $_POST['pawn_item'];

        if (isset($_FILES['pawn_image1']['name']) && $_FILES['pawn_image1']['name'] != "") {
            $pawn_image1 = $rename.'/'.$_FILES['pawn_image1']['name'];
            move_uploaded_file($_FILES['pawn_image1']['tmp_name'], $dir.'/'.$rename.'/'.$pawn_image1);
        } else {
            $pawn_image1 = "";
        }

        if (isset($_FILES['pawn_image2']['name']) && $_FILES['pawn_image2']['name'] != "") {
            $pawn_image2 = $rename.'/'.$_FILES['pawn_image2']['name'];
            move_uploaded_file($_FILES['pawn_image2']['tmp_name'], $dir.'/'.$rename.'/'.$pawn_image2);
        } else {
            $pawn_image2 = "";
        }

        if (isset($_FILES['pawn_image3']['name']) && $_FILES['pawn_image3']['name'] != "") {
            $pawn_image3 = $rename.'/'.$_FILES['pawn_image3']['name'];
            move_uploaded_file($_FILES['pawn_image3']['tmp_name'], $dir.'/'.$rename.'/'.$pawn_image3);
        } else {
            $pawn_image3 = "";
        }

    } else {
        
        $pawn_category = "";
        $pawn_item = "";
        $pawn_image1 = "";
        $pawn_image2 = "";
        $pawn_image3 = "";
    }

    if ($_POST['contra_loan'] != "--- Select Contra Loan ID ---") {
        $contra_loan = $_POST['contra_loan'];
    } else {
        $contra_loan = "";
    }

    if ($_POST['contra_amount'] != "0" && $_POST['contra_amount'] != "") {
        if (is_numeric($_POST['contra_amount'])) {
            $contra_amount = $_POST['contra_amount'];
        } else {
            $insert = false;
            echo "<script>alert('Incorrect input.')</script>";
        }
    } else {
        $contra_amount = 0;
    }

    $application_date = $_POST['application_date'];

    if ($_POST['loan_source'] != "--- Select Loan Source ---") {
        $loan_source = $_POST['loan_source'];
    } else {
        $insert = false;
        echo "<script>alert('Please select loan source.')</script>";
    }

    $start_date = $_POST['start_date'];
    $temp = explode(" ", $start_date);
    $follow_up_date = $temp[0];
    $loan_method = $_POST['loan_method'];

    if (is_numeric($_POST['dept_period'])) {
        $dept_period = $_POST['dept_period'];
    } else {
        $insert = false;
        echo "<script>alert('Incorrect input.')</script>";
    }

    $loan_package = $_POST['loan_package'];

    if ($_POST['dept_type'] != "--- Select Dept Type ---") {
        $dept_type = $_POST['dept_type'];
    } else {
        $insert = false;
        echo "<script>alert('Please select dept type.')</script>";
    }

    if ($insert != false) {
        $temp = 1;
        if ($dept_period > 1) {
            $temp = $dept_period - 1;
        }
        switch ($dept_type) {
            case 'Daily':
                $end_date = date("Y-m-d", strtotime($start_date) + ($temp * 24 * 60 * 60));
                break;
            case 'Weekly':
                $end_date = date("Y-m-d", strtotime($start_date) + ($temp * 24 * 60 * 60 * 7));
                break;
            case 'Monthly':
                $end_date = date("Y-m-d", strtotime($start_date) + ($temp * 24 * 60 * 60 * 30));
                break;
        }
    }


    $remark = $_POST['remark'];

    if ($_POST['instalment_period'] != "" && $_POST['instalment_period'] != "0") {
        if (is_numeric($_POST['instalment_period'])) {
            $instalment_period = $_POST['instalment_period'];
        } else {
            $insert = false;
            echo "<script>alert('Incorrect input.')</script>";
        }
    } else {
        $instalment_period = "0";
    }

    if (is_numeric($_POST['principal_amount'])) {
        $principal_amount = $_POST['principal_amount'];
    } else {
        $insert = false;
        echo "<script>alert('Incorrect input.')</script>";
    }

    if ($_POST['instalment_type'] != "--- Select Instalment Type ---") {
        $instalment_type = $_POST['instalment_type'];
    } else {
        $instalment_type = "";
    }

    if ($_POST['deposit_amount'] != "") {
        if (is_numeric($_POST['deposit_amount'])) {
            $deposit_amount = $_POST['deposit_amount'];
        } else {
            $insert = false;
            echo "<script>alert('Incorrect input.')</script>";
        }
    } else {
        $deposit_amount = "0";
    }

    if ($_POST['interest'] != "") {
        if (is_numeric($_POST['interest'])) {
            $interest = $_POST['interest'];
        } else {
            $insert = false;
            echo "<script>alert('Incorrect input.')</script>";
        }
    } else {
        $interest = "0";
    }

    if ($_POST['application_fee'] != "") {
        if (is_numeric($_POST['application_fee'])) {
            $application_fee = $_POST['application_fee'];
        } else {
            $insert = false;
            echo "<script>alert('Incorrect input.')</script>";
        }
    } else {
        $application_fee = "0";
    }

    if ($_POST['interest_fixed'] != "") {
        if (is_numeric($_POST['interest_fixed'])) {
            $interest_fixed = $_POST['interest_fixed'];
        } else {
            $insert = false;
            echo "<script>alert('Incorrect input.')</script>";
        }
    } else {
        $interest_fixed = "0";
    }

    if ($_POST['payment_upfront'] != "") {
        if (is_numeric($_POST['payment_upfront'])) {
            $payment_upfront = $_POST['payment_upfront'];
        } else {
            $insert = false;
            echo "<script>alert('Incorrect input.')</script>";
        }
    } else {
        $interest_fixed = "0";
    }

    if ($_POST['only_interest'] == "on") {
        $only_interest = "1";
    } else {
        $only_interest = "0";
    }
    

    $sql1 = "INSERT INTO a_loan (customer, branch1, branch2, is_pawn, pawn_category, pawn_item, pawn_image1, pawn_image2, pawn_image3, contra_loan, contra_amount, application_date, loan_source, start_date, end_date, loan_method, dept_period, loan_package, dept_type, remark, instalment_period, principal_amount, instalment_type, deposit_amount, interest, application_fee, interest_fixed, payment_upfront, only_interest, follow_up_date) VALUES ('".$customer_id."', '".$branch1."', '".$branch2."', '".$is_pawn."', '".$pawn_category."', '".$pawn_item."', '".$pawn_image1."', '".$pawn_image2."', '".$pawn_image3."', '".$contra_loan."', '".$contra_amount."', '".$application_date."', '".$loan_source."', '".$start_date."', '".$end_date."', '".$loan_method."', '".$dept_period."', '".$loan_package."', '".$dept_type."', '".$remark."', '".$instalment_period."', '".$principal_amount."', '".$instalment_type."', '".$deposit_amount."', '".$interest."', '".$application_fee."', '".$interest_fixed."', '".$payment_upfront."', '".$only_interest."', '".$follow_up_date."');";

    // echo $sql;


    if ($insert != false) {
        mysqli_query($conn, $sql1);

        $on_hand = $principal_amount - $payment_upfront;
        $due_amount = $on_hand / $dept_period;

        $sql = "SELECT * FROM a_loan ORDER BY id DESC LIMIT 1;";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $loan_id = $row['id'];

        $payment_due = $start_date;

        while ($on_hand > 0) {
            $sql2 = "INSERT INTO a_instalment (loan_id, payment_due, due_amount, late_charge, cs_remark, cs_collector_remark, dept_collector_remark, settle_by, status) VALUES ('".$loan_id."', '".$payment_due."', '".$due_amount."', 0, '', '', '', 'Not Yet Settle/Confirm', 'Unpaid');";
            mysqli_query($conn, $sql2);

            switch ($row['dept_type']) {
                case 'Daily':
                    $payment_due = date("Y-m-d", strtotime($payment_due) + (24 * 60 * 60));
                    break;
                case 'Weekly':
                    $payment_due = date("Y-m-d", strtotime($payment_due) + (24 * 60 * 60 * 7));
                    break;
                case 'Monthly':
                    $payment_due = date("Y-m-d", strtotime($payment_due) + (24 * 60 * 60 * 7 * 30));
                    break;
            }
            $on_hand -= $due_amount;
        }

        echo "<script>alert('Add loan successful.')</script>";
        echo "<script>window.location = 'add_customer.php?c=".$customer_id."';</script>";
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
                    <div class="col-md-2"><input type="text" name="branch1" class="form-control"></div>
                    <div class="col-md-6"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Personal Information</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Name as NRIC</label></div>
                    <div class="col-md-2"><label><?php echo $row['name'];?></label></div>
                    <div class="col-md-2"><label>Race</label></div>
                    <div class="col-md-2"><label><?php echo $row['race'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>IC</label></div>
                    <div class="col-md-2"><label><?php echo $row['ic'];?></label></div>
                    <div class="col-md-2"><label>Gender</label></div>
                    <div class="col-md-2"><label><?php echo $row['gender'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Martial Status</label></div>
                    <div class="col-md-2">
<?php
if ($row['martial'] != "--- Select Martial Status ---") {?>
                        <label><?php echo $row['martial'];?></label>
<?php }?>
                    </div>
                    <div class="col-md-2"><label>No. of Child</label></div>
                    <div class="col-md-2">
<?php
if ($row['no_child'] == "") {?>
                        <label>0</label>
<?php } else {?>
                        <label><?php echo $row['no_child'];?></label>
<?php }?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Mobile No.</label></div>
                    <div class="col-md-2"><label><?php echo $row['mobile'];?></label></div>
                    <div class="col-md-2"><label>Tel No.</label></div>
                    <div class="col-md-2"><label><?php echo $row['tel'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Email</label></div>
                    <div class="col-md-2"><label><?php echo $row['email'];?></label></div>
                    <div class="col-md-2"><label>Personal Remark</label></div>
                    <div class="col-md-2"><label><?php echo $row['personal_remark'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-2"><label>Customer Status</label></div>
                    <div class="col-md-2"><label style="color: <?php if ($row['status'] != "Active") { echo "red;"; } else { echo "green;"; } ?>"><?php echo $row['status'];?></label></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-2"><label>BlackList</label></div>
                    <div class="col-md-2"><label style="color: green;">Clear</label></div>
                    <div class="col-md-2"></div>
                </div>
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
                    <div class="col-md-2">
                        <select class="form-control" name="is_pawn">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-2"><label>Pawn Category</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="pawn_category">
                            <option value="-- None --">-- None --</option>
                            <option value="Gold & Jewelry">Gold & Jewelry</option>
                            <option value="Diamond & Gem">Diamond & Gem</option>
                            <option value="Luxury Watches">Luxury Watches</option>
                            <option value="Luxury Bags & Garments">Luxury Bags & Garments</option>
                            <option value="Electronics Goods">Electronics Goods</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Pawn Item(s)</label></div>
                    <div class="col-md-2"><input type="text" name="pawn_item" class="form-control"></div>
                    <div class="col-md-6"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-1"><label>Pawn Image</label></div>
                    <div class="col-md-2"><input type="file" name="pawn_image1"></div>
                    <div class="col-md-1"><label>Pawn Image</label></div>
                    <div class="col-md-2"><input type="file" name="pawn_image2"></div>
                    <div class="col-md-1"><label>Pawn Image</label></div>
                    <div class="col-md-2"><input type="file" name="pawn_image3"></div>
                    <div class="col-md-1"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Contra Loan (If Applicable)</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Contra Loan ID</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="contra_loan">
                            <option value="--- Select Contra Loan ID ---">--- Select Contra Loan ID ---</option>
<?php
$sql1 = "SELECT id FROM a_loan WHERE customer = '".$customer_id."' AND status != 'Completed';";
$res1 = mysqli_query($conn, $sql1);
while ($myrow1 = mysqli_fetch_array($res1)) {?>
                            <option value="<?php echo $myrow1['id'];?>"><?php echo $myrow1['id'];?></option>
<?php }?>
                        </select>
                    </div>
                    <div class="col-md-2"><label>Contra Amount</label></div>
                    <div class="col-md-2"><input type="text" name="contra_amount" class="form-control"></div>
                    <div class="col-md-2"></div>
                </div>
                <hr style="border-color: lightgrey;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Loan Sharing (If Applicable)</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Sharing With</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="branch2">
                            <option value="--- Select Branch ---">--- Select Branch ---</option>
                        </select>
                    </div>
                    <div class="col-md-6"></div>
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
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label><span style="color: red;">*</span> Application Date</label></div>
                    <div class="col-md-2"><input type="datetime-local" name="application_date" class="form-control" required></div>
                    <div class="col-md-2"><label>Loan Source</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="loan_source">
                            <option value="--- Select Loan Source ---">--- Select Loan Source ---</option>
                            <option value="KL (Inquiry)">KL (Inquiry)</option>
                            <option value="JB (Inquiry)">JB (Inquiry)</option>
                            <option value="OS (Inquiry)">OS (Inquiry)</option>
                            <option value="INDON (Inquiry)">INDON (Inquiry)</option>
                            <option value="Friend/Family Intro">Friend/Family Intro</option>
                            <option value="Repeated Loan">Repeated Loan</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label><span style="color: red;">*</span> Loan Start Date</label></div>
                    <div class="col-md-2"><input type="datetime-local" name="start_date" class="form-control" required></div>
                    <div class="col-md-2"><label>Loan Method</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="loan_method">
                            <option value="Normal">Normal</option>
                            <option value="OBL Method">OBL Method</option>
                            <option value="Credit">Credit</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label><span style="color: red;">*</span> Dept Period</label></div>
                    <div class="col-md-2"><input type="text" name="dept_period" class="form-control" required></div>
                    <div class="col-md-2"><label>Loan Package</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="loan_package">
                            <option value="Normal">Normal</option>
                            <option value="Trial (300)">Trial (300)</option>
                            <option value="High Risk">High Risk</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label><span style="color: red;">*</span> Dept Type</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="dept_type">
                            <option value="--- Select Dept Type ---">--- Select Dept Type ---</option>
                            <option value="Daily">Daily</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Monthly">Monthly</option>
                        </select>
                    </div>
                    <div class="col-md-2"><label>Remark</label></div>
                    <div class="col-md-2"><input type="text" name="remark" class="form-control"></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Instalment Period</label></div>
                    <div class="col-md-2"><input type="text" name="instalment_period" class="form-control"></div>
                    <div class="col-md-2"><label><span style="color: red;">*</span> Principal Amount</label></div>
                    <div class="col-md-2"><input type="text" name="principal_amount" class="form-control" required></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Instalment Type</label></div>
                    <div class="col-md-2">
                        <select class="form-control" name="instalment_type">
                            <option value="--- Select Instalment Type ---">--- Select Instalment Type ---</option>
                            <option value="Daily">Daily</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Monthly">Monthly</option>
                        </select>
                    </div>
                    <div class="col-md-2"><label>Deposit Amount</label></div>
                    <div class="col-md-2"><input type="text" name="deposit_amount" class="form-control"></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Interest (%)</label></div>
                    <div class="col-md-2"><input type="text" name="interest" class="form-control"></div>
                    <div class="col-md-2"><label>Application Fee</label></div>
                    <div class="col-md-2"><input type="text" name="application_fee" class="form-control"></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><label>Interest (Fixed)</label></div>
                    <div class="col-md-2"><input type="text" name="interest_fixed" class="form-control"></div>
                    <div class="col-md-2"><label>Payment Upfront</label></div>
                    <div class="col-md-2"><input type="text" name="payment_upfront" class="form-control"></div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8"><label><input type="checkbox" name="only_interest" style="margin-right: 5px;">Only Interest</label></div>
                </div>
                <br>
                <div class="row form-group">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success" name="function" value="create">Create</button>
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
        <div class="container">
            <div class="row">
                <table cellspacing="0" cellpadding="2" class="table table-striped table-bordered" style="width: 100%;">
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
