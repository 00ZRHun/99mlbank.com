<?php
if (!(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]))) {
    echo "<script>window.location.href='index.php';</script>";
    exit;
}
