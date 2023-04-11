<?php
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
//include('auth.php');
$servername = "localhost";
/*$username = "ccrdskmy_loansw";
$password = "gq5QBO,Z8UQN";
$dbname = "ccrdskmy_loan_software";*/
$username = "ecadmin_crm";
$password = "bXwM}E=ME^!t";
$dbname = "ecadmin_crm";

//define("SITEURL","http://readyforyourreview.com/Loan_software"); 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
$host_name = $_SERVER['SERVER_NAME'];
$server_ssl = $_SERVER['REQUEST_SCHEME'];
$url = $server_ssl.'://'.$host_name;
// print_r($_SERVER);
// define("SITEURL","http://crm.ecomdemo.xyz");
 define("SITEURL",$url);


//$host_name = 
$select_superadmin = "SELECT * from domain_list_setting where domain_name='$host_name'";
$row_superadmin = $conn->query($select_superadmin);
$result_superadmin = mysqli_fetch_assoc($row_superadmin);

$domain_status = $result_superadmin['status'];
$table_prefix = $result_superadmin['table_prefix'];
$first_method = $result_superadmin['first_method'];

?>