<?php 
include('header.php');

$customer_card_table = "CREATE TABLE IF NOT EXISTS ".$table_prefix."customers_card (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT(11) NOT NULL,
	center_id VARCHAR(255) NOT NULL,
	amt_per_day VARCHAR(255),
	no_of_terms VARCHAR(255),
	start_date VARCHAR(255),
	duration VARCHAR(255),
	advance VARCHAR(255),
	loan_out VARCHAR(255),
	deposit VARCHAR(255),
	crossed VARCHAR(255),
	crossed_date VARCHAR(100),
	profit VARCHAR(255),
	clear_payment VARCHAR(50),
	user_agent_id INT(11)
)";

if (mysqli_query($conn, $customer_card_table)) {
  
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
$agent_id = $_SESSION["agent_id"];
$customer_id = $t_center_id = $f_term_amt =$i_term =$d_startDay =$d_startMonth = $d_startYear = $start_date = $t_duration =$f_adv = $f_loan_out =$f_deposit =$f_profit =$name =$new_IC = '';

if(isset($_POST['confirmNewCard']))
{

	$t_cust_id = $_POST['t_cust_id'];
	//$customer_name = $_POST['cust_name'];
	$t_center_id = $_POST['t_center_id'];
	$f_term_amt = $_POST['f_term_amt'];
	$i_term = $_POST['i_term'];
	
	$start_date =$_POST['start_date'];
	
	$t_duration = $_POST['t_duration'];
	$f_adv = $_POST['f_adv'];
	$f_loan_out = $_POST['f_loan_out'];
	$f_deposit = $_POST['f_deposit'];
	$f_profit = $_POST['f_profit'];

	$query = "SELECT * FROM ".$table_prefix."customers where id = $customer_id";
	$result = mysqli_query($conn, $query);
	
	if($result->num_rows > 0)
	{
		//print_r($result->fetch_assoc());	
		$row = $result->fetch_assoc();
		$name = $row['name'];
		$new_IC = $row['new_IC'];
	}
	$sql = "INSERT INTO ".$table_prefix."customers_card (
	customer_id,
	center_id,
	amt_per_day,
	no_of_terms,
	start_date,
	duration,
	advance,
	loan_out,
	deposit,
	crossed,
	crossed_date,
	profit,
	clear_payment,user_agent_id) VALUES ($t_cust_id ,
	'$t_center_id',
	'$f_term_amt',
	'$i_term',
	'$start_date',
	'$t_duration',
	'$f_adv',
	'$f_loan_out',
	'$f_deposit',
	'',
	'',
	'$f_profit',
	'',
	$agent_id)";	
	if(mysqli_query($conn, $sql)) {
		
		$success = "The customer card is successfully added.";
	} 
}
elseif(isset($_POST['update_card']))
{
	$t_cust_id = $_POST['t_cust_id'];
	//$customer_name = $_POST['cust_name'];
	$t_center_id = $_POST['t_center_id'];
	$f_term_amt = $_POST['f_term_amt'];
	$i_term = $_POST['i_term'];
	$d_startDay = $_POST['d_startDay'];
	$d_startMonth = $_POST['d_startMonth'];
	$d_startYear = $_POST['d_startYear'];
	
	$start_date = $d_startDay.'-'.$d_startMonth.'-'.$d_startYear;
	
	$t_duration = $_POST['t_duration'];
	$f_adv = $_POST['f_adv'];
	$f_loan_out = $_POST['f_loan_out'];
	$f_deposit = $_POST['f_deposit'];
	$f_profit = $_POST['f_profit'];
	$sql = "UPDATE ".$table_prefix."customers_card SET center_id='$t_center_id',amt_per_day='$f_term_amt',no_of_terms='$i_term',start_date='$start_date',duration='$t_duration',advance='$f_adv',loan_out='$f_loan_out',deposit='$f_deposit',profit='$f_profit' WHERE id = ".$_REQUEST['cust'];	
	if(mysqli_query($conn, $sql)) {
		$success = "Customer card updated successfully.";
	} 
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <center> <h1>Customer Card</h1></center>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
	if(isset($_GET['t_cust_id']) || isset($_GET['customer_id_ic_name'])) {?>
	<a href="customer.php" class="btn btn-info">Back</a>
	<?php }
	if(isset($success))
	{
	?>
    <section>
    	<div class="container">
        	<div class="row">
            	<div class="col-md-3"></div>
                <div class="col-md-6" style="color: green;font-size: 26px;">
                	<?php echo $success;?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
   <br/>
    <?php
	}
	if(isset($_REQUEST['cust']) && isset($_REQUEST['card']))
	{
		
		$card_id = $_REQUEST['cust'];
		$query = "SELECT * FROM ".$table_prefix."customers_card where id = $card_id";
		$result = mysqli_query($conn, $query);
		$customer_id ='';
		if($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();	
			
			$customer_id = $row['customer_id'];
			$t_center_id = $row['center_id'];
			$f_term_amt = $row['amt_per_day'];
			$i_term = $row['no_of_terms'];
			
			$start_date = $row['start_date'];
			$date = explode('-',$start_date);
			
			$d_startDay = $date[0];
			$d_startMonth = $date[1];
			$d_startYear = $date[2];
			
			$t_duration = $row['duration'];
			$f_adv = $row['advance'];
			$f_loan_out = $row['loan_out'];
			$f_deposit = $row['deposit'];
			$f_profit = $row['profit'];
		}
		
		$query1 = "SELECT * FROM ".$table_prefix."customers where id =$customer_id";
		$result1 = mysqli_query($conn, $query1);
		
		if($result1->num_rows > 0)
		{
			$row = $result1->fetch_assoc();	
			$t_cust_id = $row['id'];
			$name = $row['name'];
			$new_IC = $row['new_IC'];
		}
		
	?>
    <section>
    	<div class="container">
        	<form id="form1" name="form1" method="post">
            	<input name="t_cust_id" type="hidden" id="t_cust_id" value="<?php echo $t_cust_id; ?>" size="30" maxlength="30">
                <input name="card_id" type="hidden" id="card_id" value="<?php echo $card_id; ?>" size="30" maxlength="30">
            	<div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>IC/Passport</label>
                    </div>
                    <div class="col-md-6">
                    	<span class="SpecialHeader"><?php echo $new_IC; ?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Name</label>
                    </div>
                    <div class="col-md-6">
                    	<span class="SpecialHeader"><?php echo $name; ?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Center ID</label>
                    </div>
                    <div class="col-md-6">
                    	                    
                    	<select name="t_center_id" class="form-control" style="width:50%">
                        <?php 
						$current_user_center= '';
					
						if($_SESSION["group_name"]!='superadmin')
						{
							$current_user_center = "WHERE id = ".$_SESSION["center_id"];
							
						}				
							$select_center_deatil = "SELECT * FROM ".$table_prefix."center_detail ".$current_user_center." ORDER BY show_sequence ASC";
						

							$result = mysqli_query($conn,$select_center_deatil);
							if($result->num_rows > 0)
							{
								//$count=0;
								
								while($row = $result->fetch_assoc()){
										
						?>
                        <option value="<?php echo $row['id'];?>" <?php if($t_center_id == $row['id']){ echo 'selected="selected"';} ?>><?php echo $row['center_name'];?></option>                            
                        <?php }}?>
                        
                        
                        
                            <!--<option value="1" <?php if($t_center_id == '1'){ echo 'selected="selected"';} ?>>1 - Company</option>
                            <option value="2" <?php if($t_center_id == '2'){ echo 'selected="selected"';} ?>>2 - A</option>
                            <option value="3" <?php if($t_center_id == '3'){ echo 'selected="selected"';} ?>>3 - B</option>
                            <option value="4" <?php if($t_center_id == '4'){ echo 'selected="selected"';} ?>>4 - C</option>
                            <option value="5" <?php if($t_center_id == '5'){ echo 'selected="selected"';} ?>>5 - D</option>-->
                        </select>
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Card ID</label>
                    </div>
                    <div class="col-md-6">
                    	<span class="ErrMsg"><?php echo $card_id; ?></span> 
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Amount Per Day </label>
                    </div>
                    <div class="col-md-6">
                    	
                    	<input name="f_term_amt" type="text" id="f_term_amt" required class="form-control" value="<?php echo $f_term_amt;?>">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>No Of Term </label>
                    </div>
                    <div class="col-md-6">
                    
                    	<input name="i_term" type="text" required  id="i_term" class="form-control" value="<?php echo $i_term;?>">
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Start Date</label>
                    </div>
                    <div class="col-md-6">
                    	
                    	<div class="col-md-4">
                        	
                        	<select name="d_startDay" class="form-control">
							<?php 
                            for($i=1; $i<=31; $i++)
                            {
                                if($i<10)
                                {
                                    $i = '0'.$i;
                                }
                            ?>
                            <option value="<?php echo $i; ?>"  <?php if($d_startDay == $i){ echo 'selected="selected"';} ?>><?php echo $i; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        </div>
                        
                        <div class="col-md-4">
                            <select name="d_startMonth" class="form-control">
                         
                              <?php 
                                for($i=1; $i<=12; $i++)
                                {
                                    if($i<10)
                                    {
                                        $i = '0'.$i;
                                    }
                                ?>
                                <option value="<?php echo $i; ?>"  <?php if($d_startMonth == $i){ echo 'selected="selected"';} ?>><?php echo $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                       
                        <div class="col-md-4">
                        	<select name="d_startYear" class="form-control">       
                             <?php 
								$current_year = date("Y");
								for($i = date('Y'); $i <= date('Y', strtotime('+2 year')); $i++)
								{
							?>
							<option value="<?php echo $i; ?>" <?php if($d_startYear == $i){ echo 'selected="selected"';} ?>><?php echo $i; ?></option>
							<?php
								}
							?>
                            
                        </select>
                        </div>
                       
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Duration </label>
                    </div>
                    <div class="col-md-6">
                    	
                        <select name="t_duration" class="form-control" style="width:50%">
                            <option value="01" <?php if($t_duration=='01'){ echo 'selected="selected"';} ?>>01 - Daily</option>
                            <option value="07" <?php if($t_duration=='07'){ echo 'selected="selected"';} ?>>07 - Weekly</option>
                            <option value="10" <?php if($t_duration=='10'){ echo 'selected="selected"';} ?>>10 - 10 days</option>
                            <option value="14" <?php if($t_duration=='14'){ echo 'selected="selected"';} ?>>14 - Bi Weekly</option>
                            <option value="15" <?php if($t_duration=='15'){ echo 'selected="selected"';} ?>>15 - half month</option>
                            <option value="20" <?php if($t_duration=='20'){ echo 'selected="selected"';} ?>>20 - 20 days</option>
                            <option value="21" <?php if($t_duration=='21'){ echo 'selected="selected"';} ?>>21 - 3 weeks</option>
                            <option value="30" <?php if($t_duration=='30'){ echo 'selected="selected"';} ?>>30 - monthly</option>
                        </select>
                       
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Advance </label>
                    </div>
                    <div class="col-md-6">
                    	
                    	<input name="f_adv" required  type="text" class="form-control" id="f_adv" value="<?php echo $f_adv;?>">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Loan Out </label>
                    </div>
                    <div class="col-md-6">
                    
                    	<input name="f_loan_out" required  class="form-control" type="text" id="f_loan_out" value="<?php echo $f_loan_out;?>">
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Deposit </label>
                    </div>
                    <div class="col-md-6">
                    	
                    	<input name="f_deposit" required  class="form-control" type="text" id="f_deposit" value="<?php echo $f_deposit;?>">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Profit </label>
                    </div>
                    <div class="col-md-6">
                    	
                    	<input name="f_profit" required  class="form-control" type="text" id="f_profit" value="<?php echo $f_profit;?>">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                    	
                    	<input name="update_card" class="btn btn-success" type="submit" id="update_card" value="update Card">&nbsp;&nbsp; 
                        <a href="customer.php?t_cust_id=<?php echo $t_cust_id; ?>" class="btn btn-success">Cancel</a>
                       <!-- <input type="submit" class="btn btn-success" name="Submit2" value="Cancel">-->
                       
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
            </form>
        </div>
    </section>
    <?php
	}
	elseif(isset($_POST['NewCard']))
	{
		$t_cust_id = $_POST['t_cust_id'];
		$query = "SELECT * FROM ".$table_prefix."customers where id = $t_cust_id";
		$result = mysqli_query($conn, $query);
		
		if($result->num_rows > 0)
		{
			//print_r($result->fetch_assoc());	
			$row = $result->fetch_assoc();
			$name = $row['name'];
			$new_IC = $row['new_IC'];
		}
		$t_center_id = $_POST['t_center_id'];
		$f_term_amt = $_POST['f_term_amt'];
		$i_term = $_POST['i_term'];
		$d_startDay = $_POST['d_startDay'];
		$d_startMonth = $_POST['d_startMonth'];
		$d_startYear = $_POST['d_startYear'];
		
		$start_date = $d_startDay.'-'.$d_startMonth.'-'.$d_startYear;
		
		$t_duration = $_POST['t_duration'];
		$f_adv = $_POST['f_adv'];
		$f_loan_out = $_POST['f_loan_out'];
		$f_deposit = $_POST['f_deposit'];
		$f_profit = $_POST['f_profit'];
	?>
    <section>
    	<div class="container">
        	<form id="form1" name="form1" method="post">
            	<input name="t_cust_id" type="hidden" id="t_cust_id" value="<?php echo $t_cust_id; ?>" size="30" maxlength="30">
            	<div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>IC/Passport</label>
                    </div>
                    <div class="col-md-6">
                    	<span class="SpecialHeader"><?php echo $new_IC; ?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Name</label>
                    </div>
                    <div class="col-md-6">
                    	<span class="SpecialHeader"><?php echo $name; ?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Center ID</label>
                    </div>
                    <div class="col-md-6">
                    	<input type="hidden" name="t_center_id" value="<?php echo $t_center_id;?>"/>
                    	<span><?php echo $t_center_id;?></span>                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Card ID</label>
                    </div>
                    <div class="col-md-6">
                    	<span class="ErrMsg">自動生成</span> 
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Amount per Day</label>
                    </div>
                    <div class="col-md-6">
                    <input type="hidden" name="f_term_amt" value="<?php echo $f_term_amt;?>"/>
                    	<span><?php echo $f_term_amt;?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Deadline</label>
                    </div>
                    <div class="col-md-6">
                    <span>
						<input type="hidden" name="i_term" value="<?php echo $i_term;?>"/>
					<?php echo $i_term;?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Start Date</label>
                    </div>
                    <div class="col-md-6">
                    	<input type="hidden" name="start_date" value="<?php echo $start_date;?>"/>
                    	<span><?php echo $start_date;?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Duration</label>
                    </div>
                    <div class="col-md-6">
                    <input type="hidden" name="t_duration" value="<?php echo $t_duration;?>"/>
                    	<span><?php echo $t_duration;?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Advance</label>
                    </div>
                    <div class="col-md-6">
                    <input type="hidden" name="f_adv" value="<?php echo $f_adv;?>"/>
                    	<span><?php echo $f_adv;?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Out</label>
                    </div>
                    <div class="col-md-6">
                     <input type="hidden" name="f_loan_out" value="<?php echo $f_loan_out;?>"/>
                    <span><?php echo $f_loan_out;?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Deposit</label>
                    </div>
                    <div class="col-md-6">
                    <input type="hidden" name="f_deposit" value="<?php echo $f_deposit;?>"/>
                    	<span><?php echo $f_deposit;?></span>
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Profit</label>
                    </div>
                    <div class="col-md-6">
                    <input type="hidden" name="f_profit" value="<?php echo $f_profit;?>"/>
                    	<span><?php echo $f_profit;?></span>
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                    	
                    	<input name="confirmNewCard" class="btn btn-success" type="submit" id="confirmNewCard" value="Confirm New Card">
                       
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
            </form>
        </div>
    </section>
    
    
    <?php
	}
	elseif(isset($_POST['AddCard']))
	{
		$t_cust_id = $_POST['t_cust_id'];
		$query = "SELECT * FROM ".$table_prefix."customers where id = $t_cust_id";
		$result = mysqli_query($conn, $query);
		
		if($result->num_rows > 0)
		{
			//print_r($result->fetch_assoc());	
			$row = $result->fetch_assoc();
			$name = $row['name'];
			$new_IC = $row['new_IC'];
		}
		
		$t_center_id = $_POST['t_center_id'];
		$f_term_amt = $_POST['f_term_amt'];
		$i_term = $_POST['i_term'];
		$d_startDay = $_POST['d_startDay'];
		$d_startMonth = $_POST['d_startMonth'];
		$d_startYear = $_POST['d_startYear'];
		
		$start_date = $d_startDay.'-'.$d_startMonth.'-'.$d_startYear;
		
		$t_duration = $_POST['t_duration'];
		$f_adv = $_POST['f_adv'];
		$f_loan_out = $_POST['f_loan_out'];
		$f_deposit = $_POST['f_deposit'];
		$f_profit = $_POST['f_profit'];
		
	?>
    <section>
    	<div class="container">
        	<form id="form1" name="form1" method="post">
            	<input name="t_cust_id" type="hidden" id="t_cust_id" value="<?php echo $t_cust_id; ?>" size="30" maxlength="30">
            	<div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>IC/Passport</label>
                    </div>
                    <div class="col-md-6">
                    	<span class="SpecialHeader"><?php echo $new_IC; ?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Name</label>
                    </div>
                    <div class="col-md-6">
                    	<span class="SpecialHeader"><?php echo $name; ?></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Center ID</label>
                    </div>
                    <div class="col-md-6">
                    	                    
                    	<select name="t_center_id" class="form-control" style="width:50%">
                        <?php 
						$current_user_center= '';
						if($_SESSION["group_name"]!='superadmin')
						{
							$current_user_center = "WHERE id = ".$_SESSION["center_id"];
						}
						
						
							$select_center_deatil = "SELECT * FROM ".$table_prefix."center_detail ".$current_user_center." ORDER BY show_sequence ASC";
							$result = mysqli_query($conn,$select_center_deatil);
							if($result->num_rows > 0)
							{
								//$count=0;
								
								while($row = $result->fetch_assoc()){
										
						?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['center_name'];?></option>                            
                        <?php }}?>
                         <!--<option value="1">1 - Company</option>
                            <option value="2">2 - A</option>
                            <option value="3">3 - B</option>
                            <option value="4">4 - C</option>
                            <option value="5">5 - D</option>-->
                        </select>
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Card No</label>
                    </div>
                    <div class="col-md-6">
                    	<span class="ErrMsg">Auto Generated</span> 
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Amount per Day</label>
                    </div>
                    <div class="col-md-6">
                    	
                    	<input name="f_term_amt" type="text" id="f_term_amt" required class="form-control" value="">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Deadline</label>
                    </div>
                    <div class="col-md-6">
                    
                    	<input name="i_term" type="text" required  id="i_term" class="form-control" value="">
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Start Date</label>
                    </div>
                    <div class="col-md-6">
                    	
                    	<div class="col-md-4">
                        	
                        	<select name="d_startDay" class="form-control">
							<?php 
							$current_date = date('d');
                            for($i=1; $i<=31; $i++)
                            {
                                if($i<10)
                                {
                                    $i = '0'.$i;
                                }
                            ?>
                            <option value="<?php echo $i; ?>" <?php if($i == $current_date){echo 'selected="selected"';} ?>><?php echo $i; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        </div>
                        
                        <div class="col-md-4">
                            <select name="d_startMonth" class="form-control">
                         
                              <?php 
							  $current_month = date('m');
                                for($i=1; $i<=12; $i++)
                                {
                                    if($i<10)
                                    {
                                        $i = '0'.$i;
                                    }
                                ?>
                                <option value="<?php echo $i; ?>" <?php if($i == $current_month){echo 'selected="selected"';} ?>><?php echo $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                       
                        <div class="col-md-4">
                        	<select name="d_startYear" class="form-control">       
                             <?php 
								$current_year = date("Y");
								for($i = date('Y'); $i <= date('Y', strtotime('+2 year')); $i++)
								{
							?>
							<option value="<?php echo $i; ?>" <?php if($i == $current_year){echo 'selected="selected"';} ?>><?php echo $i; ?></option>
							<?php
								}
							?>
                            
                        </select>
                        </div>
                       
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Duration</label>
                    </div>
                    <div class="col-md-6">
                    	
                        <select name="t_duration" class="form-control" style="width:50%">
                            <option label="01 - Daily" value="01">01 - Daily</option>
                            <option label="07 - Weekly" value="07">07 - Weekly</option>
                            <option label="10 - 10 days" value="10">10 - 10 days</option>
                            <option label="14 - Bi Weekly" value="14">14 - Bi Weekly</option>
                            <option label="15 - half month" value="15">15 - half month</option>
                            <option label="20 - 20 days" value="20">20 - 20 days</option>
                            <option label="21 - 3 weeks" value="21">21 - 3 weeks</option>
                            <option label="30 - monthly" value="30">30 - monthly</option>
                        </select>
                       
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Advance</label>
                    </div>
                    <div class="col-md-6">
                    	
                    	<input name="f_adv" required  type="text" class="form-control" id="f_adv" value="">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Out</label>
                    </div>
                    <div class="col-md-6">
                    
                    	<input name="f_loan_out" required  class="form-control" type="text" id="f_loan_out" value="">
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Deposit</label>
                    </div>
                    <div class="col-md-6">
                    	
                    	<input name="f_deposit" required  class="form-control" type="text" id="f_deposit" value="">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2">
                    	<label>Profit</label>
                    </div>
                    <div class="col-md-6">
                    	
                    	<input name="f_profit" required  class="form-control" type="text" id="f_profit" value="">
                      
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
                <div class="row form-group">
                	<div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                    	
                    	<input name="NewCard" class="btn btn-success" type="submit" id="NewCard" value="Create New Card">&nbsp;&nbsp; <input type="reset" class="btn btn-success" name="Submit2" value="Reset">
                       
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br/>
            </form>
        </div>
    </section>
    
   
	<?php
    } 
	elseif(isset($_REQUEST['t_cust_id']) || isset($_POST['Submit2']) )
	{
		$customer_id = $_REQUEST['t_cust_id'];
		$query = "SELECT * FROM ".$table_prefix."customers where id = $customer_id";
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
			$customer_pic = $row['customer_pic'];
			$customer_pic_ic = $row['customer_pic_ic'];
			$customer_guaranty_pic = $row['customer_guarantor_pic'];
			$remark = $row['remark'];
			$how_to_know = $row['how_to_know'];
		}
		
	?>
    <section>
    	<div class="container" style="overflow-x: auto;">
        	<table cellspacing="2" class="table customer_info" cellpadding="2" border="0" align="center" style="width: 70%;">
    
                    <tbody><tr>
                      <td colspan="3" class="SubMenuCaption" bgcolor="#038603">Customer Detail</td>
                    </tr>
                    <tr>
                      <td bgcolor="#CCCCCC">ID : <span class="SpecialHeader"><?php echo $customer_id;?></span></td>
                      <td bgcolor="#CCCCCC" colspan="2">Name: 
                      <label><span class="SpecialHeader"><?php echo $customer_name;?></span></label></td>
                    </tr>
                    <tr>
                      <td bgcolor="#CCCCCC" colspan="3">Address: 
                        <br>
                        <span class="SpecialHeader"><?php echo $customer_address1;?><br>
                        <?php echo $customer_address2;?><br>
                        <?php echo $customer_address3;?><br>
                      <?php echo $customer_address4;?></span></td>
                    </tr>
                    <tr>
                      <td bgcolor="#CCCCCC">Phone: 
                        
                        <span class="SpecialHeader"><?php echo $customer_telephone1;?><br>
                      </span>
                      
                        <span class="SpecialHeader"><?php echo $customer_telephone2;?><br>
                      </span></td>
                      <td bgcolor="#CCCCCC" colspan="2">Gender : 
                      <label><span class="SpecialHeader"><?php echo $t_gender;?></span></label></td>
                    </tr>
                    <tr>
                      <td bgcolor="#CCCCCC">Remark : <span class="SpecialHeader"><?php echo $remark;?></span></td>
                      <td bgcolor="#CCCCCC" colspan="2">How to know : 
                      <label><span class="SpecialHeader"><?php echo $how_to_know;?></span></label></td>
                    </tr>
                    <tr>
                      <td colspan="3" bgcolor="#CCCCCC"><div align="center"><a href="<?php if ($_SESSION['center_id'] == "6") { echo "ax_"; }?>register_new_customer.php?cust=<?php echo $customer_id;?>" class="btn btn-success">Edit Customer</a> </div></td>
                    </tr>
                  </tbody></table>
        </div>
    </section>
    <br/>
    <?php 
		//$query = "SELECT * FROM customers_card WHERE customer_id = ";
	?>
    <section>
    	<div class="container" style="overflow-x: auto;">
        	<table cellspacing="0" cellpadding="2" align="center" class="table table-bordered table-striped">
        		<caption class="menu-header">
        			Quotation Information
        		</caption>
        		<thead>
        			<tr style="text-align: center;">
	                    <th>No.</th>
	                    <th>Quotation No.</th>
	                    <th>State</th>
	                    <th>Date</th>
	                    <th>Dealer</th>
	                    <th style="text-align: right;">Total Amount</th>
	                    <th>&nbsp;</th>
	                </tr>
	            </thead>
	            <tbody>
                  <?php 
					//$sql = "SELECT * FROM customers_card WHERE customer_id = $customer_id".$current_user_center." AND clear_payment!=1";
					$sql = "SELECT * FROM quotation WHERE customer_id = '".$customer_id."' ORDER BY id DESC;";
					$result = mysqli_query($conn,$sql); 
					if($result->num_rows > 0)
					{
						$count=0;
						
						while($row = $result->fetch_assoc()) {
				  ?>
                  
	                <tr style="text-align: center;">
	                    <td><?php echo ++$count; ?></td>
	                    <td><?php echo $row['id']; ?></td>
	                    <td><?php echo $row['state']; ?></td>
	                    <td><?php echo $row['date']; ?></td>
	                    <?php
	                    $sql = "SELECT * FROM users WHERE id = '".$row['agent_id']."';";
	                    $res = mysqli_query($conn, $sql);
	                    $myrow = mysqli_fetch_assoc($res);
	                    ?>
	                    <td><?php echo $myrow['user_name']; ?></td>
	                    <?php
	                    $subtotal = 0;
	                    $sql = "SELECT * FROM quotation_details WHERE quotation_id = '".$row['id']."';";
	                    $res = mysqli_query($conn, $sql);
	                    while ($myrow = mysqli_fetch_array($res)) {
	                    	$subtotal += $myrow['price'];
	                    }
	                    ?>
	                    <td style="text-align: right;"><?php printf("RM%0.2f", $subtotal);?></td>
	                    <td style="text-align: left;">
	                   	<?php
	                   	if ($row['state'] == "Pending") {?>
	                      	<a href="quotation.php?c=<?php echo $customer_id;?>&q=<?php echo $row['id']; ?>" class="btn btn-success">Order Detail</a>
	                      	<a onclick="return confirm('Are you sure to cancel this order?')" href="cancelled_quotation.php?q=<?php echo $row['id']; ?>" class="btn btn-success">Cancel Order</a>
	                      	<a href="confirm_quotation.php?q=<?php echo $row['id']; ?>" class="btn btn-success">Confirm Order</a>
	                   	<?php } elseif ($row['state'] == "Cancelled") {?>
	                      	<a href="quotation.php?c=<?php echo $customer_id;?>&q=<?php echo $row['id']; ?>" class="btn btn-success">Order Details</a>
	                   		<a onclick="return confirm('Are you sure to restore this order?')" href="cancelled_quotation.php?q=<?php echo $row['id']; ?>" class="btn btn-success">Restore Order</a>
	                   	<?php } elseif ($row['state'] == "Confirmed") {
	                   		echo "Waiting for admin processing.";?>
	                      	<a onclick="return confirm('Are you sure to cancel this order?')" href="cancelled_quotation.php?q=<?php echo $row['id']; ?>" class="btn btn-success">Cancel order</a>
	                   	<?php } elseif ($row['state'] == "Completed") {?>
	                      	<a href="quotation.php?c=<?php echo $customer_id;?>&q=<?php echo $row['id']; ?>" class="btn btn-success">Order Detail</a>
	                   	<?php }?>
	                    </td>
	                </tr>
	                   <?php }}?>
                                            
                </tbody>
            </table>
        </div>
        <br/>
        
        <div class="container">
        	<form id="form1" name="form1" method="post" action="customer.php">
                <p align="center">
                  <label>
                  <!-- <input name="AddCard" type="submit" class="btn btn-success" id="AddCard" value="添加新報價單"> -->
                  <a href="quotation.php?c=<?php echo $_REQUEST['t_cust_id'];?>" class="btn btn-success" target="_self">Add New Quotation</a>
                  </label>
                </p>
            </form>
        </div>
    </section><br/>
    <?php
	}
	else
	{
	?>
    <section>
    	<div class="container">
        	<div class="row">
            	<div class="col-md-3"></div>
                <div class="col-md-6">
                	<form method="get">
                    	<div class="row form-group">
                        	<div class="col-md-6"><label for="customer_id">Customer ID/IC Number/Name</label></div>
                            <div class="col-md-6"><input type="text" name="customer_id_ic_name" class="form-control" value="<?php echo $_REQUEST['customer_id_ic_name']; ?>"/></div>
                        </div>
                        <div class="row form-group">
                        	<div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" name="search">Search</button>
                                &nbsp;&nbsp;
                                <button type="reset" name="reset" class="btn btn-success">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
    <br/>    
    <section>
    	<div class="container">
        	<div class="row" style="overflow-x: auto;">
                    <table cellspacing="0" cellpadding="2" class="table table-striped table-bordered" style="width: 100%;">
                        <caption class="menu-header">
                        Customer Information
                        </caption>
                        <thead>
                            <tr class="customer_table" style="text-align: center;">
                                <th>&nbsp;</th>
                                <th>No</th>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Phone Number</th>
                                <th>Dealer</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
							$agent_id = '';
							$agent_id_search = '';
							
							if(isset($_SESSION["agent_id"]) && !empty($_SESSION["agent_id"]) && $_SESSION["group_name"] !='superadmin')
							{
								$agent_id = ' WHERE user_agent_id = '.$_SESSION["agent_id"];
								$agent_id_search =' AND user_agent_id = '.$_SESSION["agent_id"];
							}
							/*else{
								$agent_id = ' WHERE user_agent_id = '.$_SESSION["last_login"];
								$agent_id_search =' AND user_agent_id = '.$_SESSION["last_login"];
							}*/
							
							
							if(isset($_REQUEST['customer_id_ic_name']) && !empty($_REQUEST['customer_id_ic_name']))
							{
								$value = $_REQUEST['customer_id_ic_name'];
								$search_query = "SELECT * FROM ".$table_prefix."customers WHERE (id LIKE '%$value%' OR name LIKE '%$value%' OR new_IC LIKE '%$value%')".$agent_id_search;
								$result = mysqli_query($conn, $search_query);
								
							}
							else
							{
								$sql = "SELECT * FROM ".$table_prefix."customers".$agent_id;	
								$result = mysqli_query($conn, $sql);
							}
							if ($result->num_rows > 0) 
							{
								$count=0;
								while($row = $result->fetch_assoc()) {
									if($_SESSION["group_name"] !='superadmin')
									{
										
									}
							?>
                            <tr style="text-align: center;">
                            	<td>
                                	<a href="<?php if ($_SESSION['center_id'] == "6") { echo "ax_"; }?>register_new_customer.php?cust=<?php echo $row['id'];?>" class="btn btn-success">Edit</a>
                                  	<a href="customer.php?t_cust_id=<?php echo $row['id'];?>&amp;Submit=1" target="_self" class="btn btn-success">Card</a>
                                </td>
                                <td><?php  echo ++$count;?></td>
                                <td><?php echo  $row['id'];?></td>
                                <td><?php echo  $row['name'];?></td>
                                <td><?php echo  $row['telephone_1'];?></td>
                                <?php  
									$sql_agent = "SELECT * from ".$table_prefix."users WHERE id =".$row['user_agent_id'];
									$result_agent = mysqli_query($conn, $sql_agent);
									if ($result_agent->num_rows > 0) 
									{
										$row_agent = $result_agent->fetch_assoc();
								?>
								<td><?php echo $row_agent['user_name'];?> </td>
								<?php
									}
								?>
                                
                                
                                <td></td>
                            </tr>                            
                            <?php
								}
							}
							else
							{
							?>
                            
                            <tr>
                            	<td colspan="7" class="ErrMsg"><div align="center">***** No user found. Please try again later. ***** </div></td>
                            </tr>
                           <?php }?>
                        </tbody>
                    </table>
                
            </div>
        </div>
    </section>
    <?php 
	}
	?>
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