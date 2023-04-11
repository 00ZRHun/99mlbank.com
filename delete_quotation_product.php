<?php
include('header.php');
if (isset($_GET['p'])) {
	$sql = "DELETE FROM quotation_details WHERE id = '".$_GET['p']."';";
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