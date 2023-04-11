<?php 
include('config.php');
$date = explode('-',$_POST['date']);
$card_ids = $_POST['card_ids'];
$center_type = $_POST['center_type'];
$d_startMonth = $date[1];
$d_startYear = $date[2];
$where = '';
if($center_type=='all')
{
	$where ='WHERE 1=1';
}
else
{
	$where ="WHERE center_id = ".$center_type;
}

			
$result_collection = array();

if ($_SESSION["group_name"] == 'superadmin') {
	$sql_query ="SELECT * FROM customers_card ".$where;
}
else{
	//$abc_hwe="SELECT * from customers where user_agent_id=".$_SESSION['agent_id'];
	$sql_query ="SELECT * FROM customers_card ".$where." AND user_agent_id=".$_SESSION['agent_id'];
}


$results = mysqli_query($conn,$sql_query);
$customercard_id = array();
if($results->num_rows > 0)
{
	while($rows = $results->fetch_assoc())
	{
		$date_of_record = explode('-',$rows['start_date']);
		
		/*if($d_startMonth == $date_of_record[1] && $d_startYear == $date_of_record[2])
		{*/
			$customercard_id[]=$rows['id'];
			$result_collection[$rows['start_date']]['loan_out']+=$rows['loan_out'];
			$result_collection[$rows['start_date']]['profit']+=$rows['profit'];
			$result_collection[$rows['start_date']]['customer_id'][]=$rows['customer_id'];
		//}
	}
}

$where .= ' and card_id IN ('.implode(',',$customercard_id).')';
$sql ="SELECT * FROM collection ".$where."";

$result = mysqli_query($conn,$sql );

if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$date_hwe ='';
		$date_hwe = date('d-m-Y',$row['d_date_disp']);
		$date_hwe2 =  explode('-',$date_hwe);
		if($d_startMonth == $date_hwe2[1] && $d_startYear == $date_hwe2[2])
		{
			$result_collection[$date_hwe]['collection'] += $row['amount'];
			$result_collection[$date_hwe]['card_id'][]=$row['card_id'];
			
		}
	}
}

$html='';
$loan_outtotal = 0;
$amount = 0;
foreach($result_collection as $key=> $val)
{	
	if($key==$_POST['date'])
	{
		foreach($val['card_id'] as $card_id)
		{
			$amount_balance = 0;
			$loan_out=0;
			$customer_id ='';
			$collectiondetail = mysqli_query($conn,"SELECT * FROM collection where card_id=".$card_id." AND d_date_disp=".strtotime($key));
			if(mysqli_num_rows($collectiondetail)>0)
			{
				while($row_collection = mysqli_fetch_assoc($collectiondetail))
				{
					$amount_balance+=$row_collection['amount'];
				}
			}
			$get_card = mysqli_query($conn,"SELECT * FROM customers_card where id=".$card_id);
			if(mysqli_num_rows($get_card)>0)
			{
				while($row_card = mysqli_fetch_assoc($get_card))
				{
					$customer_id =$row_card['customer_id'];
					$loan_out=$row_card['loan_out'];
				}
			}
			$row_customer='';
			$customerdetail = mysqli_query($conn,"SELECT * FROM customers where id=".$customer_id);
			if(mysqli_num_rows($customerdetail)>0)
			{
				$row_customer = mysqli_fetch_assoc($customerdetail);
			}
			$html.='<tr>';
			$html.='<td>'.$row_customer['id'].'</td>';
			$html.='<td><a href="customer_card.php?t_cust_id='.$row_customer['id'].'&Submit=1" style="color: blue;">'.$row_customer['name'].'</a></td>';
			$html.='<td>'.$card_id.'</td>';
			$html.='<td>'.$loan_out.'</td>';
			$html.='<td>'.$amount_balance.'</td>';
			$html.='</tr>';
			$loan_outtotal+=$loan_out;
			$amount+=$amount_balance;
		}
	}
}

$html.='<tr>';
$html.='<td>Total</td>';
$html.='<td></td>';
$html.='<td></td>';
$html.='<td class="total_td">'.$loan_outtotal.'</td>';
$html.='<td class="total_td">'.$amount.'</td>';
$html.='</tr>';

echo $html;

die;

?>