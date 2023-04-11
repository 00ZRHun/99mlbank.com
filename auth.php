<?php
include('config.php');

if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]))
{
	
}
else
{
	
	echo "<script>window.location.href='index.php';</script>";
    exit;
}