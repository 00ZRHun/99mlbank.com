<?php 
include('config.php');
$center_id_hwe = $_POST['center_id_hwe'];
$where =" WHERE center_id = ".$center_id_hwe;
$where2 =" WHERE center_id = ".$center_id_hwe;
if($_SESSION["group_name"]!='superadmin')			
{
	$abc_hwe="SELECT * from customers where user_agent_id=".$_SESSION['agent_id'];
	
}
else
{
	$abc_hwe="SELECT * from customers";
}

$result_hwe = mysqli_query($conn,$abc_hwe);
$customer_id=array();
while($rows = $result_hwe->fetch_assoc())
{
	$customer_id[]=$rows['id'];
}
if($_SESSION["group_name"]!='superadmin')			
{
	$where .= ' and customer_id IN ('.implode(',',$customer_id).') and user_agent_id='.$_SESSION['agent_id'];
	
}
else
{
	$where .= ' and customer_id IN ('.implode(',',$customer_id).')';
}

			
$result_collection = array();

$sql_query ="SELECT * FROM customers_card ".$where."  AND clear_payment!=1";
$results = mysqli_query($conn,$sql_query);
$customercard_id=array();
if($results->num_rows > 0)
{
	while($rows = $results->fetch_assoc())
	{
		
		$customercard_id[]=$rows['id'];
		$result_collection[$rows['id']]['loan_out']=$rows['loan_out'];
		$result_collection[$rows['id']]['customer_id']=$rows['customer_id'];
		/*$result_collection[$rows['start_date']]['loan_out']+=$rows['loan_out'];
		$result_collection[$rows['start_date']]['profit']+=$rows['profit'];
		$result_collection[$rows['start_date']]['customer_id'][]=$rows['customer_id'];*/
	}
}

$where2 .= ' and card_id IN ('.implode(',',$customercard_id).')';
$sql ="SELECT * FROM collection ".$where2."";
$result = mysqli_query($conn,$sql );

if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		
		$date_hwe ='';
		//$date_hwe = date('d-m-Y',$row['d_date_disp']);
		$result_collection[$row['card_id']]['collection'] += $row['amount'];
		//$result_collection[$date_hwe]['card_id'][]=$row['card_id'];
			
		
	}
}

$html='';
print_r($result_collection);
$loan_out = 0;
$amount = 0;
$balance = 0;
foreach($result_collection as $key=> $val)
{

	$customerdetail = mysqli_query($conn,"SELECT * FROM customers where id=".$val['customer_id']);
	if(mysqli_num_rows($customerdetail)>0)
	{
		$loan_out += $val['loan_out'];
		$amount +=$val['collection'];
		$balance +=$val['collection']-$val['loan_out'];
		$customer_data = mysqli_fetch_assoc($customerdetail);
		$customer_data_name = $customer_data['name'];
		$html.='<tr>';
		$html.='<td>'.$val['customer_id'].'</td>';
		$html.='<td><a href="customer_card.php?t_cust_id='.$val['customer_id'].'&Submit=1" style="color: blue;">'.$customer_data_name.'</a></td>';
		$html.='<td>'.$key.'</td>';
		$html.='<td>'.number_format($val['loan_out'],2).'</td>';
		$html.='<td>'.number_format($val['collection'],2).'</td>';
		$html.='<td>'.number_format(($val['collection']-$val['loan_out']),2).'</td>';
		$html.='</tr>';
	}
	
}
$html.='<tr style="background-color:#038603;color:white;">';
$html.='<td colspan="3">Total</td>';

$html.='<td class="total_td">'.number_format($loan_out,2).'</td>';
$html.='<td class="total_td">'.number_format($amount,2).'</td>';
$html.='<td class="total_td">'.number_format($balance,2).'</td>';
$html.='</tr>';

echo $html;

die;

?>