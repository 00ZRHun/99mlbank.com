<?php
// TODO: add control access level
if (!(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]))) {
    // echo "<script>window.location.href='" . SITEURL . "/index.php';</script>";
    echo "<script>window.location.href='$url/index.php';</script>";   // ditto
    exit;
}
