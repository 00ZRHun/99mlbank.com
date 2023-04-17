<?php
require_once('config.php');
// unset($_SESSION["user_id"]);
$_SESSION["user_id"] = "";
echo "<script>window.location.href='index.php';</script>";   // same as below
// echo "<script>alert('_SESSION[\"user_id\"] = '" . $_SESSION["user_id"] . "')</script>";   // D
?>

<!-- <script>
	//window.location.replace("http://readyforyourreview.com/Loan_software/index.php");]
	window.location.replace("<?= SITEURL ?>/index.php");
</script> -->