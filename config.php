<?php

// declare variable
// add a switch mode between host local or deploy to server
$isLocal = false;
// $isLocal = true;

/* if (!isset($_SESSION))
  session_start(); */
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
//include('auth.php');
$servername = "localhost";
/*$username = "ccrdskmy_loansw";
$password = "gq5QBO,Z8UQN";
$dbname = "ccrdskmy_loan_software";*/
/* $username = "ecadmin_crm";
$password = "bXwM}E=ME^!t";
$dbname = "ecadmin_crm"; */
if ($isLocal) {
  // local credential
  $username = "zrhun";
  $password = "password";
} else {
  // server credential
  $username = "ecadmin_99mlbank";
  $password = "bXwM}E=ME^!t";
}
$dbname = "ecadmin_99mlbank";

//define("SITEURL","http://readyforyourreview.com/Loan_software"); 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} /* else {   // D
  echo ("Connection to $dbname database successful");
} */
$host_name = $_SERVER['SERVER_NAME'];
$host_name = "crm.ecomdemo.xyz";   // * TODO: 99mlbank.com
/* $server_ssl = $_SERVER['REQUEST_SCHEME'];
$url = $server_ssl.'://'.$host_name; */
if ($isLocal) {
  $url = "http://localhost:8080";   // OPT: http://crm.ecomdemo.xyz
} else {
  $url = "https://99mlbank.com";
}
// echo '$url = ' . $url;
// print_r($_SERVER);
// define("SITEURL","http://crm.ecomdemo.xyz");
/* if (!defined("SITEURL"))
  define("SITEURL", $url); */
define("SITEURL", $url);   // TODO: direct use $url var instead SITEURL const
// $_SESSION["SITEURL"] = $url;   // TODO: find a way to get SITEURL as global var / store as


//$host_name = 
/* $select_superadmin = "SELECT * from domain_list_setting where domain_name='$host_name'";
$row_superadmin = $conn->query($select_superadmin);
$result_superadmin = mysqli_fetch_assoc($row_superadmin);

$domain_status = $result_superadmin['status'];
$table_prefix = $result_superadmin['table_prefix'];
$first_method = $result_superadmin['first_method']; */

// initialise variables
// $path_home = SITEURL . "/home.php";
$path_home = $url . "/home.php";
