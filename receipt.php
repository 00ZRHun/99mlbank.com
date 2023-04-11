<?php
include('config.php');

if (isset($_GET['c'])) {
	$sql = "SELECT * FROM collection WHERE id = '".$_GET['c']."';";
	$res = mysqli_query($conn, $sql);
	$myrow = mysqli_fetch_assoc($res);
	$data = $myrow['image'];
	$type = $myrow['image_type'];
	header("Content-type: $type");
	echo $data;
} else {
	echo "<script>window.location = 'account88.php';</script>";
}
?>