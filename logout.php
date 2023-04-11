<?php
session_start();
require_once('config.php');
unset($_SESSION["user_id"]);


?>
<script>
	//window.location.replace("http://readyforyourreview.com/Loan_software/index.php");]
	window.location.replace("<?php echo SITEURL?>/index.php");
	</script>