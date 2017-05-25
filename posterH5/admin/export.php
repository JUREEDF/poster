<?php
include_once('./include/init.php');
if (empty($_SESSION['user_name'])) {
    header("location:login.php");
    die;
}
$sql = "select * from user";
?>