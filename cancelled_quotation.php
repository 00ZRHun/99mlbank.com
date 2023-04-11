<?php
include('header.php');
if (isset($_GET['q'])) {
	$sql = "SELECT state FROM quotation WHERE id = '".$_GET['q']."';";
	$res = mysqli_query($conn, $sql);
	$myrow = mysqli_fetch_assoc($res);

	if ($myrow['state'] != "Cancelled") {
		$sql = "UPDATE quotation SET state = 'Cancelled' WHERE id = '".$_GET['q']."';";
	} else {
		if (isset($_GET['i'])) {
			$sql = "UPDATE quotation SET state = 'Confirmed' WHERE id = '".$_GET['q']."';";
		} else {
			$sql = "UPDATE quotation SET state = 'Pending' WHERE id = '".$_GET['q']."';";
		}
	}

	// $sql = "DELETE FROM quotation_details WHERE id = '".$_GET['q']."';";
	mysqli_query($conn, $sql);

	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}

	echo "<script>window.location = '".$previous."';</script>" ;

} else {
	echo "<script>window.location = 'dashboard.php';</script>" ;
}
?>