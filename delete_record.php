<?php
if (isset($_GET['c'])) {
	$card = $_GET['c'];
} else {
	echo '<script>window.location = "home.php";</script>';
}

require_once("config.php");

$sql = "SELECT * FROM collection WHERE id = '".$card."';";
$res = mysqli_query($conn, $sql);
$myrow = mysqli_fetch_assoc($res);
$daycount = $myrow['days'];

$sql = "SELECT * FROM customers_card WHERE id = '".$myrow['card_id']."';";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$crossed_date = $row['crossed_date'];

if ($daycount < 0) {
	$new_crossed_date = date("d-m-Y", strtotime($crossed_date.' + '.$daycount.' days'));
} else {
	$new_crossed_date = date("d-m-Y", strtotime($crossed_date.' - '.$daycount.' days'));
}

$sql = "DELETE FROM collection WHERE id = '".$card."';";
mysqli_query($conn, $sql);

$sql = "UPDATE customers_card SET crossed_date = '".$new_crossed_date."' WHERE id = '".$myrow['card_id']."';";
mysqli_query($conn, $sql);

echo "<script>javascript:history.go(-1)</script>";
?>